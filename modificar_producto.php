<?php
require_once "seguridad.php";

$productos = isset($_COOKIE['productos']) ? unserialize($_COOKIE['productos']) : [];

if (isset($_GET['modificar'])) {
    $index = (int)$_GET['modificar'];

    if (isset($productos[$index])) {
        $producto = $productos[$index];
    } else {
        echo "Producto no encontrado.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar'])) {
    $index = (int)$_POST['index'];  

    $productos[$index] = [
        'codigo' => $_POST['codigo'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio'],
        'detalles' => $_POST['detalles'],
        'imagen' => $_POST['imagen']
    ];

    setcookie('productos', serialize($productos), time() + 3600, '/');
    header("Location: productos.php");  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    <form action="modificar_producto.php" method="post">
        <input type="hidden" name="index" value="<?php echo $index; ?>">

        <label for="Codigo">Código: </label>
        <input type="text" name="codigo" id="codigo" value="<?php echo ($producto['codigo']); ?>">
        <br><br>

        <label for="Nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="<?php echo ($producto['nombre']); ?>">
        <br><br>

        <label for="Precio">Precio: </label>
        <input type="text" name="precio" id="precio" value="<?php echo ($producto['precio']); ?>">
        <br><br>

        <label for="Detalles">Detalles: </label>
        <textarea name="detalles" id="detalles"><?php echo ($producto['detalles']); ?></textarea>
        <br><br>

        <label for="Imagen">Imagen: </label>
        <input type="text" name="imagen" id="imagen" value="<?php echo ($producto['imagen']); ?>">
        <br><br>

        <button type="submit" name="guardar">Guardar Cambios</button>
    </form>
</body>
</html>
