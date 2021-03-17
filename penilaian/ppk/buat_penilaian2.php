<?php
session_start();
include "../src/talikuat.php";
include('cekppk.php');
if(!isset($_SESSION['nama'])){
	echo '<script language="javascript">alert("Anda harus Login!"); document.location="../index.php";</script>';

}
$talikuat = new talikuat();	
//$talikuat->checkLoggedIn();
include "../src/item_penyedia_jasa.php";
	$controller = new ItemPenyedia();
	$itemPenyedia = $controller->itemPenyedia();

include "../src/item_pengguna.php";
	$controller = new ItemPengguna();
	$itemPengguna = $controller->itemPengguna();

include "../src/item_pengguna1.php";
	$controller = new ItemPengguna1();
	$itemPengguna1 = $controller->itemPengguna1();

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

if(!empty($_POST['nama_kegiatan']) && $_POST['nama_kegiatan']) {	
	$talikuat->simpan2($_POST);
}

if(!empty($_GET['data_umum']) && $_GET['data_umum']) {
	$data = $talikuat->getDataUmum($_GET['data_umum']);
	$data_ruas = $talikuat->getDataUmumRuas($_GET['data_umum']);		
	//$invoiceItems = $invoice->getInvoiceItems($_GET['update_id']);		
}

if(!empty($_GET['id_pen']) && $_GET['id_pen']) {
	$pen = $talikuat->getPenilaian($_GET['id_pen']);
	//$data_ruas = $talikuat->getDataUmumRuas($_GET['data_umum']);		
	//$invoiceItems = $invoice->getInvoiceItems($_GET['update_id']);		
}

if(!empty($_GET['id_paket']) && $_GET['id_paket']) {
	$pen3 = $talikuat->getPenilaian3($_GET['id_paket']);
	//$data_ruas = $talikuat->getDataUmumRuas($_GET['data_umum']);		
	//$invoiceItems = $invoice->getInvoiceItems($_GET['update_id']);		
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
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
<script src="../js/lap2.js"></script>
<script src="../js/c.js"></script>
<script src="../js/ruas_koordinat.js"></script>
		
<style>#ruas_koordinat{display:none;}</style>

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
	    <a href="#" class="brand-link">
      <img src="../assets/img/jabar.png" alt="">
	  <span class="brand-text font-weight-light"></span>   

    </a>
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
	<!--
    <a href="#" class="brand-link">
      <img src="../assets/img/jabar.png" alt="" class="brand-image img-circle elevation-3"
           style="opacity: .8">
	  <span class="brand-text font-weight-light">TaliKuat BimaJabar</span>   

    </a>
	-->
    <!-- Sidebar -->

    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
				  				<?php 
									$hasil = $talikuat -> get_member();
									
									foreach($hasil as $isi){
								?>
          <img src="../assets/img/user/<?php echo $isi['gambar'];?>" class="img-circle elevation-2" alt="User Image">
								<?php }?>
		</div>
        <div class="info">
          <!--<a href="#" class="d-block">(<?php echo $_SESSION['nama'] ; ?>)</a>-->
		  						<?php 
									$hasil = $talikuat -> get_member();
									
									foreach($hasil as $isi){
								?>
		  <a href="#" class="d-block"><?php echo $isi['nama_lengkap'];?></a>
									<?php }?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Halaman Utama
                <!--<i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
			<!--
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
			-->
          </li>
<!--		  
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
                <a href="master_kontraktor.php" class="nav-link disabled">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kontraktor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="master_konsultan.php" class="nav-link disabled">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Konsultan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="master_ppk.php" class="nav-link disabled">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PPK</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="master_jenis_pekerjaan.php" class="nav-link disabled">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis Pekerjaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="master_pengguna.php" class="nav-link disabled">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pengguna Aplikasi</p>
                </a>
              </li>			  			  
            </ul>
          </li>
-->
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
                <a href="penilaian_penyedia.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penilaian Penyedia</p>
                </a>
              </li>
<!--			  
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
-->			  
              <li class="nav-item">
                <a href="laporan_penilaian.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Penilaian</p>
                </a>
              </li>	 
            </ul>
          </li>
<!--
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
-->
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
			  <li class="breadcrumb-item"><a href="penilaian_penyedia.php">Penilaian Penyedia</a></li>
              <li class="breadcrumb-item active">Buat Penilaian</li>
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
					  <h3 class="card-title">Buat Penilaian</h3>

					  <div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						  <i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fas fa-times"></i></button>
					  </div>
					</div>
			<div class="card-body">
		

					<div class="col-lg-12 main-chart">
						<?php if(isset($_GET['success-edit'])){?>
						<div class="alert alert-success">
							<p>Edit Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Tambah Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['success-update'])){?>
						<div class="alert alert-success">
							<p>Update Data Berhasil !</p>
						</div>
						<?php }?>

            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  <form action="" id="invoice-form" method="post" class="form-horizontal" role="form" novalidate="" enctype="multipart/form-data" > 
             
                <div class="card-body">
										  <div class="form-group row">
											<label class="col-sm-3 col-form-label">Unor</label>
											<div class="col-sm-9">
												<select name="unor" id="unor" class="form-control select2" style="width:100%;" data-live-search="true" >
													<option value="<?php echo $data['unor']; ?>"><?php echo $data['unor']; ?></option>
														<?php
														foreach($itemUnor as $ur)
															{
														?>
													<option value="<?php echo $ur['nama_lengkap'];?>">
														<?php echo $ur['nama_lengkap'];?>
													</option>
														<?php
															}
															?>
												</select>						  
											</div>
										  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Penyedia Jasa</label>
                    <div class="col-sm-9">
						<select name="penyedia_jasa" id="penyedia_jasa" class="select2 form-control" data-live-search="true" >
							<option value="<?php echo $data['penyedia_jasa']; ?>"><?php echo $data['penyedia_jasa']; ?></option>
								<?php
								foreach($itemPenyedia as $penyedia)
									{
								?>
								<option value="<?php echo $penyedia['nama'];?>">
								<?php echo $penyedia['nama'];?>
								</option>
								<?php
									}
								?>
						</select>

                    </div>
                  </div>


                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Kegiatan / Paket</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="<?php echo $data['nama_kegiatan']; ?>" required="required">
                    </div>
                  </div>										  

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No. Kontrak</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="no_kontrak" name="no_kontrak" value="<?php echo $data['no_kontrak']; ?>" required="required">
                    </div>
                  </div>				  

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Kontrak</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="tgl_kontrak" name="tgl_kontrak" value="<?php echo $data['tgl_kontrak']; ?>" required="required">
                    </div>
                  </div>				  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nilai. Kontrak</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nilai_kontrak" name="nilai_kontrak" value="<?php echo $data['nilai_kontrak']; ?>" required="required">
                    </div>
                  </div>										

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">tanggal SPMK</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="tgl_spmk" name="tgl_spmk" value="<?php echo $data['tgl_spmk']; ?>" required="required">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Waktu Pelaksanaan</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="waktu_pelaksanaan" name="waktu_pelaksanaan" value="<?php echo $data['waktu_pelaksanaan']; ?>" required="required">
                    </div>
					<label class="col-sm-3 col-form-label">Hari</label>
					
                  </div>				  

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tgl PHO</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="pho" name="pho" value="<?php echo date('d / m / Y',strtotime("+" .$data['waktu_pelaksanaan']. " days",strtotime($data['tgl_spmk'])));?>	" required="required">
                    </div>
                  </div>	

										  <div class="form-group row">
											<label class="col-sm-3 col-form-label">Persiapan (Mobilisasi) s/d:</label>
											<div class="col-sm-3">
											  <input type="date" class="form-control" name="persiapan_m" value="<?php echo $data['tgl_spmk']; ?>">
											</div>
											<div class="col-sm-3">
											  <input type="text" class="form-control" name="persiapan_s" value="<?php echo date('d / m / Y',strtotime("+59 days",strtotime($data['tgl_spmk'])));?>">
											</div>
										  </div>

										  <div class="form-group row">
											<label class="col-sm-3 col-form-label">Pelaksanaan</label>
											<div class="col-sm-3">
											  <input type="text" class="form-control" name="pelaksanaan_m" value="<?php echo date('d / m / Y',strtotime("+60 days",strtotime($data['tgl_spmk'])));?>">
											</div>
											<div class="col-sm-3">
											  <input type="text" class="form-control" name="pelaksanaan_s" value="<?php echo date('d / m / Y',strtotime("+149 days",strtotime($data['tgl_spmk'])));?>">
											</div>
										  </div>

										  <div class="form-group row">
											<label class="col-sm-3 col-form-label">Penyelesaian Masa Pelaksanaan</label>
											<div class="col-sm-3">
											  <input type="text" class="form-control" name="penyelesaian_m" value="<?php echo date('d / m / Y',strtotime("+150 days",strtotime($data['tgl_spmk'])));?>">
											</div>
											<div class="col-sm-3">
											  <input type="text" class="form-control" name="penyelesaian_s" value="<?php echo date('d / m / Y',strtotime("+" .$data['waktu_pelaksanaan']. " days",strtotime($data['tgl_spmk'])));?>	">
											</div>
										  </div>									

										  <div class="form-group row">
											<label class="col-sm-3 col-form-label">Periode Penilaian</label>
											<div class="col-sm-3">
											  <input type="text" class="form-control" name="periode_m" value="<?php
$time = strtotime($pen3['periode_m']);
//echo $pen3['periode_m'];
echo date("Y-m-d", strtotime('first day of this month',strtotime('+1 month',$time)));	
/* 
 $tgl = date ('d',strtotime($data['tgl_spmk']));
 //echo $tgl
 // this format is string comparable

if ($tgl > '15') {
    //echo 'greater than';
	echo date('Y-m-d', strtotime('first day of next month',strtotime($data['tgl_spmk'])));
}else{
    //echo 'Less than';
echo date('Y-m-d', strtotime($data['tgl_spmk']));
	
}
*/
?>">
											</div>
											<div class="col-sm-3">
											  <input type="text" class="form-control" name="periode_s" value="<?php

$time = strtotime($pen3['periode_m']);
//echo $time;
echo date("Y-m-d", strtotime('last day of this month',strtotime('+1 month',$time)));											  
 //$tgl = date ('d',strtotime($data['tgl_spmk']));
 //$bln=$_GET['bln']+1;
 //echo $bln;
 //echo date('Y-m-d',strtotime('last day of this month', strtotime('+'+'$bln'+'month', strtotime($data['tgl_spmk']))));
 //echo $tgl
 // this format is string comparable
/*
if ($tgl > '15') {
    //echo 'greater than';
	echo date('Y-m-d', strtotime('last day of next month',strtotime($data['tgl_spmk'])));
}else{
    //echo 'Less than';
	echo date('Y-m-d', strtotime('last day of this month',strtotime($data['tgl_spmk'])));
}
*/
?>">
											</div>
										  </div>	
				<!--
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Bulan Ke-</label>
                    <div class="col-sm-2">
						<select name="bulan_ke" id="bulan_ke" class="select2 form-control" data-live-search="true" >
							<option value="0">Pilih bulan</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>

						</select>

                    </div>
                  </div>
				-->
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Bulan Ke-</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="bulan_ke" name="bulan_ke" value="<?php $bln=$_GET['bln']+1; echo $bln; ?>" required="required" readonly>
                    </div>
                  </div>



                </div>
                <!-- /.card-body -->
				                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header bg-danger text-white">A. Aspek Kinerja ( Persiapan )</div>
                                    <div class="card-body">
<!--------------->
<input type="hidden" class="form-control" id="bobot_a1" name="bobot_a1" >
<input type="hidden" class="form-control" id="total_a1" name="total_a1" >
<input type="hidden" class="form-control" id="bobot_a11" name="bobot_a11" value="<?php echo $pen['a1_bobot'];?>" >
<input type="hidden" class="form-control" id="total_a11" name="total_a11" value="<?php echo $pen['a1_total'];?>">
										 <div class="form-group row">
										
                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="ca1" onclick="myFunction()" name="inline-checkbox1" class="form-check-input" checked disabled>Pengajuan Jadwal Pelaksanaan Pekerjaan sesuai dengan jadwal
                                                        </label>
													</div>	

											<!--<label class="col-sm-6 col-form-label">Pengajuan Jadwal Pelaksanaan Pekerjaan sesuai dengan jadwal</label>-->
											
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons" >
												<!--		
												  <label class="btn bg-olive active" id="ya1" >
													<input type="radio" name="a1"> Ya
												  </label>
												  <label class="btn bg-olive" id="tidak1" >
													<input type="radio" name="a1" > Tidak
												  </label>
												-->  
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_a11" name="nilai_a11" value="<?php echo $pen['a1'];?>">
											  <input type="hidden" class="form-control" id="nilai_a1" name="nilai_a1" value="<?php echo $pen['a1'];?>">
											</div>
										  </div>
										 <div class="form-group row">	
													

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label">
                                                            <input type="checkbox" id="ca2" onclick="myFunction()" name="inline-checkbox1" class="form-check-input" checked disabled>Pengajuan laporan Kajian Teknis sesuai dengan jadwal
                                                        </label>
													</div>
																 
										 
											<!--<label class="col-sm-6 col-form-label">Pengajuan laporan Kajian Teknis sesuai dengan jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												<!--
												  <label class="btn bg-olive active" id="a2">
													<input type="radio" name="options" autocomplete="off"> Ya
												  </label>
												  <label class="btn bg-olive" id="ta2">
													<input type="radio" name="options" autocomplete="off"> Tidak
												  </label>
												 --> 
												</div>
											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_a21"  onkeyup="total1();" name="nilai_a21" value="<?php echo $pen['a2'];?>" >
											  <input type="hidden" class="form-control" id="nilai_a2"  onkeyup="total1();" name="nilai_a2" value="<?php echo $pen['a2'];?>" >
											  <!--<input type="text" class="form-control" id="harga_satuan1" alt="" name="harga_satuan1" onkeyup="total();" required="required">-->
											</div>
										  </div>
										 <div class="form-group row">
											
											<!--<label class="col-sm-6 col-form-label">Pengajuan Program Mutu sesuai dengan jadwal</label>-->
                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label">
                                                            <input type="checkbox" id="ca3" onclick="myFunction()" name="inline-checkbox1" class="form-check-input" checked disabled>Pengajuan Program Mutu sesuai dengan jadwal
                                                        </label>
													</div>
											
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												<!--
												  <label class="btn bg-olive active" id="a3">
													<input type="radio" name="options" onkeyup="jumlah()" autocomplete="off"> Ya
												  </label>
												  <label class="btn bg-olive" id="ta3">
													<input type="radio" name="options" onkeyup="jumlah()" autocomplete="off"> Tidak
												  </label>
												-->	
												</div>
											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_a31" alt="" name="nilai_a31" value="<?php echo $pen['a3'];?>" >
											   <input type="hidden" class="form-control" id="nilai_a3" alt="" name="nilai_a3" value="<?php echo $pen['a3'];?>" >
											</div>
										  </div>
										  
										 <div class="form-group row">
										 
											<!--<label class="col-sm-6 col-form-label">Pelaksanaan Mobilisasi sesuai dengan jadwal</label>-->

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label">
                                                            <input type="checkbox" id="ca4" onclick="myFunction()" name="inline-checkbox1" class="form-check-input" checked disabled>Pelaksanaan Mobilisasi sesuai dengan jadwal
                                                        </label>
													</div>
											
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												<!--
												  <label class="btn bg-olive active" id="a4">
													<input type="radio" name="options" autocomplete="off"> Ya
												  </label>
												  <label class="btn bg-olive" id="ta4">
													<input type="radio" name="options" autocomplete="off"> Tidak
												  </label>
												-->
												</div>
											</div>
										   <div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_a41" alt="" name="nilai_a41" value="<?php echo $pen['a4'];?>" >
											  <input type="hidden" class="form-control" id="nilai_a4" alt="" name="nilai_a4" value="<?php echo $pen['a4'];?>" >
											</div>
										  </div>
										  <!--
											<div class="col-sm-3">
											  <input type="text" class="form-control" id="nilai_a5" alt="" name="nilai_a5"  >
											</div>
											-->


<!-- ----------->
                                    </div>
                                </div>
                            </div>
							</div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header bg-danger text-white">B. Aspek Kinerja ( Pelaksanaan Pekerjaan )</div>
                                    <div class="card-body">
<!--------------->
<input type="hidden" class="form-control" id="bobot_b1" name="bobot_b1" >
<input type="hidden" class="form-control" id="total_b1" name="total_b1" >

										 <div class="form-group row">
                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb1" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengajuan Shop Drawing sesuai dengan jadwal
                                                        </label>
													</div>											 
										 
											<!--<label class="col-sm-6 col-form-label">Pengajuan Shop Drawing sesuai dengan jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt1">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b1" name="nilai_b1" >
											</div>
										  </div>

										 <div class="form-group row">
                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb2" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengajuan uji bahan sesuai dengan jadwal
                                                        </label>
													</div>											 

											<!--<label class="col-sm-6 col-form-label">Pengajuan uji bahan sesuai dengan jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt2">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b2" onkeyup="total1();" name="nilai_b2" >
											</div>
										  </div>

										 <div class="form-group row">
                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb3" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengajuan Request sesuai dengan jadwal
                                                        </label>
													</div>											 




											<!--<label class="col-sm-6 col-form-label">Pengajuan Request sesuai dengan jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt3">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b3" onkeyup="total1();" name="nilai_b3" >
											</div>
										  </div>										  

										 <div class="form-group row">
                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb4" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Jumlah dan kualifikasi pekerja sesuai dengan Request
                                                        </label>
													</div>



											<!--<label class="col-sm-6 col-form-label">Jumlah dan kualifikasi pekerja sesuai dengan Request</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt4">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b4" onkeyup="total1();" name="nilai_b4" >
											</div>
										  </div>

										 <div class="form-group row">
                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb5" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Jumlah, Jenis, dan kapasitas alat sesuai dengan Request
                                                        </label>
													</div>



											<!--<label class="col-sm-6 col-form-label">Jumlah, Jenis, dan kapasitas alat sesuai dengan Request</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt5">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b5" onkeyup="total1();" name="nilai_b5" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb6" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Kualitas dan kuantitas pasokan bahan sesuai dengan Request
                                                        </label>
													</div>



											<!--<label class="col-sm-6 col-form-label">Kualitas dan kuantitas pasokan bahan sesuai dengan Request</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt6">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b6" onkeyup="total1();" name="nilai_b6" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb7" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Volume hasil pekerjaan sesuai dengan target
                                                        </label>
													</div>


											<!--<label class="col-sm-6 col-form-label">Volume hasil pekerjaan sesuai dengan target</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt7">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b7" onkeyup="total1();" name="nilai_b7" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb8" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Tidak terjadi masalah pada peralatan
                                                        </label>
													</div>

											<!--<label class="col-sm-6 col-form-label">Tidak terjadi masalah pada peralatan</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt8">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b8" onkeyup="total1();" name="nilai_b8" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb9" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Tidak terjadi masalah dalam penyediaan bahan
                                                        </label>
													</div>


											<!--<label class="col-sm-6 col-form-label">Tidak terjadi masalah dalam penyediaan bahan</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt9">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b9" onkeyup="total1();" name="nilai_b9" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb10" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Tidak terjadi perbaikan pekerjaan akibat kegagalan hasil pekerjaan atau uji hasil pekerjaan tidak memenuhi syarat
                                                        </label>
													</div>




											<!--<label class="col-sm-6 col-form-label">Tidak terjadi perbaikan pekerjaan akibat kegagalan hasil pekerjaan atau uji hasil pekerjaan tidak memenuhi syarat</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt10">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b10" onkeyup="total1();" name="nilai_b10" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb11" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Kelengkapan K3 untuk pekerja Terpenuhi
                                                        </label>
													</div>

											<!--<label class="col-sm-6 col-form-label">Kelengkapan K3 untuk pekerja Terpenuhi</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt11">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b11" onkeyup="total1();" name="nilai_b11" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb12" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengendalian Lalu Lintas terpenuhi
                                                        </label>
													</div>


											<!--<label class="col-sm-6 col-form-label">Pengendalian Lalu Lintas terpenuhi</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt12">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b12" onkeyup="total1();" name="nilai_b12" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb13" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Tidak terjadi kecelakaan kerja
                                                        </label>
													</div>


											<!--<label class="col-sm-6 col-form-label">Tidak terjadi kecelakaan kerja</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt13">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b13" onkeyup="total1();" name="nilai_b13" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb14" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Tidak menerima surat teguran berkaitan dengan pelaksanaan pekerjaan
                                                        </label>
													</div>


											<!--<label class="col-sm-6 col-form-label">Tidak menerima surat teguran berkaitan dengan pelaksanaan pekerjaan</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt14">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b14" onkeyup="total1();" name="nilai_b14" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb15" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Sosialisasi/Pemberitahuan ke lingkungan sekitar pekerjaan dilakukan
                                                        </label>
													</div>


											<!--<label class="col-sm-6 col-form-label">Sosialisasi/Pemberitahuan ke lingkungan sekitar pekerjaan dilakukan</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt15">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b15" onkeyup="total1();" name="nilai_b15" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb16" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Tidak ada Komplain/Permasalahan dengan Lingkungan sekitar
                                                        </label>
													</div>


											<!--<label class="col-sm-6 col-form-label">Tidak ada Komplain/Permasalahan dengan Lingkungan sekitar</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt16">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b16" onkeyup="total1();" name="nilai_b16" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cb17" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Progres Item Pekerjaan tidak mengalami keterlambatan
                                                        </label>
													</div>

											<!--<label class="col-sm-6 col-form-label">Progres Item Pekerjaan tidak mengalami keterlambatan</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="b1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="bt17">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_b17" onkeyup="total1();" name="nilai_b17" >
											</div>
										  </div>










<!-- ----------->
                                    </div>
                                </div>
                            </div>
							</div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header bg-danger text-white">C. Aspek Kinerja ( Progres dan Pelaporan )</div>
                                    <div class="card-body">
<!--------------->
<input type="hidden" class="form-control" id="bobot_c1" name="bobot_c1" >
<input type="hidden" class="form-control" id="total_c1" name="total_c1" >

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cc1" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Progres Pekerjaan Tidak mengalami keterlambatan
                                                        </label>
													</div>


											<!--<label class="col-sm-6 col-form-label">Progres Pekerjaan Tidak mengalami keterlambatan</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="c1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="ct1">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_c1" name="nilai_c1" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cc2" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Tidak dalam kontrak kritis
                                                        </label>
													</div>



											<!--<label class="col-sm-6 col-form-label">Tidak dalam kontrak kritis</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="c1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="ct2">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_c2" name="nilai_c2" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cc3" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengajuan Laporan Harian sesuai dengan jadwal
                                                        </label>
													</div>



											<!--<label class="col-sm-6 col-form-label">Pengajuan Laporan Harian sesuai dengan jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="c1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="ct3">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_c3" name="nilai_c3" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cc4" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengajuan Back Up Kualitas sesuai dengan jadwal
                                                        </label>
													</div>



											<!--<label class="col-sm-6 col-form-label">Pengajuan Back Up Kualitas sesuai dengan jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="c1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="ct4">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_c4" name="nilai_c4" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cc5" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengajuan Back Up Kuantitas sesuai dengan jadwal
                                                        </label>
													</div>



											<!--<label class="col-sm-6 col-form-label">Pengajuan Back Up Kuantitas sesuai dengan jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="c1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="ct5">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_c5" name="nilai_c5" >
											</div>
										  </div>

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cc6" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengajuan MC sesuai dengan jadwal
                                                        </label>
													</div>



											<!--<label class="col-sm-6 col-form-label">Pengajuan MC sesuai dengan jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="c1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="ct6">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_c6" name="nilai_c6" >
											</div>
										  </div>										  
<!-- ----------->
                                    </div>
                                </div>
                            </div>
							</div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header bg-danger text-white">D. Aspek Kinerja ( Penyelesaian Masa Pelaksanaan )</div>
                                    <div class="card-body">
<!--------------->
<input type="hidden" class="form-control" id="bobot_d1" name="bobot_d1" >
<input type="hidden" class="form-control" id="total_d1" name="total_d1" >

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cd1" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Tidak melewati masa pelaksanaan
                                                        </label>
													</div>
	

											<!--<label class="col-sm-6 col-form-label">Tidak melewati masa pelaksanaan</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="d1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="dt1">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_d1" name="nilai_d1" >
											</div>
										  </div>	

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cd2" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Tidak terjadi perubahan signifikan antara kuantitas hasil Kajian Teknis dengan kuantitas akhir
                                                        </label>
													</div>


											<!--<label class="col-sm-6 col-form-label">Tidak terjadi perubahan signifikan antara kuantitas hasil Kajian Teknis dengan kuantitas akhir</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="d1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="dt2">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_d2" name="nilai_d2" >
											</div>
										  </div>	

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cd3" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengajuan As Built Drawing sesuai dengan jadwal
                                                        </label>
													</div>

											<!--<label class="col-sm-6 col-form-label">Pengajuan As Built Drawing sesuai dengan jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="d1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="dt3">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_d3" name="nilai_d3" >
											</div>
										  </div>	

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cd4" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengajuan Pernyataan Akhir pekerjaan (lengkap dengan back up) sesuai dengan jadwal
                                                        </label>
													</div>

											<!--<label class="col-sm-6 col-form-label">Pengajuan Pernyataan Akhir pekerjaan (lengkap dengan back up) sesuai dengan jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="d1">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="dt4">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_d4" name="nilai_d4" >
											</div>
										  </div>	

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cd5" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengajuan Jaminan Pemeliharaan Sesuai jadwal
                                                        </label>
													</div>
	
											<!--<label class="col-sm-6 col-form-label">Pengajuan Jaminan Pemeliharaan Sesuai jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="d5">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="dt5">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_d5" name="nilai_d5" >
											</div>
										  </div>	

										 <div class="form-group row">

                                                    <div class="form-check-inline form-check col-sm-6 ">
                                                        <label for="inline-checkbox1" class="form-check-label ">
                                                            <input type="checkbox" id="cd6" onclick="myFunction()" name="inline-checkbox1" class="form-check-input">Pengajuan Jadwal Pemeliharaan sesuai jadwal
                                                        </label>
													</div>

											<!--<label class="col-sm-6 col-form-label">Pengajuan Jadwal Pemeliharaan sesuai jadwal</label>-->
											<div class="col-sm-3">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  <label class="btn bg-olive active" id="d6">
													<input type="radio" name="options"> Ya
												  </label>
												  <label class="btn bg-olive" id="dt6">
													<input type="radio" name="options"> Tidak
												  </label>
												</div>

											</div>
											<div class="col-sm-1">
											  <input type="text" class="form-control" id="nilai_d6" onkeyup="total1();" name="nilai_d6" >
												
											  
											</div>
										  </div>	
<!-- ----------->
                                    </div>
                                </div>
                            </div>
							</div>				
				
				
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
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
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
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

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>

<script>
$(document).ready(function() {
/*	
	 var bobot= '61.54';
	 var x = '16';
	 var nilai=bobot/x;
	
*/
//var nilaib=document.getElementByName("nilai_b").value;
	/*
	$("#b1").click(function() {
	  $("#nilai_b1").val(nilai);
	  //$("#nilai_a5").val(nilai2);
  })
*/ 

  $("#tidak1").click(function() {
	  $("#nilai_a1").val(0);
  })
  $("#ta2").click(function() {
	  $("#nilai_a2").val(0);
  })
  $("#ta3").click(function() {
	  $("#nilai_a3").val(0);
  })
  $("#ta4").click(function() {
	  $("#nilai_a4").val(0);
  })  
  $("#bt1").click(function() {
	  $("#nilai_b1").val(0);
  })
  $("#bt2").click(function() {
	  $("#nilai_b2").val(0);
  })

  $("#bt3").click(function() {
	  $("#nilai_b3").val(0);
  })

  $("#bt4").click(function() {
	  $("#nilai_b4").val(0);
  })

  $("#bt5").click(function() {
	  $("#nilai_b5").val(0);
  })  
  $("#bt6").click(function() {
	  $("#nilai_b6").val(0);
  }) 
  $("#bt7").click(function() {
	  $("#nilai_b7").val(0);
  }) 
  $("#bt8").click(function() {
	  $("#nilai_b8").val(0);
  }) 
  $("#bt9").click(function() {
	  $("#nilai_b9").val(0);
  }) 
  $("#bt10").click(function() {
	  $("#nilai_b10").val(0);
  }) 
  $("#bt11").click(function() {
	  $("#nilai_b11").val(0);
  }) 
  $("#bt12").click(function() {
	  $("#nilai_b12").val(0);
  }) 
  $("#bt13").click(function() {
	  $("#nilai_b13").val(0);
  }) 
  $("#bt14").click(function() {
	  $("#nilai_b14").val(0);
  }) 
  $("#bt15").click(function() {
	  $("#nilai_b15").val(0);
  }) 
  $("#bt16").click(function() {
	  $("#nilai_b16").val(0);
  }) 
  $("#bt17").click(function() {
	  $("#nilai_b17").val(0);
  }) 
  
  $("#ct1").click(function() {
	  $("#nilai_c1").val(0);
  })
  $("#ct2").click(function() {
	  $("#nilai_c2").val(0);
  })
  $("#ct3").click(function() {
	  $("#nilai_c3").val(0);
  })
  $("#ct4").click(function() {
	  $("#nilai_c4").val(0);
  })
  $("#ct5").click(function() {
	  $("#nilai_c5").val(0);
  })
  $("#ct6").click(function() {
	  $("#nilai_c6").val(0);
  })

  $("#dt1").click(function() {
	  $("#nilai_d1").val(0);
  })
  $("#dt2").click(function() {
	  $("#nilai_d2").val(0);
  })
  $("#dt3").click(function() {
	  $("#nilai_d3").val(0);
  })
  $("#dt4").click(function() {
	  $("#nilai_d4").val(0);
  })
  $("#dt5").click(function() {
	  $("#nilai_d5").val(0);
  })
  $("#dt6").click(function() {
	  $("#nilai_d6").val(0);
  }) 
  
})
</script>


<script>
function myFunction() {
  // Get the checkbox a1
	var cBa1 = document.getElementById("ca1");  
	var cBa2 = document.getElementById("ca2");
	var cBa3 = document.getElementById("ca3");  
	var cBa4 = document.getElementById("ca4");  
	
	
  // Get the checkbox b1
	var cBb1 = document.getElementById("cb1");
	var cBb2 = document.getElementById("cb2");
	var cBb3 = document.getElementById("cb3");
	var cBb4 = document.getElementById("cb4");
	var cBb5 = document.getElementById("cb5");
	var cBb6 = document.getElementById("cb6");
	var cBb7 = document.getElementById("cb7");
	var cBb8 = document.getElementById("cb8");
	var cBb9 = document.getElementById("cb9");
	var cBb10 = document.getElementById("cb10");
	var cBb11 = document.getElementById("cb11");
	var cBb12 = document.getElementById("cb12");
	var cBb13 = document.getElementById("cb13");
	var cBb14 = document.getElementById("cb14");
	var cBb15 = document.getElementById("cb15");
	var cBb16 = document.getElementById("cb16");
	var cBb17 = document.getElementById("cb17");

  // Get the checkbox c1
	var cBc1 = document.getElementById("cc1");
	var cBc2 = document.getElementById("cc2");
	var cBc3 = document.getElementById("cc3");
	var cBc4 = document.getElementById("cc4");
	var cBc5 = document.getElementById("cc5");
	var cBc6 = document.getElementById("cc6");

  // Get the checkbox d1
	var cBd1 = document.getElementById("cd1");
	var cBd2 = document.getElementById("cd2");
	var cBd3 = document.getElementById("cd3");
	var cBd4 = document.getElementById("cd4");
	var cBd5 = document.getElementById("cd5");
	var cBd6 = document.getElementById("cd6");
 	
  // Get the output a1
  
  if (cBa1.checked == true){
    nilai_cBa1 = "1";
  } else {
    nilai_cBa1 = "0";
  }

  if (cBa2.checked == true){
    nilai_cBa2 = "1";
  } else {
    nilai_cBa2 = "0";
  }

  if (cBa3.checked == true){
    nilai_cBa3 = "1";
  } else {
    nilai_cBa3 = "0";
  }
  
  if (cBa4.checked == true){
    nilai_cBa4 = "1";
  } else {
    nilai_cBa4 = "0";
  }

  // Get the checkbox b ==============================================
  if (cBb1.checked == true){
    nilai_cBb1 = "1";
  } else {
    nilai_cBb1 = "0";
  } 

  if (cBb2.checked == true){
    nilai_cBb2 = "1";
  } else {
    nilai_cBb2 = "0";
  } 

  if (cBb3.checked == true){
    nilai_cBb3 = "1";
  } else {
    nilai_cBb3 = "0";
  } 

  if (cBb4.checked == true){
    nilai_cBb4 = "1";
  } else {
    nilai_cBb4 = "0";
  } 

  if (cBb5.checked == true){
    nilai_cBb5 = "1";
  } else {
    nilai_cBb5 = "0";
  }
  
  if (cBb6.checked == true){
    nilai_cBb6 = "1";
  } else {
    nilai_cBb6 = "0";
  }
  
  if (cBb7.checked == true){
    nilai_cBb7 = "1";
  } else {
    nilai_cBb7 = "0";
  }
  
  if (cBb8.checked == true){
    nilai_cBb8 = "1";
  } else {
    nilai_cBb8 = "0";
  }
  
  if (cBb9.checked == true){
    nilai_cBb9 = "1";
  } else {
    nilai_cBb9 = "0";
  }
  
  if (cBb10.checked == true){
    nilai_cBb10 = "1";
  } else {
    nilai_cBb10 = "0";
  }
  
  if (cBb11.checked == true){
    nilai_cBb11 = "1";
  } else {
    nilai_cBb11 = "0";
  }
  
  if (cBb12.checked == true){
    nilai_cBb12 = "1";
  } else {
    nilai_cBb12 = "0";
  }
  
  if (cBb13.checked == true){
    nilai_cBb13 = "1";
  } else {
    nilai_cBb13 = "0";
  }
  
  if (cBb14.checked == true){
    nilai_cBb14 = "1";
  } else {
    nilai_cBb14 = "0";
  }

  if (cBb15.checked == true){
    nilai_cBb15 = "1";
  } else {
    nilai_cBb15 = "0";
  }
  
  if (cBb16.checked == true){
    nilai_cBb16 = "1";
  } else {
    nilai_cBb16 = "0";
  }
  
  if (cBb17.checked == true){
    nilai_cBb17 = "1";
  } else {
    nilai_cBb17 = "0";
  }

  // Get the checkbox c ==============================================
  if (cBc1.checked == true){
    nilai_cBc1 = "1";
  } else {
    nilai_cBc1 = "0";
  } 

  if (cBc2.checked == true){
    nilai_cBc2 = "1";
  } else {
    nilai_cBc2 = "0";
  } 

  if (cBc3.checked == true){
    nilai_cBc3 = "1";
  } else {
    nilai_cBc3 = "0";
  } 

  if (cBc4.checked == true){
    nilai_cBc4 = "1";
  } else {
    nilai_cBc4 = "0";
  } 

  if (cBc5.checked == true){
    nilai_cBc5 = "1";
  } else {
    nilai_cBc5 = "0";
  }
  
  if (cBc6.checked == true){
    nilai_cBc6 = "1";
  } else {
    nilai_cBc6 = "0";
  }

  // Get the checkbox d ==============================================
  if (cBd1.checked == true){
    nilai_cBd1 = "1";
  } else {
    nilai_cBd1 = "0";
  } 

  if (cBd2.checked == true){
    nilai_cBd2 = "1";
  } else {
    nilai_cBd2 = "0";
  } 

  if (cBd3.checked == true){
    nilai_cBd3 = "1";
  } else {
    nilai_cBd3 = "0";
  } 

  if (cBd4.checked == true){
    nilai_cBd4 = "1";
  } else {
    nilai_cBd4 = "0";
  } 

  if (cBd5.checked == true){
    nilai_cBd5 = "1";
  } else {
    nilai_cBd5 = "0";
  }
  
  if (cBd6.checked == true){
    nilai_cBd6 = "1";
  } else {
    nilai_cBd6 = "0";
  }  
  
  var total_a = parseInt(nilai_cBa1) + parseInt(nilai_cBa2) + parseInt(nilai_cBa3) + parseInt(nilai_cBa4);
  var total_b = parseInt(nilai_cBb1) + parseInt(nilai_cBb2) + parseInt(nilai_cBb3) + parseInt(nilai_cBb4)+ parseInt(nilai_cBb5)+ parseInt(nilai_cBb6)+ parseInt(nilai_cBb7)+ parseInt(nilai_cBb8)+ parseInt(nilai_cBb9)+ parseInt(nilai_cBb10)+ parseInt(nilai_cBb11)+ parseInt(nilai_cBb12)+ parseInt(nilai_cBb13)+ parseInt(nilai_cBb14)+ parseInt(nilai_cBb15)+ parseInt(nilai_cBb16)+ parseInt(nilai_cBb17);
  var total_c = parseInt(nilai_cBc1) + parseInt(nilai_cBc2) + parseInt(nilai_cBc3) + parseInt(nilai_cBc4)+ parseInt(nilai_cBc5)+ parseInt(nilai_cBc6);
  var total_d = parseInt(nilai_cBd1) + parseInt(nilai_cBd2) + parseInt(nilai_cBd3) + parseInt(nilai_cBd4)+ parseInt(nilai_cBd5)+ parseInt(nilai_cBd6);
  
  var total = total_a + total_b + total_c + total_d;
  
  var sub_total_a = 100/total*total_a;
  var sub_total_b = 100/total*total_b;
  var sub_total_c = 100/total*total_c;
  var sub_total_d = 100/total*total_d;
  
  nilai_aa1 = sub_total_a/total_a;
  nilai_bb1 = sub_total_b/total_b;
  nilai_cc1 = sub_total_c/total_c;
  nilai_dd1 = sub_total_d/total_d;
  
  document.getElementById('bobot_a1').value = sub_total_a.toFixed(2);
  document.getElementById('total_a1').value = total_a.toFixed(2);
  
  document.getElementById('bobot_b1').value = sub_total_b.toFixed(2);
  document.getElementById('total_b1').value = total_b.toFixed(2);  

  document.getElementById('bobot_c1').value = sub_total_c.toFixed(2);
  document.getElementById('total_c1').value = total_c.toFixed(2); 

  document.getElementById('bobot_d1').value = sub_total_d.toFixed(2);
  document.getElementById('total_d1').value = total_d.toFixed(2);   
  
  document.getElementById('nilai_a1').value = nilai_aa1.toFixed(2);
  document.getElementById('nilai_a2').value = nilai_aa1.toFixed(2);
  document.getElementById('nilai_a3').value = nilai_aa1.toFixed(2);
  document.getElementById('nilai_a4').value = nilai_aa1.toFixed(2);

  document.getElementById('nilai_b1').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b2').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b3').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b4').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b5').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b6').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b7').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b8').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b9').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b10').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b11').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b12').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b13').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b14').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b15').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b16').value = nilai_bb1.toFixed(2);
  document.getElementById('nilai_b17').value = nilai_bb1.toFixed(2);

  document.getElementById('nilai_c1').value = nilai_cc1.toFixed(2);
  document.getElementById('nilai_c2').value = nilai_cc1.toFixed(2);
  document.getElementById('nilai_c3').value = nilai_cc1.toFixed(2);
  document.getElementById('nilai_c4').value = nilai_cc1.toFixed(2);
  document.getElementById('nilai_c5').value = nilai_cc1.toFixed(2);
  document.getElementById('nilai_c6').value = nilai_cc1.toFixed(2);

  document.getElementById('nilai_d1').value = nilai_dd1.toFixed(2);
  document.getElementById('nilai_d2').value = nilai_dd1.toFixed(2);
  document.getElementById('nilai_d3').value = nilai_dd1.toFixed(2);
  document.getElementById('nilai_d4').value = nilai_dd1.toFixed(2);
  document.getElementById('nilai_d5').value = nilai_dd1.toFixed(2);
  document.getElementById('nilai_d6').value = nilai_dd1.toFixed(2);
} 
	
</script>	

</body>
</html>
