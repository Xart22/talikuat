<?php
// $host = "103.131.0.195";
// $user = "talikuat";
// $pass = "";
// $database = "dbsik";

$host = "localhost";
$user = "root";
$pass = "";
$database = "dbsik";
// Koneksi dan memilih database di server
$konek=mysqli_connect($host,$user,$pass) or die("Koneksi gagal");
mysqli_select_db($konek,$database) or die("Database tidak bisa dibuka");
?>
