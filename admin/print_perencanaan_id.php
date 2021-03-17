<?php
session_start();
include('../konfigurasi/koneksi.php');
include "../src/talikuat.php";
include "tgl_indo.php";

if (!isset($_GET['id_pekerjaan'])) {
    echo '<script language="javascript">alert("Anda Salah Format ID Kosong!!!"); document.location="perencanaan_konsultan.php";</script>';
}

/* 
   ===================================================================================================================
    Untuk sementara datanya saya buat 1 terlebih dahulu karena di tabelnya banyak id yang gak berelasi 
    dan banyak nama yang redundan
   ===================================================================================================================
*/

$kegiatan = $_GET['id_pekerjaan'];
 
$query = mysqli_query($konek, "SELECT a.*,c.*,c.volume AS rencana, b.volume AS realisasi, b.jenis_pekerjaan, d.waktu_pelaksanaan, d.nilai_kontrak, c.harga_satuan AS hargasatuan FROM jadual AS a INNER JOIN detail_laporan_harian_pekerjaan AS b ON a.id = b.no_trans INNER JOIN detail_jadual AS c ON a.id = c.id_jadual INNER JOIN data_umum AS d ON a.id_data_umum = d.id WHERE a.kegiatan = '$kegiatan' GROUP BY c.tgl");
$fetch = mysqli_fetch_array($query); 
// die(var_dump($fetch));

$jumlah_biaya = $fetch['rencana'] * $fetch['hargasatuan'];
$botkontrak = $jumlah_biaya / $fetch['nilai_kontrak'] * 100;

$tgl_awal = $fetch['tgl'];
foreach ($query as $data) {
}
$tgl_akhir = $data['tgl'];

$periode = '';

if($tgl_awal != $tgl_akhir) {
    $periode .= "<li>PERIODE PELAKSANAAN&nbsp;&nbsp;&nbsp;:&nbsp; " . tgl_indo($tgl_awal) . " &nbsp;&nbsp; S/D &nbsp;&nbsp; " . tgl_indo($tgl_akhir) . "</li>";
} else {
    $periode .= "<li>PERIODE PELAKSANAAN&nbsp;&nbsp;&nbsp;:&nbsp; " . tgl_indo($tgl_awal) . " &nbsp;&nbsp; S/D &nbsp;&nbsp; -</li>";
}

$output = "
    <h3 style='text-align: center;'>BREAKDOWN JADWAL PEKERJAAN <br> KUANTITAS, PROGRES FISIK DAN KEUANGAN</h3>
";

$output .= "
    <ul style='list-style-type: none;'>
        <li>NAMA KEGIATAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; ".$fetch['kegiatan']. "</li>
        <li>PENYEDIA JASA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; ".$fetch['nama_penyedia']. "</li>
        <li>KONSULTAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; ".$fetch['konsultan']. "</li>
        ".$periode."
        <li>WAKTU PELAKSANAAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; " . $fetch['waktu_pelaksanaan'] . " Hari Kalender</li>
        <li>Nilai Kontrak (Non PPN)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; " . $fetch['nilai_kontrak'] . "</li>
        <li>No. Mata Pembayaran&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; ".$fetch['nmp']. "</li>
        <li>Jenis Pekerjaan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; <b>".$fetch['jenis_pekerjaan']. "</b></li>
        <li>Harga Satuan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; ".$fetch['hargasatuan']. "&nbsp; Rupiah</li>
        <li>Kuantitas Rencana&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; ".$fetch['rencana']." &nbsp; ".$fetch['satuan']. "</li>
        <li>Jumlah Biaya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; ".$jumlah_biaya. " &nbsp; Rupiah</li>
        <li>Bobot thd Kontrak (%)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; ".round($botkontrak, 2)." &nbsp; %</li>
    </ul>
";

$output .= "
    <table border='1' align='center' cellpadding='5' cellspacing='0' style='text-align:center; margin-top: 50px; margin-bottom: 150px;'>
        <thead>
            <tr>
                <th rowspan='3'>PERIODE</th>
                <th colspan='4'>KUANTITAS (VOLUME)</th>
                <th colspan='4'>PROGRESS (FISIK) PEKERJAAN</th>
                <th colspan='4'>PROGRESS KEUANGAN THD KONTRAK</th>
            </tr>
            <tr>
                <th colspan='2'>RENCANA</th>
                <th colspan='2'>REALISASI</th>

                <th colspan='2'>RENCANA</th>
                <th colspan='2'>REALISASI</th>

                <th colspan='2'>RENCANA</th>
                <th colspan='2'>REALISASI</th>
            </tr>
            <tr>
                <th>HARIAN</th>
                <th>KOMULLATIF</th>

                <th>HARIAN</th>
                <th>KOMULLATIF</th>

                <th>BOBOT HARIAN(%)</th>
                <th>KOMULATIF(%)</th>

                <th>BOBOT HARIAN(%)</th>
                <th>KOMULATIF(%)</th>

                <th>PROD. HARIAN(Rp)</th>
                <th>KOMULATIF(%)</th>

                <th>PROD. HARIAN(Rp)</th>
                <th>KOMULATIF(%)</th>
            </tr>
        </thead>
        <tbody>
";

    foreach ($query as $data) {
        //if = rencana * kuantitas rencana : bobot_thd_kontrak, 
        // rencana * bobot thd kontrak : kuantitas rencana
        //else if = jika ada mingguannya rencana : minggu * kuantitas rencana : bobot_thd_kontrak
        
        if($botkontrak != 0) {
            $rencana = $data['rencana'] * ($data['rencana'] / $botkontrak);
            $realisasi = $data['realisasi'] * ($data['realisasi'] / $botkontrak);
        } else {
            $rencana = 0;
            $realisasi = 0;
        }

        $tgl = explode("-", $data['tgl']);

        // Kuantitas Volume
        $komulatifrn = $data['rencana'];
        $komulatifrn += $data['rencana']; 
        
        $komulatifrl = $data['realisasi'];
        $komulatifrl += $data['realisasi'];

        //Progres Keuangan
        $prodharianren = $rencana * $data['hargasatuan'];
        $komprodren = $prodharianren + $data['hargasatuan'];
        $komprodren += $komprodren;

        $prodharianrel = $realisasi * $data['hargasatuan'];
        $komprodrel = $prodharianrel + $data['hargasatuan'];
        $komprodrel += $data['hargasatuan'];
        // die($prodharianrel);

        $hsql = "SELECT `a`.`Date` FROM (SELECT LAST_DAY('$tgl_akhir') - INTERVAL (`a`.`a` + (10 * `b`.`a`) + (100 * `c`.`a`)) DAY AS `Date` FROM (SELECT 0 AS `a` UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS `a` CROSS JOIN (SELECT 0 AS `a` UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS `b` CROSS JOIN (SELECT 0 AS `a` UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS `c`) AS `a` WHERE `a`.`Date` between '$tgl_awal' and LAST_DAY('$tgl_akhir') GROUP BY `a`.`Date` ORDER BY `a`.`Date` ASC";
        $sq = mysqli_query($konek, $hsql);
        // die($hsql);
        
        foreach ($sq as $isi) {
            $tgl_dinamis = $isi['Date'];
            // die(var_dump($tgl_dinamis));
            $tgln = explode("-", $tgl_dinamis);

            $output .= "
                <tr>
                    <td>".bulan_indo_explicit($tgln[1]) . " " . $tgln[2]/*bulan_indo_explicit($tgl[1])."-" .$tgl[2]*/."</td>
                    <!-- Kuantitas Volume -->
                    <td></td>
                    <td></td>

                    <td></td>
                    <td></td>
                   
                    <!-- Progres Fisik -->
                    <td>" . round($rencana, 2) . "</td>
                    <td>" . $komulatifrn . "</td>

                    <td>" . round($realisasi, 3) . "</td>
                    <td>" . $komulatifrl . "</td>

                    <!-- Progres keuangan -->
                    <td>" . $prodharianren . "</td>
                    <td>" . $komprodren . "</td>

                    <td>" . $prodharianrel . "</td>
                    <td>" . $komprodrel . "</td>
                </tr>
            ";
        }
    }

$output .= "
        </tbody>
    </table>";


// create pdf of report planning consultant	
$invoiceFileName = 'Laporan_paparan_perencanaan_id.pdf';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A3', 'landscape');
// $dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));