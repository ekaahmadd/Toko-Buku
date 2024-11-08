<?php
include "../../conf/conn.php";
session_start(); // Pastikan session dimulai jika belum ada
$user = $_SESSION['username'];

// Ambil id_kasir berdasarkan username yang login
$queryKasir = "SELECT id_kasir FROM kasir WHERE username = '$user' LIMIT 1";
$resultKasir = mysqli_query($koneksi, $queryKasir);
$rowKasir = mysqli_fetch_assoc($resultKasir);

// Pastikan id_kasir ditemukan
if ($rowKasir) {
    $id_kasir = $rowKasir['id_kasir'];
} else {
    // Jika id_kasir tidak ditemukan, tampilkan error atau redirect
    echo "Kasir tidak ditemukan!";
    exit; // Berhenti di sini jika tidak ditemukan
}

$buku = $_POST["buku"];
$jumlah = $_POST["jumlah"];
$total = $_POST["total"];
$tanggal = $_POST["tanggal"];

// Query untuk menyimpan penjualan
$query = "INSERT INTO penjualan (id_buku, id_kasir, jumlah, total, tanggal) 
          VALUES ('$buku', '$id_kasir', '$jumlah', '$total', '$tanggal')";

if ($koneksi->query($query)) {
    // Redirect atau pesan sukses
    echo '<script>alert("Data Berhasil Ditambah !!!");
    window.location.href="../../index.php?page=data_penjualan"</script>';
} else {
    // Pesan error gagal simpan
    echo '<script>alert("Data Gagal Ditambah !!!");
    window.location.href="../../index.php?page=data_penjualan"</script>';
}
?>
