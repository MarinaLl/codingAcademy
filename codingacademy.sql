--
-- Base de dades: `codingacademy`
--

CREATE DATABASE IF NOT EXISTS codingacademy;

--
-- Utilitzar base de dades: `codingacademy`
--

USE codingacademy;

-- --------------------------------------------------------

--
-- Estructura de la taula `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estructura de la taula `course`
--

CREATE TABLE `course` (
  `code` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `difficulty` varchar(255) NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `teacher_email` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `student_email` varchar(255) DEFAULT NULL,
  `course_code` int(11) DEFAULT NULL,
  `grade` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `student`
--

CREATE TABLE `student` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastNames` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `student`
--

INSERT INTO `student` (`email`, `password`, `dni`, `name`, `lastNames`, `age`, `photo`, `active`) VALUES
('alex@gmail.com', '8104aec88ba77a1aba2bfedc07365c12', '456123789', 'alex', 'cedeño', 21, 'img/1695626557-manzana.webp', 1),
('erik@gmail.com', 'df5a13d6b339036c68a7c1890a0a29aa', '456456465', 'erik', 'fernandez', 24, 'img/1695625473-manzana.webp', 1),
('joel@gmail.com', '61b5226c99caf675a364c1b0f24a846d', '456132E', 'joel', 'gurrera', 21, 'img/1695626442-manzana.webp', 1),
('marina@gmail.com', 'c98a0d7fe575cc92f0cc931db5e31552', '47440654A', 'marina', 'llambrich', 18, 'img/1695625535-manzana.webp', 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `teacher`
--

CREATE TABLE `teacher` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dni` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastNames` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Índexs per a la taula `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`code`),
  ADD KEY `FK_teacher_course` (`teacher_email`);

--
-- Índexs per a la taula `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `FK_student_enrollment` (`student_email`),
  ADD KEY `FK_course_enrollment` (`course_code`);

--
-- Índexs per a la taula `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`email`);

--
-- Índexs per a la taula `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `course`
--
ALTER TABLE `course`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la taula `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `FK_teacher_course` FOREIGN KEY (`teacher_email`) REFERENCES `teacher` (`email`);

--
-- Restriccions per a la taula `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `FK_course_enrollment` FOREIGN KEY (`course_code`) REFERENCES `course` (`code`),
  ADD CONSTRAINT `FK_student_enrollment` FOREIGN KEY (`student_email`) REFERENCES `student` (`email`),
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`student_email`) REFERENCES `student` (`email`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`course_code`) REFERENCES `course` (`code`);
COMMIT;


-- Añadir la tabla category
CREATE TABLE `category` (
  `ID` varchar(255),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `category`(`ID`) VALUES ('beginner-friendly');
INSERT INTO `category`(`ID`) VALUES ('web-development');
INSERT INTO `category`(`ID`) VALUES ('game-development');
INSERT INTO `category`(`ID`) VALUES ('computer-science');

-- Agregar la restricción de clave foránea en la columna existente `category`
ALTER TABLE `course`
  ADD CONSTRAINT `FK_course_category` FOREIGN KEY (`category`) REFERENCES `category` (`ID`);
