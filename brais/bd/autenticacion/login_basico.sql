-- 1. Crear la base de datos
CREATE DATABASE IF NOT EXISTS login_bd CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;

-- 2. Seleccionar la base de datos para trabajar en ella
USE login_bd;

-- 3. Crear la tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Longitud para soportar contraseñas encriptadas
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)