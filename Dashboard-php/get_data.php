<?php
include "koneksi.php";
$sql = $koneksi->query("SELECT * FROM laporan ORDER BY tanggal DESC");

while($row = $sql->fetch_assoc()) {
    echo "<tr>
      <td>{$row['tanggal']}</td>
      <td>{$row['deskripsi']}</td>
      <td>{$row['pemasukan']}</td>
      <td>{$row['pengeluaran']}</td>
      <td>
        <button class='btn btn-sm btn-warning editBtn' data-id='{$row['id']}'>Edit</button>
        <button class='btn btn-sm btn-danger hapusBtn' data-id='{$row['id']}'>Hapus</button>
      </td>
    </tr>";
}
?>
