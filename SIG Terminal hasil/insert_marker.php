<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $geom = "ST_SetSRID(ST_MakePoint($lng, $lat), 0)";

    $query = "INSERT INTO minimarket (nama, lat, lng, geom) VALUES ('$nama', $lat, $lng, $geom)";
    $result = pg_query($db, $query);

    if ($result) {
        echo "Data berhasil disimpan";
    } else {
        echo "Gagal menyimpan data";
    }
}
?>
