CREATE TABLE IF NOT EXISTS `havuz` (
  `SatirId` int(11) NOT NULL AUTO_INCREMENT,
  `BID` int(11) DEFAULT NULL,
  `TID` int(11) DEFAULT NULL,
  `Tarih` datetime DEFAULT NULL,
  PRIMARY KEY (`SatirId`)
) ENGINE=InnoDB AUTO_INCREMENT=792 DEFAULT CHARSET=utf8;
ALTER DATABASE `havuz` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;