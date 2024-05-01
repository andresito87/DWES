<?php
include_once __DIR__ . '/monumentos.php';
$provinciaAlAzar = array_rand($monumentos);
$monumentoAlAzar = array_rand($monumentos[$provinciaAlAzar]);
$monumentoAlAzar = $monumentos[$provinciaAlAzar][$monumentoAlAzar];
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Mapa simple de OpenStreetMap con Leaflet</title>
    <!-- Cargar hoja de estilos de leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <style>
        .monumentos-container {
            display: flex;
            flex-wrap: wrap;
        }

        .provincia-monumentos {
            width: 400px;
            max-width: 100%;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;

        }
    </style>
</head>

<body>
    <h1>Los dos mejores monumentos de cada provincia de Andalucía</h1>
    <!-- Cargar la librería Javascript leafleft 1.9.3 desde el CDN de unpkg.com -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <!-- Establecer un elemento div donde se renderizará el mapa -->
    <div id="map" style="height:400px;width:800px"></div>

    <script>
        var map = L.map('map');

        //Añadimos una capa 
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 30,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


        function changeView(elm) {
            let latitud = elm.getAttribute('data-latitud');
            let longitud = elm.getAttribute('data-longitud');
            let markerid = elm.getAttribute('data-marker');            
            map.setView([latitud, longitud], 15);
            markers[markerid].openPopup();            
            return false;
        }
    </script>

    <script>        
        var markers={};
    </script>
    <div class="monumentos-container">        
        <?php foreach ($monumentos as $provincia => $monumentos_provincia) : ?>
            <div class="provincia-monumentos">
                <h3><?php echo $provincia; ?></h3>
                <?php foreach ($monumentos_provincia as $monumento) : ?>

                    <script>
                        marker=L.marker([<?= $monumento['latitud'] ?>, <?= $monumento['longitud'] ?>]);
                        marker.addTo(map);
                        marker.bindPopup('<?= $monumento['nombre'] ?> (<?= $provincia ?>)');
                        markers["<?=$monumento['id']?>"]=marker;
                    </script>
                    <div class="monumento">
                        <a href="javascript:void(0)" onclick="return changeView(this);" data-marker="<?=$monumento['id']?>" data-latitud="<?php echo $monumento['latitud']; ?>" data-longitud="<?php echo $monumento['longitud']; ?>">
                            Ver "<?php echo $monumento['nombre']; ?>" en el mapa
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <script>

        map.setView([<?= $monumentoAlAzar['latitud'] ?>, <?= $monumentoAlAzar['longitud'] ?>], 17);
        markers["<?=$monumentoAlAzar['id']?>"].openPopup();

    </script>
</body>

</html>