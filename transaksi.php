<?php
if (!isset($_SESSION)) {
   session_start();
}
?>
<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-sm-6">
         <h1 class="m-0 text-dark">Transaksi</h1>
      </div>
      <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item ">Penjualan</li>
            <li class="breadcrumb-item active">Transaksi</li>
         </ol>
      </div>
   </div>
</div>
<?php
if (isset($_POST["proses"])) {
   $id_kasir = $_SESSION['admin']['id'];
   $tanggal_transaksi = date('y-m-d');
   $nama_pelanggan = $_POST["nama_pelanggan"];
   $alamat_pelanggan = $_POST['alamat_pelanggan'];
   $no_pelanggan = $_POST['no_pelanggan'];
   $no_invoice = $_POST['invoice'];
   $grandtotal = $_POST['grandtotal'];
   $grandtotal = preg_replace("/[^0-9]/", '', $grandtotal);
   $hasildiskon = $_POST['hasildiskon'];
   $hasildiskon = preg_replace("/[^0-9]/", '', $hasildiskon);
   $diskon = $_POST['diskon'];
   $subtotal = $_POST['subtotal'];
   $subtotal = preg_replace("/[^0-9]/", '', $subtotal);
   $bayar = $_POST['bayar'];
   $kembalian = $_POST['kembalian'];
   $kembalian = preg_replace("/[^0-9]/", '', $kembalian);
   if (empty($nama_pelanggan)) {
      $error = "<small class='text-danger'>Nama Pelanggan Belum Terinput</small>";
   } elseif (empty($alamat_pelanggan)) {
      $error_alamat = "<small class='text-danger'>Alamat Pelanggan Belum Terinput</small>";
   } elseif (empty($no_pelanggan)) {
      $error_no = "<small class='text-danger'>No Pelanggan Belum Terinput</small>";
   } else {
      if (isset($nama_pelanggan) && isset($alamat_pelanggan) && isset($no_pelanggan)) {
         $query = "INSERT INTO transaksi (id_kasir,tanggal_transaksi,nama,alamat,no_pelanggan,invoice,subtotal,diskon,hasildiskon,grandtotal,bayar,kembalian) VALUE ('$id_kasir','$tanggal_transaksi','$nama_pelanggan','$alamat_pelanggan','$no_pelanggan','$no_invoice','$subtotal','$diskon','$hasildiskon','$grandtotal','$bayar','$kembalian')";
         $koneksi->query($query);
         $id_transaksi = $koneksi->insert_id;

         if (!isset($_SESSION['detail']) or empty($_SESSION['detail'])) {
            echo "";
         } else {
            foreach ($_SESSION['detail'] as $id_barang => $qty) {
               $barang_id = $id_barang;
               $query = "SELECT * FROM barang WHERE id='$barang_id'";
               $ambil = $koneksi->query($query);
               $pecah = $ambil->fetch_assoc();
               $nama_barang = $pecah['nama_barang'];
               $harga_barang = $pecah['harga_barang'];
               $satuan = $pecah['satuan'];
               $ukuran = $pecah['ukuran'];
               $kode = $pecah['kode'];
               $total = $harga_barang * $qty;

               $barang_detail = "INSERT INTO transaksi_detail (id_transaksi,id_barang,nama_barang,ukuran,kode,harga,jumlah_pembelian,satuan,subtotal) VALUE ('$id_transaksi','$barang_id','$nama_barang','$ukuran','$kode','$harga_barang','$qty','$satuan','$total')";
               $koneksi->query($barang_detail);

               $update_stok = "UPDATE barang SET stok_barang = stok_barang - $qty WHERE id='$barang_id'";
               $koneksi->query($update_stok);
            }
         }
         unset($_SESSION['detail']);
         echo "<script>alert('Transaksi berhasil'); location=index.php?page=transaksi</script>";
         echo "<script>window.open('faktur.php?id=$id_transaksi');</script>";
      }
   }
}

?>
<div class="content">
   <div class="container-fluid">
      <form action="" method="post" enctype="multipart/form-data">
         <div class="row">
            <div class="col-lg-4">
               <div class="card card-primary card-outline">
                  <div class="card-body">
                     <table width="100%">
                        <tr>
                           <td style="vertical-align: top" align="center">
                              <label for="">Tanggal </label>
                           </td>
                           <td>
                              <div class="form-group">
                                 <input type="date" name="tanggal_transaksi" class="form-control" readonly value="<?php
                                                                                                                  echo date('Y-m-d'); ?>">
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td align="center" style="vertical-align: top" width="30%">
                              <div class="form-group">
                                 <label for="">Nama Pelanggan</label>
                              </div>
                           </td>
                           <td>
                              <div class="form-group">
                                 <input type="text" name="nama_pelanggan" class="form-control">
                                 <?php
                                 if (isset($_POST['proses'])) {
                                    echo $error;
                                 }
                                 ?>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td align="center" style="vertical-align: top" width="30%">
                              <label for="">Alamat Pelanggan</label>

                           </td>
                           <td>
                              <div class="form-group">
                                 <input type="text" name="alamat_pelanggan" class="form-control">
                                 <?php
                                 if (isset($_POST['proses'])) {
                                    echo $error_alamat;
                                 }
                                 ?>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td align="center" style="vertical-align: top" width="30%">
                              <label for="">No Pelanggan</label>
                           </td>
                           <td>
                              <div class="form-group">
                                 <input type="text" name="no_pelanggan" class="form-control">
                                 <?php
                                 if (isset($_POST['proses'])) {
                                    echo $error_no;
                                 }

                                 ?>
                              </div>
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="card card-success card-outline">
                  <div class="card-body">
                     <table width="100%">
                        <tr>
                           <td style="vertical-align: top">
                              <label for="">Nama Barang</label>
                           </td>
                           <td colspan="2">
                              <div class="form-group ">
                                 <select name="barang" id="barang" onchange="changeValue(this.value)" class="form-control barang">
                                    <option></option>
                                    <?php
                                    $query = "SELECT * FROM barang";
                                    $ambil = $koneksi->query($query);
                                    $jsArray = "var ambil_harga = new Array();\n";
                                    while ($barang = $ambil->fetch_assoc()) {
                                       $ket = "";

                                       if (isset($_POST['barang'])) {
                                          $ambildata = trim($_POST['barang']);

                                          if ($ambildata == $barang['id']) {
                                             $ket = "selected";
                                          }
                                       }
                                    ?>
                                       <option <?php echo $ket; ?> value="<?php echo $barang['id']; ?>"><?php echo $barang['nama_barang']; ?> <?php echo $barang['ukuran']; ?> <?php echo $barang['kode']; ?></option>
                                       <?php
                                       $jsArray .= "ambil_harga['" . $barang['id'] . "'] = 
                                       {
                                          id           : '" . addslashes($barang['id']) . "',
                                          harga_barang : 'Rp. " . addslashes(number_format($barang['harga_barang'], 0, ".", ".")) . "',
                                          stok_barang  : '" . addslashes($barang['stok_barang']) . "'};\n"; ?>
                                    <?php }; ?>
                                 </select>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td style="vertical-align: top" width="30%">
                              <div class="form-group">
                                 <label for="">QTY </label>
                                 <input type="number" name="qty" class="form-control" min="1" placeholder="Qty">
                              </div>
                           </td>
                           <td style="vertical-align: top">
                              <label for="">Harga </label>
                              <div class="form-group input-group">
                                 <input type="text" readonly class="form-control" name="harga_barang" id="harga_barang" placeholder="Rp.0">
                              </div>
                           </td>
                           <td style="vertical-align: top">
                              <label for="">Stok </label>
                              <div class="form-group input-group">
                                 <input type="text" readonly class="form-control" name="stok_barang" id="stok_barang" placeholder="0">
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td>
                              <div class="form-group">
                                 <button name="tambah" class="btn btn-primary btn-sm float-right mt-3"><i class="fa fa-cart-plus"></i> Tambah</button>
                              </div>
                           </td>
                        </tr>
                     </table>
                     <input type="hidden" name="id_barang" class="id_barang">
                     <?php
                     if (isset($_POST['tambah'])) {
                        $qty = $_POST["qty"];
                        $id_barang = $_POST["id_barang"];
                        if (empty($qty)) {
                           echo "<script>alert('Barang Belum Di Pilih / Jumlah Pembelian Belum Di Input');</script>";
                        } else {
                           $_SESSION["detail"][$id_barang] = $qty;
                        }
                     }
                     ?>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="card card-warning card-outline">
                  <div class="card-body">
                     <?php
                     // $today = date("dmyHis"); // yang di pake
                     // $query = "SELECT max(invoice) AS voice FROM transaksi WHERE invoice LIKE '$today%'";
                     // $hasil = $koneksi->query($query);
                     // $data  = mysqli_fetch_array($hasil);
                     // $lastNoTransaksi = $data['voice'];
                     // // $lastNoUrut = substr($lastNoTransaksi, 12, 4);
                     // // $nextNoUrut = $lastNoUrut + 1;
                     // // $inisial = "AJ";
                     // // $nextNoTransaksi = $inisial . $today . sprintf('%04s', $nextNoUrut);
                     // $noUrut =  substr($lastNoTransaksi, 10, 4);
                     // $nourutnext = $noUrut + 1;
                     // $char = "AJ"; // yang di pake
                     // $invoice = $char . $today; // yang di pake
                     ?>
                     <div align="right">
                        <!-- <h5>Invoice
                           <div class="form-group">
                              <input readonly name="invoice" class="form-control" type="text" value="<?php echo $invoice; ?>" style="font-size: 18pt; text-align:right; border: 0 solid; outline: none; background: #fff; color: #000; font-weight: 700; width:100%; padding:0">
                           </div>
                        </h5> -->
                        <h5>Total Pembelian</h5>
                        <h1>
                           <div class="form-group">
                              <input readonly id="subtotal2" name="grandtotal" onkeyup="cok();" class="subtotal2" type="text" class="form-control" value="Rp.0" style="font-size: 35pt; text-align:right; border: 0 solid; outline: none; background: #fff; color: #000; font-weight: 700; width:100%">
                           </div>
                        </h1>
                        <h1>
                           <div class="form-group">
                              <input readonly id="hasildiskon" name="hasildiskon" onkeyup="cok();" class="hasildiskon" type="hidden" class="form-control" value="Rp.0" style="font-size: 35pt; text-align:right; border: 0 solid; outline: none; background: #fff; color: #000; font-weight: 700; width:100%">
                           </div>
                        </h1>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="card card-danger card-outline">
                  <div class="card-body table-responsive-md">
                     <table class="table table-bordered ">
                        <thead>
                           <tr>
                              <th style="width:5%;" align="center">No</th>
                              <th>Nama Barang</th>
                              <th>Harga</th>
                              <th>Satuan</th>
                              <th>Qty</th>
                              <th>Total</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           if (!isset($_SESSION['detail']) or empty($_SESSION['detail'])) {
                              echo "<tr><td colspan='7' class='text-center'>Tidak ada item</td></tr>";
                           } else { ?>
                              <?php $nomor = 1;
                              $subtotal = (isset($subtotal)) ? $subtotal : 0;
                              foreach ($_SESSION['detail'] as $id_barang => $qty) :
                                 $barang_id = $id_barang;
                                 $query = "SELECT * FROM barang WHERE id='$barang_id'";
                                 $ambil = $koneksi->query($query);
                                 $pecah = $ambil->fetch_assoc();
                                 $satuan = $pecah['satuan'];
                                 $harga = $pecah['harga_barang'];
                                 $nama = $pecah['nama_barang'];
                                 $kode = $pecah['kode'];
                                 $ukuran = $pecah['ukuran'];
                                 $total = $pecah['harga_barang'] * $qty;
                                 // $subtotal = 0;
                                 if (!isset($_POST['proses'])) {
                                    $subtotal = $total + intval($subtotal);
                                 }
                              ?>
                                 <tr>
                                    <td align='center'><?php echo  $nomor++;; ?> </td>
                                    <!-- <td style='width: 10%' align='center'> <?php echo $kode; ?></td> -->
                                    <td> <?php echo $nama; ?> <?php echo $ukuran; ?> <?php echo $kode; ?></td>
                                    <td style='width: 12%'>Rp. <?php echo number_format($harga, 0, ".", "."); ?></td>
                                    <td style="width: 5%"><?php echo $satuan; ?></td>
                                    <td style='width: 5%'><?php echo $qty; ?>
                                    </td>
                                    <td style='width: 15%'>Rp. <?php echo number_format($total, 0, ".", "."); ?> </td>
                                    <td style='width: 10%''>
                                 <a href=' index.php?page=hapustransaksi&id=<?php echo $barang_id; ?> ' onclick=' return confirm("yakin akan hapus barang?")' class='btn btn-danger btn-xs'><i class='fas fa-trash'></i> Hapus</a>
                                    </td>
                                 </tr>
                              <?php endforeach ?>
                              <input type="hidden" id="subtotal" name="subtotal" class="subtotal" value="<?php echo $subtotal; ?>
                           ">
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-3">
               <div class="card card-secondary card-outline">
                  <div class="card-body">
                     <table width="100%">
                        <tr>
                           <td style="vertical-align: top" width="30%">
                              <label for="">Discount</label>
                           </td>
                           <td>
                              <div class="form-group">
                                 <input type="number" id="diskon" onkeyup="cok();" value="0" class="form-control diskon" name="diskon">
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td style="vertical-align: top" width="40%">
                              <label for="">SubTotal</label>
                           </td>
                           <td>
                              <div class="form-group">
                                 <input type="text" readonly name="subtotal" class="form-control" value="Rp. <?php if (empty($subtotal)) {
                                                                                                                  echo "0";
                                                                                                               } else {
                                                                                                                  echo number_format($subtotal, 0, ".", ".");
                                                                                                               } ?>">
                              </div>
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="card card-info card-outline">
                  <div class="card-body">
                     <table width="100%">
                        <tr>
                           <td style="vertical-align: top" width="30%">
                              <label for="">Bayar</label>
                           </td>
                           <td>
                              <div class="form-group">
                                 <input type="number" id="bayar" value="0" onkeyup="cok();" class="form-control bayar" name="bayar" required>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td style="vertical-align: top" width="40%">
                              <label for="">Kembalian</label>
                           </td>
                           <td>
                              <div class="form-group">
                                 <input type="text" readonly class="form-control kembalian" onkeyup="cok();" id="kembalian" name="kembalian" value="Rp.0">
                              </div>
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="form-group">
                  <button name="proses" class="btn btn-success btn-sm">
                     <i class="fa fa-paper-plane"></i> Process Payment
                  </button><br><br>
                  <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#print-transaksi">
                     <i class="fa fa-print"></i> Print
                  </button>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>


<div class="modal fade" id="print-transaksi">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Data Transaksi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body table-responsive-md">
            <table id="example1" class="table table-bordered ">
               <thead>
                  <tr>
                     <th style="width:5%;" align="center">No</th>
                     <!-- <th>Kode Barang</th> -->
                     <!-- <th>No Invoice</th> -->
                     <th>Tanggal</th>
                     <th>Nama </th>
                     <th style='width: 40%'>Alamat</th>
                     <th>No Telpon</th>
                     <th>Total</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $nomor = 1; ?>
                  <?php $ambil = $koneksi->query("SELECT *,transaksi.id AS transaksi_id, transaksi.subtotal AS subtotaltransaksi, transaksi_detail.subtotal AS subtotalbarang FROM transaksi JOIN transaksi_detail ON transaksi.id = transaksi_detail.id_transaksi JOIN admin ON admin.id = transaksi.id_kasir WHERE transaksi.id GROUP BY transaksi.id ORDER BY transaksi.id DESC"); ?>
                  <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                     <tr>
                        <td align='center' style='width: 5%'><?php echo $nomor++; ?> </td>
                        <!-- <td><?php echo $pecah['invoice']; ?></td> -->
                        <td><?php echo $pecah['tanggal_transaksi']; ?></td>
                        <td style='width: 12%'><?php echo $pecah['nama']; ?></td>
                        <td><?php echo $pecah['alamat']; ?></td>
                        <td style='width: 12%'><?php echo $pecah['no_pelanggan']; ?></td>
                        <td style='width: 12%'>Rp. <?php echo number_format($pecah['grandtotal'], 0, ".", "."); ?></td>
                        <td align="center" style='width: 16%'>
                           <a href="" id="<?php echo $pecah['transaksi_id']; ?>" data-toggle='modal' data-target='#detail-transaksi' class='transdet btn btn-secondary btn-sm'>
                              <i class='fas fa-eye'></i> Detail</a>
                           <a href='faktur.php?id=<?php echo $pecah['transaksi_id']; ?>' target="_blank" class='btn btn-primary btn-sm'><i class='fas fa-print'></i> Print</a>
                        </td>
                     </tr>
                  <?php }; ?>
               </tbody>
            </table>

         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="detail-transaksi">
   <div class="modal-dialog modal-lg">
      <div class="modal-content bg-primary">
         <div class="modal-header">
            <h4 class="modal-title">Detail Transaksi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" id="data-barang">

         </div>
      </div>
   </div>
</div>


<script>
   <?php echo $jsArray; ?>

   function changeValue(id) {
      document.getElementById("harga_barang").value = ambil_harga[id].harga_barang;
      document.getElementById("stok_barang").value = ambil_harga[id].stok_barang;
      $(".id_barang").val(ambil_harga[id].id);
   };
</script>

<script>
   var idr = {
      minimumFractionDigits: 0,
      maximumFractionDigits: 0
   }

   var subtotal = ~~parseInt(document.getElementById("subtotal").value);
   document.getElementById('subtotal2').value = "Rp. " + subtotal.toLocaleString("id-ID", idr);

   function cok() {
      var diskon = ~~parseInt(document.getElementById("diskon").value);
      var subtotal = ~~parseInt(document.getElementById("subtotal").value);
      var bayar = ~~parseInt(document.getElementById("bayar").value);
      var hasildiskon = subtotal * diskon / 100;
      var hasil = subtotal - hasildiskon;
      var kembalian = bayar - hasil;

      var rupiah = {
         minimumFractionDigits: 0,
         maximumFractionDigits: 0
      }
      document.getElementById('subtotal2').value = "Rp. " + hasil.toLocaleString("id-ID", rupiah);
      document.getElementById('hasildiskon').value = "Rp. " + hasildiskon.toLocaleString("id-ID", rupiah);
      document.getElementById('kembalian').value = "Rp. " + kembalian.toLocaleString("id-ID", rupiah);
   };
</script>