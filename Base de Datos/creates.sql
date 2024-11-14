-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Nov 14, 2024 at 08:24 AM
-- Server version: 11.5.2-MariaDB-ubu2404
-- PHP Version: 8.2.25

SET FOREIGN_KEY_CHECKS = 0;

-- Eliminar tablas
DROP TABLE IF EXISTS guardado;
DROP TABLE IF EXISTS likeUsuario;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS respuestas;
DROP TABLE IF EXISTS temas;
DROP TABLE IF EXISTS usuarios;

-- Eliminar trigger
DROP TRIGGER IF EXISTS poner_foto_default;

-- Reactivar restricciones de clave foránea
SET FOREIGN_KEY_CHECKS = 1;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: grupo3_2425
--

-- --------------------------------------------------------

--
-- Table structure for table guardado
--

CREATE TABLE guardado (
  id_guardado int(11) NOT NULL,
  id_post int(11) DEFAULT NULL,
  id_usuario int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table likeUsuario
--

CREATE TABLE likeUsuario (
  id_likeUsuario int(11) NOT NULL,
  id_usuario int(11) DEFAULT NULL,
  id_respuesta int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table posts
--

CREATE TABLE posts (
  id_post int(11) NOT NULL,
  id_usuario int(11) DEFAULT NULL,
  id_tema int(11) DEFAULT NULL,
  contenido text DEFAULT NULL,
  ruta_media varchar(255) DEFAULT NULL,
  fecha datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table respuestas
--

CREATE TABLE respuestas (
  id_respuesta int(11) NOT NULL,
  id_post int(11) DEFAULT NULL,
  id_usuario int(11) DEFAULT NULL,
  contenido text DEFAULT NULL,
  ruta_media varchar(255) DEFAULT NULL,
  fecha datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table temas
--

CREATE TABLE temas (
  id_tema int(11) NOT NULL,
  nombre varchar(100) DEFAULT NULL,
  caracteristica varchar(50) DEFAULT NULL,
  imagen varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table usuarios
--

CREATE TABLE usuarios (
  id_usuario int(11) NOT NULL,
  foto varchar(255) DEFAULT NULL,
  nombre varchar(100) DEFAULT NULL,
  contrasena varchar(100) DEFAULT NULL,
  especialidad varchar(255) DEFAULT NULL,
  anios_empresa int(11) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  tipo enum('admin','usuario') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Triggers usuarios
--
DELIMITER $$
CREATE TRIGGER poner_foto_default BEFORE INSERT ON usuarios FOR EACH ROW IF NEW.foto IS NULL THEN
	SET NEW.foto = '/assets/images/perfil/default.jpg';
END IF
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table guardado
--
ALTER TABLE guardado
  ADD PRIMARY KEY (id_guardado),
  ADD KEY id_post (id_post),
  ADD KEY id_usuario (id_usuario);

--
-- Indexes for table likeUsuario
--
ALTER TABLE likeUsuario
  ADD PRIMARY KEY (id_likeUsuario),
  ADD UNIQUE KEY id_usuario (id_usuario,id_respuesta),
  ADD KEY id_respuesta (id_respuesta);

--
-- Indexes for table posts
--
ALTER TABLE posts
  ADD PRIMARY KEY (id_post),
  ADD KEY id_usuario (id_usuario),
  ADD KEY id_tema (id_tema);

--
-- Indexes for table respuestas
--
ALTER TABLE respuestas
  ADD PRIMARY KEY (id_respuesta),
  ADD KEY id_post (id_post),
  ADD KEY id_usuario (id_usuario);

--
-- Indexes for table temas
--
ALTER TABLE temas
  ADD PRIMARY KEY (id_tema);

--
-- Indexes for table usuarios
--
ALTER TABLE usuarios
  ADD PRIMARY KEY (id_usuario);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table guardado
--
ALTER TABLE guardado
  MODIFY id_guardado int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table likeUsuario
--
ALTER TABLE likeUsuario
  MODIFY id_likeUsuario int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table posts
--
ALTER TABLE posts
  MODIFY id_post int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table respuestas
--
ALTER TABLE respuestas
  MODIFY id_respuesta int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table temas
--
ALTER TABLE temas
  MODIFY id_tema int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table usuarios
--
ALTER TABLE usuarios
  MODIFY id_usuario int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table guardado
--
ALTER TABLE guardado
  ADD CONSTRAINT guardado_ibfk_1 FOREIGN KEY (id_post) REFERENCES posts (id_post),
  ADD CONSTRAINT guardado_ibfk_2 FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario);

--
-- Constraints for table likeUsuario
--
ALTER TABLE likeUsuario
  ADD CONSTRAINT likeUsuario_ibfk_1 FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
  ADD CONSTRAINT likeUsuario_ibfk_2 FOREIGN KEY (id_respuesta) REFERENCES respuestas (id_respuesta);

--
-- Constraints for table posts
--
ALTER TABLE posts
  ADD CONSTRAINT posts_ibfk_1 FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
  ADD CONSTRAINT posts_ibfk_2 FOREIGN KEY (id_tema) REFERENCES temas (id_tema);

--
-- Constraints for table respuestas
--
ALTER TABLE respuestas
  ADD CONSTRAINT respuestas_ibfk_1 FOREIGN KEY (id_post) REFERENCES posts (id_post),
  ADD CONSTRAINT respuestas_ibfk_2 FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
