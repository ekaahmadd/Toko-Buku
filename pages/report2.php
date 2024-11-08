<?php
ob_start();
include "../conf/conn.php";
require_once("../plugins/dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$query = mysqli_query($koneksi, "SELECT * FROM distributor");

$html = '<center><h3>Daftar Data Distributor</h3></center><hr/><br/>';
$html .= '<table border="1" width="100%">
  <tr>
    <th>No</th>
    <th>Nama Distributor</th>
    <th>Alamat</th>
    <th>Telepon</th>
  </tr>';

$no = 1;
while ($row = mysqli_fetch_array($query)) {
  $html .= "<tr><td>" . $no . "</td><td>" . $row['nama_distributor'] . "</td><td>" . $row['alamat'] . "</td><td>" . $row['telepon'] . "</td></tr>";
  $no++;
}

$html .= "</table>";

$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');
// Rendering dari HTML ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_distributor.pdf');
?>
