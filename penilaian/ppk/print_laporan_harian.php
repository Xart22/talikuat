<?php
session_start();
include "../src/talikuat.php";
$talikuat = new talikuat();	
/*
include '../../../src/lap_harian.php';
$lap_harian = new Lap_harian();
$lap_harian->checkLoggedIn();
if(!empty($_GET['lap_id']) && $_GET['lap_id']) {
	echo $_GET['lap_id'];
	$invoiceValues = $lap_harian->getlap_harian($_GET['lap_id']);		
	$invoiceItems = $lap_harian->getlap_harianItems($_GET['lap_id']);	
	$bahan = $lap_harian->getlap_harianBahan($_GET['lap_id']);
	$beton = $lap_harian->getlap_harianBeton($_GET['lap_id']);
	$cuaca = $lap_harian->getlap_harianCuaca($_GET['lap_id']);
	$hotmix = $lap_harian->getlap_harianHotmix($_GET['lap_id']);
	$peralatan = $lap_harian->getlap_harianPeralatan($_GET['lap_id']);
	$tkerja = $lap_harian->getlap_hariantkerja($_GET['lap_id']);
}
*/
if(!empty($_GET['lap_id']) && $_GET['lap_id']) {
	echo $_GET['lap_id'];
	$lap_harian_values = $talikuat->getlap_harian($_GET['lap_id']);		
	$pekerjaan = $talikuat->getlap_harianItems($_GET['lap_id']);	
	$bahan = $talikuat->getlap_harianBahan($_GET['lap_id']);
	$beton = $talikuat->getlap_harianBeton($_GET['lap_id']);
	$cuaca = $talikuat->getlap_harianCuaca($_GET['lap_id']);
	$hotmix = $talikuat->getlap_harianHotmix($_GET['lap_id']);
	$peralatan = $talikuat->getlap_harianPeralatan($_GET['lap_id']);
	$tkerja = $talikuat->getlap_hariantkerja($_GET['lap_id']);
}

$invoiceDate = date("d/M/Y, H:i:s", strtotime($lap_harian_values['real_date']));
$invoiceDate1 = date("d/M/Y", strtotime($lap_harian_values['tanggal']));
$output = '<br/><br/><br/>';
$output='<br/><br/><br/><br/><br/><br/><p align="center" style="font-size:16px"><b>LAPORAN HARIAN</b></p>';
$output.='<b align="left" style="font-size:10px" >Kegiatan/Paket : &nbsp;  '.$lap_harian_values['kegiatan'].'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b align="right" style="font-size:10px" >Tgl &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;  '.$invoiceDate1.'</b><br /> 
	<b style="font-size:10px" >Ruas Jalan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; '.$lap_harian_values['ruas_jalan'].'</b><br/>
	<b style="font-size:10px" >Segmen Jalan &nbsp;&nbsp;&nbsp;: &nbsp; '.$lap_harian_values['segmen_jalan'].'</b><br/><br/>';

$output .='<p align="Left" style="font-size:12px"><b>PEKERJAAN</b></p>';
$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

	<tr>
	<th align="left">No.</th>
	<th align="left">Id Pekerjaan</th>
	<th align="left">Jenis Pekerjaan</th>
	<th align="left">Sta Awal</th>
	<th align="left">Sta Akhir</th>
	<th align="left">Ki/Ka</th>
	<th align="left">Volume</th>
	<th align="left">Satuan</th>
	<th align="left">Ket</th>	
	</tr>';
$count = 0;   
foreach($pekerjaan as $invoiceItem){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$invoiceItem["no_pekerjaan"].'</td>
	<td align="left">'.$invoiceItem["jenis_pekerjaan"].'</td>
	<td align="left">'.$invoiceItem["sta_awal"].'</td>
	<td align="left">'.$invoiceItem["sta_akhir"].'</td>
	<td align="left">'.$invoiceItem["ki_ka"].'</td> 
	<td align="left">'.$invoiceItem["volume"].'</td>
	<td align="left">'.$invoiceItem["satuan"].'</td>
	<td align="left">'.$invoiceItem["ket"].'</td>  	
	</tr>';
}

$output .= '
	</table>';
	
//----------------------------------
$output .='<p align="Left" style="font-size:12px"><b>BAHAN / MATERIAL</b></p>';
$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">
	<tr>
	<th align="left">No.</th>
	<th align="left">Bahan Digunakan</th>
	<th align="left">Volume</th>
	<th align="left">Satuan</th>
	</tr>';
$count = 0;   
foreach($bahan as $bahanItem){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$bahanItem["bahan"].'</td>
	<td align="left">'.$bahanItem["volume"].'</td>
	<td align="left">'.$bahanItem["satuan"].'</td> 	
	</tr>';
}

$output .= '
	</table>';

//----------------------------------
$output .='<p align="Left" style="font-size:12px"><b>PERALATAN</b></p>';
$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

	<tr>
	<th align="left">No.</th>
	<th align="left">Jenis Peralatan</th>
	<th align="left">Jumlah</th>
	<th align="left">Satuan</th>	
	</tr>';
$count = 0;   
foreach($peralatan as $peralatanItem){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$peralatanItem["jenis_peralatan"].'</td>
	<td align="left">'.$peralatanItem["jumlah"].'</td>
	<td align="left">'.$peralatanItem["satuan"].'</td> 	
	</tr>';
}

$output .= '
	</table>';	

//----------------------------------
$output .='<p align="Left" style="font-size:12px"><b>BAHAN HOTMIX ASPHALT</b></p>';
$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

	<tr>
	<th align="left">No.</th>
	<th align="left">Bahan Digunakan</th>
	<th align="left">No. Dump Truck</th>
	<th align="left">Waktu Datang</th>
	<th align="left">Waktu Hampar</th>
	<th align="left">Suhu Datang</th>
	<th align="left">Suhu Hampar</th>
	<th align="left">P(m)</th>
	<th align="left">L(m)</th>
	<th align="left">T.Gembur(m)</th>	
	<th align="left">Ket</th>		
	</tr>';
$count = 0;   
foreach($hotmix as $hotmixItem){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$hotmixItem["bahan_hotmix"].'</td>
	<td align="left">'.$hotmixItem["no_dt"].'</td>
	<td align="left">'.$hotmixItem["waktu_datang"].'</td>
	<td align="left">'.$hotmixItem["waktu_hampar"].'</td>
	<td align="left">'.$hotmixItem["suhu_datang"].'</td>
	<td align="left">'.$hotmixItem["suhu_hampar"].'</td>
	<td align="left">'.$hotmixItem["pro_p"].'</td>
	<td align="left">'.$hotmixItem["pro_i"].'</td>
	<td align="left">'.$hotmixItem["pro_t"].'</td>
	<td align="left">'.$hotmixItem["ket"].'</td>
	</tr>';
}

$output .= '
	</table>';	

//----------------------------------
$output .='<p align="Left" style="font-size:12px"><b>BAHAN BETON READY MIX</b></p>';
$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

	<tr>
	<th align="left">No.</th>
	<th align="left">Bahan Digunakan</th>
	<th align="left">No. Truck Mixer</th>
	<th align="left">Waktu Datang</th>
	<th align="left">Waktu Curah</th>
	<th align="left">Slump Test</th>
	<th align="left">Satuan</th>
	<th align="left">Ket</th>	
	</tr>';
$count = 0;   
foreach($beton as $betonItem){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$betonItem["bahan_beton"].'</td>
	<td align="left">'.$betonItem["no_tm"].'</td>
	<td align="left">'.$betonItem["waktu_datang"].'</td>
	<td align="left">'.$betonItem["waktu_curah"].'</td>
	<td align="left">'.$betonItem["slump_test"].'</td>
	<td align="left">'.$betonItem["satuan"].'</td>
	<td align="left">'.$betonItem["ket"].'</td>
	</tr>';
}

$output .= '
	</table>';

//----------------------------------
$output .='<p align="Left" style="font-size:12px"><b>TENAGA KERJA</b></p>';
$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

	<tr>
	<th align="left">No.</th>
	<th align="left">Tenaga Kerja</th>
	<th align="left">Jumlah</th>
	</tr>';
$count = 0;   
foreach($tkerja as $tk){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$tk["tenaga_kerja"].'</td>
	<td align="left">'.$tk["jumlah"].'</td>	
	</tr>';
}

$output .= '
	</table>';

//----------------------------------
$output .='<p align="Left" style="font-size:12px"><b>CUACA</b></p>';
$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

	<tr>
	<th align="left">No.</th>
	<th align="left">Cerah</th>
	<th align="left">Hujan Ringan</th>
	<th align="left">Hujan Lebat</th>
	<th align="left">Bencana Alam</th>
	<th align="left">Lain-lain</th>	
	</tr>';
$count = 0;   
foreach($cuaca as $cc){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$cc["cerah"].'</td>
	<td align="left">'.$cc["hujan_ringan"].'</td>
	<td align="left">'.$cc["hujan_lebat"].'</td>
	<td align="left">'.$cc["bencana_alam"].'</td>
	<td align="left">'.$cc["lain_lain"].'</td>
 	
	</tr>';
}

$output .= '
	</table>';

	
// create pdf of invoice	
$invoiceFileName = 'Invoice-'.$lap_harian_values['no_trans'].'.pdf';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
//$dompdf->setPaper('A4', 'landscape');
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
?>   
   