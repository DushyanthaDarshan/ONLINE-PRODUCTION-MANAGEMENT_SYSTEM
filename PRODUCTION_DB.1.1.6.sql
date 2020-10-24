-- MySQL dump 10.9
--
-- Host: localhost    Database: production_db
-- ------------------------------------------------------
-- Server version	4.1.19-community-nt

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE DATABASE IF NOT EXISTS production_db;

--
-- Table structure for table `comments`
--

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `USER_ID` bigint(20) NOT NULL auto_increment,
  `USER_TYPE` varchar(45) NOT NULL default '',
  `USERNAME` varchar(200) NOT NULL default '',
  `PASSWD` varchar(20) NOT NULL default '',
  `F_NAME` varchar(255) NOT NULL default '',
  `NIC` varchar(20) default NULL,
  `PHONE_NUMBER` varchar(20) NOT NULL default '',
  `U_ADDRESS` varchar(255) default NULL,
  `COUNTRY` varchar(100) NOT NULL default '',
  `EMAIL` varchar(100) NOT NULL default '',
  `U_STATUS` varchar(45) NOT NULL default '',
  `CREATED_TIMESTAMP` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
LOCK TABLES `user` WRITE;
INSERT INTO `user` VALUES (1,'ADMIN','dushyantha1208@gmail.com','dushda','Dushyantha Darshan Rubasinghe','971002010V','0778120192','Piliyandala','Sri Lanka','ACTIVE','',''),(2,'ADMIN','dush@gmail.com','123','Darshan','971005510V','0778120192','Piliyandala','Sri Lanka','ACTIVE','',''),(3,'ADMIN','dusha','111','Darshana','9715510V','0778120192','Piliyandala','Sri Lanka','dd@gmail.com','ACTIVE',''),(4,'ADMIN','dushan','222','rubasinghe','97150V','0778120192','Piliyandala','Sri Lanka','d@gmail.com','ACTIVE',''),(5,'ADMIN','dushan','222','rubasinghe','97150V','0778120192','Piliyandala','Sri Lanka','d@gmail.com','ACTIVE',''),(6,'ADMIN','dushan','222','rubasinghe','97150V','0778120192','Piliyandala','Sri Lanka','d@gmail.com','ACTIVE',''),(7,'ADMIN','dushan','222','rubasinghe','97150V','0778120192','Piliyandala','Sri Lanka','d@gmail.com','ACTIVE',''),(8,'ADMIN','dushant','222','rubasingh','971520V','0778120192','Piliyandala','Sri Lanka','d1@gmail.com','ACTIVE',''),(9,'Customer','9','222','rubasingh','971520V','0778120192','Piliyandala','Sri Lanka','d1@gmail.com','ACTIVE',''),(10,'Customer','10','222','rubasingh','971520V','0778120192','Piliyandala','Sri Lanka','d1@gmail.com','ACTIVE',''),(11,'sales','11','11','11','11','0778120192','Piliyandala','Sri Lanka','d1@gmail.com','ACTIVE',''),(12,'Sales Agent','12','12','12','12','12','12','12','d1@gmail.com','ACTIVE',''),(14,'Customer','ddr','123','Darshan','null','null','null','Sri Lanka','ddr@gmail.com','ACTIVE',''),(15,'Customer','17','17','17','null','null','null','17','17','ACTIVE','07/08/2020 10:08:21'),(16,'Customer','18','18','18','null','null','null','18','18','ACTIVE','07/08/2020 10:08:56'),(17,'Customer','19','19','19','null','null','null','19','19','ACTIVE','07/08/2020 11:08:45'),(18,'Customer','22','22','22','null','null','null','22','22','ACTIVE','10/08/2020 02:08:57'),(19,'Customer','24','24','24','null','null','null','24','24','ACTIVE','12/08/2020 10:08:17'),(26,'ADMIN','29','29','29','29','29','29','29','29','ACTIVE','13/08/2020 01:08:13'),(27,'Sales Agent','30','30','30','30','30','30','30','30','ACTIVE','13/08/2020 02:08:33'),(28,'ADMIN','31','31','31','31','31','31','31','31','ACTIVE','13/08/2020 05:08:07'),(34,'ADMIN','uoc','uoc','University Of Colombo','1000000000V','0112666555','Colombo','Sri Lanka','uoc@gmail.com','ACTIVE','06/10/2020 05:10:49'),(35,'Supplier','chan','chan','Chandeepa','9752845698V','0714445556','Galle','Sri Lanka','chan@gmail.com','ACTIVE','08/10/2020 05:10:57');
UNLOCK TABLES;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `COMMENT_ID` bigint(20) NOT NULL auto_increment,
  `COMMENT_NAME` varchar(255) NOT NULL default '',
  `USER_ID` bigint(20) NOT NULL default '0',
  `EXPERIENCE` varchar(100) default NULL,
  PRIMARY KEY  (`COMMENT_ID`),
  CONSTRAINT `FK_comments_USER` FOREIGN KEY (`COMMENT_ID`) REFERENCES `user` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--


/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
LOCK TABLES `comments` WRITE;
INSERT INTO `comments` VALUES (1,'Great',0,'verygood'),(2,'Great',0,'verygood'),(3,'Great',0,'verygood'),(4,'Great!!!!',1,'verygood'),(5,'Superb',1,'verygood'),(6,'Superb',1,'verygood'),(7,'Superb',1,'verygood'),(8,'Superb',1,'verygood'),(9,'Superb',1,'verygood'),(10,'Superb',1,'verygood'),(11,'Superb',1,'verygood'),(12,'Superb',1,'verygood');
UNLOCK TABLES;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `PRODUCT_ID` bigint(20) NOT NULL auto_increment,
  `PRODUCT_TYPE` varchar(80) NOT NULL default '',
  `PRODUCT_NAME` varchar(100) NOT NULL default '',
  `PRODUCT_SIZE` varchar(45) NOT NULL default '',
  `PRICE` varchar(10) default NULL,
  `PRODUCT_DESCRIPTION` varchar(255) default NULL,
  `PRODUCT_STATUS` varchar(45) default NULL,
  `CREATED_TIMESTAMP` varchar(45) NOT NULL default '',
  `PRODUCT_CODE` varchar(15) NOT NULL default '',
  `IMG` varchar(100) default NULL,
  PRIMARY KEY  (`PRODUCT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--


/*!40000 ALTER TABLE `products` DISABLE KEYS */;
LOCK TABLES `products` WRITE;
INSERT INTO `products` VALUES (1,'Jam','Strawberry Jam','250 g','Rs.280.00','test1','ACTIVE','14/08/2020 10:08:38','**021','imgs/Jam/str_jam.jpg'),(2,'Jam','Mango Jam','250 g','Rs.250.00','favourite','ACTIVE','14/08/2020 11:08:04','**001','imgs/Jam/mangoe_jam.jpg'),(3,'Jam','Wood apple Jam','250 g','Rs.200.00','Abc','ACTIVE','','**002','imgs/Jam/wood_jam.jpg'),(4,'4','4','4','4','DEACTIVE','DEACTIVE','14/08/2020 09:08:34','**003',NULL),(5,'8','8','8','8','8','DEACTIVE','15/08/2020 07:08:07','**005',NULL),(6,'Fruit Juice','Mangoe Juice','500 ml','Rs.150.00','cde','ACTIVE','','**005','imgs/Juice/mangoe_juice.jpg'),(7,'Fruit Juice','Mixed Fruit Juice','500 ml','Rs.250.00','cdef','ACTIVE','','**006','imgs/Juice/mixed1.jpg'),(8,'Fruit Juice','Papaya Juice','500 ml','Rs.180.00','papaya','ACTIVE','','**007','imgs/Juice/papaya.jpg'),(9,'Sauce','Tomatoe Sauce','250 g','Rs.250.00','a','ACTIVE','','**010','imgs/Sauce/tomatoe.jpg'),(10,'Sauce','Chilli Sauce','250 g','Rs.220.00','sau2','ACTIVE','','**011','imgs/Sauce/chilli.jpg'),(11,'Sauce','Garlic Sauce','250 g','Rs.300.00','sau3','ACTIVE','','**012','imgs/Sauce/garlic.jpg'),(12,'Chuttney','Tomatooe Chuttney','200 g','Rs.250.00','chut1','ACTIVE','','**013','imgs/Chuttney/mangoe.jpg'),(13,'Chuttney','Chilli Chuttney','200 g','Rs.220.00','chut2','ACTIVE','','**014','imgs/Chuttney/chilli.jpg'),(14,'Chuttney','Mint Chuttney','200 g','Rs.300.00','chut3','ACTIVE','','**015','imgs/Chuttney/mint.jpg'),(15,'Biscuits','Chocolate Biscuit','100 g','Rs.70.00','bis1','ACTIVE','','**016','imgs/Biscuits/chocolate.jpg'),(16,'Biscuits','Ginger Biscuit','100 g','Rs.60.00','bis2','ACTIVE','','**017','imgs/Biscuits/ginger.jpg'),(17,'Biscuits','Peanut Biscuit','100 g','Rs.150.00','bis3','ACTIVE','','**018','imgs/Biscuits/peanut.jpg');
UNLOCK TABLES;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `M_ID` bigint(20) NOT NULL auto_increment,
  `M_CODE` varchar(20) NOT NULL default '',
  `M_NAME` varchar(100) NOT NULL default '',
  `ALL_Q` int(10) default NULL,
  `AVAILABLE_Q` int(10) default NULL,
  `M_STATUS` varchar(50) default NULL,
  `USED_Q` int(10) default NULL,
  `PENDING_USE_Q` int(10) default NULL,
  `CREATED_BY` varchar(45) default NULL,
  `CREATED_TIMESTAMP` varchar(45) default NULL,
  `UPDATED_BY` varchar(45) default NULL,
  `UPDATED_TIMESTAMP` varchar(45) default NULL,
  `USER_ID` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`M_ID`),
  CONSTRAINT `FK_stock_1` FOREIGN KEY (`M_ID`) REFERENCES `user` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--


/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
LOCK TABLES `stock` WRITE;
INSERT INTO `stock` VALUES (1,'**500','A',100,100,'A',100,100,'DUSH','AAAA',NULL,NULL,0),(2,'**501','Mangoes',0,500,'Surplus',100,100,'dushyantha1208@gmail.com','09/10/2020 10:10:43',NULL,NULL,1),(3,'**502','Strawberry',0,200,'Ready to Pick',10,100,'dushyantha1208@gmail.com','09/10/2020 11:10:52',NULL,NULL,34),(4,'**504','Watermelon',50,100,'Available',0,35,'Dushyantha','2020-10-09 14:20:45',NULL,NULL,35);
UNLOCK TABLES;
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;