<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../conf/conn.php';

// membuat variabel untuk menampung data dari form
$judul      = $_POST['judul'];
$noisbn     = $_POST['noisbn'];
$penulis    = $_POST['penulis'];
$penerbit   = $_POST['penerbit'];
$tahun      = $_POST['tahun'];
$stok       = $_POST['stok'];
$pokok      = $_POST['harga_pokok'];
$jual       = $_POST['harga_jual'];
$gambar     = $_FILES['gambar']['name'];

// Menentukan nama gambar yang baru (jika ada)
$nama_gambar_baru = ''; // Inisialisasi variabel gambar

// cek jika ada gambar yang diupload
if ($gambar != "") {
  $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg'); // ekstensi file gambar yang bisa diupload 
  $x = explode('.', $gambar); // memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar']['tmp_name'];
  $angka_acak     = rand(1, 999);
  $nama_gambar_baru = $angka_acak . '-' . $gambar; // menggabungkan angka acak dengan nama file sebenarnya

  if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
    move_uploaded_file($file_tmp, '../../dist/img/' . $nama_gambar_baru); // memindahkan file gambar ke folder tujuan
  } else {
    // jika ekstensi file tidak diperbolehkan, tampilkan pesan error dan hentikan proses
    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg, atau png.');</script>";
    echo "<script>window.location.href='../../index.php?page=data_buku';</script>";
    exit;
  }
}

// Menyiapkan query untuk menambahkan data ke tabel buku
$query = "INSERT INTO buku (judul, noisbn, penulis, penerbit, tahun, stok, harga_pokok, harga_jual, gambar) 
          VALUES ('$judul', '$noisbn', '$penulis', '$penerbit', '$tahun', '$stok', '$pokok', '$jual', '$nama_gambar_baru')";

$result = mysqli_query($koneksi, $query);

// periksa query apakah ada error
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
  // tampil alert dan akan redirect ke halaman index.php
  echo '<script>alert("Data Berhasil Disimpan !!!");</script>';
  echo '<script>window.location.href="../../index.php?page=data_buku";</script>';
}
?>
