<?php
class lap_harian{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "dbsik";   
	private $lap_harianUserTable = 'master_user';	
    private $lap_harianMasterTable = 'master_laporan_harian';
	private $lap_harianDetailTable = 'detail_laporan_harian_pekerjaan';
	private $lap_harianDetailTable_bahan = 'detail_laporan_harian_bahan';
	private $lap_harianDetailTable_beton = 'detail_laporan_harian_beton';
	private $lap_harianDetailTable_cuaca = 'detail_laporan_harian_cuaca';
	private $lap_harianDetailTable_hotmix = 'detail_laporan_harian_hotmix';
	private $lap_harianDetailTable_intruksi = 'detail_laporan_harian_intruksi';
	private $lap_harianDetailTable_peralatan = 'detail_laporan_harian_peralatan';
	private $lap_harianDetailTable_tkerja = 'detail_laporan_harian_tkerja';
	private $request='request';
	private $request_detail_bahan ='detail_request_bahan';
	private $request_detail_peralatan ='detail_request_peralatan';
	private $request_detail_tkerja ='detail_request_tkerja';
	private $jadual='jadual';
	private $jadual_detail='detail_jadual';
	private $data_umum='data_umum';
	private $data_umum_ruas='data_umum_ruas';
	
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
			//echo'error';
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	public function loginUsers($email, $password){
		$sqlQuery = "
			SELECT id, email, user 
			FROM ".$this->lap_harianUserTable." 
			WHERE email='".$email."' AND pass='".$password."'";
        return  $this->getData($sqlQuery);
	}	
	public function checkLoggedIn(){
		if(!$_SESSION['userid']) {
			header("Location:index.php");
		}
	}
/*	----------------------save ori -----------------------------------------------------------------------------------*/
/*
	public function saveInvoice($POST) {

		$sqlInsert = "
			INSERT INTO ".$this->lap_harianMasterTable."(user,kegiatan,ruas_jalan) 
			VALUES ('".$POST['userId']."', '".$POST['companyName']."', '".$POST['address']."')";
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['productCode']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->lap_harianDetailTable."(no_trans,sta_awal,sta_akhir) 
			VALUES ('".$lastInsertId."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}       	
	}	
	

*/
	public function saveInvoice($POST) {
//generate  number
/*
$awalan='LH-';
$lebar=6;

	$query="select no_trans from master_laporan_harian order by no_trans desc limit 1";
	$hasil=mysqli_query($this,$query);
	$jumlahrecord = mysqli_num_rows($hasil);
	if($jumlahrecord == 0){
		$nomor=1;
	}
	else
	{
		$row=mysqli_fetch_array($hasil);
		$nomor=intval(substr($row[0],strlen($awalan)))+1;
	}
	if($lebar>0){
		$angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
	}
	else{
		$angka = $awalan.$nomor;
	}
	//return $angka;
	
	$notrans=$angka;
*/

//----------------------------------------------------awal data laporan -------------------------------------------------------------------------------------------------------------
		$soft = $_FILES['soft']['name'];
		$tmp_soft = $_FILES['soft']['tmp_name'];
		$softbaru = date('dmYHis').$soft;
		$path_soft = "lampiran/lh/".$softbaru;
		

		$tgl = date("j F Y, G:i");
		
		$sqlInsert = "
			INSERT INTO ".$this->lap_harianMasterTable."(nmp,satuan,volume,no_request,unor,user,kegiatan,ruas_jalan,tanggal,segmen_jalan,ket,nama_kontraktor,nama_ppk,nama_konsultan,tgl_input,gambar) 
			VALUES ('".$POST['jenis_pekerjaan_master']."','".$POST['satuan_master']."','".$POST['volume_master']."','".$POST['request']."','".$POST['unor']."','".$POST['userId']."', '".$POST['kegiatan']."', '".$POST['ruas_jalan']."', '".$POST['tanggal']."', '".$POST['segmen_jalan']."', '".$POST['notes']."','".$POST['kontraktor']."', '".$POST['ppk']."','".$POST['konsultan']."','".$tgl."','".$softbaru."')";		
		move_uploaded_file($tmp_soft,$path_soft);
		mysqli_query($this->dbConnect, $sqlInsert);
		
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['no_pekerjaan']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->lap_harianDetailTable."(no_trans,no_pekerjaan,jenis_pekerjaan,sta_awal,sta_akhir,ki_ka,volume,satuan,ket,tgl) 
			VALUES ('".$lastInsertId."', '".$POST['no_pekerjaan'][$i]."', '".$POST['jenis_pekerjaan'][$i]."', '".$POST['sta_awal'][$i]."', '".$POST['sta_akhir'][$i]."', '".$POST['ki_ka'][$i]."', '".$POST['volume'][$i]."', '".$POST['satuan'][$i]."', '".$POST['ket'][$i]."', '".$POST['tanggal']."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem);

		};
		for ($i = 0; $i < count($POST['bahan']); $i++) {
			$sqlInsertItem_bahan = "
			INSERT INTO ".$this->lap_harianDetailTable_bahan."(no_trans,bahan,volume,satuan) 
			VALUES ('".$lastInsertId."', '".$POST['bahan'][$i]."', '".$POST['volume_bahan'][$i]."', '".$POST['satuan_bahan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_bahan);

		};
		for ($i = 0; $i < count($POST['bahan_beton']); $i++) {
			$sqlInsertItem_bahan_beton = "
			INSERT INTO ".$this->lap_harianDetailTable_beton."(no_trans,bahan_beton,no_tm,waktu_datang,waktu_curah,slump_test,satuan,ket) 
			VALUES ('".$lastInsertId."', '".$POST['bahan_beton'][$i]."', '".$POST['no_tm'][$i]."', '".$POST['waktu_datang'][$i]."', '".$POST['waktu_curah'][$i]."', '".$POST['slump_test'][$i]."', '".$POST['satuan_beton'][$i]."', '".$POST['ket_beton'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_bahan_beton);
		}; 		

		for ($i = 0; $i < count($POST['cerah']); $i++) {
			$sqlInsertItem_cuaca = "
			INSERT INTO ".$this->lap_harianDetailTable_cuaca."(no_trans,cerah,hujan_ringan,hujan_lebat,bencana_alam,lain_lain) 
			VALUES ('".$lastInsertId."', '".$POST['cerah'][$i]."', '".$POST['hujan_ringan'][$i]."', '".$POST['hujan_lebat'][$i]."', '".$POST['bencana_alam'][$i]."', '".$POST['lain_lain'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_cuaca);
		};		

		for ($i = 0; $i < count($POST['bahan_hotmix']); $i++) {
			$sqlInsertItem_bahan_hotmix = "
			INSERT INTO ".$this->lap_harianDetailTable_hotmix."(no_trans,bahan_hotmix,no_dt,waktu_datang,waktu_hampar,suhu_datang,suhu_hampar,pro_p,pro_i,pro_t,ket) 
			VALUES ('".$lastInsertId."', '".$POST['bahan_hotmix'][$i]."','".$POST['no_dt'][$i]."', '".$POST['waktu_datang'][$i]."', '".$POST['waktu_hampar'][$i]."', '".$POST['suhu_datang'][$i]."', '".$POST['suhu_hampar'][$i]."', '".$POST['pro_p'][$i]."', '".$POST['pro_i'][$i]."', '".$POST['pro_t'][$i]."', '".$POST['ket_hotmix'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_bahan_hotmix);
		};	

		for ($i = 0; $i < count($POST['jenis_peralatan']); $i++) {
			$sqlInsertItem_peralatan = "
			INSERT INTO ".$this->lap_harianDetailTable_peralatan."(no_trans,jenis_peralatan,jumlah,satuan) 
			VALUES ('".$lastInsertId."', '".$POST['jenis_peralatan'][$i]."', '".$POST['jumlah_peralatan'][$i]."', '".$POST['satuan_peralatan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_peralatan);
		};

		for ($i = 0; $i < count($POST['tenaga_kerja']); $i++) {
			$sqlInsertItem_tkerja = "
			INSERT INTO ".$this->lap_harianDetailTable_tkerja."(no_trans,tenaga_kerja,jumlah) 
			VALUES ('".$lastInsertId."', '".$POST['tenaga_kerja'][$i]."', '".$POST['jumlah_tk'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_tkerja);
		};
echo '<script>window.location="index.php?page=laporan&success=tambah-data"</script>';			
	}	

//---------------------------------------------akhir save data Laporan --------------------------------------------------------------------------------------------------------------------
	
	public function saveRequest($POST) {

		$sketsa = $_FILES['sketsa']['name'];
		$tmp_sketsa = $_FILES['sketsa']['tmp_name'];
		$sketsabaru = date('dmYHis').$sketsa;
		$path_sketsa = "lampiran/req/".$sketsabaru;
		

		$tgl = date("j F Y, G:i");
		move_uploaded_file($tmp_sketsa,$path_sketsa);
		
		$sqlInsert = "
			INSERT INTO ".$this->request."(unor,satuan,user,nama_kegiatan,jenis_pekerjaan,diajukan_tgl,lokasi_sta,volume,pelaksanaan_tgl,sketsa,catatan_surveyor,catatan_inspector,catatan_technician,ci,qe,nama_kontraktor,nama_direksi,nama_ppk,note,tgl_input) 
			VALUES ('".$POST['unor']."','".$POST['satuan']."','".$POST['userId']."', '".$POST['kegiatan']."', '".$POST['jenis_pekerjaan']."', '".$POST['diajukan_tgl']."', '".$POST['lokasi_sta']."', '".$POST['perkiraan_volume']."', '".$POST['pelaksanaan_tgl']."', '".$sketsabaru."', '".$POST['surveyor']."', '".$POST['inspector']."', '".$POST['technician']."', '".$POST['ci']."', '".$POST['qe']."', '".$POST['penyedia_jasa']."', '".$POST['konsultan']."', '".$POST['nama_ppk']."', '".$POST['disetujui']."','".$tgl."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		
		for ($i = 0; $i < count($POST['bahan']); $i++) {
			$sqlInsertItem_bahan = "
			INSERT INTO ".$this->request_detail_bahan."(id,bahan,volume,satuan) 
			VALUES ('".$lastInsertId."', '".$POST['bahan'][$i]."', '".$POST['volume_bahan'][$i]."', '".$POST['satuan_bahan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_bahan);

		};

		for ($i = 0; $i < count($POST['jenis_peralatan']); $i++) {
			$sqlInsertItem_peralatan = "
			INSERT INTO ".$this->request_detail_peralatan."(id,jenis_peralatan,jumlah,satuan) 
			VALUES ('".$lastInsertId."', '".$POST['jenis_peralatan'][$i]."', '".$POST['jumlah_peralatan'][$i]."', '".$POST['satuan_peralatan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_peralatan);
		};

		for ($i = 0; $i < count($POST['tenaga_kerja']); $i++) {
			$sqlInsertItem_tkerja = "
			INSERT INTO ".$this->request_detail_tkerja."(id,tenaga_kerja,jumlah) 
			VALUES ('".$lastInsertId."', '".$POST['tenaga_kerja'][$i]."', '".$POST['jumlah_tk'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_tkerja);
		};	
echo '<script>window.location="index.php?page=request&success=tambah-data"</script>';		
	}	

//---------------------------------------------akhir save data --------------------------------------------------------------------------------------------------------------------
	
	public function saveJadual($POST) {
/*
		$sketsa = $_FILES['sketsa']['name'];
		$tmp_sketsa = $_FILES['sketsa']['tmp_name'];
		$sketsabaru = date('dmYHis').$sketsa;
		$path_sketsa = "../../assets/img/laporan/".$sketsabaru;
		move_uploaded_file($tmp_sketsa,$path_sketsa);
*/		$tgl = date("j F Y, G:i");
		$sqlInsert = "
			INSERT INTO ".$this->jadual."(satuan,nama_ppk,unor,harga_satuan,volume,nilai_kontrak,jumlah_harga,bobot,id_data_umum,nmp,user,kegiatan,ruas_jalan,waktu_pelaksanaan,panjang,ppk,nama_penyedia,konsultan,tgl_input) 
			VALUES ('".$POST['satuan1']."','".$POST['nama_ppk']."','".$POST['unor']."','".$POST['harga_satuan1']."','".$POST['volume1']."','".$POST['nilai_kontrak']."','".$POST['jumlah_harga1']."','".$POST['bobot1']."','".$POST['id_data_umum']."','".$POST['nmp1']."','".$POST['userId']."', '".$POST['kegiatan']."', '".$POST['ruas_jalan']."', '".$POST['waktu']."', '".$POST['panjang']."','".$POST['ppk']."', '".$POST['nama_penyedia']."','".$POST['konsultan']."', '".$tgl."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		
		
		for ($i = 0; $i < count($POST['nmp']); $i++) {
			$sqlInsertItem_jadual = "
			INSERT INTO ".$this->jadual_detail."(id,tgl,nmp,uraian,satuan,harga_satuan,volume,jumlah_harga,bobot,koefisien,nilai) 
			VALUES ('".$lastInsertId."', '".$POST['tgl'][$i]."', '".$POST['nmp'][$i]."', '".$POST['uraian'][$i]."', '".$POST['satuan'][$i]."', '".$POST['harga_satuan'][$i]."', '".$POST['volume'][$i]."', '".$POST['jumlah_harga'][$i]."', '".$POST['bobot'][$i]."', '".$POST['koefisien'][$i]."', '".$POST['nilai'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_jadual);

		};
/*
		for ($i = 0; $i < count($POST['jenis_peralatan']); $i++) {
			$sqlInsertItem_peralatan = "
			INSERT INTO ".$this->request_detail_peralatan."(id,jenis_peralatan,jumlah,satuan) 
			VALUES ('".$lastInsertId."', '".$POST['jenis_peralatan'][$i]."', '".$POST['jumlah_peralatan'][$i]."', '".$POST['satuan_peralatan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_peralatan);
		};

		for ($i = 0; $i < count($POST['tenaga_kerja']); $i++) {
			$sqlInsertItem_tkerja = "
			INSERT INTO ".$this->request_detail_tkerja."(id,tenaga_kerja,jumlah) 
			VALUES ('".$lastInsertId."', '".$POST['tenaga_kerja'][$i]."', '".$POST['jumlah_tk'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_tkerja);
		};	
*/		
echo '<script>window.location="index.php?page=schedule&success=tambah-data"</script>';
	}	

//---------------------------------------------akhir save data --------------------------------------------------------------------------------------------------------------------
	
	public function saveDataUmum($POST) {
/*
		$sketsa = $_FILES['sketsa']['name'];
		$tmp_sketsa = $_FILES['sketsa']['tmp_name'];
		$sketsabaru = date('dmYHis').$sketsa;
		$path_sketsa = "../../assets/img/laporan/".$sketsabaru;
		move_uploaded_file($tmp_sketsa,$path_sketsa);
*/		$tgl = date("j F Y, G:i");
		$rab = $_FILES['rab']['name'];
		$tmp_rab = $_FILES['rab']['tmp_name'];
		
		$pk = $_FILES['pk']['name'];
		$tmp_pk = $_FILES['pk']['tmp_name'];

		$sm = $_FILES['sm']['name'];
		$tmp_sm = $_FILES['sm']['tmp_name'];

		$sk = $_FILES['sk']['name'];
		$tmp_sk = $_FILES['sk']['tmp_name'];

		$ul_spmk = $_FILES['ul_spmk']['name'];
		$tmp_ul_spmk = $_FILES['ul_spmk']['tmp_name'];		

		$ul_jadual = $_FILES['ul_jadual']['name'];
		$tmp_ul_jadual = $_FILES['ul_jadual']['tmp_name'];		
		
		$ul_rencana = $_FILES['ul_rencana']['name'];
		$tmp_ul_rencana = $_FILES['ul_rencana']['tmp_name'];		
		
		// Rename nama fotonya dengan menambahkan tanggal dan jam upload
		$rabbaru = date('dmYHis').$rab;
		$pkbaru = date('dmYHis').$pk;
		$smbaru = date('dmYHis').$sm;
		$skbaru = date('dmYHis').$sk;
		$ul_spmkbaru = date('dmYHis').$ul_spmk;
		$ul_jadualbaru = date('dmYHis').$ul_jadual;
		$ul_rencanabaru = date('dmYHis').$ul_rencana;
		
		// Set path folder tempat menyimpan fotonya
		$path_rab = "lampiran/umum/".$rabbaru;
		$path_pk = "lampiran/umum/".$pkbaru;
		$path_sm = "lampiran/umum/".$smbaru;
		$path_sk = "lampiran/umum/".$skbaru;
		$path_ul_spmk = "lampiran/umum/".$ul_spmkbaru;
		$path_ul_rencana = "lampiran/umum/".$ul_rencanabaru;
		$path_ul_jadual = "lampiran/umum/".$ul_jadualbaru;
				move_uploaded_file($tmp_rab,$path_rab);
				move_uploaded_file($tmp_pk,$path_pk);
				move_uploaded_file($tmp_sm,$path_sm);
				move_uploaded_file($tmp_sk,$path_sk);
				move_uploaded_file($tmp_ul_spmk,$path_ul_spmk);
				move_uploaded_file($tmp_ul_jadual,$path_ul_jadual);
				move_uploaded_file($tmp_ul_rencana,$path_ul_rencana);

		
		$sqlInsert = "
			INSERT INTO ".$this->data_umum."(pemda,opd,unor,nama_kegiatan,no_kontrak,tgl_kontrak,nilai_kontrak,no_spmk,tgl_spmk,panjang,
			waktu_pelaksanaan,ppk,penyedia_jasa,konsultan_supervisi,nama_ppk,nama_se,nama_gs,rab,pk,sk,sm,ul_spmk,ul_jadual,ul_rencana,tgl_input) 
			VALUES ('".$POST['pemda']."', '".$POST['opd']."', '".$POST['unor']."','".$POST['nama_kegiatan']."', '".$POST['no_kontrak']."',
			'".$POST['tgl_kontrak']."', 
			'".$POST['nilai_kontrak']."','".$POST['no_spmk']."','".$POST['tgl_spmk']."','".$POST['panjang']."','".$POST['waktu_pelaksanaan']."','".$POST['ppk']."',
			'".$POST['penyedia_jasa']."','".$POST['konsultan']."','".$POST['nama_ppk']."','".$POST['nama_se']."','".$POST['nama_gs']."','".$rabbaru."',
			'".$pkbaru."','".$skbaru."','".$smbaru."','".$ul_spmkbaru."','".$ul_jadualbaru."','".$ul_rencanabaru."','".$tgl."')";		
		mysqli_query($this->dbConnect, $sqlInsert);

		
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		
		for ($i = 0; $i < count($POST['ruas_jalan']); $i++) {
			$sqlInsert_ruas = "
			INSERT INTO ".$this->data_umum_ruas."(id,ruas_jalan,lat_awal,long_awal,lat_akhir,long_akhir,segmen_jalan) 
			VALUES ('".$lastInsertId."', '".$POST['ruas_jalan'][$i]."', '".$POST['lat_awal'][$i]."', '".$POST['long_awal'][$i]."', '".$POST['lat_akhir'][$i]."', '".$POST['long_akhir'][$i]."','".$POST['segmen_jalan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsert_ruas);

		};
	
echo '<script>window.location="index.php?page=data_umum&success=tambah-data"</script>';
	}


//---------------------------------------------akhir save data --------------------------------------------------------------------------------------------------------------------

//-----------------------------------------------------DELETE ISI LAPORAN DETAIL DATA----------------------------------------------------------------------------------------------------	
		//-----------------------
		public function deletelap_harianDetailTable1($POST){
			if($POST['lapId']) {
				$sqlQuery = "
					DELETE FROM ".$this->lap_harianDetailTable." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery);		
			}		
		}

		public function deletelap_harianDetailTable_bahan1($POST){
			if($POST['lapId']) {
				$sqlQuery_bahan = "
					DELETE FROM ".$this->lap_harianDetailTable_bahan." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_bahan);		
			}		
		}
		
		public function deletelap_harianDetailTable_beton1($POST){
			if($POST['lapId']) {
				$sqlQuery_beton = "
					DELETE FROM ".$this->lap_harianDetailTable_beton." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_beton);		
			}		
		}

		public function deletelap_harianDetailTable_cuaca1($POST){
			if($POST['lapId']) {
				$sqlQuery_cuaca = "
					DELETE FROM ".$this->lap_harianDetailTable_cuaca." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_cuaca);		
			}		
		}		

		public function deletelap_harianDetailTable_hotmix1($POST){
			if($POST['lapId']) {
				$sqlQuery_hotmix = "
					DELETE FROM ".$this->lap_harianDetailTable_hotmix." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_hotmix);		
			}		
		}	

		public function deletelap_harianDetailTable_peralatan1($POST){
			if($POST['lapId']) {
				$sqlQuery_peralatan = "
					DELETE FROM ".$this->lap_harianDetailTable_peralatan." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_peralatan);		
			}		
		}	

		public function deletelap_harianDetailTable_tkerja1($POST){
			if($POST['lapId']) {
				$sqlQuery_tkerja = "
					DELETE FROM ".$this->lap_harianDetailTable_tkerja." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_tkerja);		
			}		
		}		
		//-----------------------

//-----------------------------------------------------UPDATE DATA LAPORAN HARIAN-----------------------------------------------------------------------------------------------	

public function updateLapharian($POST) {
		//$soft = $_FILES['soft']['name'];
		//$tmp_soft = $_FILES['soft']['tmp_name'];
		//$softbaru = date('dmYHis').$soft;
		//$path_soft = "lampiran/lh/".$softbaru;
		

		$tgl = date("j F Y, G:i");
		
	if($POST['lapId']) {	
			$sqlInsert = "
				UPDATE ".$this->lap_harianMasterTable." 
				SET kegiatan = '".$POST['kegiatan']."', ruas_jalan= '".$POST['ruas_jalan']."', ket = '".$POST['notes']."', segmen_jalan = '".$POST['segmen_jalan']."',
				nama_kontraktor = '".$POST['kontraktor']."', nama_ppk = '".$POST['ppk']."', nama_konsultan = '".$POST['konsultan']."', tgl_update =  '".$tgl."'
				
				WHERE user = '".$POST['userId']."' AND no_trans = '".$POST['lapId']."'";		
			//move_uploaded_file($tmp_soft,$path_soft);
			mysqli_query($this->dbConnect, $sqlInsert);	
			
		$lastInsertId = $POST['lapId'];

		//$this->deletelap_harianDetailTable1($POST['lapId']);
			$sqlQuery = "
					DELETE FROM ".$this->lap_harianDetailTable." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery);	
			
		for ($i = 0; $i < count($POST['no_pekerjaan']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->lap_harianDetailTable."(no_trans,no_pekerjaan,jenis_pekerjaan,sta_awal,sta_akhir,ki_ka,volume,satuan,ket) 
			VALUES ('".$lastInsertId."', '".$POST['no_pekerjaan'][$i]."', '".$POST['jenis_pekerjaan'][$i]."', '".$POST['sta_awal'][$i]."', '".$POST['sta_akhir'][$i]."', '".$POST['ki_ka'][$i]."', '".$POST['volume'][$i]."', '".$POST['satuan'][$i]."', '".$POST['ket'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem);

		};
		
		//$this->deletelap_harianDetailTable_bahan1($POST['lapId']);
			$sqlQuery_bahan = "
					DELETE FROM ".$this->lap_harianDetailTable_bahan." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_bahan);
		
		for ($i = 0; $i < count($POST['bahan']); $i++) {
			$sqlInsertItem_bahan = "
			INSERT INTO ".$this->lap_harianDetailTable_bahan."(no_trans,bahan,volume,satuan) 
			VALUES ('".$lastInsertId."', '".$POST['bahan'][$i]."', '".$POST['volume_bahan'][$i]."', '".$POST['satuan_bahan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_bahan);

		};
		
		//$this->deletelap_harianDetailTable_beton1($POST['lapId']);
			$sqlQuery_beton = "
					DELETE FROM ".$this->lap_harianDetailTable_beton." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_beton);
		
		for ($i = 0; $i < count($POST['bahan_beton']); $i++) {
			$sqlInsertItem_bahan_beton = "
			INSERT INTO ".$this->lap_harianDetailTable_beton."(no_trans,bahan_beton,no_tm,waktu_datang,waktu_curah,slump_test,satuan,ket) 
			VALUES ('".$lastInsertId."', '".$POST['bahan_beton'][$i]."', '".$POST['no_tm'][$i]."', '".$POST['waktu_datang'][$i]."', '".$POST['waktu_curah'][$i]."', '".$POST['slump_test'][$i]."', '".$POST['satuan_beton'][$i]."', '".$POST['ket_beton'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_bahan_beton);
		}; 		

		//$this->deletelap_harianDetailTable_cuaca1($POST['lapId']);
			$sqlQuery_cuaca = "
					DELETE FROM ".$this->lap_harianDetailTable_cuaca." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_cuaca);		
			
		for ($i = 0; $i < count($POST['cerah']); $i++) {
			$sqlInsertItem_cuaca = "
			INSERT INTO ".$this->lap_harianDetailTable_cuaca."(no_trans,cerah,hujan_ringan,hujan_lebat,bencana_alam,lain_lain) 
			VALUES ('".$lastInsertId."', '".$POST['cerah'][$i]."', '".$POST['hujan_ringan'][$i]."', '".$POST['hujan_lebat'][$i]."', '".$POST['bencana_alam'][$i]."', '".$POST['lain_lain'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_cuaca);
		};		

		//$this->deletelap_harianDetailTable_hotmix1($POST['lapId']);
			$sqlQuery_hotmix = "
					DELETE FROM ".$this->lap_harianDetailTable_hotmix." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_hotmix);			
		
		for ($i = 0; $i < count($POST['bahan_hotmix']); $i++) {
			$sqlInsertItem_bahan_hotmix = "
			INSERT INTO ".$this->lap_harianDetailTable_hotmix."(no_trans,bahan_hotmix,no_dt,waktu_datang,waktu_hampar,suhu_datang,suhu_hampar,pro_p,pro_i,pro_t,ket) 
			VALUES ('".$lastInsertId."', '".$POST['bahan_hotmix'][$i]."','".$POST['no_dt'][$i]."', '".$POST['waktu_datang'][$i]."', '".$POST['waktu_hampar'][$i]."', '".$POST['suhu_datang'][$i]."', '".$POST['suhu_hampar'][$i]."', '".$POST['pro_p'][$i]."', '".$POST['pro_i'][$i]."', '".$POST['pro_t'][$i]."', '".$POST['ket_hotmix'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_bahan_hotmix);
		};	

		//$this->deletelap_harianDetailTable_peralatan1($POST['lapId']);
			$sqlQuery_peralatan = "
					DELETE FROM ".$this->lap_harianDetailTable_peralatan." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_peralatan);			
		
		for ($i = 0; $i < count($POST['jenis_peralatan']); $i++) {
			$sqlInsertItem_peralatan = "
			INSERT INTO ".$this->lap_harianDetailTable_peralatan."(no_trans,jenis_peralatan,jumlah,satuan) 
			VALUES ('".$lastInsertId."', '".$POST['jenis_peralatan'][$i]."', '".$POST['jumlah_peralatan'][$i]."', '".$POST['satuan_peralatan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_peralatan);
		};

		//$this->deletelap_harianDetailTable_tkerja1($POST['lapId']);
			$sqlQuery_tkerja = "
					DELETE FROM ".$this->lap_harianDetailTable_tkerja." 
					WHERE no_trans = '".$POST['lapId']."'";
			mysqli_query($this->dbConnect, $sqlQuery_tkerja);			
		
		for ($i = 0; $i < count($POST['tenaga_kerja']); $i++) {
			$sqlInsertItem_tkerja = "
			INSERT INTO ".$this->lap_harianDetailTable_tkerja."(no_trans,tenaga_kerja,jumlah) 
			VALUES ('".$lastInsertId."', '".$POST['tenaga_kerja'][$i]."', '".$POST['jumlah_tk'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_tkerja);
		};
			
			
	}
		echo '<script>window.location="index.php?page=laporan&success=update-data"</script>';			
}


//-----------------------------------------------------DELETE ISI LAPORAN DETAIL DATA----------------------------------------------------------------------------------------------------	
		//-----------------------
		public function deletejadualDetail1($POST){
			if($POST['schId']) {
				$sqlQuery = "
					DELETE FROM ".$this->jadual_detail." 
					WHERE id = '".$POST['schId']."' AND nmp = '".$POST['nmp1']."'";
			mysqli_query($this->dbConnect, $sqlQuery);		
			}		
		}
		
//-----------------------------------------------------UPDATE DATA JADUAL--------------------------------------------------------------------------------------------------	

public function updateSchedule($POST) {
	//$tgl = date("j F Y, G:i");
	if($POST['schId']) {	
			$sqlInsert = "
				UPDATE ".$this->jadual." 
				SET kegiatan = '".$POST['kegiatan']."', ruas_jalan= '".$POST['ruas_jalan']."', waktu_pelaksanaan = '".$POST['waktu']."', panjang = '".$POST['panjang']."', ppk='".$POST['ppk']."',nama_penyedia='".$POST['nama_penyedia']."',konsultan='".$POST['konsultan']."',tgl_update= '".$tgl."'
				WHERE user = '".$POST['userId']."' AND id = '".$POST['schId']."' AND nmp = '".$POST['nmp1']."'" ;		
			mysqli_query($this->dbConnect, $sqlInsert);	
		
			$sqlQuery = "
					DELETE FROM ".$this->jadual_detail." 
					WHERE id = '".$POST['schId']."' AND nmp = '".$POST['nmp1']."'";
			mysqli_query($this->dbConnect, $sqlQuery);	
		$lastInsertId = $POST['schId'];
		//$this->deletejadualDetail1($POST['schId']);
		for ($i = 0; $i < count($POST['nmp']); $i++) {
			$sqlInsertItem_jadual = "
			INSERT INTO ".$this->jadual_detail."(id,tgl,nmp,uraian,satuan,harga_satuan,volume,jumlah_harga,bobot,koefisien,nilai) 
			VALUES ('".$lastInsertId."', '".$POST['tgl'][$i]."','".$POST['nmp'][$i]."', '".$POST['uraian'][$i]."', '".$POST['satuan'][$i]."', '".$POST['harga_satuan'][$i]."', '".$POST['volume'][$i]."', '".$POST['jumlah_harga'][$i]."', '".$POST['bobot'][$i]."', '".$POST['koefisien'][$i]."', '".$POST['nilai'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_jadual);

		};
			
			
	}
		echo '<script>window.location="index.php?page=schedule&success-update=update-data"</script>';			
}

//-----------------------------------------------------DELETE ISI DETAIL DATA Request--------------------------------------------------------------------------------------------	
		//-----------------------
		public function deleterequestbahan1($POST){
			if($POST['reqId']) {
				$sqlQuery = "
					DELETE FROM ".$this->request_detail_bahan." 
					WHERE id = '".$POST['reqId']."'";
			mysqli_query($this->dbConnect, $sqlQuery);		
			}		
		}

		public function deleterequestperalatan1($POST){
			if($POST['reqId']) {
				$sqlQuery = "
					DELETE FROM ".$this->request_detail_peralatan." 
					WHERE id = '".$POST['reqId']."'";
			mysqli_query($this->dbConnect, $sqlQuery);		
			}		
		}	

		public function deleterequesttkerja1($POST){
			if($POST['reqId']) {
				$sqlQuery = "
					DELETE FROM ".$this->request_detail_tkerja." 
					WHERE id = '".$POST['reqId']."'";
			mysqli_query($this->dbConnect, $sqlQuery);		
			}		
		}		
//-----------------------------------------------------UPDATE DATA request--------------------------------------------------------------------------------------------------	
/*
			INSERT INTO ".$this->request."(user,nama_kegiatan,jenis_pekerjaan,diajukan_tgl,lokasi_sta,volume,pelaksanaan_tgl,sketsa,catatan_surveyor,catatan_inspector,catatan_technician,ci,qe,nama_kontraktor,nama_direksi,nama_ppk,note) 
			VALUES ('".$POST['userId']."', '".$POST['kegiatan']."', '".$POST['jenis_pekerjaan']."', '".$POST['diajukan_tgl']."', '".$POST['lokasi_sta']."', '".$POST['perkiraan_volume']."', '".$POST['pelaksanaan_tgl']."', '".$sketsa."', '".$POST['surveyor']."', '".$POST['inspector']."', '".$POST['technician']."', '".$POST['ci']."', '".$POST['qe']."', '".$POST['kontraktor']."', '".$POST['direksi_teknis']."', '".$POST['ppk']."', '".$POST['disetujui']."')";		

*/
public function updateRequest($POST) {
		/*
		$sketsa = $_FILES['sketsa']['name'];
		$tmp_sketsa = $_FILES['sketsa']['tmp_name'];
		$sketsabaru = date('dmYHis').$sketsa;
		$path_sketsa = "lampiran/req/".$sketsabaru;
		*/

	$tgl = date("j F Y, G:i");
	if($POST['reqId']) {	
			$sqlInsert = "
				UPDATE ".$this->request." 
				SET nama_kegiatan = '".$POST['kegiatan']."', jenis_pekerjaan= '".$POST['jenis_pekerjaan']."', diajukan_tgl = '".$POST['diajukan_tgl']."', lokasi_sta = '".$POST['lokasi_sta']."', volume='".$POST['perkiraan_volume']."',pelaksanaan_tgl='".$POST['pelaksanaan_tgl']."',
				tgl_update= '".$tgl."',catatan_surveyor='".$POST['surveyor']."',catatan_inspector='".$POST['inspector']."',catatan_technician='".$POST['technician']."',ci='".$POST['ci']."',qe='".$POST['qe']."',nama_kontraktor='".$POST['penyedia_jasa']."',nama_direksi='".$POST['konsultan']."',nama_ppk='".$POST['nama_ppk']."'
				WHERE user = '".$POST['userId']."' AND id = '".$POST['reqId']."'";	
			move_uploaded_file($tmp_sketsa,$path_sketsa);				
			mysqli_query($this->dbConnect, $sqlInsert);	
		
		$lastInsertId = $POST['reqId'];
		$this->deleterequestbahan1($POST['reqId']);
		for ($i = 0; $i < count($POST['bahan']); $i++) {
			$sqlInsertItem_bahan = "
			INSERT INTO ".$this->request_detail_bahan."(id,bahan,volume,satuan) 
			VALUES ('".$lastInsertId."', '".$POST['bahan'][$i]."', '".$POST['volume_bahan'][$i]."', '".$POST['satuan_bahan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_bahan);

		};
		
		$this->deleterequestperalatan1($POST['reqId']);
		for ($i = 0; $i < count($POST['jenis_peralatan']); $i++) {
			$sqlInsertItem_peralatan = "
			INSERT INTO ".$this->request_detail_peralatan."(id,jenis_peralatan,jumlah,satuan) 
			VALUES ('".$lastInsertId."', '".$POST['jenis_peralatan'][$i]."', '".$POST['jumlah_peralatan'][$i]."', '".$POST['satuan_peralatan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_peralatan);
		};

		$this->deleterequesttkerja1($POST['reqId']);
		for ($i = 0; $i < count($POST['tenaga_kerja']); $i++) {
			$sqlInsertItem_tkerja = "
			INSERT INTO ".$this->request_detail_tkerja."(id,tenaga_kerja,jumlah) 
			VALUES ('".$lastInsertId."', '".$POST['tenaga_kerja'][$i]."', '".$POST['jumlah_tk'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_tkerja);
		};
			
			
	}
		echo '<script>window.location="index.php?page=request&success-update=update-data"</script>';			
}
//--------------------------------delete data umum ruas -------------------------------------------------------------------------------------------------------------------
		public function deletedataumumruas($POST){
			if($POST['data_umum']) {
				$sqlQuery = "
					DELETE FROM ".$this->data_umum_ruas." 
					WHERE id = '".$POST['data_umum']."'";
			mysqli_query($this->dbConnect, $sqlQuery);		
			}		
		}
			
//---------------------------------------update data umum ----------------------------------------------------------------------------------------------------------------
public function updateDataUmum($POST) {
		$tgl = date("j F Y, G:i");	
		/*
			if($POST['reqId']) {	
			$sqlInsert = "
				UPDATE ".$this->request." 
				SET nama_kegiatan = '".$POST['kegiatan']."', jenis_pekerjaan= '".$POST['jenis_pekerjaan']."', diajukan_tgl = '".$POST['diajukan_tgl']."', lokasi_sta = '".$POST['lokasi_sta']."', volume='".$POST['perkiraan_volume']."',pelaksanaan_tgl='".$POST['pelaksanaan_tgl']."',
				sketsa='".$sketsabaru."',tgl_update= '".$tgl."',catatan_surveyor='".$POST['surveyor']."',catatan_inspector='".$POST['inspector']."',catatan_technician='".$POST['technician']."',ci='".$POST['ci']."',qe='".$POST['qe']."',nama_kontraktor='".$POST['kontraktor']."',nama_direksi='".$POST['direksi_teknis']."',nama_ppk='".$POST['ppk']."'
				WHERE user = '".$POST['userId']."' AND id = '".$POST['reqId']."'";	
		*/
		if($POST['data_umum']){
		$sqlInsert = "
			UPDATE ".$this->data_umum."
			SET pemda='".$POST['pemda']."',opd='".$POST['opd']."',unor='".$POST['unor']."',nama_kegiatan='".$POST['nama_kegiatan']."',
			no_kontrak='".$POST['no_kontrak']."',tgl_kontrak='".$POST['tgl_kontrak']."',
			nilai_kontrak='".$POST['nilai_kontrak']."',no_spmk='".$POST['no_spmk']."',tgl_spmk='".$POST['tgl_spmk']."',
			panjang='".$POST['panjang']."',waktu_pelaksanaan='".$POST['waktu_pelaksanaan']."',ppk='".$POST['ppk']."',
			penyedia_jasa='".$POST['penyedia_jasa']."',konsultan_supervisi='".$POST['konsultan']."',nama_ppk='".$POST['nama_ppk']."',nama_se='".$POST['nama_se']."',
			nama_gs='".$POST['nama_gs']."',tgl_update='".$tgl."'
			where id= '".$POST['data_umum']."'";		
		mysqli_query($this->dbConnect, $sqlInsert);
		
			$sqlQuery = "
					DELETE FROM ".$this->data_umum_ruas." 
					WHERE id = '".$POST['data_umum']."'";
			mysqli_query($this->dbConnect, $sqlQuery);	
		
		$lastInsertId = $POST['data_umum'];
		//$this->deletedataumumruas($POST['data_umum']);
		for ($i = 0; $i < count($POST['ruas_jalan']); $i++) {
			$sqlInsert_ruas = "
			INSERT INTO ".$this->data_umum_ruas."(id,ruas_jalan,lat_awal,long_awal,lat_akhir,long_akhir,segmen_jalan) 
			VALUES ('".$lastInsertId."', '".$POST['ruas_jalan'][$i]."', '".$POST['lat_awal'][$i]."', '".$POST['long_awal'][$i]."', '".$POST['lat_akhir'][$i]."', '".$POST['long_akhir'][$i]."', '".$POST['segmen_jalan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsert_ruas);

		};
		}
echo '<script>window.location="index.php?page=data_umum&success-update=update-data"</script>';
	}
//----------------------------------Laporan Harian-------------------------------------------------------------------------------------------------------------------------	
	public function getlap_harianList(){
		$sqlQuery = "
			SELECT * FROM ".$this->lap_harianMasterTable." 
			WHERE user = '".$_SESSION['userid']."'";
		return  $this->getData($sqlQuery);
	}	
	public function getlap_harian($lap_harianId){
		$sqlQuery = "
			SELECT * FROM ".$this->lap_harianMasterTable." 
			WHERE no_trans = '$lap_harianId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	
	public function getlap_harianItems($lap_harianId){
		$sqlQuery = "
			SELECT * FROM ".$this->lap_harianDetailTable." 
			WHERE no_trans = '$lap_harianId'";
		return  $this->getData($sqlQuery);	
	}
	
	public function getlap_harianBahan($lap_harianId){
		$sqlQuery = "
			SELECT * FROM ".$this->lap_harianDetailTable_bahan." 
			WHERE no_trans = '$lap_harianId'";
		return  $this->getData($sqlQuery);	
	}

	public function getlap_harianBeton($lap_harianId){
		$sqlQuery = "
			SELECT * FROM ".$this->lap_harianDetailTable_beton." 
			WHERE no_trans = '$lap_harianId'";
		return  $this->getData($sqlQuery);	
	}	

	public function getlap_harianCuaca($lap_harianId){
		$sqlQuery = "
			SELECT * FROM ".$this->lap_harianDetailTable_cuaca." 
			WHERE no_trans = '$lap_harianId'";
		return  $this->getData($sqlQuery);	
	}	

	public function getlap_harianHotmix($lap_harianId){
		$sqlQuery = "
			SELECT * FROM ".$this->lap_harianDetailTable_hotmix." 
			WHERE no_trans = '$lap_harianId'";
		return  $this->getData($sqlQuery);	
	}	

	public function getlap_harianPeralatan($lap_harianId){
		$sqlQuery = "
			SELECT * FROM ".$this->lap_harianDetailTable_peralatan." 
			WHERE no_trans = '$lap_harianId'";
		return  $this->getData($sqlQuery);	
	}	

	public function getlap_hariantkerja($lap_harianId){
		$sqlQuery = "
			SELECT * FROM ".$this->lap_harianDetailTable_tkerja." 
			WHERE no_trans = '$lap_harianId'";
		return  $this->getData($sqlQuery);	
	}	

//----------------------------------jadual / Schedule ---------------------------------------------------------------------------------------------------------		
	public function get_jadual($jadualId){
		$sqlQuery = "
			SELECT * FROM ".$this->jadual." 
			WHERE id = '$jadualId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}

	public function get_jadualdetail($jadualId){
		$sqlQuery = "
			SELECT * FROM ".$this->jadual_detail." 
			WHERE id = '$jadualId'";
		return  $this->getData($sqlQuery);	
	}	


	public function get_jadual_kontraktor($jadualId){
		$sqlQuery = "
			SELECT * FROM ".$this->jadual." 
			WHERE nama_penyedia = '".$_SESSION['perusahaan']."' AND id = '$jadualId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}




//----------------------------------Request ---------------------------------------------------------------------------------------------------------		
/*	public function get_request($requestId){
		$sqlQuery = "
			SELECT * FROM ".$this->request." 
			WHERE user = '".$_SESSION['userid']."' AND id = '$requestId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}
*/
	public function get_request($requestId){
		$sqlQuery = "
			SELECT * FROM ".$this->request." 
			WHERE id = '$requestId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}
	

	public function get_requestbahan($reqId){
		$sqlQuery = "
			SELECT * FROM ".$this->request_detail_bahan." 
			WHERE id = '$reqId'";
		return  $this->getData($sqlQuery);	
	}

	public function get_requestperalatan($reqId){
		$sqlQuery = "
			SELECT * FROM ".$this->request_detail_peralatan." 
			WHERE id = '$reqId'";
		return  $this->getData($sqlQuery);	
	}

	public function get_requesttkerja($reqId){
		$sqlQuery = "
			SELECT * FROM ".$this->request_detail_tkerja." 
			WHERE id = '$reqId'";
		return  $this->getData($sqlQuery);	
	}	


	public function get_permintaan($data_request){
		$sqlQuery = "
			SELECT * FROM ".$this->request." 
			WHERE id = '$data_request'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}
	
	
//----------------------------------------------------data umum --------------------------------------------------------------
//$sql="select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from data_umum JOIN data_umum_ruas on data_umum.id=data_umum_ruas.id group by data_umum.id "; 
	public function get_data_umum($data_umum){
		$sqlQuery = "
			SELECT * FROM ".$this->data_umum." 
			WHERE id = '$data_umum'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}


	public function get_detail($detail){
		$sqlQuery = "
			SELECT * FROM ".$this->data_umum_ruas."
			WHERE id = '$detail'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}

	public function get_dataumum($du){
		$sqlQuery = "
			SELECT * FROM ".$this->data_umum_ruas." 
			WHERE id = '$du'";
		return  $this->getData($sqlQuery);	
	}




	
//----------------------------------------------------------------------------------------------------------------------------
	public function deletelap_harianItems($lap_harianId){
		$sqlQuery = "
			DELETE FROM ".$this->lap_harianDetailTable." 
			WHERE no_trans = '".$lap_harianId."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}
	//my line -------------------------------
	public function deletelap_harianBahan($lap_harianId){
		$sqlQuery = "
			DELETE FROM ".$this->lap_harianDetailTable_bahan." 
			WHERE no_trans = '".$lap_harianId."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}	
	//------------------------------------------------
	
	public function deletelap_harian($lap_harianId){
		$sqlQuery = "
			DELETE FROM ".$this->lap_harianMasterTable." 
			WHERE no_trans = '".$lap_harianId."'";
		mysqli_query($this->dbConnect, $sqlQuery);	
		$this->deletelap_harianItems($lap_harianId);	
		return 1;
	}
}
?>