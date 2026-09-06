<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alexandria — Contato</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
  >
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
    rel="stylesheet"
  >

  <link rel="stylesheet" href="style.css">

<style>
  :root {
  --vinho-alexandria: #8b1e2d;
  --vinho-escuro: #5e1220;
  --dourado-alexandria: #d4af37;
  --dourado-claro: #f0d060;
  --bege-fundo: #f5efe6;
  --bege-card: #fdf8f2;
  --texto: #282525;
  --texto-suave: #555252;
  --borda: #eadfd2;
}

* {
  box-sizing: border-box;
}

body {
  margin: 0;
  background: #fff;
  color: var(--texto);
  font-family: "DM Sans", Arial, sans-serif;
}

.contact-page {
  min-height: 100vh;
  padding: 58px 0 48px;
  overflow: hidden;
}

.hero {
  min-height: 260px;
  position: relative;
}

.hero-content {
  position: relative;
  z-index: 2;
  padding-left: 26px;
}

.eyebrow {
  display: inline-block;
  color: #bf8f16;
  font-size: 14px;
  font-weight: 700;
  letter-spacing: 1.3px;
  margin-bottom: 10px;
}

.hero h1 {
  margin: 0;
  color: #111;
  font-family: "Playfair Display", Georgia, serif;
  font-size: clamp(48px, 5vw, 63px);
  line-height: 1.08;
  font-weight: 700;
}

.gold-line,
.small-gold-line {
  width: 50px;
  height: 3px;
  background: var(--dourado-alexandria);
}

.gold-line {
  margin: 19px 0 20px;
}

.hero p {
  margin: 0;
  color: #4f4c4c;
  font-size: 16px;
  line-height: 1.65;
}

.templo-bg {
  position: absolute;
  z-index: 1;
  top: -58px;
  right: -8px;
  width: 58%;
  max-width: 610px;
  opacity: .54;
  pointer-events: none;
}

.contact-cards {
  position: relative;
  z-index: 3;
  margin-top: 5px;
}

.info-card {
  min-height: 254px;
  padding: 27px 35px 25px;
  background: rgba(255, 255, 255, .97);
  border: 1px solid var(--borda);
  border-radius: 12px;
}

.icon-circle {
  width: 61px;
  height: 61px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 25px;
  border-radius: 50%;
  background: var(--vinho-alexandria);
  color: var(--dourado-claro);
  font-size: 29px;
}

.info-card h2 {
  margin: 0 0 15px;
  color: var(--vinho-alexandria);
  font-family: "Playfair Display", Georgia, serif;
  font-size: 21px;
  font-weight: 700;
}

.info-card p {
  margin: 0 0 8px;
  color: #4c4949;
  font-size: 14px;
  line-height: 1.55;
}

.form-section {
  position: relative;
  z-index: 3;
  margin-top: 27px;
}

.form-card,
.help-card {
  border: 1px solid var(--borda);
  border-radius: 12px;
  background: #fff;
}

.form-card {
  padding: 31px 26px 23px;
}

.form-heading {
  display: flex;
  align-items: flex-start;
  gap: 17px;
  margin-bottom: 31px;
}

.form-heading > i {
  color: #d99f12;
  font-size: 34px;
  transform: rotate(-10deg);
}

.form-heading h2 {
  margin: 0 0 10px;
  color: var(--vinho-alexandria);
  font-family: "Playfair Display", Georgia, serif;
  font-size: 24px;
  font-weight: 700;
}

.small-gold-line {
  width: 40px;
  height: 2px;
}

.form-label {
  margin-bottom: 9px;
  color: #171515;
  font-size: 14px;
  font-weight: 700;
}

.form-label span {
  color: var(--vinho-alexandria);
}

.form-control,
.form-select {
  min-height: 43px;
  border: 1px solid #e5dcd2;
  border-radius: 7px;
  padding: 10px 15px;
  color: #333;
  font-family: "DM Sans", sans-serif;
  font-size: 14px;
  box-shadow: none !important;
}

.form-control::placeholder {
  color: #999;
}

.form-control:focus,
.form-select:focus {
  border-color: var(--dourado-alexandria);
  box-shadow: 0 0 0 3px rgba(212, 175, 55, .12) !important;
}

.form-select {
  appearance: auto;
  color: #777;
}

.textarea-wrap {
  position: relative;
}

.textarea-wrap textarea {
  min-height: 127px;
  resize: vertical;
  padding-bottom: 30px;
}

#counter {
  position: absolute;
  right: 14px;
  bottom: 10px;
  color: #686565;
  font-size: 12px;
}

.form-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 25px;
  margin-top: 2px;
}

.btn-send {
  min-width: 176px;
  padding: 12px 18px;
  border: 0;
  border-radius: 6px;
  background: var(--vinho-alexandria);
  color: #fff;
  font-family: "DM Sans", sans-serif;
  font-size: 14px;
  font-weight: 700;
  transition: .2s ease;
}

.btn-send:hover {
  background: var(--vinho-escuro);
  transform: translateY(-1px);
}

.btn-send i {
  margin-right: 8px;
}

.privacy {
  border-radius: 20px;
  padding: 10px;
  background-color: var(--branco);
  display: flex;
  align-items: center;
  gap: 15px;
  color: #575454;
  font-size: 12px;
  line-height: 1.65;
  border: 2px solid var(--dourado-alexandria);
}

.privacy i {
  color: #d9a514;
  font-size: 27px;
}

.help-card {
  min-height: 552px;
  padding: 41px 28px;
  background: var(--bege-card);
}

.help-icon {
  position: relative;
  width: 65px;
  height: 44px;
  margin-bottom: 22px;
  color: #d9a514;
  font-size: 31px;
}

.help-icon .second-chat {
  position: absolute;
  left: 18px;
  top: 8px;
  font-size: 24px;
}

.help-card h2 {
  position: relative;
  z-index: 2;
  margin: 0;
  color: var(--vinho-alexandria);
  font-family: "Playfair Display", Georgia, serif;
  font-size: 28px;
  line-height: 1.2;
  font-weight: 700;
}

.help-card .small-gold-line {
  position: relative;
  z-index: 2;
  margin: 18px 0 20px;
}

.help-card p {
  position: relative;
  z-index: 2;
  max-width: 255px;
  margin: 0;
  color: #514d4d;
  font-size: 14px;
  line-height: 1.75;
}




</style>

</head>

<body>
  <?php
      include("../FRONT/includes/navbar.html")
    ?>
  <main class="contact-page">

    <section class="hero container position-relative">
      <img src="templo.png" class="templo-bg" alt="" aria-hidden="true">

      <div class="hero-content">
        <span class="eyebrow">CONTATO</span>
        <h1>Fale conosco</h1>
        <div class="gold-line"></div>

        <p>
          Tem alguma dúvida, sugestão ou deseja<br class="desktop-only">
          estabelecer uma parceria? Preencha o formulário<br class="desktop-only">
          ao lado ou utilize um de nossos canais de contato.
        </p>
      </div>
    </section>

    <section class="container contact-cards">
      <div class="row g-3">

        <div class="col-12 col-md-6 col-xl-3">
          <article class="info-card h-100">
            <div class="icon-circle">
              <i class="bi bi-envelope"></i>
            </div>
            <h2>E-mail</h2>
            <p>contato@alexandria.com</p>
            <p>Respondemos em até 24h</p>
          </article>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
          <article class="info-card h-100">
            <div class="icon-circle">
              <i class="bi bi-geo-alt"></i>
            </div>
            <h2>Endereço</h2>
            <p>Rua Academia, 123</p>
            <p>Bela História, São Paulo – SP</p>
            <p>Brasil</p>
          </article>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
          <article class="info-card h-100">
            <div class="icon-circle">
              <i class="bi bi-clock"></i>
            </div>
            <h2>Horário</h2>
            <p>Segunda a Sexta: 8h às 18h</p>
            <p>Sábado: 8h às 12h</p>
            <p>Domingo: Fechado</p>
          </article>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
          <article class="info-card h-100">
            <div class="icon-circle">
              <i class="bi bi-telephone"></i>
            </div>
            <h2>Telefone</h2>
            <p>(11) 4002-8922</p>
            <p>Seg a Sex: 8h às 18h</p>
          </article>
        </div>

      </div>
    </section>

    <section class="container form-section">
      <div class="row g-4 align-items-stretch">

        <div class="col-12 col-lg-8">
          <div class="form-card">
            <div class="form-heading">
              <i class="bi bi-send"></i>
              <div>
                <h2>Envie sua mensagem</h2>
                <div class="small-gold-line"></div>
              </div>
            </div>

            <form id="contactForm" novalidate>
              <div class="row g-4">

                <div class="col-md-6">
                  <label for="nome" class="form-label">
                    Nome completo <span>*</span>
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    id="nome"
                    placeholder="Seu nome"
                    required
                  >
                </div>

                <div class="col-md-6">
                  <label for="email" class="form-label">
                    E-mail <span>*</span>
                  </label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    placeholder="seu@email.com"
                    required
                  >
                </div>

                <div class="col-12">
                  <label for="assunto" class="form-label">
                    Assunto <span>*</span>
                  </label>
                  <select class="form-select" id="assunto" required>
                    <option value="" selected disabled>Selecione um assunto</option>
                    <option>Dúvida</option>
                    <option>Sugestão</option>
                    <option>Parceria</option>
                    <option>Suporte</option>
                    <option>Outro</option>
                  </select>
                </div>

                <div class="col-12">
                  <label for="mensagem" class="form-label">
                    Mensagem <span>*</span>
                  </label>
                  <div class="textarea-wrap">
                    <textarea
                      class="form-control"
                      id="mensagem"
                      rows="5"
                      maxlength="1000"
                      placeholder="Escreva sua mensagem aqui..."
                      required
                    ></textarea>
                    <span id="counter">0 / 1000</span>
                  </div>
                </div>

                <div class="col-12 form-footer">
                  <button type="submit" class="btn-send">
                    <i class="bi bi-send"></i>
                    Enviar mensagem
                  </button>

                </div>

                <div class="col-12">
                  <div id="formAlert" class="alert d-none mb-0" role="alert"></div>
                </div>

              </div>
            </form>
          </div>
        </div>

        <div class="col-12 col-lg-4">
          <aside class="help-card h-100 position-relative overflow-hidden">
            <div class="help-icon">
              <i class="bi bi-chat"></i>
              <i class="bi bi-chat-fill second-chat"></i>
            </div>

            <h2>Estamos aqui<br>para ajudar!</h2>
            <div class="small-gold-line"></div>

            <p>
              Nossa equipe está pronta para atender você da melhor forma
              possível. Retornaremos o mais breve possível.
            </p>

            <div class="privacy">
                    <i class="bi bi-lock"></i>
                    <span>Seus dados estão protegidos<br>e não compartilhamos suas informações.</span>
            </div>

          </aside>
        </div>

      </div>
    </section>

  </main>
  <?php
      include("../FRONT/includes/footer.html")
    ?>
</body>
</html>