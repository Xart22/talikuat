<?PHP
include "koneksi.php";

$awalan='lh-';
$lebar=6;

	$query="select no_trans from master_laporan_harian order by no_trans desc limit 1";
	$hasil=mysqli_query($konek,$query);
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

?>