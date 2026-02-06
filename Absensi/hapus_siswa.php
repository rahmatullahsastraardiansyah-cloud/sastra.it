<?php
include "koneksi.php";

$id = $_GET['id'];

// hapus data absensi siswa dulu
mysqli_query($conn, "DELETE FROM absensi WHERE siswa_id='$id'");

// baru hapus siswa
mysqli_query($conn, "DELETE FROM siswa WHERE id='$id'");

header("location:siswa.php");
exit;
