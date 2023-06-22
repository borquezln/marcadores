<?php
session_start();

require "../modelo/Consultas.php";
$dni = $_POST["dni"];
$co = new Consultas();

if ($co->resetPassword($dni)) {
    $_SESSION["reseteado"] = true;
} else {
    $_SESSION["resetErr"] = true;
}
header("Location: /password");