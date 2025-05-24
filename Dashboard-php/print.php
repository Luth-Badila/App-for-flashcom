<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Cetak Laporan Keuangan</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <style>
    @media print {
      .noprint { display: none; }
    }
  </style>
</head>
<body>
<div class="container mt-4">
  <h3>Laporan Keuangan</h3>
  <table class="table table-bordered mt-3">
    <thead>
      <tr><th>Tanggal</th><th>Deskripsi</th><th>Pemasukan</th><th>Pengeluaran</th></tr>
    </thead>
    <tbody>
      <?php
        $data = $koneksi->query("SELECT * FROM laporan ORDER BY tanggal DESC");
        while($row = $data->fetch_assoc()) {
            echo "<tr>
              <td>{$row['tanggal']}</td>
              <td>{$row['deskripsi']}</td>
              <td>{$row['pemasukan']}</td>
              <td>{$row['pengeluaran']}</td>
            </tr>";
        }
      ?>
    </tbody>
  </table>
  <button onclick="window.print()" class="btn btn-primary noprint">Cetak</button>
</div>
</body>
</html>
