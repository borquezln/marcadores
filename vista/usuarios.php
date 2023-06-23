<!DOCTYPE html>
<html>

<head>
    <title>Administración de usuarios</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        table {
            border-collapse: collapse;
        }

        td,
        th {
            border: black 1px solid;
        }
    </style>
</head>

<body>
    <header>
        <h2>Panel de administración de usuarios</h2>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Último acceso</th>
                    <th>Tipo de usuario</th>
                    <th>Estado usuario</th>
                    <th>Estado contraseña</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listaUsuarios as $usuario) {
                ?>
                    <tr>
                        <td><?= $usuario["dni"] ?></td>
                        <td><?= $usuario["nombre"] ?></td>
                        <td><?= $usuario["apellido"] ?></td>
                        <td><?= $usuario["mail"] ?></td>
                        <td>
                            <?php
                            if ($usuario["inicio_sesion"] != "" || $usuario["inicio_sesion"] != null) {
                                $date = date_create($usuario["inicio_sesion"]);
                                $ultimologin = date_format($date, "d/m/Y H:i:s");
                                echo $ultimologin;
                            } else {
                                echo $usuario["inicio_sesion"];
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $usuario["tipo_usuario"];
                            if ($usuario["tipo_usuario"] == "Usuario") {
                            ?>
                                <form method="post" action="../controlador/usuario-admin.php">
                                    <input type="hidden" name="dni" value="<?= $usuario['dni'] ?>">
                                    <input type="submit" value="Hacer administrador">
                                </form>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $usuario["estado_usuario"];
                            if ($usuario["estado_usuario"] == "No autorizado") {
                            ?>
                                <form method="post" action="../controlador/usuario-activar.php">
                                    <input type="hidden" name="dni" value="<?= $usuario['dni'] ?>">
                                    <input type="submit" value="Autorizar">
                                </form>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $usuario["estado_password"];
                            if ($usuario["estado_password"] == "No activa") {
                            ?>
                                <form method="post" action="../controlador/usuario-reset.php">
                                    <input type="hidden" name="dni" value="<?= $usuario['dni'] ?>">
                                    <input type="submit" value="Activar">
                                </form>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>