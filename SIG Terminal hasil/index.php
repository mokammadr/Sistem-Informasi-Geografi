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
    <form action="insert_marker.php" method="post">
        <label for="nama">Minimarket:</label>
        <input type="text" id="nama" name="nama">
        <input type="hidden" id="lat" name="lat">
        <input type="hidden" id="lng" name="lng">
        <input type="submit" value="Simpan">
    </form>
    <br>
    <form action="query.php" method="post">
        <textarea name="query" rows="5" cols="40" placeholder="Masukkan perintah query..."></textarea><br>
        <input type="submit" value="Kirim">
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-6.212655839269488, 106.8329300546087], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;

        map.on('click', function (e) {
            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('lng').value = e.latlng.lng;

            // Display the latitude and longitude
            alert("Latitude: " + e.latlng.lat + "\nLongitude: " + e.latlng.lng);
        });


    </script>
</body>

</html>
