-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Servidor: mysql11.kinghost.net
-- Tempo de Gera��o: Nov 19, 2010 as 04:08 PM
-- Vers�o do Servidor: 5.1.52
-- Vers�o do PHP: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `APS2010`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `multa`
--

CREATE TABLE IF NOT EXISTS `multa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_veiculo` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `end_rua` varchar(255) NOT NULL,
  `end_bairro` varchar(155) NOT NULL,
  `end_cep` int(8) NOT NULL,
  `end_cidade` varchar(155) NOT NULL,
  `end_estado` varchar(2) NOT NULL,
  `pontos` int(11) NOT NULL,
  `valor` varchar(10) NOT NULL,
  `pagamento` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `multa`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `principal`
--

CREATE TABLE IF NOT EXISTS `principal` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `principal`
--

INSERT INTO `principal` (`codigo`, `titulo`, `texto`) VALUES
(1, 'Bem-Vindo, software de exemplo com PHP orientado a objetos.', '    <p style="margin-top:10px;">\r\n    <b>Sobre o APS2010 - Ger�ncia de multas e ve�culos.</b>\r\n    </p>    \r\n    <p style="margin-left:10px; margin-top:20px;">\r\n    Este software � composto por 3 tabelas com informa��es sobre, propriet�rios, ve�culos e multas. Tem o poder de inserir, alterar e remover qualquer registro e visualizar um relat�rio configur�vel de acordo com o que o usu�rio deseja, com informa��es sobre multas de um propriet�rio, multas de um veiculo, ve�culos de um propriet�rio.\r\n    </p>\r\n    <p style="margin-left:10px; margin-top:15px;">\r\n    A estrutura do software � baseado em orienta��o a objetos, contendo um CORE com todas as classes, propriedades e m�todos sendo poss�vel ser acessado de qualquer outra parte do software, desde que tenha as permiss�es necess�rias para manipular as propriedades da classe que deseja utilizar. Sendo dividido em classes, temos as principais que s�o Proprietarios, Veiculos e Multas. Uma relacionada com a outra por conduta de heran�a do conceito Orientado a Objetos.\r\n    </p>\r\n    <p style="margin-left:10px; margin-top:15px;">\r\n    O trabalho de APS2010 foi desenvolvido de acordo com as informa��es requeridas pelo manual de cria��o\r\n    do Professor Fabr�cio, Professor do Campus de Sorocaba da Universidade Paulista UNIP.\r\n    </p>\r\n    <p style="margin-top:20px;">\r\n    <b>Os desenvolvedores deste Projeto s�o:</b>\r\n    </p>\r\n    <p style="margin-left:10px; margin-top:20px;">\r\n        Roque Jos� Ribeiro da Silva Jr. \r\n        <p style="margin-left:15px; margin-top:5px; font-size:10px;">\r\n        Programador em PHP, ASP.\r\n        <br />\r\n        Designer com HTML5, CSS3 e jQuery.\r\n        <br />\r\n        Banco de Dados MySQL e SQL Server.\r\n        </p>\r\n    </p>\r\n    <p style="margin-left:10px; margin-top:10px;">\r\n        Milton Murat Tagliani. \r\n        <p style="margin-left:15px; margin-top:5px; font-size:10px;">\r\n        Respons�vel pela documenta��o\r\n        </p>\r\n    </p>\r\n    <p style="margin-left:10px; margin-top:10px;">\r\n        Adriano Kiel. \r\n        <p style="margin-left:15px; margin-top:5px; font-size:10px;">\r\n        Respons�vel pela organiza��o e cronograma do desenvolvimento.\r\n        </p>\r\n    </p>\r\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `proprietario`
--

CREATE TABLE IF NOT EXISTS `proprietario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `celular` varchar(14) NOT NULL,
  `end_rua` varchar(255) NOT NULL,
  `end_numero` int(5) NOT NULL,
  `end_bairro` varchar(155) NOT NULL,
  `end_cep` varchar(9) NOT NULL,
  `end_cidade` varchar(155) NOT NULL,
  `end_estado` varchar(2) NOT NULL,
  `num_rg` varchar(13) NOT NULL,
  `num_cpf` varchar(14) NOT NULL,
  `num_cnh` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `proprietario`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE IF NOT EXISTS `veiculo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_proprietario` int(11) NOT NULL,
  `marca` varchar(155) NOT NULL,
  `modelo` varchar(155) NOT NULL,
  `ano` varchar(5) NOT NULL,
  `placa` varchar(7) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `veiculo`
--

