<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();
    $listMapas = [
        "Carteles",
        "Locales",
        "Puestos"
    ];

    require "../vista/inicio.php";
} else {
    header("Location: sesion-vencida.php");
}
