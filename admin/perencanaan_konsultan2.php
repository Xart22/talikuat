<?php
session_start();
include "../src/talikuat.php";
include "../fungsi/view/tampil.php";
include "tgl_indo.php";
include('cekadmin.php');

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

$pak = mysqli_query($konek, "SELECT kegiatan, sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_laporan_harian_pekerjaan JOIN detail_jadual ON detail_laporan_harian_pekerjaan.no_trans = detail_jadual.id GROUP BY kegiatan");
while ($row = mysqli_fetch_array($pak)) {
    $nama_pak[] = $row['kegiatan'];

    $query = mysqli_query($konek, "SELECT kegiatan, sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_laporan_harian_pekerjaan JOIN detail_jadual ON detail_laporan_harian_pekerjaan.no_trans = detail_jadual.id WHERE kegiatan = '" . $row['kegiatan'] . "'");
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
                            <h1 class="m-0 text-dark">Perencanaan Konsultan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Perencanaan Konsultan</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Paparan Perencanaan Konsultan</h3>
                        </div>
                        <div class="card-body">
                            <!-- <div id="paparan"></div> -->
                        </div>
                    </div>

                    <!-- Data perencanaan -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Paparan Perencanaan Konsultan </h3>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <a href="print_perencanaan.php" target="_blank" id="tombol-pdf" class="btn btn-danger mb-5">
                                    <i class="fa fa-file-pdf"></i> &nbsp; View PDF
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped text-center" id="example1">
                                        <thead>
                                            <tr style="background:#DFF0D8;color:#333;">
                                                <th rowspan="3">#</th>
                                                <th rowspan="3">Kegiatan</th>
                                                <th rowspan="3">No. Mata Pembayaran</th>
                                                <th rowspan="3">Uraian</th>
                                                <th rowspan="3">Satuan</th>
                                                <th rowspan="3">Harga Satuan (Rupiah)</th>

                                                <?php
                                                $bulank = $talikuat->get_bulan_perencanaan();
                                                $jml = 1;
                                                foreach ($bulank as $dk) {
                                                    $bulan = $dk['bulan'];
                                                    $jml++;

                                                    $tglt = $dk['tgl'];

                                                    $minggu = date('Y-m-d', strtotime('+1 week', strtotime($tglt)));

                                                    // echo $minggu . "    ";
                                                }
                                                ?>
                                                <th colspan="<?= 3 + $jml; ?>">Preservasi Rekonstruksi/Rehabilitasi Jalan</th>
                                            </tr>
                                            <tr>
                                                <th colspan="3"></th>
                                                <?/*php
                                                    $q = mysqli_query($konek, "SELECT * FROM detail_jadual");
                                                    while($d = mysqli_fetch_array($q)) {
                                                        $pish = explode("-", $d['tgl']);
                                                        $bulan = $pish[1];
                                                        $q2 = mysqli_query($konek, "SELECT * FROM detail_jadual WHERE MONTH(tgl) = '$bulan'");
                                                        $nox = 1;
                                                        while($d2 = mysqli_fetch_array($q2)) {
                                                            $nox++;
                                                        }
                                                    }
                                                    echo "<th colspan='".$nox."'>I</th>";
                                                */?>
                                            </tr>
                                            <tr>
                                                <th rowspan="1">Volume</th>
                                                <th rowspan="1">Jumlah Harga (Rp.)</th>
                                                <th rowspan="1">Bobot (%)</th>
                                                <!-- <th rowspan="2">1 Feb - 7 Feb</th> -->
                                                <?php
                                                $bulank = $talikuat->get_bulan_perencanaan();
                                                $jml = 1;
                                                foreach ($bulank as $dk) {
                                                    $bulan = $dk['bulan'];
                                                    echo "<th>" . bulan_indo($bulan) . "</th>";
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;

                                            foreach ($konsultan as $k) {
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $k['kegiatan']; ?></td>
                                                    <td><?= $k['nmp']; ?></td>
                                                    <td><?= $k['uraian']; ?></td>
                                                    <td><?= $k['satuan']; ?></td>
                                                    <td><?= $k['harga_satuan']; ?></td>
                                                    <td><?= $k['volume']; ?></td>
                                                    <td><?= $k['jumlah_harga']; ?></td>
                                                    <td><?= $k['bobot']; ?></td>
                                                    <?php
                                                    for ($i = 0; $i < 21; $i++) {
                                                        $bobot = $k['bobot'] / 4;
                                                        echo "
                                                                <td>" . $bobot . "</td>
                                                            ";
                                                    }
                                                    ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
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
    <?php
    // $arrppk = [];
    // $arrbobot = [];
    // $series = [];
    // $data = [];

    // $sql = mysqli_query($konek, "SELECT konsultan FROM jadual");

    // while ($datax = mysqli_fetch_array($sql)) {
    //     $nama = $datax['konsultan'];

    //     $array_attribute = array($nama);
    // }

    // $cari = mysqli_query($konek, "SELECT * FROM jadual");
    // while($dt = mysqli_fetch_array($cari)) {
    //     $nama_id = $dt['id'];
    //     $bobot = $dt['bobot'];

    //     //set kategori nama ppk
    //     array_push($arrppk, array('id' => $nama_id, 'bobot' => $bobot));

    //     //set nilai bobot
    //     array_push($arrbobot, $bobot);

    //     foreach($arrppk as $key => $val) {
    //         //set data bobot ppk
    //         $data[$val['bobot']] = array();

    //         $qry = mysqli_query($konek, "SELECT * FROM jadual WHERE id = " . intval($val['id']));
    //         while($row = mysqli_fetch_array($qry)) {
    //             $nilai = $row['bobot'];

    //             $data[$val['konsultan']['bobot']] = intval($nilai);
    //             // echo var_dump($data);
    //         }
    //     }

    //     // set nama series grafik nama  status kondisi jalannya
    //     foreach ($arrppk as $attribute) {
    //         array_push($series, array('name' => $attribute, 'data' => array()));
    //     }

    //     // set value per series grafik
    //     foreach ($arrbobot as $kategori) {
    //         $i = 0;
    //         foreach ($data as $attribute) {
    //             array_push($series[$i]['data'], $data[$kategori][$attribute]);
    //             // die(var_dump(array_push($series[$i]['data'], $data[$kategori][$attribute])));
    //             $i++;
    //         }
    //     }
    // } 
    ?>
    <script>
        // var clx = document.getElementById("paparan").getContext('2d');
        Highcharts.chart('paparan', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Paparan Perencanaan Sistem Aplikasi Konsultan'
            },
            subtitle: {
                text: 'Konsultan DBMPR Jawa Barat'
            },
            xAxis: {
                // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                // categories: <?//= json_encode($arrbobot); ?>
            },
            yAxis: {
                title: {
                    // text: 'Temperature (°C)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                    name: 'Tokyo',
                    // data: <?//php echo json_encode($arrbobot); ?>
                }
                // , 
                // {
                //     name: 'London',
                //     data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
                // }
            ]
        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
</body>

</html>