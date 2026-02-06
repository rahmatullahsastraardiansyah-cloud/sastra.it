<?php
include "koneksi.php";

// statistik
$qSiswa = mysqli_query($conn,"SELECT * FROM siswa");
$qAbsen = mysqli_query($conn,"SELECT * FROM absensi");
$qHadir = mysqli_query($conn,"SELECT * FROM absensi WHERE status='HADIR'");
$qTelat = mysqli_query($conn,"SELECT * FROM absensi WHERE status='TERLAMBAT'");

$totalSiswa = $qSiswa ? mysqli_num_rows($qSiswa) : 0;
$totalAbsen = $qAbsen ? mysqli_num_rows($qAbsen) : 0;
$hadir = $qHadir ? mysqli_num_rows($qHadir) : 0;
$telat = $qTelat ? mysqli_num_rows($qTelat) : 0;

// search
$cari = $_GET['cari'] ?? '';

$data = mysqli_query($conn,"
SELECT absensi.*, siswa.nama
FROM absensi
JOIN siswa ON absensi.siswa_id = siswa.id
WHERE siswa.nama LIKE '%$cari%'
ORDER BY tanggal DESC, jam DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Absensi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{background:#f4f6f9;}
.card{border-radius:18px;box-shadow:0 10px 25px rgba(0,0,0,.1);}
.stat{background:linear-gradient(135deg,#00c6ff,#0072ff);color:#fff;}
img{width:65px;border-radius:10px;}
.chart-box{width:280px;margin:auto;}
</style>
</head>

<body>
<div class="container mt-4">

<!-- STAT -->
<div class="row g-3 mb-4">
  <div class="col-md-6">
    <div class="card stat p-4">
      <h6><i class="fa-solid fa-users"></i> Total Siswa</h6>
      <h2><?= $totalSiswa ?></h2>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card stat p-4">
      <h6><i class="fa-solid fa-clipboard-check"></i> Total Absensi</h6>
      <h2><?= $totalAbsen ?></h2>
    </div>
  </div>
</div>

<!-- SEARCH -->
<form class="mb-3">
  <div class="input-group">
    <input type="text" name="cari" class="form-control" placeholder="Cari nama siswa..." value="<?= $cari ?>">
    <button class="btn btn-info text-white">
      <i class="fa-solid fa-magnifying-glass"></i>
    </button>
  </div>
</form>

<a href="siswa.php" class="btn btn-success mb-3">
  <i class="fa-solid fa-users-gear"></i> Kelola Siswa
</a>

<!-- TABLE -->
<div class="card p-3">
<table class="table table-hover text-center align-middle">
<thead class="table-info">
<tr>
  <th>Nama</th>
  <th>Tanggal</th>
  <th>Jam</th>
  <th>Kegiatan</th>
  <th>Status</th>
  <th>Foto</th>
  <th>Aksi</th>
</tr>
</thead>
<tbody>

<?php while($d=mysqli_fetch_assoc($data)){ ?>
<tr>
  <td><?= $d['nama'] ?></td>
  <td><?= $d['tanggal'] ?></td>
  <td><?= $d['jam'] ?></td>
  <td><?= $d['kegiatan'] ?></td>
  <td>
    <?php if($d['status']=="HADIR"){ ?>
      <span class="badge bg-success">HADIR</span>
    <?php } else { ?>
      <span class="badge bg-danger">TERLAMBAT</span>
    <?php } ?>
  </td>
  <td>
    <img src="foto/<?= $d['foto'] ?>">
  </td>
  <td>
    <a href="edit_absensi.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">
      <i class="fa-solid fa-pen"></i>
    </a>
    <a href="hapus_absensi.php?id=<?= $d['id'] ?>" 
       class="btn btn-danger btn-sm"
       onclick="return confirm('Hapus absensi ini?')">
      <i class="fa-solid fa-trash"></i>
    </a>
  </td>
</tr>
<?php } ?>

</tbody>
</table>
</div>

<!-- GRAFIK -->
<div class="card p-4 mt-4 text-center">
  <h5><i class="fa-solid fa-chart-pie"></i> Grafik Absensi</h5>
  <div class="chart-box">
    <canvas id="chartAbsensi"></canvas>
  </div>
</div>

</div>

<script>
new Chart(document.getElementById('chartAbsensi'),{
  type:'doughnut',
  data:{
    labels:['Hadir','Terlambat'],
    datasets:[{
      data:[<?= $hadir ?>,<?= $telat ?>],
      backgroundColor:['#198754','#dc3545']
    }]
  },
  options:{
    responsive:true,
    plugins:{
      legend:{
        position:'bottom',
        labels:{font:{size:11}}
      }
    }
  }
});
</script>

</body>
</html>
