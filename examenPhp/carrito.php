<?php
session_start();
require_once "funciones.php";

$precios = [
    "Libro 1 - PHP básico" => $_SESSION["precio1"],
    "Libro 2 - HTML y CSS" => $_SESSION["precio2"],
    "Libro 3 - JavaScript para principiantes" => $_SESSION["precio3"]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "procesando formulario";

    $errores = [];

    if (empty(validarNombre($_POST["nombre"]))) {
        $nombre = $_POST["nombre"];
        setcookie("nombre", invertirNombre($nombre), time() + 90);
    } elseif (!isset($_COOKIE["nombre"])) {
        $errores[] = "El nombre es obligatorio.";
    }

    if (empty(validarProducto($_POST["producto"]))) {
        $producto = $_POST["producto"];
    } else {
        $errores[] = "El producto es obligatorio.";
    }

    if (empty(validarCantidad($_POST["cantidad"]))) {
        $cantidad = (int) $_POST["cantidad"];
    } else {
        $errores[] = "La cantidad es obligatoria y debe ser múltiplo de 3.";
    }

    //como enviar los errores a tienda.php para visualizarlos allí
    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        header("Location: tienda.php");
        exit;
    } else {
        if (!isset($_SESSION['carrito'])) {
            echo "inicializo carrito";
            $_SESSION['carrito'] = [];
        } else {
            echo "ya existe carrito";
        }

        if (isset($_POST["producto"]) && isset($_POST["cantidad"])) {
            $producto = $_POST["producto"];
            $cantidad = (int) $_POST["cantidad"];

            switch ($producto) {
                case "Libro 1 - PHP básico":
                    $precio = $_SESSION["precio1"];
                    break;
                case "Libro 2 - HTML y CSS":
                    $precio = $_SESSION["precio2"];
                    break;
                case "Libro 3 - JavaScript para principiantes":
                    $precio = $_SESSION["precio3"];
                    break;
                default:
                    $precio = 0;
            }

            $_SESSION['carrito'][] = array(
                'producto' => $producto,
                'precio' => $precio,
                'cantidad' => $cantidad
            );

            var_dump($_SESSION['carrito']);
        }
    }



    //header("Location: carrito.php");
    //exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de la compra</title>
</head>

<body>
    <h1>Carrito de la compra</h1>

    <p><a href="tienda.php">Ir a la tienda</a></p>

    <?php if (isset($_SESSION['carrito'])) { ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario (€)</th>
                <th>Subtotal (€)</th>
            </tr>
            <?php
            foreach ($_SESSION['carrito'] as $item) {
                $subtotal = $item['precio'] * $item['cantidad'];
                echo "<tr>";
                echo "<td>" . $item['producto'] . "</td>";
                echo "<td>" . $item['cantidad'] . "</td>";
                echo "<td>" . $item['precio'] . "</td>";
                echo "<td>" . $subtotal . "</td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong><?php echo totalGeneral($_SESSION["carrito"], $precios) ?></strong></td>
            </tr>
        </table>
    <?php } else { ?>
        <p>El carrito está vacío.</p>
    <?php } ?>



    <p>
        <a href="tienda.php">Seguir comprando</a>
        <a href="reset.php">Vaciar carrito</a>
    </p>
</body>

</html>