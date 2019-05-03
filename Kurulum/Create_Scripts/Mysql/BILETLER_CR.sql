CREATE TABLE IF NOT EXISTS `biletler` (
  `BID` int(11) NOT NULL AUTO_INCREMENT,
  `TID` int(11) DEFAULT NULL,
  `GRPID` int(11) DEFAULT NULL,
  `BILET_NO` smallint(6) DEFAULT NULL,
  `SIS_TAR` datetime DEFAULT NULL,
  `ISLEM_BAS_TAR` time DEFAULT NULL,
  `ISLEM_BIT_TAR` time DEFAULT NULL,
  `TRANSFER` tinyint(1) DEFAULT NULL,
  `TUR` smallint(6) DEFAULT '1',
  `OZEL_MUSTERI` tinyint(1) DEFAULT '0',
  `BTNID` int(11) DEFAULT NULL,
  `S_YF1` varchar(50) DEFAULT '',
  `S_YF2` varchar(50) DEFAULT '',
  `S_YF3` varchar(50) DEFAULT '',
  `I_YF1` int(11) DEFAULT NULL,
  `I_YF2` int(11) DEFAULT NULL,
  `I_YF3` int(11) DEFAULT NULL,
  `B_YF` tinyint(1) DEFAULT NULL,
  `Zaman` datetime DEFAULT NULL,
  `MusteriNo` varchar(50) DEFAULT '',
  `MusteriAdi` varchar(150) DEFAULT '',
  PRIMARY KEY (`BID`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8;
ALTER DATABASE `biletler` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;