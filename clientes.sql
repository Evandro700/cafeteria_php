-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/11/2024 às 16:11
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clientes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `id_usuarios`) VALUES
(1, 90),
(2, 91);

-- --------------------------------------------------------

--
-- Estrutura para tabela `meu_carrinho`
--

CREATE TABLE `meu_carrinho` (
  `id` int(11) NOT NULL,
  `id_carrinho` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `meu_carrinho`
--

INSERT INTO `meu_carrinho` (`id`, `id_carrinho`, `id_produto`, `quantidade`) VALUES
(34, 1, 5, 1),
(35, 1, 3, 1),
(36, 1, 4, 1),
(37, 1, 6, 1),
(38, 1, 7, 1),
(39, 1, 8, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome`, `preco`, `imagem`) VALUES
(3, 'cappuccino', 14.99, 'https://static.vecteezy.com/system/resources/previews/023/522/886/non_2x/cappuccino-coffee-cup-cutout-free-png.png'),
(4, 'cafe coado', 12.99, 'https://static.vecteezy.com/system/resources/previews/049/376/953/non_2x/cup-of-coffee-with-creamy-frothy-top-and-coffee-beans-free-png.png'),
(5, 'cafe flat white', 15.99, 'https://static.vecteezy.com/system/resources/previews/046/484/306/non_2x/coffee-or-tea-cup-ai-generative-free-png.png'),
(6, 'Cup of Coffee', 11.99, 'https://static.vecteezy.com/system/resources/previews/047/312/089/non_2x/a-cup-of-coffee-free-png.png'),
(7, 'cafe mocha', 9.99, 'https://static.vecteezy.com/system/resources/previews/041/924/426/non_2x/ai-generated-latte-in-coffee-cup-isolated-on-transparent-background-free-png.png'),
(8, 'cafe gelado', 10.99, 'https://static.vecteezy.com/system/resources/previews/046/456/524/non_2x/coffee-drink-isolated-on-transparent-background-free-png.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(255) NOT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `sobrenome` varchar(50) DEFAULT NULL,
  `email` varchar(110) DEFAULT NULL,
  `telefone` int(20) NOT NULL,
  `senha` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nome`, `sobrenome`, `email`, `telefone`, `senha`) VALUES
(90, 'evando', 'teste', 'txt@gmail.com', 212121, '123'),
(91, 'joao', 'silva', 'joao@gmail.com', 519999999, '252525');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `meu_carrinho`
--
ALTER TABLE `meu_carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `meu_carrinho`
--
ALTER TABLE `meu_carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
