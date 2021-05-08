   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Barang</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="index.php">Home</a></li>
               <li class="breadcrumb-item">Produk</li>
               <li class="breadcrumb-item">Barang</li>
               <li class="breadcrumb-item active">Tambah Barang</li>
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
                  <?php

                  // $sql = "SELECT max(kode_barang) FROM barang";
                  // $query = $koneksi->query($sql);
                  // $kode_faktur = mysqli_fetch_array($query);

                  // if ($kode_faktur) {
                  //    $nilai = substr($kode_faktur[0], 1);
                  //    $kode = (int) $nilai;

                  //    //tambahkan sebanyak + 1
                  //    $kode = $kode + 1;
                  //    $auto_kode = "B" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
                  // } else {
                  //    $auto_kode = "B0001";
                  // }

                  if (isset($_POST['simpan'])) {
                     $koneksi->query("INSERT INTO barang (nama_barang,ukuran,kode,satuan,harga_barang,stok_barang) VALUE ('$_POST[nama_barang]','$_POST[ukuran]','$_POST[kode]','$_POST[satuan]','$_POST[harga_barang]','$_POST[stok_barang]')");
                     echo "<script>alert('Data Berhasil Di Simpan')</script>";
                     echo "<script>location='index.php?page=barang';</script>";
                  }
                  ?>

                  <div class="card-body">
                     <form action="" method="post" enctype="multipart/form-data">
                        <!-- <div class="form-group">
                           <label>Kode Barang</label>
                           <input type="text" class="form-control" name="kode_barang">
                        </div> -->
                        <div class="form-group">
                           <label>Nama</label>
                           <input type="text" name="nama_barang" list="nama_barang" class="form-control">
                           <datalist id="nama_barang">
                              <?php
                              $query = "SELECT * FROM kategori";
                              $ambil = $koneksi->query($query);
                              while ($barang = $ambil->fetch_assoc()) {
                              ?>
                                 <option value="<?php echo $barang['barang']; ?>"></option>
                              <?php }; ?>
                           </datalist>
                        </div>
                        <div class="form-group">
                           <label>Ukuran</label>
                           <input type="text" name="ukuran" list="ukuran" class="form-control">
                           <datalist id="ukuran">
                              <?php
                              $query = "SELECT * FROM ukuran";
                              $ambil = $koneksi->query($query);
                              while ($barang = $ambil->fetch_assoc()) {
                              ?>
                                 <option value="<?php echo $barang['ukuran']; ?>"></option>
                              <?php }; ?>
                           </datalist>
                        </div>
                        <div class="form-group">
                           <label>Kode</label>
                           <input type="text" name="kode" list="kode" class="form-control">
                           <datalist id="kode">
                              <?php
                              $query = "SELECT * FROM kode";
                              $ambil = $koneksi->query($query);
                              while ($barang = $ambil->fetch_assoc()) {
                              ?>
                                 <option value="<?php echo $barang['kode']; ?>"></option>
                              <?php }; ?>
                           </datalist>
                        </div>
                        <div class="form-group">
                           <label>Satuan</label>
                           <input type="text" name="satuan" class="form-control">
                        </div>
                        <div class="form-group">
                           <label>Harga</label>
                           <input type="number" name="harga_barang" class="form-control">
                        </div>
                        <div class="form-group">
                           <label>Stok</label>
                           <input type="number" name="stok_barang" class="form-control">
                        </div>
                        <button name="simpan" class="btn btn-primary btn-sm "><i class="fa fa-save"></i> Simpan</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>