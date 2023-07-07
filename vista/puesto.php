<!DOCTYPE html>
<html>

<head>
    <title>Puesto</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    echo "<h2>$puesto - {$encargados[0]['nombre_p']}</h2>";
    foreach ($encargados as $encargado) {
    ?>
        <p>Encargado/a: <?= $encargado['nombre_e'] ?></p>
        <p>Celular: <a href="tel:<?= $encargado['celular'] ?>"><?= $encargado['celular'] ?></a></p>
    <?php
    }
    ?>

    <input type=button name=boton value=Cerrar onclick="window.close()">
</body>

</html>