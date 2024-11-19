<?php
session_start();
include_once('conect.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuarios'])) {
    header('Location: login.php'); // Redireciona para o login
    exit();
}

$id_usuario = $_SESSION['id_usuarios']; // ID do usuário logado
$id_carrinho = $_SESSION['id_carrinho']; // ID do carrinho do usuário logado
// Consulta SQL para obter os itens do carrinho
$sql_carrinho = "
    SELECT 
        p.id_produto,
        p.nome,
        p.imagem,
        p.preco,
        c.quantidade,
        (p.preco * c.quantidade) AS total
    FROM 
        meu_carrinho c
    JOIN 
        produtos p 
    ON 
        p.id_produto = c.id_produto
    WHERE 
        c.id_carrinho = ?;
";


$stmt = $conexao->prepare($sql_carrinho);
$stmt->bind_param('i', $id_carrinho);

if ($stmt->execute()) {
    $result = $stmt->get_result();
} else {
    echo "Erro ao buscar itens do carrinho: " . $stmt->error;
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/carrinho.css">
    <link rel="stylesheet" href="../css/global.css">
    <title>Carrinho</title>
</head>

<body>
    <a class="btn_voltar" href="sistema.php">voltar</a>
    <table>
        <thead>
            <tr>
                <th>Carrinho</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='" . htmlspecialchars($row['imagem']) . "' alt='" . htmlspecialchars($row['nome']) . "'></td>";
                    echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                    echo "<td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>";
                    echo "<td>" . $row['quantidade'] . "</td>";
                    echo "<td>R$ " . number_format($row['total'], 2, ',', '.') . "</td>";
                    //botao excluir
                    echo "<td class='btn_cancel'><a href='excluir.php?id_produto=" . $row['id_produto'] . "'>Cancelar</a></td>";
                }
            } else {
                echo "<tr><td colspan='5'>Seu carrinho está vazio.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
</body>

</html>