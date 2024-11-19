
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
$id_produto = $_GET['id_produto']; // O ID do produto a ser adicionado
$quantidade = 1; // Quantidade padrão pode ser ajustada conforme a necessidade

// Verifica se o produto já existe no carrinho
$sql = "SELECT * FROM  meu_carrinho WHERE id_carrinho = ? AND id_produto = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('ii', $id_carrinho, $id_produto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sql_delete = "DELETE FROM meu_carrinho WHERE id_carrinho = ? AND id_produto = ?";
    $stmt_delete = $conexao->prepare($sql_delete);
    $stmt_delete->bind_param('ii', $id_carrinho, $id_produto);
    $stmt_delete->execute();
    
    
    echo "Produto apagado no carrinho.";
    header('Location: carrinho.php');
} else {
    
    echo "Produto não encontrado no carrinho.";
}
?>