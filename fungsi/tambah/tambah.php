
<?php 
	session_start();
	require '../../konfigurasi/konek.php';
	include "../src/LogHistory.php";
	//  $log = new LogHistory();
	 

	if(!empty($_GET['kategori'])){
		$nama= $_POST['kategori'];
		$tgl= date("j F Y, G:i");
		$data[] = $nama;
		$data[] = $tgl;
		$sql = 'INSERT INTO kategori (nama_kategori,tgl_input) VALUES(?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		$process = "Insert data kategori";
		$log_write = $log->recordProcLog($process);

		echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';
	}
	if(!empty($_GET['barang'])){
		$id = $_POST['id'];
		$kategori = $_POST['kategori'];
		$nama = $_POST['nama'];
		$merk = $_POST['merk'];
		$beli = $_POST['beli'];
		$jual = $_POST['jual'];
		$satuan = $_POST['satuan'];
		$stok = $_POST['stok'];
		$tgl = $_POST['tgl'];
		
		$data[] = $id;
		$data[] = $kategori;
		$data[] = $nama;
		$data[] = $merk;
		$data[] = $beli;
		$data[] = $jual;
		$data[] = $satuan;
		$data[] = $stok;
		$data[] = $tgl;
		$sql = 'INSERT INTO barang (id_barang,id_kategori,nama_barang,merk,harga_beli,harga_jual,satuan_barang,stok,tgl_input) 
			    VALUES (?,?,?,?,?,?,?,?,?) ';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		$process = "Insert data barang";
		$log_write = $log->recordProcLog($process);

		echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
	}
	
//--------------------------------------------------------------------------------------------------------------------------------------------------
	if(!empty($_GET['bahan'])){
		$nama_bahan = $_POST['nama_bahan'];
		$satuan_bahan = $_POST['satuan'];
		//$tgl = $_POST['tgl'];
		
		$data[] = $nama_bahan;
		$data[] = $satuan_bahan;
		//$data[] = $tgl;
		$sql = 'INSERT INTO master_bahan (nama_bahan,satuan) 
			    VALUES (?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		$process = "Insert data bahan";
		$log_write = $log->recordProcLog($process);

		echo '<script>window.location="../../index.php?page=bahan&success=tambah-data"</script>';
	}	
//-------------------------------------------------------------------------------------------------------------------------------------------------
	// if(!empty($_GET['progress'])) {
	// 	if($_POST['minggu_ke']) {
	// 		$namapaket = $_POST['nama_paket']; //textfield
	// 		$fieldteam = $_POST['team']; //textarea

	// 		$jfield = count($_POST['minggu_ke']);

	// 		for($i = 0; $i < $jfield; $i++) {
	// 			$mingguke = $_POST['minggu_ke'][$i];
	// 			$rencana = $_POST['rencana'][$i];
	// 			$realisasi = $_POST['realisasi'][$i];
	// 			$deviasi = $_POST['deviasi'][$i];
	// 			$krp = $_POST['krp'][$i];
	// 			$kpersen = $_POST['kpersen'][$i];
	// 			$data[] = $mingguke;
	// 			$data[] = $rencana;
	// 			$data[] = $realisasi;
	// 			$data[] = $deviasi;
	// 			$data[] = $krp;
	// 			$data[] = $kpersen;
	// 			// VALUES($namapaket, $fieldteam, $mingguke, $rencana, $realisasi, $deviasi, $krp, $kpersen)
	// 			$sql = "INSERT INTO progress_mingguan (nama_paket, field_team, minggu_ke, rencana, realisasi, deviasi, keuangan_rp, keuangan_per) 
	// 				VALUES((?,?,?,?,?,?,?,?))";
	// 			// $sql = 'INSERT INTO progress_mingguan (nama_paket, field_team, minggu_ke, rencana, realisasi, deviasi, keuangan_rp, keuangan_%) 
	// 			// 		VALUES (?,?,?,?,?,?,?,?)';
	// 			$row = $config -> prepare($sql);
	// 			$row->execute($data);
	// 			echo $row->rowCount();
	// 			// echo '<script>alert("Berhasil Heyy")</script>';
	// 		}
	// 	}
	// }
//-------------------------------------------------------------------------------------------------------------------------------------------------
	if(!empty($_GET['data_user'])){
		var_dump($_POST['akses']);
		try {
		$nm_member = $_POST['nm_member'];
		$nama_lengkap = $_POST['nama_lengkap'];
		$alamat_member = $_POST['alamat_member'];
		$hak = $_POST['akses'];
		$telp = $_POST['telp'];
		$email = $_POST['email'];
		$nik = $_POST['nik'];
		//$level = $_POST['level'];
		$kantor_id = $_POST['kantor_id'];
		$penyedia_jasa = $_POST['penyedia_jasa'];
		$jabatan = $_POST['jabatan'];
		//$tgl = $_POST['tgl'];
		
		$data[] = $nm_member;
		$data[] = $nama_lengkap;
		$data[] = $alamat_member;
		$data[] = $hak;
		$data[] = $telp;
		$data[] = $email;
		$data[] = $nik;
		// $data[] = $hak;
		$data[] = $kantor_id;
		$data[] = $penyedia_jasa;
		$data[] = $jabatan;
		
		//$data[] = $tgl;
		$sql = 'INSERT INTO member (nm_member,nama_lengkap,alamat_member,akses,telp,email,nik,unit,perusahaan,jabatan) 
			    VALUES (?,?,?,?,?,?,?,?,?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		// $process = "Insert data user";
		// $log_write = $log->recordProcLog($process);

		echo '<script>window.location="../../admin/master_pengguna.php?sukses=tambah-data"</script>';
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
		
	}

	if(!empty($_GET['kontraktor'])){

		try {
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$nama_direktur = $_POST['nama_direktur'];
		//$nama_gs = $_POST['nama_gs'];
		$npwp = $_POST['npwp'];
		$telp = $_POST['telp'];
		$bank = $_POST['bank'];
		$no_rek = $_POST['no_rek'];
		//$tgl = $_POST['tgl'];
		
		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $nama_direktur;
		//$data[] = $nama_gs;
		$data[] = $npwp;
		$data[] = $telp;
		$data[] = $bank;
		$data[] = $no_rek;
		//$data[] = $tgl;
		$sql = 'INSERT INTO master_penyedia_jasa (nama,alamat,nama_direktur,npwp,telp,bank,no_rek) 
			    VALUES (?,?,?,?,?,?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo $row == true;

		// $process = "Insert data kontraktor";
		// $log_write = $log->recordProcLog($process);

		echo '<script>window.location="../../admin/master_kontraktor.php?sukses=tambah-data"</script>';
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
		
	}
	
	if(!empty($_GET['konsultan'])){
		try {
			$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$nama_direktur = $_POST['nama_direktur'];
		$nama_se = $_POST['se'];
		$nama_ie = $_POST['ie'];
		//$tgl = $_POST['tgl'];
		
		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $nama_direktur;
		$data[] = $nama_se;
		$data[] = $nama_ie;
		//$data[] = $tgl;
		$sql = 'INSERT INTO master_konsultan (nama,alamat,nama_direktur,se,ie) 
			    VALUES (?,?,?,?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		// $process = "Insert data konsultan";
		// $log_write = $log->recordProcLog($process);

		echo '<script>window.location="../../admin/master_konsultan.php?sukses=tambah-data"</script>';
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
		
	}

	if(!empty($_GET['ppk'])){
		try {
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		//$tgl = $_POST['tgl'];
		
		$data[] = $nama;
		$data[] = $alamat;
		//$data[] = $tgl;
		$sql = 'INSERT INTO master_ppk (nama,alamat) 
			    VALUES (?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		// $process = "Insert data master ppk";
		// $log_write = $log->recordProcLog($process);

		echo '<script>window.location="../../admin/master_ppk.php?sukses=tambah-data"</script>';
		}  catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
		
	}

	if(!empty($_GET['pekerjaan'])){
		try {
			$id = $_POST['id'];
		$jenis_pekerjaan = $_POST['jenis_pekerjaan'];
		$satuan = $_POST['satuan'];
		$tgl = $_POST['tgl'];
		
		$data[] = $id;
		$data[] = $jenis_pekerjaan;
		$data[] = $satuan;
		$data[] = $tgl;
		$sql = 'INSERT INTO master_jenis_pekerjaan (id,jenis_pekerjaan,satuan,tgl_input) 
			    VALUES (?,?,?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);

		// $process = "Insert data pekerjaan";
		// $log_write = $log->recordProcLog($process);

		echo '<script>window.location="../../admin/master_jenis_pekerjaan.php?sukses=tambah-data"</script>';
		} catch (PDOException $e) {
			echo '<script>window.location="../../admin/master_jenis_pekerjaan.php?gagal=tambah-data"</script>';
		}
		
	}
	
	
//--------------------------------------------------------------------------------------------------------------------------------------------------
	if(!empty($_GET['jual'])){
		try {
			$id = $_GET['id'];
		$kasir =  $_GET['id_kasir'];
		$jumlah = '0';
		$total = '0';
		$tgl = date("j F Y, G:i");
		
		$data1[] = $id;
		$data1[] = $kasir;
		$data1[] = $jumlah;
		$data1[] = $total;
		$data1[] = $tgl;
		$sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
		$row1 = $config -> prepare($sql1);
		$row1 -> execute($data1);

		$process = "Insert data penjualan";
		$log_write = $log->recordProcLog($process);

 		echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
		
	}
	
/*
	if(!empty($_GET['data_umum'])){
		$pemda= $_POST['pemda'];
		$opd= $_POST['opd'];
		$unor= $_POST['unor'];
		//$tgl= date("j F Y, G:i");
		$data[] = $pemda;
		$data[] = $opd;
		$data[] = $unor;
		$sql = 'INSERT INTO data_umum (pemda,opd,unor) VALUES(?,?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=data_umum&&success=tambah-data"</script>';
	}
*/

	// if(!empty($_GET['data_umum'])){
	// 	$pemda= $_POST['pemda'];
	// 	$opd= $_POST['opd'];
	// 	$unor= $_POST['unor'];
	// 	$nama_kegiatan= $_POST['nama_kegiatan'];
	// 	$ruas_jalan=$_POST['ruas_jalan'];
	// 	$segmen_jalan=$_POST['segmen_jalan'];
	// 	$no_kontrak=$_POST['no_kontrak'];
	// 	$tgl_kontrak=$_POST['tgl_kontrak'];
	// 	$nilai_kontrak=$_POST['nilai_kontrak'];
	// 	$no_spmk=$_POST['no_spmk'];
	// 	$tgl_spmk=$_POST['tgl_spmk'];
	// 	$panjang=$_POST['panjang'];
	// 	$waktu_pelaksanaan=$_POST['waktu_pelaksanaan'];
	// 	$ppk=$_POST['ppk'];
	// 	$penyedia_jasa=$_POST['penyedia_jasa'];
	// 	$konsultan=$_POST['konsultan'];
	// 	$nama_ppk=$_POST['nama_ppk'];
	// 	$nama_se=$_POST['nama_se'];
	// 	$nama_gs=$_POST['nama_gs'];
	// 	$lat=$_POST['lat'];
	// 	$lng=$_POST['lng'];
	// 	$tgl = date("j F Y, G:i");
		
	// 	$rab = $_FILES['rab']['name'];
	// 	$tmp_rab = $_FILES['rab']['tmp_name'];
		
	// 	$pk = $_FILES['pk']['name'];
	// 	$tmp_pk = $_FILES['pk']['tmp_name'];

	// 	$sm = $_FILES['sm']['name'];
	// 	$tmp_sm = $_FILES['sm']['tmp_name'];

	// 	$sk = $_FILES['sk']['name'];
	// 	$tmp_sk = $_FILES['sk']['tmp_name'];

	// 	$ul_spmk = $_FILES['ul_spmk']['name'];
	// 	$tmp_ul_spmk = $_FILES['ul_spmk']['tmp_name'];		

	// 	$ul_jadual = $_FILES['ul_jadual']['name'];
	// 	$tmp_ul_jadual = $_FILES['ul_jadual']['tmp_name'];		
		
	// 	$ul_rencana = $_FILES['ul_rencana']['name'];
	// 	$tmp_ul_rencana = $_FILES['ul_rencana']['tmp_name'];		
		
	// 	// Rename nama fotonya dengan menambahkan tanggal dan jam upload
	// 	$rabbaru = date('dmYHis').$rab;
	// 	$pkbaru = date('dmYHis').$pk;
	// 	$smbaru = date('dmYHis').$sm;
	// 	$skbaru = date('dmYHis').$sk;
	// 	$ul_spmkbaru = date('dmYHis').$ul_spmk;
	// 	$ul_jadualbaru = date('dmYHis').$ul_jadual;
	// 	$ul_rencanabaru = date('dmYHis').$ul_rencana;
		
	// 	// Set path folder tempat menyimpan fotonya
	// 	$path_rab = "../../assets/img/laporan/".$rabbaru;
	// 	$path_pk = "../../assets/img/laporan/".$pkbaru;
	// 	$path_sm = "../../assets/img/laporan/".$smbaru;
	// 	$path_sk = "../../assets/img/laporan/".$skbaru;
	// 	$path_ul_spmk = "../../assets/img/laporan/".$ul_spmkbaru;
	// 	$path_ul_rencana = "../../assets/img/laporan/".$ul_rencanabaru;
	// 	$path_ul_jadual = "../../assets/img/laporan/".$ul_jadualbaru;
		
	// 	// Proses upload
	// 		if(move_uploaded_file($tmp_rab, $path_rab)) {// Cek apakah gambar berhasil diupload atau tidak

	// 			//$tgl= date("j F Y, G:i");
	// 			$data[] = $pemda;
	// 			$data[] = $opd;
	// 			$data[] = $unor;
	// 			$data[] = $nama_kegiatan;
	// 			$data[] = $ruas_jalan;
	// 			$data[] = $segmen_jalan;
	// 			$data[] = $no_kontrak;
	// 			$data[] = $tgl_kontrak;
	// 			$data[] = $nilai_kontrak;
	// 			$data[] = $no_spmk;
	// 			$data[] = $tgl_spmk;
	// 			$data[] = $panjang;
	// 			$data[] = $waktu_pelaksanaan;
	// 			$data[] = $ppk;
	// 			$data[] = $penyedia_jasa;
	// 			$data[] = $konsultan;
	// 			$data[] = $nama_ppk;
	// 			$data[] = $nama_se;
	// 			$data[] = $nama_gs;
	// 			$data[] = $lat;
	// 			$data[] = $lng;
	// 			$data[] = $rabbaru;
	// 			$data[] = $pkbaru;
	// 			$data[] = $smbaru;
	// 			$data[] = $skbaru;
	// 			$data[] = $ul_spmkbaru;
	// 			$data[] = $ul_jadualbaru;
	// 			$data[] = $ul_rencanabaru;
	// 			$data[] = $tgl;
	// 			$sql = 'INSERT INTO data_umum (pemda,opd,unor,nama_kegiatan,nama_ruas_jalan,segmen_jalan,no_kontrak,tgl_kontrak,nilai_kontrak,no_spmk,tgl_spmk,panjang,waktu_pelaksanaan,ppk,penyedia_jasa,konsultan_supervisi,nama_ppk,nama_se,nama_gs,lat,lng,rab,pk,sk,sm,ul_spmk,ul_jadual,ul_rencana,tgl_input) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	// 			move_uploaded_file($tmp_pk,$path_pk);
	// 			move_uploaded_file($tmp_sm,$path_sm);
	// 			move_uploaded_file($tmp_sk,$path_sk);
	// 			move_uploaded_file($tmp_ul_spmk,$path_ul_spmk);
	// 			move_uploaded_file($tmp_ul_jadual,$path_ul_jadual);
	// 			move_uploaded_file($tmp_ul_rencana,$path_ul_rencana);
	// 			$row = $config -> prepare($sql);
	// 			$row -> execute($data);

	// 			$process = "Insert data umum";
	// 			$log_write = $log->recordProcLog($process);

	// 			echo '<script>window.location="../../index.php?page=data_umum&success=tambah-data"</script>';
	// 			}
	// 		else{
	// 			// Jika gambar gagal diupload, Lakukan :
	// 			echo "Maaf, Gambar gagal untuk diupload.";
	// 			// header('location:../../media.php?modul='.$modul);
	// 			}
	// 	}
//--------------------------------------------------------------------------------------------------------------------------------------------------