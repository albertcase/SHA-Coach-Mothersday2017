# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.17-0ubuntu0.16.04.1)
# Database: coach-monthersday2017
# Generation Time: 2017-04-26 02:52:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table apply
# ------------------------------------------------------------

DROP TABLE IF EXISTS `apply`;

CREATE TABLE `apply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT NULL,
  `shop` varchar(255) DEFAULT '',
  `date` varchar(255) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table photo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photo`;

CREATE TABLE `photo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `pic` varchar(255) DEFAULT '',
  `favorite` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;

INSERT INTO `photo` (`id`, `uid`, `pic`, `favorite`, `created`, `updated`)
VALUES
	(1,1,'/vagrant/config/../template/upload/e564d0c5502bf8cfe4029d9fb2e46ad0.png',2,'2017-04-24 09:31:25','2017-04-25 06:44:11');

/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table praise
# ------------------------------------------------------------

DROP TABLE IF EXISTS `praise`;

CREATE TABLE `praise` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `praise` WRITE;
/*!40000 ALTER TABLE `praise` DISABLE KEYS */;

INSERT INTO `praise` (`id`, `pid`, `uid`, `created`, `updated`)
VALUES
	(1,1,2,'2017-04-25 06:43:44','2017-04-25 06:43:44'),
	(2,1,3,'2017-04-25 06:44:11','2017-04-25 06:44:11');

/*!40000 ALTER TABLE `praise` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pushlog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pushlog`;

CREATE TABLE `pushlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `apply_id` int(11) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) DEFAULT '',
  `nickname` varchar(255) DEFAULT '',
  `sex` varchar(255) DEFAULT '',
  `city` varchar(255) DEFAULT '',
  `province` varchar(255) DEFAULT '',
  `headimgurl` varchar(255) DEFAULT '',
  `country` varchar(255) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `openid` (`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`uid`, `openid`, `nickname`, `sex`, `city`, `province`, `headimgurl`, `country`, `created`, `updated`)
VALUES
	(1,'moifada','','','','','','','2017-04-24 07:36:55','2017-04-24 07:36:55'),
	(2,'aa','','','','','','','2017-04-24 10:23:12','2017-04-24 10:23:12'),
	(3,'bb','','','','','','','2017-04-25 06:44:07','2017-04-25 06:44:07');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
