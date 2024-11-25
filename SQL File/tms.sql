/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.22-MariaDB : Database - tms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tms` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `tms`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`UserName`,`Password`,`updationDate`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','2023-05-24 06:18:49');

/*Table structure for table `tblbooking` */

DROP TABLE IF EXISTS `tblbooking`;

CREATE TABLE `tblbooking` (
  `BookingId` int(11) NOT NULL AUTO_INCREMENT,
  `PackageId` int(11) DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `FromDate` varchar(100) DEFAULT NULL,
  `ToDate` varchar(100) DEFAULT NULL,
  `Comment` mediumtext DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL,
  `CancelledBy` varchar(5) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`BookingId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tblbooking` */

insert  into `tblbooking`(`BookingId`,`PackageId`,`UserEmail`,`FromDate`,`ToDate`,`Comment`,`RegDate`,`status`,`CancelledBy`,`UpdationDate`) values (1,1,'test@gmail.com','2020-07-11','2020-07-18','Quiero este paquete.','2020-07-08 01:38:36',2,'u','2023-09-26 14:51:46'),(2,2,'test@gmail.com','2020-07-10','2020-07-13','Hay algun descuento.','2020-07-08 01:43:25',1,NULL,'2023-09-26 14:52:03'),(3,4,'abir@gmail.com','2020-07-11','2020-07-15','Cuando obtengo la confirmación.','2020-07-08 01:44:39',2,'a','2023-09-26 14:52:21'),(4,5,'USER@MAIL.COM','2023-09-26','2023-09-30','Me gustaría conocer mas detalles de este paquete turístico, gracias.','2023-09-26 15:26:39',0,NULL,NULL),(5,5,'USER@MAIL.COM','2023-09-26','2023-09-30','Me gustaría conocer mas detalles de este paquete turístico, gracias.','2023-09-26 15:28:10',0,NULL,NULL),(6,5,'USER@MAIL.COM','2023-09-26','2023-09-30','Me gustaría conocer mas detalles de este paquete turístico, gracias.','2023-09-26 15:29:44',0,NULL,NULL),(7,5,'USER@MAIL.COM','2023-09-26','2023-09-30','Me gustaría conocer mas detalles de este paquete turístico, gracias.','2023-09-26 15:30:06',0,NULL,NULL);

/*Table structure for table `tblenquiry` */

DROP TABLE IF EXISTS `tblenquiry`;

CREATE TABLE `tblenquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `MobileNumber` char(10) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tblenquiry` */

insert  into `tblenquiry`(`id`,`FullName`,`EmailId`,`MobileNumber`,`Subject`,`Description`,`PostingDate`,`Status`) values (1,'Jone Paaire','jone@gmail.com','4646464646','Consulta para el viaje a Manali.','Por favor proporcioneme más ofertas.','2020-07-08 01:30:32',1),(2,'Dario Ozorio','dozor@gmail.com','6797947987','Consulta','Cualquier oferta para viaje al norte.','2020-07-08 01:31:38',1),(3,'Dorian','dor@gmail.com','1646689721','Alguna oferta para el norte.','Alguna oferta para el norte.','2020-07-08 01:32:41',1),(4,'Jose','jr@me.com','3201254587','Consulta','Buenas tardes, me pueden contactar por favor.','2023-09-26 16:02:42',NULL);

/*Table structure for table `tblissues` */

DROP TABLE IF EXISTS `tblissues`;

CREATE TABLE `tblissues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserEmail` varchar(100) DEFAULT NULL,
  `Issue` varchar(100) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminremarkDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tblissues` */

insert  into `tblissues`(`id`,`UserEmail`,`Issue`,`Description`,`PostingDate`,`AdminRemark`,`AdminremarkDate`) values (1,NULL,NULL,NULL,'2020-07-08 01:33:20',NULL,NULL),(2,NULL,NULL,NULL,'2020-07-08 01:33:56',NULL,NULL),(3,NULL,NULL,NULL,'2020-07-08 01:34:20',NULL,NULL),(4,NULL,NULL,NULL,'2020-07-08 01:34:38',NULL,NULL),(5,NULL,NULL,NULL,'2020-07-08 01:35:06',NULL,NULL),(6,'test@gmail.com','Problemas de reserva','No puedo reservar el paquete.','2020-07-08 01:36:03','Ok, solucionaremos el problema lo antes posible.','2023-09-26 14:55:38'),(7,'test@gmail.com','Reembolso','quiero mi reembolso','2020-07-08 01:56:29',NULL,NULL);

/*Table structure for table `tblpages` */

DROP TABLE IF EXISTS `tblpages`;

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT '',
  `detail` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `tblpages` */

insert  into `tblpages`(`id`,`type`,`detail`) values (1,'terms','																				<p align=\"justify\"><font size=\"2\"><strong><font color=\"#990000\">(1) ACEPTACIÓN DE TERMINOS</font><br><br></strong>¡Bienvenido a Yahoo!. 1Yahoo Web Services Private Limited Yahoo\", \"nosotros\" o \"nos\", según sea el caso) le proporciona el Servicio (definido a continuación), sujeto a los siguientes Términos de servicio (\"TOS\"), que pueden ser actualizados por nosotros de vez en cuando sin previo aviso. Puede revisar la versión más actualizada de los TOS en cualquier momento en</font><font size=\"2\">:&nbsp;</font><a href=\"http://in.docs.yahoo.com/info/terms/\" style=\"background-color: rgb(255, 255, 255);\"><font size=\"2\">http://in.docs.yahoo.com/info/terms/</font></a><font size=\"2\">.</font><font size=\"2\">&nbsp;Además, cuando utilice determinados servicios de Yahoo o servicios de terceros, usted y Yahoo estarán sujetos a las pautas o reglas publicadas aplicables a dichos servicios que pueden publicarse de vez en cuando. Todas dichas pautas o reglas, que pueden estar sujetas a cambios, se incorporan por la presente como referencia a los TOS. En la mayoría de los casos, las guías y reglas son específicas de una parte particular del Servicio y lo ayudarán a aplicar los TOS a esa parte, pero en la medida de cualquier inconsistencia entre los TOS y cualquier guía o regla, prevalecerán los TOS. También podemos ofrecer otros servicios de vez en cuando que se rigen por diferentes Términos de servicios, en cuyo caso los TOS no se aplican a dichos otros servicios si y en la medida en que dichos Términos de servicios diferentes los excluyan expresamente. Yahoo también puede ofrecer otros servicios de vez en cuando que se rigen por diferentes Términos de Servicios. Estos TOS no se aplican a otros servicios que se rigen por Términos de servicio diferentes.<br></font></p><p align=\"justify\"><font size=\"2\">¡Bienvenido a Yahoo!. 1Yahoo Web Services India Private Limited Yahoo\", \"nosotros\" o \"nos\", según sea el caso) le proporciona el Servicio (definido a continuación), sujeto a los siguientes Términos de servicio (\"TOS\"), que pueden ser actualizados por nosotros de vez en cuando sin previo aviso. Puede revisar la versión más actualizada de los TOS en cualquier momento en</font><font size=\"2\">:&nbsp;</font><a href=\"http://in.docs.yahoo.com/info/terms/\" style=\"background-color: rgb(255, 255, 255);\"><font size=\"2\">http://in.docs.yahoo.com/info/terms/</font></a><font size=\"2\">.</font><font size=\"2\">&nbsp;Además, cuando utilice determinados servicios de Yahoo o servicios de terceros, usted y Yahoo estarán sujetos a las pautas o reglas publicadas aplicables a dichos servicios que pueden publicarse de vez en cuando. Todas dichas pautas o reglas, que pueden estar sujetas a cambios, se incorporan por la presente como referencia a los TOS. En la mayoría de los casos, las guías y reglas son específicas de una parte particular del Servicio y lo ayudarán a aplicar los TOS a esa parte, pero en la medida de cualquier inconsistencia entre los TOS y cualquier guía o regla, prevalecerán los TOS. También podemos ofrecer otros servicios de vez en cuando que se rigen por diferentes Términos de servicios, en cuyo caso los TOS no se aplican a dichos otros servicios si y en la medida en que dichos Términos de servicios diferentes los excluyan expresamente. Yahoo también puede ofrecer otros servicios de vez en cuando que se rigen por diferentes Términos de Servicios. Estos TOS no se aplican a otros servicios que se rigen por Términos de servicio diferentes.</font><font size=\"2\"><br></font></p>\r\n<p align=\"justify\"><br></p>\r\n										\r\n										'),(2,'privacy','<p style=\"margin-bottom: 1rem; line-height: 1.8; color: rgb(68, 68, 69); font-size: 0.9rem; font-family: &quot;Open Sans&quot;, sans-serif;\">Esta Política de Privacidad describe cómo se recopila, utiliza y comparte tu información personal cuando visitas o realizas una compra en (URL de la tienda).</p><p style=\"margin-bottom: 1rem; line-height: 1.8; color: rgb(68, 68, 69); font-size: 0.9rem; font-family: &quot;Open Sans&quot;, sans-serif;\"><span style=\"font-weight: bolder;\">QUÉ INFORMACIÓN PERSONAL RECOPILAMOS</span></p><p style=\"margin-bottom: 1rem; line-height: 1.8; color: rgb(68, 68, 69); font-size: 0.9rem; font-family: &quot;Open Sans&quot;, sans-serif;\">Cuando visitas el Sitio, recopilamos automáticamente cierta información sobre tu dispositivo, incluida información sobre tu navegador web, dirección IP, zona horaria y algunas de las cookies que están instaladas en tu dispositivo.</p><p style=\"margin-bottom: 1rem; line-height: 1.8; color: rgb(68, 68, 69); font-size: 0.9rem; font-family: &quot;Open Sans&quot;, sans-serif;\">Además, a medida que navegas por el Sitio, recopilamos información sobre las páginas web individuales o los productos que ves, qué sitios web o términos de búsqueda te remiten al Sitio, e información sobre cómo interactúas con el Sitio. Nos referimos a esta información recopilada automáticamente como&nbsp;<span style=\"font-weight: bolder;\">Información del Dispositivo</span>&nbsp;(device information).</p><p style=\"margin-bottom: 1rem; line-height: 1.8; color: rgb(68, 68, 69); font-size: 0.9rem; font-family: &quot;Open Sans&quot;, sans-serif;\">Recopilamos información del dispositivo utilizando las siguientes tecnologías:</p><ul style=\"padding-left: 2rem; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif;\"><li style=\"color: rgb(68, 68, 69); font-size: 1rem; line-height: 1.8;\"><p style=\"margin-bottom: 1rem; line-height: 1.8; font-size: 0.9rem;\"><span style=\"font-weight: bolder;\">Cookies</span>: son archivos de datos que se colocan en tu dispositivo o computadora y con frecuencia incluyen un identificador único anónimo.</p></li><li style=\"color: rgb(68, 68, 69); font-size: 1rem; line-height: 1.8;\"><p style=\"margin-bottom: 1rem; line-height: 1.8; font-size: 0.9rem;\"><span style=\"font-weight: bolder;\">Archivos de registro</span>: rastrean las acciones que ocurren en el Sitio y recopilan datos, incluida tu dirección IP, el tipo de navegador, el proveedor de servicios de Internet, las páginas de referencia/salida y las marcas de fecha y hora.</p></li></ul><p style=\"margin-bottom: 1rem; line-height: 1.8; color: rgb(68, 68, 69); font-size: 0.9rem; font-family: &quot;Open Sans&quot;, sans-serif;\"><em>Menciona todas las demás herramientas de seguimiento y/o tecnologías que usa tu sitio web.</em></p>'),(3,'aboutus','										<div style=\"text-align: justify;\"><span style=\"color: rgb(0, 0, 0); font-family: Georgia; font-size: 15px; font-weight: 700;\">¡¡¡Bienvenidos al Sistema de Gestión Turística!!!</span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(0, 0, 0); font-family: Georgia; font-size: 15px;\">Desde entonces, los miembros de nuestro equipo, corteses y comprometidos, siempre han garantizado un recorrido agradable y placentero para los clientes. Este arduo esfuerzo ha permitido que Shreya Tour &amp; Travels sea reconocido como un proveedor confiable de soluciones de viaje con tres oficinas en Delhi. Tenemos paquetes que se adaptan al presupuesto y al gusto del viajero más exigente. Reserve las vacaciones de sus sueños en línea. Respaldados por la calidad y las propuestas de nuestros asesores de viajes, lo invitamos a elegir paquetes de vacaciones y personalizarlos según su plan.</span></div>										<div></div>\r\n										'),(11,'contact','																														<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Cra 9 #27 ---- Bogotá, Colombia</span>');

/*Table structure for table `tbltourpackages` */

DROP TABLE IF EXISTS `tbltourpackages`;

CREATE TABLE `tbltourpackages` (
  `PackageId` int(11) NOT NULL AUTO_INCREMENT,
  `PackageName` varchar(200) DEFAULT NULL,
  `PackageType` varchar(150) DEFAULT NULL,
  `PackageLocation` varchar(100) DEFAULT NULL,
  `PackagePrice` int(11) DEFAULT NULL,
  `PackageFetures` varchar(255) DEFAULT NULL,
  `PackageDetails` mediumtext DEFAULT NULL,
  `PackageImage` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`PackageId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbltourpackages` */

insert  into `tbltourpackages`(`PackageId`,`PackageName`,`PackageType`,`PackageLocation`,`PackagePrice`,`PackageFetures`,`PackageDetails`,`PackageImage`,`Creationdate`,`UpdationDate`) values (1,'Swiss Paris Delight Premium 2023 (paquete grupal).','Paquete grupal','París y Suiza',6000,'Billete de avión de ida y vuelta en clase económica válido durante las vacaciones - Tasas de aeropuerto - Alojamiento por 3 noches en París y 3 noches en la pintoresca Suiza - Disfrute de desayunos continentales todas las mañanas.','Elija estas vacaciones para unas vacaciones relajantes en París y Suiza. Su recorrido comienza desde París. Disfrute de una excursión a atracciones populares como la icónica Torre Eiffel. Después de experimentar la hermosa ciudad, pasarás por campos de mostaza a través de Borgoña para llegar a Suiza. Una vez allí, puedes optar por un tour a Interlaken y luego a las cataratas Trummelbach. Una parada fotográfica en el lago de Zúrich y un viaje en teleférico al monte Titlis son los principales momentos destacados de las vacaciones.','1581490262_2_1.jpg','2023-07-19 00:21:58',NULL),(2,'Vacaciones en Bután - Especial Thimphu y Paro','Paquete Familiar','Bután',3000,'Wi-Fi gratuito, desayuno gratuito, servicio gratuito de recogida y entrega','Visita al Monasterio del Nido del Tigre | Servicios complementarios de un Guía Profesional.','BHUTAN-THIMPU-PARO-PUNAKHA-TOUR-6N-7D.jpeg','2023-07-26 00:37:40','2023-09-26 15:03:10'),(3,'Especial Alma Gemela Bali - 7 Noches','Paquete Pareja','Indonesia(Bali)',5000,'Servicio gratuito de recogida y entrega, Wi-Fi gratuito, Guía profesional gratuito','Traslados al aeropuerto en coche privado | Visitas turísticas populares incluidas | Adecuado para parejas y viajeros con poco presupuesto.','1583140977_5_11.jpg','2023-07-19 00:41:07','2023-09-26 15:04:03'),(4,'Kerala: un paraíso para los amantes: valor añadido','Paquete Familiar','Kerala',1000,'Wi-Fi gratuito, servicio gratuito de recogida y entrega,','Visita la presa Matupetty, la plantación de té y un jardín de especias | Ver la puesta de sol en Kanyakumari | Coche con aire acondicionado a disposición durante 2 horas adicionales (una vez por ciudad)','images (2).jpg','2023-07-28 00:45:58',NULL),(5,'Viaje corto a Dubai','Familia','Dubai',4500,'Servicio gratuito de recogida y entrega, Wi-Fi gratuito, Desayuno gratuito','Un paquete de vacaciones para toda la familia.','unnamed.jpg','2023-07-31 00:49:13','2023-09-26 15:11:32');

/*Table structure for table `tblusers` */

DROP TABLE IF EXISTS `tblusers`;

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `MobileNumber` char(10) DEFAULT NULL,
  `EmailId` varchar(70) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `EmailId` (`EmailId`),
  KEY `EmailId_2` (`EmailId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tblusers` */

insert  into `tblusers`(`id`,`FullName`,`MobileNumber`,`EmailId`,`Password`,`RegDate`,`UpdationDate`) values (2,'User Rec','9871987979','user@mail.com','ee11cbb19052e40b07aac0ca060c23ee','2020-07-08 01:33:56',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
