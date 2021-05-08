<?php
$ambil = $koneksi->query("SELECT * FROM admin WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>


<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-sm-6">
         <h1 class="m-0 text-dark">User</h1>
      </div>
      <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Tambah User</li>
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
                  <h3 class="card-title">User</h3>
                  <div class="card-tools">
                     <a href="index.php?page=user" class="btn btn-warning btn-sm float-right"><i class="fa fa-undo"></i> kembali</a>
                  </div>
               </div>


               <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $pecah['nama_lengkap']; ?>">
                     </div>
                     <div class="form-group">
                        <label>No Telpon</label>
                        <input type="number" name="notlp" class="form-control" value="<?php echo $pecah['notlp']; ?>">
                     </div>
                     <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $pecah['username']; ?>">
                     </div>
                     <div class="form-group">
                        <label>Level</label>
                        <?php $level = $pecah['level']; ?>
                        <select name="level" id="" class="form-control">
                           <option value="">Pilih Level</option>
                           <option <?php if ($level == '1') {
                                       echo "selected";
                                    }; ?> value="1">Admin</option>
                           <option <?php if ($level == '2') {
                                       echo "selected";
                                    }; ?> value="2">Kasir</option>
                        </select>
                     </div>
                     <button type="button" id="<?php echo $pecah['id'] ?>" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-sm"><i class="fa fa-key"></i>
                        Ubah Password
                        </button>
                     <button name="update" class="btn btn-primary btn-sm "><i class="fa fa-save"></i> Simpan</button>
                  </form>

                  <div class="modal fade" id="modal-sm">
                     <div class="modal-dialog modal-sm">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h4 class="modal-title">Ubah Password</h4>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="" method="post" enctype="multipart/form-data">
                                       <div class="form-group">
                                          <label>Password Lama</label>
                                          <input type="password" name="passwordlama" class="form-control" value="">
                                       </div>
                                       <div class="form-group">
                                          <label>Password Baru</label>
                                          <input type="password" name="passwordbaru1" class="form-control" value="">
                                       </div>
                                       <div class="form-group">
                                          <label>Konfirmasi Password Baru</label>
                                          <input type="password" name="passwordbaru2" class="form-control" value="">
                                       </div>
                                       <button name="passchange" class="btn btn-primary btn-sm">Save changes</button>
                                 </form>
                                 <?php
                                 if (isset($_POST['passchange'])) {
                                       $passwordlama = $_POST['passwordlama'];
                                       $passwordbaru1 = $_POST['passwordbaru1'];
                                       $passwordbaru2 = $_POST['passwordbaru2'];

                                       $passwordlama = md5($passwordlama);
                                       $cek = $koneksi->query("SELECT password FROM admin WHERE password ='$passwordlama' ");
                                       if ($cek->num_rows) {
                                          if (strlen($passwordbaru1 <= 25)) {
                                             if ($passwordbaru1 == $passwordbaru2) {
                                                   $passwordbaru1 = md5($passwordbaru1);
                                                   $update = $koneksi->query("UPDATE admin SET password='$passwordbaru1' WHERE id='$_GET[id]'");
                                                   if ($update) {
                                                      echo "<script>alert('Data User telah diubah')</script>";
                                                      echo "<script>location='index.php?halaman=user';</script>";
                                                   }else {
                                                      echo "<script>alert('Gagal merubah password')</script>";
                                                   }
                                             }else {
                                                   echo "<script>alert('Konfirmasi password tidak cocok')</script>";
                                             }
                                          }else {
                                             echo "<script>alert('Minimal password baru adalah 5 karakter')</script>";
                                          }
                                       }else {
                                          echo "<script>alert('Password lama tidak cocok')</script>";
                                       }
                                 }
                                 ?>
                              </div>
                              <!-- <div class="modal-footer justify-content-between">
                                 
                              </div> -->
                           </div>
                     </div>
                  </div>

                  <?php
                  if (isset($_POST['update'])) {
                     $username = $_POST['username'];

                     $koneksi->query("UPDATE admin SET nama_lengkap='$_POST[nama_lengkap]',notlp='$_POST[notlp]',username='$username',level='$_POST[level]' WHERE id='$_GET[id]'");
                     echo "<script>alert('Data User telah diubah')</script>";
                     echo "<script>location='index.php?page=user';</script>";
                  }
                  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>