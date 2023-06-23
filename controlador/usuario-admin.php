<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();
    $dni = $_POST["dni"];

    require "../modelo/Consultas.php";
    $co = new Consultas;
    if ($co->hacerAdmin($dni)) {
        $_SESSION["adminOk"] = true;
    } else {
        $_SESSION["adminErr"] = true;
    }

    header("Location: usuarios.php");
} else {
    header("Location: sesion-vencida.php");
}
