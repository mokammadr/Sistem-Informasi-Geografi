<?php
    //koneksi
    $conn = pg_connect("host=localhost port=5432 dbname=db_polyline user=postgres password=root");

    //set variabel
    $id       = $_POST['id'];
    $geog     = $_POST['geog'];

    //input data
    $insert = pg_query($conn, "INSERT INTO polyline (id, geog) VALUES ('$id', '$geog')");

    //kembali
    header("Location: index.php");
?>