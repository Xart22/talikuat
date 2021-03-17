<?php
session_start();
include('../konfigurasi/koneksi.php');
include "../src/talikuat.php";
include "tgl_indo.php";
$reportDate = date("M-H:i:s");

// $talikuat = new talikuat();
// $absen = $talikuat->get_absen();

$qry = mysqli_query($konek, "SELECT * FROM absen");
foreach ($qry as $nik) {
    $sql = mysqli_query($konek, "SELECT *,COUNT(tanggal) as jmlabsen, GROUP_CONCAT(tanggal ORDER BY tanggal ASC) as hari FROM absen WHERE nik = " . $nik['nik']);
    $tsql = mysqli_fetch_array($sql);

    foreach ($sql as $item) {
        // die(var_dump($item));
        $tanggal = $item['tanggal'];
    }
}

$output = "
        <h4 style='text-align:center;'><b>ABSENSI BULANAN <br> KONSULTAN PENGAWAS FIELD TEAM</b></h4>
";

$output .= "<br><br><table border='1' cellpadding='5' cellspacing='0' align='center'>";

$output .= "<br><br>
<table border='1' cellpadding='5' cellspacing='0' align='center'>";

        $output .= "
        <thead style='text-align:center;'>
          <tr>
            <th rowspan='2'>No.</th>
            <th rowspan='2'>NAMA PERUSAHAAN</th>
            <th rowspan='2'>NAMA PPK</th>
            <th colspan='31'>BULAN " . tgl_indo($tanggal) . " 2020</th>
            <th rowspan='2'>Jml</th>
            <th rowspan='2'>TTD</th>
          </tr>
          <tr>
        ";

        $pisah = explode('-', $tanggal);
        $jmlHari = cal_days_in_month(CAL_GREGORIAN, $pisah[1], date('Y'));
        $isiAbsen = [];
        for ($i = 1; $i <= $jmlHari; $i++) {
            $blnhari = $i;
            $output .= "<th>" . $i . "</th>";
            // ------------------------------- //
            $isiAbsen[$i - 1] = "<td></td>";
            // ------------------------------- //
        }

        $output .= "
            </tr>
        </thead>
        <tbody>
        ";


    $qry = mysqli_query($konek, "SELECT DISTINCT nik FROM absen");
    while ($data = mysqli_fetch_array($qry)) {
        $nik = $data['nik'];

        $cmd = "SELECT *,COUNT(tanggal) as jmlabsen, GROUP_CONCAT(tanggal ORDER BY tanggal ASC) as hari FROM absen WHERE nik = '$nik' AND jam_masuk != 0";
        $query = mysqli_query($konek, $cmd);
        
        while ($item = mysqli_fetch_array($query)) {
        $no = 1;
            // die(var_dump($item));
            //Keterangan nama konsultan
            $output .= "
            <tr>
                <td>" . $no++ . "</td>
                <td>" . $item['nama'] . "</td>
                <td>" . $item['nama_ppk'] . "</td>
            ";

            //Perhitungan atau penanda absensi pada kolom tabel di masing-masing konsultan
            $exp = explode(',', $item['hari']);
            $jml = count($exp);

            foreach ($exp as $absen) {
                $tgl = explode('-', $absen)[2];
                // $isiAbsen[$tgl - 1] = "<td>v</td>";
                $isiAbsen[$tgl - 1] = "<td>" . $tgl . "</td>";
            }
            foreach ($isiAbsen as $absen) {
                $output .= $absen;
            }
            //Sekarang ada 1 masalah datanya cuman tampil 1x itu juga datanya punya nik yg sama aja yg ditampilin harusnya semua data yang ada.

            //Jumlah hadir dan ttd konsultan
            $output .= "
                <td>" . $item['jmlabsen'] . "</td>
                <td>-</td>
            </tr>";
        
        }
    }

$output .= "
        </tbody>
    </table>";

// create pdf of invoice	
$invoiceFileName = 'Absensi-' . $reportDate . '.pdf';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A3', 'landscape');
// $dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
