drop database bdventa;

CREATE DATABASE  IF NOT EXISTS `bdventa`;
USE `bdventa`;







DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;



/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `categoria`) VALUES (1,'otros/others'),(2,'comestibles'),(3,'aseo');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;



DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `ciNit` varchar(15) NOT NULL,
  nombre varchar(50)  not null default 'cam',
  `apellido` varchar(50) NOT NULL,
  `razonSocial` varchar(50) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `cliente`
--
-- ORDER BY:  `id`

/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id`, `ciNit`, `apellido`, `fechaRegistro`, `fechaActualizacion`) VALUES 
(1,'7844102','Perez','2019-11-16 12:54:18','2019-11-16 12:54:18'),
(2,'9833205','Sanchez','2019-11-16 12:54:18','2019-11-16 12:54:18'),
(3,'4455021','Hoyos','2019-11-16 12:54:18','2019-11-16 12:54:18'),
(4,'9522145011','Ramirez','2019-11-16 12:54:18','2019-11-16 12:54:18'),
(5,'6615423012','Gutierrez','2019-11-16 12:54:18','2019-11-16 12:54:18'),
(6,'9866325','Vargas','2019-11-16 12:54:18','2019-11-16 12:54:18'),
(7,'7822365-1A','Torrico','2019-11-16 12:54:18','2019-11-16 12:54:18'),
(8,'4755102','Merida','2019-11-16 12:54:18','2019-11-16 12:54:18'),
(9,'8850230','Peñarrieta','2019-11-16 12:54:18','2019-11-16 12:54:18'),(
10,'6855102','Gutierrez','2019-11-16 12:54:18','2019-11-16 12:54:18');
insert into cliente(ciNit,Nombre,Apellido) values('1235','Andres','Iles');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(80) NOT NULL,
  `descripcion` tinytext DEFAULT NULL,
  PRIMARY KEY (`idDepartamento`)
) ;

--
-- Dumping data for table `departamento`
--
-- ORDER BY:  `idDepartamento`

/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` (`idDepartamento`, `departamento`, `descripcion`) VALUES (1,'Putumayo','Tierra Amazonica'),(2,'Nariño','Tierra del cuy');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;

--
-- Table structure for table `detalle`
--


--
-- Table structure for table `estadoproducto`
--

DROP TABLE IF EXISTS `estadoproducto`;

CREATE TABLE `estadoproducto` (
  `idestadoProducto` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(25) NOT NULL,
  PRIMARY KEY (`idestadoProducto`)
);

--
-- Dumping data for table `estadoproducto`
--
-- ORDER BY:  `idestadoProducto`

/*!40000 ALTER TABLE `estadoproducto` DISABLE KEYS */;
INSERT INTO `estadoproducto` (`idestadoProducto`, `estado`) VALUES (1,'Nuevo'),(2,'usado');
/*!40000 ALTER TABLE `estadoproducto` ENABLE KEYS */;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;

CREATE TABLE `municipio` (
  `idMunicipio` int(11) NOT NULL AUTO_INCREMENT,
  `municipio` varchar(75) NOT NULL,
  `descripcion` tinytext DEFAULT NULL,
  `idDepartamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMunicipio`),
  KEY `idDepartamento` (`idDepartamento`),
  CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`)
) ;

--
-- Dumping data for table `municipio`
--
-- ORDER BY:  `idMunicipio`

/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` (`idMunicipio`, `municipio`, `descripcion`, `idDepartamento`) VALUES (1,'Mocoa','tcapital del putumayo',1),(2,'Villagarzon','Capital turistica del putumayo',1),(3,'Pasto','tierra del cuy y la papa',2),(4,'Ipiales','Tierra de la papa y la yuca',2);
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;

--
-- Table structure for table `oficina`
--

DROP TABLE IF EXISTS `oficina`;

CREATE TABLE `oficina` (
  `id` int(11) auto_increment,
  `nombre` varchar(40) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  idMunicipio int default 1,
  PRIMARY KEY (`id`),
  foreign key(idMunicipio) references municipio(idMunicipio)
);

--
-- Dumping data for table `oficina`
--
-- ORDER BY:  `id`

/*!40000 ALTER TABLE `oficina` DISABLE KEYS */;
INSERT INTO `oficina` (`id`, `nombre`, `direccion`, `estado`, `fechaRegistro`, `fechaActualizacion`) VALUES (1,'Oficina Center','Cine Center, Planta baja, Nro 1A',1,'2019-11-16 12:54:46','2019-11-16 12:54:46'),(2,'Oficina IC Norte 1','IC Norte, Melchor Perez de Olguin, 2do Piso',1,'2019-11-16 12:54:46','2019-11-16 12:54:46'),(3,'Oficina IC Norte 2','IC Norte, Av. America, 2do Piso, Nro 2-12',1,'2019-11-16 12:54:46','2019-11-16 12:54:46'),(4,'Oficina Heroinas','Avenida Heroinas 745, Ayacucho y Junin',1,'2019-11-16 12:54:46','2019-11-16 12:54:46'),(5,'Oficina Prado','Avenida Ballivian 789 y Oruro',1,'2019-11-16 12:54:46','2019-11-16 12:54:46');
/*!40000 ALTER TABLE `oficina` ENABLE KEYS */;

--
-- Table structure for table `producto`
--


--
-- Table structure for table `productocategoria`
--




--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `Rol` varchar(35) NOT NULL,
  `descripcion` tinytext DEFAULT NULL,
  `funciones` varchar(80) DEFAULT 'empleado',
  PRIMARY KEY (`idRol`)
) ;

--
-- Dumping data for table `rol`
--
-- ORDER BY:  `idRol`

/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`idRol`, `Rol`, `descripcion`, `funciones`) VALUES (1,'Admin','admin general de la tienda','empleado'),(2,'user','usuario comun de la tienda','empleado');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idUsuario` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(50) DEFAULT NULL,
  `correo` VARCHAR(50) DEFAULT NULL,
  `contraseña` VARCHAR(80) DEFAULT NULL,
  `nombre` VARCHAR(75) DEFAULT NULL,
  `fecha_nacimiento` DATE DEFAULT NULL,
  `idMunicipio` INT(11) DEFAULT NULL,
  `idRol` INT(11) DEFAULT 2,
  `descripcion` TINYTEXT DEFAULT 'sin descripcion',
  `telefono` VARCHAR(15) DEFAULT '3',
  `idOficina` INT(11) DEFAULT 1,
  PRIMARY KEY (`idUsuario`),
  KEY `fk_usuario_municipio` (`idMunicipio`),
  KEY `fk_usuario_oficina` (`idOficina`),
  KEY `fk_usuarios_rol_id` (`idRol`),
  CONSTRAINT `fk_usuarios_rol` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`),
  CONSTRAINT `fk_usuario_municipio` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`),
  CONSTRAINT `fk_usuario_oficina` FOREIGN KEY (`idOficina`) REFERENCES `oficina` (`id`)
) ;


--
-- Dumping data for table `usuario`
--
-- ORDER BY:  `idUsuario`

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idUsuario`, `usuario`, `correo`, `contraseña`, `nombre`, `fecha_nacimiento`, `idMunicipio`, `idRol`, `descripcion`, `telefono`) VALUES (1,'Ilesandres6','ilesandres6@gmail.com','1127071568','Andres Iles','2005-07-12',1,1,'sin descripcion','3'),(27,'Ilesandres6','ilesandre6@gmail.com','$2y$10$9OJavNHi5gDh8PAcgrLNbu5HLSp61I.iGALOeagOYgVNUYn3yAH3m','Andres','2005-07-12',1,2,'sin descripcion','3'),(28,'Platvent','wemase5629@cnurbano.com','$2y$10$J7xIYoTvLQlODfJKWIeU8eL/WSxg7BEgyn1xx.SrKcQ.6IY6qlR52','Platvent','2004-04-12',1,2,'sin descripcion','3'),(29,'Platvent','wemase5629@cnurbano.com','$2y$10$oYLLzr8rslPP/t0hszI9IOwhfMZ.nAVqjTzHhq9z7Wllm51ZZH6Au','Platvent','1886-06-02',4,2,'sin descripcion','3');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

--
-- Table structure for table `venta`
DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) NOT NULL,
  descripcion_complete tinytext default 'sin descripcion completa',
  `stock` int(20) NOT NULL DEFAULT 5,
  `unidadMedida` varchar(25) NOT NULL,
  `saldo` double(11,0) NOT NULL,
  `precioBase` decimal(18,2) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  `img` varchar(400) NOT NULL DEFAULT 'back.png',
  `idUsuario` int(11) DEFAULT 1,
  `estado` int(11) DEFAULT 1,
  `categoria` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_producto_usuario` (`idUsuario`),
  KEY `fk_producto_estadoproducto` (`estado`),
  CONSTRAINT `fk_producto_estadoproducto` FOREIGN KEY (`estado`) REFERENCES `estadoproducto` (`idestadoProducto`),
  CONSTRAINT `fk_producto_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`)
);

--
-- Dumping data for table `producto`
--
-- ORDER BY:  `id`

/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`id`, `descripcion`, `stock`, `unidadMedida`, `saldo`, `precioBase`, `fechaRegistro`, `fechaActualizacion`, `img`, `idUsuario`, `estado`, `categoria`) VALUES (1,'Hojas Bond Oficio',7,'Pieza',703,100.50,'2019-11-16 12:55:39','2024-06-16 19:18:35','1-.jpg',1,1,1),(2,'Lapiz Negro HB 2.0 Norma',10,'Unidad/U',250,25.00,'2019-11-16 12:55:39','2024-06-16 17:51:20','default.png',1,1,1),(3,'Borrador de Tinta',5,'Pieza',25,5.00,'2019-11-16 12:55:39','2024-06-16 17:51:40','default.png',1,2,1),(4,'Estuche Geométrico',10,'Estuche',205,20.50,'2019-11-16 12:55:39','2024-06-16 18:27:24','default.png',1,2,1),(5,'Cartulina de Color',5,'Pliego',400,2.50,'2019-11-16 12:55:39','2019-11-16 12:55:39','default.png',1,1,1),(6,'Archivador Rápido',5,'Pieza',15,3.00,'2019-11-16 12:55:39','2024-06-16 17:52:21','default.png',1,1,1),(7,'Micropunta Negro 0.8',5,'Pieza',150,8.50,'2019-11-16 12:55:39','2019-11-16 12:55:39','default.png',1,1,1),(8,'Marcadores (12 Colores)',5,'Estuche',650,35.00,'2019-11-16 12:55:39','2019-11-16 12:55:39','default.png',1,1,1),(9,'Cuaderno 100 Hojas C/espiral',5,'Pieza',905,21.00,'2019-11-16 12:55:39','2019-11-16 12:55:39','default.png',1,1,1),(10,'Boligrafo Pilot Negro',5,'Pieza',1500,5.00,'2019-11-16 12:55:39','2019-11-16 12:55:39','default.png',1,1,1),(11,'Boligrafo Pilot Rojo',5,'Pieza',745,5.00,'2019-11-16 12:55:39','2019-11-16 12:55:39','default.png',1,1,1),(12,'Boligrafo Pilot Azul',5,'Pieza',800,5.00,'2019-11-16 12:55:39','2019-11-16 12:55:39','default.png',1,1,1),(13,'Pegamento de 250 ml',5,'Bote',234,7.50,'2019-11-16 12:55:39','2019-11-16 12:55:39','default.png',1,1,1),(14,'Acuarelas de color',5,'Docena',65,24.50,'2019-11-16 12:55:39','2019-11-16 12:55:39','default.png',1,1,1),(56,'Disco solido 1.5 tb',2,'TB',26,13.25,'2024-06-15 18:14:07','2024-06-17 09:37:13','56-.jpg',27,1,1),(60,'Disco 1 tb mecanico',2,'TB',25,12.60,'2024-06-15 18:43:55','2024-06-18 08:19:19','60-.jpg',27,1,1);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;


DROP TABLE IF EXISTS `productocategoria`;

CREATE TABLE `productocategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idProducto` (`idProducto`),
  KEY `idCategoria` (`idCategoria`),
  CONSTRAINT `productocategoria_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`id`),
  CONSTRAINT `productocategoria_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`)
) ;

--
-- Dumping data for table `productocategoria`
--

create table if not exists estadoVenta(
id int auto_increment primary key,
estado_venta varchar(45)
);

insert into estadoVenta(`estado_venta`)values('pagado'),('finalizado'),('en proceso'),('cancelado'),('en reparto') ;

--

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `id` int(11) auto_increment not null,
  `idCliente` int NOT NULL,
  `idUsuario` int NOT NULL,
  `total` decimal(18,2) NOT NULL DEFAULT 0.00,
  idestado int default 4,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_venta_cliente` (`idCliente`),
  KEY `FK_cliente_usuario` (`idUsuario`),
  CONSTRAINT `FK_cliente_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  CONSTRAINT `FK_venta_cliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`),
  foreign key(idestado) references  estadoVenta(id)
) ;

--
-- Dumping data for table `venta`
--
-- ORDER BY:  `id`

/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` (`id`, `idCliente`, `idUsuario`, `total`, 
 `fechaRegistro`, `fechaActualizacion`) VALUES 
(1,1,1,1990.00,'2019-11-16 12:55:06','2019-11-16 12:55:06'),
(2,2,1,1620.00,'2019-11-16 12:55:06','2019-11-16 12:55:06'),
(3,3,1,1292.50,'2019-11-16 12:55:06','2019-11-16 12:55:06'),
(4,4,1,2232.50,'2019-11-16 12:55:06','2019-11-16 12:55:06'),
(5,5,1,1202.50,'2019-11-16 12:55:06','2019-11-16 12:55:06'),
(6,6,1,1435.00,'2019-11-16 12:55:06','2019-11-16 12:55:06'),
(7,7,1,657.50,'2019-11-16 12:55:06','2019-11-16 12:55:06'),
(8,8,1,850.00,'2019-11-16 12:55:06','2019-11-16 12:55:06'),
(9,9,1,2395.00,'2019-11-16 12:55:06','2019-11-16 12:55:06'),
(10,1,1,1670.00,'2019-11-16 12:55:06','2019-11-16 12:55:06'),
(11,9,1,165.00,'2019-11-16 12:55:06','2019-11-16 12:55:06');
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;


DROP TABLE IF EXISTS `detalles`;

CREATE TABLE `detalles` (
	iddetalles int auto_increment primary key,
  `idVenta` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioUnitario` decimal(8,2) NOT NULL,
  KEY `FK_Pedido_Producto_Producto` (`idProducto`),
  CONSTRAINT `FK_Pedido_Producto_Pedido` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Pedido_Producto_Producto` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ;



/*!40000 ALTER TABLE `detalles` DISABLE KEYS */;
INSERT INTO `detalles` (`idVenta`, `idProducto`, `cantidad`, `precioUnitario`) VALUES (1,3,25,5.00),(1,5,20,2.50),(1,7,10,8.50),(1,9,5,21.00),(1,11,80,5.00),(1,14,50,24.50),(2,2,50,2.50),(2,4,10,20.50),(2,6,15,3.00),(2,8,25,35.00),(2,10,20,5.00),(2,12,5,5.00),(2,14,10,24.50),(3,4,25,20.50),(3,5,30,2.50),(3,6,35,3.00),(3,7,15,8.50),(3,8,10,35.00),(3,14,5,24.50),(4,6,5,3.00),(4,9,5,21.00),(4,10,70,5.00),(4,11,10,5.00),(4,12,45,5.00),(4,13,35,7.50),(4,14,50,24.50),(5,1,2000,0.10),(5,3,35,5.00),(5,6,5,3.00),(5,9,10,21.00),(5,13,15,7.50),(5,14,20,24.50),(6,1,1000,0.10),(6,2,20,2.50),(6,3,10,5.00),(6,4,20,20.50),(6,5,10,2.50),(6,6,5,3.00),(6,7,10,8.50),(6,8,20,35.00),(7,1,1500,0.10),(7,11,5,5.00),(7,12,10,5.00),(7,13,25,7.50),(7,14,10,24.50),(8,5,5,2.50),(8,6,10,3.00),(8,7,5,8.50),(8,8,10,35.00),(8,9,15,21.00),(8,10,20,5.00),(9,10,70,5.00),(9,11,15,5.00),(9,12,25,5.00),(9,13,50,7.50),(9,14,60,24.50),(10,1,200,0.10),(10,2,5,2.50),(10,7,5,8.50),(10,8,15,35.00),(10,9,10,21.00),(10,12,25,5.00),(10,14,30,24.50),(11,6,55,3.00);
/*!40000 ALTER TABLE `detalles` ENABLE KEYS */;



