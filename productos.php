<?php

$productos = isset($_COOKIE['productos']) ? unserialize($_COOKIE['productos']) : [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Productos</title>
</head>

<body>
    <h1>ADMINISTRACIÓN DE PRODUCTOS</h1>
    <h3>Lista de Productos</h3>
    <a href="deslogar.php">Deslogar</a>
    <hr>

    <?php if (!empty($productos)): ?>
        <ul>
            <?php foreach ($productos as $index => $producto): ?>
                <li>
                    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Imagen del producto">
                    <br>
                    <strong>Código:</strong> <?php echo htmlspecialchars($producto['codigo']); ?><br>
                    <strong>Nombre:</strong> <?php echo htmlspecialchars($producto['nombre']); ?><br>
                    <strong>Precio:</strong> <?php echo htmlspecialchars($producto['precio']); ?><br>
                    <strong>Detalles:</strong> <?php echo htmlspecialchars($producto['detalles']); ?><br>
                    <br>

                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="eliminar" value="<?php echo $index; ?>">
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                    </form>

                    <form action="modificar_producto.php" method="get" style="display:inline;">
                        <input type="hidden" name="modificar" value="<?php echo $index; ?>">
                        <button type="submit">Modificar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay productos guardados.</p>
    <?php endif; ?>

    <hr>
    <a href="newProducto.php">Nuevo Producto</a>
    <a href="tienda.php">Ir a la tienda</a>
</body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $index = (int)$_POST['eliminar'];
    $productos = isset($_COOKIE['productos']) ? unserialize($_COOKIE['productos']) : [];

    if (isset($productos[$index])) {
        unset($productos[$index]);
        $productos = array_values($productos);
        setcookie('productos', serialize($productos), time() + 3600, '/');
    }

    header("Location: productos.php"); 
    exit;
}
?>

</html>
