-- Script de creación de bases de datos para MySQL/MariaDB

DROP DATABASE IF EXISTS dwes_distancia_2223;

CREATE DATABASE dwes_distancia_2223;

USE dwes_distancia_2223;

CREATE TABLE videojuegos (
    id INTEGER,
    titulo VARCHAR(100) NOT NULL,
    desarrollador VARCHAR(100) NOT NULL,
    anio_publicacion INTEGER NOT NULL,
    CONSTRAINT PK_videojuegos PRIMARY KEY (id)
);

INSERT INTO videojuegos VALUES (1, 'The Legend of Zelda: Breath of the Wild', 'Nintendo', 2017);
INSERT INTO videojuegos VALUES (2, 'The Witcher 3: Wild Hunt', 'CD Projekt Red', 2015);
INSERT INTO videojuegos VALUES (3, 'Red Dead Redemption 2', 'Rockstar Games', 2018);
INSERT INTO videojuegos VALUES (4, 'The Elder Scrolls V: Skyrim', 'Bethesda Game Studios', 2011);
INSERT INTO videojuegos VALUES (5, 'The Last of Us', 'Naughty Dog', 2013);
