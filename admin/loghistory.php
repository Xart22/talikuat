<?php
session_start();
include "../src/talikuat.php";
include "../fungsi/view/tampil.php";
include "tgl_indo.php";
include('../konfigurasi/koneksi.php');
include "../src/LogHistory.php";
include('cekadmin.php');

if (!isset($_SESSION['nama'])) {
    echo '<script language="javascript">alert("Anda harus Login!"); document.location="../index.php";</script>';
}

$id_logged = $_SESSION['id_logged'];

$talikuat = new talikuat();
$tampil = new tampil();
$hasil2 = $tampil->kontraktor_row();
$hasil3 = $tampil->konsultan_row();
$hasil4 = $tampil->ppk_row();
$hasil5 = $tampil->data_umum_admin();

$log = new LogHistory();
$menu = "Catatan Log";
$log_write = $log->recordLog($menu);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TaliKuatBimaJabar | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!--<link rel="stylesheet" href="../css/ionicons.min.css">-->
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <!--  
      <li class="nav-item d-none d-sm-inline-block">
        <a href="admin/index.php" class="nav-link">Home </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
	-->
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <!--
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
	-->
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <!--
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
		 -->
                <!-- Message Start -->
                <!--
		<div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
		-->
                <!-- Message End -->
                <!--
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
		-->
                <!-- Message Start -->
                <!--	
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
		-->
                <!-- Message End -->
                <!--	
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
		-->
                <!-- Message Start -->
                <!--	
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
		-->
                <!-- Message End -->
                <!--	
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
	  -->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <!--
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
	  -->
                </li>
                <li class="nav-item">
                    <!--
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      -->
                    <a class="nav-link" data-slide="true" href="../logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once('navbar-menu.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Catatan Log</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Catatan Log</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Catatan Data Log </h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 col-lg-12">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#menu1">Semua Log</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu2">Log Admin</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- All User Log -->
                                    <div class="tab-pane container active" id="menu1">
                                        <div class="table-responsive mt-3">
                                            <h2 class="text-center">Catatan Semua Log</h2>
                                            <!-- <a href="#" target="_blank" class="btn btn-danger mt-2 mb-3">
                                                <i class="fa fa-file-pdf"></i> &nbsp; Report All Log
                                            </a> -->

                                            <table class="table table-striped table-bordered" id="example2">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Unit</th>
                                                        <th>Role</th>
                                                        <th>IP User</th>
                                                        <th>Riwayat Log</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($konek, "SELECT login.user, history_log.ip_user, history_log.login_time, history_log.id_login AS idlog, login.level AS role FROM `history_log` INNER JOIN login ON login.id_login = history_log.id_login INNER JOIN member ON member.id_member = login.id_member WHERE login.id_login != 1");
                                                    $no = 1;
                                                    while ($data = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr style="background:#DFF0D8;color:#333;">
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $data['user']; ?></td>
                                                            <td><?= $data['role']; ?></td>
                                                            <td><?= $data['ip_user']; ?></td>
                                                            <td><?= $data['login_time']; ?></td>
                                                            <td>
                                                                <a href="#" class="btn btn-info btn-md" data-toggle="modal" data-target="#detailAll<?= $data['idlog']; ?>">Detail</a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Admin Log -->
                                    <div class="tab-pane container fade" id="menu2">
                                        <div class="table-responsive mt-3">
                                            <h2 class="text-center">Catatan Log Admin</h2>
                                            <!-- <a href="#" target="_blank" class="btn btn-danger mt-2 mb-3">
                                                <i class="fa fa-file-pdf"></i> &nbsp; Report Admin Log
                                            </a> -->

                                            <table class="table table-bordered table-striped" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>User</th>
                                                        <th>Role</th>
                                                        <th>IP User</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($konek, "SELECT DISTINCT(history_log.id_login), history_log.ip_user, member.*, member.level AS role FROM `history_log` INNER JOIN login ON login.id_login = history_log.id_login INNER JOIN member ON member.id_member = login.id_member WHERE login.id_member = 1");
                                                    $no = 1;
                                                    while ($data = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr style="background:#DFF0D8;color:#333;">
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $data['nama_lengkap']; ?></td>
                                                            <td><?= $data['role']; ?></td>
                                                            <td><?= $data['ip_user']; ?></td>
                                                            <td>
                                                                <a href="#" class="btn btn-info btn-md" data-toggle="modal" data-target="#detailad<?= $data['id_login']; ?>">Detail</a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->

            <!-- Modal Detail Admin -->
                <?php
                    $sql = mysqli_query($konek, "SELECT *, member.level AS role FROM `history_log` INNER JOIN login ON login.id_login = history_log.id_login INNER JOIN member ON member.id_member = login.id_member WHERE member.id_member = 1 AND history_log.login_time = DATE(NOW())");
                    while ($isi = mysqli_fetch_array($sql)) {
                        $id = $isi['id_login'];
                ?>
                    <div class="modal fade" id="detailad<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="detailAllLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailAllLongTitle">Detail Log Administrator</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12 justify-content-center">
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item"><img src="../assets/img/user/<?= $isi['gambar']; ?>" alt="Profil Gambar" height="150px" width="150px" class="img-thumbnail rounded mx-auto d-block"></li>
                                            <li class="list-group-item">Nama Member &nbsp;&nbsp;&nbsp;&nbsp;: <?= $isi['nm_member']; ?></li>
                                            <!-- <li class="list-group-item">Nama Lengkap &nbsp;&nbsp;&nbsp;: <?= $isi['nama_lengkap']; ?></li> -->
                                            <li class="list-group-item">Akses & Jabatan &nbsp;: <?= $isi['akses']; ?></li>
                                            <!-- <li class="list-group-item">NIK : <?= $isi['nik']; ?></li> -->
                                            <li class="list-group-item">Unit : <?= $isi['unit']; ?></li>
                                        </ul>
                                        <h2 class="text-center mt-4 mb-4">Aktivitas log & Riwayat Login</h2>
                                        <span><b>Tanggal Riwayat</b> : <?= tgl_indo($isi['login_time']); ?> </span>
                                        <h5>Aktivitas : </h5>
                                        <div class="table-responsive mb-4">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Keterangan</th>
                                                        <th>Jam Akses</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $sql = mysqli_query($konek, "SELECT DISTINCT(proses_log.keterangan_proses), proses_log.jam_proses FROM proses_log INNER JOIN history_log ON proses_log.id_login_user = history_log.id_login WHERE proses_log.id_login_user = '$id_logged' AND history_log.login_time = DATE(NOW())");
                                                    while ($akv = mysqli_fetch_array($sql)) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $akv['keterangan_proses']; ?></td>
                                                            <td><?= $akv['jam_proses']; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <h5>Log Riwayat : <?= tgl_indo($isi['login_time']); ?></h5>
                                        <div class="table-responsive mb-4">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Catatan Menu</th>
                                                        <th>Jam Akses</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $qry = mysqli_query($konek, "SELECT DISTINCT(menu_log.catatan_menu), menu_log.jam FROM menu_log INNER JOIN history_log ON menu_log.id_login_user = history_log.id_login WHERE menu_log.id_login_user = '$id_logged' AND history_log.login_time = DATE(NOW())");
                                                    while ($daft = mysqli_fetch_array($qry)) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $daft['catatan_menu']; ?></td>
                                                            <td><?= $daft['jam']; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- <p>Jumlah Aktivitas Admin : <b><?= $no; ?></b></p> -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <!-- End Modal Detail Admin -->
                                    
            <!-- Modal Detail Semua -->
                <?php 
                    $sql = mysqli_query($konek, "SELECT *, login.user, login.level AS lvl, member.level AS role FROM `history_log` INNER JOIN login ON login.id_login = history_log.id_login INNER JOIN member ON member.id_member = login.id_member WHERE member.id_member != 1 AND history_log.login_time = DATE(NOW())");
                    while($dt = mysqli_fetch_array($sql)) {
                ?>
                    <div class="modal fade" id="detailAll<?= $dt['id_login']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailAllLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailAllLabel">Detail Log <?= $dt['lvl']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12 justify-content-center">
                                        <?php 
                                            $sql2 = mysqli_query($konek, "SELECT *, login.user, login.level AS lvl, member.level AS role FROM `history_log` INNER JOIN login ON login.id_login = history_log.id_login INNER JOIN member ON member.id_member = login.id_member WHERE member.id_member != 1 AND login.id_login = ".$dt['id_login']." AND history_log.login_time = DATE(NOW())");
                                            while($src = mysqli_fetch_array($sql2)) {
                                        ?>
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item"><img src="../assets/img/user/<?= $src['gambar']; ?>" alt="Profil Gambar" height="150px" width="150px" class="img-thumbnail rounded mx-auto d-block"></li>
                                            <li class="list-group-item">Nama Member &nbsp;&nbsp;&nbsp;&nbsp;: <?= $src['nm_member']; ?></li>
                                            <li class="list-group-item">Nama Lengkap &nbsp;&nbsp;&nbsp;: <?= $src['nama_lengkap']; ?></li>
                                            <li class="list-group-item">Akses & Jabatan &nbsp;: <?= $src['lvl']; ?></li>
                                            <li class="list-group-item">NIK : <?= $src['nik']; ?></li>
                                            <li class="list-group-item">Unit : <?= $src['unit']; ?></li>
                                        </ul>
                                        <?php } ?>

                                        <h5>Log Riwayat : <?= tgl_indo($dt['login_time']); ?></h5>
                                        <div class="table-responsive mb-4">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Catatan Menu</th>
                                                        <th>Jam Akses</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $qry = mysqli_query($konek, "SELECT DISTINCT(menu_log.catatan_menu), menu_log.jam FROM menu_log INNER JOIN history_log ON menu_log.id_login_user = history_log.id_login WHERE menu_log.id_login_user = ".$dt['id_login']." AND history_log.login_time = DATE(NOW())");
                                                    while ($daft = mysqli_fetch_array($qry)) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $daft['catatan_menu']; ?></td>
                                                            <td><?= $daft['jam']; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <!-- End Modal Detail Semua -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020 <a href="#"></a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> Beta
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable();
        });

        $(function() {
            $("#example2").DataTable();
        });
    </script>
</body>

</html>