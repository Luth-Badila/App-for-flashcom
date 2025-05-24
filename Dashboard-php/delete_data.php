<?php
include "koneksi.php";
$id = $_POST['id'];
$sql = "DELETE FROM laporan WHERE id=$id";
if ($koneksi->query($sql)) {
    echo "Data berhasil dihapus";
} else {
    echo "Gagal hapus: " . $koneksi->error;
}
?>
