CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `user_id` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `rounds` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `bs_errors` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `start_dt` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `end_dt` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `balance_start` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `balance_end` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `roi` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `active` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci