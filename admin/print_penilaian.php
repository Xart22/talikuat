<?php
session_start();
include('../konfigurasi/koneksi.php');
include "tgl_indo.php";
if (!isset($_GET['id'])) {
    echo '<script language="javascript">alert("Anda Salah Format ID Kosong!!!"); document.location="perencanaan_konsultan.php";</script>';
}

$id = $_GET['id'];
$sql = "SELECT * FROM penilaian WHERE id = '$id'";
$query = "SELECT a1_bobot, b1_bobot, c1_bobot, d1_bobot FROM penilaian WHERE id = '$id'";
$exc = mysqli_query($konek, $sql);
$exc2 = mysqli_query($konek, $sql);
$exc3 = mysqli_query($konek, $sql);
$exc4 = mysqli_query($konek, $sql);
$exc5 = mysqli_query($konek, $sql);
$exc6 = mysqli_query($konek, $sql);
$exc7 = mysqli_query($konek, $sql);
$nbobot = mysqli_query($konek, $query);
while($rs = mysqli_fetch_array($nbobot)) {
    $ab = $rs['a1_bobot'];
    $bb = $rs['b1_bobot'];
    $cb = $rs['c1_bobot'];
    $db = $rs['d1_bobot'];
}

$output = "<h2 style='text-align: center;'>LEMBAR PENILAIAN KINERJA PENYEDIA PELAKSANA KONSTRUKSI</h2> <br><br>";

// $output .= "<table align='center' border='1' cellspacing='0' cellpadding='1' width='655px'>
//                 <tr>
//                     <td style='width: 450px;'>PELAKSANA KONSTRUKSI</td>
//                     <td>Tahun</td>
//                     <td>".date('Y')."</td>        
//                 </tr>
//             </table>";

// $output .= "
//     <ol>
//         <li>Unit Kerja &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </li>
//         <li>Nama Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </li>
//         <li>Alamat Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </li>
//         <li>Paket Pekerjaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </li>
//         <li>Lokasi Pekerjaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </li>
//         <li>Nilai Kontrak &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </li>
//         <li>Nomor Kontrak &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </li>
//         <li>Tanggal Kontrak &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </li>
//         <li>Tanggal SPMK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </li>
//         <li>Jangka Waktu Pelaksanaan : </li>
//         <li>Tanggal PHO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </li>
//     </ol>
// ";

$output .= "
    <table align='center' border='1' cellspacing='0' cellpadding='1' width='900px' style='text-align: center;'> 
        <thead>
            <tr>
                <td rowspan='2'>ASPEK KINERJA</td>
                <td rowspan='2'>Bobot(%)</td>
                <td rowspan='2'>Kode</td>
                <td rowspan='2'>INDIKATOR KERJA</td>
                <td colspan='1'>Penilaian</td>
                <td rowspan='2'>NILAI</td>
                <td rowspan='2'>KETERANGAN</td>
            </tr>
            <tr>
                <td>Ya / Tidak</td>
            </tr>
        </thead>
        <tbody>
        ";

        $output .= "
            <tr>
                <td colspan='2' style='background-color: green;'>A. Persiapan</td>
                <td style='background-color: green;'>".$ab."</td>
                <td colspan='4' style='background-color: green;'></td>
            </tr>
        ";

        while ($isi = mysqli_fetch_array($exc)) {
            $arr = '';
            $indikator = ['Pengajuan Jadwal Pelaksanaan Pekerjaan sesuai dengan jadwal', 'Pengajuan laporan Kajian Teknis sesuai dengan jadwal', 'Pengajuan Program Mutu sesuai dengan jadwal', 'Pelaksanaan Mobilisasi sesuai dengan jadwal'];

            // $output .= "<tr><td>".$a."</td></tr>";
            $x = 0;
            foreach ($indikator as $i) {
                $arr = $i;
                $x++;
                $a = $isi['a' . $x] != 0 ? 'Ya' : 'Tidak';
                $nilai = $isi['a' . $x];
                $jumlaha = floatval($isi['a1'] + $isi['a2'] + $isi['a3'] + $isi['a4']);
                
                $output .= "
                    <tr>
                        <td></td>
                        <td></td>
                        <td>l</td>
                        <td>".$arr."</td>
                        <td>".$a."</td>
                        <td>".$nilai."</td>
                        <td></td>
                    </tr>
                ";
            }
        }

        $output .= "
            <tr>
                <td colspan='5' style='background-color:yellow;'>Jumlah - A </td>
                <td style='background-color:yellow;'>".$jumlaha. "</td>
                <td style='background-color:yellow;'></td>
            </tr>
        ";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $output .= "
            <tr>
                <td colspan='2' style='background-color: green;'>B. Pelaksanaan Pekerjaan</td>
                <td style='background-color: green;'>" . $bb . "</td>
                <td colspan='4' style='background-color: green;'></td>
            </tr>
        ";

        while ($data = mysqli_fetch_array($exc2)) {
            $arr2 = '';
            $indikator2 = [
                'Pengajuan Shop Drawing sesuai dengan jadwal',
                'Pengajuan uji bahan sesuai dengan jadwal',
                'Pengajuan Request sesuai dengan jadwal',
                'Jumlah dan kualifikasi pekerja sesuai dengan Request',
                'Jumlah, Jenis, dan kapasitas alat sesuai dengan Request',
                'Kualitas dan kuantitas pasokan bahan sesuai dengan Request',
                'Volume hasil pekerjaan sesuai dengan target',
                'Tidak terjadi masalah pada peralatan',
                'Tidak terjadi masalah dalam penyediaan bahan',
                'Tidak terjadi perbaikan pekerjaan akibat kegagalan hasil pekerjaan atau uji hasil pekerjaan tidak memenuhi syarat',
                'Kelengkapan K3 untuk pekerja Terpenuhi',
                'Pengendalian Lalu Lintas terpenuhi',
                'Tidak terjadi kecelakaan kerja',
                'Tidak menerima surat teguran berkaitan dengan pelaksanaan pekerjaan',
                'Sosialisasi/Pemberitahuan ke lingkungan sekitar pekerjaan dilakukan',
                'Tidak ada Komplain/Permasalahan dengan Lingkungan sekitar',
                'Progres Item Pekerjaan tidak mengalami keterlambatan'
            ];

            $z = 0;
            foreach ($indikator2 as $y) {
                $arr2 = $y;
                $z++;
                $b = $data['b' . $z] != 0 ? 'Ya' : 'Tidak';
                $nilai2 = $data['b' . $z];
                $jumlahb = floatval($data['b1'] + $data['b2'] + $data['b3'] + $data['b4'] + $data['b5']+ $data['b6']+ $data['b7']+ $data['b8'] + $data['b9'] + $data['b10'] + $data['b11'] + $data['b12'] + $data['b13'] + $data['b14'] + $data['b15'] + $data['b16'] + $data['b17']);

                $output .= "
                            <tr>
                                <td></td>
                                <td></td>
                                <td>l</td>
                                <td>" . $arr2 . "</td>
                                <td>" . $b . "</td>
                                <td>" . $nilai2 . "</td>
                                <td></td>
                            </tr>
                        ";
            }
        }

        $output .= "
            <tr>
                <td colspan='5' style='background-color:yellow;'>Jumlah - B </td>
                <td style='background-color:yellow;'>" . $jumlahb . "</td>
                <td style='background-color:yellow;'></td>
            </tr>
        ";

        $output .= "
            <tr>
                <td colspan='2' style='background-color: green;'>C. Progress dan Laporan</td>
                <td style='background-color: green;'>" . $cb . "</td>
                <td colspan='4' style='background-color: green;'></td>
            </tr>
        ";

        while($dt = mysqli_fetch_array($exc3)) {
            $arr3 = '';
            $indikator3 = [
                'Progres Pekerjaan Tidak mengalami keterlambatan',
                'Tidak dalam kontrak kritis',
                'Pengajuan Laporan Harian sesuai dengan jadwal',
                'Pengajuan Back Up Kualitas sesuai dengan jadwal',
                'Pengajuan Back Up Kuantitas sesuai dengan jadwal',
                'Pengajuan MC sesuai dengan jadwal'
            ];

            $s = 0;
            foreach ($indikator3 as $y) {
                $arr3 = $y;
                $s++;
                $c = $dt['c' . $s] != 0 ? 'Ya' : 'Tidak';
                $nilai3 = $dt['c' . $s];
                $jumlahc = floatval($dt['c1'] + $dt['c2'] + $dt['c3'] + $dt['c4'] + $dt['c5'] + $dt['c6']);

                $output .= "
                        <tr>
                            <td></td>
                            <td></td>
                            <td>l</td>
                            <td>" . $arr3 . "</td>
                            <td>" . $c . "</td>
                            <td>" . $nilai3 . "</td>
                            <td></td>
                        </tr>
                    ";
            }
        }

        $output .= "
            <tr>
                <td colspan='5' style='background-color:yellow;'>Jumlah - C </td>
                <td style='background-color:yellow;'>" . $jumlahc . "</td>
                <td style='background-color:yellow;'></td>
            </tr>
        ";

        $output .= "
            <tr>
                <td colspan='2' style='background-color: green;'>D. Penyelesaian Masa Pelaksanaan</td>
                <td style='background-color: green;'>" . $db . "</td>
                <td colspan='4' style='background-color: green;'></td>
            </tr>
        ";

        while ($td = mysqli_fetch_array($exc4)) {
            $arr4 = '';
            $indikator4 = [
                'Tidak melewati masa pelaksanaan',
                'Tidak terjadi perubahan signifikan antara kuantitas hasil Kajian Teknis dengan kuantitas akhir',
                'Pengajuan As Built Drawing sesuai dengan jadwal',
                'Pengajuan Pernyataan Akhir pekerjaan (lengkap dengan back up) sesuai dengan jadwal',
                'Pengajuan Jaminan Pemeliharaan Sesuai jadwal',
                'Pengajuan Jadwal Pemeliharaan sesuai jadwal'				
            ];

            $q = 0;
            foreach ($indikator4 as $y) {
                $arr4 = $y;
                $q++;
                $d = $td['d' . $q] != 0 ? 'Ya' : 'Tidak';
                $nilai4 = $td['d' . $q];
                $jumlahd = floatval($td['d1'] + $td['d2'] + $td['d3'] + $td['d4']);

                $output .= "
                        <tr>
                            <td></td>
                            <td></td>
                            <td>0</td>
                            <td>" . $arr4 . "</td>
                            <td>" . $d . "</td>
                            <td>" . $nilai4 . "</td>
                            <td></td>
                        </tr>
                ";
            }
        }

        while($xn = mysqli_fetch_array($exc6)) {
            #Nilai Total
            $at = $xn['a1_total'];
            $bt = $xn['b1_total'];
            $ct = $xn['c1_total'];
            $dt = $xn['d1_total'];
            $jtotal = $at + $bt + $ct + $dt;
            $total = floatval($xn['a1'] + $xn['a2'] + $xn['a3'] + $xn['a4']) + floatval($xn['b1'] + $xn['b2'] + $xn['b3'] + $xn['b4'] + $xn['b5'] + $xn['b6'] + $xn['b7'] + $xn['b8'] + $xn['b9'] + $xn['b10'] + $xn['b11'] + $xn['b12'] + $xn['b13'] + $xn['b14'] + $xn['b15'] + $xn['b16'] + $xn['b17']) + floatval($xn['c1'] + $xn['c2'] + $xn['c3'] + $xn['c4'] + $xn['c5'] + $xn['c6']) + floatval($xn['d1'] + $xn['d2'] + $xn['d3'] + $xn['d4']);
        }

        $output .= "
            <tr>
                <td colspan='5' style='background-color:yellow;'>Jumlah - D </td>
                <td style='background-color:yellow;'>" . $jumlahd . "</td>
                <td style='background-color:yellow;'></td>
            </tr>
            <tr>
                <td style='background-color:yellow;'></td>
                <td style='background-color:yellow;'></td>
                <td style='background-color:yellow;'>26</td>
                <td style='background-color:yellow;'>JUMLAH TOTAL</td>
                <td style='background-color:yellow;'></td>
                <td style='background-color:yellow;'>".$total. "</td>
                <td style='background-color:yellow;'></td>
            </tr>
        ";

$output .= "
        </tbody>
    </table>
    <br><br><br><br><br>";

#####################################                       #####################################
#####################################   Tabel Keterangan    #####################################
#####################################                       #####################################

    $output .= "
        <table border='1' cellspacing='0' cellpadding='3' style='text-align: center;' align='left'>
            <tr>
                <th colspan='2'>KRITERIA PENILAIAN</th>
            </tr>
            <tr>
                <th>Sangat Kurang</th>
                <th> 50</th>
            </tr>
            <tr>
                <th>Kurang</th>
                <th>51 - 60</th>
            </tr>
            <tr>
                <th>Cukup</th>
                <th>61 - 70</th>
            </tr>
            <tr>
                <th>Baik</th>
                <th>71 -80</th>
            </tr>
            <tr>
                <th>Sangat Baik</th>
                <th>81 - 100</th>
            </tr>
        </table>
    ";

    ########################################################### Tabel Nilai kinerja ###########################################################
    while ($nx = mysqli_fetch_array($exc7)) {
        #Nilai Total
        $at = $nx['a1_total'];
        $bt = $nx['b1_total'];
        $ct = $nx['c1_total'];
        $dt = $nx['d1_total'];
        $total = floatval($nx['a1'] + $nx['a2'] + $nx['a3'] + $nx['a4']) + floatval($nx['b1'] + $nx['b2'] + $nx['b3'] + $nx['b4'] + $nx['b5'] + $nx['b6'] + $nx['b7'] + $nx['b8'] + $nx['b9'] + $nx['b10'] + $nx['b11'] + $nx['b12'] + $nx['b13'] + $nx['b14'] + $nx['b15'] + $nx['b16'] + $nx['b17']) + floatval($nx['c1'] + $nx['c2'] + $nx['c3'] + $nx['c4'] + $nx['c5'] + $nx['c6']) + floatval($nx['d1'] + $nx['d2'] + $nx['d3'] + $nx['d4']);
        //Penilaian
        $nilai = '';

        if ($total <= 100 and $total >= 81) {
            $nilai = 'Sangat Baik';
        } else if ($total <= 80 and $total >= 71) {
            $nilai = 'Baik';
        } else if ($total <= 70 and $total >= 61) {
            $nilai = 'Cukup';
        } else if ($total <= 60 and $total >= 51) {
            $nilai = 'Kurang';
        } else if ($total <= 50) {
            $nilai = 'Sangat Kurang';
        }
        // die($nilai);
    }

    $output .= "
            <table border='1' cellspacing='0' cellpadding='3' style='text-align: center;' width='250px' align='right'>
                <thead>
                    <tr>
                        <th>NILAI</th>
                    </tr>
                    <tr>
                        <th>" . $total . "</th>
                    </tr>
                    <tr>
                        <th>" . $nilai . "</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        ";


    $output .= "
            <table border='1' cellspacing='0' cellpadding='3' style='text-align: center;' align='center'>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>ASPEK KINERJA</th>
                        <th>BOBOT</th>
                        <th>NILAI AKHIR</th>
                    </tr>
                </thead>
                <tbody>
    ";

        // $arrayAspek = [
        //     'A' => 'Persiapan',
        //     'B' => 'Pelaksanaan Pekerjaan',
        //     'C' => 'Progress dan pelaporan',
        //     'D' => 'Penyelesaian Masa Pelaksanaan'
        // ];

        while ($n = mysqli_fetch_array($exc5)) {
            // foreach ($arrayAspek as $key => $value) {
                $row = '';
                #Nilai Bobot
                $a = $n['a1_bobot'];
                $b = $n['b1_bobot'];
                $c = $n['c1_bobot'];
                $d = $n['d1_bobot'];
                $jbobot = $a + $b + $c + $d;

                #Nilai Total
                $at = $n['a1_total'];
                $bt = $n['b1_total'];
                $ct = $n['c1_total'];
                $dt = $n['d1_total'];
                $jtotal = $at + $bt + $ct + $dt;
                $total = floatval($n['a1'] + $n['a2'] + $n['a3'] + $n['a4']) + floatval($n['b1'] + $n['b2'] + $n['b3'] + $n['b4'] + $n['b5'] + $n['b6'] + $n['b7'] + $n['b8'] + $n['b9'] + $n['b10'] + $n['b11'] + $n['b12'] + $n['b13'] + $n['b14'] + $n['b15'] + $n['b16'] + $n['b17']) + floatval($n['c1'] + $n['c2'] + $n['c3'] + $n['c4'] + $n['c5'] + $n['c6']) + floatval($n['d1'] + $n['d2'] + $n['d3'] + $n['d4']);

                if(isset($a) && isset($at)) {
                    $row .= "                    
                        <tr>
                            <td>A</td>
                            <td>Persiapan</td>
                            <td>" . $a . "</td> <td>" . $at . "</td>   
                        </tr>
                    ";
                }

                if (isset($b) && isset($bt)) {
                    $row .= "                    
                        <tr>
                            <td>B</td>
                            <td>Pelaksanaan Pekerjaan</td>
                            <td>" . $b . "</td> <td>" . $bt . "</td>   
                        </tr>
                    ";
                }

                if (isset($c) && isset($ct)) {
                    $row .= "                    
                        <tr>
                            <td>C</td>
                            <td>Progress dan pelaporan</td>
                            <td>" . $c . "</td> <td>" . $ct . "</td>   
                        </tr>
                    ";
                }

                if (isset($d) && isset($dt)) {
                    $row .= "                    
                        <tr>
                            <td>D</td>
                            <td>Penyelesaian Masa Pelaksanaan</td>
                            <td>" . $d . "</td> <td>" . $dt . "</td>   
                        </tr>
                    ";
                }

                $output .= $row;        
            // }
        }

        #Hasil Aspek Kinerja
        $output .= "
            <tr>
                <td></td>
                <td></td>
                <td>".$jbobot."</td>
                <td>".$total."</td>
            </tr>
        ";

    $output .= "
                </tbody>
            </table>
            <br><br><br><br><br><br>
    ";

#####################################   Stempel Keterangan    #####################################
$output .= "
        <p style='text-align:center;'>
           Mengetahui: <br>
           KEPALA UPTD PELAKSANAAN JALAN DAN JEMBATAN <br>
           WILAYAH PELAYANAN ….
        </p>
";


$output .= "
        <br><br><br><br><br><br><br>
        <p style='text-align:center;'>NIP ..........................................</p>
        <br><br><br><br><br><br><br>
";

$output .= "

";

$output .= "
    <p style='text-align:center;'>
    DINILAI OLEH: <br>
    PEJABAT PEMBUAT KOMITMEN (PPK) <br>
    PENINGKATAN/REHABILITASI JALAN DAN JEMBATAN <br>
";


$output .= "<br><br><br><br><br><br><br>
        <p style='text-align:center;'>NIP ..........................................</p>
";

// create pdf of report planning consultant	
$invoiceFileName = 'Laporan_penilaian.pdf';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
// $dompdf->setPaper('A3', 'landscape');
$dompdf->setPaper('A3', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
