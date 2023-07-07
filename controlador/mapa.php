<?php
session_start();
if (time() - $_SESSION["time"] < 600) {
    $_SESSION["time"] = time();
    require "../modelo/Consultas.php";
    $co = new Consultas;

    if ($_SESSION["tipoUsuario"] != 2) {
        $listMapas = [
            "carteles" => "Carteles",
            "locales" => "Locales",
            "puestos" => "Puestos"
        ];

        $categoria = $_POST["categoria"];
        $marcadores = $co->listarMarcadores($categoria);

        $total = $co->contadorTotal($categoria);

        if ($categoria == "carteles") {
            $tandas = $co->contadorUnicos($categoria, "tanda");
            $porTanda = [];
            for ($i = 1; $i <= $tandas; $i++) {
                $porTanda[$i-1] = $co->contadorPorValor($categoria, "tanda", $i);
            }
        } else if ($categoria == "locales") {
            $distritos = $co->unicos($categoria, "distrito");
            $porDistrito = [];
            foreach($distritos as $distrito) {
                $porDistrito[$distrito] = $co->contadorPorValor($categoria, "distrito", $distrito);
            }
        }

        require "../vista/mapa.php";
    } else {
        header("Location: 403.php");
    }
} else {
    header("Location: sesion-vencida.php");
}
