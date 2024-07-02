-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jun 28, 2011 as 02:52 
-- Versão do Servidor: 5.1.41
-- Versão do PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `bd_chat`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cht_msg`
--

CREATE TABLE IF NOT EXISTS `tb_cht_msg` (
  `CHT_MSG_COD` int(11) NOT NULL AUTO_INCREMENT,
  `CHT_MSG_SND` int(11) NOT NULL,
  `CHT_MSG_REC` int(11) NOT NULL,
  `CHT_MSG_MSG` text NOT NULL,
  `CHT_MSG_DAT` datetime NOT NULL,
  `CHT_MSG_GRP` int(11) DEFAULT NULL,
  `CHT_MSG_VIS` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CHT_MSG_COD`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='1' AUTO_INCREMENT=103 ;

--
-- Extraindo dados da tabela `tb_cht_msg`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cht_usr`
--

CREATE TABLE IF NOT EXISTS `tb_cht_usr` (
  `CHT_USR_COD` int(11) NOT NULL AUTO_INCREMENT,
  `CHT_USR_NOM` varchar(100) NOT NULL,
  `CHT_USR_STS` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CHT_USR_COD`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tb_cht_usr`
--

INSERT INTO `tb_cht_usr` (`CHT_USR_COD`, `CHT_USR_NOM`, `CHT_USR_STS`) VALUES
(1, 'Roque Ribeiro da Silva', 2),
(2, 'Bruno Marcelo Dalmazzo', 1),
(3, 'Raíssa Kasakevicius Dalmazzo', 1),
(4, 'Renato Ribeiro Kasakevicius', 3),
(5, 'Natália Simões', 1),
(6, 'Luis Eduardo Silva Ribeiro', 1),
(7, 'Eduardo Pizorno', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
