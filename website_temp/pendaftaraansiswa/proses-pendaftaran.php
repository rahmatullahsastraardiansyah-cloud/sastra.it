<?php
include("config.php");

// cek apakah tombol daftar sudah diklik
if (isset($_POST['daftar'])) {

    // ambil data dari formulir
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $jk       = $_POST['jenis_kelamin'];
    $agama    = $_POST['agama'];
    $sekolah  = $_POST['sekolah_asal'];

    // validasi sederhana
    if (empty($nama) || empty($alamat) || empty($jk) || empty($agama) || empty($sekolah)) {
        header('Location: index.php?status=gagal&error=Data tidak lengkap');
        exit();
    }

    // buat query dengan prepared statement (lebih aman dari SQL Injection)
    $stmt = $db->prepare("INSERT INTO calon_siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal)
                          VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $alamat, $jk, $agama, $sekolah);

    // eksekusi query
    if ($stmt->execute()) {
        header('Location: index.php?status=sukses');
        exit();
    } else {
        header('Location: index.php?status=gagal');
        exit();
    }

} else {
    die("Akses dilarang...");
}
?>
