<?php
include('../toko-buku/conf/conn.php');

$id = $_GET['id'];

$query = "SELECT * FROM penjualan WHERE id_penjualan = $id LIMIT 1";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_array($result);

// Mengambil harga jual dari buku yang sudah dipilih
$buku_id = $row['id_buku'];
$bukuQuery = "SELECT harga_jual FROM buku WHERE id_buku = $buku_id LIMIT 1";
$bukuResult = mysqli_query($koneksi, $bukuQuery);
$bukuRow = mysqli_fetch_array($bukuResult);
$harga_jual = $bukuRow['harga_jual'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      UBAH PENJUALAN
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li class="active">UBAH PENJUALAN</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="pages/penjualan/update_penjualan_proses.php">
            <div class="box-body">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <div class="form-group">
                <label for="buku">Buku</label>
                <select class="form-control" id="buku" name="buku" onchange="updateHargaJual()">
                  <?php
                  $queryBuku = mysqli_query($koneksi, "SELECT id_buku, judul, harga_jual FROM buku");
                  while ($bukuRow = mysqli_fetch_assoc($queryBuku)) {
                    $selected = ($bukuRow['id_buku'] == $row['id_buku']) ? "selected" : "";
                    echo "<option value='" . $bukuRow['id_buku'] . "' data-harga='" . $bukuRow['harga_jual'] . "' $selected>" . $bukuRow['judul'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="kasir">Kasir</label>
                <select class="form-control" id="kasir" name="kasir">
                  <?php
                  $queryKasir = mysqli_query($koneksi, "SELECT id_kasir, nama FROM kasir");
                  while ($kasirRow = mysqli_fetch_assoc($queryKasir)) {
                    $selected = ($kasirRow['id_kasir'] == $row['id_kasir']) ? "selected" : "";
                    echo "<option value='" . $kasirRow['id_kasir'] . "' $selected>" . $kasirRow['nama'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" value="<?php echo $row['jumlah']; ?>" required id="jumlah" oninput="updateTotal()">
              </div>
              <div class="form-group">
                <label>Total</label>
                <input type="text" name="total" class="form-control" placeholder="Total" value="<?php echo $row['total']; ?>" required id="total" readonly>
              </div>
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo $row['tanggal']; ?>" required>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" title="Simpan Data"> <i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  // Fungsi untuk memperbarui harga jual ketika buku dipilih
  function updateHargaJual() {
    var selectedBuku = document.getElementById("buku").selectedOptions[0];
    var hargaJual = selectedBuku.getAttribute('data-harga');
    window.hargaJual = hargaJual; // Menyimpan harga jual untuk perhitungan total
    updateTotal(); // Memperbarui total jika sudah ada jumlah
  }

  // Fungsi untuk menghitung total berdasarkan jumlah dan harga jual
  function updateTotal() {
    var jumlah = document.getElementById("jumlah").value;
    var total = jumlah * window.hargaJual + '000'; // Menghitung total
 // Menampilkan total dengan 2 angka desimal
  }

  // Inisialisasi harga jual jika halaman dimuat
  window.onload = function() {
    updateHargaJual();
  };
</script>
