<?php
include "koneksi.php";
$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM siswa WHERE id='$id'"));

if(isset($_POST['update'])){
  $nama = $_POST['nama'];
  mysqli_query($conn,"UPDATE siswa SET nama='$nama' WHERE id='$id'");
  header("location:siswa.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Siswa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body{background:linear-gradient(135deg,#667eea,#764ba2);min-height:100vh;display:flex;align-items:center;justify-content:center;}
.card{width:400px;border-radius:16px;}
</style>
</head>
<body>

<div class="card p-4">
<h4 class="text-center mb-3">
  <i class="fa-solid fa-user-pen"></i> Edit Siswa
</h4>

<form method="POST">
<input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control mb-3" required>

<button name="update" class="btn btn-info text-white w-100">
  <i class="fa-solid fa-save"></i> Update
</button>
</form>

</div>
</body>
</html>
