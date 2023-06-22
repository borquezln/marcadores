<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();
    require "modelo/Consultas.php";
    $co = new Consultas;

    if ($_SESSION["tipoUsuario"] == 1) {
        $categoria = $_POST["categoria"];
        $marcadores = $co->listarMarcadores($categoria);
        require "vista/mapa.php";
    } else {
        abort(403);
    }
} else {
    header("Location: sesion-vencida");
}
