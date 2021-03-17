<?php
session_start();
include('../konfigurasi/koneksi.php');
include "../src/talikuat.php";
include "tgl_indo.php";

$tanggal_sekarang = date('d-m-Y');
$del = explode('-', $tanggal_sekarang);
$talikuat = new talikuat();
// $data_umum = $talikuat->getData_umum();
$prog_minggu = $talikuat->getMingguan();
// $data_umum = mysqli_query($konek, "SELECT *,DATE_ADD(tgl_spmk, INTERVAL waktu_pelaksanaan DAY) AS pho FROM data_umum INNER JOIN detail_jadual ON detail_jadual.id = data_umum.id");

######################################################################################################################################################################################################




    $output = "
        <h3 style='text-align: center;'>
            LAPORAN PROGRES BULANAN <br>
            PELAKSANAAN KEGIATAN PENINGKATAN/REHABILITASI JALAN DAN JEMBATAN <br>
            UPTD I S/D III DINAS BINA MARGA DAN PENATAAN RUANG PROVINSI JAWA BARAT <br>
            TAHUN ANGGARAN 
        </h3>
        <br><br><br>
    ";

    $output .= "<h3 style='text-align: center;'><b>PAKET PW-01 PADA UNIT PELAKSANA TEKNIS DINAS (UPTD) PENGELOLAAN JALAN DAN JEMBATAN WILAYAH PELAYANAN  - I <span style='text-align: right; margin-left: 545px;'>STATUS : ". $del[0] . " " . bulan_indo($del[1]). " " . $del[2] ."</span></b></h3>";

    ###########################################################################################################################################################################
    ######################################################### Tabel Master ####################################################################################################
    ###########################################################################################################################################################################
    $output .= "
        <table align='center' border='1' cellpadding='2' cellspacing='0' width='900px'>
            <thead style='background-color: yellow; text-align: center;'>
                <tr>
                    <th rowspan='4'>NO</th>
                    <th rowspan='4'>NAMA PAKET KEGIATAN</th>
                    <th rowspan='4' style='width: 150px;'>FIELD TEAM</th>
                    <th rowspan='4'>PANJANG PENANGANAN (KM/M)</th>
                    <th rowspan='1' colspan='2'>DATA KONTRAK</th>
                    <th rowspan='4'>WAKTU PELAKSANAAN</th>
                    <th rowspan='4'>KONSULTAN PENGAWAS</th>
                    <th colspan='6'>PROGRESS TERHADAP KONTRAK</th>
                </tr>
                <tr>
                    <th rowspan='3'>PENYEDIA JASA</th>
                    <th rowspan='3' width='80px'>SPMK & PHO</th>
                    <th colspan='4'>FISIK</th>
                    <th rowspan='2' colspan='2'>KEUANGAN</th>
                </tr>
                <tr>
                    <th rowspan='2'>Minggu Ke-</th>
                    <th>RENCANA</th>
                    <th>REALISASI</th>
                    <th>DEVIASI</th>
                </tr>
                <tr>
                    <th>(%)</th>
                    <th>(%)</th>
                    <th>(%)</th>
                    <th style='width: 150px;'>Rp.</th>
                    <th style='width: 150px;'>(%)</th>
                </tr>
            </thead>
            <tbody style='text-align: center;'>
    ";

        $no = 1;
        foreach ($prog_minggu as $data) {
            // die(var_dump($data));
            $ts = $data['spmk']; //Tanggal spmk
            $waktu = $data['waktu_pelaksanaan']; //Hari lama pelaksanaan 
            
            $x = $data['pho'];
            $ph = explode("-", $x);
            
            if($ts == 0 AND $x == 0) {
                $spmk = '-';
                $pho = '-';
            } else {
                $ex = explode('-', $ts);
                $spmk = $ex[2] . " " .bulan_indo($ex[1]). " " . $ex[0];
                $pho = $ph[2] . " " . bulan_indo($ph[1]) . " " . $ph[0];
            }

            $tanggal_awal = $data['spmk'];
            $tanggal_akhir = $data['pho'];

            //<td>".$spmk." <br><br>".$pho. "</td>
            $output .= "
                <tr>
                    <td>".$no++."</td>
                    <td>".$data['namakegiatan']. "</td>
                    <td>" . $data['field_team'] . "</td>
                    <td>".$data['panjang_km']." KM</td>
                    <td>".$data['penyedia_jasa']. "</td>
                    
                    <td>" . $spmk . " <br>-<br>" . $pho . "</td>
                    <td>".$waktu."</td>
                    <td>".$data['konsultan']. "</td>
                    <td>" . jml_minggu($tanggal_awal, $tanggal_akhir) . "</td>
                    
                    <td>".$data['rencana']."</td>
                    <td>".$data['realisasi']."</td>
                    <td>".$data['deviasi']. "</td>

                    <td>" . $data['keuangan_rp'] . "</td>
                    <td>" . $data['keuangan_per'] . "</td>
                </tr>
            ";
        }

    $output .= "
            </tbody>
        </table>
    ";



// create pdf of report planning consultant	
$invoiceFileName = 'Laporan_progress_bulanan.pdf';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A3', 'landscape');
// $dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
