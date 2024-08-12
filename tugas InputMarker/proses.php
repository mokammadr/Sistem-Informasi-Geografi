<?php
    //koneksi
    $conn = pg_connect("host=localhost port=5432 dbname=db_marker user=postgres password=root");

    //set variabel
    $lat_long       = $_POST['latlong'];
    $nama_tempat    = $_POST['nama_tempat'];

    //input data
    $insert = pg_query($conn, "INSERT INTO lokasi (lat_long, nama_tempat) VALUES ('$lat_long', '$nama_tempat')");

    //kembali
    header("Location: index.php");
?>
