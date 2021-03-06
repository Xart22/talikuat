<?php
session_start();
include "../src/talikuat.php";
include "../src/LogHistory.php";
include('cekadmin.php');
if (!isset($_SESSION['nama'])) {
  echo '<script language="javascript">alert("Anda harus Login!"); document.location="../index.php";</script>';
}

$talikuat = new talikuat();
//$talikuat->checkLoggedIn();
include "../src/item_penyedia_jasa.php";
$controller = new ItemPenyedia();
$itemPenyedia = $controller->itemPenyedia();

include "../src/item_konsultan.php";
$controller = new ItemKonsul();
$itemKonsul = $controller->itemKonsul();

include "../src/item_ppk.php";
$controller = new ItemPpk();
$itemPpk = $controller->itemPpk();

include "../src/item_ruas_jalan.php";
$controller = new ItemRuas_jalan();
$itemRuas_jalan = $controller->itemRuas_jalan();

include "../src/item_unor.php";
$controller = new ItemUnor();
$itemUnor = $controller->itemUnor();

$log = new LogHistory();
$menu = "Buat Data Umum";
$log_write = $log->recordLog($menu);

if (!empty($_POST['nama_kegiatan']) && $_POST['nama_kegiatan']) {
  $talikuat->saveDataUmum($_POST);
}

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
  <!-- Ionicons 
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
  <link rel="stylesheet" href="../assets/ionicons/ionicons.min.css">
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
  <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->

  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- baru -->
  <script src="../js/ruas_koordinat.js"></script>

  <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../assets/datatables/jquery.dataTables.js"></script>
  <script type="text/javascript" src="../assets/datatables/dataTables.bootstrap.js"></script>
  <script type="text/javascript" src="../assets/js/jquery-2.2.3.min.js"></script>


  <link rel="stylesheet" href="../css/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../Resources/bootstrap-select/bootstrap-select.min.css" />

  <script src="../Resources/bootstrap-select/bootstrap-select.min.js"></script>
  <script type="text/javascript" src="../js/pemisah.js"></script>
  <script src="../js/invoice.js"></script>
  <script src="../js/c.js"></script>
  <script src="../js/ruas_koordinat.js"></script>

  <style>
    #ruas_koordinat {
      display: none;
    }
  </style>
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
    <?php require_once("navbar-menu.php"); ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="data_umum.php">Data Umum</a></li>
                <li class="breadcrumb-item active">Buat Data Umum</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Buat Data Umum</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">


            <div class="col-lg-12 main-chart">
              <?php if (isset($_GET['success-edit'])) { ?>
                <div class="alert alert-success">
                  <p>Edit Data Berhasil !</p>
                </div>
              <?php } ?>
              <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success">
                  <p>Tambah Data Berhasil !</p>
                </div>
              <?php } ?>
              <?php if (isset($_GET['remove'])) { ?>
                <div class="alert alert-danger">
                  <p>Hapus Data Berhasil !</p>
                </div>
              <?php } ?>
              <?php if (isset($_GET['success-update'])) { ?>
                <div class="alert alert-success">
                  <p>Update Data Berhasil !</p>
                </div>
              <?php } ?>

              <!-- Horizontal Form -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <!-- <form action="../fungsi/tambah/insert.php?data_umum=tambah" id="invoice-form" method="post" class="form-horizontal" role="form" novalidate="" enctype="multipart/form-data"> -->
                <form action="" id="invoice-form" method="post" class="form-horizontal" role="form" novalidate="" enctype="multipart/form-data">

                  <div class="card-body">
                    <input type="hidden" class="form-control" id="user" name="id_user" value="<?= $_SESSION['id_logged'] ?>">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Pemda</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="pemda" name="pemda" VALUE="PEMERINTAH PROVINSI JAWA BARAT" required="required">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">OPD</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="opd" name="opd" VALUE="DINAS BINA MARGA DAN PENATAAN RUANG" required="required">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Unor</label>
                      <div class="col-sm-10">
                        <select name="unor" id="unor" class="form-control select2" style="width:100%;" data-live-search="true">
                          <option value="0">Pilih Unor</option>
                          <?php
                          foreach ($itemUnor as $ur) {
                          ?>
                            <option value="<?php echo $ur['id_kantor']; ?>">
                              <?php echo $ur['nama_lengkap']; ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Pilih SUP</label>
                      <div class="col-sm-10">
                        <select name="sup" id="sup" class="form-control">
                          <option value="0">Pilih SUP</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Kategori Paket Kegiatan</label>
                      <div class="col-sm-10">
                        <select name="kategori" id="unor" class="form-control select2" style="width:100%;" data-live-search="true">
                          <option value="0">Pilih Kategori Paket</option>
                          <?php
                          $kategori = $talikuat->get_kategori_paket();

                          foreach ($kategori as $k) {
                          ?>
                            <option value="<?= $k['id']; ?>"><?= $k['nama_kategori']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nama Kegiatan / Paket</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" required="required">
                      </div>
                    </div>

                    <!-- Form Element sizes -->
                    <div class="card card-danger">
                      <div class="card-header">
                        <h3 class="card-title">Ruas Jalan</h3>
                      </div>
                      <div class="card-body">
                        <div class="input-group input-group-sm">

                          <select name="ruas_jalan" id="ruas_jalan" class="select2 form-control" style="width:90%" data-live-search="true">
                            <option value="0">Ruas Jalan</option>
                            <?php
                            foreach ($itemRuas_jalan as $ruas_jalan) {
                            ?>
                              <option value="<?php echo $ruas_jalan['nama_ruas'] . ',' . $ruas_jalan['id'] . ',' . $ruas_jalan['panjang']; ?>">
                                '<?php echo $ruas_jalan['nama_ruas']; ?>' - <?php echo $ruas_jalan['id']; ?> - <?php echo $ruas_jalan['panjang']; ?> Km.
                              </option>
                            <?php
                            }
                            ?>
                          </select>

                          <span class="input-group-append">
                            <button id="addrow" type="button" class="btn btn-info btn-flat">+</button>
                          </span>
                        </div>
                        <br />

                        <table class="order-list table table-responsive table-striped table-hover table-bordered" id="ruas_koordinat">
                          <!--<table class="table table-bordered table-hover " id="invoiceItem7">-->
                          <thead>
                            <tr class="well">
                              <th class="text-center">Ruas Jalan</th>
                              <th class="text-center">Segmen Jalan</th>
                              <th class="text-center">Koordinat <br />
                                Awal Lat</th>
                              <th class="text-center">Koordinat Awal Long</th>
                              <th class="text-center">Koordinat Akhir Lat</th>
                              <th class="text-center">Koordinat Akhir Long</th>
                              <th class="text-center">Link</th>
                              <th></th>
                            </tr>
                          </thead>

                          <tbody>
                          </tbody>

                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">No. Kontrak</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_kontrak" name="no_kontrak" required="required">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Tanggal Kontrak</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="tgl_kontrak" name="tgl_kontrak" required="required">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nilai. Kontrak</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nilai_kontrak" name="nilai_kontrak" required="required">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">No. SPMK</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_spmk" name="no_spmk" required="required">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">tanggal SPMK</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="tgl_spmk" name="tgl_spmk" required="required">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Panjang</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="panjang" name="panjang" placeholder=".....Km" required="required">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Waktu Pelaksanaan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="waktu_pelaksanaan" name="waktu_pelaksanaan" placeholder=".....Hari" required="required">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">PPK Kegiatan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="ppk" name="ppk" placeholder="Nama Kegiatan" required="required">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Penyedia Jasa</label>
                      <div class="col-sm-10">
                        <select name="penyedia_jasa" id="penyedia_jasa" class="select2 form-control" data-live-search="true">
                          <option value="0">Penyedia Jasa</option>
                          <?php
                          foreach ($itemPenyedia as $penyedia) {
                          ?>
                            <option value="<?php echo $penyedia['nama']; ?>">
                              <?php echo $penyedia['nama']; ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Konsultan Supervisi</label>
                      <div class="col-sm-10">
                        <select name="konsultan" id="konsultan" class="select2 form-control" data-live-search="true">
                          <option value="0">Konsultan</option>
                          <?php
                          foreach ($itemKonsul as $konsul) {
                          ?>
                            <option value="<?php echo $konsul['nama']; ?>">
                              <?php echo $konsul['nama']; ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nama PPK</label>
                      <div class="col-sm-10">
                        <select name="nama_ppk" id="nama_ppk" class="select2 form-control" data-live-search="true">
                          <option value="0">PPK</option>
                          <?php
                          foreach ($itemPpk as $p) {
                          ?>
                            <option value="<?php echo $p['nama']; ?>">
                              <?php echo $p['nama']; ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nama SE</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_se" name="nama_se" required="required">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nama GS</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_gs" name="nama_gs" required="required">
                      </div>
                    </div>

                    <!-- Form Element sizes -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Upload Data</h3>
                      </div>
                      <div class="card-body">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Daftar Kuantitas dan Harga (DKH)</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="rab">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Perjanjian Kontrak</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="pk">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">SPMK</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="ul_spmk">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Syarat Umum</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="sm">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Syarat Khusus</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="sk">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Jadual Pelaksanaan Pekerjaan</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="ul_jadual">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Gambar Rencana </label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="ul_rencana">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">SPPBJ </label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="ul_sppbj">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">SPL </label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="ul_spl">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Spesifikasi Umum </label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="ul_spek">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Jaminan-Jaminan </label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="ul_jaminan">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">SPKMP </label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" name="ul_spkmp">
                          </div>
                        </div>





                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->





                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Simpan</button>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
              <!-- /.card -->


            </div>

          </div>

          <div class="card-footer">
            Dinas Bina Marga dan Penataan Ruang Provinsi Jawa Barat
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

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

  <!-- Chained Dropdown Unor -->
  <script src="../js/chained_data_umum_ruas.js"></script>
  <!-- Chained Dropdown Ruas -->
  <script src="../js/chained_ruas_jalan.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/js/select2.full.min.js"></script>
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
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



  <!-- page script -->
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
      })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'mm/dd/yyyy'
      })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function(start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });

      $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });

    })
  </script>


</body>

</html>