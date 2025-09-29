-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2025 at 08:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_gestion_examenes`
--

-- --------------------------------------------------------

--
-- Table structure for table `examen`
--

CREATE TABLE `examen` (
  `id` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `nombre_examen` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examen`
--

INSERT INTO `examen` (`id`, `id_usuarios`, `nombre_examen`, `status`) VALUES
(1, 2, 'Geografía', '1'),
(2, 2, 'Matemática', 'activo'),
(3, 17, 'Matemáticas', 'activo'),
(4, 17, 'Historia', 'activo'),
(5, 17, 'Ciencias Sociales', 'activo'),
(6, 20, 'programacion', 'activo'),
(8, 16, 'Analisis', '1'),
(9, 2, 'Ciencias Sociales', '1'),
(10, 2, 'Problemas Políticos', '1'),
(11, 21, '213', 'activo'),
(12, 21, '213', 'activo'),
(13, 21, 'Matemática 3', 'activo'),
(14, 21, 'Matemática 3', 'activo'),
(15, 21, 'Matemática 3', 'activo'),
(16, 22, 'Administración', '1'),
(23, 22, 'programacion', 'activo'),
(24, 22, 'programacion', 'activo'),
(25, 22, 'practicas profesionalizantes', 'activo'),
(26, 22, 'programacion', 'activo'),
(27, 22, 'programacion', 'activo'),
(28, 22, 'Analisis', 'activo'),
(29, 22, 'Analisis', 'activo'),
(30, 22, 'programacion', 'activo'),
(31, 22, 'Mates', '1'),
(32, 23, 'Tejido 2', '0'),
(33, 23, 'programacion', '1'),
(34, 23, 'programacion', 'activo'),
(35, 23, 'Analisis', 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `id_examen` int(11) NOT NULL,
  `texto_pregunta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preguntas`
--

INSERT INTO `preguntas` (`id`, `id_examen`, `texto_pregunta`) VALUES
(1, 4, '¿Cuándo fue la primera guerra mundial?'),
(2, 4, '¿Cuándo fue la primera guerra mundial?'),
(3, 4, 'guerra\r\n'),
(4, 4, 'guerradd\r\n'),
(5, 3, 'jj'),
(6, 5, 'Quien fue San Martin'),
(7, 3, '2 + 3'),
(8, 4, 'vv'),
(9, 6, 'que es la programacion\r\n'),
(10, 6, 'que es la programacion\r\n'),
(11, 6, 'hola'),
(12, 6, 'hola'),
(17, 9, 'Hola'),
(19, 2, 'ffff'),
(26, 1, 'Donde esta Argentina'),
(27, 1, 'Que es Entre Ríos'),
(28, 1, 'Donde queda el glaciar Perito Moreno'),
(29, 10, 'Quien es Macri'),
(30, 10, 'MILEI'),
(31, 10, 'Who\'s Milei?'),
(32, 10, 'How many years is have Milei\'s dogs?'),
(33, 10, 'Who\'s the Karina\'s boyfriend?'),
(34, 10, 'Did Karina stole Argentinian people?'),
(35, 10, 'What politic flag are you going to vote for?'),
(38, 27, 'que es la programacion'),
(40, 27, 'nueva roma'),
(46, 31, 'holaaaaaa'),
(47, 32, 'que es la costura artesanal'),
(49, 32, 'que es la costura artesanal de forma grupal'),
(51, 33, 'jjjjjjjj'),
(52, 35, '2'),
(53, 35, 'e2'),
(54, 35, 'e2e2e'),
(55, 35, '32ee2'),
(56, 35, 'r43f'),
(57, 35, 'irrijo4o'),
(58, 35, '3ij3rj4rj3r'),
(59, 35, 'onienfofir');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'alesio13', '$2y$10$jn9hMUYY/tetBUv6BMe6r.Nk.nJzd/Y2OLCakIvCDsi'),
(2, 'alesio13', 'hero20173123'),
(3, 'e1f', 'hero201723'),
(4, '31', '123'),
(5, 'alesio3123', 'hero2017313'),
(6, 'alesio111111111111', 'hero2017'),
(7, 'alesio2', 'hero20172'),
(8, 'alesio111', 'hero20172313'),
(9, 'alesio111', 'hero20172313'),
(10, 'susana', 'hero2017'),
(11, 'alesioeee', 'hero2017'),
(12, 'alesio', 'hero2017'),
(13, 'alesio', 'hero2017'),
(14, 'alesio', 'hero2017'),
(15, 'alesio', 'hero2017'),
(16, 'alesio2020', 'hero2017'),
(17, 'test', '123'),
(18, 'alesionunez', '2121'),
(19, 'lolo', '23'),
(20, 'matias', '10'),
(21, 'nunez', '123'),
(22, 'Alesio2024', '2024'),
(23, 'claudia', '12345'),
(24, 'Manolo', '$2y$10$YbX1TsP1rKxDj9Ozt/lggOGLWHtqhEBJeG0tP7gAZN5'),
(25, 'manolo1', '$2y$10$Aiu1e6X4rNPSbWb5zWnaV.iw08K6qy5SHe7U33INSlT'),
(26, 'manolo2', '$2y$10$qwOYWC6X.xWFI0M0LuoIoOLmh0noU4WwR8unJ36UyQA'),
(27, 'juan', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuarios` (`id_usuarios`);

--
-- Indexes for table `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preguntas_ibfk_1` (`id_examen`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `examen_ibfk_1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`id_examen`) REFERENCES `examen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
