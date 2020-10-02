/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.38-MariaDB : Database - vasco
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, vasco=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`new_vasco` /*!40100 DEFAULT CHARACTER SET latin1 */;
vasco
USE `new_vasco`;

/*Table structure for table `movimientos_cabecerajf` */

DROP TABLE IF EXISTS `movimientos_cabecerajf`;

CREATE TABLE `movimientos_cabecerajf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(10) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `taller` varchar(10) DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `almacen` varchar(10) DEFAULT NULL,
  `trabajador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `movimientos_cabecerajf` */

insert  into `movimientos_cabecerajf`(`id`,`tipo`,`usuario`,`taller`,`documento`,`total`,`fecha`,`almacen`,`trabajador`) values (18,'E20',19,'T2','T21234',10,'2020-09-18','01',NULL),(19,'E20',19,'T1','T11234',24,'2020-09-18','02',5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
