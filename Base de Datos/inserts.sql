-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Nov 14, 2024 at 08:24 AM
-- Server version: 11.5.2-MariaDB-ubu2404
-- PHP Version: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grupo3_2425`
--

--
-- Dumping data for table `guardado`
--

INSERT INTO `usuarios` (`id_usuario`, `foto`, `nombre`, `contrasena`, `especialidad`, `anios_empresa`, `email`, `tipo`) VALUES
(7, '/assets/images/perfil/default.jpg', 'javiLopez', 'enginepass', 'Propulsión', 8, 'javier.lopez@aero.com', 'usuario'),
(8, '/assets/images/perfil/default.jpg', 'CarmenRuiz', 'cockpitpass', 'Sistemas de Control', 5, 'carmen.ruiz@aero.com', 'usuario'),
(9, '/assets/images/perfil/default.jpg', 'MiguelAlvarez', 'landingpass', 'Estructuras Aeronáuticas', 4, 'miguel.alvarez@aero.com', 'usuario'),
(10, '/assets/images/perfil/default.jpg', 'IsabelMoreno', 'Jm12345', 'Propulsion', 6, 'isabel.moreno@aero.com', 'admin'),
(11, '/assets/images/perfil/default.jpg', 'RobertoJiménez', 'turbinepass', 'Mantenimiento de Aeronaves', 3, 'roberto.jimenez@aero.com', 'usuario'),
(12, '/assets/images/perfil/default.jpg', 'ElenaGómez', 'fuselagepass', 'Diseño de Interiores de Aeronaves', 5, 'elena.gomez@aero.com', 'usuario'),
(13, '/assets/images/perfil/default.jpg', 'FranciscoDíaz', 'navpass', 'Navegación Aérea', 7, 'francisco.diaz@aero.com', 'usuario'),
(14, '/assets/images/perfil/default.jpg', 'SofíaHernández', 'radarpass', 'Sistemas de Radar', 4, 'sofia.hernandez@aero.com', 'usuario'),
(15, '/assets/images/perfil/default.jpg', 'AlbertoMuñoz', 'compositepass', 'Materiales Compuestos', 6, 'alberto.munoz@aero.com', 'admin'),
(16, '/assets/images/perfil/default.jpg', 'LucíaTorres', 'testpass', 'Pruebas de Vuelo', 3, 'lucia.torres@aero.com', 'usuario'),
(17, '/assets/images/perfil/default.jpg', 'RaúlOrtega', 'simpass', 'Simulación de Vuelo', 5, 'raul.ortega@aero.com', 'usuario'),
(18, '/assets/images/perfil/default.jpg', 'CristinaNavarro', 'safetypass', 'Seguridad Aérea', 8, 'cristina.navarro@aero.com', 'usuario'),
(19, '/assets/images/perfil/default.jpg', 'AndrésRamos', 'dronepass', 'Tecnología de Drones', 2, 'andres.ramos@aero.com', 'usuario'),
(20, '/assets/images/perfil/default.jpg', 'BeatrizCastro', 'atcpass', 'Control de Tráfico Aéreo', 6, 'beatriz.castro@aero.com', 'admin'),
(21, '/assets/images/perfil/default.jpg', 'DiegoFlores', 'rocketpass', 'Ingeniería de Cohetes', 4, 'diego.flores@aero.com', 'usuario'),
(22, '/assets/images/perfil/default.jpg', 'MartaVega', 'satellitepass', 'Tecnología de Satélites', 7, 'marta.vega@aero.com', 'usuario'),
(23, '/assets/images/perfil/default.jpg', 'VíctorReyes', 'weatherpass', 'Meteorología Aeronáutica', 5, 'victor.reyes@aero.com', 'usuario'),
(24, '/assets/images/perfil/default.jpg', 'NataliaCampos', 'cabinpass', 'Diseño de Cabina', 3, 'natalia.campos@aero.com', 'usuario'),
(25, '/assets/images/perfil/default.jpg', 'ÓscarMedina', 'fuelpass', 'Sistemas de Combustible', 6, 'oscar.medina@aero.com', 'admin'),
(26, '/assets/images/perfil/default.jpg', 'SilviaVargas', 'electricpass', 'Sistemas Eléctricos de Aeronaves', 4, 'silvia.vargas@aero.com', 'usuario'),
(27, '/assets/images/perfil/default.jpg', 'RubénMendoza', 'hydraulicpass', 'Sistemas Hidráulicos', 5, 'ruben.mendoza@aero.com', 'usuario'),
(28, '/assets/images/perfil/default.jpg', 'EvaHerrera', 'compositepass', 'Materiales Compuestos Avanzados', 7, 'eva.herrera@aero.com', 'usuario'),
(30, '/assets/images/perfil/default.jpg', 'MarinaDelgado', 'testpilotpass', 'Propulsion', 8, 'marina.delgado@aero.com', 'admin'),
(32, '/assets/images/perfil/ander.png', 'ander', 'Jm12345', 'Propulsion', 2, 'a@a', 'admin'),
(33, '/assets/images/perfil/eliminado.jpg', 'Usuario eliminado', '000', 'Usuario eliminado', NULL, NULL, 'usuario'),
(38, '/assets/images/perfil/inigo.png', 'inigo', 'a', 'Propulsion', 2, 'a@a', 'admin'),
(39, '/assets/images/perfil/egoitz.png', 'egoitz', 'Jm12345', 'Propulsion', 11, 'egoitz@aergibide.org', 'admin'),
(41, '/assets/images/perfil/default.jpg', 'nieves', 'nieves', 'Propulsion', 1, 'mnruiz@aergibide.org', 'usuario'),
(42, '/assets/images/perfil/default.jpg', 'ines', 'ines', 'Innovacion', 1, 'ilarranaga@aergibide.org', 'usuario'),
(43, '/assets/images/perfil/default.jpg', 'roberto', 'roberto', 'Optimizacion', 1, 'rcalvo@aergibide.org', 'usuario'),
(44, '/assets/images/perfil/default.jpg', 'maider', 'maider', 'Innovacion', 1, 'maiderdiaz@aergibide.org', 'usuario'),
(45, '/assets/images/perfil/default.jpg', 'admin', 'admin', 'Propulsion', 10, 'admin@aergibide.org', 'admin');
COMMIT;

INSERT INTO `temas` (`id_tema`, `nombre`, `caracteristica`, `imagen`) VALUES
(1, 'Aerodinámica', '#FF3183', '/assets/images/1.png'),
(2, 'Propulsión', '#7EC5FF', '/assets/images/2.png'),
(3, 'Materiales', '#FFA3A5', '/assets/images/3.png'),
(4, 'Seguridad', '#00F382', '/assets/images/4.png'),
(5, 'Materiales Aeroespaciales', '#2d2965', NULL),
(7, 'Sistemas de Control', 'Técnico', NULL),
(8, 'Navegación Aérea', 'Operacional', NULL),
(9, 'Mantenimiento de Aeronaves', 'Práctico', NULL),
(10, 'Seguridad Aérea', 'Crítico', NULL),
(11, 'Dinámica de Vuelo', 'Avanzado', NULL),
(12, 'Sistemas de Propulsión', 'Técnico', NULL),
(13, 'Aeropuertos', '#000000', NULL),
(14, 'Meteorología Aeronáutica', 'Operacional', NULL),
(15, 'Legislación Aeronáutica', 'Regulatorio', NULL),
(16, 'Ingeniería de Cohetes', 'Especializado', NULL),
(17, 'Tecnología de Drones', 'Innovación', NULL),
(18, 'Tema Eliminado', '#d10000', NULL),
(19, 'Aerodinámica Computacional', 'Simulación', NULL),
(20, 'Pruebas de Vuelo', 'Experimental', NULL),
(21, 'Sistemas Eléctricos', 'Técnico', NULL),
(22, 'Sistemas Hidráulicos', 'Técnico', NULL),
(23, 'Materiales Compuestos', 'Avanzado', NULL),
(24, 'Control de Tráfico Aéreo', 'Operacional', NULL),
(25, 'Diseño de Motores', 'Especializado', NULL),
(26, 'Sistemas de Radar', 'Técnico', NULL),
(28, 'Sistemas de Comunicación', 'Técnico', NULL),
(29, 'Ergonomía en Cabina', 'Diseño', NULL);

INSERT INTO `posts` (`id_post`, `id_usuario`, `id_tema`, `contenido`, `ruta_media`, `fecha`) VALUES
(1, 33, 1, '¿Cuáles son los principales factores que afectan la eficiencia aerodinámica de una aeronave?', NULL, '2023-05-15 10:30:00'),
(3, 33, 3, '¿Qué ventajas ofrecen los materiales compuestos en la construcción de estructuras de aeronaves?', NULL, '2023-05-17 09:15:00'),
(5, 33, 5, '¿Cómo afecta la temperatura extrema a las propiedades de los materiales aeroespaciales?', NULL, '2023-05-19 16:30:00'),
(6, 33, 18, '¿Qué consideraciones de diseño son cruciales para desarrollar un avión supersónico comercial viable?', NULL, '2023-05-20 13:10:00'),
(7, 7, 7, '¿Cuáles son los desafíos en el desarrollo de sistemas de control fly-by-wire más avanzados?', NULL, '2023-05-21 10:45:00'),
(8, 8, 8, '¿Cómo están mejorando los sistemas de navegación satelital la precisión en la aviación?', NULL, '2023-05-22 15:20:00'),
(9, 9, 9, '¿Qué nuevas técnicas de mantenimiento predictivo se están implementando en la industria aeronáutica?', NULL, '2023-05-23 09:30:00'),
(10, 10, 10, '¿Cuáles son las principales causas de accidentes aéreos en la actualidad y cómo se están abordando?', NULL, '2023-05-24 14:15:00'),
(11, 11, 11, '¿Cómo afecta la altitud a la dinámica de vuelo de una aeronave?', NULL, '2023-05-25 11:40:00'),
(12, 12, 12, '¿Qué avances recientes se han logrado en la eficiencia de los motores turbofan?', NULL, '2023-05-26 16:50:00'),
(13, 13, 13, '¿Cuáles son los principales desafíos en el diseño de aeropuertos para manejar el aumento del tráfico aéreo?', NULL, '2023-05-27 10:25:00'),
(14, 14, 14, '¿Cómo influyen los fenómenos meteorológicos extremos en la planificación de vuelos?', NULL, '2023-05-28 13:35:00'),
(15, 15, 15, '¿Qué cambios recientes en la legislación aeronáutica están afectando a la industria?', NULL, '2023-05-29 09:55:00'),
(16, 16, 16, '¿Cuáles son las últimas innovaciones en propulsión de cohetes para misiones espaciales?', NULL, '2023-05-30 15:40:00'),
(17, 17, 17, '¿Cómo está evolucionando la integración de drones en el espacio aéreo comercial?', NULL, '2023-05-31 11:15:00'),
(18, 18, 18, '¿Qué avances se han logrado en la eficiencia de los sistemas de combustible de las aeronaves?', NULL, '2023-06-01 14:30:00'),
(19, 19, 19, '¿Cómo ha mejorado la aerodinámica computacional el proceso de diseño de aeronaves?', NULL, '2023-06-02 10:50:00'),
(20, 20, 20, '¿Cuáles son los protocolos estándar para las pruebas de vuelo de nuevas aeronaves?', NULL, '2023-06-03 16:20:00'),
(21, 21, 21, '¿Qué innovaciones recientes se han introducido en los sistemas eléctricos de las aeronaves?', NULL, '2023-06-04 09:40:00'),
(22, 22, 22, '¿Cómo se están mejorando los sistemas hidráulicos para aumentar su eficiencia y fiabilidad?', NULL, '2023-06-05 13:55:00'),
(23, 23, 23, '¿Qué nuevos materiales compuestos se están desarrollando para aplicaciones aeroespaciales?', NULL, '2023-06-06 11:30:00'),
(24, 24, 24, '¿Cómo están evolucionando los sistemas de control de tráfico aéreo para manejar el aumento de vuelos?', NULL, '2023-06-07 15:10:00'),
(25, 25, 25, '¿Cuáles son las últimas tendencias en el diseño de motores para aeronaves más eficientes y ecológicas?', NULL, '2023-06-08 10:05:00'),
(26, 26, 26, '¿Qué avances se han logrado en la tecnología de radar para mejorar la detección y el seguimiento de aeronaves?', NULL, '2023-06-09 14:25:00'),
(27, 27, 28, '¿Cómo se abordan los problemas de aeroelasticidad en el diseño de aeronaves modernas?', NULL, '2023-06-10 09:50:00'),
(28, 28, 28, '¿Qué mejoras recientes se han implementado en los sistemas de comunicación aire-tierra?', NULL, '2023-06-11 13:40:00'),
(30, 30, 28, '¿Cuáles son los últimos avances en tecnología stealth para aeronaves militares?', NULL, '2023-06-13 15:30:00'),
(43, 32, 2, 'aaa', NULL, '2024-11-14 08:21:32');

INSERT INTO `respuestas` (`id_respuesta`, `id_post`, `id_usuario`, `contenido`, `ruta_media`, `fecha`) VALUES
(1, 1, 33, 'Los principales factores son la forma del ala, el ángulo de ataque, la velocidad y la altitud de vuelo.', NULL, '2023-05-15 11:45:00'),
(2, 1, 33, 'También es importante considerar la rugosidad de la superficie y la distribución del peso.', NULL, '2023-05-15 12:30:00'),
(5, 3, 33, 'Los materiales compuestos ofrecen una excelente relación resistencia-peso y mayor resistencia a la fatiga.', NULL, '2023-05-17 10:00:00'),
(6, 3, 7, 'Además, permiten diseños más aerodinámicos y reducen el mantenimiento a largo plazo.', NULL, '2023-05-17 10:45:00'),
(9, 5, 10, 'Las temperaturas extremas pueden afectar la resistencia, la ductilidad y la expansión térmica de los materiales.', NULL, '2023-05-19 17:15:00'),
(10, 5, 11, 'Es crucial seleccionar materiales que mantengan sus propiedades en el rango de temperaturas operativas de la aeronave.', NULL, '2023-05-19 18:00:00'),
(11, 6, 12, 'El diseño debe considerar la reducción del boom sónico, la eficiencia del combustible y la resistencia estructural a altas temperaturas.', NULL, '2023-05-20 14:00:00'),
(12, 6, 13, 'También es importante optimizar la aerodinámica para minimizar la resistencia supersónica.', NULL, '2023-05-20 14:45:00'),
(13, 7, 14, 'Los principales desafíos incluyen la redundancia del sistema, la protección contra interferencias electromagnéticas y la seguridad cibernética.', NULL, '2023-05-21 11:30:00'),
(14, 7, 15, 'Además, se busca mejorar la integración con otros sistemas de la aeronave y reducir el peso total.', NULL, '2023-05-21 12:15:00'),
(15, 8, 16, 'Los sistemas GNSS multifrecuencia y multiconstelación están mejorando significativamente la precisión y la integridad de la navegación.', NULL, '2023-05-22 16:00:00'),
(16, 8, 17, 'La implementación de sistemas de aumentación basados en satélites (SBAS) también está contribuyendo a una navegación más precisa.', NULL, '2023-05-22 16:45:00'),
(17, 9, 18, 'Se están utilizando sensores IoT y análisis de big data para predecir fallos antes de que ocurran.', NULL, '2023-05-23 10:15:00'),
(18, 9, 19, 'La inteligencia artificial y el aprendizaje automático se aplican para analizar patrones de desgaste y optimizar los programas de mantenimiento.', NULL, '2023-05-23 11:00:00'),
(19, 10, 20, 'Las principales causas actuales incluyen errores humanos, fallos técnicos y condiciones meteorológicas adversas.', NULL, '2023-05-24 15:00:00'),
(20, 10, 21, 'Se están abordando mediante mejoras en la formación de pilotos, sistemas de alerta más avanzados y mejor comunicación entre la tripulación y el control de tierra.', NULL, '2023-05-24 15:45:00'),
(21, 11, 22, 'La altitud afecta la densidad del aire, lo que influye en la sustentación, la resistencia y el rendimiento del motor.', NULL, '2023-05-25 12:25:00'),
(22, 11, 23, 'A mayor altitud, se requieren ajustes en la configuración de vuelo y en la gestión de potencia para mantener el rendimiento óptimo.', NULL, '2023-05-25 13:10:00'),
(23, 12, 24, 'Se han logrado mejoras en la relación de derivación, materiales más ligeros y diseños de álabes más eficientes.', NULL, '2023-05-26 17:35:00'),
(24, 12, 25, 'La implementación de sistemas de control digital del motor (FADEC) también ha contribuido significativamente a la eficiencia.', NULL, '2023-05-26 18:20:00'),
(25, 13, 26, 'Los principales desafíos incluyen la expansión de pistas, la gestión eficiente del espacio aéreo y la implementación de tecnologías para reducir los tiempos de espera.', NULL, '2023-05-27 11:10:00'),
(26, 13, 27, 'También se están desarrollando soluciones para mejorar la sostenibilidad ambiental de los aeropuertos.', NULL, '2023-05-27 11:55:00'),
(27, 14, 28, 'Los fenómenos extremos pueden afectar la ruta de vuelo, el consumo de combustible y la seguridad general.', NULL, '2023-05-28 14:20:00'),
(29, 15, 30, 'Recientes cambios incluyen regulaciones más estrictas sobre emisiones, nuevas normas de seguridad y políticas de cielos abiertos.', NULL, '2023-05-29 10:40:00'),
(30, 1, 33, 'son este', NULL, '2024-11-11 09:35:03'),
(34, 1, 33, 'soy iñigo', NULL, '2024-11-11 12:38:08'),
(41, 1, 32, 'ssss', '/reto-1-equipo-3/php/assets/images/github-5.docx', '2024-11-13 10:53:33'),
(42, 1, 38, 'repaso pdf', '/reto-1-equipo-3/php/assets/images/Ejercicio repaso.pdf', '2024-11-13 11:04:10'),
(43, 1, 38, 'repaso pdf', '/reto-1-equipo-3/php/assets/images/Ejercicio repaso.pdf', '2024-11-13 11:04:11'),
(44, 1, 38, 'foto', '/reto-1-equipo-3/php/assets/images/pexels-marcelo-moreira-2261702.jpg', '2024-11-13 11:14:20'),
(46, 1, 32, 'esto es un pdf', NULL, '2024-11-13 12:19:04');



INSERT INTO `guardado` (`id_guardado`, `id_post`, `id_usuario`) VALUES
(3, 1, 7),
(4, 1, 9),
(11, 3, 9),
(12, 3, 13),
(18, 5, 7),
(19, 5, 11),
(20, 5, 15),
(22, 6, 8),
(23, 6, 12),
(24, 6, 16),
(27, 7, 9),
(28, 7, 13),
(31, 8, 10),
(32, 8, 14),
(34, 9, 7),
(35, 9, 11),
(36, 9, 15),
(38, 10, 8),
(39, 10, 12),
(40, 10, 16),
(43, 11, 9),
(44, 11, 13),
(47, 12, 10),
(48, 12, 14),
(50, 13, 7),
(51, 13, 11),
(52, 13, 15),
(54, 14, 8),
(55, 14, 12),
(56, 14, 16),
(59, 15, 9),
(60, 15, 13);

--
-- Dumping data for table `likeUsuario`
--

INSERT INTO `likeUsuario` (`id_likeUsuario`, `id_usuario`, `id_respuesta`) VALUES
(7, 7, 2),
(67, 7, 14),
(8, 8, 2),
(68, 8, 14),
(9, 9, 2),
(69, 9, 14),
(10, 10, 2),
(70, 10, 14),
(41, 11, 9),
(71, 11, 15),
(42, 12, 9),
(72, 12, 15),
(43, 13, 9),
(73, 13, 15),
(44, 14, 9),
(74, 14, 15),
(45, 15, 9),
(75, 15, 15),
(46, 16, 10),
(47, 17, 10),
(48, 18, 10),
(49, 19, 10),
(50, 20, 10),
(21, 21, 5),
(51, 21, 11),
(22, 22, 5),
(52, 22, 11),
(23, 23, 5),
(53, 23, 11),
(24, 24, 5),
(54, 24, 11),
(25, 25, 5),
(55, 25, 11),
(26, 26, 6),
(56, 26, 12),
(27, 27, 6),
(57, 27, 12),
(28, 28, 6),
(58, 28, 12),
(30, 30, 6),
(60, 30, 12),
(89, 32, 46);

--
-- Dumping data for table `posts`
--



--
-- Dumping data for table `respuestas`
--



--
-- Dumping data for table `temas`
--



--
-- Dumping data for table `usuarios`
--



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
