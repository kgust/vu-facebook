DROP TABLE IF EXISTS `photos`;

CREATE TABLE `photos` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `source` text NOT NULL,
  `picture` text NOT NULL,
  `created_time` datetime NOT NULL,
  `likes` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
