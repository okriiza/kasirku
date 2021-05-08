<?php
$semuadata = array();
$tgl_mulai = "-";
$tgl_selesai = "-";
if (isset($_POST["kirim"])) {
   $tgl_mulai = $_POST["tglm"];
   $tgl_selesai = $_POST["tgls"];
   $ambil = $koneksi->query("SELECT * FROM transaksi_detail JOIN transaksi ON transaksi_detail.id_transaksi=transaksi.id WHERE tanggal_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai'");

   while ($pecah = $ambil->fetch_assoc()) {
      $semuadata[] = $pecah;
   }
   //     echo "<pre>";
   //     print_r($semuadata);
   //     echo "</pre>";
}
?>

<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-sm-6">
         <h1 class="m-0 text-dark">Laporan Barang Keluar</h1>
      </div>
      <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item ">Laporan</li>
            <li class="breadcrumb-item active">Laporan Barang Keluar</li>
         </ol>
      </div>
   </div>
</div>

<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-4">
            <div class="card card-primary card-outline">
               <div class="card-header">
                  <h5 class="card-title text-bold">Laporan Barang</h5>
               </div>
               <div class="card-body">
                  <form action="" method="post">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for=""> Tanggal Mulai</label>
                              <input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for=""> Tanggal Selesai</label>
                              <input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <label for="">&nbsp;</label> <br>
                           <button class="btn btn-info btn-sm" name="kirim"><i class="fas fa-eye"></i> Lihat</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-lg-8">
            <div class="card card-warning card-outline">
               <div class="card-header">
                  <h5 class="card-title text-bold">List Barang Keluar Dari <?php echo $tgl_mulai ?> Hingga <?php echo $tgl_selesai ?> </h5>
               </div>
               <div class="card-body table-responsive-md">
                  <table id="example2" class="table table-bordered " style="width: 100%">
                     <thead>
                        <tr>
                           <th style="width: 5%">No</th>
                           <th style="width: 15%">Tanggal</th>
                           <th>Nama Barang</th>
                           <th style="width: 17%">Harga</th>
                           <th>Satuan</th>
                           <th style="width: 5%">Qty</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $total = 0; ?>
                        <?php foreach ($semuadata as $key => $value) : ?>
                           <?php $total += $value['jumlah_pembelian']; ?>
                           <tr>
                              <td align="center"><?php echo $key + 1; ?></td>
                              <td><?php echo $value["tanggal_transaksi"] ?></td>
                              <td><?php echo $value["nama_barang"]; ?> <?php echo $value["ukuran"]; ?> <?php echo $value["kode"]; ?></td>
                              <td>Rp. <?php echo number_format($value["harga"], 0, ".", ".") ?></td>
                              <td><?php echo $value["satuan"] ?></td>
                              <td><?php echo $value["jumlah_pembelian"] ?></td>
                           </tr>
                        <?php endforeach ?>
                     </tbody>
                     <tfoot>
                        <tr>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th style="text-align:right">Total</th>
                           <th><?php echo number_format($total, 0, ".", "."); ?></th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>