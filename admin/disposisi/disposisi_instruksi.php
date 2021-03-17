<?php
session_start();
include "../../src/talikuat.php";
include "../../src/LogHistory.php";
include "../../fungsi/view/tampil.php";
include "../cekadmin.php";
include "../../konfigurasi/koneksi.php";

if (!isset($_SESSION['nama'])) {
    echo '<script language="javascript">alert("Anda harus Login!"); document.location="../index.php";</script>';
}

$talikuat = new talikuat();
$tampil = new tampil();
$log = new LogHistory();
$hasil2 = $tampil->kontraktor_row();
$hasil3 = $tampil->konsultan_row();
$hasil4 = $tampil->ppk_row();
$hasil5 = $tampil->data_umum_admin();

$menu = "Disposisi Instruksi";
$log_write = $log->recordLog($menu);

$paket = mysqli_query($konek, "SELECT kegiatan, sum(volume) as persen FROM master_laporan_harian group by kegiatan");
while ($row = mysqli_fetch_array($paket)) {
    $nama_paket[] = $row['kegiatan'];

    $query = mysqli_query($konek, "SELECT kegiatan, sum(volume) as persen FROM master_laporan_harian where kegiatan='" . $row['kegiatan'] . "'");
    $row = $query->fetch_array();
    $jumlah_persen[] = $row['persen'];
    // die(var_dump($row));
}
// $pak = mysqli_query($konek, "SELECT kegiatan, sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_laporan_harian_pekerjaan JOIN detail_jadual ON detail_laporan_harian_pekerjaan.no_trans = detail_jadual.id GROUP BY kegiatan");
$pak = mysqli_query($konek, "SELECT sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_laporan_harian_pekerjaan JOIN detail_jadual ON detail_laporan_harian_pekerjaan.no_trans = detail_jadual.id");
while ($row = mysqli_fetch_array($pak)) {
    // $nama_pak[] = $row['kegiatan'];

    // $query = mysqli_query($konek, "SELECT kegiatan, sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_laporan_harian_pekerjaan JOIN detail_jadual ON detail_laporan_harian_pekerjaan.no_trans = detail_jadual.id WHERE kegiatan = '" . $row['kegiatan'] . "'");
    $query = mysqli_query($konek, "SELECT sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_laporan_harian_pekerjaan JOIN detail_jadual ON detail_laporan_harian_pekerjaan.no_trans = detail_jadual.id");
    $row = $query->fetch_array();
    $persen[] = $row['persen'];
    // die(var_dump($row));
}

// die(json_encode($persen));
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
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!--<link rel="stylesheet" href="../css/ionicons.min.css">-->
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
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
                    <a class="nav-link" data-slide="true" href="../../logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once("navbar-menu.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Disposisi Instruksi</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Disposisi Instruksi</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <section class="content">

                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Disposisi Instruksi</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                        <i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12 main-chart">

                                    <table>
                                        <tr>
                                            <td>
                                                <button id="tombol-simpan" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
                                                    Tambah
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                    <br />


                                    <table class="table table-bordered table-striped" id="example1">
                                        <thead>
                                            <tr style="background:#DFF0D8;color:#333;">
                                                <th width="5%">No.</th>
                                                <th>Jenis Instruksi</th>
                                                <th>Keterangan</th>
                                                <th width="20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $query = mysqli_query($konek, "SELECT * FROM master_disposisi_instruksi");
                                            while ($data = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $data['jenis_instruksi']; ?></td>
                                                    <td><?= $data['keterangan']; ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail<?= $data['id']; ?>">Detail</a>
                                                        <a href="#" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#modal-edit<?= $data['id']; ?>">Edit</a>
                                                        <a href="../../fungsi/hapus/hapus.php?id=<?= $data['id']; ?>&disinstruksi" onclick="return confirm('Apakah  yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm text-white">Hapus</a>
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

            <!-- modal tambah -->
            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Disposisi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!--<form action="" id="invoice-form" method="post" class="form-horizontal" role="form" novalidate="" enctype="multipart/form-data" >-->
                            <form action="../../fungsi/tambah/insert.php?disinstruksi=input" method="post">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jenis Instruksi</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="instruksi" name="instruksi" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-8">
                                        <textarea name="keterangan" id="keterangan" class="form-control" cols="20" rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>


                            </form>


                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <!-- modal detail -->
            <?php
            $qry = mysqli_query($konek, "SELECT * FROM master_disposisi_instruksi");
            while ($id = mysqli_fetch_array($qry)) {
            ?>
                <div class="modal fade" id="modal-detail<?= $id['id']; ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Detail Disposisi Instruksi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Jenis Instruksi</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($konek, "SELECT * FROM master_disposisi_instruksi WHERE id = " . $id['id']);
                                                    while ($item = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $item['jenis_instruksi']; ?></td>
                                                            <td><?= $item['keterangan']; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            <?php } ?>
            <!-- /.modal -->

            <!-- modal edit -->
            <?php
            $qry = mysqli_query($konek, "SELECT id FROM master_disposisi_instruksi");
            while ($id = mysqli_fetch_array($qry)) {
            ?>
                <div class="modal fade" id="modal-edit<?= $id['id']; ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Update Disposisi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $sql = mysqli_query($konek, "SELECT * FROM master_disposisi_instruksi WHERE id =" . $id['id']);
                                while ($dt = mysqli_fetch_array($sql)) {
                                ?>
                                    <form action="../../fungsi/edit/edit.php?disinstruksi=edit" method="post">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jenis Instruksi</label>
                                            <div class="col-sm-8">
                                                <input type="hidden" name="id" value="<?= $dt['id']; ?>">
                                                <input type="text" class="form-control" id="instruksi" name="instruksi" value="<?= $dt['jenis_instruksi']; ?>" required="required">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                            <div class="col-sm-8">
                                                <textarea name="keterangan" id="keterangan" class="form-control" cols="20" rows="10"><?= $dt['keterangan']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="submit" class="btn btn-warning">Ubah</button>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            <?php } ?>
            <!-- /.modal -->

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
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../../plugins/moment/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.js"></script>
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <script src="../../plugins/chart.js/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
</body>

</html>