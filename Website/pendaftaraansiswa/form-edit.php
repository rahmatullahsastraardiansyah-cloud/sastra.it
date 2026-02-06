<?php
include("config.php");

// kalau tidak ada id di query string
if (!isset($_GET['id'])) {
    header('Location: list-siswa.php');
    exit;
}

// ambil id dari query string
$id = $_GET['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM calon_siswa WHERE id=$id";
$query = mysqli_query($db, $sql);
$siswa = mysqli_fetch_assoc($query);

// jika data yang di-edit tidak ditemukan
if (mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan...");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Edit Siswa | SMK Coding</title>
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
            <h3>✏️ Formulir Edit Data Siswa</h3>
            <p class="text-muted">SMK Coding</p>
        </header>

        <div class="card p-4">
            <form action="proses-edit.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $siswa['id']; ?>">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" id="nama"
                        value="<?php echo htmlspecialchars($siswa['nama']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" required><?php echo htmlspecialchars($siswa['alamat']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <div>
                        <?php $jk = $siswa['jenis_kelamin']; ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="laki-laki"
                                <?php echo ($jk == 'laki-laki') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="laki">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="perempuan"
                                <?php echo ($jk == 'perempuan') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <?php $agama = $siswa['agama']; ?>
                    <select class="form-select" name="agama" id="agama" required>
                        <option value="">-- Pilih Agama --</option>
                        <option <?php echo ($agama == 'Islam') ? 'selected' : ''; ?>>Islam</option>
                        <option <?php echo ($agama == 'Kristen') ? 'selected' : ''; ?>>Kristen</option>
                        <option <?php echo ($agama == 'Katolik') ? 'selected' : ''; ?>>Katolik</option>
                        <option <?php echo ($agama == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
                        <option <?php echo ($agama == 'Buddha') ? 'selected' : ''; ?>>Buddha</option>
                        <option <?php echo ($agama == 'Konghucu') ? 'selected' : ''; ?>>Konghucu</option>
                        <option <?php echo ($agama == 'Atheis') ? 'selected' : ''; ?>>Atheis</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="sekolah_asal" class="form-label">Sekolah Asal</label>
                    <input type="text" class="form-control" name="sekolah_asal" id="sekolah_asal"
                        value="<?php echo htmlspecialchars($siswa['sekolah_asal']); ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="list-siswa.php" class="btn btn-outline-secondary">⬅️ Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
