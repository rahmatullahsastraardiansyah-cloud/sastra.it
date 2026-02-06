<?php
include "koneksi.php";
date_default_timezone_set("Asia/Jakarta");

if(isset($_POST['kirim'])){

  $siswa_id = $_POST['siswa_id'];
  $tanggal  = date("Y-m-d");
  $jam      = date("H:i:s");
  $kegiatan = $_POST['kegiatan'] ?? '';

  $batas = "07:00:00";
  $status = ($jam <= $batas) ? "HADIR" : "TERLAMBAT";

  $cek = mysqli_query($conn,"SELECT * FROM absensi WHERE siswa_id='$siswa_id' AND tanggal='$tanggal'");

  if(mysqli_num_rows($cek) > 0){
    echo "<script>alert('Kamu sudah absen hari ini');</script>";
  } else {
    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tmp, "foto/".$foto);

    mysqli_query($conn,"INSERT INTO absensi (siswa_id,tanggal,jam,kegiatan,foto,status)
      VALUES ('$siswa_id','$tanggal','$jam','$kegiatan','$foto','$status')");

    echo "<script>alert('Absensi berhasil'); window.location='preview-siswa.php';</script>";
    exit;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Absensi Siswa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

  <!-- Form Absen -->
  <div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Absensi Siswa</h4>
      <a href="preview-siswa.php" class="btn btn-light btn-sm">List Absensi</a>
    </div>
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
          <label>Nama Siswa</label>
          <select name="siswa_id" class="form-control" required>
            <option value="">-- Pilih Nama --</option>
            <?php
            $q = mysqli_query($conn,"SELECT * FROM siswa");
            while($s = mysqli_fetch_assoc($q)){
              echo "<option value='{$s['id']}'>{$s['nama']}</option>";
            }
            ?>
          </select>
        </div>

        <div class="mb-3">
          <label>Kegiatan</label>
          <input type="text" name="kegiatan" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Foto Absensi</label>
          <input type="file" name="foto" class="form-control" accept="image/*" required>
        </div>

        <button name="kirim" class="btn btn-success w-100">Absen Sekarang</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
