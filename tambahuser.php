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
               <?php
               if (isset($_POST['simpan'])) {
                  $username = $_POST['username'];
                  $password =  md5($_POST['password']);
                  $koneksi->query("INSERT INTO admin (nama_lengkap,notlp,username,password,level) VALUE ('$_POST[nama_lengkap]','$_POST[notlp]','$username','$password','$_POST[level]')");
                  echo "<script>alert('Data Berhasil Di Simpan')</script>";
                  echo "<script>location='index.php?page=user';</script>";
               }
               ?>

               <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>No Telpon</label>
                        <input type="number" name="notlp" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Level</label>
                        <select name="level" id="" class="form-control">
                           <option value="0">Pilih Level</option>
                           <option value="1">Admin</option>
                           <option value="2">Kasir</option>
                        </select>
                     </div>
                     <button name="simpan" class="btn btn-primary btn-sm "><i class="fa fa-save"></i> Simpan</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>