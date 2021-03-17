<?php
date_default_timezone_set('Asia/Jakarta'); //zona waktu berdasarkan negara

class LogHistory {
    private $host       = 'localhost';
    private $user       = 'root';
    private $password   = "";
    private $database   = "dbsik";
    private $menu_log   = "menu_log";
    private $proses_log = "proses_log"; 
    private $dbConnect  = false;
    
    public function __construct(){
        if (!$this->dbConnect) {
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if ($conn->connect_error) {
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else {
                $this->dbConnect = $conn;
            }
        }
    }

    public function recordLog($menu) {
        //Checking page how does pages is refresh or entire by user or not?
        $refresh = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        $id_logged = $_SESSION['id_logged']; //id_session_user_login
        $date = date('h:i:s'); //jam

        if($refresh) {
            // Page refresh no history
        } else {
            $sql = "INSERT INTO ".$this->menu_log." (id_login_user, catatan_menu, jam) VALUES ($id_logged, '$menu','$date')";
            $query = mysqli_query($this->dbConnect, $sql);

            if(!$query) {
                die("Warning : History Log hasn't been recorded");
            }
        }
    }

    public function recordProcLog($proc) {
        //Checking page how does pages is refresh or entire by user or not?
        $id_logged = $_SESSION['id_logged']; //id_session_user_login
        $date = date('h:i:s'); //jam

        $sql = "INSERT INTO ".$this->proses_log." (id_login_user, keterangan_proses, jam_proses) VALUES ($id_logged, '$proc','$date')";
        $query = mysqli_query($this->dbConnect, $sql);

        if($query) {
            // echo "History Log has been recorded";
        }
    }

}