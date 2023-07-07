<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();
    require "../modelo/Consultas.php";
    $co = new Consultas;

    if ($_SESSION["tipoUsuario"] != 2) {
        $puesto = $_SERVER["QUERY_STRING"];
        $encargados = $co->datosPuesto($puesto);

        require "../vista/puesto.php";
    } else {
        header("Location: 403.php");
    }
} else {
    header("Location: sesion-vencida.php");
}
