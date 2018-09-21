-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: lankaagri
-- ------------------------------------------------------
-- Server version	5.7.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping data for table `admin_items`
--

LOCK TABLES `admin_items` WRITE;
/*!40000 ALTER TABLE `admin_items` DISABLE KEYS */;
INSERT INTO `admin_items` VALUES (1,'Spinach',1,55.45,'storage/items/dqZMQd2XSxBVZO5ldYPxGOCAZyWlWmnEvTEIJt20.jpeg','2018-09-20 17:12:00','2018-09-20 17:12:00'),(2,'Beetroot - Red',1,120.00,'storage/items/qGBI8O1ZYl3UYD1BWOvcGf3TEtUsRkaGVqTt3KS7.jpeg','2018-09-20 17:25:57','2018-09-20 17:25:57'),(3,'Patrick - Home Brew 250ml',5,265.65,'storage/items/rGCC4FN53a7DbJEHAlnetKG0znRKZs0cPI4F82Zj.jpeg','2018-09-20 17:33:07','2018-09-20 17:33:07');
/*!40000 ALTER TABLE `admin_items` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (5,1,14,1,'2018-09-21 07:12:18','2018-09-21 07:12:18'),(6,1,23,1,'2018-09-21 07:12:20','2018-09-21 07:12:20');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Vegetables',NULL,NULL),(2,'Fruits',NULL,NULL),(4,'Pastries','2018-09-20 17:30:00','2018-09-20 17:30:00'),(5,'Brews','2018-09-20 17:30:20','2018-09-20 17:30:20'),(6,'Wines','2018-09-20 17:30:25','2018-09-20 17:30:25');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,2,'Pineapple - Regular','storage/items/g1.jpg',2,488,340.41,8.48,391.21,'in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer',1,0,'2018-06-04 03:27:17','2018-05-17 03:39:11'),(2,1,'Monkfish - Fresh','storage/items/g1.jpg',1,465,31.55,9.39,292.90,'dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper',1,0,'2017-12-22 01:48:43','2018-09-21 05:42:27'),(3,1,'Red Currant Jelly','storage/items/g1.jpg',1,158,467.52,11.15,211.47,'integer aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan tellus',1,0,'2018-09-08 21:22:56','2018-09-21 05:42:44'),(4,3,'Cheese - Manchego, Spanish','storage/items/g1.jpg',1,406,412.41,5.31,336.93,'diam erat fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis eget elit',1,0,'2017-08-04 19:35:07','2018-09-21 05:48:30'),(5,3,'Sugar - Brown','storage/items/g1.jpg',1,425,66.93,9.75,445.13,'vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel',1,0,'2018-01-03 16:29:15','2017-11-08 21:02:58'),(6,2,'Wasabi Paste','storage/items/g1.jpg',2,33,344.04,16.26,298.79,'eros vestibulum ac est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl',0,0,'2017-11-05 16:09:55','2017-08-07 06:29:07'),(7,2,'Cheese - La Sauvagine','storage/items/g1.jpg',2,120,121.72,18.62,234.95,'posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam sit amet diam in magna bibendum',1,0,'2017-12-02 17:22:42','2018-09-20 11:16:11'),(8,2,'Squid - U - 10 Thailand','storage/items/g1.jpg',2,360,89.34,13.38,260.08,'ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue',1,0,'2018-05-09 18:07:04','2017-12-25 19:35:46'),(9,3,'Carrots - Mini Red Organic','storage/items/g1.jpg',1,228,84.01,12.37,378.74,'sit amet nulla quisque arcu libero rutrum ac lobortis vel dapibus at diam nam tristique',1,0,'2017-08-08 03:36:10','2018-03-18 00:56:39'),(10,1,'Baby Spinach','storage/items/3Zy0QwmXE1kPMgCbMAAf4iAdu31DXw3lTHFdlpep.jpeg',1,102,340.54,13.97,351.81,'pretium iaculis justo in hac habitasse platea dictumst etiam faucibus',1,0,'2018-05-08 20:06:21','2018-09-21 05:43:10'),(11,1,'Cake - Mini Cheesecake','storage/items/g1.jpg',1,208,331.57,13.19,213.92,'sagittis nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede',1,0,'2018-07-02 19:34:56','2018-09-21 07:26:48'),(12,3,'Compound - Pear','storage/items/g1.jpg',1,149,49.07,15.89,308.36,'curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut',1,0,'2017-10-18 21:30:56','2017-12-10 13:40:38'),(13,1,'Amarula Cream','storage/items/g1.jpg',1,62,376.26,13.70,435.99,'congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut',0,0,'2017-09-03 22:43:02','2018-09-21 05:43:03'),(14,2,'Soup - Chicken And Wild Rice','storage/items/g1.jpg',2,303,235.12,9.87,472.76,'nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros',1,0,'2017-09-02 04:59:56','2018-09-21 05:48:23'),(15,3,'Pineapple - Regular','storage/items/g1.jpg',1,119,122.46,12.24,490.11,'ultrices aliquet maecenas leo odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat',1,0,'2018-06-23 18:02:05','2018-02-23 07:41:06'),(16,3,'Chocolate Bar - Oh Henry','storage/items/g1.jpg',1,329,212.76,14.12,423.63,'nec dui luctus rutrum nulla tellus in sagittis dui vel nisl',1,0,'2017-11-11 22:58:54','2018-01-14 12:01:50'),(17,2,'Pasta - Canelloni','storage/items/g1.jpg',2,53,438.36,9.94,456.74,'eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor',0,0,'2017-07-13 18:05:34','2018-06-04 07:10:59'),(18,1,'Anchovy In Oil','storage/items/g1.jpg',1,461,403.75,12.80,455.60,'aliquet maecenas leo odio condimentum id luctus nec molestie sed justo pellentesque',1,0,'2017-07-04 14:11:31','2018-01-12 08:29:34'),(19,3,'Tomato - Tricolor Cherry','storage/items/g1.jpg',2,472,314.02,5.42,267.20,'donec odio justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis tristique fusce congue',0,0,'2017-07-30 19:25:35','2018-01-02 20:14:36'),(20,2,'Garlic Powder','storage/items/g1.jpg',1,37,162.91,14.69,389.93,'ultrices phasellus id sapien in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl aenean',0,0,'2017-07-23 13:08:01','2018-04-19 08:25:54'),(21,3,'Chives - Fresh','storage/items/g1.jpg',1,110,375.84,18.00,364.61,'in hac habitasse platea dictumst maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut',0,0,'2017-10-31 19:15:47','2018-05-04 01:24:54'),(22,1,'Artichokes - Knobless, White','storage/items/g1.jpg',2,166,474.10,11.21,475.10,'amet diam in magna bibendum imperdiet nullam orci pede venenatis non sodales sed tincidunt eu',0,0,'2018-04-08 01:30:03','2018-09-21 05:43:15'),(23,2,'Bread - Roll, Soft White Round','storage/items/g1.jpg',2,308,56.34,5.37,342.74,'mattis odio donec vitae nisi nam ultrices libero non mattis pulvinar nulla pede ullamcorper augue a suscipit',1,0,'2017-12-12 03:15:58','2018-06-28 14:20:27'),(24,1,'Chinese Foods - Cantonese','storage/items/g1.jpg',1,413,333.54,10.05,217.17,'aliquet maecenas leo odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat',1,1,'2017-07-15 21:40:09','2018-09-20 10:53:13'),(25,1,'Horseradish - Prepared','storage/items/g1.jpg',2,171,462.05,18.60,217.28,'lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique',1,0,'2018-03-08 08:11:03','2018-09-21 08:07:56'),(26,2,'Flour - Bread','storage/items/g1.jpg',2,183,179.13,9.88,291.53,'morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices',0,0,'2018-05-24 12:50:35','2018-09-21 05:48:21'),(27,1,'Island Oasis - Cappucino Mix','storage/items/g1.jpg',1,179,225.37,13.96,431.83,'purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus',1,0,'2018-05-18 22:12:33','2018-09-21 05:42:21'),(28,3,'Bread - White Mini Epi','storage/items/g1.jpg',2,208,242.08,14.85,407.20,'eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis',0,0,'2018-03-01 03:21:05','2018-09-21 05:48:28'),(29,1,'Baby Eggplant','storage/items/g1.jpg',2,457,426.12,10.63,482.69,'sollicitudin vitae consectetuer eget rutrum at lorem',1,0,'2017-07-21 08:22:49','2018-09-21 05:42:40'),(30,1,'Cheese - Valancey','storage/items/g1.jpg',2,352,405.60,11.92,437.39,'bibendum morbi non quam nec dui luctus rutrum nulla tellus',1,0,'2018-01-28 19:16:49','2018-09-20 11:16:11'),(31,1,'testItem','storage/items/ukkjGwOZ0jLY5qadJKw8GMkbjNjmf7MZoqNlwiev.jpeg',1,1,55.00,1.00,1.00,'pretium iaculis justo in hac habitasse platea dictumst etiam faucibus',0,1,'2018-09-20 10:40:27','2018-09-20 10:49:22');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `orderlines`
--

LOCK TABLES `orderlines` WRITE;
/*!40000 ALTER TABLE `orderlines` DISABLE KEYS */;
INSERT INTO `orderlines` VALUES (1,1,30,3,405.60,1071.76,1,'2018-09-20 11:16:11','2018-09-20 11:18:09'),(2,1,7,4,121.72,396.22,1,'2018-09-20 11:16:11','2018-09-20 11:16:11'),(3,2,26,2,179.13,322.86,1,'2018-09-20 17:36:04','2018-09-20 17:36:54'),(4,3,10,10,340.54,2929.67,1,'2018-09-20 17:41:35','2018-09-20 17:41:48'),(5,4,26,3,179.13,484.30,0,'2018-09-21 03:16:24','2018-09-21 03:16:24'),(6,5,25,1,462.05,376.11,0,'2018-09-21 08:07:56','2018-09-21 08:07:56');
/*!40000 ALTER TABLE `orderlines` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,3,1467.98,'2018-09-20 11:16:11','2018-09-20 11:16:11'),(2,1,322.86,'2018-09-20 17:36:04','2018-09-20 17:36:04'),(3,3,2929.67,'2018-09-20 17:41:35','2018-09-20 17:41:35'),(4,1,484.30,'2018-09-21 03:16:24','2018-09-21 03:16:24'),(5,3,376.11,'2018-09-21 08:07:55','2018-09-21 08:07:55');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` VALUES (1,1,'On Delivery','Total Freight Logistics, Elizabeth, Colombo, Western Province','Total Freight Logistics, Elizabeth, Colombo, Western Province','2018-09-20 11:16:11','2018-09-20 11:16:11'),(2,2,'On Delivery','515A/2, Thalgasyaya, Akmeemana, Galle, Galle, Southern Province','515A/2, Thalgasyaya, Akmeemana, Galle, Galle, Southern Province','2018-09-20 17:36:04','2018-09-20 17:36:04'),(3,3,'On Delivery','Total Freight Logistics, Elizabeth, Colombo, Western Province','Total Freight Logistics, Elizabeth, Colombo, Western Province','2018-09-20 17:41:35','2018-09-20 17:41:35'),(4,4,'PayHere','515A/2, Thalgasyaya, Akmeemana, Galle, Galle, Southern Province','515A/2, Thalgasyaya, Akmeemana, Galle, Galle, Southern Province','2018-09-21 03:16:24','2018-09-21 03:16:24'),(5,5,'PayHere','Total Freight Logistics, Elizabeth, Colombo, Western Province','Total Freight Logistics, Elizabeth, Colombo, Western Province','2018-09-21 08:07:56','2018-09-21 08:07:56');
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Amod Sachintha','amod077@gmail.com','$2y$10$Hq4KX8uvCGyV1L.HCArto.le08xpHOJEVDyUHhNQi4p2Gw3XG1aMq','950410663v','0774840329','Southern','Galle','Galle','515A/2, Thalgasyaya, Akmeemana','storage/avatars/JNlbbTBTjfBHkJRyRAZVeMvwVXWUWxBC0Yf2iiBw.jpeg',1,'Bl3TPl0zpzEhvwfechzAJQYcbc3S6kmoeUAZl49iJNT0WjMiLXvYpIr4R788','2018-09-18 05:01:12','2018-09-21 04:56:58'),(2,'Kavindu Madusanka TK','kavindumadusanka@hotmail.com','$2y$10$ElGuJ52SoNxVj53prUwoleiWMSIxmtqxjc1F0txs3DLdbBU50sbCG','951472212v','0913095014','Southern','Galle','Galle','510, Thalgasyaya','storage/avatars/dJ0UPXUNU17d6ogpTOXhcwI2t7tWjeBDocIo1sWg.jpeg',0,'Q2uhWSIb8bzgrt2uPGRcpkKa8qz4b4WEQq0oQBgLPAS9eb6HN3dr6hLSlVxZ','2018-09-18 05:01:43','2018-09-20 19:18:34'),(3,'Nishan Ariyawansa','admin@gmail.com','$2y$10$MJMNJTyReQS34vrCGCil7.mki3eMtxwz2gISS4dHnwdA4DkEUGS5O','950410332v','8882321952','Western','Colombo','Elizabeth','Total Freight Logistics','storage/avatars/3lOjGouWz2Dnr283dv01yCG9EgTVxcMZepYbMVMj.jpeg',0,'ZuItinWjW6Fjdl7hlFdKCerD0BScEpLoOb4Sg85ujznwHigk1F0QsiB7HdWM','2018-09-18 05:02:29','2018-09-20 19:15:26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-21 13:53:28
