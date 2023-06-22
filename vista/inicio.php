<!DOCTYPE html>
<html>

<head>
    <title>Panel de usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <h2>Bienvenido/a <?= $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?></h2>
    </header>

    <main>
        <?php
        if (isset($_SESSION['creadoOk'])) {
        ?>
            <div>
                <p>Marcador creado correctamente</p>
            </div>
        <?php
            unset($_SESSION['creadoOk']);
        } else if (isset($_SESSION['creadoErr'])) {
        ?>
            <div>
                <p>Hubo problemas al crear su marcador. Inténtelo nuevamente.</p>
            </div>
        <?php
            unset($_SESSION['creadoErr']);
        }
        ?>

        <h3><a href="/crear-cartel">Crear cartel</a></h3>

        <h3><a href="/crear-puesto">Crear puesto</a></h3>

        <?php
        if ($_SESSION['tipoUsuario'] == 1) {
        ?>
            <form method="post" action="mapa">
                <h3>Elegir tipo de mapa</h3>
                <select name="categoria" required>
                    <option value="" selected>Seleccione...</option>
                    <?php
                    foreach ($listMapas as $mapa) {
                    ?>
                        <option value="<?= $mapa; ?>"><?= $mapa; ?></option>
                    <?php
                    }
                    ?>
                </select>
                </br>
                <input type="submit" value="Buscar" name="buscar_cat">
            </form>
        <?php
        }
        ?>
    </main>
</body>

</html>