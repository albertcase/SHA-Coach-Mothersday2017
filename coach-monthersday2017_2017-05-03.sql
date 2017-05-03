# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.18-0ubuntu0.16.04.1)
# Database: coach-monthersday2017
# Generation Time: 2017-05-03 03:42:08 +0000
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
  `created` date DEFAULT NULL,
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



# Dump of table shop
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop`;

CREATE TABLE `shop` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shopid` varchar(64) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `shop` WRITE;
/*!40000 ALTER TABLE `shop` DISABLE KEYS */;

INSERT INTO `shop` (`id`, `shopid`, `city`, `name`, `address`, `tel`)
VALUES
	(1,'shop1','扬州市','扬州金鹰国际购物中心 ','扬州市汶河南路120号','(0514) 8731 8083'),
	(2,'shop2','北京市','北京东方广场','北京市东城区东长安街1号北京东方广场东方新天地商场1层AA16A&AA18','(010) 8518 4978'),
	(3,'shop3','杭州市','杭州大厦精品店','杭州市武林广场1号杭州大厦A座2楼前厅L206号店铺','(0571) 8718 1952'),
	(4,'shop4','成都市','成都国际金融中心','成都市锦江区红星路三段1号一层L122店','(028) 8674 8992'),
	(5,'shop5','济南市','济南恒隆广场','济南市泉城路188号一层102号店','(0531) 5563 8806'),
	(6,'shop6','长春市','卓展购物中心长春店','长春市重庆路1255号卓展购物中心一层C-1118号','(0431) 8848 6081'),
	(7,'shop7','深圳市','深圳华润万象城','深圳市罗湖区宝安南路1881号深圳华润万象城L167店','(0755) 8266 8350 '),
	(8,'shop8','乌鲁木齐市','乌鲁木齐美美友好购物中心店','乌鲁木齐市沙依巴克区友好北路689号美美友好购物中心N-109店铺','(0991) 6991 293'),
	(9,'shop9','大连市','大连百年商场','大连市中山区解放路19号大连百年商城内第G层G30号店铺','(0411) 62887332'),
	(10,'shop10','上海市','上海国金中心','上海市浦东新区陆家嘴金融贸易区世纪大道8号上海国金中心D座地下一层LG1-53,55,56&57室','(021) 2028 0023');

/*!40000 ALTER TABLE `shop` ENABLE KEYS */;
UNLOCK TABLES;


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




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
