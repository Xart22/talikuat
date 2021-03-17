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

include "../src/item_pekerjaan.php";
	$controller = new ItemList();
	$itemList = $controller->itemList();

if(!empty($_GET['req_id']) && $_GET['req_id']) {
	echo $_GET['req_id'];
	$lap_req = $talikuat->get_request($_GET['req_id']);		
	$bahan = $talikuat->get_requestbahan($_GET['req_id']);
	$peralatan = $talikuat->get_requestperalatan($_GET['req_id']);
	$tkerja = $talikuat->get_requesttkerja($_GET['req_id']);
	
}	

if(!empty($_POST['jenis_pekerjaan']) && $_POST['jenis_pekerjaan'] && !empty($_POST['reqId']) && $_POST['reqId']) {	
	$talikuat->updateRequest($_POST);	

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


        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../assets/datatables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../assets/datatables/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-2.2.3.min.js"></script>


<link rel="stylesheet" href="../css/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="../Resources/bootstrap-select/bootstrap-select.min.css" />

<script src="../Resources/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="../js/pemisah.js"></script>


<script src="../js/material.js"></script>
<script src="../js/peralatan.js"></script>
<script src="../js/hotmix.js"></script>
<script src="../js/beton.js"></script>
<script src="../js/tenaga.js"></script>
<script src="../js/cuaca.js"></script>
<script src="../js/c.js"></script>
<script src="../js/jadual.js"></script>
<script src="../js/jadual2.js"></script>

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
      <img src="../assets/img/jabar.png" alt="" class="brand-image img-circle elevation-3"
           style="opacity: .8">
	  <span class="brand-text font-weight-light">TaliKuat BimaJabar</span>   

    </a>
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
			  <li class="breadcrumb-item"><a href="permintaan.php">Data Request Pekerjaan</a></li>
              <li class="breadcrumb-item active">Edit Request Pekerjaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	
	<form action="" id="invoice-form" method="post" class="form-horizontal" role="form" novalidate="" enctype="multipart/form-data" > 

      <!-- Default box -->
     <div class="card card-danger">
					<div class="card-header">
					  <h3 class="card-title">Data Utama </h3>

					  <div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						  <i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fas fa-times"></i></button>
					  </div>
					</div>
			<div class="card-body">			
			     <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kegiatan / Paket</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="kegiatan" name="kegiatan" value="<?php echo $lap_req['nama_kegiatan'];?>" required="required">
					  <input id="unor" type="hidden" value="<?php echo $data['unor'];?>" class="form-control" name="unor">
                    </div>
                  </div>

			     <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Diajukan Tgl</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="diajukan_tgl" name="diajukan_tgl" value="<?php echo $lap_req['diajukan_tgl'];?>" required="required">
                    </div>
                  </div>

			     <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lokasi/Sta</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="lokasi_sta" name="lokasi_sta" value="<?php echo $lap_req['lokasi_sta'];?>" required="required">
                    </div>
                  </div>

			     <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Pekerjaan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jenis_pekerjaan" name="jenis_pekerjaan" value="<?php echo $lap_req['jenis_pekerjaan'];?>" required="required">
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Perkiraan Volume</label>
                    <div class="col-sm-10">   
						<div class="input-group mb-3">
						    <input type="text" class="form-control" id="perkiraan_volume" name="perkiraan_volume" value="<?php echo $lap_req['volume'];?>" required="required">
							<input id="satuan" value="<?php echo $lap_req['satuan'];?>" type="hidden" class="form-control" name="satuan">
						  <div class="input-group-append">
						  
							<span class="input-group-text"><?php echo $lap_req['satuan'];?></span>
						  </div>
						</div>
					</div>
                  </div>

			     <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Untuk Pelaksanaan Tgl</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="pelaksanaan_tgl" name="pelaksanaan_tgl" value="<?php echo $lap_req['pelaksanaan_tgl'];?>" required="required">
                    </div>
                  </div>				  

			     <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sketsa</label>
                    <div class="col-sm-10">
                     
					  <img src="../lampiran/req/<?php echo $lap_req['sketsa'];?>"  alt="#" style="width:200px;border:4px solid #ddd;"/>
                    </div>
                  </div>				  

				  
			</div>
		
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->


      <!-- Default box -->
      <div class="card card-primary">
					<div class="card-header">
					  <h3 class="card-title">Bahan / Material </h3>

					  <div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						  <i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fas fa-times"></i></button>
					  </div>
					</div>
			<div class="card-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<table class="table table-bordered table-hover" id="invoiceItem1">	
										<tr>
											<th width="2%"><input id="checkAll1" class="formcontrol" type="checkbox"></th>
											<th width="38%">Bahan Digunakan</th>
											<th width="15%">Volume</th>
											<th width="15%">Satuan</th>								
										</tr>	
											<?php 
												$count = 0;
													foreach($bahan as $bahans){
												$count++;
											?>	
										
										<tr>
										<td><input class="itemRow1" type="checkbox"></td>
										<td><input type="text" value="<?php echo $bahans["bahan"]; ?>" name="bahan[]" id="bahan_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
										<td><input type="text" value="<?php echo $bahans["volume"]; ?>" name="volume_bahan[]" id="volume_bahan_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
										<td><input type="text" value="<?php echo $bahans["satuan"]; ?>" name="satuan_bahan[]" id="satuan_bahan_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
										</tr>	
											<?php } ?>	
										
									</table>
								</div>
							</div>								
							<div class="row">
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<button class="btn btn-danger delete" id="removeRows1" type="button">- Delete</button>
									<button class="btn btn-success" id="addRows1" type="button">+ Add More</button>
								</div>
							</div>
									
					
			</div>
		
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

      <!-- Default box -->
      <div class="card card-primary">
					<div class="card-header">
					  <h3 class="card-title">Peralatan </h3>

					  <div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						  <i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fas fa-times"></i></button>
					  </div>
					</div>
			<div class="card-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									
								<table class="table table-bordered table-hover" id="invoiceItem3">	
									<tr>
										<th width="2%"><input id="checkAll3" class="formcontrol" type="checkbox"></th>
										<th width="38%">Jenis Peralatan</th>
										<th width="15%">Jumlah</th>
										<th width="15%">Satuan</th>								
									</tr>
									<?php 
										$count = 0;
											foreach($peralatan as $peralatans){
										$count++;
									?>										
									<tr>
						
										<td><input class="itemRow3" type="checkbox"></td>
										<td><input type="text" value="<?php echo $peralatans["jenis_peralatan"]; ?>" name="jenis_peralatan[]" id="jenis_peralatan_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
										<td><input type="text" value="<?php echo $peralatans["jumlah"]; ?>" name="jumlah_peralatan[]" id="jumlah_peralatan_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
										<td><input type="text" value="<?php echo $peralatans["satuan"]; ?>" name="satuan_peralatan[]" id="satuan_peralatan_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>

									</tr>	
									<?php } ?>						
								</table>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<button class="btn btn-danger delete" id="removeRows3" type="button">- Delete</button>
									<button class="btn btn-success" id="addRows3" type="button">+ Add More</button>
								</div>
							</div>	
									
					
			</div>
		
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

      <!-- Default box -->
      <div class="card card-primary">
					<div class="card-header">
					  <h3 class="card-title">Tenaga Kerja </h3>

					  <div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						  <i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fas fa-times"></i></button>
					  </div>
					</div>
			<div class="card-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									
								<table class="table table-bordered table-hover " id="invoiceItem6">	
									<tr>
										<th width="2%"><input id="checkAll6" class="formcontrol" type="checkbox"></th>
										<th width="38%">Tenaga Kerja</th>
										<th width="15%">Jumlah</th>
									</tr>
									<?php 
										$count = 0;
											foreach($tkerja as $tkerjas){
										$count++;
									?>										
									<tr>
						
										<td><input class="itemRow6" type="checkbox"></td>
										<td><input type="text" value="<?php echo $tkerjas["tenaga_kerja"]; ?>" name="tenaga_kerja[]" id="tenaga_kerja_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
										<td><input type="text" value="<?php echo $tkerjas["jumlah"]; ?>" name="jumlah_tk[]" id="jumlah_tk_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>

									</tr>	
									<?php } ?>						
								</table>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<button class="btn btn-danger delete" id="removeRows6" type="button">- Delete</button>
									<button class="btn btn-success" id="addRows6" type="button">+ Add More</button>
								</div>
							</div>							
					
			</div>
		
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
      <!-- Default box -->
      <div class="card card-secondary">
					<div class="card-header">
					  <h3 class="card-title"> </h3>

					  <div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						  <i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fas fa-times"></i></button>
					  </div>
					</div>
			<div class="card-body">

			     <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Diajukan Oleh :</label>
                    <div class="col-sm-10">
																<select name="penyedia_jasa" id="penyedia_jasa" class="select2 form-control" data-live-search="true" >
																	<option value="<?php echo $lap_req['nama_kontraktor'];?>"><?php echo $lap_req['nama_kontraktor'];?></option>
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
                    <label class="col-sm-2 col-form-label">Diperiksa Oleh :</label>
                    <div class="col-sm-10">
																<select name="konsultan" id="konsultan" class="select2 form-control" data-live-search="true" >
																	<option value="<?php echo $lap_req['nama_direksi'];?>"><?php echo $lap_req['nama_direksi'];?></option>
																	<?php
																		foreach($itemKonsul as $konsul)
																		{
																	?>
																		<option value="<?php echo $konsul['nama'];?>">
																	<?php echo $konsul['nama'];?>
																	</option>
																	<?php
																		}
																	?>
																</select>
					</div>

					
				</div>

			    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Disetujui Oleh :</label>
                    <div class="col-sm-10">
														  		<select name="nama_ppk" id="nama_ppk" class="select2 form-control" data-live-search="true" >
																	<option value="<?php echo $lap_req['nama_ppk'];?>"><?php echo $lap_req['nama_ppk'];?></option>
																	<?php
																		foreach($itemPpk as $p)
																	{
																	?>
																	<option value="<?php echo $p['nama'];?>">
																		<?php echo $p['nama'];?>
																	</option>
																	<?php
																	}
																	?>
																</select>
					</div>

					
				</div>

			     <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Chief Inspector</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="ci" alt="" name="ci" value="<?php echo $lap_req['ci'];?>" required="required">
					</div>
                  </div>

			     <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Quality Engineer</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="qe" alt="" name="qe" value="<?php echo $lap_req['qe'];?>" required="required">
					</div>
                  </div>

				
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->	  
	            <div class="card-footer">
					<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
					<input type="hidden" value="<?php echo $lap_req['id']; ?>" class="form-control" name="reqId" id="reqId">
					<button type="submit" class="btn btn-info">Simpan</button>
                </div>
 </form>	  
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
 <script type="text/javascript" >  
    
     function disableMyText(){  
          if(document.getElementById("checkMe").checked == true){  
              document.getElementById("myText").disabled = false;  
          }else{
            document.getElementById("myText").disabled = true;
          }  
     };  
	 
	 function total() {
	 var harga_satuan1=document.getElementById('harga_satuan1').value;
	 var volume2=document.getElementById('volume1').value;
	 var nilai_kontrak1=document.getElementById('nilai_kontrak').value;
	 
	 var hasil = parseFloat(harga_satuan1) * parseFloat(volume2);
	 var hasil2 = (parseFloat(harga_satuan1)/parseFloat(nilai_kontrak1));
	 var hasil3 = parseFloat(hasil2)*100;
      if (!isNaN(hasil)) {
         document.getElementById('jumlah_harga1').value = hasil;
			}
		if (!isNaN(hasil3)) {
         document.getElementById('bobot1').value = hasil3.toFixed(2);
			}
	  
	 }		 
     </script> 

</body>
</html>
