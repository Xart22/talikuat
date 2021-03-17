<?php
require "../php-spreadsheet/vendor/autoload.php";

class talikuat{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "dbsik";   
	private $login='login';
	private $absen = 'absen';
	private $kategori_paket = 'kategori_paket';
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
	private $member='member';
	private $data_umum='data_umum';
	private $data_umum_ruas='data_umum_ruas';
	private $jadual='jadual';
	private $jadual_detail='detail_jadual';
	private $simbolrequest = 'simbol_request';
	private $kantor = 'kantor';
	private $request='request';
	private $request_detail_bahan ='detail_request_bahan';
	private $request_detail_peralatan ='detail_request_peralatan';
	private $request_detail_tkerja ='detail_request_tkerja';
	private $master_laporan_harian='master_laporan_harian';
	private $detail_laporan_harian_pekerjaan='detail_laporan_harian_pekerjaan';
	private $master_penyedia_jasa='master_penyedia_jasa';
	private $master_jenis_pekerjaan='master_jenis_pekerjaan';
	
	
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
	private function getDataRow($sqlQuery)
	{
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if (!$result) {
			die('Error in query: ' . mysqli_error());
			//echo'error';
		}
		
		$row = mysqli_fetch_row($result); 
		return $row;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}

////////////////////////////////////////////Konsultan////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

	public function get_absen() {
		$sqlQuery = "SELECT DISTINCT ".$this->absen.".nik, ".$this->absen.".nama, ".$this->absen.".nama_ppk FROM absen";

		return $this->getData($sqlQuery);
	}

	public function get_perencanaan() {
		$sqlQuery = "SELECT DISTINCT d.tgl_kontrak, a.kegiatan FROM `jadual` AS a INNER JOIN `detail_laporan_harian_pekerjaan` AS b ON a.`id` = b.`no_trans` INNER JOIN `detail_jadual` AS c ON a.`id` = c.`id_jadual` INNER JOIN `data_umum` AS d ON a.`id_data_umum` = d.`id` GROUP BY c.tgl";
		// $sqlQuery = "SELECT DISTINCT(tgl), detail_jadual.nmp, detail_jadual.uraian, detail_jadual.satuan, detail_jadual.harga_satuan, detail_jadual.volume, detail_jadual.jumlah_harga, detail_jadual.bobot FROM `detail_jadual` WHERE uraian = 'Mobilisasi' ORDER BY nmp ASC";
		
		return $this->getData($sqlQuery);
	}

	public function get_data_perencanaan($id) {
		$sqlQuery = "SELECT DISTINCT a.*, b.* FROM jadual AS a INNER JOIN detail_jadual AS b ON a.id = b.id WHERE b.id = ".$id." ORDER BY b.nmp ASC";
		
		return $this->getData($sqlQuery);
	}

	public function get_bulan_perencanaan() {
		$sqlQuery = "SELECT DISTINCT month(tgl) AS bulan, detail_jadual.tgl FROM `detail_jadual` GROUP BY tgl ASC";
		// $sqlQuery = "SELECT DISTINCT month(tgl) AS bulan, detail_jadual.tgl FROM `detail_jadual` WHERE uraian = 'Mobilisasi' GROUP BY tgl ASC";

		return $this->getData($sqlQuery);
	}

	public function getData_umum() {
		$sqlQuery = "SELECT *,DATE_ADD(tgl_spmk, INTERVAL waktu_pelaksanaan DAY) AS pho, detail_jadual.volume AS rencana, detail_laporan_harian_pekerjaan.volume AS realisasi FROM data_umum 
					 INNER JOIN detail_jadual ON detail_jadual.id = data_umum.id
					 INNER JOIN detail_laporan_harian_pekerjaan ON detail_laporan_harian_pekerjaan.no_trans = data_umum.id";
		return $this->getData($sqlQuery);
	}

	public function getMingguan() {
		$sqlQuery = "SELECT * FROM progress_mingguan";

		return $this->getData($sqlQuery);
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

	public function get_penilaian() {
		$sqlQuery = "SELECT * FROM penilaian ORDER BY no_kontrak ASC";

		return $this->getData($sqlQuery);
	}

	public function get_kategori_paket() {
		$sqlQuery = "SELECT * FROM kategori_paket ORDER BY id ASC";

		return $this->getData($sqlQuery);
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

	public function get_member(){
		$sqlQuery = "
			SELECT ".$this->member.".*,".$this->login.".* FROM ".$this->member." inner join ".$this->login." on ".$this->member.".id_member=".$this->login.".id_member
			where ".$this->login.".user='".$_SESSION['nama']."'";
			
		return  $this->getData($sqlQuery);	
	}	

	public function getDataUmumRuas($du){
		$sqlQuery = "
			SELECT DISTINCT(ruas_jalan), ". $this->data_umum_ruas .".* FROM ".$this->data_umum_ruas." 
			WHERE id = '$du'";
		return  $this->getData($sqlQuery);	
	}


	public function data_umum_edit($id){
		$sqlQuery = "
			SELECT * from ".$this->data_umum."
			where id='$id'";
			
		return  $this->getData($sqlQuery);	
	}
	
	public function getDataUmum($Id){
		$sqlQuery = "
			SELECT * FROM ".$this->data_umum." 
			WHERE id = '$Id'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}

//-----------------------------------------------List Data Umum --------------------------------------------------------------	
//---------------power user-------------------
	function data_umum(){
				//$sql = "select * from data_umum";
		$sqlQuery="
			select 	*,
					data_umum.id AS datumid, 
					GROUP_CONCAT(ruas_jalan) as ruas_jalan from ".$this->data_umum." 
			JOIN ".$this->data_umum_ruas." 
			on ".$this->data_umum.".id=".$this->data_umum_ruas.".id 
			JOIN ".$this->kategori_paket."
			on ".$this->kategori_paket.".id = ".$this->data_umum.".kategori
			JOIN ".$this->kantor." 
			on ".$this->kantor.".id_kantor = ".$this->data_umum.".unor
			group by ".$this->data_umum.".id ";
			// die($sqlQuery); 
		return $this->getData($sqlQuery);
	}

//---------------power kontraktor-------------------

	function data_umum_kontraktor(){
				//$sql = "select * from data_umum";
		$sqlQuery="
			select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from ".$this->data_umum." JOIN ".$this->data_umum_ruas." on 
			".$this->data_umum.".id=".$this->data_umum_ruas.".id 
			where ".$this->data_umum.".penyedia_jasa='".$_SESSION['perusahaan']."' group by ".$this->data_umum.".id "; 
		return $this->getData($sqlQuery);
	}

//---------------power kontraktor-------------------

	function data_umum_konsultan(){
				//$sql = "select * from data_umum";
		$sqlQuery="
			select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from ".$this->data_umum." JOIN ".$this->data_umum_ruas." on 
			".$this->data_umum.".id=".$this->data_umum_ruas.".id 
			where ".$this->data_umum.".konsultan_supervisi='".$_SESSION['perusahaan']."' group by ".$this->data_umum.".id "; 
		return $this->getData($sqlQuery);
	}

//---------------power kontraktor-------------------

	function data_umum_ppk(){
				//$sql = "select * from data_umum";
		$sqlQuery="
			select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from ".$this->data_umum." JOIN ".$this->data_umum_ruas." on 
			".$this->data_umum.".id=".$this->data_umum_ruas.".id 
			where ".$this->data_umum.".nama_ppk='".$_SESSION['nama_lengkap']."' group by ".$this->data_umum.".id "; 
		return $this->getData($sqlQuery);
	}

//---------------power kontraktor-------------------

	function data_umum_admin_uptd(){
				//$sql = "select * from data_umum";
		$sqlQuery="
			select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from ".$this->data_umum." JOIN ".$this->data_umum_ruas." on 
			".$this->data_umum.".id=".$this->data_umum_ruas.".id 
			where ".$this->data_umum.".unor='".$_SESSION['unit']."' group by ".$this->data_umum.".id "; 
		return $this->getData($sqlQuery);
	}

//-----------------------------------------------List jadual --------------------------------------------------------------			
	// function list_jadual(){
	// 	$sqlQuery = "select distinct(".$this->jadual.".id), ".$this->jadual.".*, ".$this->detail_laporan_harian_pekerjaan.".nmp from ".$this->jadual." inner join " . $this->detail_laporan_harian_pekerjaan . " on " . $this->jadual . ".id_nmp =" . $this->detail_laporan_harian_pekerjaan . ".nmp";
	// 	return $this->getData($sqlQuery);
	// }

	function list_jadual(){
		$sqlQuery = "SELECT ". $this->jadual_detail . ".*, " . $this->master_jenis_pekerjaan . ".*, " . $this->jadual . ".*, ".$this->kantor.".nama_kantor FROM " . $this->jadual_detail . " 
					 INNER JOIN " . $this->master_jenis_pekerjaan . " 
					 ON " . $this->jadual_detail . ".`nmp` = " . $this->master_jenis_pekerjaan . ".`id` 
					 INNER JOIN " . $this->jadual . " 
					 ON " . $this->jadual_detail . ".`id` = " . $this->jadual . ".`id` 
					 INNER JOIN ".$this->kantor." 
					 ON ".$this->kantor.".id_kantor = ".$this->jadual.".unor";
					//  die($sqlQuery);
		return $this->getData($sqlQuery);
	}

	function list_jadual_kontraktor(){
		$sqlQuery = "select * from ".$this->jadual."
					where ".$this->jadual.".nama_penyedia = '".$_SESSION['perusahaan']."' ";
		return $this->getData($sqlQuery);
	}

	function list_jadual_konsultan(){
		$sqlQuery = "select * from ".$this->jadual."
					where ".$this->jadual.".konsultan = '".$_SESSION['perusahaan']."' ";
		return $this->getData($sqlQuery);
	}

	function list_jadual_ppk(){
		$sqlQuery = "select * from ".$this->jadual."
					where ".$this->jadual.".nama_ppk = '".$_SESSION['nama_lengkap']."' ";
		return $this->getData($sqlQuery);
	}

	function list_jadual_admin_uptd(){
		$sqlQuery = "select * from ".$this->jadual."
					where ".$this->jadual.".unor = '".$_SESSION['unit']."' ";
		return $this->getData($sqlQuery);
	}
//-----------------------------------------------List Request / permintaan -----------------------------
	function status_permintaan() {
		$sqlQuery = "select * from " . $this->simbolrequest . "";
		return $this->getData($sqlQuery);
	}

	function list_ruas_jalan() {
		$sqlQuery = "SELECT * FROM " . $this->data_umum_ruas;
		return $this->getData($sqlQuery);
	}

	function list_permintaan(){
		$sqlQuery = "select * from ".$this->request."";
		return $this->getData($sqlQuery);
	}

	function list_permintaan_kontraktor(){
		$sqlQuery = "select * from ".$this->request."
					where ".$this->request.".nama_kontraktor='".$_SESSION['perusahaan']."'";
		return $this->getData($sqlQuery);
	}

	function list_permintaan_konsultan(){
		$sqlQuery = "select * from ".$this->request."
					where ".$this->request.".nama_direksi='".$_SESSION['perusahaan']."'";
		return $this->getData($sqlQuery);
	}

	function list_permintaan_ppk(){
		$sqlQuery = "select * from ".$this->request."
					where ".$this->request.".nama_ppk='".$_SESSION['nama_lengkap']."'";
		return $this->getData($sqlQuery);
	}

	function list_permintaan_admin_uptd(){
		$sqlQuery = "select * from ".$this->request."
					where ".$this->request.".unor='".$_SESSION['unit']."'";
		return $this->getData($sqlQuery);
	}	
	
//--------------------------------------------------List Laporan Harian ---------------------------------------
	function list_laporan_harian(){
		// $sqlQuery = 
		// "select ".$this->master_laporan_harian.".*, ".$this->detail_laporan_harian_pekerjaan.".jenis_pekerjaan, ".$this->detail_laporan_harian_pekerjaan.".no_pekerjaan, 
		// 				".$this->detail_laporan_harian_pekerjaan.".satuan,".$this->detail_laporan_harian_pekerjaan.".volume from ".$this->master_laporan_harian." left join ".$this->detail_laporan_harian_pekerjaan." 
		// 				on ".$this->master_laporan_harian.".no_trans=".$this->detail_laporan_harian_pekerjaan.".no_trans";
		// return $this->getData($sqlQuery);
		$sqlQuery =
		"select " . $this->master_laporan_harian . ".*, " . $this->detail_laporan_harian_pekerjaan . ".jenis_pekerjaan, " . $this->detail_laporan_harian_pekerjaan . ".no_pekerjaan, 
						" . $this->detail_laporan_harian_pekerjaan . ".satuan from " . $this->master_laporan_harian . " left join " . $this->detail_laporan_harian_pekerjaan . " 
						on " . $this->master_laporan_harian . ".no_trans=" . $this->detail_laporan_harian_pekerjaan . ".no_trans";
		return $this->getData($sqlQuery);
	}

	function list_laporan_harian_kontraktor(){
		$sqlQuery = 
		"select ".$this->master_laporan_harian.".*, ".$this->detail_laporan_harian_pekerjaan.".jenis_pekerjaan, ".$this->detail_laporan_harian_pekerjaan.".no_pekerjaan, 
						".$this->detail_laporan_harian_pekerjaan.".satuan,".$this->detail_laporan_harian_pekerjaan.".volume from ".$this->master_laporan_harian." left join ".$this->detail_laporan_harian_pekerjaan." 
						on ".$this->master_laporan_harian.".no_trans=".$this->detail_laporan_harian_pekerjaan.".no_trans
						where ".$this->master_laporan_harian.".nama_kontraktor='".$_SESSION['perusahaan']."' ";
		return $this->getData($sqlQuery);
	}

	function list_laporan_harian_konsultan(){
		$sqlQuery = 
		"select ".$this->master_laporan_harian.".*, ".$this->detail_laporan_harian_pekerjaan.".jenis_pekerjaan, ".$this->detail_laporan_harian_pekerjaan.".no_pekerjaan, 
						".$this->detail_laporan_harian_pekerjaan.".satuan,".$this->detail_laporan_harian_pekerjaan.".volume from ".$this->master_laporan_harian." left join ".$this->detail_laporan_harian_pekerjaan." 
						on ".$this->master_laporan_harian.".no_trans=".$this->detail_laporan_harian_pekerjaan.".no_trans
						where ".$this->master_laporan_harian.".nama_konsultan='".$_SESSION['perusahaan']."' ";
		return $this->getData($sqlQuery);
	}

	function list_laporan_harian_ppk(){
		$sqlQuery = 
		"select ".$this->master_laporan_harian.".*, ".$this->detail_laporan_harian_pekerjaan.".jenis_pekerjaan, ".$this->detail_laporan_harian_pekerjaan.".no_pekerjaan, 
						".$this->detail_laporan_harian_pekerjaan.".satuan,".$this->detail_laporan_harian_pekerjaan.".volume from ".$this->master_laporan_harian." left join ".$this->detail_laporan_harian_pekerjaan." 
						on ".$this->master_laporan_harian.".no_trans=".$this->detail_laporan_harian_pekerjaan.".no_trans
						where ".$this->master_laporan_harian.".nama_ppk='".$_SESSION['nama_lengkap']."' ";
		return $this->getData($sqlQuery);
	}

	function list_laporan_harian_admin_uptd(){
		$sqlQuery = 
		"select ".$this->master_laporan_harian.".*, ".$this->detail_laporan_harian_pekerjaan.".jenis_pekerjaan, ".$this->detail_laporan_harian_pekerjaan.".no_pekerjaan, 
						".$this->detail_laporan_harian_pekerjaan.".satuan,".$this->detail_laporan_harian_pekerjaan.".volume from ".$this->master_laporan_harian." left join ".$this->detail_laporan_harian_pekerjaan." 
						on ".$this->master_laporan_harian.".no_trans=".$this->detail_laporan_harian_pekerjaan.".no_trans
						where ".$this->master_laporan_harian.".unor='".$_SESSION['unit']."' ";
		return $this->getData($sqlQuery);
	}
									

	public function get_data_umum($data_umum){
		$sqlQuery = "
			SELECT * FROM ".$this->data_umum." 
			JOIN ".$this->kantor." ON ".$this->kantor.".id_kantor = ".$this->data_umum.".unor
			WHERE id = '$data_umum'";
			// die($sqlQuery);
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}


	public function get_data_umum_detail($detail){
		$sqlQuery = "
			SELECT * FROM ".$this->data_umum_ruas."
			WHERE id = '$detail'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}

//----------------------------------jadual / Schedule ---------------------------------------------------------------------------------------------------------		
	public function get_jadual($jadualId){
		$sqlQuery = "
			SELECT * FROM ".$this->jadual." 
			JOIN ". $this->jadual_detail ." ON ". $this->jadual .".id = ". $this->jadual_detail .".id_jadual 
			JOIN ".$this->kantor." ON ".$this->kantor.".id_kantor = ".$this->jadual.".unor
			WHERE jadual.id = '$jadualId'";
			// die();
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}

	public function get_all_jadual(){
		$sqlQuery = "SELECT * FROM jadual WHERE 1";
		$result = mysqli_query($this->dbConnect, $sqlQuery);

		return $result;
	}

	public function get_jadualdetail($jadualId){
		$sqlQuery = "
			SELECT * FROM ".$this->jadual_detail." 
			WHERE id = '$jadualId'";
		return  $this->getData($sqlQuery);	
	}
	
	public function get_jadualdetail1($jadualId){
		$id_pek = $_GET['id_pek'];
		$sqlQuery = "
			SELECT * FROM ".$this->jadual_detail." 
			WHERE kegiatan = '$jadualId' and nmp = '$id_pek'";
		return  $this->getData($sqlQuery);	
	}

//-----------------------------------------------simpan data =====================================================================================
	
	public function saveDataUmum($POST) {
/*
		$sketsa = $_FILES['sketsa']['name'];
		$tmp_sketsa = $_FILES['sketsa']['tmp_name'];
		$sketsabaru = date('dmYHis').$sketsa;
		$path_sketsa = "../../assets/img/laporan/".$sketsabaru;
		move_uploaded_file($tmp_sketsa,$path_sketsa);
*/		
		$tgl = date("j F Y, G:i");
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
		$rabbaru = !isset($tmp_rab) ? date('dmYHis').$rab : "";
		$pkbaru = !isset($tmp_pk) ? date('dmYHis').$pk : "";
		$skbaru = !isset($tmp_sk) ? date('dmYHis').$sk : "";
		$smbaru = !isset($tmp_sm) ? date('dmYHis').$sm : "";
		$ul_spmkbaru = !isset($tmp_ul_spmk) ? date('dmYHis').$ul_spmk : "";
		$ul_jadualbaru = !isset($tmp_ul_jadual) ? date('dmYHis').$ul_jadual : "";
		$ul_rencanabaru = !isset($tmp_ul_rencana) ? date('dmYHis').$ul_rencana : "";
		
		// Set path folder tempat menyimpan fotonya
		$path_rab = "../lampiran/umum/".$rabbaru;
		$path_pk = "../lampiran/umum/".$pkbaru;
		$path_sm = "../lampiran/umum/".$smbaru;
		$path_sk = "../lampiran/umum/".$skbaru;
		$path_ul_spmk = "../lampiran/umum/".$ul_spmkbaru;
		$path_ul_rencana = "../lampiran/umum/".$ul_rencanabaru;
		$path_ul_jadual = "../lampiran/umum/".$ul_jadualbaru;
				move_uploaded_file($tmp_rab,$path_rab);
				move_uploaded_file($tmp_pk,$path_pk);
				move_uploaded_file($tmp_sm,$path_sm);
				move_uploaded_file($tmp_sk,$path_sk);
				move_uploaded_file($tmp_ul_spmk,$path_ul_spmk);
				move_uploaded_file($tmp_ul_jadual,$path_ul_jadual);
				move_uploaded_file($tmp_ul_rencana,$path_ul_rencana);

		
		$sqlInsert = "
			INSERT INTO ".$this->data_umum. "(pemda,opd,unor,kategori,nama_kegiatan,no_kontrak,tgl_kontrak,nilai_kontrak,no_spmk,tgl_spmk,panjang,
			waktu_pelaksanaan,ppk,penyedia_jasa,konsultan_supervisi,nama_ppk,nama_se,nama_gs,rab,pk,sk,sm,ul_spmk,ul_jadual,ul_rencana,tgl_input,user,pagu_anggaran) 
			VALUES ('".$POST['pemda']."', '".$POST['opd']."', ".$POST['unor'].", ".$POST['kategori'].",'".$POST['nama_kegiatan']."', '".$POST['no_kontrak']."',
			'".$POST['tgl_kontrak']."', 
			'".$POST['nilai_kontrak']."','".$POST['no_spmk']."','".$POST['tgl_spmk']."','".$POST['panjang']."','".$POST['waktu_pelaksanaan']."','".$POST['ppk']."',
			'".$POST['penyedia_jasa']."','".$POST['konsultan']."','".$POST['nama_ppk']."','".$POST['nama_se']."','".$POST['nama_gs']. "','".$rabbaru."',
			'".$pkbaru."','".$skbaru."','".$smbaru."','".$ul_spmkbaru."','".$ul_jadualbaru."','".$ul_rencanabaru."','".$tgl."', '".$_POST['id_user']."',0.0)";
			// die($sqlInsert);		
		mysqli_query($this->dbConnect, $sqlInsert);
		// die(mysqli_error($this->dbConnect));
		
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		
		for ($i = 0; $i < count($POST['ruas_jalan']); $i++) {
			$sqlInsert_ruas = "
			INSERT INTO ".$this->data_umum_ruas."(id,ruas_jalan,lat_awal,long_awal,lat_akhir,long_akhir,segmen_jalan) 
			VALUES ('".$lastInsertId."', '".$POST['ruas_jalan'][$i]."', '".$POST['lat_awal'][$i]."', '".$POST['long_awal'][$i]."', '".$POST['lat_akhir'][$i]."', '".$POST['long_akhir'][$i]."','".$POST['segmen_jalan'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsert_ruas);
		};
	
		echo '<script>window.location="../admin/data_umum.php?sukses=tambah-data"</script>';
		// echo '<script>window.location="data_umum.php?sukses=tambah-data"</script>';
	}
	

	public function saveDataUmum_kontraktor($POST) {
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
		$path_rab = "../lampiran/umum/".$rabbaru;
		$path_pk = "../lampiran/umum/".$pkbaru;
		$path_sm = "../lampiran/umum/".$smbaru;
		$path_sk = "../lampiran/umum/".$skbaru;
		$path_ul_spmk = "../lampiran/umum/".$ul_spmkbaru;
		$path_ul_rencana = "../lampiran/umum/".$ul_rencanabaru;
		$path_ul_jadual = "../lampiran/umum/".$ul_jadualbaru;
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
		$cek = mysqli_query($this->dbConnect, $sqlInsert);

		if($cek) {
			$lastInsertId = mysqli_insert_id($this->dbConnect);
			
			for ($i = 0; $i < count($POST['ruas_jalan']); $i++) {
				$sqlInsert_ruas = "
				INSERT INTO ".$this->data_umum_ruas."(id,ruas_jalan,lat_awal,long_awal,lat_akhir,long_akhir,segmen_jalan) 
				VALUES ('".$lastInsertId."', '".$POST['ruas_jalan'][$i]."', '".$POST['lat_awal'][$i]."', '".$POST['long_awal'][$i]."', '".$POST['lat_akhir'][$i]."', '".$POST['long_akhir'][$i]."','".$POST['segmen_jalan'][$i]."')";				
				mysqli_query($this->dbConnect, $sqlInsert_ruas);
	
			};
		
			echo '<script>window.location="../kontraktor/data_umum.php?sukses=tambah-data"</script>';
		} else {
			die(mysqli_error($this->dbConnect));
		}
	}
//---------------------------------------------akhir save data --------------------------------------------------------------------------------------------------------------------

//---------------------------------------update data umum ----------------------------------------------------------------------------------------------------------------
public function updateDataUmum($POST) {
		$tgl = date("j F Y, G:i");	

		if($POST['data_umum']){
		$sqlInsert = "
			UPDATE ".$this->data_umum."
			SET pemda='".$POST['pemda']."',opd='".$POST['opd']."',unor='".$POST['unor']."',kategori='".$POST['kategori']."'',nama_kegiatan='".$POST['nama_kegiatan']."',
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
echo '<script>window.location="data_umum.php?sukses=update-data"</script>';
	}
	
public function updateDataUmum_kontraktor($POST) {
		$tgl = date("j F Y, G:i");	

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
echo '<script>window.location="../kontraktor/data_umum.php?sukses=update-data"</script>';
	}
//=======================================================================Simpan Jadual
	public function saveJadual($POST) {
//==================================================================Jadual=========================================================================
		

//==================================================================Detail Jadual=========================================================================
		//do something with code...;
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($_FILES['fileexcel']['tmp_name']);
		 $reader->setReadDataOnly(true);
		 $spreadsheet = $reader->load($_FILES['fileexcel']['tmp_name']);
		 $sheetData = $spreadsheet->getActiveSheet();
		 var_dump($sheetData);

		$jadual = $_POST['jadual'];

		for ($i = 1; $i < count($sheetData); $i++) {
			$tanggal = $sheetData[$i]['0'];
			$x = explode('/', $tanggal);
			$tgl = $x[2] . "-" . $x[1] . "-" . $x[0];
			$nmp = $sheetData[$i]['1'];
			$uraian = $sheetData[$i]['2'];
			$satuan = $sheetData[$i]['3'];
			$volume = $sheetData[$i]['4'];
			$hsatuan = $sheetData[$i]['5'];
			$jumharga = $sheetData[$i]['6'];

			//rencana volume
			// $renvol_harian = $sheetData[$i]['5'];
			// $renvol_komulatif = $sheetData[$i]['6'];
			//progress fisik
			// $progfisik_renbobot = $sheetData[$i]['7'];
			// $progfisik_renkomulatif = $sheetData[$i]['8'];
			//rencana keuangan
			// $renkeuangan_harian = $sheetData[$i]['9'];
			// $renkeuangan_komulatif = $sheetData[$i]['10'];

			$bobot = $sheetData[$i]['7'];
			$koefisien = $sheetData[$i]['8'];
			$nilai = $sheetData[$i]['9'];

			$sql = "INSERT INTO detail_jadual(id_jadual, tgl, nmp, uraian, satuan, harga_satuan, volume, jumlah_harga, bobot, koefisien, nilai) 
                    VALUES ($jadual,'$tgl','$nmp','$uraian','$satuan',$hsatuan,$volume,$jumharga,$bobot,$koefisien,$nilai)";

			// echo($sql);
			$execute = mysqli_query($this->dbConnect, $sql);

			if ($jadual && $execute) {
				echo '<script>window.location="../admin/jadual.php?sukses=buat-data"</script>';
				// header("Location:../../../admin/data_umum.php");
			} else {
				echo "Kesalahan Sistem dalam memproses data... <br>";
				// echo mysqli_error($this->dbConnect);
			}
		}


		// $sqlInsert = "
		// 	INSERT INTO ".$this->jadual."(satuan,nama_ppk,unor,harga_satuan,volume,nilai_kontrak,jumlah_harga,bobot,id_data_umum,nmp,user,kegiatan,ruas_jalan,waktu_pelaksanaan,panjang,ppk,nama_penyedia,konsultan,tgl_input) 
		// 	VALUES ('".$POST['satuan1']."','".$POST['nama_ppk']."','".$POST['unor']."','".$POST['harga_satuan1']."','".$POST['volume1']."','".$POST['nilai_kontrak']."','".$POST['jumlah_harga1']."','".$POST['bobot1']."','".$POST['id_data_umum']."','".$POST['nmp']."','".$POST['userId']."', '".$POST['kegiatan']."', '".$POST['ruas_jalan']."', '".$POST['waktu']."', '".$POST['panjang']."','".$POST['ppk']."', '".$POST['nama_penyedia']."','".$POST['konsultan']."', '".$tgl."')";		
		// mysqli_query($this->dbConnect, $sqlInsert);
		// die($sqlInsert);
//==================================================================Detail Jadual=========================================================================		
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		$tgl = date("Y-m-d");
		$sqlInsert = "
			INSERT INTO " . $this->jadual . "(satuan,nama_ppk,unor,harga_satuan,volume,nilai_kontrak,jumlah_harga,bobot,id_data_umum,nmp,user,kegiatan,ruas_jalan,waktu_pelaksanaan,panjang,ppk,nama_penyedia,konsultan,tgl_input, tgl_update) 
			VALUES ('" . $POST['satuan1'] . "','" . $POST['nama_ppk'] . "'," . $POST['id_unor'] . ",'" . $POST['harga_satuan1'] . "','" . $POST['volume1'] . "','" . $POST['nilai_kontrak'] . "','" . $POST['jumlah_harga1'] . "','" . $POST['bobot1'] . "','" . $POST['id_data_umum'] . "'," . $POST['nmp'] . ",'" . $POST['userId'] . "', '" . $POST['kegiatan'] . "', '" . $POST['ruas_jalan'] . "', " . $POST['waktu'] . ", '" . $POST['panjang'] . "','" . $POST['ppk'] . "', '" . $POST['nama_penyedia'] . "','" . $POST['konsultan'] . "', '" . $tgl . "', '0000-00-00')";
		// die($sqlInsert);
		$jadual = mysqli_query($this->dbConnect, $sqlInsert);
		
		// for ($i = 0; $i < count($POST['nmp']); $i++) {
		// 	$sqlInsertItem_jadual = "
		// 	INSERT INTO ".$this->jadual_detail."(id,tgl,nmp,uraian,satuan,harga_satuan,volume,jumlah_harga,bobot,koefisien,nilai) 
		// 	VALUES ('".$lastInsertId."', '".$POST['tgl'][$i]."', '".$POST['nmp'][$i]."', '".$POST['uraian'][$i]."', '".$POST['satuan'][$i]."', '".$POST['harga_satuan'][$i]."', '".$POST['volume'][$i]."', '".$POST['jumlah_harga'][$i]."', '".$POST['bobot'][$i]."', '".$POST['koefisien'][$i]."', '".$POST['nilai'][$i]."')";				
		// 	mysqli_query($this->dbConnect, $sqlInsertItem_jadual);
		// };
	
echo '<script>window.location="jadual.php?sukses=tambah-data"</script>';
	}

	public function saveJadual_kontraktor($POST) {
		$tgl = date("j F Y, G:i");
		$sqlInsert = "
			INSERT INTO ".$this->jadual."(jenis_pekerjaan,satuan,nama_ppk,unor,harga_satuan,volume,nilai_kontrak,jumlah_harga,bobot,id_data_umum,nmp,user,kegiatan,ruas_jalan,waktu_pelaksanaan,panjang,ppk,nama_penyedia,konsultan,tgl_input) 
			VALUES ('".$POST['uraian'][0]."','".$POST['satuan1']."','".$POST['nama_ppk']."','".$POST['unor']."','".$POST['harga_satuan1']."','".$POST['volume1']."','".$POST['nilai_kontrak']."','".$POST['jumlah_harga1']."','".$POST['bobot1']."','".$POST['id_data_umum']."','".$POST['nmp'][0]."','".$POST['userId']."', '".$POST['kegiatan']."', '".$POST['ruas_jalan']."', '".$POST['waktu']."', '".$POST['panjang']."','".$POST['ppk']."', '".$POST['nama_penyedia']."','".$POST['konsultan']."', '".$tgl."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		
		
		for ($i = 0; $i < count($POST['nmp']); $i++) {
			$sqlInsertItem_jadual = "
			INSERT INTO ".$this->jadual_detail."(id,tgl,nmp,uraian,satuan,harga_satuan,volume,jumlah_harga,bobot,koefisien,nilai) 
			VALUES ('".$lastInsertId."', '".$POST['tgl'][$i]."', '".$POST['nmp'][$i]."', '".$POST['uraian'][$i]."', '".$POST['satuan'][$i]."', '".$POST['harga_satuan'][$i]."', '".$POST['volume'][$i]."', '".$POST['jumlah_harga'][$i]."', '".$POST['bobot'][$i]."', '".$POST['koefisien'][$i]."', '".$POST['nilai'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_jadual);

		};
	
echo '<script>window.location="../kontraktor/jadual.php?sukses=tambah-data"</script>';
	}
//-----------------------------------------------------UPDATE DATA JADUAL--------------------------------------------------------------------------------------------------	

//=======================================================================Simpan master penyedia jasa ===============================================
	public function savekontraktor($POST) {
		$tgl = date("j F Y, G:i");
		$sqlInsert = "
			INSERT INTO ".$this->master_penyedia_jasa."(nama,alamat,nama_direktur,npwp,telp,bank,no_rek)  
			VALUES ('".$POST['nama']."','".$POST['alamat']."','".$POST['nama_direktur']."','".$POST['npwp']."','".$POST['telp']."','".$POST['bank']."','".$POST['no_rek']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		
echo '<script>window.location="master_kontraktor.php?sukses=tambah-data"</script>';
	}
//-----------------------------------------------------UPDATE DATA JADUAL--------------------------------------------------------------------------------------------------	
public function updateSchedule($POST) {
	//$tgl = date("j F Y, G:i");
	if($POST['schId']) {	
			$sqlInsert = "
				UPDATE ".$this->jadual." 
				SET kegiatan = '".$POST['kegiatan']."', ruas_jalan= '".$POST['ruas_jalan']."', waktu_pelaksanaan = '".$POST['waktu']."', panjang = '".$POST['panjang']."', 
				ppk='".$POST['ppk']."',nama_penyedia='".$POST['nama_penyedia']."',konsultan='".$POST['konsultan']."',tgl_update= '',
				harga_satuan='".$POST['harga_satuan1']."', satuan='".$POST['satuan1']."', volume='".$POST['volume1']."', jumlah_harga='".$POST['jumlah_harga1']."',
				bobot='".$POST['bobot1']."'
				WHERE user = '".$POST['userId']."' AND id = '".$POST['schId']."' AND nmp = '".$POST['nmp'][0]."'" ;		
			mysqli_query($this->dbConnect, $sqlInsert);	
		
			$sqlQuery = "
					DELETE FROM ".$this->jadual_detail." 
					WHERE id = '".$POST['schId']."' AND nmp = '".$POST['nmp'][0]."'";
			mysqli_query($this->dbConnect, $sqlQuery);	
		$lastInsertId = $POST['schId'];
		//$this->deletejadualDetail1($POST['schId']);
		for ($i = 0; $i < count($POST['nmp']); $i++) {
			$sqlInsertItem_jadual = "
			INSERT INTO ".$this->jadual_detail."(kegiatan,id,tgl,nmp,uraian,satuan,harga_satuan,volume,jumlah_harga,bobot,koefisien,nilai) 
			VALUES ('".$POST['kegiatan']."','".$lastInsertId."', '".$POST['tgl'][$i]."','".$POST['nmp'][$i]."', '".$POST['uraian'][$i]."', '".$POST['satuan'][$i]."', '".$POST['harga_satuan'][$i]."', '".$POST['volume'][$i]."', '".$POST['jumlah_harga'][$i]."', '".$POST['bobot'][$i]."', '".$POST['koefisien'][$i]."', '".$POST['nilai'][$i]."')";				
			mysqli_query($this->dbConnect, $sqlInsertItem_jadual);

		};
			
			
	}
		echo '<script>window.location="jadual.php?sukses=update-data"</script>';			
}

//---------------------------------------------save request --------------------------------------------------------------------------------------------------------------------
	
	public function saveRequest($POST) {

		$sketsa = $_FILES['sketsa']['name'];
		$tmp_sketsa = $_FILES['sketsa']['tmp_name'];
		$sketsabaru = date('dmYHis').$sketsa;
		$path_sketsa = "../lampiran/req/".$sketsabaru;
		

		$tgl = date("j F Y, G:i");
		move_uploaded_file($tmp_sketsa,$path_sketsa);
		
		$sqlInsert = "
			INSERT INTO ".$this->request."(id_jenis_pekerjaan,unor,satuan,user,nama_kegiatan,jenis_pekerjaan,diajukan_tgl,lokasi_sta,volume,pelaksanaan_tgl,sketsa,catatan_surveyor,catatan_inspector,catatan_technician,ci,qe,nama_kontraktor,nama_direksi,nama_ppk,note,tgl_input) 
			VALUES ('".$POST['jp']."','".$POST['unor']."','".$POST['satuan']."','".$POST['userId']."', '".$POST['kegiatan']."', '".$POST['jenis_pekerjaan']."', '".$POST['diajukan_tgl']."', '".$POST['lokasi_sta']."', '".$POST['perkiraan_volume']."', '".$POST['pelaksanaan_tgl']."', '".$sketsabaru."', '".$POST['surveyor']."', '".$POST['inspector']."', '".$POST['technician']."', '".$POST['ci']."', '".$POST['qe']."', '".$POST['penyedia_jasa']."', '".$POST['konsultan']."', '".$POST['nama_ppk']."', '".$POST['disetujui']."','".$tgl."')";		
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
echo '<script>window.location="permintaan.php?sukses=tambah-data"</script>';		
	}	


	public function get_request($requestId){
		$sqlQuery = "
			SELECT * FROM ".$this->request." 
			WHERE id = '$requestId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}

	public function get_request_nmp($Id){
		$sqlQuery = "
			SELECT * FROM ".$this->request." 
			WHERE id = '$Id'";
		return  $this->getData($sqlQuery);	
	}

	function get_request_kontrak($id){
		$sqlQuery = "
			SELECT ".$this->data_umum.".*,".$this->request.".* FROM ".$this->data_umum." join ".$this->request." on ".$this->data_umum.".nama_kegiatan=".$this->request.".nama_kegiatan
			where ".$this->request.".nama_kegiatan='$id'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}
	
	//SELECT * FROM `data_umum` join `request` on `data_umum`.`nama_kegiatan`=`request`.`nama_kegiatan` 
	public function get_jenis_pekerjaan($Id){
		$sqlQuery = "
			SELECT * FROM ".$this->master_jenis_pekerjaan." 
			WHERE id = '$Id'";
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
	

//--------------------------------DELETE ISI DETAIL DATA Request----------------------------------------	

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

public function updateRequest($POST) {


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
		echo '<script>window.location="permintaan.php?sukses=update-data"</script>';			
}

	public function get_permintaan($data_request){
		$sqlQuery = "
			SELECT * FROM ".$this->request." 
			WHERE id = '$data_request'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	

//----------------------------------------------------simpan laporan harian-------------------------------------------------------------------------------------------------------------

	public function save_laporan_harian($POST) {
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

		$soft = $_FILES['soft']['name'];
		$tmp_soft = $_FILES['soft']['tmp_name'];
		$softbaru = date('dmYHis').$soft;
		$path_soft = "../lampiran/lh/".$softbaru;
		

		$tgl = date("j F Y, G:i");
		
		$sqlInsert = "
			INSERT INTO ".$this->lap_harianMasterTable."(nmp,satuan,volume,no_request,unor,user,kegiatan,ruas_jalan,tanggal,segmen_jalan,ket,nama_kontraktor,nama_ppk,nama_konsultan,tgl_input,gambar) 
			VALUES ('".$POST['jenis_pekerjaan_master']."','".$POST['satuan_master']."','".$POST['volume_master']."','".$POST['request']."','".$POST['unor']."','".$POST['userId']."', '".$POST['kegiatan']."', '".$POST['ruas_jalan']."', '".$POST['tanggal']."', '".$POST['segmen_jalan']."', '".$POST['notes']."','".$POST['kontraktor']."', '".$POST['ppk']."','".$POST['konsultan']."','".$tgl."','".$softbaru."')";		
		move_uploaded_file($tmp_soft,$path_soft);
		mysqli_query($this->dbConnect, $sqlInsert);
		
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['no_pekerjaan']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->lap_harianDetailTable."(kegiatan,no_trans,no_pekerjaan,jenis_pekerjaan,sta_awal,sta_akhir,ki_ka,volume,satuan,ket,tgl) 
			VALUES ('".$POST['kegiatan']."','".$lastInsertId."', '".$POST['no_pekerjaan'][$i]."', '".$POST['jenis_pekerjaan'][$i]."', '".$POST['sta_awal'][$i]."', '".$POST['sta_akhir'][$i]."', '".$POST['ki_ka'][$i]."', '".$POST['volume'][$i]."', '".$POST['satuan'][$i]."', '".$POST['ket'][$i]."', '".$POST['tanggal']."')";				
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
echo '<script>window.location="laporan_harian.php?sukses=tambah-data"</script>';			
	}	
//--------------------------------------------------------------------------------------------------------------------------------------
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

	public function get_progress($lap_harianId){
		// echo $_GET['id_pek'];
		$sqlQuery = "
			SELECT * FROM ".$this->lap_harianMasterTable." join  ".$this->lap_harianDetailTable." on ".$this->lap_harianMasterTable.".no_trans=".$this->lap_harianDetailTable.".no_trans
			WHERE ".$this->lap_harianMasterTable.".kegiatan = '$lap_harianId'";
			//SELECT * FROM ".$this->lap_harianMasterTable." join  ".$this->lap_harianDetailTable." on ".$this->lap_harianMasterTable.".no_trans=".$this->lap_harianDetailTable.".no_trans
			//WHERE ".$this->lap_harianMasterTable.".kegiatan = '$lap_harianId' and ".$this->lap_harianDetailTable.".no_pekerjaan='$id_pek' ";
		return  $this->getData($sqlQuery);	
	}

	public function getlap_pekerjaanItems($lap_kerjaId){
		$sqlQuery = "
			SELECT *, detail_jadual.volume AS volren, detail_laporan_harian_pekerjaan.volume AS volreal,
			detail_jadual.tgl AS tgljadual, detail_laporan_harian_pekerjaan.tgl AS tglpekerjaan 
			FROM detail_laporan_harian_pekerjaan
			INNER JOIN detail_jadual ON detail_laporan_harian_pekerjaan.no_trans = detail_jadual.id
			WHERE detail_jadual.id_jadual = '$lap_kerjaId'";
		return  $this->getData($sqlQuery);	
	}

//SELECT * FROM `master_laporan_harian` join detail_laporan_harian_pekerjaan on master_laporan_harian.no_trans=detail_laporan_harian_pekerjaan.no_trans 
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
				nama_kontraktor = '".$POST['kontraktor']."', nama_ppk = '".$POST['ppk']."', nama_konsultan = '".$POST['konsultan']."', tgl_update =  '".$tgl."',
				no_request = '".$POST['request']."'
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
		echo '<script>window.location="laporan_harian.php?sukses=update-data"</script>';			
}

// ==================================================================Disposisi====================================================================================
	
	public function getDisposisi($id) {
		/** 1. Kirim Disposisi*/

		$sqlQuery = "SELECT DISTINCT a.* FROM disposisi AS a 
					 JOIN disposisi_penanggung_jawab AS b ON b.disposisi_code = a.disposisi_code 
					 WHERE a.created_by = " . $id;

		return $this->getData($sqlQuery);
	}

	public function getDisposisiMasuk($id) {
		/** 1. Disposisi Masuk */
		$sqlQuery = "
			SELECT a.id,a.disposisi_code,a.dari,b.level,b.status as status_pj,a.perihal,c.nama_lengkap as pengirim,a.tgl_surat,a.no_surat,a.tanggal_penyelesaian,a.status,a.file,a.created_date,a.created_by
			FROM disposisi AS a 
			JOIN disposisi_penanggung_jawab AS b ON b.disposisi_code = a.disposisi_code
			JOIN member AS c ON b.pemberi_disposisi = c.id_member
			WHERE b.user_role_id = 
		" . $id;

		return $this->getData($sqlQuery);
	}

	public function getDisposisiTindakLanjut($id) {
		$sqlQuery = "
			SELECT b.id,a.id as disposisi_id,b.tindak_lanjut,b.status as status_tindak_lanjut,b.persentase,b.keterangan as keterangan_tl, a.disposisi_code,a.dari,a.perihal,a.tgl_surat,a.no_surat,a.tanggal_penyelesaian,a.status,a.file,a.created_date,a.created_by,c.nama_lengkap as pengirim 
			FROM disposisi_tindak_lanjut AS b 
			JOIN disposisi AS a ON a.id = b.disposisi_id 
			JOIN member AS c ON a.created_by = c.id_member
			WHERE b.created_by = ". $id ." ORDER BY b.id DESC
		";

		return $this->getData($sqlQuery);
	}

# =========================================================================Detail DIsposisi=====================================================================
	public function getDetailDisposisi($id, $discode)
	{
		$sqlQuery = "SELECT c.nama_lengkap, a.* FROM disposisi AS a 
					 JOIN disposisi_penanggung_jawab AS b ON b.disposisi_code = a.disposisi_code 
					 JOIN member AS c ON a.created_by = c.id_member 
					 WHERE a.created_by = '$id' AND a.disposisi_code = '$discode'";

		return $this->getDataRow($sqlQuery);
	}

	public function getDetailMasuk($id)
	{
		$sqlQuery = "
			SELECT a.id,a.disposisi_code,c.nama_lengkap as pengirim,a.dari,a.perihal,a.tgl_surat,a.no_surat,a.tanggal_penyelesaian,a.status,a.file,a.created_date,a.created_by 
			FROM disposisi AS a 
			JOIN disposisi_penanggung_jawab AS b ON b.disposisi_code = a.disposisi_code 
			JOIN member AS c ON a.created_by = c.id_member WHERE a.id =
		" . $id;

		return $this->getDataRow($sqlQuery);
	}

	public function getDetailTindakLanjut($id)
	{
		/** 1. Disposisi Tindak Lanjut */
		$sqlQuery = "SELECT * FROM disposisi AS a 
					 JOIN disposisi_penanggung_jawab AS b ON b.disposisi_code = a.disposisi_code 
					 JOIN member AS c ON a.created_by = c.id_member 
					 WHERE a.id = " . $id;

		return $this->getDataRow($sqlQuery);
	}

// end file
}