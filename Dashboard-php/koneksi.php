<?php
$koneksi = new mysqli("localhost", "root", "", "db_laporan");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
