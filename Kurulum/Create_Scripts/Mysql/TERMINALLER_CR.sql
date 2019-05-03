CREATE TABLE IF NOT EXISTS `terminaller` (
  `TID` int(11) NOT NULL AUTO_INCREMENT,
  `ELTID` int(11) DEFAULT NULL,
  `TERMINAL_AD` varchar(20) DEFAULT '',
  `OTO_CAGRI` tinyint(1) DEFAULT '0',
  `OTO_SURE` time DEFAULT NULL,
  `DURUM` smallint(6) DEFAULT '6',
  `AKTIF` tinyint(1) DEFAULT '1',
  `AKTIF_BID` int(11) DEFAULT '0',
  `SON_CAGRILAN_GRUP` int(11) DEFAULT '0',
  `SON_CAGRILAN_TUR` tinyint(1) DEFAULT '0',
  `SIL` tinyint(1) DEFAULT '0',
  `S_YF1` varchar(50) DEFAULT '',
  `S_YF2` varchar(50) DEFAULT '',
  `S_YF3` varchar(50) DEFAULT '',
  `I_YF1` int(11) DEFAULT NULL,
  `I_YF2` int(11) DEFAULT NULL,
  `I_YF3` int(11) DEFAULT NULL,
  `B_YF` tinyint(1) DEFAULT NULL,
  `TerminalTipi` varchar(50) DEFAULT '',
  `DoubleClick` tinyint(1) DEFAULT NULL,
  `SiralamaTipi` varchar(50) DEFAULT '',
  `CagriSiralamaTipi` varchar(50) DEFAULT '',
  PRIMARY KEY (`TID`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
ALTER DATABASE `terminaller` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;