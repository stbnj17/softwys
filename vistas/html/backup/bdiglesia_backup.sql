

CREATE TABLE `antecedentes` (
  `id_ant` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `alergias_ant` text NOT NULL,
  `enfermedades_ant` text NOT NULL,
  `vacunas_ant` text NOT NULL,
  `quirurgico_ant` text NOT NULL,
  PRIMARY KEY (`id_ant`),
  KEY `id_paciente` (`id_paciente`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

INSERT INTO antecedentes VALUES("1","1","","","","");
INSERT INTO antecedentes VALUES("2","2","","","","");
INSERT INTO antecedentes VALUES("3","3","Prueba de datos x","Prueba de datos xx","Prueba de datos xxx","Prueba de datos xxxx");
INSERT INTO antecedentes VALUES("4","1","","","","");
INSERT INTO antecedentes VALUES("5","2","","","","");
INSERT INTO antecedentes VALUES("6","3","Prueba de datos x","Prueba de datos xx","Prueba de datos xxx","Prueba de datos xxxx");
INSERT INTO antecedentes VALUES("7","4","","","","");
INSERT INTO antecedentes VALUES("8","5","","","","");
INSERT INTO antecedentes VALUES("9","6","","","","");
INSERT INTO antecedentes VALUES("10","7","","","","");
INSERT INTO antecedentes VALUES("11","8","","","","");
INSERT INTO antecedentes VALUES("12","9","","","","");
INSERT INTO antecedentes VALUES("13","10","","","","");
INSERT INTO antecedentes VALUES("14","11","","","","");
INSERT INTO antecedentes VALUES("15","12","","","","");
INSERT INTO antecedentes VALUES("16","13","","","","");
INSERT INTO antecedentes VALUES("17","14","Prueba de Datos","Prueba de datos","Prueba de datos","Prueba de datos");
INSERT INTO antecedentes VALUES("18","15","","","","");
INSERT INTO antecedentes VALUES("19","16","","","","");
INSERT INTO antecedentes VALUES("20","17","","","","");
INSERT INTO antecedentes VALUES("21","18","","","","");
INSERT INTO antecedentes VALUES("22","19","","","","");
INSERT INTO antecedentes VALUES("23","20","","","","");
INSERT INTO antecedentes VALUES("24","21","","","","");
INSERT INTO antecedentes VALUES("25","22","Prueba de antecedentes personales x","Prueba de antecedentes personales xx","Prueba de antecedentes personales xxx","Prueba de antecedentes personales xxxx");
INSERT INTO antecedentes VALUES("26","23","","","","");
INSERT INTO antecedentes VALUES("27","24","","","","");
INSERT INTO antecedentes VALUES("28","0","","","","");
INSERT INTO antecedentes VALUES("29","25","","","","");
INSERT INTO antecedentes VALUES("30","26","","","","");
INSERT INTO antecedentes VALUES("31","27","","","","");
INSERT INTO antecedentes VALUES("32","28","","","","");



CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cargo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `estado_cargo` varchar(11) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO cargo VALUES("6","prueba","1");



CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(255) NOT NULL,
  `descripcion_categoria` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO categorias VALUES("2","Lamparas","Lamparas","2017-07-27 23:40:14");
INSERT INTO categorias VALUES("3","Bombillas","Bombillas","2017-07-27 23:40:32");



CREATE TABLE `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `precision` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thousand_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `decimal_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

INSERT INTO currencies VALUES("1","US Dollar","$","2",",",".","USD");
INSERT INTO currencies VALUES("2","Libra Esterlina","&pound;","2",",",".","GBP");
INSERT INTO currencies VALUES("3","Euro","â‚¬","2",".",",","EUR");
INSERT INTO currencies VALUES("4","South African Rand","R","2",".",",","ZAR");
INSERT INTO currencies VALUES("5","Danish Krone","kr ","2",".",",","DKK");
INSERT INTO currencies VALUES("6","Israeli Shekel","NIS ","2",",",".","ILS");
INSERT INTO currencies VALUES("7","Swedish Krona","kr ","2",".",",","SEK");
INSERT INTO currencies VALUES("8","Kenyan Shilling","KSh ","2",",",".","KES");
INSERT INTO currencies VALUES("9","Canadian Dollar","C$","2",",",".","CAD");
INSERT INTO currencies VALUES("10","Philippine Peso","P ","2",",",".","PHP");
INSERT INTO currencies VALUES("11","Indian Rupee","Rs. ","2",",",".","INR");
INSERT INTO currencies VALUES("12","Australian Dollar","$","2",",",".","AUD");
INSERT INTO currencies VALUES("13","Singapore Dollar","SGD ","2",",",".","SGD");
INSERT INTO currencies VALUES("14","Norske Kroner","kr ","2",".",",","NOK");
INSERT INTO currencies VALUES("15","New Zealand Dollar","$","2",",",".","NZD");
INSERT INTO currencies VALUES("16","Vietnamese Dong","VND ","0",".",",","VND");
INSERT INTO currencies VALUES("17","Swiss Franc","CHF ","2","'",".","CHF");
INSERT INTO currencies VALUES("18","Quetzal Guatemalteco","Q","2",",",".","GTQ");
INSERT INTO currencies VALUES("19","Malaysian Ringgit","RM","2",",",".","MYR");
INSERT INTO currencies VALUES("20","Real Brasile&ntilde;o","R$","2",".",",","BRL");
INSERT INTO currencies VALUES("21","Thai Baht","THB ","2",",",".","THB");
INSERT INTO currencies VALUES("22","Nigerian Naira","NGN ","2",",",".","NGN");
INSERT INTO currencies VALUES("23","Peso Argentino","$","2",".",",","ARS");
INSERT INTO currencies VALUES("24","Bangladeshi Taka","Tk","2",",",".","BDT");
INSERT INTO currencies VALUES("25","United Arab Emirates Dirham","DH ","2",",",".","AED");
INSERT INTO currencies VALUES("26","Hong Kong Dollar","$","2",",",".","HKD");
INSERT INTO currencies VALUES("27","Indonesian Rupiah","Rp","2",",",".","IDR");
INSERT INTO currencies VALUES("28","Peso Mexicano","$","2",",",".","MXN");
INSERT INTO currencies VALUES("29","Egyptian Pound","&pound;","2",",",".","EGP");
INSERT INTO currencies VALUES("30","Peso Colombiano","$","2",".",",","COP");
INSERT INTO currencies VALUES("31","West African Franc","CFA ","2",",",".","XOF");
INSERT INTO currencies VALUES("32","Chinese Renminbi","RMB ","2",",",".","CNY");



CREATE TABLE `egresos` (
  `id_egreso` int(11) NOT NULL AUTO_INCREMENT,
  `referencia_egreso` varchar(100) NOT NULL,
  `monto` double NOT NULL,
  `descripcion_egreso` text NOT NULL,
  `tipo_egreso` int(11) NOT NULL,
  `fecha_added` date NOT NULL,
  `fecha` datetime NOT NULL,
  `users` int(11) NOT NULL,
  PRIMARY KEY (`id_egreso`),
  KEY `users` (`users`),
  CONSTRAINT `egresos_ibfk_1` FOREIGN KEY (`users`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO egresos VALUES("1","12400021","200","PARA USO DEL TRANSPORTE DE LA IGLESIA","2","2018-01-25","0000-00-00 00:00:00","1");
INSERT INTO egresos VALUES("2","7897400012","150","PARA EL ESTUDIO DE GRUPOS PEQUEÑOS","8","2018-01-25","0000-00-00 00:00:00","1");
INSERT INTO egresos VALUES("3","96000144","300","MATERIA PRIMA ","7","2018-01-25","0000-00-00 00:00:00","1");
INSERT INTO egresos VALUES("4","402100254","600","PAGO DE CUOTA DE LOCAL DE LA IGLESIA","1","2018-01-25","0000-00-00 00:00:00","1");
INSERT INTO egresos VALUES("5","1210012","200","PARA GRUPOS PEQUEÑOS","8","2018-01-27","0000-00-00 00:00:00","1");
INSERT INTO egresos VALUES("6","6482000283","50","","2","2018-04-01","2018-04-12 11:09:44","1");
INSERT INTO egresos VALUES("7","4839299","100","","7","2018-04-08","2018-04-12 11:27:25","1");
INSERT INTO egresos VALUES("8","123456","200","","7","2018-07-23","2018-07-23 23:44:49","1");
INSERT INTO egresos VALUES("9","123457","18.5","","6","2018-07-24","2018-07-24 00:21:24","1");
INSERT INTO egresos VALUES("10","123458","375","","2","2018-07-24","2018-07-24 00:22:09","1");



CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO events VALUES("1","REUNION DE JOVES 2018","#FFD700","2018-01-25 00:00:00","2018-01-26 00:00:00","1");
INSERT INTO events VALUES("2","REUNION DE ANCIANOS ","#FF0000","2018-01-27 00:00:00","2018-01-28 00:00:00","1");



CREATE TABLE `ingresos` (
  `id_ingreso` int(11) NOT NULL AUTO_INCREMENT,
  `obs_ingreso` varchar(255) NOT NULL,
  `ref_ingreso` varchar(100) NOT NULL,
  `monto` double NOT NULL,
  `tipo_ingreso` int(11) NOT NULL,
  `pago_ingreso` int(11) NOT NULL,
  `fecha_added` date NOT NULL,
  `fecha` datetime NOT NULL,
  `users` int(11) NOT NULL,
  PRIMARY KEY (`id_ingreso`),
  KEY `users` (`users`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO ingresos VALUES("1","ESTA ES UNA PRUEBA DE DATOS","OFD-000001","65","2","1","2018-01-24","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("2","","OFD-000002","150","2","1","2018-01-24","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("3","","8","55","1","1","2018-01-24","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("4","","26","75","1","1","2018-01-24","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("5","","24","35","1","1","2018-01-24","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("7","CUANTA DE LA IGLESIA","OFD-000003","100","2","3","2018-01-24","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("8","","19","150","1","2","2018-01-24","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("9","","OFD-000004","65","2","1","2018-01-25","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("10","","11","125","1","1","2018-01-25","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("11","","OFD-000005","28","2","1","2018-01-25","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("12","","8","145","1","1","2018-01-25","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("13","","OFD-000006","75","2","1","2018-01-27","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("14","","28","150","1","1","2018-01-27","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("15","","OFD-000007","200","3","1","2018-02-18","0000-00-00 00:00:00","1");
INSERT INTO ingresos VALUES("16","","OFD-000007","100","2","1","2018-04-14","2018-04-14 10:58:15","1");
INSERT INTO ingresos VALUES("17","","14","400","1","1","2018-07-23","2018-07-23 12:10:36","1");
INSERT INTO ingresos VALUES("18","","OFD-000008","130","2","1","2018-07-23","2018-07-23 23:37:18","1");
INSERT INTO ingresos VALUES("19","","OFD-000009","120","3","1","2018-07-23","2018-07-23 23:37:56","1");
INSERT INTO ingresos VALUES("20","","OFD-000009","300","4","1","2018-07-23","2018-07-23 23:38:18","1");
INSERT INTO ingresos VALUES("21","","8","65","1","1","2018-07-23","2018-07-23 23:42:08","1");



CREATE TABLE `miembros` (
  `id_miembro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_miembro` varchar(255) NOT NULL,
  `apellido_miembro` varchar(255) NOT NULL,
  `direccion_miembro` text NOT NULL,
  `telefono_miembro` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `documento_miembro` varchar(50) NOT NULL,
  `email_miembro` varchar(255) NOT NULL,
  `sexo_miembro` int(11) NOT NULL,
  `estado_miembro` int(11) NOT NULL,
  `date_addedd` datetime NOT NULL,
  PRIMARY KEY (`id_miembro`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

INSERT INTO miembros VALUES("1"," ALMORIN ELDER ","TORREJON ELDER ","CALLE PIURA 336 - PUNCHANA - MAYNAS","065-252023","1992-02-28","65-965604491","eldercin99@hotmail.com","1","1","2017-09-01 08:51:54");
INSERT INTO miembros VALUES("2","LUZ GLORIA "," AQUINO MOSQUERA","JR. LORETO 363 - HUANCAYO","064-216155","1985-06-02","064-964311643","rarba21@yahoo.es","1","1","2017-09-01 08:53:27");
INSERT INTO miembros VALUES("3","JOSÉ PABLO","CASTRO LOPEZ","URB. LEONCIO ELIAS ARBOLERA F11 - CATACAOS - PIURA ","073-284600","1989-06-12","073-969712459","castro@regionpiura.gob.pe","1","1","2017-09-01 08:54:43");
INSERT INTO miembros VALUES("4"," JESUS MANUEL ","ESPINOZA LUGO","JR. JUNIN 415 - HUANUCO ","062-513821","1986-05-23","962689545","regerep1@hotmail.com","1","1","2017-09-01 08:56:01");
INSERT INTO miembros VALUES("6"," BEBERLI","GONZALES DE OLIVEIRA","Cornejo Portugal 2319 - Belen - Iquitos","065-06226061","1986-07-31","965995999","beberlilj@hotmail.com","1","1","2017-09-01 08:58:55");
INSERT INTO miembros VALUES("7","HUAMAN SURCO","MARIO ","JR. LAS PONAS A15 - TAMBOPATA ","082-573405","1998-12-31","982782419","marius_mhs@hotmail.com","1","1","2017-09-01 09:00:07");
INSERT INTO miembros VALUES("8"," LUIS EDGARDO","LEÓN LEÓN","Urb. La alameda Santa Teresa de Journet s/n - Cajamarca","076-345822","1999-02-02","976327162","luedlele@hotmail.com","1","1","2017-09-01 09:01:57");
INSERT INTO miembros VALUES("9","ROCÍO ZOILA","LÓPEZ VERA","Av. San Borja Sur 406 - San Borja","054-461964","1978-05-24","4756000","rlopezv@indeci.gob.pe","1","1","2017-09-01 09:03:28");
INSERT INTO miembros VALUES("10"," MÓNICA MAGDALENA","MENDIOLA CHAVEZ","Ernesto Cardenas 123 Dpto 201 - Surco","617-7177","1994-11-18","998617176","monicamendiola@gmail.com","1","1","2017-09-01 09:05:00");
INSERT INTO miembros VALUES("11","MARÍA KELLY","YARLEQUÉ ALBERCA","Av. Salaverry 1295 - Chiclayo","074-692129","1984-08-13","978028029","erlley_kya@hotmail.com","1","1","2017-09-01 09:06:49");
INSERT INTO miembros VALUES("12","CARLOS ANTONIO","PAREDES ARANDA","Jr. Villanueva 1017 - Huaraz","043-426099","1972-12-25","943751928","capa__01@hotmail.com","1","1","2017-09-01 09:08:52");
INSERT INTO miembros VALUES("13","JOSE RONALD","PALOMINO ARONI","Av. Cutervo 920 - Ica","056-212846","1990-09-14","956060910","gobel11@hotmail.com","1","1","2017-09-01 09:10:44");
INSERT INTO miembros VALUES("14","JUAN CARLOS","PINTO MALAGA","Av. Ricardo Palma 324 - Paucarpata - arequipa","054-201050","1995-08-21","959915801","jcpintom5@hotmail.com","1","1","2017-09-02 21:47:48");
INSERT INTO miembros VALUES("15","ARCE PÉREZ ","ISAAC","Carretera Yurimaguas Nº 408 Banda Shilcayo - Tarapoto","(042)-522-985","1985-08-21","705914","region_sanmartin@indeci.gob.pe","1","1","2017-09-06 23:49:59");
INSERT INTO miembros VALUES("16","JOSÉ CARLOS","ECHE LLENQUE","Av. Ricardo Angulo 695 - San isidro","2259898","1985-06-28","951247-7","region_sanmartin@indeci.gob.pe","1","1","2017-09-06 23:52:02");
INSERT INTO miembros VALUES("19","DELMAR RAMON","LOPEZ","Santiago de Maria","74823030","1986-01-01","1593","delmarlopez2006@hotmail.com","1","1","2017-09-07 00:01:56");
INSERT INTO miembros VALUES("20","RAMON RODRIGUEZ ","MAGAÑA","CARRETERA CHAMPOTON-ISLA AGUADA KM 2, COLONIA EL ARENAL C.P. 24400, CHAMPOTON, CAMPECHE ","982-828-24-32","1992-02-12","ITS0001","direccion@itescham.edu.mx","1","1","2017-09-10 20:39:57");
INSERT INTO miembros VALUES("21","LUIS ARMANDO","OFFICER ARTEAGA","CARRETERA CHAMPOTON-ISLA AGUADA KM 2, COLONIA EL ARENAL C.P. 24400, CHAMPOTON, CAMPECHE","982-828-24-32","1986-05-02","ITS0002","subdireccionadmva@itescham.edu.mx","1","1","2017-09-10 20:41:34");
INSERT INTO miembros VALUES("22","COBOS SLEME ","IVONNE MEDELIJ","CARRETERA CHAMPOTON-ISLA AGUADA KM 2, COLONIA EL ARENAL C.P. 24400, CHAMPOTON, CAMPECHE","982-828-24-32","1975-02-25","451515","subdir_planeacion@itescham.edu.mx","0","1","2017-09-10 20:45:12");
INSERT INTO miembros VALUES("23","DIANA CLAUDET","RIVAS ROMERO ","CARRETERA CHAMPOTON-ISLA AGUADA KM 2, COLONIA EL ARENAL C.P. 24400, CHAMPOTON, CAMPECHE","982-828-24-32","1989-04-25","45741-01","ccuevas@itescham.edu.mx","1","1","2017-09-10 20:46:36");
INSERT INTO miembros VALUES("24","JUAN","PEREZ","col. las malgritas","1245789","1985-02-12","1213121021","juan@hotmail.com","1","1","2017-09-11 10:18:46");
INSERT INTO miembros VALUES("26","KEVIN JOSÉ ","ARGUETA PONCE","COL LAS PRUBAS DE DATOS, CASA #12 PJE.12","74853215","1986-05-28","12121015-1","kevinjose@gmail.com","1","1","2018-01-23 10:42:35");
INSERT INTO miembros VALUES("27"," CARLOS JOSE ","PINEDA LOPEZ","COL LAS COLINITAS, PJ2, 10 AV SUR SANTIAFO","7845454445","1965-06-22","454564654","carlospineda@gmail.com","1","1","2018-01-23 18:25:27");
INSERT INTO miembros VALUES("28","CARLOS","ARAUJO","COL. DE PRUEBA DE DATOS","454515015","1986-07-12","45456451-5","","1","1","2018-01-27 10:44:08");



CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modulo` varchar(30) NOT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO modulos VALUES("1","Inicio");
INSERT INTO modulos VALUES("2","Miembros");
INSERT INTO modulos VALUES("3","Tesorerias");
INSERT INTO modulos VALUES("4","Eventos");
INSERT INTO modulos VALUES("5","Reportes");
INSERT INTO modulos VALUES("6","Configuracion");
INSERT INTO modulos VALUES("7","Grupos");
INSERT INTO modulos VALUES("8","Usuarios");



CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(150) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `codigo_postal` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL,
  `impuesto` int(2) NOT NULL,
  `moneda` varchar(6) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO perfil VALUES("1","IGLESIA BUENAS NUEVAS","Santiago de María, El Salvador","Santiago de María","","Usulután","+(503) 74823030","info@softys.com","13","$","../../img/1500308929_LOGO.png");



CREATE TABLE `receta_medica` (
  `id_receta` int(11) NOT NULL AUTO_INCREMENT,
  `id_consulta` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `medicamento_receta` int(11) NOT NULL,
  `indicacion_receta` varchar(255) NOT NULL,
  `users` int(11) NOT NULL,
  PRIMARY KEY (`id_receta`),
  KEY `id_consulta` (`id_consulta`),
  KEY `id_paciente` (`id_paciente`),
  KEY `users` (`users`),
  KEY `users_2` (`users`),
  KEY `medicamento_receta` (`medicamento_receta`),
  KEY `users_3` (`users`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO receta_medica VALUES("1","1","14","12","prueba de medicamento uno x","0");
INSERT INTO receta_medica VALUES("2","1","14","8","prueba de medicamento uno xx","0");
INSERT INTO receta_medica VALUES("3","1","14","15","prueba de medicamento uno xxx","0");
INSERT INTO receta_medica VALUES("4","1","14","11","prueba de medicamento uno xxxx","0");
INSERT INTO receta_medica VALUES("5","2","3","13","Prueba de med dos x","0");
INSERT INTO receta_medica VALUES("6","2","3","16","Prueba de med dos xx","0");
INSERT INTO receta_medica VALUES("7","2","3","9","Prueba de med dos xxx","0");
INSERT INTO receta_medica VALUES("8","2","3","2","Prueba de med dos xxxx","0");
INSERT INTO receta_medica VALUES("9","2","3","10","Prueba de med dos xxxxx","0");



CREATE TABLE `tipo_gasto` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(255) NOT NULL,
  `descripcion_tipo` text NOT NULL,
  `estado_tipo` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO tipo_gasto VALUES("1","RENTA DE LOCAL","PAGO DE LA RENTA DE LA IGLESIA","1","2018-01-25 09:43:24");
INSERT INTO tipo_gasto VALUES("2","COMBUSTIBLE","","1","2018-01-25 09:45:15");
INSERT INTO tipo_gasto VALUES("3","TELEFONO","PAGO DE SERVICIO DE INTERNET Y TELEFONINA","1","2018-01-25 09:46:08");
INSERT INTO tipo_gasto VALUES("4","SEGUROS DE COMPENSACION ","","1","2018-01-25 09:46:24");
INSERT INTO tipo_gasto VALUES("5","SEGURO DE LA CORPORACION ","SEGURO DE LA CORPORACIÓN DE LA IGLESIA ","1","2018-01-25 09:46:58");
INSERT INTO tipo_gasto VALUES("6","CAFÉ ","","1","2018-01-25 09:47:15");
INSERT INTO tipo_gasto VALUES("7","MERIENDA ","MERIENDA DE LA ESCUELA DOMINICAL ","1","2018-01-25 09:47:40");
INSERT INTO tipo_gasto VALUES("8","LITERATURA ","","1","2018-01-25 09:47:57");
INSERT INTO tipo_gasto VALUES("9","MOBILIARIO Y EQUIPO","","1","2018-01-25 09:48:19");
INSERT INTO tipo_gasto VALUES("10","OTROS","VARIEDAD DE GASTOS","1","2018-01-25 09:48:42");



CREATE TABLE `user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `permission` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_group_id`),
  KEY `user_group_id` (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO user_group VALUES("1","Super Administrador","Inicio,1,1,1;Miembros,1,1,1;Tesorerias,1,1,1;Eventos,1,1,1;Reportes,1,1,1;Configuracion,1,1,1;Grupos,1,1,1;Usuarios,1,1,1;","2017-09-05 10:00:48");
INSERT INTO user_group VALUES("2","TESORERO","Inicio,0,0,0;Miembros,0,0,0;Tesorerias,1,1,0;Eventos,0,0,0;Reportes,1,1,0;Configuracion,0,0,0;Grupos,0,0,0;Usuarios,0,0,0;","2018-01-27 10:41:01");
INSERT INTO user_group VALUES("3","SECRETARIA","Inicio,0,0,0;Miembros,1,1,0;Tesorerias,0,0,0;Eventos,1,1,1;Reportes,0,0,0;Configuracion,0,0,0;Grupos,0,0,0;Usuarios,0,0,0;","2018-01-27 10:41:20");



CREATE TABLE `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `nombre_users` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_users` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_users` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `con_users` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `email_users` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `tipo_users` tinyint(4) NOT NULL,
  `cargo_users` int(11) NOT NULL,
  `sucursal_users` tinyint(4) NOT NULL,
  `date_added_users` datetime NOT NULL,
  PRIMARY KEY (`id_users`),
  UNIQUE KEY `user_name` (`usuario_users`),
  UNIQUE KEY `user_email` (`email_users`),
  KEY `cargo_users` (`cargo_users`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`cargo_users`) REFERENCES `user_group` (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

INSERT INTO users VALUES("1","Super","administrador","admin","$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO","root@admin.com","0","1","0","2016-05-21 15:06:00");

