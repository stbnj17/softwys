

CREATE TABLE `cart` (
  `cartid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `qty` double NOT NULL,
  PRIMARY KEY (`cartid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO category VALUES("1","Laptops");
INSERT INTO category VALUES("2","Desktop PC's");
INSERT INTO category VALUES("3","Tablets");



CREATE TABLE `customer` (
  `userid` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `contact` varchar(50) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO customer VALUES("2","Neovic Devierte","Silay City, Negros Occidental","09092735719");



CREATE TABLE `inventory` (
  `inventoryid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `inventory_date` datetime NOT NULL,
  PRIMARY KEY (`inventoryid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO inventory VALUES("1","2","Purchase","4","10","2017-09-18 09:32:01");
INSERT INTO inventory VALUES("2","2","Purchase","20","10","2017-09-18 09:32:01");
INSERT INTO inventory VALUES("3","2","Purchase","1","99","2017-09-18 09:32:01");
INSERT INTO inventory VALUES("4","2","Purchase","2","20","2017-09-18 09:32:01");
INSERT INTO inventory VALUES("5","2","Purchase","2","10","2017-09-18 09:34:29");
INSERT INTO inventory VALUES("6","2","Purchase","2","10","2017-09-18 11:09:21");
INSERT INTO inventory VALUES("7","2","Purchase","3","12","2017-09-18 11:09:22");
INSERT INTO inventory VALUES("8","2","Purchase","4","8","2017-09-18 11:09:22");
INSERT INTO inventory VALUES("9","1","Add Product","27","10","2017-09-18 13:59:25");
INSERT INTO inventory VALUES("10","1","Update quantity","27","20","2017-09-18 14:04:32");
INSERT INTO inventory VALUES("11","1","Purchase","2","1","2017-10-06 11:21:53");
INSERT INTO inventory VALUES("12","1","Purchase","8","3","2017-10-06 11:23:41");



CREATE TABLE `product` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_price` double NOT NULL,
  `product_qty` double NOT NULL,
  `photo` varchar(200) NOT NULL,
  `supplierid` int(11) NOT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO product VALUES("1","1","DELL Inspiron 15 7000 15.6","899","891","upload/1.jpg","4");
INSERT INTO product VALUES("2","1","MICROSOFT Surface Pro 4 & Typecover - 128 GB
","799","947","upload/2.jpg","0");
INSERT INTO product VALUES("3","2","DELL Inspiron 15 5000 15.6","599","977","upload/3.jpg","4");
INSERT INTO product VALUES("4","1","LENOVO Ideapad 320s-14IKB 14" Laptop - Grey","399","982","upload/4.jpg","0");
INSERT INTO product VALUES("5","1","APPLE MacBook Air 13.3" (2017)","879","9900","upload/5.jpg","0");
INSERT INTO product VALUES("6","1","DELL Inspiron 15 5000 15","449.99","1000","upload/6.jpg","4");
INSERT INTO product VALUES("8","1","ASUS Transformer Mini T102HA 10.1" 2 in 1 - Silver","549.99","997","upload/8.jpg","0");
INSERT INTO product VALUES("9","2","PC SPECIALIST Vortex Core Lite Gaming PC","599.99","1000","upload/9.jpg","0");
INSERT INTO product VALUES("10","2","DELL Inspiron 5675 Gaming PC - Recon Blue","599.99","1000","upload/10.jpg","4");
INSERT INTO product VALUES("11","2","HP Barebones OMEN X 900-099nn Gaming PC","489.98","1000","upload/11.jpg","0");
INSERT INTO product VALUES("12","2","ACER Aspire GX-781 Gaming PC","749.99","1000","upload/12.jpg","4");
INSERT INTO product VALUES("13","2","HP Pavilion Power 580-015na Gaming PC","799.99","1000","upload/13.jpg","0");
INSERT INTO product VALUES("14","2","LENOVO Legion Y520 Gaming PC","899.99","1000","upload/14.jpg","0");
INSERT INTO product VALUES("15","2","PC SPECIALIST Vortex Minerva XT-R Gaming PC","999.99","1000","upload/15.jpg","0");
INSERT INTO product VALUES("16","2","C SPECIALIST Vortex Core II Gaming PC","649.99","1000","upload/16.jpg","0");
INSERT INTO product VALUES("17","3","AMAZON Fire 7 Tablet with Alexa (2017) - 8 GB, Black","49.99","1000","upload/17.jpg","0");
INSERT INTO product VALUES("18","3","AMAZON Fire HD 8 Tablet with Alexa (2017) - 16 GB, Black","79.99","1000","upload/18.jpg","0");
INSERT INTO product VALUES("19","3","AMAZON Fire HD 8 Tablet with Alexa (2017) - 32 GB, Black","99.99","1000","upload/19.jpg","0");
INSERT INTO product VALUES("20","3","APPLE 9.7" iPad - 32 GB, Space Grey","339","990","upload/20.jpg","0");
INSERT INTO product VALUES("21","3","APPLE 9.7" iPad - 32 GB, Gold","339","1000","upload/21.jpg","0");
INSERT INTO product VALUES("22","3","APPLE 10.5" iPad Pro - 64 GB, Space Grey (2017)","619","1000","upload/22.jpg","0");



CREATE TABLE `sales` (
  `salesid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `sales_total` double NOT NULL,
  `sales_date` datetime NOT NULL,
  PRIMARY KEY (`salesid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO sales VALUES("1","2","34","2017-09-16 16:23:38");
INSERT INTO sales VALUES("2","2","18","2017-09-16 16:25:28");
INSERT INTO sales VALUES("3","2","6","2017-09-16 16:27:31");
INSERT INTO sales VALUES("4","2","1014244","2017-09-16 16:44:01");
INSERT INTO sales VALUES("5","2","9588","2017-09-18 09:06:29");
INSERT INTO sales VALUES("6","2","88779","2017-09-18 09:08:42");
INSERT INTO sales VALUES("7","2","15579","2017-09-18 09:09:34");
INSERT INTO sales VALUES("8","2","112361","2017-09-18 09:32:00");
INSERT INTO sales VALUES("9","2","7990","2017-09-18 09:34:29");
INSERT INTO sales VALUES("10","2","18370","2017-09-18 11:09:21");
INSERT INTO sales VALUES("11","1","799","2017-10-06 11:21:53");
INSERT INTO sales VALUES("12","1","1649.97","2017-10-06 11:23:41");



CREATE TABLE `sales_detail` (
  `sales_detailid` int(11) NOT NULL AUTO_INCREMENT,
  `salesid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `sales_qty` double NOT NULL,
  PRIMARY KEY (`sales_detailid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO sales_detail VALUES("1","2","1","12");
INSERT INTO sales_detail VALUES("2","2","2","10");
INSERT INTO sales_detail VALUES("3","3","3","11");
INSERT INTO sales_detail VALUES("4","4","2","50");
INSERT INTO sales_detail VALUES("5","4","1","106");
INSERT INTO sales_detail VALUES("6","4","5","1000");
INSERT INTO sales_detail VALUES("7","5","2","12");
INSERT INTO sales_detail VALUES("8","6","5","101");
INSERT INTO sales_detail VALUES("9","7","1","10");
INSERT INTO sales_detail VALUES("10","7","3","11");
INSERT INTO sales_detail VALUES("11","8","4","10");
INSERT INTO sales_detail VALUES("12","8","20","10");
INSERT INTO sales_detail VALUES("13","8","1","99");
INSERT INTO sales_detail VALUES("14","8","2","20");
INSERT INTO sales_detail VALUES("15","9","2","10");
INSERT INTO sales_detail VALUES("16","10","2","10");
INSERT INTO sales_detail VALUES("17","10","3","12");
INSERT INTO sales_detail VALUES("18","10","4","8");
INSERT INTO sales_detail VALUES("19","11","2","1");
INSERT INTO sales_detail VALUES("20","12","8","3");



CREATE TABLE `supplier` (
  `userid` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_address` varchar(150) NOT NULL,
  `contact` varchar(50) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO supplier VALUES("4","Dell Computer Corporation","One Dell WayRound Rock, Texas 78682","1-800-WWW-DELL");



CREATE TABLE `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `access` int(1) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO user VALUES("1","admin","21232f297a57a5a743894a0e4a801fc3","1");
INSERT INTO user VALUES("2","user","ee11cbb19052e40b07aac0ca060c23ee","2");
INSERT INTO user VALUES("4","supplier","99b0e8da24e29e4ccb5d7d76e677c2ac","3");

