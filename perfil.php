<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('location: /desenvolvimento_web/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/Favicon.svg" type="image/x-icon">
    <title>La Forno — Meu Perfil</title>
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/perfil.css">
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
                <li class="cabecalho__navbar__lista__item">
                    <a href="perfil.php">Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></a>
                </li>
                <li class="cabecalho__navbar__lista__item">
                    <a href="server/processar.php?acao=logout" class="btn-entrar">Sair</a>
                </li>
            </ul>
        </nav>
        <a class="cabecalho__carrinho" href="#"><img src="assets/carrinho.svg" alt=""></a>
    </header>

    <!-- Conteúdo do perfil -->
    <main class="perfil">
        <div class="perfil__card">
            <h2>Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h2>
            <p>Bem-vindo à sua conta.</p>
            <a href="server/processar.php?acao=logout" class="perfil__sair">Sair da conta</a>
        </div>
    </main>

    <!-- Rodapé -->
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

</body>
</html>