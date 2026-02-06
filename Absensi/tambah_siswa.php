<?php
include "koneksi.php";
if(isset($_POST['simpan'])){
  mysqli_query($conn,"INSERT INTO siswa VALUES(NULL,'$_POST[nama]')");
  header("location:siswa.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Siswa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body{background:#f4f6f9;}
.card{border-radius:18px;box-shadow:0 12px 30px rgba(0,0,0,.1);}
.header{background:linear-gradient(135deg,#00c6ff,#0072ff);color:white;}
</style>
</head>
<body>

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-5">

<div class="card">
<div class="header text-center p-3">
<h4><i class="fa-solid fa-user-plus"></i> Tambah Siswa</h4>
</div>

<div class="card-body p-4">
<form method="POST">
<div class="input-group mb-4">
<span class="input-group-text"><i class="fa-solid fa-user"></i></span>
<input type="text" name="nama" class="form-control" placeholder="Nama siswa" required>
</div>

<div class="d-flex gap-2">
<button class="btn btn-info text-white w-100" name="simpan">
<i class="fa-solid fa-save"></i> Simpan
</button>
<a href="siswa.php" class="btn btn-secondary w-100">
<i class="fa-solid fa-arrow-left"></i> Batal
</a>
</div>
</form>
</div>
</div>

</div>
</div>
</div>

</body>
</html>
