<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Siswa Baru | SMK Coding</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .menu-container {
            max-width: 600px;
            margin: 60px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .menu-container ul {
            list-style: none;
            padding: 0;
        }
        .menu-container li {
            margin: 10px 0;
        }
        .menu-container a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <header>
        <h1>SMK Coding</h1>
        <h3>Pendaftaran Siswa Baru</h3>
    </header>

    <div class="menu-container text-center">
        <h4 class="mb-4">Menu Utama</h4>

        <!-- Notifikasi hasil pendaftaran -->
        <?php if(isset($_GET['status'])): ?>
            <?php if($_GET['status'] == 'sukses'): ?>
                <div class="alert alert-success" role="alert">
                    ✅ Pendaftaran siswa baru berhasil!
                </div>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    ❌ Pendaftaran gagal. Silakan coba lagi.
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Menu navigasi -->
        <ul class="list-unstyled">
            <li>
                <a href="form-daftar.php" class="btn btn-success w-100 mb-3">📝 Daftar Siswa Baru</a>
            </li>
            <li>
                <a href="list-siswa.php" class="btn btn-primary w-100">📋 Lihat Daftar Pendaftar</a>
            </li>
            <li>
                <a href="/pkl/dashboard/html/perpustakaan.html" class="btn btn-primary w-100">📋 Logout</a>
            </li>
        </ul>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
