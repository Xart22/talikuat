<?php
session_start();
include "../src/talikuat.php";
include "../fungsi/view/tampil.php";
include "tgl_indo.php";
include('../konfigurasi/koneksi.php');
include('cekadmin.php');

if (!isset($_SESSION['nama'])) {
    echo '<script language="javascript">alert("Anda harus Login!"); document.location="../index.php";</script>';
}

$talikuat = new talikuat();

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
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../assets/img/jabar.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">TaliKuat BimaJabar</span>

            </a>
            <!-- Sidebar -->

            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php
                        $hasil = $talikuat->get_member();

                        foreach ($hasil as $isi) {
                        ?>
                            <img src="../assets/img/user/<?php echo $isi['gambar']; ?>" class="img-circle elevation-2" alt="User Image">
                        <?php } ?>
                    </div>
                    <div class="info">
                        <!--<a href="#" class="d-block">(<?php echo $_SESSION['nama']; ?>)</a>-->
                        <?php
                        $hasil = $talikuat->get_member();

                        foreach ($hasil as $isi) {
                        ?>
                            <a href="#" class="d-block"><?php echo $isi['nama_lengkap']; ?></a>
                        <?php } ?>
                    </div>

                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Halaman Utama
                                    <!--<i class="right fas fa-angle-left"></i>-->
                                </p>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="data_absensi.php" class="nav-link active">
                                <i class="nav-icon 	fa fa-address-card"></i>
                                <p>
                                    Absensi Konsultan
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Data Utama
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="master_kontraktor.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kontraktor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="master_konsultan.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Konsultan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="master_ppk.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>PPK</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="master_jenis_pekerjaan.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jenis Pekerjaan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="master_pengguna.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Pengguna Aplikasi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Input Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="data_umum.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Umum</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="jadual.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jadual Pekerjaan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="permintaan.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Permintaan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="laporan_harian.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>laporan Harian</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-download"></i>
                                <p>
                                    Pusat Unduhan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="data_kontrak.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Kontrak</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-download"></i>
                                <p>
                                    Cetak laporan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="data_progress.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Progress</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <a href="laporan_pekerjaan.php" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Laporan Pekerjaan
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Pengaturan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="edit_user.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pengguna</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Absensi Konsultan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Absensi Konsultan</li>
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
                            <h3 class="card-title">Data Absensi Konsultan </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">

                            <?php if (isset($_GET['sukses'])) { ?>
                                <div class="toastrDefaultSuccess">
                                </div>
                            <?php } ?>

                            <?php if (isset($_GET['gagal'])) { ?>
                                <div class="toastrDefaultError">
                                </div>
                            <?php } ?>

                            <?php if (isset($_GET['besar'])) { ?>
                                <div class="toastrDefaultWarning">
                                </div>
                            <?php } ?>

                            <?php if (isset($_GET['nama'])) { ?>
                                <div class="toastrDefaultInfo">
                                </div>
                            <?php } ?>

                            <div class="col-lg-12 main-chart">

                                <table>
                                    <tr>
                                        <td>
                                            <a href="print_absensi.php" target="_blank" id="tombol-pdf" class="btn btn-danger">
                                                <i class="fa fa-file-pdf"></i> &nbsp; View PDF
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                                <br />


                                <table class="table table-bordered table-striped text-center" id="example1">
                                    <thead>
                                        <tr style="background:#DFF0D8;color:#333;">
                                            <th width="5%">No.</th>
                                            <th>NIK</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Nama PPK</th>
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $absen = $talikuat->get_absen();

                                        $no = 1;
                                        foreach ($absen as $isi) {
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $isi['nik']; ?></td>
                                                <td><?= $isi['nama']; ?></td>
                                                <td><?= $isi['nama_ppk']; ?></td>
                                                <td>
                                                    <a target="_blank" href="detail_absensi.php?nik=<?= $isi['nik'] ?>" class="btn btn-sm btn-info"><i class="fa fa-list-alt"></i> Detail</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->



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
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.js"></script>
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <script src="../plugins/chart.js/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>

</body>

</html>