<?php
ob_start();
include "../conf/conn.php";
require_once("../plugins/dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$query = mysqli_query($koneksi, "SELECT * FROM buku");

$html = '
  <center><h3>Daftar Data Buku</h3></center>
  <hr/>
  <br/>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #000;
      padding: 8px;
      text-align: center;
    }
    th {
      background-color: #f2f2f2;
    }
    td {
      font-size: 12px;
    }
  </style>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>No ISBN</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Tahun</th>
        <th>Stok</th>
        <th>Harga Pokok</th>
        <th>Harga Jual</th>
      </tr>
    </thead>
    <tbody>';

$no = 1;
while ($row = mysqli_fetch_array($query)) {
  $html .= "<tr>
            <td>" . $no . "</td>
            <td>" . $row['judul'] . "</td>
            <td>" . $row['noisbn'] . "</td>
            <td>" . $row['penulis'] . "</td>
            <td>" . $row['penerbit'] . "</td>
            <td>" . $row['tahun'] . "</td>
            <td>" . $row['stok'] . "</td>
            <td>" . number_format($row['harga_pokok'], 0, ',', '.') . "</td>
            <td>" . number_format($row['harga_jual'], 0, ',', '.') . "</td>
          </tr>";
  $no++;
}

$html .= '</tbody>
  </table>';

// Load HTML ke Dompdf
$dompdf->loadHtml($html);

// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');

// Rendering HTML ke PDF
$dompdf->render();

// Mengoutput file PDF
$dompdf->stream('laporan_buku.pdf', array("Attachment" => 0)); // Menambahkan "Attachment" => 0 untuk menampilkan langsung di browser
?>
