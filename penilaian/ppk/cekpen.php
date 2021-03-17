<?php
include "../konfigurasi/koneksi.php";

session_start(); // Starting Session 
$error = ''; // Variable To Store Error Message 
/*
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

*/
$namapaket=$_GET['nama_kegiatan'];
$namapenyedia= $_GET['penyedia_jasa'];
$dataumum=$_GET['data_umum'];

$data = mysqli_query($konek, "select *
					from penilaian
					where nama_paket ='$namapaket' and nama_penyedia = '$namapenyedia'");
					
$r=mysqli_fetch_array($data);
$ketemu=mysqli_num_rows($data);
$id_pen=$r['id'];
$id_paket=$r['nama_paket'];
$bln =mysqli_num_rows($data);


$data2 = mysqli_query($konek, "select * from data_umum where id='$dataumum'");
$r2=mysqli_fetch_array($data2);
$wp=$r2['waktu_pelaksanaan'];

// Apabila username dan password ditemukan
if ($ketemu > 0)
	{
	if ($wp < 120)
	{
		header("Location: buat_penilaian2.php?data_umum=$dataumum&id_pen=$id_pen&id_paket=$id_paket&wp=$wp&bln=$ketemu");
	}
		else if ($wp > 120 and $ketemu >= 2 )
	{
		header("Location: buat_penilaian4.php?data_umum=$dataumum&id_pen=$id_pen&id_paket=$id_paket&wp=$wp&bln=$ketemu");
	}
	else if($wp > 120 and $ketemu < 2)
	{
		header("Location: buat_penilaian3.php?data_umum=$dataumum&id_pen=$id_pen&id_paket=$id_paket&wp=$wp&bln=$ketemu");
	}
	/*
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

  mysqli_query($konek,"UPDATE login SET id_sesi = '$sid_baru' WHERE user='$username'");
		
		if($_SESSION['level'] == "ADMINISTRATOR")
        {
         //$_SESSION['id'] = $username;   
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
		*/
}
else
{
	header("Location: buat_penilaian.php?data_umum=$dataumum");
 // echo "<center>data Nggak ada! <br> 
 //       Username atau Password Anda tidak benar.<br>
 //       Atau account Anda sedang diblokir.<br>";
 // echo "<a href=index.html><b>ULANGI LAGI</b></a></center>";
}

//}
	//}
//}
//}
?>
