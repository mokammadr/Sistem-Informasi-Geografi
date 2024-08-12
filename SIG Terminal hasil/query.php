<?php
include 'config.php';

$query = $_POST['query'];

$result = pg_query($db, $query);

if (!$result) {
    echo "Query error";
    exit;
}

$rows = pg_fetch_all($result);

if (!$rows) {
    echo "Tidak ada data";
    exit;
}

$data = json_encode($rows);


$query = "SELECT nama, ST_X(geom) AS lng, ST_Y(geom) AS lat FROM minimarket";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Peta Leaflet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>

<body>
    <div id="map"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-6.212655839269488, 106.8329300546087], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var data = <?php echo $data; ?>;

        data.forEach(function(minimarket) {
            var latlng = L.latLng(minimarket.lat, minimarket.lng);
            var marker = L.marker(latlng).addTo(map);
            marker.bindPopup('<b>' + minimarket.nama + '</b>');
        });
    </script>
</body>

</html>
