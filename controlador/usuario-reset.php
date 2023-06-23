<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();
    $dni = $_POST["dni"];

    require "../modelo/Consultas.php";
    $co = new Consultas;
    if ($co->resetear($dni)) {
        $_SESSION["resetOk"] = true;
    } else {
        $_SESSION["resetErr"] = true;
    }

    header("Location: /usuarios");
} else {
    header("Location: sesion-vencida");
}
