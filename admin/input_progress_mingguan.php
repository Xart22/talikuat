<?php
session_start();
include "../src/talikuat.php";
include "../fungsi/view/tampil.php";
include "tgl_indo.php";
include('cekadmin.php');

if (isset($_GET['action']) && $_GET['action'] == 'getData') {
    $id = $_GET['nama_paket'];

    // $query = mysqli_query($konek, "SELECT *,DATE_ADD(tgl_spmk, INTERVAL waktu_pelaksanaan DAY) AS pho, detail_jadual.volume AS rencana, detail_laporan_harian_pekerjaan.volume AS realisasi FROM data_umum 
    //                                 INNER JOIN detail_jadual ON detail_jadual.id = data_umum.id
    //                                 INNER JOIN detail_laporan_harian_pekerjaan ON detail_laporan_harian_pekerjaan.no_trans = data_umum.id
    //                                 WHERE detail_jadual.id_jadual = '$id'");
    $query = mysqli_query($konek, "SELECT * FROM jadual");
    $row = mysqli_fetch_assoc($query);
    echo json_encode($row);
    exit;
}

if (!isset($_SESSION['nama'])) {
    echo '<script language="javascript">alert("Anda harus Login!"); document.location="../index.php";</script>';
}
$talikuat = new talikuat();
$konsultan = $talikuat->get_perencanaan();

include('../konfigurasi/koneksi.php');
$paket = mysqli_query($konek, "SELECT kegiatan, sum(volume) as persen FROM master_laporan_harian group by kegiatan");
while ($row = mysqli_fetch_array($paket)) {
    $nama_paket[] = $row['kegiatan'];

    $query = mysqli_query($konek, "SELECT kegiatan, sum(volume) as persen FROM master_laporan_harian where kegiatan='" . $row['kegiatan'] . "'");
    $row = $query->fetch_array();
    $jumlah_persen[] = $row['persen'];
    // die(var_dump($row));
}

$pak = mysqli_query($konek, "SELECT kegiatan, sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_jadual INNER JOIN detail_laporan_harian_pekerjaan ON detail_jadual.id = detail_laporan_harian_pekerjaan.no_trans INNER JOIN jadual ON detail_jadual.id_jadual = jadual.id GROUP BY kegiatan");
while ($row = mysqli_fetch_array($pak)) {
    $nama_pak[] = $row['kegiatan'];

    $query = mysqli_query($konek, "SELECT kegiatan, sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_jadual INNER JOIN detail_laporan_harian_pekerjaan ON detail_jadual.id = detail_laporan_harian_pekerjaan.no_trans INNER JOIN jadual ON detail_jadual.id = jadual.id WHERE kegiatan = '" . $row['kegiatan'] . "'");
    $row = $query->fetch_array();
    $persen[] = $row['persen'];
    // die(var_dump($row));
}

include "../src/LogHistory.php";
$log = new LogHistory();
$menu = "Input Progress Mingguan";
$log_write = $log->recordLog($menu);

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
        <?php require_once("navbar-menu.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Progress Mingguan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item">Perencanaan Konsultan</li>
                                <li class="breadcrumb-item active">Input Progress Mingguan</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Grafik Card -->
                    <!-- <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Paparan Perencanaan Konsultan</h3>
                        </div>
                        <div class="card-body"> -->
                    <!-- <div id="paparan"></div> -->
                    <!-- </div>
                    </div> -->

                    <!-- Data perencanaan -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Input Progress Mingguan </h3>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <form action="<?= '../fungsi/tambah/insert.php'; ?>" method="POST">
                                    <div class="form-group row">
                                        <label for="namapaket" class="col-sm-2 col-form-label">Nama Paket Kegiatan</label>
                                        <div class="col-sm-10">
                                            <select name="nama_paket" class="form-control" id="nama_paket" onchange="changeValue(this.value)">
                                                <option value="-">Pilih Paket Kegiatan</option>
                                                <?php
                                                $query = mysqli_query($konek, "SELECT DISTINCT(jadual.kegiatan) AS kegiatan, DATE_ADD(tgl_spmk, INTERVAL data_umum.waktu_pelaksanaan DAY) AS pho, jadual.*, jadual.id AS jid,data_umum.*, data_umum.waktu_pelaksanaan AS waktu FROM data_umum 
                                                                                INNER JOIN detail_jadual ON detail_jadual.id = data_umum.id
                                                                                INNER JOIN detail_laporan_harian_pekerjaan ON detail_laporan_harian_pekerjaan.no_trans = data_umum.id
                                                                                INNER JOIN jadual ON jadual.id = detail_jadual.id_jadual");
                                                $collection = "var proweek = new Array();\n";
                                                while ($var = mysqli_fetch_array($query)) {
                                                    echo "<option value='" . $var['id'] . "'>" . $var['kegiatan'] . "</option>";
                                                    $collection .= "proweek['" . $var['id'] . "'] = 
                                                                    {
                                                                        id:'" . addslashes($var['jid']) . "'
                                                                        ,kegiatan: '" . addslashes($var['kegiatan']) . "'
                                                                        ,panjang:'" . addslashes($var['panjang']) . "'
                                                                        ,penyedia_jasa:'" . addslashes($var['nama_penyedia']) . "'
                                                                        ,spmkpho:'" . addslashes($var['tgl_spmk']) . " " . addslashes($var['pho']) . "'
                                                                        ,waktu: '" . addslashes($var['waktu']) . "'
                                                                        ,konsultan: '" . addslashes($var['konsultan']) . " " . "'
                                                                    };\n";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fieldteam" class="col-sm-2 col-form-label">Field Team</label>
                                        <div class="col-sm-10">
                                            <textarea name="team" placeholder="Masukkan Nama Team Progress" class="form-control" id="fieldteam" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <input id="nmk" name="nmk" type="hidden" class="form-control" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="pjgkm">Panjang Penanganan (KM/M)</label>
                                            <input id="pjgkm" name="pjgkm" type="text" class="form-control" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="pj">Penyedia Jasa</label>
                                            <input id="pj" name="pj" type="text" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="spo">SPMK & PHO</label>
                                            <input id="spo" name="spo" type="text" class="form-control" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="wp">Waktu Pelaksanaan</label>
                                            <input id="wp" name="wp" type="text" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="konsultan" class="col-sm-2 col-form-label">Konsultan Pengawas</label>
                                            <textarea id="kp" name="kons" class="form-control" id="konsultan" rows="3" readonly></textarea>
                                        </div>
                                    </div>

                                    <h3 class="text-center text-bold mt-5">Progress Terhadap Kontrak</h3>
                                    <table class="table table-responsive table-bordered mt-4" id="progress">
                                        <thead>
                                            <tr>
                                                <th>Minggu Ke-</th>
                                                <th>Rencana (%)</th>
                                                <th>Realisasi (%)</th>
                                                <th>Deviasi (%)</th>
                                                <th>Keuangan Rp.</th>
                                                <th>Keuangan (%)</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="minggu_ke[]"></td>
                                                <td><input type="text" name="rencana[]"></td>
                                                <td><input type="text" name="realisasi[]"></td>
                                                <td><input type="text" name="deviasi[]"></td>
                                                <td><input type="text" name="krp[]"></td>
                                                <td><input type="text" name="kpersen[]"></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div>
                                        <button type="button" name="add" id="add" class="btn btn-success btn-xs p-1 w-25"><i class="fas fa-plus"></i></button>
                                    </div>
                                    <br />

                                    <div id="inserted_progress"></div>

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
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
    <!-- Sparkline -->
    <script src="../plugins/sparklines/sparkline.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- JQVMap -->
    <!-- <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
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

    <script>
        <?php echo $collection; ?>

        function changeValue(item) {
            document.getElementById('nmk').value = proweek[item].kegiatan;
            document.getElementById('pjgkm').value = proweek[item].panjang;
            document.getElementById('pj').value = proweek[item].penyedia_jasa;
            document.getElementById('spo').value = proweek[item].spmkpho;
            document.getElementById('wp').value = proweek[item].waktu;
            document.getElementById('kp').value = proweek[item].konsultan;
        };
    </script>

    <script>
        $(document).ready(function() {
            var count = 1;
            $("#add").click(function() {
                count = count + 1;

                var html_code = "<tr id='row" + count + "'>";
                html_code += "<td><input type='text' name='minggu_ke[]'></td>";
                html_code += "<td><input type='text' name='rencana[]'></td>";
                html_code += "<td><input type='text' name='realisasi[]'></td>";
                html_code += "<td><input type='text' name='deviasi[]'></td>";
                html_code += "<td><input type='text' name='krp[]'></td>";
                html_code += "<td><input type='text' name='kpersen[]'></td>";
                html_code += "<td><button type='button' id='remove' name='remove' data-row='row" + count + "' class='btn btn-danger btn-xs p-2 remove'><i class='fas fa-trash'></i></button></td>";
                html_code += "</tr>";

                $("#progress").append(html_code);

                $(document).on('click', '.remove', function() {
                    var delete_row = $(this).data("row");
                    $('#' + delete_row).remove();
                });
            });

        });

        // $(document).on('click', '.remove3', function() {
        //     var delete_row = $(this).data("row");
        //     $('#' + delete_row).remove();
        // })
    </script>
    <script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
</body>

</html>