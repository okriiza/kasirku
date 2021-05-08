<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title> Kasirku | Log in</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
   <div class="login-box">
      <div class="login-logo">
         <a href=""><b>KASIR</b>KU</a> <br>
      </div>
      <div class="card">
         <div class="card-body login-card-body">
            <form action="" method="post" enctype="multipart/form-data">
               <div class="form-group input-group mb-3">
                  <input type="text" class="form-control" name="username" placeholder="username">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-user"></span>
                     </div>
                  </div>
               </div>
               <div class="form-group input-group mb-3">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-8">
                  </div>
                  <div class="col-4">
                     <button type="submit" name="login" class="btn btn-primary btn-sm btn-block mb-2"><i class="fas fa-sign-in-alt"></i> Sign In</button>
                  </div>
               </div>
            </form>
            <?php
            if (isset($_POST['login'])) {
               $username = mysqli_real_escape_string($koneksi, $_POST['username']);
               $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));
               $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
               $yangcocok = $ambil->num_rows;
               if ($yangcocok == 1) {
                  $_SESSION['admin'] = $ambil->fetch_assoc();
                  if ($_SESSION['admin']['level'] == 1) {
                     echo "<div class='alert alert-info'>Login Sukses</div>";
                     echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                  } else {
                     echo "<div class='alert alert-info'>Login Sukses</div>";
                     echo "<meta http-equiv='refresh' content='1;url=index.php?page=transaksi'>";
                  }
               } else {
                  echo "<div class='alert alert-danger'>Login Gagal</div>";
                  echo "<meta http-equiv='refresh' content='1;url=login.php'>";
               }
            }

            ?>
         </div>
      </div>
   </div>

   <script src="assets/plugins/jquery/jquery.min.js"></script>
   <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="assets/dist/js/adminlte.min.js"></script>

</body>

</html>