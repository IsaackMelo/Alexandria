import chromadb
from sentence_transformers import SentenceTransformer
from config.settings import settings

class ChromaService:
    def __init__(self):
        self.client = chromadb.PersistentClient(path=settings.CHROMA_PERSIST_DIRECTORY)
        self.embedding_model = SentenceTransformer('all-MiniLM-L6-v2')
        self.collection = self.client.get_or_create_collection(name="alexandria_conteudos")

    def buscar_conteudos_similares(self, query_text, n_results=2):
        resultados = self.collection.query(
            query_texts=[query_text],
            n_results=n_results
        )
        
        conteudos = []
        if resultados and 'documents' in resultados and resultados['documents']:
            docs = resultados['documents'][0]
            metadatas = resultados['metadatas'][0] if 'metadatas' in resultados else []
            
            for i, doc in enumerate(docs):
                meta = metadatas[i] if i < len(metadatas) else {}
                conteudos.append({
                    "id_conteudo": meta.get("id_conteudo", 1),
                    "titulo": meta.get("titulo", "Conteúdo Histórico"),
                    "trecho": doc
                })
                
        return conteudos

chroma_service = ChromaService()