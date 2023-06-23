<?php
session_start();

require "../modelo/Consultas.php";
$dni = $_POST["dni"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$co = new Consultas();

if ($co->registrarUsuario($dni, $nombre, $apellido, $mail, $password)) {
    $_SESSION["registrado"] = true;
} else {
    $_SESSION["registradoErr"] = true;
}
header("Location: registro.php");