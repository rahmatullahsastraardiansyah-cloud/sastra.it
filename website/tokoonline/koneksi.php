<?php
$conn = new mysqli("localhost", "root", "", "toko_online");

if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: " . $conn->connect_error;
  exit();
}
?>
