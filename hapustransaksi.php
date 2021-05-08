<?php
if (!isset($_SESSION)) {
   session_start();
}

$id_barang = $_GET["id"];
unset($_SESSION["detail"][$id_barang]);
echo "<script>location='index.php?page=transaksi';</script>";
