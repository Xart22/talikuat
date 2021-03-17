<?php 
class tampil{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "dbsik";   
	private $login='login';
	private $member='member';
	private $data_umum='data_umum';
	private $data_umum_ruas='data_umum_ruas';
	private $master_penyedia_jasa='master_penyedia_jasa';
	private $master_ppk='master_ppk';
	private $master_konsultan='master_konsultan';
	private $master_jenis_pekerjaan='master_jenis_pekerjaan';
	private $request='request';
	
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
	
				public function kontraktor_row(){
				$sql = "select*from ".$this->master_penyedia_jasa."";
				$result = mysqli_query($this->dbConnect, $sql);
				$row = mysqli_num_rows($result);
				return $row;
				}
			
			function konsultan_row(){
				$sql = "select*from ".$this->master_konsultan."";
				$result = mysqli_query($this->dbConnect, $sql);
				$row = mysqli_num_rows($result);
				return $row;
			}

			function ppk_row(){
				$sql = "select*from ".$this->master_ppk."";
				$result = mysqli_query($this->dbConnect, $sql);
				$row = mysqli_num_rows($result);
				return $row;
			}

	function data_umum_kontraktor(){
				//$sql = "select * from data_umum";
		$sqlQuery="
			select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from ".$this->data_umum." JOIN ".$this->data_umum_ruas." on 
			".$this->data_umum.".id=".$this->data_umum_ruas.".id 
			where ".$this->data_umum.".penyedia_jasa='".$_SESSION['perusahaan']."' group by ".$this->data_umum.".id "; 
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_num_rows($result);
		return $row;
	}

	function data_umum_konsultan(){
				//$sql = "select * from data_umum";
		$sqlQuery="
			select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from ".$this->data_umum." JOIN ".$this->data_umum_ruas." on 
			".$this->data_umum.".id=".$this->data_umum_ruas.".id 
			where ".$this->data_umum.".konsultan_supervisi='".$_SESSION['perusahaan']."' group by ".$this->data_umum.".id "; 
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_num_rows($result);
		return $row;
	}

	function data_umum_ppk(){
				//$sql = "select * from data_umum";
		$sqlQuery="
			select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from ".$this->data_umum." JOIN ".$this->data_umum_ruas." on 
			".$this->data_umum.".id=".$this->data_umum_ruas.".id 
			where ".$this->data_umum.".nama_ppk='".$_SESSION['nama_lengkap']."' group by ".$this->data_umum.".id "; 
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_num_rows($result);
		return $row;
	}	

	function data_umum_admin_uptd(){
				//$sql = "select * from data_umum";
		$sqlQuery="
			select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from ".$this->data_umum." JOIN ".$this->data_umum_ruas." on 
			".$this->data_umum.".id=".$this->data_umum_ruas.".id 
			where ".$this->data_umum.".unor='".$_SESSION['unit']."' group by ".$this->data_umum.".id "; 
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_num_rows($result);
		return $row;
	}
	
	function data_umum_admin(){
				//$sql = "select * from data_umum";
		$sqlQuery="
			select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from ".$this->data_umum." JOIN ".$this->data_umum_ruas." on 
			".$this->data_umum.".id=".$this->data_umum_ruas.".id 
			 group by ".$this->data_umum.".id "; 
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_num_rows($result);
		return $row;
	}	

	public function kontraktor(){
		$sqlQuery = "
			SELECT * FROM ".$this->master_penyedia_jasa.""; 
		return  $this->getData($sqlQuery);	
	}		

	function kontraktor_edit($id){
		$sqlQuery = "select * from ".$this->master_penyedia_jasa." 
					where id='$id'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}			

	public function konsultan(){
		$sqlQuery = "
			SELECT * FROM ".$this->master_konsultan.""; 
		return  $this->getData($sqlQuery);	
	}

	function konsultan_edit($id){
		$sqlQuery = "select * from ".$this->master_konsultan." 
					where id='$id'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}

	public function ppk(){
		$sqlQuery = "
			SELECT * FROM ".$this->master_ppk.""; 
		return  $this->getData($sqlQuery);	
	}

	function ppk_edit($id){
		$sqlQuery = "select * from ".$this->master_ppk." 
					where id='$id'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}

			public function data_user(){
				$sqlQuery = "select * from ".$this->member."";
				return  $this->getData($sqlQuery);	
			}

			function data_user_edit($id){
				$sqlQuery = "select * from ".$this->member."
						where id_member='$id'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
			}	

			function konsultan_submit1($id){
				$sqlQuery = "select * from ".$this->request." 
						where id='$id'";
				$result = mysqli_query($this->dbConnect, $sqlQuery);	
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				return $row;
			}			

	public function jenis_pekerjaan(){
		$sqlQuery = "
			SELECT * FROM ".$this->master_jenis_pekerjaan.""; 
		return  $this->getData($sqlQuery);	
	}

	function jenis_pekerjaan_edit($id){
		$sqlQuery = "select * from ".$this->master_jenis_pekerjaan." 
					where id='$id'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}

	function data_umum(){
				//$sql = "select * from data_umum";
		$sqlQuery="
			select *, GROUP_CONCAT(ruas_jalan) as ruas_jalan from ".$this->data_umum." JOIN ".$this->data_umum_ruas." on ".$this->data_umum.".id=".$this->data_umum_ruas.".id group by ".$this->data_umum.".id "; 
		return $this->getData($sqlQuery);
	}

			function member_edit($id){
				$sqlQuery = "select ".$this->member.".*, ".$this->login.".*
						from ".$this->member." inner join ".$this->login." on ".$this->member.".id_member = ".$this->login.".id_member
						where ".$this->member.".id_member= '$id'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
			}
			
}
?>