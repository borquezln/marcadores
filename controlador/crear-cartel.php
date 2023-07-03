<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();

    if ($_SESSION["tipoUsuario"] != 3) {
        require "../vista/crear-cartel.php";
    } else {
        header("Location: 403.php");
    }
} else {
    header("Location: sesion-vencida.php");
}
