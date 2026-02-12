CREATE DATABASE IF NOT EXISTS gimnasio;

USE gimnasio;

CREATE TABLE usuarios (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    email VARCHAR(100) UNIQUE NOT NULL,

    password VARCHAR(255) NOT NULL,

    rol ENUM('admin', 'miembro') DEFAULT 'miembro'

);

CREATE TABLE clases (

    id INT AUTO_INCREMENT PRIMARY KEY,

    actividad VARCHAR(100) NOT NULL,

    dia_semana VARCHAR(20) NOT NULL, -- Lunes, Martes, etc.

    hora VARCHAR(10) NOT NULL,       -- 10:00, 18:30

    cupo_maximo INT NOT NULL

);

CREATE TABLE reservas (

    id INT AUTO_INCREMENT PRIMARY KEY,

    usuario_id INT,

    clase_id INT,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,

    FOREIGN KEY (clase_id) REFERENCES clases(id) ON DELETE CASCADE

);

-- Datos iniciales de clases

INSERT INTO clases (actividad, dia_semana, hora, cupo_maximo) VALUES 

('Yoga', 'Lunes', '10:00', 15),

('CrossFit', 'Lunes', '18:00', 10),

('Spinning', 'Martes', '09:00', 20),

('Zumba', 'Miércoles', '19:00', 25),

('Boxeo', 'Jueves', '20:00', 12);