<?php
session_start();
require_once 'db.php';
require_once 'funciones_tests.php';
require_once 'funciones_resultados.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
} else {
    $msg = "";
}

$tipo = $_SESSION['tipo'];

$tests = obtener_tests($conexion);
$resultados = obtener_resultados_usuario($conexion, $_SESSION['id_usuario']);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Tests</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        /* Un par de ajustes extra para que el panel no sea una tarjeta pequeña */
        body {
            display: block;
            background: #f4f7f6;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Hola, <?php echo $_SESSION['nombre']; ?></h1>
            <a href="logout.php" style="color: red;">Cerrar Sesión</a>
        </header>
        <?php if ($msg): ?>
            <div class="form-card">
                <p style="color: red; text-align: center;"><?php echo $msg; ?></p>
            </div>
        <?php endif; ?>
        <?php if ($tipo === 'admin'): ?>
            <form action="crear_test.php" method="POST" style="margin-bottom: 20px;">
                <input type="text" name="titulo" placeholder="Título del Test" required>
                <button type="submit">Crear Test</button>
            <?php endif; ?>

            <h2>Tests Disponibles</h2>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($tests): ?>
                        <?php foreach ($tests as $test): ?>
                            <tr>
                                <td><?php echo $test['titulo']; ?></td>
                                <td><a href="realizar_test.php?id=<?php echo $test['id_test']; ?>">Realizar Test</a>
                                    <?php if ($tipo === 'admin'): ?>
                                        <a href="eliminar_test.php?id=<?php echo $test['id_test']; ?>">Eliminar</a>
                                        <a href="editar_test.php?id=<?php echo $test['id_test']; ?>">Editar</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay tests disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <h2>Mis Resultados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Test</th>
                        <th>Fecha</th>
                        <th>Aciertos</th>
                        <th>Preguntas Totales</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($resultados): ?>
                    <?php foreach ($resultados as $resultado): ?>
                        <tr>
                            <td><?php echo $resultado['titulo']; ?></td>
                            <td><?php echo $resultado['fecha']; ?></td>
                            <td><?php echo $resultado['aciertos']; ?></td>
                            <td><?php echo $resultado['total_preguntas']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No hay resultados aún.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            </table>
    </div>
</body>

</html>