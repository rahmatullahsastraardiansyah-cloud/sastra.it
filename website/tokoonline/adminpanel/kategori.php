<?php
require "session.php";
require "../koneksi.php";

$querykategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($querykategori);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kategori</title>
     <link rel="stylesheet" href="../bootstrap/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/fontawesome-free-7.1.0-web/css/fontawesome.min.css">
</head>

<style>
     .no-decoration{
        text-decoration: none;
    }
</style>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="../adminpanel" class="no-decoration text-muted"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                kategori
            </li>
        </ol>
         </nav>
         <div class="my-5 col-12 col-md-6">
            <h3>tambah kategori</h3>

            <form action="" method="post">
                <div>
                    <label for="kategori">kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="input nama kategori"
                    class="form-control">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan_kategori'])){
                    $kategori = htmlspecialchars($_POST['kategori']);

                   $queryExist = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama='$kategori'");
                    $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                    if($jumlahDataKategoriBaru > 0){
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                        Kategori Sudah Ada
                        </div>
                        <?php
                    }
                    else{
                       $querySimpan = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");


                        if($querySimpan){
                            ?>
                             <div class="alert alert-primary mt-3" role="alert">
                                 Kategori Berhasil Tersimpan
                              </div>

                              <meta http-equiv="refresh" content="2; url=kategori.php" />
                              <?php

                        }
                        else{
                            echo mysqli_error($conn);
                        }
                    }
                }
            ?>
         </div>

         <div class="mt-3">
            <h2>List kategori</h2>
         </div>

         <div class="table-responsive mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($jumlahkategori==0){
                     ?>
                        <tr>
                            <td colspan=3 class="text-center">Data Kategori Tidak Tersedia</td>
                        </tr>
                    <?php
                        } 
                        else{
                            $jumlah=1;
                            while ($row = mysqli_fetch_array($querykategori)) {
                        ?>
                            <tr>
                        <td><?php echo $jumlah; ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td>
                            <a href="kategori-detail.php?p=<?php echo $row['id']; ?>
                                " class="btn btn-info"><i class="fas fa-search"></i>
                            </a>
                        </td>
                    </tr>

                        <?php
                            $jumlah++;
                            }
                        }
                    ?>
                </tbody>
            </table>
         </div>
    </div>
    
    <script src="../bootstrap/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/fontawesome-free-7.1.0-web/js/all.js"></script>
</body>
</html>