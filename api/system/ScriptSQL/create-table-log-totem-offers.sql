CREATE TABLE `log_totem_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hashClient` varchar(300) CHARACTER SET latin1 NOT NULL,
  `receipt` varchar(255) CHARACTER SET latin1 NOT NULL,
  `printType` varchar(255) CHARACTER SET latin1 NOT NULL,
  `opinionType` varchar(100) CHARACTER SET latin1 NOT NULL,
  `comment` varchar(500) CHARACTER SET latin1 NOT NULL,
  `flagReceipt` int(11) NOT NULL,
  `downloadType` varchar(100) CHARACTER SET latin1 NOT NULL,
  `country` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `store` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;