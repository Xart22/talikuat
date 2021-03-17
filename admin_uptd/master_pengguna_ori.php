<?php
session_start();
include "../src/talikuat.php";
include "../fungsi/view/tampil.php";
include('cekadmin.php');

if(!isset($_SESSION['nama'])){
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
$tampil= new tampil();
//$talikuat->checkLoggedIn();
$data_item = $talikuat->get_member();

include "../src/item_rule.php";
	$controller = new ItemRule();
	$itemRule = $controller->itemRule();

include "../src/item_penyedia_jasa.php";
	$controller = new ItemPenyedia();
	$itemPenyedia = $controller->itemPenyedia();

include "../src/item_unor.php";
	$controller = new ItemUnor();
	$itemUnor = $controller->itemUnor();

include "../src/LogHistory.php";
  $log = new LogHistory();
  $menu = "Pengguna";
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
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
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
  <?php require_once('navbar-menu.php'); ?>

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
              <li class="breadcrumb-item active">Data Pengguna</li>
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
					  <h3 class="card-title">Data Pengguna Aplikasi</h3>

					  <div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						  <i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fas fa-times"></i></button>
					  </div>
					</div>
			<div class="card-body">
		
						<?php if(isset($_GET['sukses'])){?>
						<div class="toastrDefaultSuccess">	
						</div>
						<?php }?>
						
						<?php if(isset($_GET['gagal'])){?>
						<div class="toastrDefaultError">	
						</div>
						<?php }?>
						
						<?php if(isset($_GET['besar'])){?>
						<div class="toastrDefaultWarning">	
						</div>
						<?php }?>
						
						<?php if(isset($_GET['nama'])){?>
						<div class="toastrDefaultInfo">	
						</div>
						<?php }?>
						
					<div class="col-lg-12 main-chart">

						<table>
							<tr>
								<button id="tombol-simpan" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-lg">
								Insert Data
								</button>
							</tr>
						</table>
						<br/>

							
							<table class="table table-bordered table-striped" id="example1">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<td>No.</td>
										<td>ID</td>
										<td>Nama Panggilan<br/>
											Nama Lengkap</td>
										<td>Hak Akses</td>
										<td>Alamat<br/>
											No. Telp<br/>
											Email</td>
										<td>Perusahaan</td>
										<td>Photo</td>
										<td>NIP/NIK</td>
										<td>Aksi</td>
									</tr>
								</thead>
								<tbody>
								<?php 
									$hasil = $tampil -> data_user();
									$no=1;
									foreach($hasil as $isi){
								?>
									<tr>
										<td><?php echo $no;?></td>
										<td>00<?php echo $isi['id_member'];?></td>
										<td><?php echo $isi['nm_member'];?><br/>
											<?php echo $isi['nama_lengkap'];?></td>
										<td><?php echo $isi['akses'];?></td>
										<td><?php echo $isi['alamat_member'];?><br/>
											<?php echo $isi['telp'];?><br/>
											<?php echo $isi['email'];?></td>
										<td><?php echo $isi['perusahaan'];?></td>
										
										<td><img src="../assets/img/user/<?php echo $isi['gambar'];?>"  alt="#" style="width:150px;height:100px;border:4px solid #ddd;"/></td>
										<td><?php echo $isi['nik'];?></td>
											<td>
											<input type="hidden" value="<?php echo $isi['nik'];?>" class="form-control" name="nik">
	
											<a href="edit_pengguna.php?data_user=<?php echo $isi['id_member'];?>"><span class="nav-icon fas fa-edit" style="color:red" title="Ubah Data">&nbsp;</span></a>
											<a href="../fungsi/submit/submit.php?data_user=submit&id_member=<?php echo $isi['id_member'];?>&nik=<?php echo $isi['nik'];?>&akses=<?php echo $isi['akses'];?>" title="Aktifkan Login" onclick="javascript:return confirm('aktifkan ?');"><span class="nav-icon fas fa-key" style="color:green" >&nbsp;</span></a>
											</td>
									</tr>
								<?php $no++; }?>
								</tbody>
							</table>
						
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
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Pengguna</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
				<!--<form action="" id="invoice-form" method="post" class="form-horizontal" role="form" novalidate="" enctype="multipart/form-data" >-->				
				<form action="../fungsi/tambah/tambah.php?data_user=tambah" method="post">
			     
				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Panggilan</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="nm_member" name="nm_member" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Hak Akses</label>
                    <div class="col-sm-8">
                      	<select name="akses" id="akses" class="form-control select2" data-live-search="true" >
							<option value="0">Pilih Hak Akses</option>
							<?php
								foreach($itemRule as $rule)
							{
							?>
								<option value="<?php echo $rule['rule'];?>">
							<?php echo $rule['rule'];?>
								</option>
							<?php
							}
							?>
						</select>
                    </div>
                  </div>
				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perusahaan</label>
                    <div class="col-sm-8">
																<select name="penyedia_jasa" id="penyedia_jasa" class="select2 form-control" data-live-search="true" >
																	<option value="0">Penyedia Jasa</option>
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
                    <label class="col-sm-3 col-form-label">Jabatan</label>
                    <div class="col-sm-8">

					    <select name="jabatan" id="jabatan" class="form-control select2" data-live-search="true" required="required" >
							<option value="0">Pilih Jabatan</option>
							<option value="DIREKTUR">DIREKTUR</option>
							<option value="DIREKTUR UTAMA">DIREKTUR UTAMA</option>
							<option value="GENERAL SUPERINTENDENT">GENERAL SUPERINTENDENT</option>
							<option value="SITE ENGINEERING">SITE ENGINEERING</option>
							<option value="INSPECTION ENGINEERING">INSPECTION ENGINEERING</option>
							<option value="PPK">PPK</option>
							<option value="PPTK">PPTK</option>
						</select>
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="alamat_member" name="alamat_member" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No. Telp</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="telp" name="telp" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">E-mail</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="email" name="email" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NIP / NIK</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="nik" name="nik" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Unit/Bidang</label>
                    <div class="col-sm-8">
						
						<select name="kantor_id" id="kantor_id" class="form-control select2" style="width:100%;" data-live-search="true" >
							<option value="0">Pilih Unor</option>
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
                    <label class="col-sm-3 col-form-label">Tanggal Input</label>
                    <div class="col-sm-8">
                      <input type="text" readonly="readonly" class="form-control" id="tgl" name="tgl"  value="<?php echo  date("j F Y");?>" required="required" >
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

<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- page script -->
<script>
  $(function () {
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

</body>
</html>
