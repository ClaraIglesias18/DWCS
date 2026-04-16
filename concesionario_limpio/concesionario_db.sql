CREATE DATABASE IF NOT EXISTS concesionario_db;
USE concesionario_db;

CREATE TABLE marcas (
    id_marca INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    pais VARCHAR(50) NOT NULL
);

CREATE TABLE modelos (
    id_modelo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    anio INT NOT NULL,
    id_marca INT NOT NULL,
    CONSTRAINT fk_marca
        FOREIGN KEY (id_marca) 
        REFERENCES marcas(id_marca)
        ON DELETE CASCADE
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);


INSERT INTO marcas (nombre, pais) VALUES 
('Toyota', 'Japón'),
('Seat', 'España'),
('Tesla', 'EE.UU.');

INSERT INTO modelos (nombre, anio, id_marca) VALUES 
('Corolla', 2022, 1),
('RAV4', 2023, 1);

INSERT INTO modelos (nombre, anio, id_marca) VALUES 
('Ibiza', 2021, 2),
('León', 2022, 2);

INSERT INTO modelos (nombre, anio, id_marca) VALUES 
('Model 3', 2023, 3),
('Model Y', 2022, 3);