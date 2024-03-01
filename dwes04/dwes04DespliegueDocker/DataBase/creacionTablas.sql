SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

USE `dwes04tarea`;

DROP TABLE IF EXISTS `talleres`;
CREATE TABLE talleres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    ubicacion VARCHAR(255),
    dia_semana VARCHAR(20) NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    cupo_maximo INT,
    CONSTRAINT chk_horario CHECK (hora_inicio < hora_fin)
);

INSERT INTO talleres (nombre, descripcion, ubicacion, dia_semana, hora_inicio, hora_fin, cupo_maximo) VALUES
('Arte Creativo', 'Taller de expresión artística para fomentar la creatividad', 'Centro Comunitario XYZ', 'Lunes', '15:00:00', '17:00:00', 20),
('Música y Ritmo', 'Clases de música y ritmo para desarrollar habilidades musicales', 'Escuela Municipal ABC', 'Lunes', '17:30:00', '19:30:00', 15),
('Club de Lectura', 'Espacio para fomentar el hábito de la lectura y el pensamiento crítico', 'Biblioteca Pública Z', 'Martes', '14:00:00', '16:00:00', 25),
('Deporte en Equipo', 'Actividades deportivas para promover el trabajo en equipo', 'Polideportivo Municipal', 'Martes', '17:30:00', '19:30:00', 18),
('Tecnología y Aprendizaje', 'Taller de informática y nuevas tecnologías', 'Centro Juvenil W', 'Miércoles', '15:00:00', '17:00:00', 22),
('Baile y Movimiento', 'Clases de baile para fomentar la actividad física y la diversión', 'Centro Recreativo M', 'Miércoles', '17:30:00', '19:30:00', 20),
('Cine y Debate', 'Proyecciones y discusiones sobre películas con temáticas educativas', 'Sala Audiovisual N', 'Jueves', '16:00:00', '18:00:00', 15),
('Ciencia Divertida', 'Experimentos y actividades científicas para despertar la curiosidad', 'Laboratorio Educativo P', 'Jueves', '18:30:00', '20:30:00', 18),
('Juegos de Mesa', 'Torneos y partidas de juegos de mesa para estimular el pensamiento estratégico', 'Centro Recreativo Q', 'Viernes', '15:30:00', '17:30:00', 25),
('Teatro y Improvisación', 'Taller de teatro para desarrollar habilidades escénicas y comunicativas', 'Teatro Municipal R', 'Viernes', '18:00:00', '20:00:00', 20);