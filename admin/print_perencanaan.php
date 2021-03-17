<?php
session_start();
include('../konfigurasi/koneksi.php');
include "../src/talikuat.php";
include "tgl_indo.php";

if(!isset($_GET['id'])) {
    echo '<script language="javascript">alert("Anda Salah Format ID Kosong!!!"); document.location="perencanaan_konsultan.php";</script>';
}

$talikuat = new talikuat();

$id = $_GET['id'];
$sql = "SELECT * FROM jadual WHERE id = " . $id;
$query = mysqli_query($konek, $sql);

foreach($query as $data) {
    
    $output = "
        <h3 style='text-align:center;'>BREAKDOWN VOLUME PEKERJAAN <br> PRESERVASI " . $data['kegiatan'] . "</h3>
        <br><br><br>

        <p>Paket Pekerjaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  : Preservasi " . $data['kegiatan'] . " <br>
        Waktu Pelaksanaan &nbsp;&nbsp;&nbsp;&nbsp;: " . $data['waktu_pelaksanaan'] . " Hari <br>
        Ruas Jalan        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: " . $data['ruas_jalan'] . " <br>
        Panjang           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : " . $data['panjang'] . " KM<br>
        Nama penyedia     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : " . $data['nama_penyedia'] . "</p>
    ";

    $bulank = $talikuat->get_bulan_perencanaan();
    $jml = 1;
    foreach ($bulank as $dk) {
        $bulan = $dk['bulan'];
        $jml++;

        $tglt = $dk['tgl'];

        $minggu = date('Y-m-d', strtotime('+1 week', strtotime($tglt)));
        // echo $minggu . "    ";
        $colspan = 3 + $jml;
    }

    $bulank = $talikuat->get_bulan_perencanaan();
    $kolom = '';
    foreach ($bulank as $dk) {
        $bulan = $dk['bulan'];
        $kolom .= '<th>' . bulan_indo($bulan) . '</th>';
    }

    $output .= "<br><br><br>
        <table border='1' align='center' cellpadding='5' cellspacing='0' style='text-align:center;'>
            <thead>
                <tr style='background:#DFF0D8;color:#333;'>
                    <th rowspan='2'>No.</th>
                    <th rowspan='2'>Kegiatan</th>
                    <th rowspan='2'>No. Mata Pembayaran</th>
                    <th rowspan='2'>Uraian</th>
                    <th rowspan='2'>Satuan</th>
                    <th rowspan='2'>Harga Satuan (Rupiah)</th>
                    <th colspan='$colspan'>Preservasi Rekonstruksi/Rehabilitasi Jalan</th>
                </tr>
                <tr>
                    <th rowspan='1'>Volume</th>
                    <th rowspan='1'>Jumlah Harga (Rp.)</th>
                    <th rowspan='1'>Bobot (%)</th>
                    <!-- <th rowspan='2'>1 Feb - 7 Feb</th> -->
                    ".$kolom."
                </tr>
            </thead>
    ";

    $no = 1;
    
    $output .= "
        <tbody> ";

        $konsultan = mysqli_query($konek, "SELECT * FROM detail_jadual WHERE id = '$id' ORDER BY nmp ASC");
        foreach($konsultan as $k) {
        // die(var_dump($k['bobot']));
            $kolbobot = '';
            for ($i = 0; $i < 21; $i++) {
                $bobot = $k['bobot'] / 4;
                $kolbobot .= "<td>" . $bobot . "</td>";
            }

            $output .= "
                <tr>
                    <td>". $no++ ."</td>
                    <td>". $k['kegiatan'] ."</td>
                    <td>". $k['nmp'] ."</td>
                    <td>". $k['uraian'] ."</td>
                    <td>". $k['satuan'] ."</td>
                    <td>". $k['harga_satuan'] ."</td>
                    <td>". $k['volume'] ."</td>
                    <td>". $k['jumlah_harga'] ."</td>
                    <td>". $k['bobot'] ."</td>
                    <td>". $kolbobot ."</td>
                </tr>
            ";
        }

    $output .= "
        </tbody>
    </table>
    ";

}


// create pdf of report planning consultant	
$invoiceFileName = 'Laporan_perencanaan.pdf';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A2', 'landscape');
// $dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
