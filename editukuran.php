<?php
$ambil = $koneksi->query("SELECT * FROM ukuran WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>


<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-sm-6">
         <h1 class="m-0 text-dark">Ukuran Produk</h1>
      </div>
      <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Produk</li>
            <li class="breadcrumb-item">Ukuran</li>
            <li class="breadcrumb-item active">Edit Ukuran Produk</li>
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
                  <h3 class="card-title">Ukuran Produk</h3>
                  <div class="card-tools">
                     <a href="index.php?page=ukuranproduk" class="btn btn-warning btn-sm float-right"><i class="fa fa-undo"></i> kembali</a>
                  </div>
               </div>

               <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label>Ukuran Produk</label>
                        <input type="text" name="ukuran" value="<?php echo $pecah['ukuran']; ?>" class="form-control">
                     </div>
                     <button name="update" class="btn btn-primary btn-sm "><i class="fa fa-save"></i> Simpan</button>

                  </form>
                  <?php
                  if (isset($_POST['update'])) {
                     $koneksi->query("UPDATE ukuran SET ukuran='$_POST[ukuran]' WHERE id='$_GET[id]'");
                     echo "<script>alert('Data Ukuran Produk telah diubah')</script>";
                     echo "<script>location='index.php?page=ukuranproduk';</script>";
                  }
                  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>