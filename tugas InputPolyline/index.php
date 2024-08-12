<!DOCTYPE html>
<html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.0-beta.2.rc.2/leaflet.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.0-beta.2.rc.2/leaflet.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.css" rel="stylesheet" />
  

<head>
  <meta charset="utf-8">
  <title>TEST</title>
  <style>
    #map {
      margin: 0;
      height: 100%;
      width: 100%; }
  </style>
</head>

<body>
  <div id='map'></div>

  <script>
  // center of the map
  var center = [-7.199228, 113.24735], 13;

  // Create the map
  var map = L.map('map').setView(center, 13);

  // Set up the OSM layer
  L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
      maxZoom: 18
    }).addTo(map);



  // Menginisialisasi FeatureGroup untuk menyimpan layer yang dapat diedit
  var editableLayers = new L.FeatureGroup();
  map.addLayer(editableLayers);

  var options = {
    position: 'topleft',
    draw: {
      polygon: {
        allowIntersection: false, // Membatasi bentuk menjadi poligon sederhana
        drawError: {
          color: '#e1e100', // Warnai bentuknya akan berubah saat berpotongan
          message: '<strong>Oh snap!<strong> you can\'t draw that!' // Pesan yang akan ditampilkan saat berpotongan
        },
        shapeOptions: {
          color: '#97009c'
        }
      },
      polyline: {
        shapeOptions: {
          color: '#f357a1',
          weight: 10
            }
      },
      // nonaktifkan item toolbar dengan menyetelnya ke false
      polyline: true,
      circle: true, // Turns off this drawing tool
      polygon: true,
      marker: true,
      rectangle: true,
    },
    edit: {
      featureGroup: editableLayers, //REQUIRED!!
      remove: true
    }
  };

  // Menginisialisasi draw control dan meneruskannya ke FeatureGroup dari layer yang dapat diedit
  var drawControl = new L.Control.Draw(options);
  map.addControl(drawControl);

  var editableLayers = new L.FeatureGroup();
  map.addLayer(editableLayers);

  map.on('draw:created', function(e) {
    var type = e.layerType,
      layer = e.layer;

    if (type === 'polyline') {
      layer.bindPopup('A polyline!');
    } else if ( type === 'polygon') {
      layer.bindPopup('A polygon!');
    } else if (type === 'marker') 
    {layer.bindPopup('marker!');}
    else if (type === 'circle') 
    {layer.bindPopup('A circle!');}
     else if (type === 'rectangle') 
    {layer.bindPopup('A rectangle!');}


    editableLayers.addLayer(layer);
  });

  mymap.on('click', onMapClick); //jalankan fungsi
        <?php
        // konfigurasi koneksi ke database
        $dbhost = 'localhost';
        $dbname = 'db_polyline';
        $dbuser = 'postgres';
        $dbpass = 'root';
        $pdo = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        // ambil data dari tabel lokasi
        $query = "SELECT * FROM lokasi";
        $result = $pdo->query($query);

        // looping data menggunakan while
        while ($row = $result->fetch()) {
            // menggunakan fungsi L.marker(lat, long) untuk menampilkan latitude dan longitude
            // menggunakan fungsi str_replace() untuk menghilangkan karakter yang tidak dibutuhkan
            $id = str_replace(['[', ']', 'id', '(', ')'], '', $row['id']);
            echo "L.polyline([$id]).addTo(mymap)";
            // data ditampilkan di dalam bindPopup( data ) dan dapat dikustomisasi dengan html
            $popupData = 'geog' . $row['geog'];
            echo ".bindPopup(`$popupData`);";
        }
        ?>
  </script>
</body>
</html>