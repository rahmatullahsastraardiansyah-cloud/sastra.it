<?php
include("config.php");

if (!isset($_GET['id'])) {
    header('Location: list-siswa.php');
    exit;
}

$id = intval($_GET['id']); // memastikan hanya angka

// buat query hapus
$sql = "DELETE FROM calon_siswa WHERE id=$id";
$query = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Data | SMK Coding</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            max-width: 450px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <div class="card p-4 text-center">
        <?php if ($query): ?>
            <div class="alert alert-success mb-3" role="alert">
                ✅ Data siswa berhasil dihapus!
            </div>
            <a href="list-siswa.php" class="btn btn-primary">Kembali ke Daftar</a>
        <?php else: ?>
            <div class="alert alert-danger mb-3" role="alert">
                ❌ Gagal menghapus data. Silakan coba lagi.
            </div>
            <a href="list-siswa.php" class="btn btn-secondary">Kembali</a>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
