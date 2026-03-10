<?php
session_start();

if(!isset($_SESSION['lista'])) {
    $_SESSION['lista'] = [];
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['producto'])) {
    $producto = trim($_POST['producto']);
    if($producto) {
        $_SESSION['lista'][] = $producto;
    }
}

if(isset($_GET['item'])) {
    $item = $_GET['item'];
    $key = array_search($item, $_SESSION['lista']);
    unset($_SESSION['lista'][$key]);
    // como se quedo el array con un elemento vacio, lo reindexamos para que no haya problemas al mostrarlo
    $_SESSION['lista'] = array_values($_SESSION['lista']);
}

?>
<!DOCTYPE html>
<html>
    <body>
        <h2>Lista de la compra</h2>
        <form action="lista_compra.php" method="post">
            <input type="text" name="producto" placeholder="Añadir producto">
            <button type="submit">Añadir</button>
        </form>
        <ul>
            <?php foreach($_SESSION['lista'] as $item): ?>
                <li><?= htmlspecialchars($item) ?><a href="lista_compra.php?item=<?= $item ?>"> (Borrar)</a></li>
            <?php endforeach; ?>
            <!-- <li>Pipas</li> -->
        </ul>
    </body>
</html>