<?php
include "koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
  mysqli_query($conn,"SELECT * FROM absensi WHERE id='$id'")
);

if(isset($_POST['update'])){
  $kegiatan = $_POST['kegiatan'];
  $status   = $_POST['status'];

  mysqli_query($conn,"UPDATE absensi SET
    kegiatan='$kegiatan',
    status='$status'
    WHERE id='$id'
  ");

  header("location:admin.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Absensi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card p-4 shadow">
    <h4 class="mb-3">Edit Absensi</h4>

    <form method="POST">

      <label>Kegiatan</label>
      <select name="kegiatan" class="form-select mb-3">
        <option value="KBM" <?= $data['kegiatan']=="KBM"?"selected":"" ?>>KBM</option>
        <option value="Prakerin" <?= $data['kegiatan']=="Prakerin"?"selected":"" ?>>Prakerin</option>
        <option value="Sekolah" <?= $data['kegiatan']=="Sekolah"?"selected":"" ?>>Sekolah</option>
        <option value="Ekstrakurikuler" <?= $data['kegiatan']=="Ekstrakurikuler"?"selected":"" ?>>Ekstrakurikuler</option>
      </select>

      <label>Status</label>
      <select name="status" class="form-select mb-3">
        <option value="HADIR" <?= $data['status']=="HADIR"?"selected":"" ?>>HADIR</option>
        <option value="TERLAMBAT" <?= $data['status']=="TERLAMBAT"?"selected":"" ?>>TERLAMBAT</option>
      </select>

      <button type="submit" name="update" class="btn btn-success">
        Update
      </button>
      <a href="admin.php" class="btn btn-secondary">Kembali</a>

    </form>
  </div>
</div>

</body>
</html>
