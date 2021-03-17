<?php
session_start();
include "../src/talikuat.php";
$talikuat = new talikuat();	

if(!empty($_GET['lap_id']) && $_GET['lap_id']) {
	echo $_GET['lap_id'];
	$lap_harian_values = $talikuat->getlap_harian($_GET['lap_id']);		
	$pekerjaan = $talikuat->getlap_pekerjaanItems($_GET['lap_id']);
}

$invoiceDate = date("d/M/Y, H:i:s", strtotime($lap_harian_values['real_date']));
$invoiceDate1 = date("d/M/Y", strtotime($lap_harian_values['tanggal']));
$output = '<br/><br/><br/>';
$output='<br/><br/><br/><br/><br/><br/><p align="center" style="font-size:16px"><b>LAPORAN HARIAN PEKERJAAN</b></p>';
$output.='<b align="left" style="font-size:10px" >Kegiatan/Paket : &nbsp;  '.$lap_harian_values['kegiatan'].'</b><br /> 
    <b style="font-size:10px" >Ruas Jalan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; '.$lap_harian_values['ruas_jalan'].'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b align="right" style="font-size:10px" >Tgl &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;  '.$invoiceDate1.'</b>';
    

    $output .= ' <br/><br/><br/>
	<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:12px">

    <tr>
        <th colspan = "2" align="center">Rencana</th>
        <th colspan = "2" align="center">Realisasi</th>
    </tr>
    <tr>
        <th align="center">Tanggal Rencana</th>
        <th align="center">Volume</th>
        <th align="center">Tanggal Realisasi</th>
        <th align="center">Volume</th>
    </tr>';
    $count = 0;
    foreach($pekerjaan as $invoiceItem){
        if($invoiceItem["tglpekerjaan"] != '0000-00-00') { $tkerja = date('d F Y', strtotime($invoiceItem["tglpekerjaan"])); } else { $tkerja = "Tanggal Kosong"; }
        if($invoiceItem["tgljadual"] != '0000-00-00') { $tjadual = date('d F Y', strtotime($invoiceItem["tgljadual"])); } else { $tjadual = "Tanggal Kosong"; }
        $count++;
        $output .= '
        <tr>
            <td align="center">'.$tjadual.'</td>
            <td align="center">'.$invoiceItem["volren"].'</td>
            <td align="center">'.$tkerja.'</td>
            <td align="center">'.$invoiceItem["volreal"].'</td>	
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
   