-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Maio-2021 às 01:51
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `waffle`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista`
--

CREATE TABLE `lista` (
  `idLista` int(11) NOT NULL,
  `nomeLista` varchar(25) NOT NULL,
  `idPasta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `lista`
--

INSERT INTO `lista` (`idLista`, `nomeLista`, `idPasta`) VALUES
(1, 'ListaTarefas', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pasta`
--

CREATE TABLE `pasta` (
  `idPasta` int(11) NOT NULL,
  `nomePasta` varchar(25) NOT NULL,
  `pertenceATime` tinyint(4) DEFAULT NULL,
  `time_nome` varchar(25) DEFAULT NULL,
  `user_apelido` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pasta`
--

INSERT INTO `pasta` (`idPasta`, `nomePasta`, `pertenceATime`, `time_nome`, `user_apelido`) VALUES
(4, 'pasta1', NULL, NULL, 'gusta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefa`
--

CREATE TABLE `tarefa` (
  `idTarefa` int(11) NOT NULL,
  `nomeTarefa` varchar(25) NOT NULL,
  `descricao` text DEFAULT NULL,
  `prazo` datetime DEFAULT NULL,
  `lista_idLista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tarefa`
--

INSERT INTO `tarefa` (`idTarefa`, `nomeTarefa`, `descricao`, `prazo`, `lista_idLista`) VALUES
(0, 'Codar', 'fazer trabalho exp criativa', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `time`
--

CREATE TABLE `time` (
  `nome` varchar(25) NOT NULL,
  `criador` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `time`
--

INSERT INTO `time` (`nome`, `criador`) VALUES
('ScalingWaffle', 'gusta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `time_has_user`
--

CREATE TABLE `time_has_user` (
  `time_nome` varchar(25) NOT NULL,
  `user_apelido` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `apelido` varchar(10) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` char(64) NOT NULL,
  `tempo` time NOT NULL,
  `confirmado` tinyint(4) NOT NULL,
  `mail2FA` char(32) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`nome`, `sobrenome`, `email`, `apelido`, `telefone`, `senha`, `tempo`, `confirmado`) VALUES
('gustavo', 'schmidt', 'gustavooliveira092011@gmail.com', 'gusta', '47995652326', '251efc2d8aa4f7efab6ddba0d3197c966e848201298d73b56f32973bb923969e', '18:42:08', 0),
('gabriel', 'wasley', ' gawamos@gmail.com', 'hipocrita', '47991418888', '073d8b22e163d60116b04491ecc2b7d405185ae4908e39d699d146414d55a3d3', '18:47:39', 0),
('aleister', 'edward', 'aleisterlima@yahoo.com.br', 'shrimp', '47991840098', 'ee8649e13726e535aeba4ca78ff50e6df278d21cedcc8619c43b0fddf89469da', '18:17:56', 0),
('felipe', 'neto', 'felipe.a.d.noleto@gmail.com', 'splef', '47999954005', '17513c7722ecc129447bc2d38fc544ff030bd3c4908d3b8fc67a2ba4331c07af', '18:25:07', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`idLista`),
  ADD KEY `idPasta` (`idPasta`);

--
-- Índices para tabela `pasta`
--
ALTER TABLE `pasta`
  ADD PRIMARY KEY (`idPasta`),
  ADD KEY `time_nome` (`time_nome`),
  ADD KEY `user_apelido` (`user_apelido`);

--
-- Índices para tabela `tarefa`
--
ALTER TABLE `tarefa`
  ADD PRIMARY KEY (`idTarefa`),
  ADD KEY `lista_idLista` (`lista_idLista`);

--
-- Índices para tabela `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`nome`);

--
-- Índices para tabela `time_has_user`
--
ALTER TABLE `time_has_user`
  ADD PRIMARY KEY (`time_nome`,`user_apelido`),
  ADD KEY `user_apelido` (`user_apelido`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`apelido`),
  ADD UNIQUE KEY `apelido_UNIQUE` (`apelido`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `telefone_UNIQUE` (`telefone`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista`
--
ALTER TABLE `lista`
  MODIFY `idLista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pasta`
--
ALTER TABLE `pasta`
  MODIFY `idPasta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `lista`
--
ALTER TABLE `lista`
  ADD CONSTRAINT `lista_ibfk_1` FOREIGN KEY (`idPasta`) REFERENCES `pasta` (`idPasta`);

--
-- Limitadores para a tabela `pasta`
--
ALTER TABLE `pasta`
  ADD CONSTRAINT `pasta_ibfk_1` FOREIGN KEY (`time_nome`) REFERENCES `time` (`nome`),
  ADD CONSTRAINT `pasta_ibfk_2` FOREIGN KEY (`user_apelido`) REFERENCES `user` (`apelido`);

--
-- Limitadores para a tabela `tarefa`
--
ALTER TABLE `tarefa`
  ADD CONSTRAINT `tarefa_ibfk_1` FOREIGN KEY (`lista_idLista`) REFERENCES `lista` (`idLista`);

--
-- Limitadores para a tabela `time_has_user`
--
ALTER TABLE `time_has_user`
  ADD CONSTRAINT `time_has_user_ibfk_1` FOREIGN KEY (`time_nome`) REFERENCES `time` (`nome`),
  ADD CONSTRAINT `time_has_user_ibfk_2` FOREIGN KEY (`user_apelido`) REFERENCES `user` (`apelido`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
