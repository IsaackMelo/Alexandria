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
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../estilo/alexandria.css">
<link rel="stylesheet" href="../estilo/paginas/web-contato.css">

<link rel="stylesheet" href="../estilo/responsivo.css">
<link rel="stylesheet" href="../estilo/site.css">
</head>

<body class="pagina-site">
  <?php
      include __DIR__ . '/../includes/navbar.html';
    ?>
  <section class="banner-contato">
    <div class="banner-conteudo">
      <span class="eyebrow">CONTATO</span>
      <h1>Fale conosco</h1>
      <div class="gold-line"></div>

      <p>
        Tem alguma dúvida, sugestão ou deseja estabelecer uma parceria?
        Preencha o formulário abaixo ou use um dos nossos canais de contato.
      </p>

      <div class="banner-botoes">
        <a href="../web/plano.php" class="botao-ouro">Garantir minha vaga</a>
        <a href="../web/missao.php" class="botao-vazado">Conhecer a Missão</a>
      </div>
    </div>
  </section>

  <main class="contact-page">

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
      include __DIR__ . '/../includes/footer.html';
    ?>
</body>
</html>