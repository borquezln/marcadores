<!DOCTYPE html>
<html>

<head>
    <title>Panel de usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <h2>Bienvenido/a <?= $_SESSION["nombre"] . " " . $_SESSION["apellido"] ?></h2>
    </header>

    <main>
        <?php
        if (isset($_SESSION["creadoOk"])) {
        ?>
            <div>
                <p>Marcador creado correctamente</p>
            </div>
        <?php
            unset($_SESSION["creadoOk"]);
        } else if (isset($_SESSION["creadoErr"])) {
        ?>
            <div>
                <p>Hubo problemas al crear su marcador. Inténtelo nuevamente.</p>
            </div>
        <?php
            unset($_SESSION["creadoErr"]);
        }

        if ($_SESSION["tipoUsuario"] != 3) {
        ?>
            <h3><a href="../controlador/crear-cartel.php">Crear cartel</a></h3>

            <h3><a href="../controlador/crear-local.php">Crear punto fijo</a></h3>
            <?php
            if ($_SESSION["tipoUsuario"] == 1) {
            ?>
                <h3><a href="../controlador/usuarios.php">Administración de usuarios</a></h3>
            <?php
            }
        }
        if ($_SESSION["tipoUsuario"] != 2) {
            ?>
            <form method="post" action="../controlador/mapa.php">
                <h3>Elija el mapa que desea ver:</h3>
                <select name="categoria" required>
                    <option value="" selected>Seleccione...</option>
                    <?php
                    foreach (array_keys($listMapas) as $key) {
                    ?>
                        <option value="<?= $key ?>"><?= $listMapas[$key] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="submit">
            </form>
        <?php
        }
        ?>
    </main>
</body>

</html>