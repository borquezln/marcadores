<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();
    require "../modelo/Consultas.php";
    $co = new Consultas;

    $listaUsuarios = $co->listarUsuarios();
    require "../vista/usuarios.php";
} else {
    header("Location: sesion-vencida.php");
}
