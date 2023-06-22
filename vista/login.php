<!DOCTYPE html>
<html>

<head>
    <title>Iniciar Sesión</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <h1>Ingreso al sistema de marcadores</h1>
    </header>

    <main>
        <?php
        if (isset($_SESSION['noAuto'])) {
        ?>
            <div>
                <p>Su cuenta no está dada de alta. Será informado cuando pueda ingresar</p>
            </div>
        <?php
            unset($_SESSION['noAuto']);
        } else if (isset($_SESSION['errLogin'])) {
        ?>
            <div>
                <p>Datos Erróneos. Ingrese nuevamente</p>
            </div>
        <?php
            unset($_SESSION['errLogin']);
        }
        ?>
        <form action="controlador/login-form.php" method="post">
            <h4>Acceder</h4>
            <p>Ingrese sus credenciales para acceder</p>

            <div>
                <label for="dni">
                    Documento:<br>
                    <input type="number" name="dni" min="1000000" max="100000000" id="dni" placeholder="DNI" required>
                </label>
            </div>
            <br>
            <div>
                <label for="password">
                    Contraseña:<br>
                    <input type="password" name="password" id="password" placeholder="Contraseña">
                </label>
            </div>
            <br>
            <div>
                <button type="submit">Acceder</button>
            </div>
            <br>
            <a href="password">Olvidé mi contraseña</a>
            <br>
            <a href="registro">Registrarme</a>
        </form>
    </main>
</body>

</html>