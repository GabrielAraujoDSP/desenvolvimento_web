<?php
session_start();
require_once 'server/conexao.php';

$stmt = $conn->prepare("SELECT nome, preco, descricao FROM produtos WHERE ativo = 1 LIMIT 3");
$stmt->execute();
$mais_vendidos = $stmt->get_result();
?>

<!DOCTYPE mais-vendidos__textohtml>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="shortcut icon" href="assets/Favicon.svg" type="image/x-icon">
    <title>La Forno</title>
</head>
<body>
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
        <a class="cabecalho__carrinho" href="carrinho.html">
            <img src="assets/carrinho.svg" alt="">
            <span class="carrinho__contador" id="carrinho-contador"></span>
        </a>
    </header>

    <section class="banner">
        <img src="assets/banner.svg" alt="">
    </section>

    <main class="mais-vendidos">
        <h2 class="mais-vendidos__texto">Mais Vendidos</h2>
        <div class="mais-vendidos__produtos">
            <?php while($produto = $mais_vendidos->fetch_assoc()): ?>
            <div class="vendidos__produtos__card">
                <img class="vendidos__produtos__card__pizza" src="assets/pizzas/pizza_margueita.svg" alt="">
                <p><?php echo $produto['nome']; ?></p>
                <p>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                <div class="vendidos__produtos__card__quantidade">
                    <button>-</button>
                    <p>0</p>
                    <button>+</button>
                </div>
                <a class="vendidos__produtos__card__link" href="#">Adicionar à cesta</a>
            </div>
            <?php endwhile; ?>
        </div>
    </main>

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
<script src="scripts/script.js"></script>
</body>
</html>
