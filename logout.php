<?php
	include "konfigurasi/koneksi.php";
	include "src/LogHistory.php";
	session_start();
	
	date_default_timezone_set('Asia/Jakarta'); //zona waktu berdasarkan negara
	$tgl_now = date('Y-m-d H:i:s');
	// die($tgl_now);
	$id_logged = $_SESSION['id_logged'];
  	$log = mysqli_query($konek, "INSERT INTO menu_log (id_login_user, catatan_menu, jam) VALUES ($id_logged, 'Logout','$tgl_now')");

	if($log) {
		session_destroy();
		echo '<script>alert("Anda Telah Logout");window.location="index.php"</script>';
	} else {
		die('You Die!!!');
	}
?>
