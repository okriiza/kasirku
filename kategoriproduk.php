<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-sm-6">
         <h1 class="m-0 text-dark">Kategori Barang</h1>
      </div>
      <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item ">Produk</li>
            <li class="breadcrumb-item active">Kategori</li>
         </ol>
      </div>
   </div>
</div>

<div class="content">
   <div class="container-fluid">
      <div class="row ">
         <div class="col-lg">
            <div class="card card-primary card-outline">
               <div class="card-header">
                  <h5 class="card-title">Data Kategori Barang</h5>
                  <a href="index.php?page=tambahkategori" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Tambah Kategori</a>
               </div>
               <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th style="width:5%;">No</th>
                           <th>Barang</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $nomor = 1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM kategori"); ?>
                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                           <tr>
                              <td align="center"><?php echo $nomor++; ?></td>
                              <td><?php echo $pecah['barang']; ?></td>
                              <td style="width: 15%">
                                 <a href="index.php?page=editkategori&id=<?php echo $pecah['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit "></i> Edit</a>
                                 <a href="index.php?page=hapuskategori&id=<?php echo $pecah['id']; ?>" onclick="return confirm('yakin akan hapus kategori?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                              </td>
                           </tr>
                        <?php }; ?>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>