<?php
include "koneksi.php";

$id = $_POST['id'];
$tanggal = $_POST['tanggal'];
$deskripsi = $_POST['deskripsi'];
$pemasukan = $_POST['pemasukan'];
$pengeluaran = $_POST['pengeluaran'];

if ($id == '') {
    $sql = "INSERT INTO laporan (tanggal, deskripsi, pemasukan, pengeluaran)
            VALUES ('$tanggal', '$deskripsi', '$pemasukan', '$pengeluaran')";
} else {
    $sql = "UPDATE laporan SET 
            tanggal='$tanggal',
            deskripsi='$deskripsi',
            pemasukan='$pemasukan',
            pengeluaran='$pengeluaran'
            WHERE id=$id";
}

if ($koneksi->query($sql)) {
    echo "Data berhasil disimpan";
} else {
    echo "Gagal: " . $koneksi->error;
}
?>
