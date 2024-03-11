CREATE DATABASE IF NOT EXISTS impresoras_db;
USE impresoras_db;

CREATE TABLE impresoras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(45) NOT NULL,
    modelo VARCHAR(45) NOT NULL,
    tipo ENUM('inyección de tinta', 'laser', 'matricial') NOT NULL,
    color BOOLEAN NOT NULL,
    año YEAR NOT NULL,
    coste DECIMAL(10, 2) NOT NULL
);

INSERT INTO impresoras (marca, modelo, tipo, color, año, coste)
VALUES
    ('HP', 'OfficeJet Pro 9025', 'inyección de tinta', TRUE, '2022', 299.99),
    ('Epson', 'EcoTank ET-4760', 'inyección de tinta', TRUE, '2021', 499.99),
    ('Brother', 'HL-L2350DW', 'laser', FALSE, '2019', 129.99),
    ('Canon', 'PIXMA TR4520', 'inyección de tinta', TRUE, '2020', 79.99),
    ('Xerox', 'WorkCentre 6515', 'laser', TRUE, '2018', 399.99);