<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = "";
}

if (isset($_SESSION['contraseña'])) {
    $_SESSION['contraseña'] = '';
}

if (!isset($_SESSION['logueado'])) {
    $_SESSION['logueado'] = false;
}

if (!$_SESSION['logueado']) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carrito</title>
    </head>

    <body>
        <h1>LOGIN ADMINISTRACIÓN DE PRODUCTOS</h1>
        <form action="" method="post">
            <label for="Usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario">
            <br><br>
            <label for="Contraseña">Contraseña: </label>
            <input type="password" name="contraseña" id="contraseña">
            <br><br>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </body>

    </html>
<?php
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'], $_POST['contraseña'])) {
    if ($_POST['usuario'] === "hola" && $_POST['contraseña'] === "123") {
        $_SESSION['logueado'] = true;
        header("Location: newProducto.php");
        exit;
    } else {
        echo '<span style="color: red">Te has equivocado escribiendo la contraseña</span>';
    }
}
?>