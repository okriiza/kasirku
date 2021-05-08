<?php
$ambil = $koneksi->query("SELECT * FROM transaksi WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM transaksi WHERE id='$_GET[id]'");
echo "<script>alert('transaksi Berhasil Terhapus');</script>";
echo "<script>location='index.php?page=transaksidetail';</script>";
