-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 25-Jul-2022 às 07:10
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `restaurante_bd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cpf` varchar(15) CHARACTER SET utf8 NOT NULL,
  `telefone` varchar(13) CHARACTER SET utf8 NOT NULL,
  `endereco` varchar(200) CHARACTER SET utf8 NOT NULL,
  `dataRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `dataAlteracao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `situacao` enum('habilitado','desabilitado') CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `cpf`, `telefone`, `endereco`, `dataRegistro`, `dataAlteracao`, `situacao`) VALUES
(1, 'cliente teste', '99999999999', '(32)999999999', 'Rua teste da teste, bairro teste, testeUF', '2022-07-25 03:00:04', '2022-07-25 09:07:08', 'habilitado'),
(2, 'teste', '000000', '9999', 'teste', '2022-07-25 03:20:25', '2022-07-25 09:28:32', 'habilitado'),
(3, 'testeAlterando', '222222', '77777', 'Teste addres novo', '2022-07-25 03:21:58', '2022-07-25 09:03:34', 'habilitado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

CREATE TABLE `item_pedido` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `precoUnidade` decimal(6,2) NOT NULL,
  `observacao` varchar(200) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `momento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item_pedido`
--

INSERT INTO `item_pedido` (`id`, `nome`, `quantidade`, `precoUnidade`, `observacao`, `id_usuario`, `momento`) VALUES
(1, 'X Tudo', 1, '10.00', 'Sem cebola', 1, '2022-07-09 03:27:40'),
(2, 'X Tudo', 1, '10.00', 'Sem cebola', NULL, '2022-07-09 03:29:01'),
(3, 'Pizza F', 1, '19.99', 'Completa', NULL, '2022-07-09 03:34:50'),
(4, 'Pizza F', 1, '19.99', 'Completa', NULL, '2022-07-09 03:43:07'),
(5, 'Pizza M', 1, '15.99', 'Completa', NULL, '2022-07-09 03:44:39'),
(6, 'Pizza P', 1, '10.99', 'Sem azeitonas', NULL, '2022-07-09 03:45:37'),
(7, 'X Tudo', 1, '15.00', 'Bife extra', NULL, '2022-07-09 03:46:15'),
(8, 'Porção de batata', 1, '8.99', 'Completa', NULL, '2022-07-09 03:55:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `valor` decimal(6,2) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `info_adicional` varchar(200) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `situacao` enum('habilitado','desabilitado') NOT NULL,
  `momento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `categoria`, `valor`, `foto`, `info_adicional`, `id_usuario`, `situacao`, `momento`) VALUES
(1, 'Pizza Familia', 'Pizzas', '45.00', '', 'Pizza com 8 fatias', 1, 'habilitado', '2022-07-24 20:30:37'),
(2, 'X-Tudo', 'Lanches', '15.00', '', 'Hambúrguer completo', 1, 'habilitado', '2022-07-10 17:45:55'),
(3, 'Hot dog Americano', 'Lanches', '5.00', '', 'Hot dog simples', 1, 'habilitado', '2022-07-10 17:47:35'),
(4, 'Coca-Cola 3L', 'Bebidas', '15.00', '', 'Refrigerante Coca-Cola 3L', 1, 'habilitado', '2022-07-10 21:02:56'),
(5, 'Batata frita M', 'Lanches', '8.00', '', 'Batata Frita tamanho médio', 1, 'habilitado', '2022-07-10 23:21:37'),
(6, 'Cachorrão de frango', 'Lanches', '12.00', '', 'Cachorrão de frango completo', 1, 'habilitado', '2022-07-10 23:25:05'),
(7, 'Batata frita com bacon', 'Refeição', '25.00', '', 'Porção de batata com bacon frito', 1, 'habilitado', '2022-07-11 01:25:53'),
(8, 'Coca-Cola 600ml', 'Bebidas', '6.00', '', 'Coquinha gelada', 1, 'habilitado', '2022-07-11 01:29:38'),
(9, 'Batata frita P', 'Porção', '5.99', '', '', 1, 'habilitado', '2022-07-11 02:12:35'),
(10, 'teste2', 'teste', '0.99', '', 'Teste', 1, 'habilitado', '2022-07-11 02:06:36'),
(11, 'Teste3', 'teste', '1.99', '', 'Teste', 1, 'habilitado', '2022-07-11 02:07:55'),
(12, 'teste4', 'teste', '1.50', '', 'Teste', 1, 'habilitado', '2022-07-11 02:09:54'),
(13, 'teste4', 'teste', '1.50', '', 'Teste', 1, 'habilitado', '2022-07-11 02:10:47'),
(14, 'Teste', 'Teste', '1.00', '', 'Teste', 1, 'habilitado', '2022-07-11 02:10:55'),
(15, 'teste6', 'teste', '0.01', '', 'teste', 1, 'habilitado', '2022-07-11 02:14:28'),
(16, 'teste7', 'teste', '15.99', '', 'Teste', 1, 'habilitado', '2022-07-11 02:18:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `dataRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `dataAlteracao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `situacao` enum('habilitado','desabilitado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `dataRegistro`, `dataAlteracao`, `situacao`) VALUES
(1, 'Vitor Assis', 'vassis@gti.com', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-07-25 02:10:37', '2022-07-25 07:05:11', 'habilitado'),
(2, 'Leonardo Rodrigues', 'lenx@gti.com', '202cb962ac59075b964b07152d234b70', '2022-07-25 02:05:17', '2022-07-25 07:05:17', 'desabilitado'),
(3, 'Igor Nery Teste', 'ig.nery@gti.com', '202cb962ac59075b964b07152d234b70', '2022-07-25 02:05:25', '2022-07-25 07:05:25', 'habilitado'),
(4, 'Tássio Gama', 'tassiog@gti.com', '202cb962ac59075b964b07152d234b70', '2022-07-25 02:05:30', '2022-07-25 07:05:30', 'habilitado');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices para tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
