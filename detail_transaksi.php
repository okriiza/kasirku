<?php
include "koneksi.php";
if ($_POST['id']) {
   $id = $_POST['id'];
   $nomor = 1;
   $view = $koneksi->query("SELECT *, transaksi.subtotal AS subtotaltransaksi, transaksi_detail.subtotal AS subtotalbarang FROM transaksi JOIN transaksi_detail ON transaksi.id = transaksi_detail.id_transaksi JOIN admin ON admin.id = transaksi.id_kasir WHERE id_transaksi='$id'");
   $detail_transaksi = $view->fetch_assoc();
   echo ' <div class="container-fluid">
      <div class="row">
         <div class="col-md-6">
            <table width="100%">
               <tr style="vertical-align: top">
                  <td><label for="">kasir </label></td>
                  <td><span id="kasir">: ' . $detail_transaksi['nama_lengkap'] . '</span></td>
               </tr>
               <tr style="vertical-align: top">
                  <td><label for="">Tanggal </label></td>
                  <td><span id="tanggal">: ' . $detail_transaksi['tanggal_transaksi'] . '</span></td>
               </tr>
               <tr style="vertical-align: top">
                  <td><label for="">Nama </label></td>
                  <td><span id="nama">: ' . $detail_transaksi['nama'] . '</span></td>
               </tr>
               <tr style="vertical-align: top">
                  <td><label for="">Alamat </label></td>
                  <td><span id="alamat">: ' . $detail_transaksi['alamat'] . '</span></td>
               </tr>
               <tr style="vertical-align: top">
                  <td style="width:30%"><label for="">No Telpon </label></td>
                  <td><span id="notlp">: ' . $detail_transaksi['no_pelanggan'] . '</span></td>
               </tr>
            </table>
         </div>
         <div class="col-md-6">
            <table width="100%">
               <tr style="vertical-align: top">
                  <td><label for="">SubTotal </label></td>
                  <td><span id="subtotal">: Rp. ' . number_format($detail_transaksi['subtotaltransaksi'], 0, ".", ".") . '</span></td>
               </tr>
               <tr style="vertical-align: top">
                  <td><label for="">Discount </label></td>
                  <td><span id="diskon">: ' .  $detail_transaksi['diskon'] . '</span></td>
               </tr>
               <tr style="vertical-align: top">
                  <td style="width:30%"><label for="">Grand Total </label></td>
                  <td><span id="grandtotal">: Rp. ' . number_format($detail_transaksi['grandtotal'], 0, ".", ".")
      . '</span></td>
               </tr>
               <tr style="vertical-align: top">
                  <td><label for="">Bayar </label></td>
                  <td><span id="bayar">: Rp. ' . number_format($detail_transaksi['bayar'], 0, ".", ".") . '</span></td>
               </tr>
               <tr style="vertical-align: top">
                  <td><label for="">Kembalian </label></td>
                  <td><span id="kembalian">: Rp. ' . number_format($detail_transaksi['kembalian'], 0, ".", ".") . '</span></td>
               </tr>
               
            </table>
         </div>
      </div>
   </div>';
   // <tr style="vertical-align: top">
   // <td><label for="">No Invoice </label></td>
   // <td><span id="invoice">: ' . $detail_transaksi['invoice'] . ' </span></td>
   // </tr>
   echo '
			<table id="example1" class="table table-bordered">
                     <thead>
                        <tr>
                           <th style="width:5%;" align="center">No</th>
                           <th>Nama Barang</th>
                           <th>Harga</th>
                           <th>Satuan</th>
                           <th>Qty</th>
                           <th>Total</th>
                        </tr>
                     </thead>
                     <tbody>';
   $ambil = $koneksi->query("SELECT * FROM transaksi_detail WHERE id_transaksi='$id'");
   while ($row_view = $ambil->fetch_assoc()) {
      echo '
			<tr>
                              <td align="center">' . $nomor++ . '</td>
                              <td>' . $row_view['nama_barang'] . ' ' . $row_view['ukuran'] .  ' ' . $row_view['kode'] . '</td>
                              <td align="right">Rp. ' . number_format($row_view['harga'], 0, ".", ".") . '</td>
                              <td align="center">' . $row_view['satuan'] . '</td>
										<td align="right">' . $row_view['jumlah_pembelian'] . ' </td>
										<td align="right">Rp. ' . number_format($row_view['subtotal'], 0, ".", ".") . '</td>
									</tr>';
   }
   echo '</tbody>
		</table>';
}
