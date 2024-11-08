<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$koneksi = mysqli_connect("localhost", "root", "", "toko_buku1");

if ($koneksi) {
    echo "";
} else {
    echo "Koneksi gagal: " . mysqli_connect_error();
}

