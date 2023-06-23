<!DOCTYPE html>
<html>

<head>
    <title>Registrarse</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    if (isset($_SESSION["registrado"])) {
    ?>
        <p>Su solicitud de registro ha sido enviada. Pronto recibirá un correo a la brevedad confirmando que puede usar su cuenta.</p>
        <a href="/">Volver al inicio</a>
    <?php
        unset($_SESSION["registrado"]);
    } else {
    ?>
        <header>
            <div>
                <h2>Formulario de registro</h2>
            </div>
        </header>
        <main>
            <?php
            if (isset($_SESSION["registroErr"])) {
            ?>
                <div>
                    <p>Hubo problemas al registrarse. Inténtelo nuevamente.</p>
                </div>
            <?php
                unset($_SESSION["registroErr"]);
            }
            ?>
            <form action="../controlador/registro-form.php" method="post">
                <p>Ingrese sus datos para registrarse</p>

                <div>
                    <label for="dni">
                        Documento:<br>
                        <input type="number" name="dni" min="1000000" max="100000000" id="dni" placeholder="DNI" required>
                    </label>
                </div>
                <br>
                <div>
                    <label for="nombre">
                        Nombre:<br>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                    </label>
                </div>
                <br>
                <div>
                    <label for="apellido">
                        Apellido:<br>
                        <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>
                    </label>
                </div>
                <br>
                <div>
                    <label for="mail">
                        Mail:<br>
                        <input type="text" name="mail" id="mail" placeholder="Mail" required>
                    </label>
                </div>
                <br>
                <div>
                    <label for="floatingPassword">
                        Contraseña:<br>
                        <input type="password" name="password" id="floatingPassword" placeholder="Contraseña" required>
                    </label>
                </div>
                <br>
                <div>
                    <button type="submit">Registrarse</button>
            </form>
        <?php
    }
        ?>
        </main>
</body>

</html>