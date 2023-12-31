<!DOCTYPE html>
<html>

<head>
    <title>Mapa de <?= $categoria ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <style>
        #map {
            width: 75vw;
            height: 75vh;
        }
    </style>
</head>

<body>
    <header>
        <h1>Mapa de <?= $listMapas[$categoria] ?></h1>
    </header>
    <main>
        <div id="map">
            <script>
                var chincheta = L.icon({
                    iconUrl: '../img/<?= $categoria ?>.png',
                    iconSize: [27, 41]
                });

                var map = L.map('map').setView([-32.88967672451535, -68.8448381518724], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                    maxZoom: 18,
                }).addTo(map);

                <?php
                foreach ($marcadores as $marcador) {
                ?>
                    var marker = L.marker([<?= $marcador["latitud"] ?>, <?= $marcador["longitud"] ?>], {
                        icon: chincheta
                    }).addTo(map);

                    var direccion = "<b>Dirección:</b> <?= $marcador["direccion"] ?>";
                    <?php
                    if ($categoria == "carteles") {
                    ?>
                        var popup = direccion + "<br><b>Encargado:</b> <?= $marcador["responsable"] ?><br><b>Tanda:</b> <?= $marcador["tanda"] ?>";
                    <?php
                    } else if ($categoria == "locales") {
                    ?>
                        var popup = "<b>Distrito:</b> <?= $marcador["distrito"] ?><br>" + direccion;
                    <?php
                    } else {
                    ?>
                        var popup = '<b>Nombre:</b> <?= $marcador["nombre"] ?><br>' + direccion + '<br><a href="../controlador/puesto.php?<?= $marcador["nro_puesto"] ?>" target="_blank">Más información</a>';
                    <?php
                    }
                    ?>

                    marker.bindPopup(popup);
                <?php
                }
                ?>
            </script>
        </div>

        <section>
            <h2>Totales:</h2>
            <h4>Total de <?= $listMapas[$categoria] ?>: <?= $total ?></h4>
            <?php
            if ($categoria == "carteles") {
                foreach (array_keys($porTanda) as $tanda) {
            ?>
                    <p>Total de tanda <?= $tanda + 1 ?>: <?= $porTanda[$tanda] ?></p>
                <?php
                }
            } else if ($categoria == "locales") {
                foreach ($distritos as $distrito) {
                ?>
                    <p>Total en <?= $distrito ?>: <?= $porDistrito[$distrito] ?></p>
            <?php
                }
            }
            ?>
        </section>
    </main>
</body>

</html>