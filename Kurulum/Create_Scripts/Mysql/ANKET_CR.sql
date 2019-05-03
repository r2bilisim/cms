DROP TABLE IF EXISTS `anket`;
CREATE TABLE IF NOT EXISTS `anket` (
  `SatirId` int(11) NOT NULL AUTO_INCREMENT,
  `Secim` int(11) DEFAULT NULL,
  `Tarih` datetime DEFAULT NULL,
  `TerminalId` int(11) DEFAULT NULL,
  PRIMARY KEY (`SatirId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER DATABASE `anket` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;