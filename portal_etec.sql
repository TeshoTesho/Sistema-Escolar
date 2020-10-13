-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01-Out-2020 às 22:38
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `portal_etec`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_avisos`
--

DROP TABLE IF EXISTS `tb_avisos`;
CREATE TABLE IF NOT EXISTS `tb_avisos` (
  `cd_aviso` int(11) NOT NULL AUTO_INCREMENT,
  `nm_titulo` varchar(50) DEFAULT NULL,
  `ds_descricao` varchar(500) DEFAULT NULL,
  `dt_data` date DEFAULT NULL,
  `cd_rm_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_aviso`),
  KEY `fk_cd_rm_user_aviso` (`cd_rm_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_curso`
--

DROP TABLE IF EXISTS `tb_curso`;
CREATE TABLE IF NOT EXISTS `tb_curso` (
  `cd_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nm_curso` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cd_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_curso`
--

INSERT INTO `tb_curso` (`cd_curso`, `nm_curso`) VALUES
(1, 'Contabilidade'),
(2, 'Farmácia'),
(3, 'Informática'),
(4, 'Logística'),
(5, 'Logística - ETIM'),
(6, 'Química - ETIM'),
(7, 'Transações Imobiliárias ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_documento`
--

DROP TABLE IF EXISTS `tb_documento`;
CREATE TABLE IF NOT EXISTS `tb_documento` (
  `cd_documento` int(11) NOT NULL AUTO_INCREMENT,
  `nm_documento` varchar(45) DEFAULT NULL,
  `ds_documento` varchar(600) NOT NULL,
  `cd_tipo_documento` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_documento`),
  KEY `fk_cd_tipo_documento` (`cd_tipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_documento`
--

INSERT INTO `tb_documento` (`cd_documento`, `nm_documento`, `ds_documento`, `cd_tipo_documento`) VALUES
(1, 'Declaração para Estágio', 'Documento base para entregar à empresa onde pretende estagiar', 1),
(2, 'Declaração de Frequência Escolar', 'Documento contendo a frequência escolar do aluno', 1),
(3, 'Declaração de Matrícula', 'Documento contendo a frequência escolar do aluno', 1),
(4, 'Declaração para Trabalho', 'Documento atestando que estuda na escola, curso e horário em que está matriculado, afim de entregar em local de trabalho', 1),
(5, 'Declaração para Passe Intermunicipação \"EMTU\"', 'Declaração a ser entregue na empresa responsável para obtenção de passe para ônibus intermunicipais.', 1),
(6, 'Histórico de Transferência', 'Documento com histórico escolar para efetuar transferência de escolas', 2),
(7, 'Histórico Escolar', 'Documento com histórico escolar completo', 2),
(8, 'Certificado de Módulo', 'Certificado emitido após conclusão de módulos', 4),
(9, 'Diploma (após a publicação no GDAE)', 'Requerimento de diploma após conclusão do curso e publicação no GDAE	', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_periodo`
--

DROP TABLE IF EXISTS `tb_periodo`;
CREATE TABLE IF NOT EXISTS `tb_periodo` (
  `cd_periodo` int(11) NOT NULL AUTO_INCREMENT,
  `nm_periodo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cd_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_periodo`
--

INSERT INTO `tb_periodo` (`cd_periodo`, `nm_periodo`) VALUES
(1, 'Matutino'),
(2, 'Integral'),
(3, 'Noturno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_solicitacao`
--

DROP TABLE IF EXISTS `tb_solicitacao`;
CREATE TABLE IF NOT EXISTS `tb_solicitacao` (
  `cd_solicitacao` int(11) NOT NULL AUTO_INCREMENT,
  `ds_solicitacao` varchar(45) DEFAULT NULL,
  `ic_deferido` tinyint(4) DEFAULT NULL,
  `cd_rm_user` int(11) DEFAULT NULL,
  `cd_documento` int(11) DEFAULT NULL,
  `dt_solicitacao` date DEFAULT NULL,
  `ds_obs_secretaria` varchar(500) NOT NULL,
  PRIMARY KEY (`cd_solicitacao`),
  KEY `fk_cd_documento` (`cd_documento`),
  KEY `fk_cd_rm_user_solicitacao` (`cd_rm_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_turma`
--

DROP TABLE IF EXISTS `tb_turma`;
CREATE TABLE IF NOT EXISTS `tb_turma` (
  `cd_turma` int(11) NOT NULL AUTO_INCREMENT,
  `sg_curso` varchar(5) NOT NULL,
  `nm_turma` varchar(45) DEFAULT NULL,
  `cd_periodo` int(11) DEFAULT NULL,
  `cd_curso` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_turma`),
  KEY `fk_cd_curso` (`cd_curso`),
  KEY `fk_cd_periodo` (`cd_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_turma`
--

INSERT INTO `tb_turma` (`cd_turma`, `sg_curso`, `nm_turma`, `cd_periodo`, `cd_curso`) VALUES
(0, 'CT', '1CT1', 1, 1),
(1, 'CT', '2CT1', 1, 1),
(2, 'CT', '3CT1', 1, 1),
(3, 'CT', '1CT3', 3, 1),
(4, 'CT', '2CT3', 3, 1),
(5, 'CT', '3CT3', 3, 1),
(6, 'FR', '1FR1', 1, 2),
(7, 'FR', '2FR1', 1, 2),
(8, 'FR', '3FR1', 1, 2),
(9, 'FR', '1FR3', 3, 2),
(10, 'FR', '2FR3', 3, 2),
(11, 'FR', '3FR3', 3, 2),
(12, 'IF', '1IF1', 1, 3),
(13, 'IF', '2IF1', 1, 3),
(14, 'IF', '3IF1', 1, 3),
(15, 'IF', '1IF3', 3, 3),
(16, 'IF', '2IF3', 3, 3),
(17, 'IF', '3IF3', 3, 3),
(18, 'LG', '1LG1', 1, 4),
(19, 'LG', '2LG1', 1, 4),
(20, 'LG', '3LG1', 1, 4),
(21, 'LG', '1LG3', 3, 4),
(22, 'LG', '2LG3', 3, 4),
(23, 'LG', '3LG3', 3, 4),
(24, 'LGEM', '1LGEM', 2, 5),
(25, 'LGEM', '2LGEM', 2, 5),
(26, 'LGEM', '3LGEM', 2, 5),
(27, 'QUEM', '1QUEM', 2, 6),
(28, 'QUEM', '2QUEM', 2, 6),
(29, 'QUEM', '3QUEM', 2, 6),
(30, 'TI', '1TI1', 1, 7),
(31, 'TI', '2TI1', 1, 7),
(32, 'TI', '3TI1', 1, 7),
(33, 'TI', '1TI3', 3, 7),
(34, 'TI', '2TI3', 3, 7),
(35, 'TI', '3TI3', 3, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `cd_rm_user` int(11) NOT NULL,
  `cd_rm_user_cp` varchar(500) NOT NULL,
  `nm_user` varchar(50) DEFAULT NULL,
  `ic_user` tinyint(1) DEFAULT NULL,
  `cd_password_user` varchar(45) DEFAULT NULL,
  `cd_rg` bigint(20) NOT NULL,
  `cd_cpf` bigint(20) NOT NULL,
  `dt_nascimento` date DEFAULT NULL,
  `ds_email` varchar(500) DEFAULT NULL,
  `cd_telefone` bigint(20) DEFAULT NULL,
  `ds_endereco` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`cd_rm_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`cd_rm_user`, `cd_rm_user_cp`, `nm_user`, `ic_user`, `cd_password_user`, `cd_rg`, `cd_cpf`, `dt_nascimento`, `ds_email`, `cd_telefone`, `ds_endereco`) VALUES
(123456, '49-50-51-52-53-54-', 'Secretaria', 1, '202cb962ac59075b964b07152d234b70', 0, 0, '2017-10-26', 'secretaria@etec.com', 1334913153, 'Avenida Guadalajara, nº 941 - Guilhermina - Praia Grande/SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `cd_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `nm_tipo_documento` varchar(45) DEFAULT NULL,
  `prazo` int(3) NOT NULL,
  PRIMARY KEY (`cd_tipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_documento`
--

INSERT INTO `tipo_documento` (`cd_tipo_documento`, `nm_tipo_documento`, `prazo`) VALUES
(1, 'Declaração', 2),
(2, 'Histórico', 15),
(4, 'Certificado', 15),
(5, 'Diploma', 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_turma`
--

DROP TABLE IF EXISTS `usuario_turma`;
CREATE TABLE IF NOT EXISTS `usuario_turma` (
  `cd_turma` int(11) NOT NULL DEFAULT '0',
  `cd_rm_user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cd_turma`,`cd_rm_user`),
  KEY `fk_cd_rm_user` (`cd_rm_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_avisos`
--
ALTER TABLE `tb_avisos`
  ADD CONSTRAINT `fk_cd_rm_user_aviso` FOREIGN KEY (`cd_rm_user`) REFERENCES `tb_usuario` (`cd_rm_user`);

--
-- Limitadores para a tabela `tb_documento`
--
ALTER TABLE `tb_documento`
  ADD CONSTRAINT `fk_cd_tipo_documento` FOREIGN KEY (`cd_tipo_documento`) REFERENCES `tipo_documento` (`cd_tipo_documento`);

--
-- Limitadores para a tabela `tb_solicitacao`
--
ALTER TABLE `tb_solicitacao`
  ADD CONSTRAINT `fk_cd_documento` FOREIGN KEY (`cd_documento`) REFERENCES `tb_documento` (`cd_documento`),
  ADD CONSTRAINT `fk_cd_rm_user_solicitacao` FOREIGN KEY (`cd_rm_user`) REFERENCES `tb_usuario` (`cd_rm_user`);

--
-- Limitadores para a tabela `tb_turma`
--
ALTER TABLE `tb_turma`
  ADD CONSTRAINT `fk_cd_curso` FOREIGN KEY (`cd_curso`) REFERENCES `tb_curso` (`cd_curso`),
  ADD CONSTRAINT `fk_cd_periodo` FOREIGN KEY (`cd_periodo`) REFERENCES `tb_periodo` (`cd_periodo`);

--
-- Limitadores para a tabela `usuario_turma`
--
ALTER TABLE `usuario_turma`
  ADD CONSTRAINT `fk_cd_rm_user` FOREIGN KEY (`cd_rm_user`) REFERENCES `tb_usuario` (`cd_rm_user`),
  ADD CONSTRAINT `fk_cd_turma` FOREIGN KEY (`cd_turma`) REFERENCES `tb_turma` (`cd_turma`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
