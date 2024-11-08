<?php
include "../../conf/conn.php";
$nama = $_POST["nama"];
$alamat = $_POST["alamat"];
$telepon = $_POST["telepon"];
$status = $_POST["status"];
$username = $_POST["username"];
$password = md5($_POST["password"]);
$level = 'kasir'; // Menambahkan nilai default untuk kolom level

$query = "INSERT INTO kasir (nama, alamat, telepon, status, username, password, level) 
          VALUES ('$nama', '$alamat', '$telepon', '$status', '$username', '$password', '$level')";

if ($koneksi->query($query)) {
    echo '<script>alert("Data Berhasil Disimpan !!!");
          window.location.href="../../index.php?page=data_kasir"</script>';
} else {
    echo '<script>alert("Data Gagal Disimpan !!!");
          window.location.href="../../index.php?page=data_kasir"</script>';
}
?>
