<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();

    if ($_SESSION["tipoUsuario"] != 2) {
        require "../vista/crear-puesto.php";
    } else {
        header("Location: 403.php");
    }
} else {
    header("Location: sesion-vencida.php");
}
