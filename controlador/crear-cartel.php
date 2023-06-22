<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();
    require "vista/crear-cartel.php";
} else {
    header("Location: sesion-vencida");
}
