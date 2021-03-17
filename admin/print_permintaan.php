<?php
session_start();
include "../src/talikuat.php";
$talikuat = new talikuat();	
/*
if(!empty($_GET['lap_id']) && $_GET['lap_id']) {
	echo $_GET['lap_id'];
	//echo $_GET['npm'];
	$lap_req = $talikuat->get_request($_GET['lap_id']);		
	//$bahan = $talikuat->get_requestbahan($_GET['lap_id']);
	//$peralatan = $talikuat->get_requestperalatan($_GET['lap_id']);
	//$tkerja = $talikuat->get_requesttkerja($_GET['lap_id']);
	//$jenis_pekerjaan = $talikuat->get_jenis_pekerjaan($_GET['npm']);
	
}
*/
if(!empty($_GET['lap_id']) && $_GET['lap_id']) {
	echo $_GET['lap_id'];
	echo $_GET['kegiatan'];
	
	//$lap_harian_values = $talikuat->getlap_harian($_GET['lap_id']);		
	//$pekerjaan = $talikuat->getlap_harianItems($_GET['lap_id']);	
	//$bahan = $talikuat->getlap_harianBahan($_GET['lap_id']);
	//$beton = $talikuat->getlap_harianBeton($_GET['lap_id']);
	//$cuaca = $talikuat->getlap_harianCuaca($_GET['lap_id']);
	//$hotmix = $talikuat->getlap_harianHotmix($_GET['lap_id']);
	//$peralatan = $talikuat->getlap_harianPeralatan($_GET['lap_id']);
	//$tkerja = $talikuat->getlap_hariantkerja($_GET['lap_id']);
	
	$lap_req = $talikuat->get_request_nmp($_GET['lap_id']);	
	$lap_req1 = $talikuat->get_request($_GET['lap_id']);
	$lap_req2 = $talikuat->get_request_kontrak($_GET['kegiatan']);	
}

//$invoiceDate = date("d/M/Y, H:i:s", strtotime($lap_harian_values['real_date']));
$invoiceDate1 = date("d/M/Y", strtotime($lap_req1['diajukan_tgl']));
$output = '<br/><br/><br/>';
$output='<br/><br/><br/><br/><br/><br/><p align="center" style="font-size:16px"><b>PENGAJUAN MEMULAI PEKERJAAN (REQUEST)</b></p>';
$output.='<b align="left" style="font-size:10px" >Kegiatan/Paket : &nbsp;  '.$lap_req1['nama_kegiatan'].'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b align="right" style="font-size:10px" >Tgl Pengajuan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;  '.$invoiceDate1.'</b><br /> 
	<b style="font-size:10px" >Penyedia Jasa &nbsp;&nbsp; : &nbsp; '.$lap_req1['nama_kontraktor'].'</b><br/>
	<b style="font-size:10px" >No. Kontrak &nbsp;&nbsp;&nbsp;: &nbsp; '.$lap_req2['no_kontrak'].'</b><br/>
	<b style="font-size:10px" >Tgl. Kontrak &nbsp;&nbsp;&nbsp;: &nbsp; '.$lap_req2['tgl_kontrak'].'</b><br/><br/>';

$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

	<tr>
	<th align="left">No.</th>
	<th align="left">No Mata Pembayaran</th>
	<th align="left">Jenis Pekerjaan</th>
	<th align="left">Satuan</th>
	<th align="left">Perkiraan Kuantitas</th>
	<th align="left">Lokasi</th>
	<th align="left">ki_ka</th>
	<th align="left">Tanggal</th>	
	</tr>';
$count = 0;   
foreach($lap_req as $lr){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$lr["jenis_pekerjaan"].'</td>
	<td align="left">'.$lr["id_jenis_pekerjaan"].'</td>
	<td align="left">'.$lr["satuan"].'</td>
	<td align="left">'.$lr["volume"].'</td>
	<td align="left">'.$lr["lokasi_sta"].'</td>
	<td align="left"></td>
	<td align="left">'.$lr["pelaksanaan_tgl"].'</td>
	
	</tr>';
}

$output .= '
	</table>';
	
//----------------------------------
$output .='<p align="Left" style="font-size:12px"><b></b></p>';
$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

	<tr>
	<th align="center">DATA PENDUKUNG</th>
	<th align="center">STATUS</th>
	<th align="center">TANGGAL</th>
	<th align="center">REFERENSI</th>
	<th align="center">VERIFIKASI PENGAWAS <br/>
	YA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| TIDAK</th>
	</tr>';

	$output .= '
	<tr>
	<td align="left">1. Gambar Kerja (SoftDrawing) <br/>
	2. Metode Kerja <br/>
	3. Rencana Pemeriksaan Pengujian <br/>
	&nbsp;&nbsp;&nbsp;&nbsp;(Inspection Testing Plan) <br/>
	4. Persetujuan Material/Bahan<br/>
	&nbsp;&nbsp;&nbsp;&nbsp;1. ........................<br/>
	&nbsp;&nbsp;&nbsp;&nbsp;2. ........................<br/>
	&nbsp;&nbsp;&nbsp;&nbsp;3. ........................<br/>
	&nbsp;&nbsp;&nbsp;&nbsp;4. ........................<br/>
	5. Persetujuan Bahan Campuran(JMF)<br/>
	&nbsp;&nbsp;&nbsp;&nbsp;1. ........................<br/>
	&nbsp;&nbsp;&nbsp;&nbsp;2. ........................<br/>
	6. Kesiapan Lapangan<br/>
	7. Kondisi dan Kelaikan Peralatan<br>
	</td>
	<td align="left"></td>
	<td align="left"></td>
	<td align="left"></td>
	<td align="center">|<br>
	|<br>
	|<br>
	|<br>
	|<br>
	|<br>
	|<br>
	|<br>
	|<br>
	|<br>
	|<br>
	|<br>
	|<br>
	|<br>
	</td>
	
	</tr>';


$output .= '
	</table>';
	

//----------------------------------
$output .='<p align="Left" style="font-size:12px"><b></b></p>';
$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

	<tr>
	<th align="center" width="200px">DIAJUKAN PENYEDIA <br/><br/><br/>
	('.$lap_req1['nama_kontraktor'].')
	</th>
	<th align="center">DIPERIKSA KONSULTAN<br/> 
	PENGAWAS<br/><br/><br/>
	(...................................)</th>
	<th align="left">CATATAN REKOMENDASI <br/>
	[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;] &nbsp;&nbsp;  Pekerjaan dapat dilaksanakan <br/>
	[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;] &nbsp;&nbsp; Pekerjaan tidak dapat dilaksanakan <br/>
	[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;] &nbsp;&nbsp; Pekerjaan dapat dilaksanakan dgn Catatan <br/>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...........................................................................<br/>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...........................................................................<br/>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...........................................................................<br/>
	</th>

	</tr>';


$output .= '
	</table>';

//----------------------------------
$output .='<p align="Left" style="font-size:12px"><b></b></p>';
$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

	<tr>
	<th align="center" width="200px">DISETUJUI PEJABAT PEMBUAT KOMITMEN (PPK) <br/><br/><br/>
	('.$lap_req1['nama_kontraktor'].')
	</th>
	<th align="left">CATATAN / KESIMPULAN PERSETUJUAN<br/><br/><br/><br/><br/>
	
	</th>


	</tr>';


$output .= '
	</table>';

	
// create pdf of invoice	
$invoiceFileName = 'Request-'.$lap_req1['id'].'.pdf';
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
   