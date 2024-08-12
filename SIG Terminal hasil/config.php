<?php
$host = 'localhost';
$port = '5432';
$database = 'uas_sig';
$user = 'postgres';
$password = '3458';

$connectionString = "host=$host port=$port dbname=$database user=$user password=$password";
$db = pg_connect($connectionString);

if (!$db) {
    echo "Koneksi database gagal";
    exit;
}
?>
