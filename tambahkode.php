<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-sm-6">
         <h1 class="m-0 text-dark">Kode</h1>
      </div>
      <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Produk</li>
            <li class="breadcrumb-item">Kode Produk</li>

            <li class="breadcrumb-item active">Tambah Kode</li>
         </ol>
      </div>
   </div>
</div>

<div class="content">
   <div class="container-fluid ">
      <div class="row justify-content-center">
         <div class="col-md-6 ">
            <div class="card card-primary card-outline ">
               <div class="card-header">
                  <h3 class="card-title">Kategori</h3>
                  <div class="card-tools">
                     <a href="index.php?page=kodeproduk" class="btn btn-warning btn-sm float-right"><i class="fa fa-undo"></i> kembali</a>
                  </div>
               </div>
               <?php
               if (isset($_POST['simpan'])) {
                  $koneksi->query("INSERT INTO kode (kode) VALUE ('$_POST[kode_produk]')");
                  echo "<script>alert('Data Berhasil Di Simpan')</script>";
                  echo "<script>location='index.php?page=kodeproduk';</script>";
               }

               ?>

               <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label>Kode Produk</label>
                        <input type="text" name="kode_produk" class="form-control">
                     </div>
                     <button name="simpan" class="btn btn-primary btn-sm "><i class="fa fa-save"></i> Simpan</button>

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>