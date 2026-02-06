<?php
    require "koneksi.php";
    $queryProduk = mysqli_query($conn, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Home</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-7.1.0-web/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Toko online Fashion</h1>
            <h3>Mau cari apa?</h3>
            <form method="get" action="produk.php">
            <div class="col-md-8 offset-md-2">
            <div class="input-group input-group-lg my-4">
            <input type="text" class="form-control" placeholder="Nama barang" aria-label="Recipient’s username" aria-describedby="basic-addon2" name="keyword">
            <button tyepe="submit" class="btn warna3 text-white">Telusuri</button>
            </form>
            </div>
            </div>

        </div>
    </div>

    <!-- highlighted kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Terlaris</h3>

            <div class="row mt-5">
<div class="row mt-3">
    <div class="col-md-4 mb-3">
        <div class="highlighted-kategori viva d-flex justify-content-center align-items-center">
            <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Viva The Movie">Viva The Movie</a></h4>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="highlighted-kategori kampung-eles d-flex justify-content-center align-items-center">
            <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Server mc">Server mc</a></h4>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="highlighted-kategori brutal-legends d-flex justify-content-center align-items-center">
            <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=RP BL">RP BL</a></h4>
        </div>
    </div>
</div>
        </div>
    </div>

     <!-- tentang kategori -->
     <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>Tentang kami</h3>
            <p class="fs-5 mt-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error quidem iste voluptatibus. Harum sapiente, alias rerum hie exercitationem inventore ut tempore quis animi officiis ea omnis 
                quasi laboriosam quo quod neque rem, nostrum saepe aut enim
                 voluptatibus sint ipsum nobis. Provident molestiae laborum alias nobis voluptatibus! Provident facere corporis, aspernatur obcaecati facilis
                   at doloremque pariatur perferendis temporibus
                    laudantium natus repudiandae quidem ab placeat minus dicta quisquam voluptatum. Ipsa qui, ratione perferendisillo ducimus libero voluptates optio eaque repellendus? Impedit, officia!
            </p>
        </div>
     </div>

    

     <!-- produk -->
            <div class="container-fluid py-5">
  <div class="container text-center">
    <h3>Produk</h3>

    <div class="row mt-5">
      <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
      <div class="col-sm-6 col-md-4 mb-3">
        <div class="card h-100">
          <div class="image-box">
            <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
          </div>

          <div class="card-body">
            <h4 class="card-title"><?php echo $data['nama']; ?></h4>
            <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
            <p class="card-text text-harga">Rp<?php echo $data['harga']; ?></p>
            <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn warna3 text-white">Lihat Detail</a>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
    <a class="btn btn-outline-warning mt-3 p-3 fs-3" href="produk.php">See More</a>
  </div>
</div>



        <!-- footer -->
         <?php require"footer.php"?>


    
    <script src="bootstrap/bootstrap-5.3.8-dist/js/boostrap.bundle.min.js"></script>
    <script src="fontawesome/fontawesome-free-7.1.0-web/js/all.min.js"></script>
</body>
</html>