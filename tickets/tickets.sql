CREATE DATABASE IF NOT EXISTS tickets;
USE tickets;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('empleado', 'tecnico') NOT NULL
);

CREATE TABLE incidencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    prioridad ENUM('Baja', 'Media', 'Alta') DEFAULT 'Media',
    estado ENUM('Abierta', 'En Proceso', 'Resuelta') DEFAULT 'Abierta',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);