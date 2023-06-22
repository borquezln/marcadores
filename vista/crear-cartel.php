<!DOCTYPE html>
<html>

<head>
    <title>Crear cartel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <h2>Nuevo cartel</h2>
    </header>
    <main>
        <form enctype="multipart/form-data" action="../controlador/crear-form.php" method="POST">
            <div>
                <input type="hidden" name="marcador" value="carteles">

                <label for="direccion">
                    Dirección del cartel: <input name="direccion" value="" required>
                </label>
                <br>
                <button type="button" id="localizacionBoton">Obtener ubicación</button>
                <br>
                <label for="latitud">
                    Latitud:
                    <textarea id="latitudTextarea" name="latitud" rows="1" readonly required></textarea>
                </label>
                <br>
                <label for="longitud">
                    Longitud:
                    <textarea id="longitudTextarea" name="longitud" rows="1" readonly required></textarea>
                </label>
                <br>
                <label for="foto">
                    Foto:
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="file" name="foto" accept=".jpg,.jpeg">
                </label>
                <br>
            </div>
            <div>
                <button type="submit">Crear cartel</button>
            </div>
        </form>
    </main>

    <script defer src="../scripts/getCurrentPosition.js"></script>
</body>

</html>