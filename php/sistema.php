<?php

// Sistema já logado por conteúdo para usuário logado
session_start();

include_once('conect.php');

if (!isset($_SESSION['email']) == true && !isset($_SESSION['senha']) == true) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}


$logado = $_SESSION['email'];
$id_usuario = $_SESSION['id_usuarios'];

$sql = "SELECT * FROM usuarios ORDER BY id_usuarios DESC";
$result = $conexao->query($sql);
$sqlcarrinho = "SELECT * FROM produtos ORDER BY id_produto DESC";
$result2 = $conexao->query($sqlcarrinho);


//print_r($_SESSION['id_usuarios']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sistema.css">
    <title>Sistema</title>
</head>
<header class="header">
    <section class="cabecalho">
        <nav class="nav">

            <a href="#sobre">Sobre</a>
            <a href="#menu">Menu</a>
            <a href="#endereço">Endereço</a>

        </nav>

        <div class="perfil">

            <a class="carrinho" href="carrinho.php"><img
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA60lEQVR4nO3WsQpBURjA8VsmKwNG5Q1MJoOFlFmKJ7BY5QHkJZTJG9ydYrPZhZXBoAh/XX1ic45z7pH4z1/n11nOdzzvJwPGPFoA1U/AQScg4wS/BwxuNHQ8lwEVgaeu4SiwB85AwjXuy60bruEm4TR6BadDglcqt56HAPdV4F4IcE0FzltGL0BSBY4AG4vw7CX6hA8twl0duG4RLujAMVkYpu2DF1EZFnxiAfa1UIHbFuDWO3AK2BmgWyCuDQueC9YkcNQAD/LByL6F/m5AGVgHGwYomc4pJwfdW5rOfQVckkOXQNF07p/nqit4etkTHpfOQQAAAABJRU5ErkJggg=="
                    alt=""></a>

            <nav>
                <a href="config.php">Perfil</a>
                <a class="sair" href="sair.php">Sair</a>
            </nav>



        </div>
    </section>

    <div class="conteiner">

        <img class="fundo" src="../img/fundo_inicio.webp" alt="" width="100%">

        <section class="topo">
            <div class="controle">
                <h3 class="inicio">Com o melhor<span> Café</span> </h3>
                <p>Nossa paixão pelo café se reflete no nosso compromisso com a sustentabilidade e a inovação. <br>
                    Trabalhamos diretamente com
                    produtores e aplicamos técnicas avançadas para garantir <br> que cada bebida ofereça uma experiência
                    única, fresca e
                    envolvente a cada gole.</p>

                <a href="#menu" class="btn">Pegue o Seu Agora</a>
            </div>
        </section>

</header>
<section class="sobre" id="sobre">
    <img src="../img/sobre_nos.jpg" alt="" width="300px">
    <div>
        <h2>Sobre <span>Nós</span></h2>
        <p>Nosso café se destaca pela sua qualidade excepcional, resultante do uso dos melhores grãos
            selecionados e torrados com
            precisão. Cada xícara é preparada com técnicas que preservam os aromas e sabores únicos,
            proporcionando uma experiência
            sensorial inigualável.

            Além disso, nossa paixão pela perfeição reflete-se em cada etapa do processo, desde a escolha dos
            fornecedores até o
            preparo final. O cuidado e a dedicação que colocamos em cada detalhe garantem que você saboreie um
            café verdadeiramente
            especial a cada gole</p>
    </div>
</section>






<!-- Cardápio -->
<div class="cardapio" id="menu">
    <table>
        <thead>
            <tr>
                <th>Nosso <span>Cardapio</span> </th>

            </tr>
        </thead>
        <tbody>
            <div class="card">
                <?php
                while ($produtos = mysqli_fetch_assoc($result2)) {
                    echo "<tr>";
                    //echo "<td>" . $produtos['id_produto'] . "</td>";
                    echo "<td><img src='" . $produtos['imagem'] . "' style='width: 100px; height: 100px;'></td>";
                    echo "<td>" . $produtos['nome'] . "</td>";
                    echo "<td>" . $produtos['preco'] . "</td>";

                    echo "<td><button class='btn' id='btn' type='button' onclick='adicionarCarrinho(" . $produtos['id_produto'] . ");'>Adicionar ao Carrinho</button></td>";
                }
                ?>
            </div>
        </tbody>
    </table>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function adicionarCarrinho(id) {
        // Cria um objeto XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "compras.php", true);

        // Defina o que fazer quando a requisição for completada
        xhr.onload = function () {
            if (xhr.status == 200) {
                // Se a requisição for bem-sucedida, exibe a resposta
                console.log(xhr.responseText); // Exibe no console
                alert(xhr.responseText); // Exibe no alerta
            } else {
                console.error("Erro na requisição: " + xhr.status);
                alert("Erro ao adicionar ao carrinho. Tente novamente.");
            }
        };

        // Envia os dados diretamente no formato URL encoded
        var params = "id_produto=" + id;
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(params); // Envia os dados ao PHP
    }
</script>

<section class="endereco" id="endereço">

    <h2 class="titulo"><span>nosso</span> endereço</h2>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6906.526314019232!2d-51.17736833135992!3d-30.057990433840196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x951977fdbd3749f5%3A0xec574d4a9ef7d81d!2sCanal%20Caf%C3%A9!5e0!3m2!1spt-BR!2sbr!4v1726181681871!5m2!1spt-BR!2sbr"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>

</section>



</body>

</html>