<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-sm-6">
         <h1 class="m-0 text-dark">Daftar Kode Produk</h1>
      </div>
      <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item ">Produk</li>
            <li class="breadcrumb-item active">Kode Produk</li>
         </ol>
      </div>
   </div>
</div>


<div class="content">
   <div class="container-fluid">
      <div class="row ">
         <div class="col-lg">
            <div class="card card-danger card-outline">
               <div class="card-header">
                  <h5 class="card-title">Kode Produk</h5>
                  <a href="index.php?page=tambahkode" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Tambah Kode Produk</a>
               </div>
               <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th style="width:5%;">No</th>
                           <th>Kode</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $nomor = 1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM kode"); ?>
                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                           <tr>
                              <td align="center"><?php echo $nomor++; ?></td>
                              <td><?php echo $pecah['kode']; ?></td>
                              <td style="width: 15%">
                                 <a href="index.php?page=editkode&id=<?php echo $pecah['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit "></i> Edit</a>
                                 <a href="index.php?page=hapuskode&id=<?php echo $pecah['id']; ?>" onclick="return confirm('yakin akan hapus kode produk?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
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