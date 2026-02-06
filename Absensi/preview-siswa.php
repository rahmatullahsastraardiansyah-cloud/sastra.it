<?php
include "koneksi.php";

// ambil semua absensi terbaru
$query = mysqli_query($conn, "SELECT a.*, s.nama FROM absensi a 
                              JOIN siswa s ON a.siswa_id = s.id
                              ORDER BY a.tanggal DESC, a.jam DESC");

// ambil total siswa
$total_siswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa"));

// ambil total absensi
$total_absensi = mysqli_num_rows($query);

// data untuk grafik
$hadir = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absensi WHERE status='HADIR'"));
$terlambat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absensi WHERE status='TERLAMBAT'"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Preview Absensi Siswa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row mb-3">
    <div class="col-md-6">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5 class="card-title">Total Siswa</h5>
          <h3><?= $total_siswa ?></h3>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card text-white bg-info mb-3">
        <div class="card-body">
          <h5 class="card-title">Total Absensi</h5>
          <h3><?= $total_absensi ?></h3>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Tabel Absensi</h5>
      <a href="absen.php" class="btn btn-sm btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead class="table-light">
          <tr>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Kegiatan</th>
            <th>Status</th>
            <th>Foto</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($query)): ?>
          <tr>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['jam'] ?></td>
            <td><?= htmlspecialchars($row['kegiatan']) ?></td>
            <td><?= $row['status'] ?></td>
            <td>
              <?php if($row['foto']): ?>
              <img src="foto/<?= $row['foto'] ?>" width="50" alt="Foto">
              <?php endif; ?>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header bg-light">
      <h5 class="mb-0">Grafik Absensi</h5>
    </div>
    <div class="card-body d-flex justify-content-center">
      <!-- Grafik dibuat lebih kecil -->
      <canvas id="grafikAbsensi" width="250" height="250"></canvas>
    </div>
  </div>
</div>

<script>
const ctx = document.getElementById('grafikAbsensi').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Hadir', 'Terlambat'],
        datasets: [{
            label: 'Absensi',
            data: [<?= $hadir ?>, <?= $terlambat ?>],
            backgroundColor: ['#28a745','#dc3545'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: false, // buat ukuran canvas tetap sesuai width & height
        plugins: { legend: { position: 'bottom' } }
    }
});
</script>

</body>
</html>
