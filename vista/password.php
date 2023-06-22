<!DOCTYPE html>
<html>

<head>
    <title>Resetear contraseña</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    if (isset($_SESSION['reseteado'])) {
    ?>
        <div>
            <p>Si su DNI se encuentra en nuestra base de datos, recibirá un correo a la brevedad con su nueva contraseña.</p>
            <a href="/">Volver al inicio</a>
        </div>
        <?php
        unset($_SESSION['reseteado']);
    } else {
        if (isset($_SESSION['resetErr'])) {
        ?>
            <p>Hubo problemas al resetear su contraseña. Inténtelo nuevamente.</p>
        <?php
            unset($_SESSION['resetErr']);
        }
        ?>
        <header>
            <h2>Resetear contraseña</h2>
        </header>
        <main>
            <form action="controlador/password-form.php" method="post">
                <p>Ingrese su DNI para resetear su contraseña</p>
                <div>
                    <label for="dni">
                        Documento:<br>
                        <input type="number" name="dni" min="1000000" max="100000000" id="dni" placeholder="DNI" required>
                    </label>
                </div>
                <br>
                <div>
                    <button type="submit">Acceder</button>
                </div>
            </form>
        </main>
    <?php
    }
    ?>
</body>

</html>