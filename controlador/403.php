<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();
    require "../vista/403.php";
} else {
    header("Location: sesion-vencida.php");
}
