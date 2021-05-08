<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-sm-6">
         <h1 class="m-0 text-dark">Transaksi Detail</h1>
      </div>
      <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item active">Transaksi Detail</li>
         </ol>
      </div>
   </div>
</div>
</div>

<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg">
            <div class="card card-success card-outline">
               <div class="card-header">
                  <h5 class="card-title">Detail</h5>
               </div>
               <div class="card-body">
                  <table id="example1" class="table table-bordered ">
                     <thead>
                        <tr>
                           <th style="width:5%;" align="center">No</th>
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
                              <td align='center'><?php echo $nomor++; ?> </td>
                              <!-- <td><?php echo $pecah['invoice']; ?></td> -->
                              <td><?php echo $pecah['tanggal_transaksi']; ?></td>
                              <td style='width: 12%'><?php echo $pecah['nama']; ?></td>
                              <td><?php echo $pecah['alamat']; ?></td>
                              <td style='width: 12%'><?php echo $pecah['no_pelanggan']; ?></td>
                              <td style='width: 12%'>Rp. <?php echo number_format($pecah['grandtotal'], 0, ".", "."); ?></td>
                              <td align="center" style='width: 15%'>
                                 <a href="" id="<?php echo $pecah['transaksi_id']; ?>" data-toggle='modal' data-target='#detail-transaksi' class='transdet btn btn-secondary btn-xs'>
                                    <i class='fas fa-eye'></i> Detail</a>
                                 <a href='faktur.php?id=<?php echo  $pecah['transaksi_id']; ?>' target="_blank" class='btn btn-primary btn-xs'><i class='fas fa-print'></i> Print</a>
                                 <a href='index.php?page=hapustransaksidetail&id=<?php echo  $pecah['transaksi_id']; ?>' target="_blank" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i> Hapus</a>
                              </td>
                           </tr>
                        <?php }; ?>
                     </tbody>
                  </table>
               </div>
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