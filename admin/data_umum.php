<?php
session_start();
include "../src/talikuat.php";
include "../src/LogHistory.php";
include('cekadmin.php');
if (!isset($_SESSION['nama'])) {
  echo '<script language="javascript">alert("Anda harus Login!"); document.location="../index.php";</script>';

  //$hasil_profil = $lihat -> member();
  /*$talikuat = new talikuat();	
$talikuat->checkLoggedIn();

session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
*/
}
$talikuat = new talikuat();
$log = new LogHistory();
$log->recordLog("Data Umum");
//$talikuat->checkLoggedIn();
$data_item = $talikuat->get_member();

$menu = "Data Umum";

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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <style>
    .disabled {
      pointer-events: none;
      cursor: default;
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
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
        </li>
        <li class="nav-item">
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
                <li class="breadcrumb-item active">Data Umum</li>
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
            <h3 class="card-title">Data Kegiatan / Paket</h3>

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
                  <td><a href="buat_data_umum.php"><button class="btn btn-primary"><i class="fa fa-plus"></i> Insert Data</button></td>
                </tr>
              </table>
              <br />

              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr style="background:#DFF0D8;color:#333;">
                      <th>No.</th>
                      <!--
                      <td>Pemda</td>
                      <td>OPD</td>
                      -->
                      <th>Unor</th>
                      <th>Kategori Paket</th>
                      <th>Nama Kegiatan</th>
                      <th>Nama Ruas Jalan</th>
                      <th>No Kontrak<br />
                        Tgl Kontrak<br />
                        Tgl PHO<br />
                        Nilai Kontrak</th>
                      <th>Penyedia Jasa</th>
                      <th>Nama PPK</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $hasil = $talikuat->data_umum();
                    $no = 1;
                    foreach ($hasil as $isi) {
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <!--<td><?php //echo $isi['id'];
                                ?></td>-->
                        <!--<td><?php echo $isi['pemda']; ?></td>-->
                        <!--<td><?php echo $isi['opd']; ?></td>-->
                        <td><?php echo $isi['nama_kantor']; ?></td>
                        <td><?= ucfirst($isi['nama_kategori']); ?></td>
                        <td><?php echo $isi['nama_kegiatan']; ?></td>
                        <td><?php echo $isi['ruas_jalan']; ?></td>
                        <td><?php echo $isi['no_kontrak']; ?><br />
                          <?php echo $isi['tgl_kontrak']; ?><br />
                          <?php echo date('Y-m-d', strtotime("+" . $isi['waktu_pelaksanaan'] . " days", strtotime($isi['tgl_spmk']))); ?><br />
                          <?php echo number_format($isi['nilai_kontrak'], 2); ?></td>
                        <td><?php echo $isi['penyedia_jasa']; ?></td>
                        <td><?php echo $isi['nama_ppk']; ?></td>
                        <td>

                          <a href="edit_data_umum.php?data_umum=<?php echo $isi['datumid']; ?>"><span class="nav-icon fas fa-edit" style="color:red" title="Ubah Data">&nbsp;</span></a>
                          <a href="#" onclick="javascript:return confirm('Hapus Data ?');"><span class="glyphicon glyphicon-remove-sign" style="color:red;font-size:18px" title="Hapus Data">&nbsp;</span></a>
                          <a href="buat_jadual.php?data_umum=<?php echo $isi['datumid']; ?>"><span class="nav-icon fas fa-calendar" title="Buat Jadual">&nbsp;</span></a>
                        </td>
                      </tr>
                    <?php $no++;
                    } ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>

        </div>
        <!--
        <div class="card-footer">
          Footer
        </div>
		-->
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

  <!-- SweetAlert2 -->
  <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="../plugins/toastr/toastr.min.js"></script>
      <!-- costum js -->
      <script src="../js/costum.js"></script>

  <!-- page script -->
  <script>
    $(function() {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
  </script>

  <script type="text/javascript">
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      $('.swalDefaultSuccess').show(function() {
        Toast.fire({
          type: 'success',
          title: 'Data Sudah Tersimpan.'
        })
      });
      $('.swalDefaultInfo').click(function() {
        Toast.fire({
          type: 'info',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultError').show(function() {
        Toast.fire({
          type: 'error',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultWarning').show(function() {
        Toast.fire({
          type: 'warning',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultQuestion').click(function() {
        Toast.fire({
          type: 'question',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });

      $('.toastrDefaultSuccess').show(function() {
        toastr.success('Data Sudah Tersimpan')
      });
      $('.toastrDefaultInfo').show(function() {
        toastr.info('Ini Terjadi Karena Telah Masuk Nama File Yang Sama,Silahkan Rename File terlebih dahulu')
      });
      $('.toastrDefaultError').show(function() {
        toastr.error('Data Gagal Di Update')
      });
      $('.toastrDefaultWarning').show(function() {
        toastr.warning('Besar File Tidak Boleh Lebih Dari 4 MB')
      });

      $('.toastsDefaultDefault').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultTopLeft').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'topLeft',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultBottomRight').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'bottomRight',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultBottomLeft').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'bottomLeft',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultAutohide').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          autohide: true,
          delay: 750,
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultNotFixed').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          fixed: false,
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultFull').click(function() {
        $(document).Toasts('create', {
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          icon: 'fas fa-envelope fa-lg',
        })
      });
      $('.toastsDefaultFullImage').click(function() {
        $(document).Toasts('create', {
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          image: '../../dist/img/user3-128x128.jpg',
          imageAlt: 'User Picture',
        })
      });
      $('.toastsDefaultSuccess').click(function() {
        $(document).Toasts('create', {
          class: 'bg-success',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultInfo').click(function() {
        $(document).Toasts('create', {
          class: 'bg-info',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultWarning').click(function() {
        $(document).Toasts('create', {
          class: 'bg-warning',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultDanger').click(function() {
        $(document).Toasts('create', {
          class: 'bg-danger',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultMaroon').click(function() {
        $(document).Toasts('create', {
          class: 'bg-maroon',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
    });
  </script>

</body>

</html>