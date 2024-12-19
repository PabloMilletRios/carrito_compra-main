<?php
require_once "seguridad.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoProducto = [
        'codigo' => $_POST['codigo'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio'],
        'detalles' => $_POST['detalles'],
        'imagen' => "assets/" . $_POST['imagen']
    ];

    
    $productos = isset($_COOKIE['productos']) ? unserialize($_COOKIE['productos']) : [];
    $productos[] = $nuevoProducto;
    setcookie('productos', serialize($productos), time() + 3600,'/');
    header("Location: productos.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
</head>

<body>
    <H1>ADMINISTRACIÓN DE PRODUCTOS</H1>
    <h3>Nuevo Producto</h3>
    <hr>
    <form action="" method="post">
        <label for="Codigo">Codigo: </label>
        <input type="text" name="codigo" id="codigo">
        <br>
        <br>
        <label for="Nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <br>
        <label for="Precio">Precio: </label>
        <input type="text" name="precio" id="precio">
        <br>
        <br>
        <label for="Detalles">Detalles: </label>
        <textarea name="detalles" id="detalles"></textarea>
        <br>
        <br>
        <label for="Imagen">Imagen: </label>
        <input type="text" name="imagen" id="imagen">
        <br>
        <button type="submit">Guardar</button>
        <br>
        <button type="button">Volver</button>
    </form>
    <hr>
</body>

</html>