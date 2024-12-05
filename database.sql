--
-- MySQL 5.5.5
-- Thu, 05 Dec 2024 00:05:11 +0000
--
CREATE DATABASE `Location_history`

CREATE TABLE `ip_history` (
   `id` int(11) not null auto_increment,
   `ip_address` varchar(45) not null,
   `country` varchar(100),
   `region` varchar(100),
   `city` varchar(100),
   `latitude` varchar(50),
   `longitude` varchar(50),
   `isp` varchar(150),
   `timezone` varchar(100),
   `created_at` timestamp not null default CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=10
