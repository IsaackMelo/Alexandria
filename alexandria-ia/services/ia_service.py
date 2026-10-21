import anthropic
from config.settings import settings

class IAService:
    def __init__(self):
        self.client = anthropic.Anthropic(api_key=settings.AI_API_KEY)

    def gerar_feedback(self, nota_final, questoes_erradas, conteudos_relacionados):
        prompt = f"""
        Você é o tutor de história especialista da plataforma Alexandria. 
        Um aluno acabou de realizar um simulado e obteve a nota final: {nota_final}.
        
        As questões que ele errou foram:
        {questoes_erradas}
        
        Com base nesses erros, foram encontrados os seguintes conteúdos de estudo recomendados no banco de dados:
        {conteudos_relacionados}
        
        Gere um feedback detalhado, motivador e em português, explicando o que ele precisa revisar com base nos erros cometidos e indicando claramente os conteúdos recomendados.
        """

        response = self.client.messages.create(
            model="claude-3-haiku-20240307",
            max_tokens=1000,
            messages=[
                {"role": "user", "content": prompt}
            ]
        )

        return response.content[0].text

ia_service = IAService()