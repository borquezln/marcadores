<?php
session_start();

require "../modelo/Consultas.php";
$dni = $_POST["dni"];
$password = $_POST["password"];
$co = new Consultas();

if ($co->autenticarUsuario($dni, $password)) {
    $co->inicioSesion($dni);
    $_SESSION["dni"] = $dni;
    $_SESSION["time"] = time();
    $_SESSION["mail"] = $co->listarDatoUsuario($dni, "mail");
    $_SESSION["nombre"] = $co->listarDatoUsuario($dni, "nombre");
    $_SESSION["apellido"] = $co->listarDatoUsuario($dni, "apellido");
    $_SESSION["tipoUsuario"] = $co->listarDatoUsuario($dni, "tipo_usuario");
    $_SESSION["estadoUsuario"] = $co->listarDatoUsuario($dni, "estado_usuario");

    if ($_SESSION["estadoUsuario"] == 1) {
        header("Location: /inicio");
    } else {
        $_SESSION["noAuto"] = true;
        header("Location: /");
    }
} else {
    $_SESSION["errLogin"] = true;
    header("Location: /");
}
