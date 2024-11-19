<?php
//envia todos os dados do cliente para o banco criando um cadastro do usuario


if (isset($_POST['submit'])) {

    include_once('conect.php');

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];

    $result = mysqli_query($conexao, "INSERT INTO usuarios (nome, sobrenome, email, telefone, senha) 
        VALUES ('$nome', '$sobrenome', '$email', '$telefone', '$senha')");
    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";

    $result = $conexao->query($sql);
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    
    $id_usuarios = $arr[0]['id_usuarios'];
    $result_carrinho = mysqli_query($conexao, "INSERT INTO carrinho (id_usuarios) 
        VALUES ($id_usuarios)");
    header('Location: login.php');
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastro.css">
    <title>cadastro</title>
</head>
<body>
    <div class="edit-delete">

        <form action="cadastro.php" method="POST">
            <h3>Cadastro</h3>
            <input class="input" type="text" name="nome" id="nome" placeholder="nome" required>
            <br>
            <input class="input" type="text" name="sobrenome" id="sobrenome" placeholder="sobrenome" required>
            <br>
            <input class="input" type="email" name="email" id="email" placeholder="email" required>
            <br>
            <input class="input" type="number" name="telefone" id="telefone" placeholder="telefone" required>
            <br>
            <input class="input" type="password" name="senha" id="senha" placeholder="senha" required>
            <br>
            <input class="btn" type="submit" name="submit" value="Enviar" required>
            <a href="login.php">Ja possui uma conta?</a>
        </form>
    </div>
</body>

</html>