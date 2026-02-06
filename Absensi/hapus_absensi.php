<?php
include "koneksi.php";
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM absensi WHERE id='$id'");
header("location:admin.php");
