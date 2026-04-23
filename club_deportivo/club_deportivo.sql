CREATE DATABASE club_deportivo;
USE club_deportivo;

-- 1. Usuarios (Jugadores)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nivel ENUM('Principiante', 'Intermedio', 'Avanzado') DEFAULT 'Principiante'
);

-- 2. Pistas
CREATE TABLE pistas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, -- Ej: Pista Cristal 1, Pista Muro 2
    tipo VARCHAR(30), -- Cubierta o Exterior
    precio_hora DECIMAL(5,2)
);

-- 3. Reservas (La tabla relacional)
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_pista INT,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    estado ENUM('Confirmada', 'Pagada', 'Cancelada') DEFAULT 'Confirmada',
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_pista) REFERENCES pistas(id)
);

INSERT INTO pistas (nombre, tipo, precio_hora) VALUES 
('Pista Central', 'Cubierta', 15.00),
('Pista 2', 'Exterior', 10.00),
('Pista 3', 'Cristal Exterior', 12.00);