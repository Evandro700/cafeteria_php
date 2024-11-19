<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include_once('conect.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";

    $result = $conexao->query($sql);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) < 1) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
              
        header('Location: login.php');
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;   
        $_SESSION['id_usuarios'] = $row['id_usuarios'];
        $id_usuario_int = intval($row['id_usuarios']);
        $sql_carrinho = "SELECT * FROM carrinho WHERE id_usuarios = $id_usuario_int";
        $result_carrinho = $conexao->query($sql_carrinho);
        $row_carrinho = mysqli_fetch_assoc($result_carrinho);
        $_SESSION['id_carrinho'] = $row_carrinho['id'];
        header('Location: sistema.php');

    }
    

}


?>