from flask import Flask
from routes.feedback import feedback_bp

app = Flask(__name__)

app.register_blueprint(feedback_bp)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)