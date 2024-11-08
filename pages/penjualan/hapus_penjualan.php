<?php
include "../../conf/conn.php";

// Mendapatkan ID penjualan yang akan dihapus
$id = $_GET['id'];

// Ambil data penjualan yang akan dihapus
$queryPenjualan = "SELECT * FROM penjualan WHERE id_penjualan = '$id' LIMIT 1";
$result = $koneksi->query($queryPenjualan);

if ($result->num_rows > 0) {
  $penjualan = $result->fetch_assoc();
  
  // Ambil ID buku dan jumlah yang terjual
  $id_buku = $penjualan['id_buku'];
  $jumlah_terjual = $penjualan['jumlah'];

  // Update stok buku dengan menambah kembali jumlah yang terjual
  $queryBuku = "UPDATE buku SET stok = stok + $jumlah_terjual WHERE id_buku = '$id_buku'";
  if ($koneksi->query($queryBuku)) {
    // Jika update stok buku berhasil, hapus data penjualan
    $queryDelete = "DELETE FROM penjualan WHERE id_penjualan = '$id'";
    if ($koneksi->query($queryDelete)) {
      // Redirect setelah data berhasil dihapus
      echo '<script>alert("Data Berhasil Dihapus dan Stok Buku Diperbarui!!!");
      window.location.href="../../index.php?page=data_penjualan";</script>';
    } else {
      echo '<script>alert("Data Penjualan Gagal Dihapus!!!");
      window.location.href="../../index.php?page=data_penjualan";</script>';
    }
  } else {
    echo '<script>alert("Gagal Memperbarui Stok Buku!!!");
    window.location.href="../../index.php?page=data_penjualan";</script>';
  }
} else {
  echo '<script>alert("Data Penjualan Tidak Ditemukan!!!");
  window.location.href="../../index.php?page=data_penjualan";</script>';
}
?>
