<?php
	
	class Database
	{
		public $conn;
		
		public function __construct()
		{
			$this->conn= mysqli_connect("localhost","root","","dbsik") or die("Database connection failed");
		}
	}

?>