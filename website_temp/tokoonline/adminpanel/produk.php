<?php
require "session.php";
require "../koneksi.php";

function generateRandomString($length = 20) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $len = strlen($chars);
    $out = '';
    for ($i = 0; $i < $length; $i++) {
        $out .= $chars[random_int(0, $len - 1)];
    }
    return $out;
}

// Query produk join kategori
$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori 
    FROM produk a 
    JOIN kategori b ON a.kategori_id = b.id");
$jumlahProduk = mysqli_num_rows($query);

// Query kategori
$querykategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/fontawesome-free-7.1.0-web/css/all.min.css">
</head>

<style>
.no-decoration {
    text-decoration: none;
}
form div {
    margin-bottom: 10px;
}
</style>

<body>
<?php require "navbar.php"; ?>

<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="../adminpanel" class="no-decoration text-muted">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
    </nav>

    <!-- Tambah Produk -->
    <div class="my-5 col-12 col-md-6">
        <h3>Tambah Produk</h3>

        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" required autocomplete="off">
            </div>
            <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih Satu</option>
                    <?php while ($data = mysqli_fetch_array($querykategori)) { ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div>
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control" required>
            </div>
            <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div>
                <label for="ketersediaan_stock">Ketersediaan Stock</label>
                <select name="ketersediaan_stock" id="ketersediaan_stock" class="form-control">
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary mt-3" name="simpan">Simpan</button>
            </div>
        </form>

        <?php
        if (isset($_POST['simpan'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $kategori = htmlspecialchars($_POST['kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $detail = htmlspecialchars($_POST['detail']);
            $ketersediaan_stock = htmlspecialchars($_POST['ketersediaan_stock']);

            $target_dir = "../image/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $imageFileType = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
            $image_size = $_FILES["foto"]["size"];
            $random_name = generateRandomString(20);
            $new_name = $random_name . "." . $imageFileType;
            $target_file = $target_dir . $new_name;

            if ($nama == '' || $kategori == '' || $harga == '') {
                echo '<div class="alert alert-warning mt-3">Nama, kategori, dan harga wajib diisi</div>';
            } else {
                if ($image_size > 500000) {
                    echo '<div class="alert alert-warning mt-3">File tidak boleh lebih dari 500KB</div>';
                } elseif (!in_array($imageFileType, ['jpg','jpeg', 'png', 'gif'])) {
                    echo '<div class="alert alert-warning mt-3">File wajib bertipe JPG, PNG, atau GIF</div>';
                } else {
                    // Pindahkan file yang diupload
                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

                    // Simpan ke database
                    $queryTambah = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stock) 
                        VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stock')");

                    if ($queryTambah) {
                        echo '<div class="alert alert-primary mt-3">Produk berhasil tersimpan</div>';
                        echo '<meta http-equiv="refresh" content="2; url=produk.php" />';
                    } else {
                        echo '<div class="alert alert-danger mt-3">Gagal menyimpan produk: ' . mysqli_error($conn) . '</div>';
                    }
                }
            }
        }
        ?>
    </div>

    <!-- List Produk -->
    <div class="mt-3 mb-5">
        <h2>List Produk</h2>
        <div class="table-responsive mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Ketersediaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($jumlahProduk == 0) {

                        echo '<tr><td colspan="6" class="text-center">Data produk tidak tersedia</td></tr>';
                    } else {
                        $no = 1;
                        mysqli_data_seek($query, 0); // reset pointer hasil query
                        while ($data = mysqli_fetch_array($query)) {
                            echo '
                            <tr>
                                <td>' . $no++ . '</td>
                                <td>' . $data['nama'] . '</td>
                                <td>' . $data['nama_kategori'] . '</td>
                                <td>' . $data['harga'] . '</td>
                                <td>' . $data['ketersediaan_stock'] . '</td>
                                <td>
                                    <a href="produk-detail.php?p=' . $data['id'] . '" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../bootstrap/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/fontawesome-free-7.1.0-web/js/all.min.js"></script>
</body>
</html>
