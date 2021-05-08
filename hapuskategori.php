<?php
$ambil = $koneksi->query("SELECT * FROM kategori WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM kategori WHERE id='$_GET[id]'");
echo "<script>alert('Kategori Berhasil Terhapus');</script>";
echo "<script>location='index.php?page=kategoriproduk';</script>";
