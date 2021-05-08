<?php
$ambil = $koneksi->query("SELECT * FROM barang WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM barang WHERE id='$_GET[id]'");
echo "<script>alert('barang Berhasil Terhapus');</script>";
echo "<script>location='index.php?page=barang';</script>";
