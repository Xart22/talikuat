
<?php 
session_start();
require '../../konfigurasi/konek.php';
include "../../src/LogHistory.php";
$log = new LogHistory();

if(!empty($_GET['disinstruksi'])) {
	$id = htmlentities($_POST['id']);
	$jenis_instruksi = htmlentities($_POST['instruksi']);
	$keterangan = htmlentities($_POST['keterangan']);

	$sql = "UPDATE master_disposisi_instruksi SET jenis_instruksi=?, keterangan=? WHERE id =?";
	$row = $config->prepare($sql);
	$row->BindParam(1, $jenis_instruksi);
	$row->BindParam(2, $keterangan);
	$row->BindParam(3, $id);
	$row->execute();

	if ($row->rowCount() == 0) {
		echo "Gagal";
	} else {
		//Logging history
		$process = "Mengubah Disposisi Instruksi";
		$log->recordProcLog($process);
	
		echo '<script>window.location="../../admin/disposisi/disposisi_instruksi.php"</script>';
	}

}

if(!empty($_GET['pengaturan'])){
	$nama= htmlentities($_POST['namatoko']);
	$alamat = htmlentities($_POST['alamat']);
	$kontak = htmlentities($_POST['kontak']);
	$pemilik = htmlentities($_POST['pemilik']);
	$id = '1';
	
	$data[] = $nama;
	$data[] = $alamat;
	$data[] = $kontak;
	$data[] = $pemilik;
	$data[] = $id;
	$sql = 'UPDATE toko SET nama_toko=?, alamat_toko=?, tlp=?, nama_pemilik=? WHERE id_toko = ?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah pengaturan";
	$log->recordProcLog($process);

	echo '<script>window.location="../../index.php?page=pengaturan&success=edit-data"</script>';
}

if(!empty($_GET['kategori'])){
	$nama= htmlentities($_POST['kategori']);
	$id= htmlentities($_POST['id']);
	$data[] = $nama;
	$data[] = $id;
	$sql = 'UPDATE kategori SET nama_kategori=? WHERE id_kategori=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data kategori";
	$log->recordProcLog($process);

	echo '<script>window.location="../../index.php?page=kategori/edit&kategori='.$id.'&success=edit-data"</script>';
}

if(!empty($_GET['stok'])){
	$restok = htmlentities($_POST['restok']);
	$id = htmlentities($_POST['id']);
	$dataS[] = $id;
	$sqlS = 'select*from barang WHERE id_barang=?';
	$rowS = $config -> prepare($sqlS);
	$rowS -> execute($dataS);
	$hasil = $rowS -> fetch();
	
	$stok = $restok + $hasil['stok'];
	
	$data[] = $stok;
	$data[] = $id;
	$sql = 'UPDATE barang SET stok=? WHERE id_barang=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data stok";
	$log->recordProcLog($process);

	echo '<script>window.location="../../index.php?page=barang&success-stok=stok-data"</script>';
}
//---------------------------------------------------------------------------------------------------------------------------------------
if(!empty($_GET['barang'])){
	$id = htmlentities($_POST['id']);
	$kategori = htmlentities($_POST['kategori']);
	$nama = htmlentities($_POST['nama']);
	$merk = htmlentities($_POST['merk']);
	$beli = htmlentities($_POST['beli']);
	$jual = htmlentities($_POST['jual']);
	$satuan = htmlentities($_POST['satuan']);
	$stok = htmlentities($_POST['stok']);
	$tgl = htmlentities($_POST['tgl']);
	
	$data[] = $kategori;
	$data[] = $nama;
	$data[] = $merk;
	$data[] = $beli;
	$data[] = $jual;
	$data[] = $satuan;
	$data[] = $stok;
	$data[] = $tgl;
	$data[] = $id;
	$sql = 'UPDATE barang SET id_kategori=?, nama_barang=?, merk=?, 
			harga_beli=?, harga_jual=?, satuan_barang=?, stok=?, tgl_update=?  WHERE id_barang=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data barang";
	$log->recordProcLog($process);

	echo '<script>window.location="../../index.php?page=barang/edit&barang='.$id.'&success=edit-data"</script>';
}
//-----------my-----------------

if(!empty($_GET['bahan'])){
	$id = htmlentities($_POST['id']);
	$nama = htmlentities($_POST['nama']);
	$satuan = htmlentities($_POST['satuan']);
	$tgl = htmlentities($_POST['tgl']);
	
	$data[] = $nama;
	$data[] = $satuan;
	$data[] = $tgl;
	$data[] = $id;
	$sql = 'UPDATE master_bahan SET nama_bahan=?, satuan=?, tgl_update=?  WHERE id=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data bahan";
	$log->recordProcLog($process);

	echo '<script>window.location="../../index.php?page=bahan/edit&bahan='.$id.'&success=edit-data"</script>';
}

//--------------------------------------------------------------------------------------------------
/*
if(!empty($_GET['ppk'])){
	$id = htmlentities($_POST['id']);
	$app = htmlentities($_POST['approval']);
	$catatan = htmlentities($_POST['catatan']);
	if ($app=='1') {
		$gp1='<a href="#"><span class="glyphicon glyphicon-ok-circle" style="color:green;font-size:18px"  title="Sudah di Setujui">&nbsp;</span></a>';
		$ppk1='1';
	}
	else {
		$gp1='<a href="#"><span class="glyphicon glyphicon-remove-circle" style="color:red;font-size:18px"  title="Ditolak">&nbsp;</span></a>';
		$ppk1='0';
	};
	$data[] = $gp1;
	$data[] = $catatan;
	$data[] = $ppk1;
	$data[] = $id;
	$sql = 'UPDATE master_laporan_harian SET gp1=?, catatan_ppk=?, ppk=? WHERE no_trans=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);
	echo '<script>window.location="../../index.php?page=laporan/ppk&success-update=edit-data"</script>';
}
*/

if(!empty($_GET['ppk'])){
	$id = htmlentities($_POST['id']);
	$app = htmlentities($_POST['approval']);
	$catatan = htmlentities($_POST['catatan']);
	if ($app=='1') {
		$gp1='<a href="#"><span class="fas fa-check-square" style="color:green;font-size:18px"  title="Sudah di Setujui">&nbsp;</span></a>';
		$ppk1='1';
		$aksi2='disabled';
	}
	else {
		$gp1='<a href="#"><span class="fas fa-times-circle" style="color:red;font-size:18px"  title="Ditolak">&nbsp;</span></a>';
		$ppk1='0';
		$aksi2='';
	};
	
		//========================================================
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['dokumentasi']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['dokumentasi']["type"], $allowedImageType)) {
		echo '<script>window.location="../../ppk/laporan_harian.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['dokumentasi']["size"] / 1024) > 4096) {
echo '<script>window.location="../../ppk/laporan_harian.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/lh/';
		$target_path = $target_path . basename( $_FILES['dokumentasi']['name']); 
		if (file_exists("$target_path")){ 
echo '<script>window.location="../../ppk/laporan_harian.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['dokumentasi']['tmp_name'], $target_path)){
				//post foto lama
			$dokumentasi2 = $_POST['dokumentasi2'];
			//remove foto di direktori
			unlink('../../lampiran/lh/'.$dokumentasi2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['dokumentasi']['name'];
	$data[] = $gp1;
	$data[] = $catatan;
	$data[] = $ppk1;
	$data[] = $aksi2;
	$data[] = $id;
	$sql = 'UPDATE master_laporan_harian SET foto_ppk=?, gp1=?, catatan_ppk=?, ppk=?, aksi2=? WHERE no_trans=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data master ppk";
	$log->recordProcLog($process);

	echo '<script>window.location="../../ppk/laporan_harian.php?sukses=edit-data"</script>';
}
	}
}
//========================================================================================================================


if(!empty($_GET['ppk1'])){
	$id = htmlentities($_POST['reqId']);
	$app = htmlentities($_POST['approval']);
	$catatan = htmlentities($_POST['catatan']);
	if ($app=='1') {
		$gp1='<a href="#"><span class="fas fa-check-square" style="color:green;font-size:18px"  title="Sudah di Setujui">&nbsp;</span></a>';
		$ppk1='1';
		$aksi2='disabled';
	}
	else {
		$gp1='<a href="#"><span class="fas fa-times-circle" style="color:red;font-size:18px"  title="Ditolak">&nbsp;</span></a>';
		$ppk1='0';
		$aksi2='';
	};
	
		//========================================================
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['dokumentasi']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['dokumentasi']["type"], $allowedImageType)) {
		echo '<script>window.location="../../ppk/permintaan.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['dokumentasi']["size"] / 1024) > 4096) {
echo '<script>window.location="../../ppk/permintaan.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/req/';
		$target_path = $target_path . basename( $_FILES['dokumentasi']['name']); 
		if (file_exists("$target_path")){ 
echo '<script>window.location="../../ppk/permintaan.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['dokumentasi']['tmp_name'], $target_path)){
				//post foto lama
			$dokumentasi2 = $_POST['dokumentasi2'];
			//remove foto di direktori
			unlink('../../lampiran/req/'.$dokumentasi2.'');
			//input foto
			$id = $_POST['reqId'];
			$data[] = $_FILES['dokumentasi']['name'];
	$data[] = $gp1;
	$data[] = $catatan;
	$data[] = $ppk1;
	$data[] = $aksi2;
	$data[] = $id;
	$sql = 'UPDATE request SET foto_ppk=?, gp1=?, catatan_ppk=?, ppk=?, aksi2=? WHERE id=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data ppk1";
	$log->recordProcLog($process);

	echo '<script>window.location="../../ppk/permintaan.php?sukses=edit-data"</script>';
}
	}
}
//========================================================================================================================
/*
if(!empty($_GET['konsultan'])){
	$id = htmlentities($_POST['id']);
	$app = htmlentities($_POST['approval']);
	$catatan = htmlentities($_POST['catatan']);
	if ($app=='1') {
		$gk2='<a href="#"><span class="glyphicon glyphicon-ok-circle" style="color:green;font-size:18px"  title="Sudah di Setujui">&nbsp;</span></a>';
		$konsultan1='1';
		$aksi3='';
	}
	else {
		$gk2='<a href="#"><span class="glyphicon glyphicon-remove-circle" style="color:red;font-size:18px"  title="Ditolak">&nbsp;</span></a>';
		$konsultan1='0';
		$aksi3='disabled';
	};
	$data[] = $gk2;
	$data[] = $catatan;
	$data[] = $konsultan1;
	$data[] = $aksi3;
	$data[] = $id;
	$sql = 'UPDATE master_laporan_harian SET gk2=?, catatan_konsultan=?, konsultan=?, aksi3=?  WHERE no_trans=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);
	echo '<script>window.location="../../index.php?page=laporan/konsultan&success-update=edit-data"</script>';
}
*/	

if(!empty($_GET['konsultan'])){
	$id = htmlentities($_POST['id']);
	$app = htmlentities($_POST['approval']);
	$catatan = htmlentities($_POST['catatan']);
	if ($app=='1') {
		$gk2='<a href="#"><span class="fas fa-check-square" style="color:green;font-size:18px"  title="Sudah di Setujui">&nbsp;</span></a>';
		$gk21='1';
		$aksi3='';
	}
	else {
		$gk2='<a href="#"><span class="fas fa-times-circle" style="color:red;font-size:18px"  title="Ditolak">&nbsp;</span></a>';
		$gk21='0';
		$aksi3='disabled';
		$aksi1='';
	};
	//========================================================
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['dokumentasi']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['dokumentasi']["type"], $allowedImageType)) {
		echo '<script>window.location="../../konsultan/laporan_harian.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['dokumentasi']["size"] / 1024) > 4096) {
echo '<script>window.location="../../konsultan/laporan_harian.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/lh/';
		$target_path = $target_path . basename( $_FILES['dokumentasi']['name']); 
		if (file_exists("$target_path")){ 
echo '<script>window.location="../../konsultan/laporan_harian.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['dokumentasi']['tmp_name'], $target_path)){
				//post foto lama
			$dokumentasi2 = $_POST['dokumentasi2'];
			//remove foto di direktori
			unlink('../../lampiran/lh/'.$dokumentasi2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['dokumentasi']['name'];
			
	$data[] = $gk2;
	$data[] = $catatan;
	$data[] = $gk21;
	$data[] = $aksi3;
	$data[] = $aksi1;
	$data[] = $id;
	$sql = 'UPDATE master_laporan_harian SET foto_konsultan=?, gk2=?, catatan_konsultan=?, konsultan=?, aksi3=?, aksi1=?  WHERE no_trans=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data konsultan";
	$log->recordProcLog($process);

	echo '<script>window.location="../../konsultan/laporan_harian.php?sukses=edit-data"</script>';
			
			/*
			$data[] = $_FILES['foto']['name'];
			$data[] = $id;
			$sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);
			echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
			*/
		}
	}	
	
	
	
	
	
	
	//======================================================

}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------


if(!empty($_GET['konsultan1'])){
	$id = htmlentities($_POST['reqId']);
	$app = htmlentities($_POST['approval']);
	$catatan = htmlentities($_POST['catatan']);
	if ($app=='1') {
		$gk2='<a href="#"><span class="fas fa-check-square" style="color:green;font-size:18px"  title="Sudah di Setujui">&nbsp;</span></a>';
		$gk21='1';
		$aksi3='';
	}
	else {
		$gk2='<a href="#"><span class="fas fa-times-circle" style="color:red;font-size:18px"  title="Ditolak">&nbsp;</span></a>';
		$gk21='0';
		$aksi3='disabled';
		$aksi1='';
	};
	//========================================================
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['dokumentasi']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['dokumentasi']["type"], $allowedImageType)) {
		echo '<script>window.location="../../konsultan/permintaan.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['dokumentasi']["size"] / 1024) > 4096) {
		echo '<script>window.location="../../konsultan/permintaan.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/req/';
		$target_path = $target_path . basename( $_FILES['dokumentasi']['name']); 
	if (file_exists("$target_path")){ 
		echo '<script>window.location="../../konsultan/permintaan.php?nama=edit-data"</script>';

	}elseif(move_uploaded_file($_FILES['dokumentasi']['tmp_name'], $target_path)){
				//post foto lama
			$dokumentasi2 = $_POST['dokumentasi2'];
			//remove foto di direktori
			unlink('../../lampiran/req/'.$dokumentasi2.'');
			//input foto
	}
	}
	//========================================================
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType1 = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ceklist']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ceklist']["type"], $allowedImageType1)) {
		echo '<script>window.location="../../konsultan/permintaan.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ceklist']["size"] / 1024) > 4096) {
		echo '<script>window.location="../../konsultan/permintaan.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/req/';
		$target_path = $target_path . basename( $_FILES['ceklist']['name']); 
	if (file_exists("$target_path")){ 
		echo '<script>window.location="../../konsultan/permintaan.php?nama=edit-data"</script>';

	}elseif(move_uploaded_file($_FILES['ceklist']['tmp_name'], $target_path)){
				//post foto lama
			$ceklist2 = $_POST['ceklist2'];
			//remove foto di direktori
			unlink('../../lampiran/req/'.$ceklist2.'');
			//input foto
	
	
	
	$id = $_POST['reqId'];
	$data[] = $_FILES['ceklist']['name'];
	$data[] = $_FILES['dokumentasi']['name'];		
	$data[] = $gk2;
	$data[] = $catatan;
	$data[] = $gk21;
	$data[] = $aksi3;
	$data[] = $aksi1;
	$data[] = $id;
	
	$sql = 'UPDATE request SET app_konsultan=?, foto_konsultan=?, gk2=?, catatan_konsultan=?, konsultan=?, aksi3=?, aksi1=?  WHERE id=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data konsultan1";
	$log->recordProcLog($process);
	//echo '<script>window.location="../../index.php?page=request/konsultan&success-update=edit-data"</script>';
	echo '<script>window.location="../../konsultan/permintaan.php?sukses=edit-data"</script>';
			
			/*
			$data[] = $_FILES['foto']['name'];
			$data[] = $id;
			$sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);
			echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
			*/
		}
	}	
	
	
	
	
	
	
	//======================================================

}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
if(!empty($_GET['pekerjaan'])){
	$id = htmlentities($_POST['id']);
	$nama = htmlentities($_POST['nama']);
	$satuan = htmlentities($_POST['satuan']);
	$tgl = htmlentities($_POST['tgl']);
	
	$data[] = $nama;
	$data[] = $satuan;
	$data[] = $tgl;
	$data[] = $id;
	$sql = 'UPDATE master_jenis_pekerjaan SET jenis_pekerjaan=?, satuan=?, tgl_update=?  WHERE id=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data pekerjaan";
	$log->recordProcLog($process);

	echo '<script>window.location="../../admin/master_jenis_pekerjaan.php?sukses=edit-data"</script>';
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------

if(!empty($_GET['kontraktor'])){
	$id = htmlentities($_POST['id']);
	$nama = htmlentities($_POST['nama']);
	$alamat = htmlentities($_POST['alamat']);
	$tgl = htmlentities($_POST['tgl']);
	$nama_direktur = htmlentities($_POST['nama_direktur']);
	//$nama_gs = htmlentities($_POST['nama_gs']);
	$npwp = htmlentities($_POST['npwp']);
	$telp = htmlentities($_POST['telp']);
	$bank = htmlentities($_POST['bank']);
	$no_rek = htmlentities($_POST['no_rek']);
	
	$data[] = $nama;
	$data[] = $alamat;
	$data[] = $tgl;
	$data[] = $nama_direktur;
	//$data[] = $nama_gs;
	$data[] = $npwp;
	$data[] = $telp;
	$data[] = $bank;
	$data[] = $no_rek;
	
	$data[] = $id;
	$sql = 'UPDATE master_penyedia_jasa SET nama=?, alamat=?, tgl_update=?, nama_direktur=?, npwp=?, telp=?, bank=?, no_rek=?  WHERE id=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data kontraktor";
	$log->recordProcLog($process);

	echo '<script>window.location="../../admin/master_kontraktor.php?sukses=edit-data"</script>';
}
//-------------------------------------------------------------------------------------------------------------------------------------------------------

if(!empty($_GET['data_user'])){
	$id_member = htmlentities($_POST['id_member']);
	$nm_member = htmlentities($_POST['nm_member']);
	$nama_lengkap = htmlentities($_POST['nama_lengkap']);
	$jabatan = htmlentities($_POST['jabatan']);
	$alamat_member = htmlentities($_POST['alamat_member']);
	$telp = htmlentities($_POST['telp']);
	$email = htmlentities($_POST['email']);
	$nik = htmlentities($_POST['nik']);
	$akses = htmlentities($_POST['akses']);
	$kantor_id = htmlentities($_POST['kantor_id']);
	$penyedia_jasa = htmlentities($_POST['penyedia_jasa']);
	$tgl = htmlentities($_POST['tgl']);

	$data[] = $nm_member;
	$data[] = $nama_lengkap;
	$data[] = $jabatan;
	$data[] = $alamat_member;
	$data[] = $telp;
	$data[] = $email;
	$data[] = $nik;
	$data[] = $akses;
	$data[] = $kantor_id;
	$data[] = $penyedia_jasa;
	$data[] = $tgl;
	
	$data[] = $id_member;
	$sql = 'UPDATE member SET nm_member=?, nama_lengkap=?, jabatan=?, alamat_member=?, telp=?, email=?, nik=?, akses=?, unit=?, perusahaan=?, tgl_update=?  WHERE id_member=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);
	
	$id_member = htmlentities($_POST['id_member']);
	$akses = htmlentities($_POST['akses']);	
	$data1[] = $akses;
	$data1[] = $id_member;
	$sql1 = 'UPDATE login SET level=? WHERE id_member=?';
	$row1 = $config -> prepare($sql1);
	$row1 -> execute($data1);

	//Logging history
	$process = "Mengubah data user";
	$log->recordProcLog($process);

	echo '<script>window.location="../../admin/master_pengguna.php?sukses=edit-data"</script>';
}
//-------------------------------------------------------------------------------------------------------------------------------------------------------

if(!empty($_GET['konsultan2'])){
	$id = htmlentities($_POST['id']);
	$nama = htmlentities($_POST['nama']);
	$alamat = htmlentities($_POST['alamat']);
	$nama_direktur = htmlentities($_POST['nama_direktur']);
	$se = htmlentities($_POST['se']);
	$ie = htmlentities($_POST['ie']);
	$tgl = htmlentities($_POST['tgl']);
	
	$data[] = $nama;
	$data[] = $alamat;
	$data[] = $tgl;
	$data[] = $nama_direktur;
	$data[] = $se;
	$data[] = $ie;
	$data[] = $id;
	$sql = 'UPDATE master_konsultan SET nama=?, alamat=?, tgl_update=?, nama_direktur=?, se=?, ie=?  WHERE id=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data konsultan2";
	$log->recordProcLog($process);

	echo '<script>window.location="../../admin/master_konsultan.php?sukses=edit-data"</script>';
}

//-------------------------------------------------------------------------------------------------------------------------------------------------------
if(!empty($_GET['ppk2'])){
	$id = htmlentities($_POST['id']);
	$nama = htmlentities($_POST['nama']);
	$alamat = htmlentities($_POST['alamat']);
	$tgl = htmlentities($_POST['tgl']);
	
	$data[] = $nama;
	$data[] = $alamat;
	$data[] = $tgl;
	$data[] = $id;
	$sql = 'UPDATE master_ppk SET nama=?, alamat=?, tgl_update=?  WHERE id=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "Mengubah data ppk2";
	$log->recordProcLog($process);

	echo '<script>window.location="../../admin/master_ppk.php?sukses=edit-data"</script>';
}
//=============================================Gambar Profil==================================================================================
if(!empty($_GET['gambar_admin'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['foto']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/edit_user.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/edit_user.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../assets/img/user/';
		$target_path = $target_path . basename( $_FILES['foto']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/edit_user.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)){
				//post foto lama
			$foto2 = $_POST['foto2'];
			//remove foto di direktori
			unlink('../../assets/img/user/'.$foto2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['foto']['name'];
			$data[] = $id;
			$sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data member (gambar admin dirubah)";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/edit_user.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['gambar_admin_uptd'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['foto']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin_uptd/edit_user.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin_uptd/edit_user.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../assets/img/user/';
		$target_path = $target_path . basename( $_FILES['foto']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin_uptd/edit_user.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)){
				//post foto lama
			$foto2 = $_POST['foto2'];
			//remove foto di direktori
			unlink('../../assets/img/user/'.$foto2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['foto']['name'];
			$data[] = $id;
			$sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data member (gambar admin uptd dirubah)";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin_uptd/edit_user.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['gambar_konsultan'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['foto']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
		echo '<script>window.location="../../konsultan/edit_user.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
echo '<script>window.location="../../konsultan/edit_user.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../assets/img/user/';
		$target_path = $target_path . basename( $_FILES['foto']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../konsultan/edit_user.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)){
				//post foto lama
			$foto2 = $_POST['foto2'];
			//remove foto di direktori
			unlink('../../assets/img/user/'.$foto2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['foto']['name'];
			$data[] = $id;
			$sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data member (gambar konsultan diubah)";
			$log->recordProcLog($process);

			echo '<script>window.location="../../konsultan/edit_user.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['gambar_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['foto']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/edit_user.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/edit_user.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../assets/img/user/';
		$target_path = $target_path . basename( $_FILES['foto']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/edit_user.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)){
				//post foto lama
			$foto2 = $_POST['foto2'];
			//remove foto di direktori
			unlink('../../assets/img/user/'.$foto2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['foto']['name'];
			$data[] = $id;
			$sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data member (gambar kontraktor dirubah)";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/edit_user.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['gambar_ppk'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['foto']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
		echo '<script>window.location="../../ppk/edit_user.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
echo '<script>window.location="../../ppk/edit_user.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../assets/img/user/';
		$target_path = $target_path . basename( $_FILES['foto']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../ppk/edit_user.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)){
				//post foto lama
			$foto2 = $_POST['foto2'];
			//remove foto di direktori
			unlink('../../assets/img/user/'.$foto2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['foto']['name'];
			$data[] = $id;
			$sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data member (gambar ppk dirubah)";
			$log->recordProcLog($process);

			echo '<script>window.location="../../ppk/edit_user.php?sukses=edit-data"</script>';
		}
	}
}

//----------------------------------rab --------------------------------------------------------------------------------------------------------
if(!empty($_GET['rab'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['rab']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['rab']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['rab']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['rab']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['rab']['tmp_name'], $target_path)){
				//post foto lama
			$rab2 = $_POST['rab2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$rab2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['rab']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET rab=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data rab";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

//----------------------------------rab 1 --------------------------------------------------------------------------------------------------------
if(!empty($_GET['rab1'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['rab1']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['rab1']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['rab1']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['rab1']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['rab1']['tmp_name'], $target_path)){
				//post foto lama
			$rab11 = $_POST['rab11'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$rab11.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['rab1']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET rab1=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data rab1";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['rab1_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['rab1']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['rab1']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['rab1']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['rab1']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['rab1']['tmp_name'], $target_path)){
				//post foto lama
			$rab11 = $_POST['rab11'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$rab11.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['rab1']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET rab1=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data rab1 kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

//----------------------------------rab2 --------------------------------------------------------------------------------------------------------
if(!empty($_GET['rab2'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['rab2']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['rab2']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['rab2']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['rab2']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['rab2']['tmp_name'], $target_path)){
				//post foto lama
			$rab21 = $_POST['rab21'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$rab21.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['rab2']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET rab2=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data rab2";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['rab2_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['rab2']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['rab2']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['rab2']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['rab2']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['rab2']['tmp_name'], $target_path)){
				//post foto lama
			$rab21 = $_POST['rab21'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$rab21.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['rab2']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET rab2=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data rab2 kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}
//----------------------------------rab3 --------------------------------------------------------------------------------------------------------
if(!empty($_GET['rab3'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['rab3']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['rab3']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['rab3']["size"] / 1024) > 4096) {
		echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['rab3']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['rab3']['tmp_name'], $target_path)){
				//post foto lama
			$rab31 = $_POST['rab31'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$rab31.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['rab3']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET rab3=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data rab3";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['rab3_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['rab3']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['rab3']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['rab3']["size"] / 1024) > 4096) {
		echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['rab3']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['rab3']['tmp_name'], $target_path)){
				//post foto lama
			$rab31 = $_POST['rab31'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$rab31.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['rab3']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET rab3=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data rab3 kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

//----------------------------------pk --------------------------------------------------------------------------------------------------------
if(!empty($_GET['pk'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['pk']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['pk']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['pk']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['pk']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['pk']['tmp_name'], $target_path)){
				//post foto lama
			$pk2 = $_POST['pk2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$pk2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['pk']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET pk=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data pk";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['pk_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['pk']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['pk']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['pk']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['pk']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['pk']['tmp_name'], $target_path)){
				//post foto lama
			$pk2 = $_POST['pk2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$pk2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['pk']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET pk=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "Mengubah data pk kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

//----------------------------------sm --------------------------------------------------------------------------------------------------------
if(!empty($_GET['sm'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['sm']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['sm']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['sm']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['sm']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['sm']['tmp_name'], $target_path)){
				//post foto lama
			$sm2 = $_POST['sm2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$sm2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['sm']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET sm=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data sm";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['sm_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['sm']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['sm']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['sm']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['sm']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['sm']['tmp_name'], $target_path)){
				//post foto lama
			$sm2 = $_POST['sm2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$sm2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['sm']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET sm=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data sm kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

//----------------------------------sk --------------------------------------------------------------------------------------------------------
if(!empty($_GET['sk'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['sk']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['sk']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['sk']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['sk']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['sk']['tmp_name'], $target_path)){
				//post foto lama
			$sk2 = $_POST['sk2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$sk2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['sk']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET sk=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data sk";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['sk_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['sk']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['sk']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['sk']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['sk']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['sk']['tmp_name'], $target_path)){
				//post foto lama
			$sk2 = $_POST['sk2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$sk2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['sk']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET sk=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data sk kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

//----------------------------------ul_spmk --------------------------------------------------------------------------------------------------------
if(!empty($_GET['ul_spmk'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_spmk']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_spmk']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_spmk']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_spmk']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_spmk']['tmp_name'], $target_path)){
				//post foto lama
			$ul_spmk2 = $_POST['ul_spmk2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_spmk2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_spmk']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_spmk=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul spmk";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['ul_spmk_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_spmk']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_spmk']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_spmk']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_spmk']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_spmk']['tmp_name'], $target_path)){
				//post foto lama
			$ul_spmk2 = $_POST['ul_spmk2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_spmk2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_spmk']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_spmk=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul spmk kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}
//----------------------------------ul_jadual--------------------------------------------------------------------------------------------------------
if(!empty($_GET['ul_jadual'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_jadual']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_jadual']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_jadual']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_jadual']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_jadual']['tmp_name'], $target_path)){
				//post foto lama
			$ul_jadual2 = $_POST['ul_jadual2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_jadual2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_jadual']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_jadual=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul jadual";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['ul_jadual_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_jadual']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_jadual']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_jadual']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_jadual']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_jadual']['tmp_name'], $target_path)){
				//post foto lama
			$ul_jadual2 = $_POST['ul_jadual2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_jadual2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_jadual']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_jadual=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul jadual kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}
//----------------------------------ul_rencana--------------------------------------------------------------------------------------------------------
if(!empty($_GET['ul_rencana'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_rencana']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_rencana']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_rencana']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_rencana']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_rencana']['tmp_name'], $target_path)){
				//post foto lama
			$ul_rencana2 = $_POST['ul_rencana2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_rencana2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_rencana']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_rencana=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul rencana";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['ul_rencana_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_rencana']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_rencana']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_rencana']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_rencana']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_rencana']['tmp_name'], $target_path)){
				//post foto lama
			$ul_rencana2 = $_POST['ul_rencana2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_rencana2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_rencana']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_rencana=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul rencana kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}
//----------------------------------ul_sppbj--------------------------------------------------------------------------------------------------------
if(!empty($_GET['ul_sppbj'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_sppbj']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_sppbj']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_sppbj']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_sppbj']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_sppbj']['tmp_name'], $target_path)){
				//post foto lama
			$ul_sppbj2 = $_POST['ul_sppbj2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_sppbj2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_sppbj']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_sppbj=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul sppbj";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['ul_sppbj_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_sppbj']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_sppbj']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_sppbj']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_sppbj']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_sppbj']['tmp_name'], $target_path)){
				//post foto lama
			$ul_sppbj2 = $_POST['ul_sppbj2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_sppbj2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_sppbj']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_sppbj=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul sppbj kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

//----------------------------------ul_spl--------------------------------------------------------------------------------------------------------
if(!empty($_GET['ul_spl'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_spl']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_spl']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_spl']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_spl']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_spl']['tmp_name'], $target_path)){
				//post foto lama
			$ul_spl2 = $_POST['ul_spl2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_spl2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_spl']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_spl=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul spl";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['ul_spl_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_spl']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_spl']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_spl']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_spl']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_spl']['tmp_name'], $target_path)){
				//post foto lama
			$ul_spl2 = $_POST['ul_spl2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_spl2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_spl']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_spl=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul spl kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}
//----------------------------------ul_spek--------------------------------------------------------------------------------------------------------
if(!empty($_GET['ul_spek'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_spek']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_spek']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_spek']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_spek']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_spek']['tmp_name'], $target_path)){
				//post foto lama
			$ul_spek2 = $_POST['ul_spek2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_spek2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_spek']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_spek=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul spek";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['ul_spek_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_spek']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_spek']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_spek']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_spek']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_spek']['tmp_name'], $target_path)){
				//post foto lama
			$ul_spek2 = $_POST['ul_spek2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_spek2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_spek']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_spek=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul spek kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}
//----------------------------------ul_jaminan--------------------------------------------------------------------------------------------------------
if(!empty($_GET['ul_jaminan'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_jaminan']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_jaminan']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_jaminan']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_jaminan']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_jaminan']['tmp_name'], $target_path)){
				//post foto lama
			$ul_jaminan2 = $_POST['ul_jaminan2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_jaminan2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_jaminan']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_jaminan=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul jaminan";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['ul_jaminan_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_jaminan']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_jaminan']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_jaminan']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_jaminan']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_jaminan']['tmp_name'], $target_path)){
				//post foto lama
			$ul_jaminan2 = $_POST['ul_jaminan2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_jaminan2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_jaminan']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_jaminan=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul jaminan kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

//----------------------------------ul_spkmp--------------------------------------------------------------------------------------------------------
if(!empty($_GET['ul_spkmp'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_spkmp']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_spkmp']["type"], $allowedImageType)) {
		echo '<script>window.location="../../admin/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_spkmp']["size"] / 1024) > 4096) {
echo '<script>window.location="../../admin/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_spkmp']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../admin/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_spkmp']['tmp_name'], $target_path)){
				//post foto lama
			$ul_spkmp2 = $_POST['ul_spkmp2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_spkmp2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_spkmp']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_spkmp=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul spkmp";
			$log->recordProcLog($process);

			echo '<script>window.location="../../admin/data_umum.php?sukses=edit-data"</script>';
		}
	}
}

if(!empty($_GET['ul_spkmp_kontraktor'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	//$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['ul_spkmp']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['ul_spkmp']["type"], $allowedImageType)) {
		echo '<script>window.location="../../kontraktor/data_umum.php?gagal=edit-data"</script>';

	}elseif (round($_FILES['ul_spkmp']["size"] / 1024) > 4096) {
echo '<script>window.location="../../kontraktor/data_umum.php?besar=edit-data"</script>';

	}else{
		$target_path = '../../lampiran/umum/';
		$target_path = $target_path . basename( $_FILES['ul_spkmp']['name']); 
		if (file_exists("$target_path")){ 
			echo '<script>window.location="../../kontraktor/data_umum.php?nama=edit-data"</script>';

			}elseif(move_uploaded_file($_FILES['ul_spkmp']['tmp_name'], $target_path)){
				//post foto lama
			$ul_spkmp2 = $_POST['ul_spkmp2'];
			//remove foto di direktori
			unlink('../../lampiran/umum/'.$ul_spkmp2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['ul_spkmp']['name'];
			$data[] = $id;
			$sql = 'UPDATE data_umum SET ul_spkmp=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data ul spkmp kontraktor";
			$log->recordProcLog($process);

			echo '<script>window.location="../../kontraktor/data_umum.php?sukses=edit-data"</script>';
		}
	}
}
//----------------------------------edit sketsa request --------------------------------------------------------------------------------------------------------
if(!empty($_GET['gambar2'])){
	$id = htmlentities($_POST['id']);
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	//$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['sketsa']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['sketsa']["type"], $allowedImageType)) {
		echo "You can only upload pdf dan ods file";
		echo "<font face='Verdana' size='2' ><BR><BR><BR>
				<a href='../../index.php?page=request'>Back to upform</a><BR>";

	}elseif (round($_FILES['sketsa']["size"] / 1024) > 4096) {
		echo "WARNING !!! Besar File Tidak Boleh Lebih Dari 4 MB";
		echo "<font face='Verdana' size='2' ><BR><BR><BR>
				<a href='../../index.php?page=request'>Back to upform</a><BR>";

	}else{
		$target_path = '../../lampiran/req/';
		$target_path = $target_path . basename( $_FILES['sketsa']['name']); 
		if (file_exists("$target_path")){ 
			echo "<font face='Verdana' size='2' >Ini Terjadi Karena Telah Masuk Nama File Yang Sama,
			<br> Silahkan Rename File terlebih dahulu<br>";

		echo "<font face='Verdana' size='2' ><BR><BR><BR>
				<a href='../../index.php?page=request'>Back to upform</a><BR>";

			}elseif(move_uploaded_file($_FILES['sketsa']['tmp_name'], $target_path)){
				//post foto lama
			$sketsa2 = $_POST['sketsa2'];
			//remove foto di direktori
			unlink('../../lampiran/req/'.$sketsa2.'');
			//input foto
			$id = $_POST['id'];
			$data[] = $_FILES['sketsa']['name'];
			$data[] = $id;
			$sql = 'UPDATE request SET sketsa=?  WHERE id=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data request (gambar2)";
			$log->recordProcLog($process);

			echo '<script>window.location="../../index.php?page=request&success=edit-data"</script>';
		}
	}
}

//----------------------------------edit gambar request --------------------------------------------------------------------------------------------------------
if(!empty($_GET['gambar3'])){
	$lapId = htmlentities($_POST['lapId']);
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	//$allowedImageType = array("application/pdf","application/vnd.ms-excel" );
	if ($_FILES['gambar']["error"] > 0) {
		$output['error']= "Error in File";
	} elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
		echo "You can only upload pdf dan ods file";
		echo "<font face='Verdana' size='2' ><BR><BR><BR>
				<a href='../../index.php?page=laporan'>Back to upform</a><BR>";

	}elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
		echo "WARNING !!! Besar File Tidak Boleh Lebih Dari 4 MB";
		echo "<font face='Verdana' size='2' ><BR><BR><BR>
				<a href='../../index.php?page=laporan'>Back to upform</a><BR>";

	}else{
		$target_path = '../../lampiran/lh/';
		$target_path = $target_path . basename( $_FILES['gambar']['name']); 
		if (file_exists("$target_path")){ 
			echo "<font face='Verdana' size='2' >Ini Terjadi Karena Telah Masuk Nama File Yang Sama,
			<br> Silahkan Rename File terlebih dahulu<br>";

		echo "<font face='Verdana' size='2' ><BR><BR><BR>
				<a href='../../index.php?page=laporan'>Back to upform</a><BR>";

			}elseif(move_uploaded_file($_FILES['gambar']['tmp_name'], $target_path)){
				//post foto lama
			$gambar2 = $_POST['gambar2'];
			//remove foto di direktori
			unlink('../../lampiran/lh/'.$gambar2.'');
			//input foto
			$lapId = $_POST['lapId'];
			$data[] = $_FILES['gambar']['name'];
			$data[] = $lapId;
			$sql = 'UPDATE master_laporan_harian SET gambar=?  WHERE no_trans=?';
			$row = $config -> prepare($sql);
			$row -> execute($data);

			//Logging history
			$process = "mengubah data request (gambar3)";
			$log->recordProcLog($process);

			echo '<script>window.location="../../index.php?page=laporan&success=edit-data"</script>';
		}
	}
}


//-------------------------------------------------------------------------------------------------------------------------
if(!empty($_GET['data_umum'])){
	$id = htmlentities($_POST['id']);
	$pemda = htmlentities($_POST['pemda']);
	$opd = htmlentities($_POST['opd']);
	$unor = htmlentities($_POST['unor']);
	$nama_kegiatan = htmlentities($_POST['nama_kegiatan']);
	$nama_ruas_jalan = htmlentities($_POST['ruas_jalan']);
	$lat = htmlentities($_POST['lat']);
	$lng = htmlentities($_POST['lng']);
	$segmen_jalan = htmlentities($_POST['segmen_jalan']);
	$no_kontrak = htmlentities($_POST['no_kontrak']);
	$tgl_kontrak = htmlentities($_POST['tgl_kontrak']);
	$nilai_kontrak = htmlentities($_POST['nilai_kontrak']);
	$no_spmk = htmlentities($_POST['no_spmk']);
	$tgl_spmk = htmlentities($_POST['tgl_spmk']);
	$panjang = htmlentities($_POST['panjang']);
	$waktu_pelaksanaan = htmlentities($_POST['waktu_pelaksanaan']);
	$ppk = htmlentities($_POST['ppk']);
	$penyedia_jasa = htmlentities($_POST['penyedia_jasa']);
	$konsultan_supervisi = htmlentities($_POST['konsultan_supervisi']);
	$nama_ppk = htmlentities($_POST['nama_ppk']);
	$nama_se = htmlentities($_POST['nama_se']);
	$nama_gs = htmlentities($_POST['nama_gs']);
	
	
	$data[] = $pemda;
	$data[] = $opd;
	$data[] = $unor;
	$data[] = $nama_kegiatan;
	$data[] = $nama_ruas_jalan;
	$data[] = $lat;
	$data[] = $lng;
	$data[] = $segmen_jalan;
	$data[] = $no_kontrak;
	$data[] = $tgl_kontrak;
	$data[] = $nilai_kontrak;
	$data[] = $no_spmk;
	$data[] = $tgl_spmk;
	$data[] = $panjang;
	$data[] = $waktu_pelaksanaan;
	$data[] = $ppk;
	$data[] = $penyedia_jasa;
	$data[] = $konsultan_supervisi;
	$data[] = $nama_ppk;
	$data[] = $nama_se;
	$data[] = $nama_gs;
	$data[] = $id;
	$sql = 'UPDATE data_umum SET pemda=?,opd=?,unor=?,nama_kegiatan=?,nama_ruas_jalan=?, lat=?,lng=?,segmen_jalan=?,no_kontrak=?,tgl_kontrak=?,nilai_kontrak=?,no_spmk=?,tgl_spmk=?,panjang=?,waktu_pelaksanaan=?,ppk=?,penyedia_jasa=?,konsultan_supervisi=?,nama_ppk=?,nama_se=?,nama_gs=? WHERE id=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "mengubah data umum";
	$log->recordProcLog($process);

	echo '<script>window.location="../../index.php?page=data_umum&success-edit=edit-data"</script>';
}


//-------------------------------------------------Ganti Photo Profil--------------------------------------------------------------------------
if(!empty($_GET['profil_admin'])){
	$id = htmlentities($_POST['id']);
	$nama = htmlentities($_POST['nama']);
	$alamat = htmlentities($_POST['alamat']);
	$tlp = htmlentities($_POST['telp']);
	$email = htmlentities($_POST['email']);
	$nik = htmlentities($_POST['nik']);
	$tgl= date("j F Y, G:i");
	
	$data[] = $nama;
	$data[] = $alamat;
	$data[] = $tlp;
	$data[] = $email;
	$data[] = $nik;
	$data[] = $tgl;
	$data[] = $id;
	$sql = 'UPDATE member SET nama_lengkap=?,alamat_member=?,telp=?,email=?,nik=?,tgl_update=? WHERE id_member=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "mengubah profil admin";
	$log->recordProcLog($process);

	echo '<script>window.location="../../admin/edit_user.php?sukses=edit-data"</script>';
	//echo '<script>window.location="edit_user.php?sukses=edit-data"</script>';
}

if(!empty($_GET['profil_admin_uptd'])){
	$id = htmlentities($_POST['id']);
	$nama = htmlentities($_POST['nama']);
	$alamat = htmlentities($_POST['alamat']);
	$tlp = htmlentities($_POST['telp']);
	$email = htmlentities($_POST['email']);
	$nik = htmlentities($_POST['nik']);
	$tgl= date("j F Y, G:i");
	
	$data[] = $nama;
	$data[] = $alamat;
	$data[] = $tlp;
	$data[] = $email;
	$data[] = $nik;
	$data[] = $tgl;
	$data[] = $id;
	$sql = 'UPDATE member SET nama_lengkap=?,alamat_member=?,telp=?,email=?,nik=?,tgl_update=? WHERE id_member=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "mengubah profil admin uptd";
	$log->recordProcLog($process);

	echo '<script>window.location="../../admin_uptd/edit_user.php?sukses=edit-data"</script>';
	//echo '<script>window.location="edit_user.php?sukses=edit-data"</script>';
}

if(!empty($_GET['profil_konsultan'])){
	$id = htmlentities($_POST['id']);
	$nama = htmlentities($_POST['nama']);
	$alamat = htmlentities($_POST['alamat']);
	$tlp = htmlentities($_POST['telp']);
	$email = htmlentities($_POST['email']);
	$nik = htmlentities($_POST['nik']);
	$tgl= date("j F Y, G:i");
	
	$data[] = $nama;
	$data[] = $alamat;
	$data[] = $tlp;
	$data[] = $email;
	$data[] = $nik;
	$data[] = $tgl;
	$data[] = $id;
	$sql = 'UPDATE member SET nama_lengkap=?,alamat_member=?,telp=?,email=?,nik=?,tgl_update=? WHERE id_member=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "mengubah profil konsultan";
	$log->recordProcLog($process);

	echo '<script>window.location="../../konsultan/edit_user.php?sukses=edit-data"</script>';
}

if(!empty($_GET['profil_kontraktor'])){
	$id = htmlentities($_POST['id']);
	$nama = htmlentities($_POST['nama']);
	$alamat = htmlentities($_POST['alamat']);
	$tlp = htmlentities($_POST['telp']);
	$email = htmlentities($_POST['email']);
	$nik = htmlentities($_POST['nik']);
	$tgl= date("j F Y, G:i");
	
	$data[] = $nama;
	$data[] = $alamat;
	$data[] = $tlp;
	$data[] = $email;
	$data[] = $nik;
	$data[] = $tgl;
	$data[] = $id;
	$sql = 'UPDATE member SET nama_lengkap=?,alamat_member=?,telp=?,email=?,nik=?,tgl_update=? WHERE id_member=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "mengubah profil kontraktor";
	$log->recordProcLog($process);

	echo '<script>window.location="../../kontraktor/edit_user.php?sukses=edit-data"</script>';
}

if(!empty($_GET['profil_ppk'])){
	$id = htmlentities($_POST['id']);
	$nama = htmlentities($_POST['nama']);
	$alamat = htmlentities($_POST['alamat']);
	$tlp = htmlentities($_POST['telp']);
	$email = htmlentities($_POST['email']);
	$nik = htmlentities($_POST['nik']);
	$tgl= date("j F Y, G:i");
	
	$data[] = $nama;
	$data[] = $alamat;
	$data[] = $tlp;
	$data[] = $email;
	$data[] = $nik;
	$data[] = $tgl;
	$data[] = $id;
	$sql = 'UPDATE member SET nama_lengkap=?,alamat_member=?,telp=?,email=?,nik=?,tgl_update=? WHERE id_member=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "mengubah profil ppk";
	$log->recordProcLog($process);

	echo '<script>window.location="../../ppk/edit_user.php?sukses=edit-data"</script>';
}


//============================================= ganti password =======================================================================

if(!empty($_GET['pass_admin'])){
	$id = htmlentities($_POST['id']);
	//$user = htmlentities($_POST['user']);
	$pass = htmlentities($_POST['pass']);
	
	//$data[] = $user;
	$data[] = $pass;
	$data[] = $id;
	$sql = 'UPDATE login SET pass=md5(?) WHERE id_member=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "mengubah password admin";
	$log->recordProcLog($process);

	echo '<script>window.location="../../admin/edit_user.php?sukses=edit-data"</script>';
}

if(!empty($_GET['pass_admin_uptd'])){
	$id = htmlentities($_POST['id']);
	//$user = htmlentities($_POST['user']);
	$pass = htmlentities($_POST['pass']);
	
	//$data[] = $user;
	$data[] = $pass;
	$data[] = $id;
	$sql = 'UPDATE login SET pass=md5(?) WHERE id_member=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "mengubah password admin uptd";
	$log->recordProcLog($process);

	echo '<script>window.location="../../admin_uptd/edit_user.php?sukses=edit-data"</script>';
}

if(!empty($_GET['pass_kontraktor'])){
	$id = htmlentities($_POST['id']);
	//$user = htmlentities($_POST['user']);
	$pass = htmlentities($_POST['pass']);
	
	//$data[] = $user;
	$data[] = $pass;
	$data[] = $id;
	$sql = 'UPDATE login SET pass=md5(?) WHERE id_member=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "mengubah password kontraktor";
	$log->recordProcLog($process);

	echo '<script>window.location="../../kontraktor/edit_user.php?sukses=edit-data"</script>';
}

if(!empty($_GET['pass_konsultan'])){
	$id = htmlentities($_POST['id']);
	//$user = htmlentities($_POST['user']);
	$pass = htmlentities($_POST['pass']);
	
	//$data[] = $user;
	$data[] = $pass;
	$data[] = $id;
	$sql = 'UPDATE login SET pass=md5(?) WHERE id_member=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "mengubah password konsultan";
	$log->recordProcLog($process);

	echo '<script>window.location="../../konsultan/edit_user.php?sukses=edit-data"</script>';
}

if(!empty($_GET['pass_ppk'])){
	$id = htmlentities($_POST['id']);
	//$user = htmlentities($_POST['user']);
	$pass = htmlentities($_POST['pass']);
	
	//$data[] = $user;
	$data[] = $pass;
	$data[] = $id;
	$sql = 'UPDATE login SET pass=md5(?) WHERE id_member=?';
	$row = $config -> prepare($sql);
	$row -> execute($data);

	//Logging history
	$process = "mengubah password ppk";
	$log->recordProcLog($process);

	echo '<script>window.location="../../ppk/edit_user.php?sukses=edit-data"</script>';
}
/*
if(!empty($_GET['cari_barang'])){
    $cari = trim(strip_tags($_POST['keyword']));
	if($cari == '')
	{

	}else{
		$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
				from barang inner join kategori on barang.id_kategori = kategori.id_kategori
				where id_barang like '%$cari%' or nama_barang like '%$cari%' or merk like '%$cari%'";
		$row = $config -> prepare($sql);
		$row -> execute();
		$hasil1= $row -> fetchAll();
?>
	<table class="table table-stripped" width="100%">
	<?php foreach($hasil1 as $hasil){?>
		<tr>
			<td><h4><?php echo $hasil['id_barang'];?></h4></td>
			<td><h4><?php echo $hasil['nama_barang'];?></h4></td>
			<td><h4><?php echo $hasil['harga_jual'];?></h4></td>
			<td>
			<a href="fungsi/tambah/tambah.php?jual=jual&id=<?php echo $hasil['id_barang'];?>&id_kasir=<?php echo $_SESSION['admin']['id_member'];?>">
			<button class="btn btn-success">Taruh</button></a></td>
		</tr>
	<?php }?>
	</table>
<?php	
	}
}

*/
if(!empty($_GET['cari_barang'])){
    $cari = trim(strip_tags($_POST['keyword']));
	if($cari == '')
	{

	}else{
		/*$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
				from barang inner join kategori on barang.id_kategori = kategori.id_kategori
				where id_barang like '%$cari%' or nama_barang like '%$cari%' or merk like '%$cari%'";
		*/
		$sql = "select * from data_umum
				where nama_kegiatan like '%$cari%' or nama_ruas_jalan like '%$cari%' or no_kontrak like '%$cari%'";		
				
		$row = $config -> prepare($sql);
		$row -> execute();
		$hasil1= $row -> fetchAll();
?>
	<table class="table table-stripped" width="100%">
	<?php foreach($hasil1 as $hasil){?>
		<tr>
			<td><h4><?php echo $hasil['nama_kegiatan'];?></h4></td>
			<td><h4><?php echo $hasil['nama_ruas_jalan'];?></h4></td>
			<td><h4><?php echo $hasil['no_kontrak'];?></h4></td>
			<td>
			<a href="fungsi/tambah/tambah.php?jual=jual&id=<?php echo $hasil['id_barang'];?>&id_kasir=<?php echo $_SESSION['admin']['id_member'];?>">
			<button class="btn btn-success">Taruh</button></a></td>
		</tr>
	<?php }?>
	</table>
<?php	
	}
}
?>
