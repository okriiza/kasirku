<?php
error_reporting(0);
include 'koneksi.php';
if (!isset($_SESSION)) {
   session_start();
}
if (!isset($_SESSION['admin'])) {
   echo "<script>alert('Anda harus login dahulu');</script>";
   echo "<script>location='login.php';</script>";
   header('location:login.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="x-ua-compatible" content="ie=edge">

   <title>KasirKu</title>

   <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
   <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
   <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
   <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
   <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
   <link rel="stylesheet" href="assets/dist/css/select2.min.css"  />

   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini sidebar-collapse ">
   <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
         </ul>

         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a href="logout.php" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <span>Logout</span>
               </a>
            </li>
         </ul>
      </nav>

      <aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
         <?php
         if ($_SESSION['admin']['level'] == 1) {
            echo '<a href="index.php" class="brand-link">
            <img src="logo/aj.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
            <h5 class="brand-text font-weight-light">KasirKu</h5>
         </a>';
         } else {
            echo '<a href="" class="brand-link">
            <img src="logo/aj.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
            <h5 class="brand-text font-weight-light">KasirKu</h5>
         </a>';
         }
         ?>

         <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                  <img src="logo/boss.png" class="img-circle elevation-2" alt="User Image">
               </div>
               <div class="info">
                  <a href="#" class="d-block"><?php echo $_SESSION['admin']['nama_lengkap']; ?></a>
               </div>
            </div>

            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                  <?php if ($_SESSION['admin']['level'] == "1") : ?>
                     <li class="nav-item ">
                        <a href="index.php" class="nav-link">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                              Dashboard </p>
                        </a>
                     </li>
                     <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link ">
                           <i class="nav-icon fas fa-boxes"></i>
                           <p>
                              Produk
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="index.php?page=kategoriproduk" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Kategori</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="index.php?page=ukuranproduk" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Ukuran/No</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="index.php?page=kodeproduk" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Kode Produk </p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="index.php?page=barang" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Barang</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link ">
                           <i class="nav-icon fas fa-shopping-cart"></i>
                           <p>
                              Penjualan
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="index.php?page=transaksi" class="nav-link">
                                 <i class="nav-icon far fa-circle"></i>
                                 <p>
                                    Transaksi
                                 </p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="index.php?page=transaksidetail" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Transaksi Detail</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link ">
                           <i class="nav-icon fas fa-file"></i>
                           <p>
                              Laporan
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="index.php?page=laporantransaksi" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Laporan Transaksi</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="index.php?page=laporanbarang" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Laporan Barang Keluar</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-header">Setting</li>
                     <li class="nav-item">
                        <a href="index.php?page=user" class="nav-link">
                           <i class="nav-icon fas fa-user"></i>
                           <p>
                              User
                           </p>
                        </a>
                     </li>
                     <!-- <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                           <i class="nav-icon fas fa-sign-out-alt"></i>
                           <p>
                              Logout
                           </p>
                        </a>
                     </li> -->
                  <?php else : ?>
                     <li class="nav-item">
                        <a href="index.php?page=transaksi" class="nav-link">
                           <i class="nav-icon fas fa-shopping-cart"></i>
                           <p>
                              Transaksi
                           </p>
                        </a>
                     </li>
               </ul>
            <?php endif ?>
            </nav>
         </div>
      </aside>

      <div class="content-wrapper">
         <div class="content-header">
            <?php
            if (isset($_GET['page'])) {
               if ($_GET['page'] == "barang") {
                  include 'barang.php';
               } elseif ($_GET['page'] == "tambahbarang") {
                  include 'tambahbarang.php';
               } elseif ($_GET['page'] == "editbarang") {
                  include 'editbarang.php';
               } elseif ($_GET['page'] == "hapusbarang") {
                  include 'hapusbarang.php';
               } elseif ($_GET['page'] == "transaksi") {
                  include 'transaksi.php';
               } elseif ($_GET['page'] == "laporantransaksi") {
                  include 'laporantransaksi.php';
               } elseif ($_GET['page'] == "laporanbarang") {
                  include 'laporanbarang.php';
               } elseif ($_GET['page'] == "hapustransaksi") {
                  include 'hapustransaksi.php';
               } elseif ($_GET['page'] == "kategoriproduk") {
                  include 'kategoriproduk.php';
               } elseif ($_GET['page'] == "hapuskategori") {
                  include 'hapuskategori.php';
               } elseif ($_GET['page'] == "editkategori") {
                  include 'editkategori.php';
               } elseif ($_GET['page'] == "tambahkategori") {
                  include 'tambahkategori.php';
               } elseif ($_GET['page'] == "tambahkode") {
                  include 'tambahkode.php';
               } elseif ($_GET['page'] == "hapuskode") {
                  include 'hapuskode.php';
               } elseif ($_GET['page'] == "editkode") {
                  include 'editkode.php';
               } elseif ($_GET['page'] == "kodeproduk") {
                  include 'kodeproduk.php';
               } elseif ($_GET['page'] == "ukuranproduk") {
                  include 'ukuranproduk.php';
               } elseif ($_GET['page'] == "hapusukuran") {
                  include 'hapusukuran.php';
               } elseif ($_GET['page'] == "editukuran") {
                  include 'editukuran.php';
               } elseif ($_GET['page'] == "tambahukuran") {
                  include 'tambahukuran.php';
               } elseif ($_GET['page'] == "tambahsatuan") {
                  include 'tambahsatuan.php';
               } elseif ($_GET['page'] == "editsatuan") {
                  include 'editsatuan.php';
               } elseif ($_GET['page'] == "hapussatuan") {
                  include 'hapussatuan.php';
               } elseif ($_GET['page'] == "satuanproduk") {
                  include 'satuanproduk.php';
               } elseif ($_GET['page'] == "detail_transaksi") {
                  include 'detail_transaksi.php';
               } elseif ($_GET['page'] == "user") {
                  include 'user.php';
               } elseif ($_GET['page'] == "tambahuser") {
                  include 'tambahuser.php';
               } elseif ($_GET['page'] == "edituser") {
                  include 'edituser.php';
               } elseif ($_GET['page'] == "hapususer") {
                  include 'hapususer.php';
               } elseif ($_GET['page'] == "transaksidetail") {
                  include 'transaksidetail.php';
               } elseif ($_GET['page'] == "hapustransaksidetail") {
                  include 'hapustransaksidetail.php';
               }
            } else {
               include 'home.php';
            }
            ?>
         </div>
      </div>


      <footer class="main-footer text-sm">
         <div class="float-right  d-sm-inline">
            <strong>Developed By <a href="https://okriiza.com">Rendi Okriza Putra</a> </strong>v1.0
         </div>
         <strong>Copyright &copy; 2020 </strong> All rights reserved.
      </footer>
   </div>


   <script src="assets/plugins/jquery/jquery.min.js"></script>
   <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
   <script src="js/chosen.jquery.js"></script>
   <script src="assets/dist/js/adminlte.min.js"></script>
   <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
   <script src="assets/plugins/toastr/toastr.min.js"></script>
   <script src="assets/plugins/datatables/jquery.dataTables.js"></script>
   <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
   <script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
   <script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
   <script src="assets/plugins/jszip/jszip.min.js"></script>
   <script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
   <script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
   <script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
   <script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
   <script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
   <script src="assets/plugins/jquery/select2.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function() {
         $('#barang').select2({
            placeholder: 'Pilih Barang',
            allowClear: true
         });
      });
   </script>
   <script>
      // ini menyiapkan dokumen agar siap grak :)
      $(document).ready(function() {
         // yang bawah ini bekerja jika tombol lihat data (class="view_data") di klik
         $('.transdet').click(function() {
            // membuat variabel id, nilainya dari attribut id pada button
            // id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
            var id = $(this).attr("id");

            // memulai ajax
            $.ajax({
               url: 'detail_transaksi.php', // set url -> ini file yang menyimpan query tampil detail data siswa
               method: 'post', // method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
               data: {
                  id: id
               }, // nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
               success: function(data) { // kode dibawah ini jalan kalau sukses
                  $('#data-barang').html(data); // mengisi konten dari -> <div class="modal-body" id="data_siswa">
                  $('#detail-transaksi').modal("show"); // menampilkan dialog modal nya
               }
            });
         });
      });
   </script>
   <script>
      $(document).ready(function() {
         var table = $('#example').DataTable({
            buttons: [{
               extend: "print",
               className: "btn btn-primary",
               title: "Laporan Transaksi",
               footer: true,
               init: function(api, node, config) {
                  $(node).removeClass('btn-secondary')
               }
            }, ],
            dom: "<'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>>" +
               "<'row'<'col-md-12'tr>>" +
               "<'row'<'col-md-3'i><'col-md-5'p>>",
            lengthMenu: [
               [5, 10, 25, 50, 100, -1],
               [5, 10, 25, 50, 100, "All"]
            ],
         });
         table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

         var table2 = $('#example2').DataTable({
            buttons: [{
               extend: "print",
               className: "btn btn-primary",
               title: "Laporan Barang Keluar",
               footer: true,
               init: function(api, node, config) {
                  $(node).removeClass('btn-secondary')
               }
            }, ],
            dom: "<'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>>" +
               "<'row'<'col-md-12'tr>>" +
               "<'row'<'col-md-3'i><'col-md-5'p>>",
            lengthMenu: [
               [5, 10, 25, 50, 100, -1],
               [5, 10, 25, 50, 100, "All"]
            ],
         });

         table2.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
         $('#example1').DataTable({
            "lengthMenu": [
               [5, 10, 25, 50, 100, -1],
               [5, 10, 25, 50, 100, "All"]
            ],
         });
      });
   </script>
   <script type="text/javascript">
      var url = window.location;
      const allLinks = document.querySelectorAll('.nav-item a');
      const currentLink = [...allLinks].filter(e => {
         return e.href == url;
      });

      currentLink[0].classList.add("active");
      currentLink[0].closest(".nav-treeview");
      currentLink[0].closest(".has-treeview");
      $('.menu-open').find('a').each(function() {
         if (!$(this).parents().hasClass('active')) {
            $(this).parents().addClass("active");
            $(this).addClass("active");
         }
      });
   </script>

</body>

</html>