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
	echo $_GET['id_pek'];
	
	$pro = $talikuat->get_progress($_GET['kegiatan']);
	$jd = $talikuat->get_jadualdetail($_GET['lap_id']);
	$jad = $talikuat->get_jadual($_GET['lap_id']);
	$j1 = $talikuat->get_jadualdetail1($_GET['kegiatan']);
}

//$invoiceDate = date("d/M/Y, H:i:s", strtotime($lap_harian_values['real_date']));
//$invoiceDate1 = date("d/M/Y", strtotime($lap_req1['diajukan_tgl']));

$output ='<p align="center" style="font-size:14px"><b>Breakdown Jadual Pekerjaan </b></p></br>
			<p align="center" style="font-size:14px"><b>Kuantitas dan Progress Fisik </b></p>'	;

$output .= '
	<table width="100%"  cellpadding="5" cellspacing="0" style="font-size:10px">
	<tr>
	<th align="left" width="27%">KEGIATAN/PAKET</th>
	<th align="left" width="2%">:</th>
	<th align="left" >'.$jad['kegiatan'].'</th>
	</tr>';

$output .= '
	</table>';
$output .= '
	<table width="100%"  cellpadding="5" cellspacing="0" style="font-size:10px">
	<tr>
	<th align="left" width="27%">PENYEDIA JASA</th>
	<th align="left" width="2%">:</th>
	<th align="left" >'.$jad['nama_penyedia'].'</th>
	</tr>';

$output .= '
	</table>';

$output .= '
	<table width="100%"  cellpadding="5" cellspacing="0" style="font-size:10px">
	<tr>
	<th align="left" width="27%">KONSULTAN</th>
	<th align="left" width="2%">:</th>
	<th align="left" >'.$jad['konsultan'].'</th>
	</tr>';

$output .= '
	</table>';

$output .= '
	<table width="100%"  cellpadding="5" cellspacing="0" style="font-size:10px">
	<tr>
	<th align="left" width="27%">WAKTU PELAKSANAAN</th>
	<th align="left" width="2%">:</th>
	<th align="left" >'.$jad['waktu_pelaksanaan'].' Hari Kalender</th>
	</tr>';

$output .= '
	</table>';

$output .= '
	<table width="100%"  cellpadding="5" cellspacing="0" style="font-size:10px">
	<tr>
	<th align="left" width="27%">NILAI KONTRAK (NON PPN)</th>
	<th align="left" width="2%">:</th>
	<th align="left" >'.$jad['nilai_kontrak'].' Rupiah</th>
	</tr>';

$output .= '
	</table>';

$output .= '
	<table width="100%"  cellpadding="5" cellspacing="0" style="font-size:10px">
	<tr>
	<th align="left" width="27%">NOMOR MATA PEMBAYARAN</th>
	<th align="left" width="2%">:</th>
	<th align="left" >'.$jad['nmp'].'</th>
	</tr>';

$output .= '
	</table>';

$output .= '
	<table width="100%"  cellpadding="5" cellspacing="0" style="font-size:10px">
	<tr>
	<th align="left" width="27%">JENIS PEKERJAAN</th>
	<th align="left" width="2%">:</th>
	<th align="left" >'.$jad['jenis_pekerjaan'].'</th>
	</tr>';
$output .= '
	</table>';

$output .= '
	<table width="100%"  cellpadding="5" cellspacing="0" style="font-size:10px">
	<tr>
	<th align="left" width="27%">HARGA SATUAN</th>
	<th align="left" width="2%">:</th>
	<th align="left" >'.$jad['harga_satuan'].' Rupiah</th>
	</tr>';
$output .= '
	</table>';

$output .= '
	<table width="100%"  cellpadding="5" cellspacing="0" style="font-size:10px">
	<tr>
	<th align="left" width="27%">KUANTITAS RENCANA</th>
	<th align="left" width="2%">:</th>
	<th align="left" >'.$jad['volume'].' '.$jad['satuan'].'</th>
	</tr>';
$output .= '
	</table>';

$output .= '
	<table width="100%"  cellpadding="5" cellspacing="0" style="font-size:10px">
	<tr>
	<th align="left" width="27%">JUMLAH BIAYA</th>
	<th align="left" width="2%">:</th>
	<th align="left" >'.$jad['jumlah_harga'].' Rupiah</th>
	</tr>';
$output .= '
	</table>';

$output .= '
	<table width="100%"  cellpadding="5" cellspacing="0" style="font-size:10px">
	<tr>
	<th align="left" width="27%">BOBOT TERHADAP KONTRAK (%)</th>
	<th align="left" width="2%">:</th>
	<th align="left" >'.$jad['bobot'].' %</th>
	</tr>';
$output .= '
	</table>';

$output .='<br/>
			<br/>';



	
$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

	<tr>
	<th align="center" width="5%">No.</th>
	<th align="center"width="15%">Periode</th>
	<th align="center"width="30%">Kuantitas Volume <br/>
	Rencana &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Realisasi
	</th>
	<th align="center" width="30%">Progress Fisik Pekerjaan<br/>
	Rencana &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Realisasi
	</th>
	</tr>';
$count = 0;   
foreach($jd as $jd1){
	$count++;
	$output .= '
	<tr>
	<td align="center">'.$count.'</td>
	<td align="center">'.$jd1["tgl"].'|'.$j1["tgl"].'</td>
	<td align="center">'.$jd1["nilai"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$jd1["nilai"].'</td>
	<td align="center">'.$jd1["volume"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$jd1["volume"].'</td>	
	</tr>';
}

$output .= '
	</table>';
	

// create pdf of invoice	
$invoiceFileName = 'progress-'.$jad['id'].'.pdf';
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
   