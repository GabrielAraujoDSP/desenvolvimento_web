<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/Favicon.svg" type="image/x-icon">
    <title>La Forno — Entrar</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <img src="assets/forno 1 (Traced).svg" alt="La Forno">
                <h1>La Forno</h1>
            </div>

            <div class="login-abas">
                <button class="aba ativa" id="btn-entrar" onclick="trocarAba('entrar')">Entrar</button>
                <button class="aba" id="btn-cadastro" onclick="trocarAba('cadastro')">Criar Conta</button>
            </div>

            <!-- Formulário para o usuário entrar na sua conta -->
            <form id="form-entrar" action="server/processar.php" method="post" style="display:flex; flex-direction:column; gap:12px;">
                <input type="hidden" name="acao" value="login">
                <div class="campo">
                    <label>E-mail</label>
                    <input class="input-email" type="email" name="email" placeholder="seu@email.com" required>
                </div>
                <div class="campo">
                    <label>Senha</label>
                    <input class="input-senha" type="password" name="senha" placeholder="Sua senha" required>
                </div>
                <button type="submit" class="btn-submit">Entrar</button>
            </form>

            <!-- Formulário para o usuário se cadastrar -->
            <form id="form-cadastro" action="server/processar.php" method="post" style="display:none; flex-direction:column; gap:12px;">
                <input type="hidden" name="acao" value="cadastro">
                <div class="campo">
                    <label>Nome completo</label>
                    <input class="input-nome" type="text" name="nome" placeholder="Seu nome" required>
                </div>
                <div class="campo">
                    <label>E-mail</label>
                    <input class="input-email" type="email" name="email" placeholder="seu@email.com" required>
                </div>
                <div class="campo">
                    <label>Senha</label>
                    <input class="input-senha" type="password" name="senha" placeholder="Crie uma senha" required>
                </div>
                <button type="submit" class="btn-submit">Criar Conta</button>
            </form>

        </div>
    </div>

    <script src="scripts/login.js"></script>
</body>
</html>