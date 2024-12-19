<?php
$productos = isset($_COOKIE['productos']) ? unserialize($_COOKIE['productos']) : [];

session_start();
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comprar'])) {
        $index = (int)$_POST['comprar'];
        if (isset($productos[$index])) {
            $producto = $productos[$index];
            if (isset($_SESSION['carrito'][$producto['codigo']])) {
                $_SESSION['carrito'][$producto['codigo']]['cantidad']++;
            } else {
                $_SESSION['carrito'][$producto['codigo']] = [
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'cantidad' => 1,
                ];
            }
        }
    }

    if (isset($_POST['eliminar'])) {
        $codigo = $_POST['eliminar'];
        if (isset($_SESSION['carrito'][$codigo])) {
            $_SESSION['carrito'][$codigo]['cantidad']--;
            if ($_SESSION['carrito'][$codigo]['cantidad'] <= 0) {
                unset($_SESSION['carrito'][$codigo]);
            }
        }
    }

    header("Location: tienda.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
</head>

<body>
    <h1>Tienda Online</h1>
    <h3>Productos Disponibles</h3>
    <hr>

    <?php if (!empty($productos)): ?>
        <ul>
            <?php foreach ($productos as $index => $producto): ?>
                <li>
                    <img src="<?php echo ($producto['imagen']); ?>" alt="Imagen del producto" width="150">
                    <br>
                    <strong>Nombre:</strong> <?php echo ($producto['nombre']); ?><br>
                    <strong>Precio:</strong> <?php echo ($producto['precio']); ?> €<br>
                    <br>

                    <form action="detalle_producto.php" method="get" style="display:inline;">
                        <input type="hidden" name="codigo" value="<?php echo ($producto['codigo']); ?>">
                        <button type="submit">Detalles</button>
                    </form>

                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="comprar" value="<?php echo $index; ?>">
                        <button type="submit">Comprar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay productos disponibles.</p>
    <?php endif; ?>

    <hr>
    <h3>Carrito</h3>
    <?php if (!empty($_SESSION['carrito'])): ?>
        <ul>
            <?php 
            $total = 0;
            foreach ($_SESSION['carrito'] as $codigo => $item): 
                $total += $item['precio'] * $item['cantidad'];
            ?>
                <li>
                    <strong>Nombre:</strong> <?php echo ($item['nombre']); ?><br>
                    <strong>Precio:</strong> <?php echo ($item['precio']); ?> €<br>
                    <strong>Cantidad:</strong> <?php echo $item['cantidad']; ?><br>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="eliminar" value="<?php echo ($codigo); ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <strong>Total: <?php echo $total; ?> €</strong>
    <?php else: ?>
        <p>El carrito está vacío.</p>
    <?php endif; ?>
</body>

</html>
