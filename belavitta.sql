-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 11/09/2024 às 15:08
-- Versão do servidor: 10.11.2-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `belavitta`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administradores`
--

CREATE TABLE `administradores` (
  `cpf` int(12) NOT NULL,
  `email` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `codagenda` int(11) NOT NULL,
  `hora` time DEFAULT NULL,
  `data` date DEFAULT NULL,
  `cpf` int(11) DEFAULT NULL,
  `codservico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `cpf` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `cidade` varchar(90) DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `datan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`cpf`, `nome`, `email`, `cidade`, `telefone`, `datan`) VALUES
(12, 'fernandop', 'fer45@gmail', 'sp', 12345, '2024-09-23'),
(586, '257572', 'asjdask@gmail.com', 'cascavelll', 468, '5050-05-05'),
(1234, 'jonivaldo', 'jonivaldo@gmail.com', 'cascavel', 123, '2024-09-03'),
(3333, 'menon', 'menon@gmail.com', 'cascavel', 3333, '2024-08-13'),
(5257, 'annny', 'marianaramos@gmail.com', 'cascavel', 778678, '7207-05-02'),
(12342, 'jonivaldor', 'jonivaldo@gmail.com', 'cascavel', 123, '2024-09-03'),
(12345, 'ggggg', 'ggggg@gggg.com', 'hhhhh', 121212, '0002-02-02'),
(41211, 'klnblkbkjl', 'njnmlmk.lkl.', 'jnl,njln.', 455645645, '2024-07-15'),
(45566, 'jonivaldo', 'jonivaldo@gmail', 'cascavel', 123, '2024-09-23'),
(1234223, 'paulo', 'paulo@gmail.com', 'cascavel', 123, '2024-09-03'),
(1234567, 'mariana', 'mariana@', 'cascav', 12345678, '2024-07-22'),
(12342234, 'paulo3', 'paulo4@gmail.com', 'cascavel', 123, '2024-09-03'),
(12345342, 'katelin', 'katelin@gmail', 'bh', 1097676, '2024-09-05'),
(12345678, 'mariana ramos de souza', 'mariana.rs1@outlook.com', 'cascavel', 123456789, '2024-07-29'),
(12563423, 'fernandop23', 'fer453@gmail', 'sp', 12345, '2024-09-23'),
(1123122532, 'anny caroline machado', 'marianaramos@gmail.com', 'cascavel', 5851, '2006-03-31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `horarios`
--

CREATE TABLE `horarios` (
  `codhorario` int(11) NOT NULL,
  `horariomanha` time DEFAULT NULL,
  `horariotarde` time DEFAULT NULL,
  `diasemana` date DEFAULT NULL,
  `codprofissional` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissionais`
--

CREATE TABLE `profissionais` (
  `codprofissional` int(9) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `imagem` blob DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `codservico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `codservico` int(9) NOT NULL,
  `horario` time DEFAULT NULL,
  `valor` int(50) DEFAULT NULL,
  `imagem` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`cpf`);

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`codagenda`),
  ADD KEY `cpf` (`cpf`),
  ADD KEY `codservico` (`codservico`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cpf`);

--
-- Índices de tabela `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`codhorario`),
  ADD KEY `codprofissional` (`codprofissional`);

--
-- Índices de tabela `profissionais`
--
ALTER TABLE `profissionais`
  ADD PRIMARY KEY (`codprofissional`),
  ADD KEY `codservico` (`codservico`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`codservico`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `codagenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `horarios`
--
ALTER TABLE `horarios`
  MODIFY `codhorario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `profissionais`
--
ALTER TABLE `profissionais`
  MODIFY `codprofissional` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `codservico` int(9) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`cpf`) REFERENCES `clientes` (`cpf`),
  ADD CONSTRAINT `agendamento_ibfk_2` FOREIGN KEY (`codservico`) REFERENCES `servicos` (`codservico`);

--
-- Restrições para tabelas `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`codprofissional`) REFERENCES `profissionais` (`codprofissional`);

--
-- Restrições para tabelas `profissionais`
--
ALTER TABLE `profissionais`
  ADD CONSTRAINT `profissionais_ibfk_1` FOREIGN KEY (`codservico`) REFERENCES `servicos` (`codservico`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
