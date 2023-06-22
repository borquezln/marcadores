<?php
// Router
$path = parse_url($_SERVER["REQUEST_URI"])["path"];

$routes = [
    "/" => "controlador/login.php",
    "/mapa" => "controlador/mapa.php",
    "/inicio" => "controlador/inicio.php",
    "/registro" => "controlador/registro.php",
    "/password" => "controlador/password.php",
    "/crear-puesto" => "controlador/crear-puesto.php",
    "/crear-cartel" => "controlador/crear-cartel.php",
    "/sesion-vencida" => "controlador/sesion-vencida.php"
];

function abort($code = 404)
{
    http_response_code($code);
    require "controlador/{$code}.php";
}

function routeToControlador($path, $routes)
{
    if (array_key_exists($path, $routes)) {
        require $routes[$path];
    } else {
        abort();
    }
}

routeToControlador($path, $routes);
