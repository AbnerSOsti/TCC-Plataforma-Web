-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela devplace.aulas
CREATE TABLE IF NOT EXISTS `aulas` (
  `id_aula` int NOT NULL AUTO_INCREMENT,
  `id_modulo` int DEFAULT NULL,
  `titulo_aula` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conteudo_aula` text COLLATE utf8mb4_unicode_ci,
  `ordem_aula` int DEFAULT NULL,
  PRIMARY KEY (`id_aula`),
  KEY `id_modulo` (`id_modulo`),
  CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela devplace.cadastro_usuario
CREATE TABLE IF NOT EXISTS `cadastro_usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_usuario` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `senha_usuario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_usuario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datacadastro_usuario` date DEFAULT NULL,
  `token_recuperacao` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expira` date DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email_usuario` (`email_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela devplace.exercicios
CREATE TABLE IF NOT EXISTS `exercicios` (
  `id_exercicio` int NOT NULL AUTO_INCREMENT,
  `id_aula` int DEFAULT NULL,
  `tipo_exercicio` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pergunta` text COLLATE utf8mb4_unicode_ci,
  `feedback_erro` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_exercicio`),
  KEY `id_aula` (`id_aula`),
  CONSTRAINT `exercicios_ibfk_1` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id_aula`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela devplace.exercicio_blocos
CREATE TABLE IF NOT EXISTS `exercicio_blocos` (
  `id_bloco` int NOT NULL AUTO_INCREMENT,
  `id_exercicio` int DEFAULT NULL,
  `texto_bloco` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordem_correta` int DEFAULT NULL,
  PRIMARY KEY (`id_bloco`),
  KEY `id_exercicio` (`id_exercicio`),
  CONSTRAINT `exercicio_blocos_ibfk_1` FOREIGN KEY (`id_exercicio`) REFERENCES `exercicios` (`id_exercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela devplace.exercicio_completar
CREATE TABLE IF NOT EXISTS `exercicio_completar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_exercicio` int DEFAULT NULL,
  `resposta_correta` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_exercicio` (`id_exercicio`),
  CONSTRAINT `exercicio_completar_ibfk_1` FOREIGN KEY (`id_exercicio`) REFERENCES `exercicios` (`id_exercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela devplace.exercicio_opcoes
CREATE TABLE IF NOT EXISTS `exercicio_opcoes` (
  `id_opcao` int NOT NULL AUTO_INCREMENT,
  `id_exercicio` int DEFAULT NULL,
  `texto_opcao` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correta` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_opcao`),
  KEY `id_exercicio` (`id_exercicio`),
  CONSTRAINT `exercicio_opcoes_ibfk_1` FOREIGN KEY (`id_exercicio`) REFERENCES `exercicios` (`id_exercicio`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela devplace.linguagens
CREATE TABLE IF NOT EXISTS `linguagens` (
  `id_linguagem` int NOT NULL AUTO_INCREMENT,
  `nome_linguagem` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `nivel` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_linguagem`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela devplace.modulos
CREATE TABLE IF NOT EXISTS `modulos` (
  `id_modulo` int NOT NULL AUTO_INCREMENT,
  `titulo_modulo` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao_modulo` text COLLATE utf8mb4_unicode_ci,
  `ordem_modulo` int DEFAULT NULL,
  `id_linguagem` int DEFAULT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela devplace.progresso_aula
CREATE TABLE IF NOT EXISTS `progresso_aula` (
  `id_progresso_aula` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_aula` int NOT NULL,
  `status` enum('em_andamento','concluida') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'em_andamento',
  `data_inicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_conclusao` datetime DEFAULT NULL,
  `total_exercicios` int DEFAULT NULL,
  `exercicios_corretos` int DEFAULT NULL,
  PRIMARY KEY (`id_progresso_aula`),
  UNIQUE KEY `usuario_aula` (`id_usuario`,`id_aula`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_aula` (`id_aula`),
  CONSTRAINT `progresso_aula_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `cadastro_usuario` (`id_usuario`),
  CONSTRAINT `progresso_aula_ibfk_2` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id_aula`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela devplace.usuario_configuracao
CREATE TABLE IF NOT EXISTS `usuario_configuracao` (
  `id_usuario` int NOT NULL,
  `id_linguagem_atual` int DEFAULT NULL,
  `id_modulo_atual` int DEFAULT NULL,
  `id_aula_atual` int DEFAULT NULL,
  `ultimo_acesso` datetime DEFAULT CURRENT_TIMESTAMP,
  `ultimo_login` datetime DEFAULT CURRENT_TIMESTAMP,
  `ultima_linguagem_acessada` int DEFAULT NULL,
  `tema` enum('claro','escuro') DEFAULT 'claro',
  PRIMARY KEY (`id_usuario`),
  KEY `fk_config_linguagem` (`id_linguagem_atual`),
  KEY `fk_config_modulo` (`id_modulo_atual`),
  KEY `fk_config_aula` (`id_aula_atual`),
  CONSTRAINT `fk_config_aula` FOREIGN KEY (`id_aula_atual`) REFERENCES `aulas` (`id_aula`),
  CONSTRAINT `fk_config_linguagem` FOREIGN KEY (`id_linguagem_atual`) REFERENCES `linguagens` (`id_linguagem`),
  CONSTRAINT `fk_config_modulo` FOREIGN KEY (`id_modulo_atual`) REFERENCES `modulos` (`id_modulo`),
  CONSTRAINT `fk_config_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `cadastro_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela devplace.usuario_linguagem
CREATE TABLE IF NOT EXISTS `usuario_linguagem` (
  `id_usuario` int NOT NULL,
  `id_linguagem` int NOT NULL,
  `data_inscricao` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_ultimo_acesso` datetime DEFAULT CURRENT_TIMESTAMP,
  `favorito` tinyint(1) DEFAULT '0',
  `concluido` tinyint(1) DEFAULT '0',
  `ativo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_usuario`,`id_linguagem`),
  KEY `id_linguagem` (`id_linguagem`),
  CONSTRAINT `usuario_linguagem_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `cadastro_usuario` (`id_usuario`),
  CONSTRAINT `usuario_linguagem_ibfk_2` FOREIGN KEY (`id_linguagem`) REFERENCES `linguagens` (`id_linguagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
