<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Laporan Keuangan</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>
<body class="p-4">
  <div class="container">
    <h2 class="mb-4">Dashboard Laporan Keuangan</h2>

    <!-- Form Input -->
    <form id="formData">
      <input type="hidden" name="id" id="id">
      <div class="row g-2">
        <div class="col-md-2"><input type="date" name="tanggal" id="tanggal" class="form-control" required></div>
        <div class="col-md-3"><input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi"></div>
        <div class="col-md-2"><input type="number" name="pemasukan" id="pemasukan" class="form-control" placeholder="Pemasukan"></div>
        <div class="col-md-2"><input type="number" name="pengeluaran" id="pengeluaran" class="form-control" placeholder="Pengeluaran"></div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </div>
    </form>

    <!-- Tabel -->
    <table class="table table-bordered mt-4" id="tabelData">
      <thead class="table-dark">
        <tr>
          <th>Tanggal</th><th>Deskripsi</th><th>Pemasukan</th><th>Pengeluaran</th><th>Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>

    <button onclick="window.open('print.php','_blank')" class="btn btn-success mt-3">Cetak Laporan</button>
  </div>

<!-- <script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/datatables.min.js"></script> -->

<script>
$(document).ready(function(){
  function loadData() {
    $.get('get_data.php', function(data){
      $('#tabelData tbody').html(data);
    });
  }
  loadData();

  $('#formData').on('submit', function(e){
    e.preventDefault();
    $.post('add_data.php', $(this).serialize(), function(response){
      alert(response);
      $('#formData')[0].reset();
      loadData();
    });
  });

  $(document).on('click', '.editBtn', function(){
    const row = $(this).closest('tr');
    $('#id').val($(this).data('id'));
    $('#tanggal').val(row.find('td:eq(0)').text());
    $('#deskripsi').val(row.find('td:eq(1)').text());
    $('#pemasukan').val(row.find('td:eq(2)').text());
    $('#pengeluaran').val(row.find('td:eq(3)').text());
  });

  $(document).on('click', '.hapusBtn', function(){
    if (confirm("Yakin hapus data?")) {
      $.post('delete_data.php', {id: $(this).data('id')}, function(response){
        alert(response);
        loadData();
      });
    }
  });
});
</script>
</body>
</html>
