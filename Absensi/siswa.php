<?php
include "koneksi.php";
$siswa = mysqli_query($conn,"SELECT * FROM siswa");
?>

<!DOCTYPE html>
<html>
<head>
<title>Kelola Siswa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body{background:#f4f6f9;}
.card{border-radius:16px;box-shadow:0 10px 25px rgba(0,0,0,.08);}
</style>
</head>
<body>

<div class="container mt-4">
<div class="card p-4">

<div class="d-flex justify-content-between mb-3">
  <h4><i class="fa-solid fa-users-gear"></i> Data Siswa</h4>
  <a href="tambah_siswa.php" class="btn btn-info text-white">
    <i class="fa-solid fa-user-plus"></i> Tambah
  </a>
</div>

<table class="table table-bordered text-center">
<tr>
  <th>Nama</th>
  <th>Aksi</th>
</tr>

<?php while($s=mysqli_fetch_assoc($siswa)){ ?>
<tr>
  <td><?= $s['nama'] ?></td>
  <td>
    <a href="edit_siswa.php?id=<?= $s['id'] ?>" class="btn btn-warning btn-sm">
      <i class="fa-solid fa-pen"></i>
    </a>
    <a href="hapus_siswa.php?id=<?= $s['id'] ?>" 
       class="btn btn-danger btn-sm"
       onclick="return confirm('Hapus siswa?')">
      <i class="fa-solid fa-trash"></i>
    </a>
  </td>
</tr>
<?php } ?>

</table>

<a href="admin.php" class="btn btn-secondary">
  <i class="fa-solid fa-arrow-left"></i> Kembali
</a>

</div>
</div>
</body>
</htm
