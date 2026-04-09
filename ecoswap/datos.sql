USE ecoswap;

-- Insertar 4 Usuarios (La contraseña es '123456' en todos)
-- El hash corresponde a '123456' generado con password_hash
INSERT INTO usuarios (nombre, email, password) VALUES 
('Juan Pérez', 'juan@correo.com', '$2y$10$8W3W.pXkG7M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M'),
('Marta Sánchez', 'marta@correo.com', '$2y$10$8W3W.pXkG7M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M'),
('Carlos Ruiz', 'carlos@correo.com', '$2y$10$8W3W.pXkG7M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M'),
('Elena G.', 'elena@correo.com', '$2y$10$8W3W.pXkG7M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M9M');

-- Insertar Productos de prueba
INSERT INTO productos (vendedor_id, nombre, descripcion, precio, imagen, categoria) VALUES 
(1, 'iPhone 13 - Como nuevo', 'En perfecto estado, 128GB, color azul.', 550.00, 'movil.jpg', 'Electrónica'),
(2, 'Sofá 3 plazas', 'Sofá gris muy cómodo, poco uso por mudanza.', 200.00, 'sofa.jpg', 'Hogar'),
(1, 'Zapatillas Running', 'Talla 42, puestas dos veces.', 45.00, 'zapatillas.jpg', 'Moda'),
(3, 'Cámara Réflex Canon', 'Incluye objetivo 18-55mm y funda.', 320.00, 'camara.jpg', 'Electrónica'),
(4, 'Casco de Moto', 'Talla M, homologado, color negro mate.', 85.00, 'casco.jpg', 'Motor');

-- Insertar algunos Favoritos previos
INSERT INTO favoritos (usuario_id, producto_id) VALUES 
(1, 2), -- A Juan le gusta el sofá de Marta
(2, 1), -- A Marta le gusta el iPhone de Juan
(3, 1); -- A Carlos también le gusta el iPhone de Juan