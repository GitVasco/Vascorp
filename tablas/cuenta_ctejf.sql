/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.38-MariaDB : Database - new_vasco
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`new_vasco` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `new_vasco`;

/*Table structure for table `cuenta_ctejf` */

DROP TABLE IF EXISTS `cuenta_ctejf`;

CREATE TABLE `cuenta_ctejf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_doc` varchar(10) DEFAULT NULL,
  `num_cta` varchar(20) DEFAULT NULL,
  `cliente` varchar(15) DEFAULT NULL,
  `vendedor` varchar(10) DEFAULT NULL,
  `fecha` varchar(12) DEFAULT NULL,
  `fecha_ven` varchar(12) DEFAULT NULL,
  `fecha_cep` varchar(12) DEFAULT NULL,
  `tip_mon` varchar(12) DEFAULT NULL,
  `monto` double(11,2) DEFAULT NULL,
  `tip_cambio` varchar(12) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `notas` varchar(100) DEFAULT NULL,
  `cod_pago` varchar(10) DEFAULT NULL,
  `doc_origen` varchar(20) DEFAULT NULL,
  `renovacion` tinyint(4) DEFAULT NULL,
  `protesta` tinyint(4) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `saldo` double(11,2) DEFAULT NULL,
  `ult_pago` varchar(12) DEFAULT NULL,
  `estado_doc` varchar(12) DEFAULT NULL,
  `banco` varchar(10) DEFAULT NULL,
  `num_unico` varchar(12) DEFAULT NULL,
  `fecha_envio` varchar(12) DEFAULT NULL,
  `fecha_abono` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cuenta_ctejf` */

insert  into `cuenta_ctejf`(`id`,`tipo_doc`,`num_cta`,`cliente`,`vendedor`,`fecha`,`fecha_ven`,`fecha_cep`,`tip_mon`,`monto`,`tip_cambio`,`estado`,`notas`,`cod_pago`,`doc_origen`,`renovacion`,`protesta`,`usuario`,`saldo`,`ult_pago`,`estado_doc`,`banco`,`num_unico`,`fecha_envio`,`fecha_abono`) values (3,'01','123123123123','ex0002','21','2020-12-31','2021-01-01','2021-01-04','Soles',5.00,'12','','sdfsddffddsfdf','01','123123123123',1,0,'Brean Flores',5.00,'2020-12-30','Soles','1','0123456789','2020-12-08','2020-12-16');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
