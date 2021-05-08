<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-sm-6">
         <h1 class="m-0 text-dark">Daftar Barang</h1>
      </div>
      <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Produk</li>
            <li class="breadcrumb-item active">Barang</li>
         </ol>
      </div>
   </div>
</div>


<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg">
            <div class="card card-success card-outline">
               <div class="card-header">
                  <h5 class="card-title">Barang</h5>
                  <a href="index.php?page=tambahbarang" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Tambah Barang</a>
               </div>
               <div class="card-body table-responsive-md">
                  <table id="example1" class="table table-bordered">
                     <thead>
                        <tr>
                           <th style="width:5%;">No</th>
                           <th>Nama Barang</th>
                           <th>Ukuran</th>
                           <th>Kode</th>
                           <th>Satuan</th>
                           <th>Harga</th>
                           <th>Stok</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $nomor = 1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM barang"); ?>
                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                           <tr>
                              <td align="center"><?php echo $nomor++; ?></td>
                              <td><?php echo $pecah['nama_barang']; ?></td>
                              <td><?php echo $pecah['ukuran']; ?></td>
                              <td><?php echo $pecah['kode']; ?></td>
                              <td><?php echo $pecah['satuan']; ?></td>
                              <td>Rp. <?php echo number_format($pecah['harga_barang'], 0, ".", '.'); ?></td>
                              <td><?php echo $pecah['stok_barang']; ?></td>
                              <td style="width: 16%">
                                 <a href="index.php?page=editbarang&id=<?php echo $pecah['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit "></i> Edit</a>
                                 <a href="index.php?page=hapusbarang&id=<?php echo $pecah['id']; ?>" onclick="return confirm('yakin akan hapus barang?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                              </td>
                           </tr>
                        <?php }; ?>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>