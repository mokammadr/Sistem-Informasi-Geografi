<!DOCTYPE html>
<html lang="en">


<!-- leaflet css  -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

<!-- bootstrap cdn  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta</title>
    <style>
        /* ukuran peta */
        #mapid {
            height: 100vh;
        }

        .jumbotron {
            height: 100%;
            border-radius: 0;
        }

        body {
            background-color: #ebe7e1;
        }
    </style>
</head>


<!-- leaflet js  -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

<body>
    <div class="row"> <!-- class row digunakan sebelum membuat column  -->
        <div class="col-4"> <!-- ukuruan layar dengan bootstrap adalah 12 kolom, bagian kiri dibuat sebesar 4 kolom-->
            <div class="jumbotron"> <!-- untuk membuat semacam container berwarna abu -->
                <h4>Input Data Lokasi</h4>
                <h1>Sampang</h1>
                <hr>
                <form action="proses.php" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Latitude, Longitude</label>
                        <input type="text" class="form-control" id="latlong" name="latlong">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Tempat</label>
                        <input type="text" class="form-control" name="nama_tempat">
                    </div>

                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8"> <!-- ukuruan layar dengan bootstrap adalah 12 kolom, bagian kiri dibuat sebesar 4 kolom-->
            <!-- peta akan ditampilkan dengan id = mapid -->
            <div id="mapid"></div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script>
        var mymap = L.map('mapid').setView([-7.199228, 113.24735], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 20,
        }).addTo(mymap);



        // buat variabel berisi fugnsi L.popup 
        var popup = L.popup();

        // buat fungsi popup saat map diklik
        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("koordinatnya adalah " + e.latlng
                    .toString()
                ) //set isi konten yang ingin ditampilkan, kali ini kita akan menampilkan latitude dan longitude
                .openOn(mymap);

            document.getElementById('latlong').value = e.latlng //value pada form latitde, longitude akan berganti secara otomatis
        }
        mymap.on('click', onMapClick); //jalankan fungsi
        <?php
        // konfigurasi koneksi ke database
        $dbhost = 'localhost';
        $dbname = 'db_marker';
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
            $latLong = str_replace(['[', ']', 'LatLng', '(', ')'], '', $row['lat_long']);
            echo "L.marker([$latLong]).addTo(mymap)";
            // data ditampilkan di dalam bindPopup( data ) dan dapat dikustomisasi dengan html
            $popupData = 'nama tempat: ' . $row['nama_tempat'];
            echo ".bindPopup(`$popupData`);";
        }
        ?>
    </script>
</body>

</html>