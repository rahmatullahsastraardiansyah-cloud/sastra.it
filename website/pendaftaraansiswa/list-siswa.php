<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Siswa Baru | SMK Coding</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .container {
            margin-top: 40px;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #e9f3ff;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="mb-4 text-center">
            <h2 class="fw-bold text-primary">📋 Data Siswa yang Sudah Mendaftar</h2>
            <p class="text-muted">SMK Coding</p>
        </header>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="form-daftar.php" class="btn btn-primary">[+] Tambah Baru</a>
            <a href="index.php" class="btn btn-outline-secondary">🏠 Kembali</a>
        </div>

        <div class="card p-3">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" style="width: 50px;">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Agama</th>
                        <th scope="col">Sekolah Asal</th>
                        <th scope="col" style="width: 130px;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM calon_siswa";
                    $query = mysqli_query($db, $sql);
                    $no = 1;

                    while ($siswa = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($siswa['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($siswa['alamat']) . "</td>";
                        echo "<td>" . htmlspecialchars($siswa['jenis_kelamin']) . "</td>";
                        echo "<td>" . htmlspecialchars($siswa['agama']) . "</td>";
                        echo "<td>" . htmlspecialchars($siswa['sekolah_asal']) . "</td>";
                        echo "<td>
                                <a href='form-edit.php?id=" . $siswa['id'] . "' class='btn btn-sm btn-warning me-1'>Edit</a>
                                <a href='hapus.php?id=" . $siswa['id'] . "' class='btn btn-sm btn-danger'
                                   onclick=\"return confirm('Yakin ingin menghapus data ini?');\">Hapus</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <p class="text-end mt-3">
                <strong>Total:</strong> <?php echo mysqli_num_rows($query); ?> siswa
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
