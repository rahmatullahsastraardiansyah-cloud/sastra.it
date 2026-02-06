<?php
    require "session.php";
    require "../koneksi.php";

    

    $id = $_GET['p'];

    $query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.
    kategori_id=b.id WHERE a.id='$id'");
    $data = mysqli_fetch_array($query);

    $querykategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");
    function generateRandomString($length = 20) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $len = strlen($chars);
    $out = '';
    for ($i = 0; $i < $length; $i++) {
        $out .= $chars[random_int(0, $len - 1)];
    }
    return $out;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>

<style>

    form div {
    margin-bottom: 10px;
}

</style>
<body>
    <?php require "navbar.php";?>

    <div class="container mt-5">
    <h2>Detail Produk</h2>

    <div class="col-12  col-md-6 mb-5">
    <form action="" method="post" enctype="multipart/form-data">
          <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?php echo $data['nama']?>" class="form-control" required autocomplete="off">
            </div>

             <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="<?php echo $data['kategori_id']?>"><?php echo $data['nama_kategori'] ?></option>
                    <?php while ($dataKategori = mysqli_fetch_array($querykategori)) { ?>
                        <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number"  class="form-control" value="$<?php echo $data['harga']; ?>" name="harga" required>
            </div>
                        <div>
                            <label for="currentFoto">foto produk sekarang</label>
                            <img src="../image/<?php echo $data['foto']?>" alt="" width="300px">
                        </div>
            <div>
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control" required>
            </div>

             <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="5" class="form-control">
                    <?php echo $data['detail']?>
                </textarea>
            </div>

            <div>
                <label for="ketersediaan_stock">Ketersediaan Stock</label>
                <select name="ketersediaan_stock" id="ketersediaan_stock" class="form-control">
                    <option value="<?php echo $data['ketersediaan_stock']?>"><?php echo $data['ketersediaan_stock']?></option>
                    <?php
                    if($data['ketersediaan_stock']=='tersedia'){
                      ?>
                        <option value="habis">Habis</option>
                      <?php  
                    }
                    else{
                        ?>
                        <option value="tersedia">tersedia</option>

                        <?php
                    }
                    ?>
                    
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary mt-3" name="simpan">Simpan</button>
                <button type="submit" class="btn btn-danger mt-3" name="hapus">hapus</button>
            </div>
    </form>
    <?php
        if(isset($_POST['simpan'])){
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
                ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Nama, kategori dan harga wajib diisi
                    </div>
                <?php
            }
            else{
                $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id='$kategori',
                nama='$nama', harga='$harga', detail='$detail', ketersediaan_stock='$ketersediaan_stock' WHERE id=$id");

                if($nama_file!=''){
                    if ($image_size > 500000000){
                        
                ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        file tidak bole lebih dari 500kb
                    </div>
                <?php
                        
                    }
                    else{
                        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                ?>
                        <div class="alert alert-warning mt-3" role="alert">
                        file wajib bertipe jpg atau png atau gif
                    </div>
                <?php

                        }
                        else{
                            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

                           $queryUpdate = mysqli_query($conn,"UPDATE produk SET foto='$new_name' WHERE id='$id'");


                            if($queryUpdate){
                ?>
                                 <div class="alert alert-primary mt-3">Produk berhasil tersimpan</div>
                                <meta http-equiv="refresh" content="2; url=produk.php" />
                <?php
                            }
                            else{
                                echo mysqli_errno($conn);
                            }
                        }
                    }
                }
                
            }
        }
        if(isset($_POST['hapus'])){
            $queryHapus = mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
            if($queryHapus){
    ?>
            <div class="alert alert-primary mt-3" role="alert">
                  produk Berhasil Dihapus
               </div>

               <meta http-equiv="refresh" content="2; url=produk.php" />
    <?php
            }
        }
    ?>
    </div>
    </div>
    
<script src="../bootstrap/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>