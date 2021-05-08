<!-- <div class="content">
   <div class="container-fluid">

   </div>
</div> -->

<div class="container-fluid">
   <div class="row">
      <div class="col-md-3 col-sm-6 col-12">
         <div class="info-box bg-primary">
            <span class="info-box-icon"><i class="fas fa-signal"></i></span>
            <div class="info-box-content">
               <span class="info-box-text">Pendapatan Hari ini</span>
               <?php $tanggal_now = date('y-m-d'); ?>
               <?php $ambil = $koneksi->query("SELECT SUM(grandtotal) AS total FROM transaksi WHERE tanggal_transaksi='$tanggal_now' GROUP BY tanggal_transaksi"); ?>
               <?php $pecah = mysqli_fetch_array($ambil); ?>
               <h3 class="info-box-number">Rp. <?php echo  number_format($pecah['total'], 0, ".", "."); ?></h3>
               <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-3 col-sm-6 col-12">
         <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fas fa-signal"></i></span>
            <div class="info-box-content">
               <span class="info-box-text">Pendapatan Bulan Ini</span>
               <?php
               $bulan_now =  date('y-m-d');
               ?>
               <?php $ambil = $koneksi->query("SELECT CONCAT(YEAR(tanggal_transaksi),'/',MONTH(tanggal_transaksi)), SUM(grandtotal) AS total FROM transaksi WHERE CONCAT(YEAR(tanggal_transaksi),'/',MONTH(tanggal_transaksi)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW())) GROUP BY YEAR(tanggal_transaksi),MONTH(tanggal_transaksi)"); ?>
               <?php $pecah = mysqli_fetch_array($ambil); ?>
               <h3 class="info-box-number">Rp. <?php echo  number_format($pecah['total'], 0, ".", "."); ?></h3>
               <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-3 col-sm-6 col-12">
         <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="fas fa-signal"></i></span>
            <div class="info-box-content">
               <span class="info-box-text">Pendapatan Tahun Ini</span>
               <?php $tahun_now = date('Y-m-d'); ?>
               <?php $ambil = $koneksi->query("SELECT YEAR(tanggal_transaksi), SUM(grandtotal) AS total FROM transaksi WHERE YEAR(tanggal_transaksi)='$tahun_now' GROUP BY YEAR(tanggal_transaksi)"); ?>
               <?php $pecah = mysqli_fetch_array($ambil); ?>
               <h3 class="info-box-number">Rp. <?php echo  number_format($pecah['total'], 0, ".", "."); ?></h3>
               <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-3 col-sm-6 col-12">
         <div class="info-box bg-danger">
            <span class="info-box-icon"><i class="fas fa-box"></i></span>
            <div class="info-box-content">
               <span class="info-box-text">Jumlah Barang</span>
               <?php $ambil = $koneksi->query("SELECT COUNT(*) AS jumlah FROM barang "); ?>
               <?php while ($pecah = mysqli_fetch_array($ambil)) {; ?>
                  <h3 class="info-box-number"><?php echo $pecah['jumlah']; ?></h3>
               <?php }; ?>
               <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
               </div>
            </div>
         </div>
      </div>
   </div>


   <div class="row">
      <div class="col-md-6">
         <div class="card card-primary  card-outline">
            <div class="card-header">
               <h3 class="card-title"><b>5 Barang Terlaris Hari Ini !</b></h3>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th style="width: 10%">No</th>
                        <th>Nama</th>
                        <th style="width: 10%">Terjual</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $daynow = date("Y-m-d");
                     $nomor = 1;
                     $query = "SELECT sum(jumlah_pembelian) AS qtyy,nama_barang,ukuran,kode,tanggal_transaksi,id_barang FROM transaksi_detail JOIN transaksi ON transaksi.id=transaksi_detail.id_transaksi WHERE tanggal_transaksi='$daynow' GROUP BY id_barang ORDER BY qtyy DESC LIMIT 5";
                     $ambil = $koneksi->query($query);
                     while ($pecah = mysqli_fetch_array($ambil)) {;
                     ?>
                        <tr>
                           <td align="center"><?php echo $nomor++; ?></td>
                           <td><?php echo $pecah['nama_barang']; ?> <?php echo $pecah['ukuran']; ?> <?php echo $pecah['kode']; ?></td>
                           <td align="center"><span class="badge bg-success"><?php echo $pecah['qtyy']; ?></span></td>
                        </tr>
                     <?php }; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>