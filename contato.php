<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/contato.css">
    <link rel="shortcut icon" href="assets/Favicon.svg" type="image/x-icon">
    <title>La Forno — Cardápio</title>
</head>
<body>
    <!-- Cabeçalho -->
    <header class="cabecalho">
        <div class="cabecalho__logo">
            <h1 class="cabecalho__logo__texto">La Forno</h1>
            <img class="cabecalho__logo__imagem" src="assets/forno 1 (Traced).svg" alt="">
        </div>
        <nav class="cabecalho__navbar">
            <ul class="cabecalho__navbar__lista">
                <li class="cabecalho__navbar__lista__item"><a href="index.php">Início</a></li>
                <li class="cabecalho__navbar__lista__item"><a href="cardapio.php">Cardápio</a></li>
                <li class="cabecalho__navbar__lista__item"><a href="sobre_nos.php">Sobre Nós</a></li>
                <li class="cabecalho__navbar__lista__item"><a href="contato.php">Contato</a></li>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                <li class="cabecalho__navbar__lista__item">
                    <a href="perfil.php">Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></a>
                </li>
                <li class="cabecalho__navbar__lista__item">
                    <a href="server/processar.php?acao=logout" class="btn-entrar">Sair</a>
                </li>
                <?php else: ?>
                <li class="cabecalho__navbar__lista__item">
                    <a href="login.php" class="btn-entrar">Entrar</a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <a class="cabecalho__carrinho" href="#"><img src="assets/carrinho.svg" alt=""></a>
    </header>
    <!-- Fim do cabeçalho -->

    <!-- Banner da Loja -->
    <section class="banner">
        <img src="assets/banner.svg" alt="">
    </section>
    <!-- Fim do Banner -->

    <!-- Caixa de atendimento -->
    <section class="contato-topo">

        <div class="contato-topo__whatsapp">

            <div class="whatsapp__icone">
                <a href="assets/w0fu52c6a8t61.jpg">
                    <img src="assets/whatsapp-svgrepo-com.svg" alt="WhatsApp">
                </a>
            </div>

            <div class="whatsapp__texto">
                <span>ATENDIMENTO RÁPIDO</span>

                <h2>Fale conosco<br>pelo WhatsApp</h2>

                <p>
                Dúvidas sobre pedidos, entregas,
                pagamentos ou cardápio? Chama a gente!
                </p>

                <a href="#" class="botao-whatsapp">
                Converse no WhatsApp
                </a>
            </div>

        </div>

        <div class="contato-topo__horario">

            <div class="horario__titulo">

                <div class="horario__icone"></div>

                <span>HORÁRIO DE ATENDIMENTO</span>

            </div>

            <p>Todos os dias</p>

            <h3>das 18h às 23h30</h3>

            <div class="tempo-entrega">
            Tempo médio de entrega: 40 a 60 min
        </div>

            <p class="acompanhamento">
                Acompanhe seu pedido em tempo real
                na página de acompanhamento.
            </p>

        </div>

    </section>
    <!-- Fim da caixa de atendimento -->


    <!-- Formulário-->
    <main class="conteiner-contato">
        <section class="contato">
            <h2>Fale Conosco</h2>
            <p>Para qualquer dúvida, críticas ou sugestões, mande uma mensagem para nós!</p>
            <form action="server/processar.php" method="post" class="forme-contato">
                <input type="hidden" name="acao" value="contato">
                <div class="tropa-do-input">
                    <label for="titulo_nome">Seu Nome:</label><br>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>
                </div>

                <div class="tropa-do-input">
                    <label for="titulo_email">Seu E-mail:</label><br>
                    <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                </div>

                <div class="tropa-do-input">
                    <label for="titulo_mensagem">Sua Mensagem:</label><br>
                    <textarea name="mensagem" id="mensagem-cliente" placeholder="Como podemos te ajudar?" required></textarea>
                </div>

                <button type="submit" class="botao-enviar">Enviar Mensagem</button>
            </form>
        </section>
    </main>
    <!-- Fim do Formulário -->

    <!-- Rodapé-->
    <footer class="footer">
        <div class="footer_superior">
            <div class="footer_superior__logo">
                <img src="assets/forno 1 (Traced).svg" alt="">
                <p>La Forno</p>
            </div>

            <div class="line"><img src="assets/line-xl-svgrepo-com.svg" alt=""></div>

            <div class="footer__superior__informacoes">
                <p>Email: tropadapizza@gmail.com</p>
                <p>Localização: Botafogo é bairro</p>
            </div>

            <div class="line"><img src="assets/line-xl-svgrepo-com.svg" alt=""></div>

            <div class="footer__superior__contatos">
                <a href="assets/w0fu52c6a8t61.jpg"><img src="assets/whatsapp-svgrepo-com.svg" alt=""></a>
                <a href="#"><img src="assets/instagram-svgrepo-com.svg" alt=""></a>
            </div>
        </div>
        <div class="footer_infeior">
            <h3>Desenvolvido por: Gabriel Araújo, Thiago Marlon, Davi Costa e Felipe Carnot</h3>
        </div>
    </footer>
    <script src="scripts/formulario_msg_de_envio.js"></script>
</body>
</html>