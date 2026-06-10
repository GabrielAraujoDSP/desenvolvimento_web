<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'];

    // CONTATO
    if ($acao === 'contato') {
        $nome     = trim($_POST['nome']);
        $email    = trim($_POST['email']);
        $mensagem = trim($_POST['mensagem']);

        $stmt = $conn->prepare("INSERT INTO contatos (nome, email, mensagem) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $mensagem);
        $stmt->execute();

        header('location: /desenvolvimento_web/contato.html?sucesso=1#contato');
        exit;
    }

    // CADASTRO
    if ($acao === 'cadastro') {
        $nome  = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha_hash) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $senha_hash);
        $stmt->execute();

        header('location: /desenvolvimento_web/login.php?cadastro=1');
        exit;
    }

    // LOGINc - Conectar-se
    if ($acao === 'login') {
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        $stmt = $conn->prepare("SELECT id, nome, senha_hash, tipo FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario   = $resultado->fetch_assoc();

        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
            $_SESSION['usuario_id']   = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];

            if ($usuario['tipo'] === 'admin') {
                header('location: /desenvolvimento_web/admin.php');
            } else {
                header('location: /desenvolvimento_web/perfil.php');
            }
            exit;
        } else {
            header('location: /desenvolvimento_web/login.php?erro=1');
            exit;
        }
    }
}

// Logout - Sair
if (isset($_GET['acao']) && $_GET['acao'] === 'logout') {
    session_destroy();
    header('location: /desenvolvimento_web/index.php');
    exit;
}
?>