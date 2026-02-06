<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran Siswa Baru | SMK Coding</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        h3 {
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="text-center mb-4">
            <h3>📝 Formulir Pendaftaran Siswa Baru</h3>
            <p class="text-muted">SMK Coding</p>
        </header>

        <div class="card p-4">
            <form action="proses-pendaftaran.php" method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Tulis alamat lengkap" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="laki-laki" required>
                            <label class="form-check-label" for="laki">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="perempuan">
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select class="form-select" name="agama" id="agama" required>
                        <option value="">-- Pilih Agama --</option>
                        <option>Islam</option>
                        <option>Kristen</option>
                        <option>Katolik</option>
                        <option>Hindu</option>
                        <option>Buddha</option>
                        <option>Konghucu</option>
                        <option>Atheis</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="sekolah_asal" class="form-label">Sekolah Asal</label>
                    <input type="text" class="form-control" name="sekolah_asal" id="sekolah_asal" placeholder="Masukkan nama sekolah" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="list-siswa.php" class="btn btn-outline-secondary">⬅️ Kembali</a>
                    <button type="submit" name="daftar" class="btn btn-primary">✅ Daftar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
