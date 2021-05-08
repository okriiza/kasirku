<?php

session_start();

$detail = $_SESSION["detail"];
$id_barang = $_POST["id_barang"];
$value = $_POST["value"];

$detail[$id_barang]["qty"] = $value;

$_SESSION["detail"] = $detail;
