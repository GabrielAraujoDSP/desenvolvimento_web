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
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <img src="assets/forno 1 (Traced).svg" alt="La Forno">
                <h1>La Forno</h1>
            </div>

            <h2 class="perfil-titulo">Olá, <?php echo $_SESSION['usuario_nome']; ?>!</h2>

            <p class="perfil-subtitulo">Bem-vindo à sua conta.</p>

            <a href="server/processar.php?acao=logout" class="perfil-sair">Sair da conta</a>
        </div>
    </div>
</body>
</html>