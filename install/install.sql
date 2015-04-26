<?php
# This file will be required in "install.php", so you can use php code here.
if(!defined("IN_SYSTEM"))
	die("Access Denied");
?>

CREATE TABLE `<?=$tablepre?>account` (
	`id` int AUTO_INCREMENT,
	`account` varchar(30) NOT NULL UNIQUE,
	`password` varchar(34) NOT NULL,
	`email` varchar(255) NOT NULL UNIQUE,
	`nickname` text NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARSET=<?=$charset?>;

CREATE TABLE `<?=$tablepre?>session` (
	`id` int,
	`expire` timestamp,
	`cookie` varchar(32)
) ENGINE=MyISAM CHARSET=<?=$charset?>;
