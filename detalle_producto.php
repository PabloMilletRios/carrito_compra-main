<?php

$productos = isset($_COOKIE['productos']) ? unserialize($_COOKIE['productos']) : [];

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    foreach ($productos as $producto) {
        if ($producto['codigo'] === $codigo) {
            $productoSeleccionado = $producto;
            break;
        }
    }

    if (!isset($productoSeleccionado)) {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "No se proporcionó un código válido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
</head>

<body>
    <h1>Detalles del Producto</h1>
    <img src="<?php echo ($productoSeleccionado['imagen']); ?>" alt="Imagen del producto" width="200">
    <br>
    <strong>Nombre:</strong> <?php echo ($productoSeleccionado['nombre']); ?><br>
    <strong>Precio:</strong> <?php echo ($productoSeleccionado['precio']); ?> €<br>
    <strong>Detalles:</strong> <?php echo ($productoSeleccionado['detalles']); ?><br>
    <br>

    <form action="tienda.php" method="post">
        <input type="hidden" name="comprar" value="<?php echo array_search($productoSeleccionado, $productos); ?>">
        <button type="submit">Comprar</button>
    </form>

    <a href="tienda.php">Volver a la tienda</a>
</body>

</html>
