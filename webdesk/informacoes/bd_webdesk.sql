
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `bd_webdesk`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_CHT_MSG`
--

CREATE TABLE IF NOT EXISTS `TB_CHT_MSG` (
  `CHT_MSG_COD` int(11) NOT NULL AUTO_INCREMENT,
  `CHT_MSG_SND` int(11) NOT NULL,
  `CHT_MSG_REC` int(11) NOT NULL,
  `CHT_MSG_MSG` text NOT NULL,
  `CHT_MSG_DAT` datetime NOT NULL,
  `CHT_MSG_GRP` int(11) DEFAULT NULL,
  `CHT_MSG_VIS` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CHT_MSG_COD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de Mensagens do Sistema' AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `TB_CHT_MSG`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_GND_CTO`
--

CREATE TABLE IF NOT EXISTS `TB_GND_CTO` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tabela de Contatos da Agenda' AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `TB_GND_CTO`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_GND_GRU`
--

CREATE TABLE IF NOT EXISTS `TB_GND_GRU` (
  `GND_GRU_COD` int(11) NOT NULL AUTO_INCREMENT,
  `GND_GRU_TIT` varchar(100) NOT NULL,
  `GND_GRU_OBS` text NOT NULL,
  `GND_GRU_USC` int(11) NOT NULL,
  PRIMARY KEY (`GND_GRU_COD`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tabela de Grupos dos Contatos da Agenda' AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `TB_GND_GRU`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_GND_UF`
--

CREATE TABLE IF NOT EXISTS `TB_GND_UF` (
  `GND_UF_COD` int(11) NOT NULL,
  `GND_UF_SIG` char(2) NOT NULL,
  `GND_UF_NOM` varchar(72) NOT NULL,
  PRIMARY KEY (`GND_UF_SIG`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tabela de Estados do Brasil';

--
-- Extraindo dados da tabela `TB_GND_UF`
--

INSERT INTO `TB_GND_UF` (`GND_UF_COD`, `GND_UF_SIG`, `GND_UF_NOM`) VALUES
(1, 'AC', 'Acre'),
(2, 'AL', 'Alagoas'),
(3, 'AM', 'Amazonas'),
(4, 'AP', 'Amapá'),
(5, 'BA', 'Bahia'),
(6, 'CE', 'Ceará'),
(7, 'DF', 'Distrito Federal'),
(8, 'ES', 'Espírito Santo'),
(9, 'GO', 'Goiás'),
(10, 'MA', 'Maranhão'),
(11, 'MG', 'Minas Gerais'),
(12, 'MS', 'Mato Grosso do Sul'),
(13, 'MT', 'Mato Grosso'),
(14, 'PA', 'Pará'),
(15, 'PB', 'Paraíba'),
(16, 'PE', 'Pernambuco'),
(17, 'PI', 'Piauí'),
(18, 'PR', 'Paraná'),
(19, 'RJ', 'Rio de Janeiro'),
(20, 'RN', 'Rio Grande do Norte'),
(21, 'RO', 'Rondônia'),
(22, 'RR', 'Roraima'),
(23, 'RS', 'Rio Grande do Sul'),
(24, 'SC', 'Santa Catarina'),
(25, 'SE', 'Sergipe'),
(26, 'SP', 'São Paulo'),
(27, 'TO', 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_WDK_EMP`
--

CREATE TABLE IF NOT EXISTS `TB_WDK_EMP` (
  `WDK_EMP_COD` int(11) NOT NULL AUTO_INCREMENT,
  `WDK_EMP_NOM` varchar(45) DEFAULT NULL COMMENT 'Nome da Empresa',
  `WDK_EMP_HST` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs DEFAULT NULL COMMENT 'Host do Servidor de Hospedagem',
  `WDK_EMP_SNH` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs DEFAULT NULL COMMENT 'Senha do Host',
  PRIMARY KEY (`WDK_EMP_COD`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Empresas do Sistema' AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `TB_WDK_EMP`
--

INSERT INTO `TB_WDK_EMP` (`WDK_EMP_COD`, `WDK_EMP_NOM`, `WDK_EMP_HST`, `WDK_EMP_SNH`) VALUES
(1, 'WebDesk', 'webdesk', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_WDK_USR`
--

CREATE TABLE IF NOT EXISTS `TB_WDK_USR` (
  `WDK_USR_COD` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo de Usuario do Sistema Global',
  `WDK_USR_NOM` varchar(45) NOT NULL COMMENT 'Nome Completo',
  `WDK_USR_USR` varchar(155) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL COMMENT 'Usuario',
  `WDK_USR_SNH` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL COMMENT 'Senha',
  `WDK_USR_EMA` varchar(255) DEFAULT NULL COMMENT 'Email',
  `WDK_USR_EMP` int(11) NOT NULL DEFAULT '1' COMMENT 'Empresa Vinculada',
  `WDK_USR_APV` int(1) DEFAULT '1' COMMENT 'Aprovacao',
  `WDK_USR_STS` int(1) DEFAULT '0' COMMENT 'Status Online/Offline',
  `WDK_USR_ACE` int(1) DEFAULT '1' COMMENT 'Nivel de Acesso do Sistema',
  `WDK_USR_AUS` varchar(1024) DEFAULT NULL,
  `WDK_USR_IMG` varchar(300) DEFAULT NULL,
  `WDK_USR_BGD` varchar(300) DEFAULT 'imagens/wallpaper/wallpaper_20.jpg',
  `WDK_USR_INI` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`WDK_USR_COD`,`WDK_USR_EMP`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Tabela de Usuarios do Sistema' AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `TB_WDK_USR`
--

INSERT INTO `TB_WDK_USR` (`WDK_USR_COD`, `WDK_USR_NOM`, `WDK_USR_USR`, `WDK_USR_SNH`, `WDK_USR_EMA`, `WDK_USR_EMP`, `WDK_USR_APV`, `WDK_USR_STS`, `WDK_USR_ACE`, `WDK_USR_AUS`, `WDK_USR_IMG`, `WDK_USR_BGD`, `WDK_USR_INI`) VALUES
(1, 'Administrador', 'root', '123456', 'root@webdesk', 1, 1, 0, 3, '', NULL, 'conteudo/diretorio/upload/root/cityscape.jpg', '0000-00-00 00:00:00');
