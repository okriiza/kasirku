<?php
$ambil = $koneksi->query("SELECT * FROM ukuran WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM ukuran WHERE id='$_GET[id]'");
echo "<script>alert('ukuran Berhasil Terhapus');</script>";
echo "<script>location='index.php?page=ukuranproduk';</script>";
