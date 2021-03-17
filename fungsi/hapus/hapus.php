<?php
	session_start();
	require '../../konfigurasi/konek.php';
	include "../../src/LogHistory.php";

	$log = new LogHistory();

	if(!empty($_GET['kategori'])){
		$id= $_GET['id'];
		$data[] = $id;
		$sql = 'DELETE FROM kategori WHERE id_kategori=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		//Logging history
		$process = "Menghapus data kategori";
		$log->recordProcLog($process);

		echo '<script>window.location="../../index.php?page=kategori&&remove=hapus-data"</script>';
	}
	if(!empty($_GET['barang'])){
		$id= $_GET['id'];
		$data[] = $id;
		$sql = 'DELETE FROM barang WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		//Logging history
		$process = "Menghapus data kategori";
		$log->recordProcLog($process);

		echo '<script>window.location="../../index.php?page=barang&&remove=hapus-data"</script>';
	}
//-------------------------------------------------------------------------------------------------------------
	if(isset($_GET['disinstruksi'])) {
		$id = $_GET['id'];
		$sql = "DELETE FROM `master_disposisi_instruksi` WHERE id = " . $id;
		// die($sql);
		$row = $config->prepare($sql);
		$row->execute();
		
		//Logging history
		$process = "Menghapus data disposisi instruksi";
		$log->recordProcLog($process);

		echo '<script>window.location="../../admin/disposisi/disposisi_instruksi.php"</script>';
	}

	if (isset($_GET['kirimdisposisi'])) {
		$id = $_GET['id'];
		$sql = 'DELETE FROM disposisi WHERE id = ' . $id;
		$row = $config->prepare($sql);
		$row->execute();

		//Logging history
		$process = "Menghapus data kirim disposisi";
		$log->recordProcLog($process);

		echo '<script>window.location="../../admin/disposisi/kirim_disposisi.php"</script>';
	}
//-------------------------------------------------------------------------------------------------------------
	if(!empty($_GET['bahan'])){
		$id= $_GET['id'];
		$data[] = $id;
		$sql = 'DELETE FROM master_bahan WHERE id=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		//Logging history
		$process = "Menghapus data bahan";
		$log->recordProcLog($process);

		echo '<script>window.location="../../index.php?page=bahan&&remove=hapus-data"</script>';
	}
//-------------------------------------------------------------------------------------------------------------
	if(!empty($_GET['kontraktor'])){
		$id= $_GET['kontraktor'];
		$data[] = $id;
		$sql = 'DELETE FROM master_penyedia_jasa WHERE id=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		$process = "Menghapus data kontraktor";
		$log->recordProcLog($process);
		echo '<script>window.location="../../admin/master_kontraktor.php?hapus=Menghapus-data"</script>';
		
		// echo '<script>window.location="../../index.php?page=kontraktor&&remove=hapus-data"</script>';
	}

	if(!empty($_GET['konsultan'])){
		$id= $_GET['konsultan'];
		$data[] = $id;
		$sql = 'DELETE FROM master_konsultan WHERE id=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		//Logging history
		$process = "Menghapus data konsultan";
		$log->recordProcLog($process);

		echo '<script>window.location="../../admin/master_konsultan.php?hapus=Menghapus-data"</script>';
	}
	
		if(!empty($_GET['pekerjaan'])){
		$id= $_GET['pekerjaan'];
		$data[] = $id;
		$sql = 'DELETE FROM master_jenis_pekerjaan WHERE id=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		//Logging history
		$process = "Menghapus data pekerjaan";
		$log->recordProcLog($process);

		echo '<script>window.location="../../admin/master_jenis_pekerjaan.php?hapus=Menghapus-data"</script>';	}

	if(!empty($_GET['ppk'])){
		$id= $_GET['ppk'];
		$data[] = $id;
		$sql = 'DELETE FROM master_ppk WHERE id=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		//Logging history
		$process = "Menghapus data master ppk";
		$log->recordProcLog($process);

		echo '<script>window.location="../../admin/master_ppk.php?hapus=Menghapus-data"</script>';
	}
//-------------------------------------------------------------------------------------------------------------
	
	if(!empty($_GET['jual'])){
		
		$dataI[] = $_GET['brg'];
		$sqlI = 'select*from barang where id_barang=?';
		$rowI = $config -> prepare($sqlI);
		$rowI -> execute($dataI);
		$hasil = $rowI -> fetch();
		
		$jml = $_GET['jml'] + $hasil['stok'];
		
		$dataU[] = $jml;
		$dataU[] = $_GET['brg'];
		$sqlU = 'UPDATE barang SET stok =? where id_barang=?';
		$rowU = $config -> prepare($sqlU);
		$rowU -> execute($dataU);
		
		$id = $_GET['id'];
		$data[] = $id;
		$sql = 'DELETE FROM penjualan WHERE id_penjualan=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		//Logging history
		$process = "Menghapus data jual";
		$log->recordProcLog($process);

		echo '<script>window.location="../../index.php?page=jual"</script>';
	}
	if(!empty($_GET['penjualan'])){
		
		$sqlI = 'INSERT INTO nota SELECT * FROM penjualan';
		$rowI = $config -> prepare($sqlI);
		$rowI -> execute($dataI);
		
		$sql = 'DELETE FROM penjualan';
		$row = $config -> prepare($sql);
		$row -> execute();

		//Logging history
		$process = "Menghapus data penjualan";
		$log->recordProcLog($process);

		echo '<script>window.location="../../index.php?page=jual"</script>';
	}
	if(!empty($_GET['laporan'])){
		
		$sql = 'DELETE FROM nota';
		$row = $config -> prepare($sql);
		$row -> execute();

		//Logging history
		$process = "Menghapus data laporan";
		$log->recordProcLog($process);

		echo '<script>window.location="../../index.php?page=laporan&remove=hapus"</script>';
	}
