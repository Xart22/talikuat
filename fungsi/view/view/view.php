<?php
	/*
	 * PROSES TAMPIL  
	 */ 
	 class view {
		protected $db;
		function __construct($db){
			$this->db = $db;
		}
			
			function member(){
				$sql = "select member.*, login.*
						from member inner join login on member.id_member = login.id_member where login.user='".$_SESSION['nama']."'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function member_edit($id){
				$sql = "select member.*, login.*
						from member inner join login on member.id_member = login.id_member
						where member.id_member= ?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}
			
			function kantor(){
				$sql = "select*from kantor where user='".$_SESSION['kantorid']."'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
//-------------------------------------------------------
			function kategori(){
				$sql = "select*from kategori";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function pekerjaan(){
				$sql = "select*from master_jenis_pekerjaan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}			
			

//---------------------------------------------------------
			function barang(){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function bahan(){
				$sql = "select * from master_bahan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}	

			function list_laporan(){
				$sql = "select * from master_laporan_harian where user='".$_SESSION['userid']."'" ;
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}			


			function list_laporan1(){
				$sql = "select master_laporan_harian.*, detail_laporan_harian_pekerjaan.jenis_pekerjaan, detail_laporan_harian_pekerjaan.no_pekerjaan, 
						detail_laporan_harian_pekerjaan.volume from master_laporan_harian left join detail_laporan_harian_pekerjaan 
						on master_laporan_harian.no_trans=detail_laporan_harian_pekerjaan.no_trans where master_laporan_harian.user='".$_SESSION['userid']."'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}


			function list_laporan_kontraktor(){
				$sql = "select master_laporan_harian.*, detail_laporan_harian_pekerjaan.jenis_pekerjaan, detail_laporan_harian_pekerjaan.no_pekerjaan, 
						detail_laporan_harian_pekerjaan.volume from master_laporan_harian left join detail_laporan_harian_pekerjaan 
						on master_laporan_harian.no_trans=detail_laporan_harian_pekerjaan.no_trans where master_laporan_harian.nama_kontraktor='".$_SESSION['perusahaan']."'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function list_laporan_ppk(){
				//$sql = "select * from master_laporan_harian where nama_ppk='".$_SESSION['nm_member']."'" ;
				$sql = "select master_laporan_harian.*, detail_laporan_harian_pekerjaan.jenis_pekerjaan, detail_laporan_harian_pekerjaan.no_pekerjaan, 
						detail_laporan_harian_pekerjaan.volume from master_laporan_harian left join detail_laporan_harian_pekerjaan 
						on master_laporan_harian.no_trans=detail_laporan_harian_pekerjaan.no_trans where master_laporan_harian.nama_ppk='".$_SESSION['nm_member']."'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}	

			function list_laporan_konsultan(){
				$sql = "select master_laporan_harian.*, detail_laporan_harian_pekerjaan.jenis_pekerjaan, detail_laporan_harian_pekerjaan.no_pekerjaan, 
						detail_laporan_harian_pekerjaan.volume from master_laporan_harian left join detail_laporan_harian_pekerjaan 
						on master_laporan_harian.no_trans=detail_laporan_harian_pekerjaan.no_trans where master_laporan_harian.nama_konsultan='".$_SESSION['nm_member']."'";
				//$sql = "select * from master_laporan_harian where nama_konsultan='".$_SESSION['nm_member']."'" ;
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function list_request_ppk(){
				$sql = "select * from request where nama_ppk='".$_SESSION['nm_member']."'" ;
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function list_request_konsultan(){
				$sql = "select * from request where nama_direksi='".$_SESSION['nm_member']."'" ;
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function data_umum(){
				//$sql = "select * from data_umum";
				$sql="select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from data_umum JOIN data_umum_ruas on data_umum.id=data_umum_ruas.id group by data_umum.id "; 
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function data_umum_kontraktor(){
				//$sql = "select * from data_umum";
				$sql="select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from data_umum JOIN data_umum_ruas on data_umum.id=data_umum_ruas.id where data_umum.penyedia_jasa='".$_SESSION['perusahaan']."' group by data_umum.id "; 
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			
			function data_unduhan_kontraktor(){
				//$sql = "select * from data_umum";
				$sql="select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from data_umum JOIN data_umum_ruas on data_umum.id=data_umum_ruas.id where data_umum.penyedia_jasa='".$_SESSION['nm_member']."' group by data_umum.id "; 
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function data_umum_ruas(){
				$sql = "select * from data_umum_ruas";
				//$sql="select * from data_umum join data_umum_ruas on data_umum.id = data_umum_ruas.id"; 
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function list_request(){
				$sql = "select * from request where user='".$_SESSION['userid']."'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function list_request_kontraktor(){
				$sql = "select * from request where nama_kontraktor='".$_SESSION['perusahaan']."'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}


			function list_jadual(){
				$sql = "select * from jadual";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}	

			function list_jadual_kontraktor(){
				$sql = "select * from jadual where nama_penyedia='".$_SESSION['perusahaan']."'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function detail_jadual(){
				$sql = "select * from detail_jadual";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function kontraktor(){
				$sql = "select * from master_penyedia_jasa";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}	

			function konsultan(){
				$sql = "select * from master_konsultan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}	

			function ppk(){
				$sql = "select * from master_ppk";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function data_user(){
				$sql = "select * from member";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}			
//---------------------------------------------------------------------

			function barang_edit($id){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori
						where id_barang=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function bahan_edit($id){
				$sql = "select * from master_bahan 
						where id=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function pekerjaan_edit($id){
				$sql = "select * from master_jenis_pekerjaan
						where id=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function data_umum_edit($id){
				$sql = "select * from data_umum
						where id=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}


			function request_edit($id){
				$sql = "select * from request
						where id=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function data_user_edit($id){
				$sql = "select * from member 
						where id_member=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function kontraktor_edit($id){
				$sql = "select * from master_penyedia_jasa 
						where id=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}
			
			function konsultan_edit($id){
				$sql = "select * from master_konsultan 
						where id=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function ppk_edit($id){
				$sql = "select * from master_ppk 
						where id=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}
			
			function ppk_submit($id){
				$sql = "select * from master_laporan_harian 
						where no_trans=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function ppk_submit1($id){
				$sql = "select * from request 
						where id=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}			

			function konsultan_submit1($id){
				$sql = "select * from request 
						where id=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}			
//-----------------------------------------------------------------------------------------------------------
			function barang_cari($cari){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori
						where id_barang like '%$cari%' or nama_barang like '%$cari%' or merk like '%$cari%'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
//--------------------------------------------------------------------------------------------------------------------------------------
			function barang_id(){
				$sql = 'SELECT * FROM barang ORDER BY id_barang DESC';
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				
				$urut = substr($hasil['id_barang'], 2, 3);
				$tambah = (int) $urut + 1;
				if(strlen($tambah) == 1){
					 $format = 'BR00'.$tambah.'';
				}else if(strlen($tambah) == 2){
					 $format = 'BR0'.$tambah.'';
				}else{
					 $format = 'BR'.$tambah.'';
				}
				return $format;
			}


			function bahan_id(){
				$sql = 'SELECT * FROM barang ORDER BY id_barang DESC';
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				
				$urut = substr($hasil['id_barang'], 2, 3);
				$tambah = (int) $urut + 1;
				if(strlen($tambah) == 1){
					 $format = 'BR00'.$tambah.'';
				}else if(strlen($tambah) == 2){
					 $format = 'BR0'.$tambah.'';
				}else{
					 $format = 'BR'.$tambah.'';
				}
				return $format;
			}			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
//---------------------------------------------------------------------------------------------------------------------------------------
			function kategori_edit($id){
				$sql = "select*from kategori where id_kategori=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function kategori_row(){
				$sql = "select*from kategori";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function kegiatan_row(){
				$sql = "select*from data_umum";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function kegiatan_kontraktor_row(){
				$sql="select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from data_umum JOIN data_umum_ruas on data_umum.id=data_umum_ruas.id where data_umum.penyedia_jasa='".$_SESSION['perusahaan']."' group by data_umum.id ";
				//$sql = "select*from data_umum where penyedia_jasa='".$_SESSION['perusahaan']."'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function kontraktor_row(){
				$sql = "select*from master_penyedia_jasa";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function konsultan_row(){
				$sql = "select*from master_konsultan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function ppk_row(){
				$sql = "select*from master_ppk";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

//=========================Laporan Harian============================================================================
			function laporan_row(){
				$sql = "select*from master_laporan_harian";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}


			function laporan1_row(){
				$sql = "select master_laporan_harian.*, detail_laporan_harian_pekerjaan.jenis_pekerjaan, detail_laporan_harian_pekerjaan.no_pekerjaan, 
						detail_laporan_harian_pekerjaan.volume from master_laporan_harian left join detail_laporan_harian_pekerjaan 
						on master_laporan_harian.no_trans=detail_laporan_harian_pekerjaan.no_trans";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}




			function laporan_ppk_row(){
				$sql = "select*from master_laporan_harian where ppk='1'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function laporan_pengajuan_row(){
				$sql = "select*from master_laporan_harian where kontraktor='1'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function laporan_konsultan_row(){
				$sql = "select*from master_laporan_harian where konsultan='1'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}
			
//=================================request==================================================================================
			function request_row(){
				$sql = "select*from request";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function request_ppk_row(){
				$sql = "select*from request where ppk='1'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function request_pengajuan_row(){
				$sql = "select*from request where kontraktor='1'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function request_konsultan_row(){
				$sql = "select*from request where konsultan='1'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

//------------------------------------------------------------------------------------------------------------------------------------------------
			function barang_stok_row(){
				$sql ="SELECT SUM(stok) as jml FROM barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function barang_beli_row(){
				$sql ="SELECT SUM(harga_beli) as beli FROM barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jual_row(){
				$sql ="SELECT SUM(jumlah) as stok FROM nota";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jual(){
				$sql ="SELECT nota.* , barang.id_barang, barang.nama_barang, member.id_member,
						member.nm_member from nota 
					   left join barang on barang.id_barang=nota.id_barang 
					   left join member on member.id_member=nota.id_member";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			
			function periode_jual($periode){
				$sql ="SELECT nota.* , barang.id_barang, barang.nama_barang, member.id_member,
						member.nm_member from nota 
					   left join barang on barang.id_barang=nota.id_barang 
					   left join member on member.id_member=nota.id_member WHERE nota.periode = ?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($periode));
				$hasil = $row -> fetchAll();
				return $hasil;
			}


			function penjualan(){
				$sql ="SELECT penjualan.* , barang.id_barang, barang.nama_barang, member.id_member,
						member.nm_member from penjualan 
					   left join barang on barang.id_barang=penjualan.id_barang 
					   left join member on member.id_member=penjualan.id_member
					   ORDER BY id_penjualan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function jumlah(){
				$sql ="SELECT SUM(total) as bayar FROM penjualan";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jumlah_nota(){
				$sql ="SELECT SUM(total) as bayar FROM nota";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jml(){
				$sql ="SELECT SUM(harga_beli*stok) as byr FROM barang";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
	 }
