<?php
$ambil = $koneksi->query("SELECT * FROM barang WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>


<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-sm-6">
         <h1 class="m-0 text-dark">Barang</h1>
      </div>
      <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Produk</li>
            <li class="breadcrumb-item">barang</li>
            <li class="breadcrumb-item active">Update Barang</li>
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
                  <h3 class="card-title">Barang</h3>
                  <div class="card-tools">
                     <a href="index.php?page=barang" class="btn btn-warning btn-sm float-right"><i class="fa fa-undo"></i> kembali</a>
                  </div>
               </div>

               <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama_barang" class="form-control" value="<?php echo $pecah['nama_barang']; ?>">
                     </div>
                     <div class="form-group">
                        <label>Ukuran</label>
                        <input type="text" name="ukuran" class="form-control" value="<?php echo $pecah['ukuran']; ?>">
                     </div>
                     <div class="form-group">
                        <label>Kode</label>
                        <input type="text" name="kode" class="form-control" value="<?php echo $pecah['kode']; ?>">
                     </div>
                     <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" name="satuan" class="form-control" value="<?php echo $pecah['satuan']; ?>">
                     </div>
                     <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga_barang" class="form-control" value="<?php echo $pecah['harga_barang']; ?>">
                     </div>
                     <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok_barang" class="form-control" value="<?php echo $pecah['stok_barang']; ?>">
                     </div>

                     <button name="update" class="btn btn-primary btn-sm "><i class="fa fa-save"></i> Update</button>

                  </form>

                  <?php
                  if (isset($_POST['update'])) {
                     $koneksi->query("UPDATE barang SET nama_barang='$_POST[nama_barang]',ukuran='$_POST[ukuran]',kode='$_POST[kode]',satuan='$_POST[satuan]',harga_barang='$_POST[harga_barang]', stok_barang='$_POST[stok_barang]' WHERE id='$_GET[id]'");
                     echo "<script>alert('Data Barang telah diubah')</script>";
                     echo "<script>location='index.php?page=barang';</script>";
                  }
                  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>