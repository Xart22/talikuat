<?php
session_start();
include "../src/talikuat.php";
include "../fungsi/view/tampil.php";
include('cekkonsultan.php');

if(!isset($_SESSION['nama'])){
	echo '<script language="javascript">alert("Anda harus Login!"); document.location="../index.php";</script>';

}
$talikuat = new talikuat();	
$tampil = new tampil();
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

if(!empty($_POST['nama_kegiatan']) && $_POST['nama_kegiatan'] && !empty($_POST['data_umum']) && $_POST['data_umum']) {	
	$talikuat->updateDataUmum($_POST);	
	//header("Location:../data_umum.php?sukses=edit-data");	
}
include "../src/item_rule.php";
	$controller = new ItemRule();
	$itemRule = $controller->itemRule();
if(!empty($_GET['data_user']) && $_GET['data_user']) {
	echo $_GET['data_user'];
	$data = $tampil->data_user_edit($_GET['data_user']);
	//$data_ruas = $talikuat->getDataUmumRuas($_GET['data_umum']);		
	//$invoiceItems = $invoice->getInvoiceItems($_GET['update_id']);	
	
}

include "../src/LogHistory.php";
$log = new LogHistory();
$menu = "Edit Pengguna";
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
			  <li class="breadcrumb-item"><a href="master_pengguna.php">Data user</a></li>
              <li class="breadcrumb-item active">Edit Data user</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info">
					<div class="card-header">
					  <h3 class="card-title">Edit Data </h3>

					  <div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						  <i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fas fa-times"></i></button>
					  </div>
					</div>
			<div class="card-body">

				<form action="../fungsi/edit/edit.php?data_user=edit" method="post"> 
				 <div class="form-group row">
				 <input type="hidden" readonly="readonly" class="form-control" value="<?php echo $data['id_member'];?>" name="id_member">
                    <label class="col-sm-3 col-form-label">Nama Panggilan</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="nm_member" name="nm_member" value="<?php echo $data['nm_member'];?>" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $data['nama_lengkap'];?>" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Hak Akses</label>
                    <div class="col-sm-8">
                      	<select name="akses" id="akses" class="form-control select2" data-live-search="true" >
							<option value="<?php echo $data['akses'];?>"><?php echo $data['akses'];?></option>
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
																	<option value="<?php echo $data['perusahaan'];?>"><?php echo $data['perusahaan'];?></option>
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
							<option value="<?php echo $data['jabatan'];?>"><?php echo $data['jabatan'];?></option>
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
                      <input type="text" class="form-control" id="alamat_member" name="alamat_member" value="<?php echo $data['alamat_member'];?>" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No. Telp</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="telp" name="telp" value="<?php echo $data['telp'];?>" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">E-mail</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email'];?>" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NIP / NIK</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $data['nik'];?>" required="required" >
                    </div>
                  </div>

				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Unit/Bidang</label>
                    <div class="col-sm-8">
					    <select name="kantor_id" id="kantor_id" class="form-control select2" data-live-search="true" required="required" >
							<option value="<?php echo $data['kantor_id'];?>"><?php echo $data['kantor_id'];?></option>
							<option value="k0">PUSAT</option>
							<option value="k01">BIDANG PEMELIHARAAN DAN PEMBANGUNAN JALAN</option>
							<option value="k1">UPTD-I</option>
							<option value="k2">UPTD-II</option>
							<option value="k3">UPTD-III</option>
							<option value="k4">UPTD-IV</option>
							<option value="k5">UPTD-V</option>
							<option value="k6">UPTD-VI</option>
						</select>
                    </div>
                  </div>

			     <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal update</label>
                    <div class="col-sm-8">
                      <input type="text" readonly="readonly" class="form-control" id="tgl" name="tgl"  value="<?php echo  date("j F Y");?>" required="required" >
                    </div>
                  </div>
			
			</div>
            
			<div class="card-footer">
   														<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
														
														<input type="hidden" value="<?php echo $data['id']; ?>" class="form-control" name="data_umum" id="data_umum">
														<button class="btn btn-primary" name="btn" value="Tambah" style="border-radius:0px;"><i class="fa fa-pencil"></i> Ubah</button>
                </div>
                <!-- /.card-footer -->
				</form>
      </div>
      <!-- /.card -->


	
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


</body>
</html>
