CREATE TABLE `board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `decks_num` INT(11) COLLATE utf8_slovenian_ci NOT NULL,
  `dealer_stops_17` INT(11) COLLATE utf8_slovenian_ci NOT NULL,
  `double_bet` INT(11) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `split` INT(11) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `surender` INT(11) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `insurance` INT(11) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `ratio` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `min_bet` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `max_bet` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `color` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `active_table` INT(11) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
