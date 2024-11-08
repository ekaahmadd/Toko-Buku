<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      DATA PENJUALAN
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li class="active">DATA PENJUALAN</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <a href="index.php?page=tambah_penjualan" class="btn btn-primary" role="button" title="Tambah Data"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
          </div>
          <div class="box-body table-responsive">
            <table id="penjualan" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>KASIR</th>
                  <th>JUMLAH</th> <!-- Tambahkan kolom jumlah -->
                  <th>TOTAL</th>
                  <th>TANGGAL</th>
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include "../toko-buku1/conf/conn.php";
                $no = 0;
                // Menambahkan kolom jumlah pada query
                $query = mysqli_query($koneksi, "SELECT penjualan.*, kasir.*, buku.harga_jual FROM penjualan
                INNER JOIN kasir ON penjualan.id_kasir = kasir.id_kasir
                INNER JOIN buku ON penjualan.id_buku = buku.id_buku
                ORDER BY penjualan.id_penjualan DESC")
                  or die(mysqli_error($koneksi));

                while ($row = mysqli_fetch_array($query)) {
                  // Hitung jumlah dari data yang ada
                  $jumlah = $row['jumlah'];
                  $harga_jual = $row['harga_jual'];
                  
                  $total = $jumlah * $harga_jual; // Menghitung total
                  
                  // Format total dengan menambahkan tiga angka nol
                  $totalFormatted = number_format($total, 0, ',', '.'); // Menambahkan format angka
                  $totalWithZeros = $totalFormatted . '000'; // Menambahkan '000' pada akhir total
                ?>
                  <tr>
                    <td><?php echo $no = $no + 1; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $jumlah; ?></td> <!-- Menampilkan kolom jumlah -->
                    <td><?php echo $totalWithZeros; ?></td> <!-- Menampilkan total dengan '000' -->
                    <td><?php echo $row['tanggal']; ?></td>
                    <td>
                      <a href="index.php?page=ubah_penjualan&id=<?= $row['id_penjualan']; ?>" class="btn btn-success" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit"></i></a>
                      <a href="javascript:void(0);" class="btn btn-danger" role="button" title="Hapus Data" onclick="hapusPenjualan(<?= $row['id_penjualan']; ?>);"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Javascript Datatable -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#penjualan').DataTable();
  });

  function hapusPenjualan(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
      window.location.href = "pages/penjualan/hapus_penjualan.php?id=" + id;
    }
  }
</script>
