<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Site</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --vinho-alexandria:   #8b1e2d;
            --vinho-escuro:       #5e1220;
            --dourado-alexandria: #d4af37;
            --dourado-claro:      #f0d060;
            --bege-fundo:         #f5efe6;
            --bege-card:          #fdf8f2;
            --preto-contraste:    #1a1a1a;
            --cinza-destaque:     #dee0e3;
            --cinza-texto:        #555;
            --branco:             #ffffff;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: var(--vinho-alexandria);
        }

        .layout {
            width: 100%;
            height: 100vh;
            display: flex;
            margin: 0;
            padding: 40px;
        }

        .left,
        .right {
            flex: 1;             /* cada uma ocupa metade */
            display: flex;
            justify-content: center;
            align-items: center;

            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        .left {
            background-image: url('../FRONT/imagens/imagem-login.png');
        }

        .right {
            background-color: white;
        }

        .hero-section {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 92vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 80px 20px;
            position: relative; /* importante */
            overflow: hidden;
        }

        .back-button {
            position: absolute;
            top: 25px;
            left: 25px;
            color: var(--vinho-alexandria);
            font-size: 32px;
            text-decoration: none;
            z-index: 10;
        }

        .back-button:hover {
            color: var(--vinho-escuro);
        }

        .hero-eyebrow {
            display: inline-block;
            background-color: var(--dourado-alexandria);
            color: var(--preto-contraste);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            padding: 6px 18px;
            border-radius: 2px;
            margin-bottom: 28px;
        }

        .hero-title {
            font-size: clamp(1.2rem, 2.25vw, 2.1rem);
            color: var(--preto-contraste);
            line-height: 1;
            margin-bottom: 24px;
            font-weight: 700;
        }

        .hero-title span {
            color: var(--vinho-alexandria);
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: var(--preto-contraste);
            max-width: 640px;
            margin: 0 auto 40px;
            line-height: 1.7;
        }

        .login-card {
            width: 100%;
            max-width: 850px;
            height: 100%;
            padding: 40px 90px;
            height: fit-content;
        }

        h1{

            font-family:'Cormorant Garamond', serif;
            font-size:32px;
            color:#651B1B;
            text-align:center;

        }

        .divider{

            display:flex;
            align-items:center;
            justify-content:center;
            gap:5px;

            margin-bottom:20px;

        }

        .divider::before,
        .divider::after{

            content:"";
            width:75px;
            height:2px;
            background:#D9A63A;

        }

        .diamond{

            width:10px;
            height:10px;
            background:#D9A63A;
            transform:rotate(45deg);

        }

        label {
            color: #651B1B;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 15px;
        }

        .input-group {
            margin-bottom: 6px;
        }

        .input-group-text {
            height: 48px;
            padding: 8px 12px;
            background: white;
            border: 1px solid #ced4da;
        }

        .form-control {
            height: 48px;
            font-size: 16px;
            padding: 10px 14px;
            border-radius: 6px;
            border: 1px solid #ced4da;
        }

        .form-control:focus{

            box-shadow:none;
            border-color:#ced4da;

        }

        .options{

            display:flex;
            justify-content:space-between;
            align-items:center;

            margin-bottom:30px;

        }

        .options a{

            text-decoration:none;
            color:#D4A339;
            font-weight:500;

        }

        .btn-login {
            height: 50px;
            border: none;
            background: #D9A63A;
            color: var(--preto-contraste);
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            width: 50%;
            transition: .3s;
        }

        .btn-login:hover{

            background:#c8921d;

        }

        .register{

            text-align:center;

        }

        .register a{

            color:#D4A339;
            text-decoration:none;
            font-weight:600;

        }

        .button{
            width: 100%;
            display: flex;
            justify-content: center;
        }

    </style>
</head>
<body>

    <div class="layout">
        <div class="left rounded-start-4 p-3">
            <div class="fundo-site">
                <section class="hero-section">

    <a href="#" class="back-button">
        <i class="bi bi-arrow-left"></i>
    </a>

    <div class="d-flex flex-column">
        <div class="d-flex flex-row">
            <div class="text-center">

                <span class="hero-eyebrow">
                    Prepare-se. Compreenda. Conquiste sua vaga.
                </span>

                <h1 class="hero-title">
                    Domine a História.<br>
                    <span>Conquiste</span> seu próximo objetivo.
                </h1>

                <p class="hero-subtitle">
                    Na Alexandria, você encontra uma preparação completa
                    em História do Brasil e Geral, organizada para
                    vestibulares e concursos.
                </p>

            </div>
        </div>
    </div>

</section>
            </div>
        </div>
        <div class="right rounded-end-4 p3">
            <div class="login-card">
    <h1>Login</h1>
    <div class="divider">
        <div class="diamond"></div>
    </div>
    <label>E-mail</label>
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-envelope fs-4"></i>
        </span>
        <input
            type="email"
            class="form-control"
            placeholder="alexandria@gmail.com">
    </div>
    <label>Senha</label>
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-lock fs-4"></i>
        </span>
        <input
            type="password"
            class="form-control"
            placeholder="Sua senha">
        <span class="input-group-text">
            <i class="bi bi-eye fs-4"></i>
        </span>
    </div>
    <div class="options">
        <div class="form-check">
            <input
                class="form-check-input"
                type="checkbox"
                id="remember">
            <label
                class="form-check-label"
                for="remember">
                Lembrar de mim
            </label>
        </div>
        <a href="#">Esqueci minha senha</a>
    </div>
    <div class="button">
    <button class="btn-login">
        Entrar &nbsp;
        <i class="bi bi-arrow-right"></i>
    </button>
    </div>

    <div class="register">
        Não tem uma conta?
        <a href="#">
            Crie agora
        </a>
    </div>
</div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>