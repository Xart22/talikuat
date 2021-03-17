<?php
include "konfigurasi/koneksi.php";
include "src/LogHistory.php";

session_start(); // Starting Session 
$error = ''; // Variable To Store Error Message 
ini_set('date.timezone', 'Asia/Jakarta');
if (isset($_POST['submit'])) { 
	if (empty($_POST['username']) || empty($_POST['password'])) { 
		$error = "Username or Password is invalid"; 
	} 
	else{ 
function anti_injection($data){
 // $filter = mysqli_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  $filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
  return $filter;
}

$username = anti_injection($_POST['username']);
$pass     = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  echo "Sekarang loginnya tidak bisa di injeksi lho.";
}
else{
//$login=mysqli_query($konek,"SELECT * FROM login WHERE user='$username' AND pass='$pass'");

$login = mysqli_query($konek, "select member.*, login.*
					from login inner join member on login.id_member = member.id_member
					where user ='$username' and pass = '$pass'");

$r=mysqli_fetch_array($login);
$ketemu=mysqli_num_rows($login);

// Apabila username dan password ditemukan
if ($ketemu > 0)
{
  $_SESSION['id_logged'] = $r['id_login'];
  $_SESSION['nama'] = $r['user'];
  $_SESSION['level'] = $r['level'];
  $_SESSION['id_member'] = $r['id_member'];
  $_SESSION['perusahaan'] = $r['perusahaan'];
  $_SESSION['nama_lengkap'] = $r['nama_lengkap'];
  $_SESSION['unit'] = $r['unit'];
  $_SESSION['userid'] = $r['id_member'];
  
  $sid_lama = session_id();
	session_regenerate_id();
  $sid_baru = session_id();
  $tgl_now = date('Y-m-d H:i:s');
  $ip = $_SERVER['SERVER_ADDR'];

  mysqli_query($konek, "UPDATE login SET id_sesi = '$sid_baru' WHERE user='$username'");
  $cek = mysqli_query($konek, "INSERT INTO history_log(id_login, login_time, ip_user) VALUES ($r[id_login],'$tgl_now','$ip')");
  $date = date("h:i:s");
  $id_logged = $_SESSION['id_logged'];
  $log = mysqli_query($konek, "INSERT INTO menu_log (id_login_user, catatan_menu, jam) VALUES ($id_logged, 'Dashboard','$date')");

        if($_SESSION['level'] == "ADMINISTRATOR")
        {
            header("Location: admin/index.php");
        }
        else if($_SESSION['level'] =="KONTRAKTOR")
        {
            header("Location: kontraktor/index.php");
        }
        else if($_SESSION['level'] == "KONSULTAN")
        {
            
            header("Location: konsultan/index.php");
        }
        else if($_SESSION['level'] == "PPK")
        {
            
            header("Location: ppk/index.php");
        }
        else if($_SESSION['level'] == "ADMIN-UPTD")
        {
            
            header("Location: admin_uptd/index.php");
        }	
      }
      else
      {
        echo "<center>LOGIN GAGAL! <br> 
              Username atau Password Anda tidak benar.<br>
              Atau account Anda sedang diblokir.<br>";
        // echo "<a href=index.html><b>ULANGI LAGI</b></a></center>";
      }
    }
	}
}
//}
?>
