<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();
    require "../modelo/Consultas.php";
    $co = new Consultas();

    $marcador = $_POST["marcador"];
    $direccion = $_POST["direccion"];
    $latitud = $_POST["latitud"];
    $longitud = $_POST["longitud"];
    $foto = $_FILES["foto"];

    $fichero = "../fotos/";
    $ruta = $fichero . basename($foto["name"]);
    move_uploaded_file($foto["tmp_name"], $ruta);

    if ($co->crearMarcador($marcador, $direccion, $latitud, $longitud, $ruta, $_SESSION["dni"])) {
        $_SESSION["creadoOk"] = true;
    } else {
        $_SESSION["creadoErr"] = true;
    }
    header("Location: /inicio");
} else {
    header("Location: sesion-vencida");
}
