<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "absensi_sekolah";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  die("Koneksi gagal");
}
?>
