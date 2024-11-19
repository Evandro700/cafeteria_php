<?php
session_start();
include_once('conect.php');

        // Verifica se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
    exit;
}

$logado = $_SESSION['email'];

        // Consulta para pegar os dados do usuário logado
$sql = "SELECT * FROM usuarios WHERE email = '$logado' LIMIT 1";
$result = $conexao->query($sql);

if ($result && $result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    echo "Nenhum dado encontrado para o usuário logado.";
}

                // Ação para editar o usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar'])) {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];

                                // Atualiza os dados no banco
    $sql = "UPDATE usuarios SET nome = ?, sobrenome = ?, email = ?, telefone = ?, senha = ? WHERE id_usuarios = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('sssssi', $nome, $sobrenome, $email, $telefone, $senha, $user_data['id']);

    if ($stmt->execute()) {
        // Se os dados forem atualizados com sucesso, vai recagerar a página
        echo "Dados atualizados com sucesso!";
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
        exit;
    } else {
        echo "Erro ao atualizar dados.";
    }
}

    // Ação para excluir a conta
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['excluir'])) {
    // Deleta a conta
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('i', $user_data['id']);

    if ($stmt->execute()) {
        echo "Conta excluída com sucesso!";
        header("Location: login.php");
        exit;
    } else {
        echo "Erro ao excluir conta.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/config.css">
    <title>Configuraçao</title>

</head>

<body>
    <a href="sistema.php">Voltar</a>


    <div class="profile-box">
        <!-- Formulário para Editar Dados do usuario -->
        <form class="form" action="config.php" method="POST">

            <h2> <span>Bem-vindo</span> <?php echo $user_data['nome']; ?> <?php echo $user_data['sobrenome']; ?>!</h2>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $user_data['nome']; ?>" required>
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" name="sobrenome" value="<?php echo $user_data['sobrenome']; ?>" required>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $user_data['email']; ?>" required>
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" value="<?php echo $user_data['telefone']; ?>" required>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" value="<?php echo $user_data['senha']; ?>" required>
            <br>
            <input class="btn" type="submit" name="editar" value="Editar">
        </form>


        <form class="delet" action="" method="POST"
            onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
            <input class="button" type="submit" name="excluir" value="Excluir Conta">
        </form>




</body>

</html>