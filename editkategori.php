<?php
$ambil = $koneksi->query("SELECT * FROM kategori WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>


<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-sm-6">
         <h1 class="m-0 text-dark">Edit Kategori</h1>
      </div>
      <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">produk</li>
            <li class="breadcrumb-item">kategori</li>
            <li class="breadcrumb-item active">Edit Kategori</li>
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
                  <h3 class="card-title">Ubah Kategori</h3>
                  <div class="card-tools">
                     <a href="index.php?page=kategoriproduk" class="btn btn-warning btn-sm float-right"><i class="fa fa-undo"></i> kembali</a>
                  </div>
               </div>

               <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label>Barang</label>
                        <input type="text" name="barang" value="<?php echo $pecah['barang']; ?>" class="form-control">
                     </div>
                     <button name="update" class="btn btn-primary btn-sm "><i class="fa fa-save"></i> Simpan</button>

                  </form>
                  <?php
                  if (isset($_POST['update'])) {
                     $koneksi->query("UPDATE kategori SET barang='$_POST[barang]' WHERE id='$_GET[id]'");
                     echo "<script>alert('Data kategori telah diubah')</script>";
                     echo "<script>location='index.php?page=kategoriproduk';</script>";
                  }
                  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>