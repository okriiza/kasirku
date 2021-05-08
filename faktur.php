<?php

include 'koneksi.php';

$query = "SELECT *,transaksi.subtotal AS subtotaltransaksi, transaksi_detail.subtotal AS subtotalbarang FROM transaksi JOIN transaksi_detail ON transaksi.id = transaksi_detail.id_transaksi JOIN admin ON transaksi.id_kasir = admin.id WHERE transaksi.id='$_GET[id]'";
$detail = $koneksi->query($query);
$detail_faktur = $detail->fetch_array();

function tgl_indo($tanggal)
{
   $bulan = array(
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
   );
   $pecahkan = explode('-', $tanggal);

   // variabel pecahkan 0 = tanggal
   // variabel pecahkan 1 = bulan
   // variabel pecahkan 2 = tahun
   return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Faktur Pembayaran</title>
</head>

<body style='font-family:tahoma; font-size:12pt;'>
   <center>
      <table width="800" style="font-size:12pt;">
         <td align="left" width='10%' style="vertical-align: top">
            <img width="50" style="margin-bottom: 2px;" src="logo/aj.png" alt="">
         </td>
         <td align="left" width='50%' style="display: block;">
            <b style="font-size: 12pt">ANUGRAH JAYA</b>
            <br>
            <span>
               Jl. Cicalengka, majalaya Km.6 Bandung <br> Telp. 081 320 616 283
            </span>
         </td>
         <td align="left" width='40%' style="vertical-align: top">
            <table>
               <!-- <tr>
                  <td>No.Invoice </td>
                  <td>: <?php echo $detail_faktur['invoice']; ?></td>
               </tr> -->
               <tr>
                  <td>Tanggal </td>
                  <td>: <?php echo tgl_indo($detail_faktur['tanggal_transaksi']); ?></td>
               </tr>
               <tr>
                  <td>Kepada </td>
                  <td>: <?php echo $detail_faktur['nama']; ?></td>
               </tr>
               <tr>
                  <td style="vertical-align: top">Alamat </td>
                  <td>: <?php echo $detail_faktur['alamat']; ?></td>
               </tr>
               <tr>
                  <td>No.Telp </td>
                  <td>: <?php echo $detail_faktur['no_pelanggan']; ?></td>
               </tr>
            </table>
         </td>
      </table>
      <!-- <table style='width:800px;'>
         <tr align="center">
            <td style="font-size: 15px">
               <b>No.Invoice</b>
            </td>
         </tr>
         <tr align="center">
            <td style="font-size: 12px">
               <?php echo $detail_faktur['invoice']; ?>
            </td>
         </tr>
      </table> -->
         <table style='width:800px; margin-top:10px; margin-bottom:10px; border:1px solid black; border-left:none; border-right:none;' cellspacing="0" >
            <tr align="" style="text-transform: uppercase;">
               <th width='3%'>No</th>
               <th width='20%'>Nama Barang</th>
               <th width='3%'>Jumlah</th>
               <th width='5%'>Satuan</th>
               <th width='8%'>Harga (RP)</th>
               <th width='8%'>Total</h>
            </tr>
         </table>
         <table style='width:800px; margin-top:10px; margin-bottom:10px' cellspacing="0" border="0">
            <tr align="" style="text-transform: uppercase;">
                  <th width='3%'></th>
                  <th width='20%'></th>
                  <th width='3%'></th>
                  <th width='5%'></th>
                  <th width='8%'></th>
                  <th width='8%'></h>
               </tr>
            <?php $nomor = 1; ?>
            <?php $ambil = $koneksi->query("SELECT * FROM transaksi_detail WHERE id_transaksi='$_GET[id]'"); ?>
            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
               <tr align="center" >
                  <td ><?php echo $nomor++; ?></td>
                  <td><?php echo $pecah['nama_barang']; ?><?php echo $pecah['ukuran']; ?> <?php echo $pecah['kode']; ?></td>
                  <td ><?php echo $pecah['jumlah_pembelian']; ?></td>
                  <td ><?php echo $pecah['satuan']; ?></td>
                  <td align="right">Rp. <?php echo number_format($pecah['harga'], 0, ".", "."); ?></td>
                  <td align="right">Rp. <?php echo number_format($pecah['subtotal'], 0, ".", "."); ?></td>
               </tr>
            <?php }; ?>
            <tr>
               <td colspan="5" align="right" style='border-left:none;border-bottom:none'>SUBTOTAL :</td>
               <td align="right" style='border-left:none;border-right:none;border-bottom:none'>Rp. <?php echo number_format($detail_faktur['subtotaltransaksi'], 0, ".", "."); ?></td>
            </tr>
            <?php
            if ($detail_faktur['diskon'] == "0" or $detail_faktur['diskon'] == null) {
            } else {
               echo "<tr>
               <td colspan='5' align='right' style='border-left:none;border-bottom:none'>DISKON :</td>
               <td align='right' style='border-left:none;border-right:none;border-bottom:none'>";
               echo $detail_faktur['diskon'];
               echo "%</td>";
               echo "</tr>";
            }
            ?>
            <tr>
               <td colspan="5" align="right" style='border-left:none;border-bottom:none'>GRAND TOTAL :</td>
               <td align="right" style='border-left:none;border-right:none;border-bottom:none'>Rp. <?php echo number_format($detail_faktur['grandtotal'], 0, ".", "."); ?></td>
            </tr>
            <tr>
               <td colspan="5" align="right" style='border-left:none;border-bottom:none'>BAYAR :</td>
               <td align="right" style='border-left:none;border-right:none;border-bottom:none'>Rp. <?php echo number_format($detail_faktur['bayar'], 0, ".", "."); ?></td>
            </tr>
            <tr>
               <td colspan="5" align="right" style='border-left:none;border-bottom:none'>Kembalian :</td>
               <td align="right" style='border-left:none;border-right:none;border-bottom:none'>Rp. <?php echo number_format($detail_faktur['kembalian'], 0, ".", "."); ?></td>
            </tr>
            <table style="width:800px;" border="0">
               <tr>
                  <td align="center" width='10%'><b>PENERIMA</b></td>
                  <td align="center" width='10%'><b>PENGIRIM</b></td>
                  <td align="center" width='10%'><b>DIKELUARKAN OLEH</b></td>
               </tr>
               <tr>
                  <td align="center" height="50"></td>
                  <td align="center" height="50"></td>
                  <td align="center" height="50"></td>
               </tr>
               <tr>
                  <td align="center">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
                  <td align="center">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
                  <td align="center">(&nbsp;&nbsp;<b><?php echo $detail_faktur['nama_lengkap']; ?></b>&nbsp;&nbsp;)</td>
               </tr>
               <tr>
                  <td colspan="3" style="padding-top: 15px; font-size: 8px"><span align="left"><b>NOTE:</b> <br>BARANG YANG SUDAH DIBELI TIDAK DAPAT DIKEMBALIKAN/DITUKAR KECUALI ADA PERJANJIAN.</span>
                  </td>
               </tr>
            </table>
         </table>
   </center>

</body>
<script>
   // print();
   // setTimeout(window.close, 500);
</script>

</html>