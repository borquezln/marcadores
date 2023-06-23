<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();
    $dni = $_POST["dni"];

    require "../modelo/Consultas.php";
    $co = new Consultas;
    if ($co->activar($dni)) {
        $_SESSION["activado"] = true;
    } else {
        $_SESSION["activarErr"] = true;
    }

    header("Location: /usuarios");
} else {
    header("Location: sesion-vencida");
}
