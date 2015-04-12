CREATE TABLE `account` (
	`id` int AUTO_INCREMENT,
	`account` varchar(30) NOT NULL UNIQUE,
	`password` text NOT NULL,
	`email` varchar(255) NOT NULL UNIQUE,
	`nickname` text NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARSET=utf8
