DROP TABLE IF EXISTS `ubicaciones`;

CREATE TABLE `ubicaciones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `dias` set('L','M','X','J','V','S','D'),
  `created_at` timestamp NULL DEFAULT now(),
  `updated_at` timestamp NULL DEFAULT now(),
  PRIMARY KEY (`id`)
);

INSERT INTO `ubicaciones` VALUES 
  (2,'Biblioteca Municipal Distrito 4','Biblioteca Municipal del distrito 4. 6ª Avenida','L,M,X','2024-02-14 17:03:46','2024-02-14 17:03:46'),
  (3,'Casa de la cultura Andaluza','Casa de la cultura Andaluza Calle Rocío nº 76','M,X','2024-02-16 07:21:28','2024-02-16 07:21:28'),
  (5,'ejemplo2','descripción ubicación ejemplo 2','L,M,V','2024-02-17 11:57:11','2024-02-17 11:57:11');

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(65) NOT NULL,
  `roles` set('admin','coord','trasoc','edusoc') NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni_UNIQUE` (`dni`)
);

INSERT INTO `empleados` VALUES (1,'12345678A','María','González Pérez','coord','b91c3c4ba08accafd0a97cfac9586e59d54fd932817293c2749f11924d1bdc34'),(2,'X8765432B','Carlos','López Martínez','trasoc','8f337c7569e1ee8c8094007df710b1b3438b9e79ec03ec71248a3f1ef74754e3'),(3,'Y9876543C','Encarnación','López Pérez','trasoc','b5b1ca78e61e5037349bfc4fa72747b3ec5dd6349833c903d342c062de83e962'),(4,'Z7654321D','Juan','Sánchez Gómez','admin','d469ca1564658a97ebc7059d20e8a9616950795aca97f353b48dd6b9005aaa94'),(5,'C8765432F','Felípe','Ruíz Alonso','edusoc','453d0f89796fb408f021d830fff24afa6d2a227508a7fb615db6320f1456f8aa');
