<?php
session_start();
require_once 'conexao.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['erro' => 'Método não permitido']);
    exit;
}

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['erro' => 'Usuário não autenticado']);
    exit;
}

$dados = json_decode(file_get_contents('php://input'), true);

if (!$dados || empty($dados['itens']) || !isset($dados['total'])) {
    echo json_encode(['erro' => 'Dados do pedido inválidos']);
    exit;
}

$usuario_id = (int) $_SESSION['usuario_id'];
$total      = (float) $dados['total'];
$itens      = $dados['itens'];
$end        = $dados['endereco'] ?? [];

// "Rua das Flores — Bairro Centro"  ->  rua + bairro
$rua_bairro = explode(' — ', $end['logradouro'] ?? '', 2);
$rua    = trim($rua_bairro[0] ?? '');
$bairro = trim($rua_bairro[1] ?? '');

// "São Paulo / SP"  ->  cidade + uf
$cidade_uf = explode(' / ', $end['cidade'] ?? '', 2);
$cidade = trim($cidade_uf[0] ?? '');
$uf     = trim($cidade_uf[1] ?? '');

$numero = $end['numero'] ?? '';
$cep    = preg_replace('/\D/', '', $end['cep'] ?? '');

$stmt = $conn->prepare(
    "INSERT INTO pedidos (usuario_id, status, total, entrega_rua, entrega_numero, entrega_bairro, entrega_cidade, entrega_uf, entrega_cep)
     VALUES (?, 'pago', ?, ?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param('idssssss', $usuario_id, $total, $rua, $numero, $bairro, $cidade, $uf, $cep);
$stmt->execute();

$pedido_id = $conn->insert_id;

foreach ($itens as $item) {
    $nome_item  = $item['nome'] ?? '';
    $quantidade = (int) ($item['quantidade'] ?? 1);
    $preco_unit = (float) ($item['preco'] ?? 0);

    $s = $conn->prepare("SELECT id FROM produtos WHERE nome = ?");
    $s->bind_param('s', $nome_item);
    $s->execute();
    $produto = $s->get_result()->fetch_assoc();

    if (!$produto) continue;

    $produto_id = (int) $produto['id'];

    $s2 = $conn->prepare("INSERT INTO pedido_itens (pedido_id, produto_id, quantidade, preco_unit) VALUES (?, ?, ?, ?)");
    $s2->bind_param('iiid', $pedido_id, $produto_id, $quantidade, $preco_unit);
    $s2->execute();
}

echo json_encode(['sucesso' => true, 'pedido_id' => $pedido_id]);
