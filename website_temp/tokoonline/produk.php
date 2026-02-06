<?php
require "koneksi.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// get produk by nama produk
if(isset($_GET['keyword'])){
    $keyword = mysqli_real_escape_string($conn, $_GET['keyword']); // tambahkan keamanan
    $queryProduk = mysqli_query($conn,"SELECT * FROM produk WHERE nama LIKE '%$keyword%'");
}

// get produk by kategori
else if (isset($_GET['kategori'])){
    $kategoriNama = mysqli_real_escape_string($conn, $_GET['kategori']);
    $queryGetKategoriId = mysqli_query($conn,"SELECT id FROM kategori WHERE nama='$kategoriNama'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);

    $queryProduk = mysqli_query($conn,"SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
}

// get produk default
else{
    $queryProduk = mysqli_query($conn,"SELECT * FROM produk");
}

$countdata = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Produk</title>
     <link rel="stylesheet" href="bootstrap/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-7.1.0-web/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Produk</h1>
        </div>
    </div>
    
     <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_array($queryKategori)){ ?>
                    <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama']; ?>">
                         <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                                <?php
                if($countdata<1){
            ?>
                <h4 class="text-center my-5">Produk yang anda cari tidak ada</h4>
            <?php
                }
            ?>
            
            <?php while($produk = mysqli_fetch_array($queryProduk)){ ?>
                <div class="col-md-4 mb-4">
                     <div class="card h-100">
                        <div class="image-box">
                          <img src="image/<?php echo $produk['foto']; ?>" class="card-img-top" alt="<?php echo $data['nama']; ?>">
                            </div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $produk['nama']; ?></h4>
                                    <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                                    <p class="card-text text-harga">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                    <a href="produk-detail.php?nama=<?php echo urlencode($produk['nama']); ?>" 
                                    class="btn warna3 text-white">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
     </div>

     <?php require "footer.php"; ?>

    <script src="bootstrap/bootstrap-5.3.8-dist/js/boostrap.bundle.min.js"></script>
    <script src="fontawesome/fontawesome-free-7.1.0-web/js/all.min.js"></script>
</body>
</html>