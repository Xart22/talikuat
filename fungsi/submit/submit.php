<?php 
	session_start();
	require '../../konfigurasi/konek.php';
	include "../../src/LogHistory.php";
	$log = new LogHistory();

//---------------------------------------------------------------Laporan Harian ----------------------------------------------------------------------------
	if(!empty($_GET['laporan'])){
		$id= $_GET['id'];
		$gk1='<a href="#"><span class="fas fa-check-square" style="color:green;font-size:18px"  title="Pengajuan">&nbsp;</span></a>';
		$gk2='<a href="#"><span class="fas fa-check-square" style="color:red;font-size:18px"  title="Menunggu Persetujuan">&nbsp;</span></a>';
		$gp1='<a href="#"><span class="fas fa-check-square" style="color:red;font-size:18px"  title="Menunggu Persetujuan">&nbsp;</span></a>';
		$aksi1='disabled';
		$aksi2='';
		$aksi3='';
		$kontraktor='1';
		
		$data[] =  $kontraktor;
		$data[] = $gk1;
		$data[] = $gk2;
		$data[] = $gp1;
		$data[] = $aksi1;
		$data[] = $aksi2;
		$data[] = $aksi3;
		$data[] = $id;
		$sql = 'UPDATE master_laporan_harian set kontraktor=?, gk1=?, gk2=?, gp1=?, aksi1=?, aksi2=?, aksi3=? WHERE no_trans=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		//Logging history
		$process = "Submit master laporan harian";
		$log->recordProcLog($process);

		echo '<script>window.location="../../admin/laporan_harian.php?submit=submit-data"</script>';
	}

//---------------------------------------------------------request --------------------------------------------------------------------------------------------
	if(!empty($_GET['request'])){
		$id= $_GET['id'];
		$gk1='<a href="#"><span class="fas fa-check-square" style="color:green;font-size:18px"  title="Pengajuan">&nbsp;</span></a>';
		$gk2='<a href="#"><span class="fas fa-check-square" style="color:red;font-size:18px"  title="Menunggu Persetujuan">&nbsp;</span></a>';
		$gp1='<a href="#"><span class="fas fa-check-square" style="color:red;font-size:18px"  title="Menunggu Persetujuan">&nbsp;</span></a>';
		$aksi1='disabled';
		$aksi2='';
		$aksi3='';
		$kontraktor='1';
		
		$data[] =  $kontraktor;
		$data[] = $gk1;
		$data[] = $gk2;
		$data[] = $gp1;
		$data[] = $aksi1;
		$data[] = $aksi2;
		$data[] = $aksi3;
		$data[] = $id;
		$sql = 'UPDATE request set kontraktor=?, gk1=?, gk2=?, gp1=?, aksi1=?, aksi2=?, aksi3=? WHERE id=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		//Logging history
		$process = "Submit request";
		$log->recordProcLog($process);

		echo '<script>window.location="../../admin/permintaan.php?submit=submit-data"</script>';
	}

	if(!empty($_GET['data_user'])){
		$id_member = $_GET['id_member'];
		$nik = $_GET['nik'];
		$akses = $_GET['akses'];
		//$user='123';
		$pass='202cb962ac59075b964b07152d234b70';
		
		$data[] =  $nik;
		$data[] = $pass;
		
		$data[] = $id_member;
		$data[] = $akses;
		
		$sql = 'INSERT INTO login (user,pass,id_member,level) VALUES (?,?,?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		//Logging history
		$process = "Submit data user";
		$log->recordProcLog($process);

		echo '<script>window.location="../../admin/master_pengguna.php?sukses=submit-data"</script>';
	}


?>

