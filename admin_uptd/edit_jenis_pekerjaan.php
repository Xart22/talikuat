<?php
session_start();
include "../src/talikuat.php";
include "../fungsi/view/tampil.php";
include('cekadmin.php');
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

include "../src/item_pekerjaan.php";
	$controller = new ItemList();
	$itemList = $controller->itemList();
	


if(!empty($_GET['pekerjaan']) && $_GET['pekerjaan']) {
	echo $_GET['pekerjaan'];
	$data = $tampil->jenis_pekerjaan_edit($_GET['pekerjaan']);		
}

include "../src/LogHistory.php";
$log = new LogHistory();
$menu = "Edit Jenis Pekerjaan";
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
			  <li class="breadcrumb-item"><a href="master_jenis_pekerjaan.php">Data Jenis Pekerjaan</a></li>
              <li class="breadcrumb-item active">Edit Data Jenis Pekerjaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	
	<!--<form action="" id="invoice-form" method="post" class="form-horizontal" role="form" novalidate="" enctype="multipart/form-data" > -->
	<form action="../fungsi/edit/edit.php?pekerjaan=tambah" method="post">

      <!-- Default box -->
     <div class="card card-danger">
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
				
			     <div class="form-group row">
                    <label class="col-sm-3 col-form-label">ID Pekerjaan</label>
                    <div class="col-sm-8">
                      <input type="text" readonly="readonly" class="form-control" id="id" name="id" value="<?php echo $data['id'];?>" required="required" >
                    </div>
                  </div>

			     <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Pekerjaan</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['jenis_pekerjaan'];?>" required="required" >
                    </div>
                  </div>

			     <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Satuan</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $data['satuan'];?>" required="required" >
                    </div>
                  </div>	


			     <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Update</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="tgl" name="tgl" readonly="readonly" value="<?php echo  date("j F Y");?>">
                    </div>
                  </div>
			
		</div>
		
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
  
	            <div class="card-footer">				
					<input type="hidden" value="<?php echo $data['id']; ?>" class="form-control" name="id" id="id">
					<button type="submit" class="btn btn-info">Update</button>
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
