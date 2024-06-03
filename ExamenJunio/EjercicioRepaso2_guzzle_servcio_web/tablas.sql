CREATE SCHEMA ejemplo_ex_20232024;

USE ejemplo_ex_20232024;

CREATE TABLE propietarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellidos VARCHAR(50),
    edad INT
);

INSERT INTO propietarios (nombre, apellidos, edad) VALUES
('Juan', 'González Pérez', 35),
('María', 'Martínez López', 40),
('Pedro', 'Díaz Rodríguez', 28),
('Ana', 'Sánchez García', 45);

CREATE TABLE pisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigocomunidad VARCHAR(50),
    localizacion VARCHAR(100),
    cuota DECIMAL(10,2),
    id_propietario INT,
    FOREIGN KEY (id_propietario) REFERENCES propietarios(id)
);


INSERT INTO pisos (codigocomunidad, localizacion, cuota, id_propietario) VALUES
('COM1', 'Planta 1, Piso 1, Puerta A', 120.00, 1),
('COM1', 'Planta 1, Piso 1, Puerta B', 126.00, 1),
('COM1', 'Planta 2, Piso 1, Puerta C', 150.00, 2),
('COM2', 'Planta 1, Piso 2, Puerta D', 58.00, 3),
('COM2', 'Planta 1, Piso 3, Puerta E', 53.00, 3);
