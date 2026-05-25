-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/03/2026 às 23:55
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
-- Banco de dados: `codexia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aulas`
--

CREATE TABLE `aulas` (
  `id_aula` int(11) NOT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `titulo_aula` varchar(150) DEFAULT NULL,
  `conteudo_aula` text DEFAULT NULL,
  `ordem_aula` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_usuario`
--

CREATE TABLE `cadastro_usuario` (
  `id_usuario` int(15) NOT NULL,
  `nome_usuario` varchar(150) DEFAULT NULL,
  `email_usuario` varchar(250) DEFAULT NULL,
  `senha_usuario` varchar(255) DEFAULT NULL,
  `datacadastro_usuario` date DEFAULT NULL,
  `token_recuperacao` varchar(350) DEFAULT NULL,
  `token_expira` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `cadastro_usuario`
--

INSERT INTO `cadastro_usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `datacadastro_usuario`, `token_recuperacao`, `token_expira`) VALUES
(2, 'Abner Osti', '9123@fai.com.br', '$2y$10$4bWTOW16EwKaLJ9LRU1Nb.ZY5xrs4W0/AqZZxTj.Qvuk/6i2vFCDy', '2026-03-10', '3d1e9b7a2f49560937f8fce75e623112.1773251226', '2026-03-11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `exercicios`
--

CREATE TABLE `exercicios` (
  `id_exercicio` int(11) NOT NULL,
  `id_aula` int(11) DEFAULT NULL,
  `tipo_exercicio` varchar(50) DEFAULT NULL,
  `pergunta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `exercicio_blocos`
--

CREATE TABLE `exercicio_blocos` (
  `id_bloco` int(11) NOT NULL,
  `id_exercicio` int(11) DEFAULT NULL,
  `texto_bloco` varchar(200) DEFAULT NULL,
  `ordem_correta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `exercicio_completar`
--

CREATE TABLE `exercicio_completar` (
  `id` int(11) NOT NULL,
  `id_exercicio` int(11) DEFAULT NULL,
  `resposta_correta` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `exercicio_opcoes`
--

CREATE TABLE `exercicio_opcoes` (
  `id_opcao` int(11) NOT NULL,
  `id_exercicio` int(11) DEFAULT NULL,
  `texto_opcao` varchar(200) DEFAULT NULL,
  `correta` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL,
  `titulo_modulo` varchar(150) DEFAULT NULL,
  `descricao_modulo` text DEFAULT NULL,
  `ordem_modulo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `linguagens` (
  `id_linguagem` int(11) NOT NULL AUTO_INCREMENT,
  `nome_linguagem` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `nivel` varchar(50) DEFAULT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_linguagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `titulo_modulo`, `descricao_modulo`, `ordem_modulo`) VALUES
(1, 'teste', 'teste', 1),
(2, 'teste2', 'teste', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `progresso_aula`
--

CREATE TABLE `progresso_aula` (
  `id_progresso_aula` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `status` enum('em_andamento','concluida') NOT NULL DEFAULT 'em_andamento',
  `data_inicio` datetime NOT NULL DEFAULT current_timestamp(),
  `data_conclusao` datetime DEFAULT NULL,
  `total_exercicios` int(11) DEFAULT NULL,
  `exercicios_corretos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id_aula`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Índices de tabela `cadastro_usuario`
--
ALTER TABLE `cadastro_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email_usuario` (`email_usuario`);

--
-- Índices de tabela `exercicios`
--
ALTER TABLE `exercicios`
  ADD PRIMARY KEY (`id_exercicio`),
  ADD KEY `id_aula` (`id_aula`);

--
-- Índices de tabela `exercicio_blocos`
--
ALTER TABLE `exercicio_blocos`
  ADD PRIMARY KEY (`id_bloco`),
  ADD KEY `id_exercicio` (`id_exercicio`);

--
-- Índices de tabela `exercicio_completar`
--
ALTER TABLE `exercicio_completar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_exercicio` (`id_exercicio`);

--
-- Índices de tabela `exercicio_opcoes`
--
ALTER TABLE `exercicio_opcoes`
  ADD PRIMARY KEY (`id_opcao`),
  ADD KEY `id_exercicio` (`id_exercicio`);

--
-- Índices de tabela `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Índices de tabela `progresso_aula`
--
ALTER TABLE `progresso_aula`
  ADD PRIMARY KEY (`id_progresso_aula`),
  ADD UNIQUE KEY `usuario_aula` (`id_usuario`, `id_aula`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_aula` (`id_aula`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id_aula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cadastro_usuario`
--
ALTER TABLE `cadastro_usuario`
  MODIFY `id_usuario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `exercicios`
--
ALTER TABLE `exercicios`
  MODIFY `id_exercicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `exercicio_blocos`
--
ALTER TABLE `exercicio_blocos`
  MODIFY `id_bloco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `exercicio_completar`
--
ALTER TABLE `exercicio_completar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `exercicio_opcoes`
--
ALTER TABLE `exercicio_opcoes`
  MODIFY `id_opcao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `progresso_aula`
--
ALTER TABLE `progresso_aula`
  MODIFY `id_progresso_aula` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id_modulo`);

--
-- Restrições para tabelas `exercicios`
--
ALTER TABLE `exercicios`
  ADD CONSTRAINT `exercicios_ibfk_1` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id_aula`);

--
-- Restrições para tabelas `exercicio_blocos`
--
ALTER TABLE `exercicio_blocos`
  ADD CONSTRAINT `exercicio_blocos_ibfk_1` FOREIGN KEY (`id_exercicio`) REFERENCES `exercicios` (`id_exercicio`);

--
-- Restrições para tabelas `exercicio_completar`
--
ALTER TABLE `exercicio_completar`
  ADD CONSTRAINT `exercicio_completar_ibfk_1` FOREIGN KEY (`id_exercicio`) REFERENCES `exercicios` (`id_exercicio`);

--
-- Restrições para tabelas `exercicio_opcoes`
--
ALTER TABLE `exercicio_opcoes`
  ADD CONSTRAINT `exercicio_opcoes_ibfk_1` FOREIGN KEY (`id_exercicio`) REFERENCES `exercicios` (`id_exercicio`);

--
-- Restrições para tabelas `progresso_aula`
--
ALTER TABLE `progresso_aula`
  ADD CONSTRAINT `progresso_aula_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `cadastro_usuario` (`id_usuario`),
  ADD CONSTRAINT `progresso_aula_ibfk_2` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id_aula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
