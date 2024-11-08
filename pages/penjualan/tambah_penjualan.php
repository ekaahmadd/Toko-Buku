<?php
  // session_start(); // Jika perlu, aktifkan session untuk mengambil username
  $user = $_SESSION['username'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      TAMBAH PENJUALAN
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li class="active">TAMBAH PENJUALAN</li>
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
          <form role="form" method="post" action="pages/penjualan/simpan_penjualan_proses.php">
            <div class="box-body">
              <div class="form-group">
                <label>Buku</label>
                <select class="form-control" name="buku" id="buku" required onchange="updateHarga()">
                  <option value="">- Pilih -</option>
                  <?php
                  include "conf/conn.php";
                  $query = mysqli_query($koneksi, "SELECT * FROM buku") or die(mysqli_error($koneksi));
                  while ($row = mysqli_fetch_array($query)) {
                    echo '<option value="' . $row['id_buku'] . '" data-harga="' . $row['harga_jual'] . '">' . $row['judul'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Kasir</label>
                <input type="text" name="kasir" class="form-control" value="<?=$user?>" readonly>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Jumlah" oninput="updateTotal()">
              </div>
              <div class="form-group">
                <label>Total</label>
                <input type="text" name="total" id="total" class="form-control" placeholder="Total" readonly>
              </div>
              <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" placeholder="Tanggal">
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
  let harga_jual = 0;

  // Fungsi untuk memperbarui harga saat memilih buku
  function updateHarga() {
    const selectedBuku = document.getElementById('buku');
    const selectedOption = selectedBuku.options[selectedBuku.selectedIndex];
    harga_jual = selectedOption.getAttribute('data-harga');
    updateTotal(); // Update total setelah memilih buku
  }

  // Fungsi untuk menghitung total
  function updateTotal() {
    const jumlah = document.getElementById('jumlah').value;
    if (jumlah && harga_jual) {
      const total = jumlah * harga_jual + '000';
      document.getElementById('total').value = total;
      
    }
  }
</script>
