<?php
$ambil = $koneksi->query("SELECT * FROM kode WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM kode WHERE id='$_GET[id]'");
echo "<script>alert('Kode Berhasil Terhapus');</script>";
echo "<script>location='index.php?page=kodeproduk';</script>";
