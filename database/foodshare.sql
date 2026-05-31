-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2026 at 08:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nivel_acesso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doacoes`
--

CREATE TABLE `doacoes` (
  `id` int(11) NOT NULL,
  `doador_id` int(11) NOT NULL,
  `descricao` text DEFAULT NULL,
  `tipo_alimento` varchar(100) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `data_disponivel` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'disponivel',
  `endereco` varchar(255) DEFAULT NULL,
  `origem` varchar(100) DEFAULT NULL,
  `peso` varchar(50) DEFAULT NULL,
  `receptor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doacoes`
--

INSERT INTO `doacoes` (`id`, `doador_id`, `descricao`, `tipo_alimento`, `quantidade`, `data_disponivel`, `status`, `endereco`, `origem`, `peso`, `receptor_id`) VALUES
(2, 1, 'Pão - Doação de pãoes e frios', 'padaria', 10, '2026-05-30', 'solicitado', 'Av. das Nações, 450 - Praia Grande - SP', 'Darliel', '10', NULL),
(4, 1, 'Mix de vegetais - Um mix dde vegetais', 'vegetais', 30, '2026-05-31', 'concluido', 'Av. das Nações, 450 - Praia Grande - SP', 'Darliel', '30', 8),
(5, 1, 'Carnes - Doação de carnes para retirada imediata', 'padaria', 30, '2026-05-31', 'disponivel', 'Av. das Nações, 450 - Praia Grande - SP', 'Darliel Pereira', '30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doadores`
--

CREATE TABLE `doadores` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cpf_cnpj` varchar(20) NOT NULL,
  `tipo_doador` enum('pessoa_fisica','empresa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doadores`
--

INSERT INTO `doadores` (`id`, `usuario_id`, `cpf_cnpj`, `tipo_doador`) VALUES
(1, 3, '12345678910', 'pessoa_fisica'),
(2, 7, '12345678910454', 'empresa');

-- --------------------------------------------------------

--
-- Table structure for table `entregas`
--

CREATE TABLE `entregas` (
  `id` int(11) NOT NULL,
  `solicitacao_id` int(11) NOT NULL,
  `data_entrega` date DEFAULT NULL,
  `comprovante` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instituicoes`
--

CREATE TABLE `instituicoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `nome_responsavel` varchar(100) DEFAULT NULL,
  `area_atuacao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instituicoes`
--

INSERT INTO `instituicoes` (`id`, `usuario_id`, `cnpj`, `nome_responsavel`, `area_atuacao`) VALUES
(2, 8, '34789327408237', NULL, 'Assistência Social');

-- --------------------------------------------------------

--
-- Table structure for table `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `lida` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `solicitacoes`
--

CREATE TABLE `solicitacoes` (
  `id` int(11) NOT NULL,
  `instituicao_id` int(11) NOT NULL,
  `data_solicitacao` date DEFAULT curdate(),
  `status` enum('pendente','aprovado','recusado') DEFAULT 'pendente',
  `cpf_beneficiario` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('doador','instituicao','admin') DEFAULT 'doador',
  `endereco` varchar(150) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `endereco`, `telefone`, `criado_em`) VALUES
(3, 'Darliel Pereira', 'darliel@email.com', '$2y$10$ukWG48cK5hKdk/gIzZ7QZ.j0ZJ8KJirthi2DgorxZaws2Fz5blpkC', 'doador', 'Xique Xique Bahia', '(13) 3333-4444', '2026-05-31 00:26:21'),
(7, 'darliel administrador', 'darliel@foodshare.com', '$2y$10$I/ILgF/CzdvizttbyISQPOAHRGy4tepJAnn5ihX9oevz3A7GWpG8C', 'admin', 'Xique Xique Bahia', '(13) 3333-4444', '2026-05-31 01:32:27'),
(8, 'Ong Receptora', 'receptor@ong.com', '$2y$10$uSYgFiWJN14F9QycS76unOAXms3JH7rhsHUx4pRbHD2trOSSOAsL6', 'instituicao', NULL, NULL, '2026-05-31 15:50:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `doacoes`
--
ALTER TABLE `doacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doador_id` (`doador_id`);

--
-- Indexes for table `doadores`
--
ALTER TABLE `doadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_cnpj` (`cpf_cnpj`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `idx_cpf` (`cpf_cnpj`);

--
-- Indexes for table `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitacao_id` (`solicitacao_id`);

--
-- Indexes for table `instituicoes`
--
ALTER TABLE `instituicoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `idx_cnpj` (`cnpj`);

--
-- Indexes for table `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instituicao_id` (`instituicao_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doacoes`
--
ALTER TABLE `doacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doadores`
--
ALTER TABLE `doadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instituicoes`
--
ALTER TABLE `instituicoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doacoes`
--
ALTER TABLE `doacoes`
  ADD CONSTRAINT `doacoes_ibfk_1` FOREIGN KEY (`doador_id`) REFERENCES `doadores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doadores`
--
ALTER TABLE `doadores`
  ADD CONSTRAINT `doadores_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_ibfk_1` FOREIGN KEY (`solicitacao_id`) REFERENCES `solicitacoes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `instituicoes`
--
ALTER TABLE `instituicoes`
  ADD CONSTRAINT `instituicoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD CONSTRAINT `solicitacoes_ibfk_1` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicoes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
