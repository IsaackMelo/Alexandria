from flask import Blueprint, request, jsonify
from services.chroma_service import chroma_service
from services.ia_service import ia_service

feedback_bp = Blueprint('feedback_bp', __name__)

@feedback_bp.route('/feedback', methods=['POST'])
def processar_feedback():
    dados = request.get_json()
    
    if not dados:
        return jsonify({"erro": "Dados inválidos ou ausentes"}), 400

    id_resultado = dados.get("id_resultado")
    id_simulado = dados.get("id_simulado")
    nota_final = dados.get("nota_final")
    respostas = dados.get("respostas", [])
    questoes = dados.get("questoes", [])

    # Mapeia a alternativa correta de cada questão
    gabarito = {q["id_quest"]: q["alt_correta"] for q in questoes}

    # Filtra apenas as questões que o usuário errou
    questoes_erradas = []
    textos_para_busca = []

    for resp in respostas:
        id_q = resp["id_quest"]
        if resp["acertou"] == 0:
            alt_escolhida = resp["alt_escolhida"]
            alt_correta = gabarito.get(id_q, "Desconhecida")
            
            detalhe_erro = f"Questão {id_q}: Usuário escolheu {alt_escolhida}, mas o correto era {alt_correta}."
            questoes_erradas.append(detalhe_erro)
            textos_para_busca.append(f"História questão {id_q}")

    # Busca conteúdos similares no ChromaDB baseados nos erros
    query_str = " ".join(textos_para_busca) if textos_para_busca else "História geral do Brasil e Mundial"
    conteudos_relacionados = chroma_service.buscar_conteudos_similares(query_str, n_results=2)

    # Gera o feedback personalizado utilizando a IA
    feedback_texto = ia_service.gerar_feedback(nota_final, questoes_erradas, conteudos_relacionados)

    # Formata a resposta no padrão esperado pelo PHP
    resposta_json = {
        "feedback": feedback_texto,
        "conteudos_recomendados": [
            {
                "id_conteudo": c["id_conteudo"],
                "titulo": c["titulo"]
            } for c in conteudos_relacionados
        ]
    }

    return jsonify(resposta_json), 200