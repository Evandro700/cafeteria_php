
<?php
// compras.php

session_start();
include_once('conect.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    // Se não estiver logado, destrua a sessão e redirecione para a página de login
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['id_usuarios']);
    header('Location: login.php'); // Altere para a página de login, se necessário
    exit();
}

// Verificar se o ID do usuário está presente
if (!isset($_SESSION['id_usuarios'])) {
    echo "Você precisa estar logado para adicionar ao carrinho.";
    exit();
    
}

$id_carrinho = $_SESSION['id_carrinho']; // O ID do usuário logado
$id_produto = $_POST['id_produto']; // O ID do produto a ser adicionado
$quantidade = 1; // Quantidade padrão pode ser ajustada conforme a necessidade

// Verifica se o produto já existe no carrinho
$sql = "SELECT * FROM  meu_carrinho WHERE id_carrinho = ? AND id_produto = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('ii', $id_carrinho, $id_produto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Se o produto já estiver no carrinho, você pode atualizar a quantidade
    $sql_update = "UPDATE meu_carrinho SET quantidade = quantidade + 1 WHERE id_carrinho = ? AND id_produto = ?";
    $stmt_update = $conexao->prepare($sql_update);
    $stmt_update->bind_param('ii', $id_carrinho, $id_produto);
    $stmt_update->execute();
    echo "Produto atualizado no carrinho.";
} else {
    // Se o produto não estiver no carrinho, insere um novo
    $sql_insert = "INSERT INTO meu_carrinho (id_carrinho, id_produto, quantidade) VALUES (?, ?, ?)";
    $stmt_insert = $conexao->prepare($sql_insert);
    $stmt_insert->bind_param('iii', $id_carrinho, $id_produto, $quantidade);
    $stmt_insert->execute();
    echo "Produto adicionado ao carrinho.";
}
?>