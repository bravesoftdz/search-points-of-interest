# Dump of table hotels
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hotels`;

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `lon` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;

INSERT INTO `hotels` (`id`, `title`, `address`, `lat`, `lon`, `created_at`, `updated_at`)
VALUES
    (2,'Amba Hotel Marble Arch','Bryanston Street, London W1H 7EH','51.5144','-0.15655',NULL,'2017-07-19 11:27:18'),
    (3,'Amba Hotel Charing Cross','The Strand, London, WC2N 5HX','51.50845','-0.12493',NULL,'2017-07-03 08:52:07'),
    (4,'The Royal Horseguards Hotel','2 Whitehall Court London SW1A 2EJ','51.50537','-0.12396',NULL,'2017-06-30 15:35:38'),
    (5,'The Tower Hotel','St Katharine\'s Way London E1W 1LD','51.50662','-0.07277',NULL,'2017-06-30 15:42:13'),
    (6,'The Cumberland','Great Cumberland Place, London W1H 7DL','51.51387','-0.15882',NULL,'2017-07-03 08:55:06'),
    (7,'The Grosvenor Hotel','101 Buckingham Palace Rd, London SW1W 0SJ','51.49566','-0.14522',NULL,'2017-07-03 08:55:51'),
    (8,'Thistle Euston','Cardington Street, Euston London NW1 2LP','51.52914','-0.13723',NULL,'2017-07-03 09:00:18'),
    (9,'Thistle City Barbican','Central Street, Clerkenwell London EC1V 8DS','51.52728','-0.09597',NULL,'2017-07-03 08:59:07'),
    (10,'Thistle Holborn, The Kingsley','Bloomsbury Way London WC1A 2SD','51.51764','-0.12465',NULL,'2017-07-03 09:01:33'),
    (11,'Thistle Bloomsbury Park','126 Southampton Row London WC1B 5AD','51.52088','-0.12296',NULL,'2017-07-03 08:57:35'),
    (12,'Thistle Hyde Park','90-92 Lancaster Gate London W2 3NR','51.51124','-0.18089',NULL,'2017-07-03 09:02:40'),
    (13,'Thistle Kensington Gardens','104 Bayswater Road London W2 3HL','51.51074','-0.18409',NULL,'2017-07-03 09:03:38'),
    (14,'Thistle Trafalgar Square','Whitcomb Street, Trafalgar Square LondonWC2H 7HG','51.50913','-0.13018',NULL,'2017-07-03 09:06:28'),
    (15,'Thistle London Heathrow T5','Bath Road, Longford London UB7 0EQ','51.48036','-0.48372',NULL,'2017-07-03 09:04:32'),
    (16,'every hotel Piccadilly','Coventry Street, London W1D 6BZ','51.51023','-0.131643',NULL,'2017-06-30 15:29:46');

/*!40000 ALTER TABLE `hotels` ENABLE KEYS */;
UNLOCK TABLES;