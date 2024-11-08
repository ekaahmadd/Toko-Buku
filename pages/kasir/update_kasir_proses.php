<?php
include "../../conf/conn.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$status = $_POST['status'];
$username = $_POST['username'];
$password = md5($_POST['password']);

// Validate phone number (allow only numbers and plus sign)
if (!preg_match("/^[0-9+]+$/", $telepon)) {
    echo '<script>alert("Nomor telepon tidak valid !!!"); window.location.href="../../index.php?page=data_kasir"</script>';
    exit;
}

// Validate status (only accept 'active' or 'nonactive')
if ($status !== 'active' && $status !== 'nonactive') {
    echo '<script>alert("Status tidak valid. Pilih status yang sesuai!"); window.location.href="../../index.php?page=data_kasir"</script>';
    exit;
}

// Prepare the update query
$query = "UPDATE kasir SET nama='$nama', alamat='$alamat', telepon='$telepon', status='$status', username='$username', password='$password' WHERE id_kasir=$id";

// Execute the query
if ($koneksi->query($query)) {
    echo '<script>alert("Data Berhasil Diupdate !!!");
    window.location.href="../../index.php?page=data_kasir"</script>';
} else {
    echo '<script>alert("Data Gagal Diupdate !!!");
    window.location.href="../../index.php?page=data_kasir"</script>';
}
?>
