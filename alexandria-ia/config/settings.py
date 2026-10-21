import os

class Settings:
    # Chave da API de IA (Anthropic Claude ou OpenAI)
    AI_API_KEY = os.getenv("AI_API_KEY", "sua-chave-aqui")
    
    # Configurações do ChromaDB
    CHROMA_PERSIST_DIRECTORY = os.getenv("CHROMA_DIR", "./chroma_db")

settings = Settings()