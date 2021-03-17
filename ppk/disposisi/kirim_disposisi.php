<?php
session_start();
include "../../src/talikuat.php";
include "../../src/LogHistory.php";
include "../../fungsi/view/tampil.php";
include "../cekppk.php";
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

$menu = "Dashboard";
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
    <!-- Select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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
                            <img src="../../assets/img/user/<?php echo $isi['gambar']; ?>" class="img-circle elevation-2" alt="User Image">
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
                        <li class="nav-item has-treeview">
                            <a href="../index.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Halaman Utama
                                    <!--<i class="right fas fa-angle-left"></i>-->
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Disposisi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="kirim_disposisi.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kirim Disposisi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="disposisi_masuk.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Disposisi Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="disposisi_tindak_lanjut.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Disposisi Tindak Lanjut</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="data_absensi.php" class="nav-link">
                                <i class="nav-icon 	fa fa-address-card"></i>
                                <p>
                                    Absensi Konsultan
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="perencanaan_konsultan.php" class="nav-link">
                                <i class="nav-icon fa fa-calendar" aria-hidden="true"></i>
                                <p>
                                    Perencanaan Konsultan
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="data_progress_mingguan.php" class="nav-link">
                                <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                                <p>
                                    Progress Mingguan
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="penilaian_kinerja.php" class="nav-link">
                                <i class="nav-icon fa fa-bars" aria-hidden="true"></i>
                                <p>
                                    Penilaian Kinerja
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

                        <li class="nav-item has-treeview">
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
                                <li class="nav-item">
                                    <a href="loghistory.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Catatan Log</p>
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
                            <h1 class="m-0 text-dark">Kirim Disposisi</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Kirim Disposisi</li>
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
                                <h3 class="card-title">Kirim Disposisi </h3>

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
                                                    Kirim
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                    <br />

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="example1">
                                            <thead>
                                                <tr style="background:#DFF0D8;color:#333;">
                                                    <th width="5%">No.</th>
                                                    <th>Status</th>
                                                    <th>Surat Dari</th>
                                                    <th>Perihal</th>
                                                    <th>No Surat</th>
                                                    <th>Tgl Surat</th>
                                                    <th>Disposisi</th>
                                                    <th>Tgl Deadline</th>
                                                    <th>Dibuat Tgl</th>
                                                    <th width="20%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include "../tgl_indo.php";
                                                $no = 1;
                                                $id = $_SESSION['id_logged'];
                                                $qry = $talikuat->getDisposisi($id);
                                                foreach ($qry as $item) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($item['status'] == "1") {
                                                                echo '<button class="btn btn-secondary btn-mini btn-round">Submitted</button> ';
                                                            } else if ($item['status'] == "2") {
                                                                echo '<button class="btn btn-primary btn-mini btn-round">Accepted</button> ';
                                                            } else if ($item['status'] == "3") {
                                                                echo '<button class="btn btn-success  btn-mini btn-round">On Progress</button> ';
                                                            } else if ($item['status'] == "4") {
                                                                echo '<button class="btn btn-info  btn-mini btn-round">Finish</button> ';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $item['dari']; ?></td>
                                                        <td><?= $item['perihal']; ?></td>
                                                        <td><?= $item['no_surat']; ?></td>
                                                        <td><?= tgl_indo($item['tgl_surat']); ?></td>
                                                        <td>
                                                            <?php /**Untuk disposisi code sandingkan dengan tabel disposisi kepada penanggung jawab */
                                                                $dpcode = $item['disposisi_code'];
                                                                $qry = "SELECT c.nama_lengkap, a.id, b.user_role_id, a.disposisi_code AS dpa, b.disposisi_code AS dpb FROM disposisi AS a JOIN disposisi_penanggung_jawab AS b ON a.disposisi_code = b.disposisi_code JOIN member AS c ON a.created_by = c.id_member WHERE b.user_role_id = '$id' AND a.disposisi_code = '$dpcode'";
                                                                $sql = mysqli_query($konek, $qry);
                                                                $cek = mysqli_num_rows($sql);
                                                                if($cek > 0) {
                                                                    foreach ($sql as $data) {
                                                                        echo $data['nama_lengkap'] . "<br/>";
                                                                    }
                                                                } else {
                                                                    echo "Tidak Ada";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><?= tgl_indo($item['tanggal_penyelesaian']); ?></td>
                                                        <td><?= $item['created_date']; ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail<?= $item['id']; ?>">Detail</a>
                                                            <!-- <a href="#" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#modal-edit<?= $item['id']; ?>">Edit</a> -->
                                                            <a onclick="return confirm('Apakah  yakin ingin menghapus data ini?')" href="../../fungsi/hapus/hapus.php?id=<?= $item['id']; ?>&kirimdisposisi" class="btn btn-danger btn-sm text-white">Hapus</a>
                                                        </td>
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

            <!-- modal kirim disposisi -->
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
                            <form action="../../fungsi/tambah/insert.php?diskirim=tambah" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Dari</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="dari" name="dari" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Perihal</label>
                                    <div class="col-sm-8">
                                        <textarea name="perihal" id="perihal" class="form-control" cols="20" rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tgl Surat</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="tglsurat" name="tglsurat" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">No Surat</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nosurat" name="nosurat" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Disposisikan Kepada</label>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control" id="kepada" name="kepada" required="required" placeholder="Disposisikan Kepada...."> -->
                                        <select name="kepada[]" multiple="multiple" class="form-control select2">
                                            <option value="">Disposisikan Kepada...</option>
                                            <?php
                                            $sql = mysqli_query($konek, "SELECT * FROM member");
                                            foreach ($sql as $item) {
                                            ?>
                                                <option value="<?= $item['id_member']; ?>"><?= $item['jabatan']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jenis Instruksi</label>
                                    <div class="col-sm-8">
                                        <select name="instruksi[]" class="form-control select2" multiple="multiple">
                                            <?php
                                            $sql = mysqli_query($konek, "SELECT * FROM master_disposisi_instruksi");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <option value="<?= $data['id']; ?>"><?= $data['jenis_instruksi']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tgl Penyelesaian</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="penyelesaian" name="penyelesaian" required="required" placeholder="Disposisikan Kepada....">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">File Lampiran</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="lampiran" name="lampiran" placeholder="Disposisikan Kepada....">
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

            <!-- modal detail kirim disposisi -->
            <?php
            $sql = mysqli_query($konek, "SELECT * FROM disposisi");
            $isi = mysqli_fetch_array($sql);
            ?>
            <div class="modal fade" id="modal-detail<?= $isi['id']; ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detail Disposisi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">

                                <h1 class="text-center">Detail Data</h1>
                                <div class="table-responsive mb-5">
                                    <table class="table-bordered table-striped nowrap" cellpadding="8" align="center">
                                        <?php
                                        $id = $_SESSION['id_logged']; //id login admin
                                        $discode = $isi['disposisi_code'];
                                        $data = $talikuat->getDetailDisposisi($id, $discode);

                                        if ($data) {
                                        ?>
                                            <tr>
                                                <th>Disposisi Code</th>
                                                <td><?= $data[1]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Pemberi Disposisi</th>
                                                <td><?= $data[2]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Surat dari</th>
                                                <td><?= $data[3]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Perihal</th>
                                                <td><?= $data[4]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Surat</th>
                                                <td><?= tgl_indo($data[5]); ?></td>
                                            </tr>
                                            <tr>
                                                <th>No Surat</th>
                                                <td><?= $data[6]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Penyelesaian</th>
                                                <td><?= tgl_indo($data[7]); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <?php
                                                    $status = $data[8];
                                                    if ($status == "1") {
                                                        echo '<button class="  btn btn-inverse btn-mini btn-round">Submitted</button> ';
                                                    } else if ($status == "2") {
                                                        echo '<button class="btn btn-info btn-mini btn-round">Accepted</button> ';
                                                    } else if ($status == "3") {
                                                        echo '<button class="btn btn-success  btn-mini btn-round">On Progress</button> ';
                                                    } else if ($status == "4") {

                                                        echo '<button class="btn btn-info  btn-mini btn-round">Finish</button> ';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Disposisi Kepada</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Dibuat Tanggal</th>
                                                <td><?= $data[10]; ?></td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="">Data Kosong</td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>

                                <h1 class="text-center">Lampiran</h1>
                                <?php if ($data[9] != '' || $data[9] != null) { ?>
                                    <iframe src="../../lampiran/disposisi_pdf/<?= $data[9]; ?>" width="600" height="400" class="mx-auto d-block" frameborder="0"></iframe>
                                <?php } else { ?>
                                    <h2 class="text-center">Lampiran Tidak Tersedia</h2>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <!-- modal edit disposisi  -->
            <?php
            $sql = mysqli_query($konek, "SELECT * FROM disposisi");
            $isi = mysqli_fetch_array($sql);
            ?>
            <div class="modal fade" id="modal-edit<?= $isi['id']; ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Disposisi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post" enctype="multipart/form-data">
                                <?php
                                $qry = mysqli_query($konek, "SELECT * FROM disposisi WHERE id = " . $isi['id']);
                                $edit = mysqli_fetch_array($qry);
                                ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Dari</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="dari" name="dari" value="<?= $edit['dari']; ?>" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Perihal</label>
                                    <div class="col-sm-8">
                                        <textarea name="perihal" id="perihal" class="form-control" cols="20" rows="10"><?= $edit['perihal']; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tgl Surat</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="tglsurat" name="tglsurat" value="<?= $edit['tgl_surat']; ?>" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">No Surat</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nosurat" name="nosurat" value="<?= $edit['no_surat']; ?>" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Disposisikan Kepada</label>
                                    <div class="col-sm-8">
                                        <?php
                                        $dpcode = $edit['disposisi_code'];
                                        $qry = "SELECT c.nama_lengkap, a.id, b.user_role_id, a.disposisi_code AS dpa, b.disposisi_code AS dpb FROM disposisi AS a JOIN disposisi_penanggung_jawab AS b ON a.disposisi_code = b.disposisi_code JOIN member AS c ON a.created_by = c.id_member WHERE b.user_role_id = '$id' AND a.disposisi_code = '$dpcode'";
                                        $sql = mysqli_query($konek, $qry);
                                        foreach ($sql as $data) {
                                            if($data) {
                                        ?>
                                            <input type="text" class="form-control" id="kepada" name="kepada" value="<?= $data['nama_lengkap']; ?>" readonly>
                                        <?php } else { echo "<h1>sd</h1>"; } } ?>
                                        <select name="kepada[]" multiple="multiple" class="form-control select2">
                                            <option value="">Disposisikan Kepada...</option>
                                            <?php
                                            $sql = mysqli_query($konek, "SELECT * FROM member");
                                            foreach ($sql as $item) {
                                            ?>
                                                <option value="<?= $item['id_member']; ?>"><?= $item['jabatan']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jenis Instruksi</label>
                                    <div class="col-sm-8">
                                        <select name="instruksi[]" id="instruksi" class="form-control select2" multiple="multiple" style="width: 350px;" required="required">
                                            <?php
                                            $sql = mysqli_query($konek, "SELECT * FROM master_disposisi_instruksi");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <option value="<?= $data['id']; ?>"><?= $data['jenis_instruksi']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tgl Penyelesaian</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="penyelesaian" name="penyelesaian" value="<?= $edit['tgl_penyelesaian']; ?>" required="required" placeholder="Disposisikan Kepada....">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">File Lampiran</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="lampiran" name="lampiran" placeholder="Disposisikan Kepada....">
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-warning text-white">Ubah</button>
                                </div>


                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
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
    <!-- Select 2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2({});
        })
    </script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.js"></script>
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <script src="../../plugins/chart.js/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
</body>

</html>