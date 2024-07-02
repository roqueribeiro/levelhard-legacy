-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Fev 04, 2011 as 12:30 PM
-- Versão do Servidor: 5.1.41
-- Versão do PHP: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Banco de Dados: `webrocky`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_GND_CTO`
--

CREATE TABLE `TB_GND_CTO` (
  `GND_CTO_COD` int(11) NOT NULL AUTO_INCREMENT,
  `GND_CTO_NOM` varchar(200) NOT NULL,
  `GND_CTO_SNO` varchar(200) NOT NULL,
  `GND_CTO_TEL` varchar(20) NOT NULL,
  `GND_CTO_CEL` varchar(20) NOT NULL,
  `GND_CTO_MAI` varchar(200) NOT NULL,
  `GND_CTO_END` varchar(200) NOT NULL,
  `GND_CTO_BAI` varchar(200) NOT NULL,
  `GND_CTO_CEP` varchar(20) NOT NULL,
  `GND_CTO_CID` varchar(200) NOT NULL,
  `GND_CTO_EST` varchar(200) NOT NULL,
  `GND_CTO_OBS` text NOT NULL,
  `GND_CTO_GRU` int(11) NOT NULL,
  `GND_CTO_USC` int(11) NOT NULL,
  PRIMARY KEY (`GND_CTO_COD`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `TB_GND_CTO`
--

INSERT INTO `TB_GND_CTO` VALUES(1, 'Roque', 'Ribeiro da Silva', '', '(15) 9143-8516', 'roque.ribeiro@webrocky.com.br', '', '', '', '', 'SP', '', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_GND_GRU`
--

CREATE TABLE `TB_GND_GRU` (
  `GND_GRU_COD` int(11) NOT NULL AUTO_INCREMENT,
  `GND_GRU_TIT` varchar(100) NOT NULL,
  `GND_GRU_OBS` text NOT NULL,
  `GND_GRU_USC` int(11) NOT NULL,
  PRIMARY KEY (`GND_GRU_COD`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `TB_GND_GRU`
--

INSERT INTO `TB_GND_GRU` VALUES(1, 'Sem Grupo', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_GND_UF`
--

CREATE TABLE `TB_GND_UF` (
  `GND_UF_COD` int(11) NOT NULL,
  `GND_UF_SIG` char(2) NOT NULL,
  `GND_UF_NOM` varchar(72) NOT NULL,
  PRIMARY KEY (`GND_UF_SIG`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `TB_GND_UF`
--

INSERT INTO `TB_GND_UF` VALUES(1, 'AC', 'Acre');
INSERT INTO `TB_GND_UF` VALUES(2, 'AL', 'Alagoas');
INSERT INTO `TB_GND_UF` VALUES(3, 'AM', 'Amazonas');
INSERT INTO `TB_GND_UF` VALUES(4, 'AP', 'Amapá');
INSERT INTO `TB_GND_UF` VALUES(5, 'BA', 'Bahia');
INSERT INTO `TB_GND_UF` VALUES(6, 'CE', 'Ceará');
INSERT INTO `TB_GND_UF` VALUES(7, 'DF', 'Distrito Federal');
INSERT INTO `TB_GND_UF` VALUES(8, 'ES', 'Espírito Santo');
INSERT INTO `TB_GND_UF` VALUES(9, 'GO', 'Goiás');
INSERT INTO `TB_GND_UF` VALUES(10, 'MA', 'Maranhão');
INSERT INTO `TB_GND_UF` VALUES(11, 'MG', 'Minas Gerais');
INSERT INTO `TB_GND_UF` VALUES(12, 'MS', 'Mato Grosso do Sul');
INSERT INTO `TB_GND_UF` VALUES(13, 'MT', 'Mato Grosso');
INSERT INTO `TB_GND_UF` VALUES(14, 'PA', 'Pará');
INSERT INTO `TB_GND_UF` VALUES(15, 'PB', 'Paraíba');
INSERT INTO `TB_GND_UF` VALUES(16, 'PE', 'Pernambuco');
INSERT INTO `TB_GND_UF` VALUES(17, 'PI', 'Piauí');
INSERT INTO `TB_GND_UF` VALUES(18, 'PR', 'Paraná');
INSERT INTO `TB_GND_UF` VALUES(19, 'RJ', 'Rio de Janeiro');
INSERT INTO `TB_GND_UF` VALUES(20, 'RN', 'Rio Grande do Norte');
INSERT INTO `TB_GND_UF` VALUES(21, 'RO', 'Rondônia');
INSERT INTO `TB_GND_UF` VALUES(22, 'RR', 'Roraima');
INSERT INTO `TB_GND_UF` VALUES(23, 'RS', 'Rio Grande do Sul');
INSERT INTO `TB_GND_UF` VALUES(24, 'SC', 'Santa Catarina');
INSERT INTO `TB_GND_UF` VALUES(25, 'SE', 'Sergipe');
INSERT INTO `TB_GND_UF` VALUES(26, 'SP', 'São Paulo');
INSERT INTO `TB_GND_UF` VALUES(27, 'TO', 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_GND_USR`
--

CREATE TABLE `TB_GND_USR` (
  `GND_USR_COD` int(11) NOT NULL AUTO_INCREMENT,
  `GND_USR_NOM` char(200) NOT NULL,
  `GND_USR_SNO` char(200) NOT NULL,
  `GND_USR_LOG` varchar(20) NOT NULL,
  `GND_USR_SEN` varchar(20) NOT NULL,
  `GND_USR_MAI` char(200) NOT NULL,
  `GND_USR_ACE` int(11) NOT NULL,
  `GND_USR_AUS` varchar(200) NOT NULL,
  PRIMARY KEY (`GND_USR_COD`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `TB_GND_USR`
--

INSERT INTO `TB_GND_USR` VALUES(1, 'Administrador', '', 'root', '123456', 'roque.ribeiro@hotmail.com.br', 2, '');
