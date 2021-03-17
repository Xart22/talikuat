<?php
session_start();
require '../../konfigurasi/koneksi.php';
require "../../php-spreadsheet/vendor/autoload.php";
include "../../src/talikuat.php";
include "../../src/LogHistory.php";

$talikuat = new talikuat();
$log = new LogHistory();

if (!empty($_POST['minggu_ke'])) {
    $fieldid = $_POST['nama_paket']; //textfield
    $namapaket = $_POST['nmk'];
    $fieldteam = $_POST['team']; //textarea
    $pjg = $_POST['pjgkm'];
    $pjasa = $_POST['pj'];
    $fielddate = $_POST['spo'];
    $spmkpho = explode(" ", $fielddate);
    $waktu = $_POST['wp'];
    $konsul = $_POST['kons'];

    $jfield = count($_POST['minggu_ke']);

    //logging history
    $process = "Insert data minggu_ke";
    $log_write = $log->recordProcLog($process);

    for ($i = 0; $i < $jfield; $i++) {
        $mingguke = $_POST['minggu_ke'][$i];
        $rencana = $_POST['rencana'][$i];
        $realisasi = $_POST['realisasi'][$i];
        $deviasi = $_POST['deviasi'][$i];
        $krp = $_POST['krp'][$i];
        $kpersen = $_POST['kpersen'][$i];
        // VALUES($namapaket, $fieldteam, $mingguke, $rencana, $realisasi, $deviasi, $krp, $kpersen)
        $sql = "INSERT INTO progress_mingguan (id_data_umum, namakegiatan, field_team, panjang_km, penyedia_jasa, spmk, pho, waktu_pelaksanaan, konsultan, minggu_ke, rencana, realisasi, deviasi, keuangan_rp, keuangan_per) 
                VALUES($fieldid, '$namapaket', '$fieldteam', '$pjg', '$pjasa', '$spmkpho[0]', '$spmkpho[1]', '$waktu', '$konsul', $mingguke, $rencana, $realisasi, $deviasi, $krp, $kpersen)";
        // die($sql);
        $row = mysqli_query($konek, $sql);
        
        if ($row) {
            echo '<script>window.location="../../admin/data_progress_mingguan.php"</script>';
        } else {
            echo mysqli_error($konek);
        }
    }
}

//input data umum baru
if (!empty($_GET['data_umum'])) {
    $pemda = $_POST['pemda'];
    $opd = $_POST['opd'];
    $unor = $_POST['unor'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $ruas_jalan = $_POST['ruas_jalan'];
    $segmen_jalan = $_POST['segmen_jalan'];
    $no_kontrak = $_POST['no_kontrak'];
    $tgl_kontrak = $_POST['tgl_kontrak'];
    $nilai_kontrak = $_POST['nilai_kontrak'];
    $no_spmk = $_POST['no_spmk'];
    $tgl_spmk = $_POST['tgl_spmk'];
    $panjang = $_POST['panjang'];
    $waktu_pelaksanaan = $_POST['waktu_pelaksanaan'];
    $ppk = $_POST['ppk'];
    $penyedia_jasa = $_POST['penyedia_jasa'];
    $konsultan = $_POST['konsultan'];
    $nama_ppk = $_POST['nama_ppk'];
    $nama_se = $_POST['nama_se'];
    $nama_gs = $_POST['nama_gs'];
    $lat = $_POST['lat_awal'];
    $lng = $_POST['long_awal'];
    $latak = $_POST['lat_akhir'];
    $longak = $_POST['long_akhir'];
    $tgl = date("j F Y, G:i");

    $rab = $_FILES['rab']['name'];
    $tmp_rab = $_FILES['rab']['tmp_name'];

    $pk = $_FILES['pk']['name'];
    $tmp_pk = $_FILES['pk']['tmp_name'];

    $sm = $_FILES['sm']['name'];
    $tmp_sm = $_FILES['sm']['tmp_name'];

    $sk = $_FILES['sk']['name'];
    $tmp_sk = $_FILES['sk']['tmp_name'];

    $ul_spmk = $_FILES['ul_spmk']['name'];
    $tmp_ul_spmk = $_FILES['ul_spmk']['tmp_name'];

    $ul_jadual = $_FILES['ul_jadual']['name'];
    $tmp_ul_jadual = $_FILES['ul_jadual']['tmp_name'];

    $ul_rencana = $_FILES['ul_rencana']['name'];
    $tmp_ul_rencana = $_FILES['ul_rencana']['tmp_name'];

    // Rename nama fotonya dengan menambahkan tanggal dan jam upload
    $rabbaru = date('dmYHis') . $rab;
    $pkbaru = date('dmYHis') . $pk;
    $smbaru = date('dmYHis') . $sm;
    $skbaru = date('dmYHis') . $sk;
    $ul_spmkbaru = date('dmYHis') . $ul_spmk;
    $ul_jadualbaru = date('dmYHis') . $ul_jadual;
    $ul_rencanabaru = date('dmYHis') . $ul_rencana;

    // Set path folder tempat menyimpan fotonya
    $path_rab = "../../assets/img/laporan/" . $rabbaru;
    $path_pk = "../../assets/img/laporan/" . $pkbaru;
    $path_sm = "../../assets/img/laporan/" . $smbaru;
    $path_sk = "../../assets/img/laporan/" . $skbaru;
    $path_ul_spmk = "../../assets/img/laporan/" . $ul_spmkbaru;
    $path_ul_rencana = "../../assets/img/laporan/" . $ul_rencanabaru;
    $path_ul_jadual = "../../assets/img/laporan/" . $ul_jadualbaru;

    // Proses upload
    if (move_uploaded_file($tmp_rab, $path_rab)) { // Cek apakah gambar berhasil diupload atau tidak

        // $tgl= date("j F Y, G:i");
        // $pemda;
        // $opd;
        // $unor;
        // $nama_kegiatan;
        // $ruas_jalan;
        // $segmen_jalan;
        // $no_kontrak;
        // $tgl_kontrak;
        // $nilai_kontrak;
        // $no_spmk;
        // $tgl_spmk;
        // $panjang;
        // $waktu_pelaksanaan;
        // $ppk;
        // $penyedia_jasa;
        // $konsultan;
        // $nama_ppk;
        // $nama_se;
        // $nama_gs;
        // $lat;
        // $lng;
        // $latak;
        // $longak;
        // $rabbaru;
        // $pkbaru;
        // $skbaru;
        // $smbaru;
        // $ul_spmkbaru;
        // $ul_jadualbaru;
        // $ul_rencanabaru;
        // $tgl;

        $sql = "INSERT INTO data_umum (pemda,opd,unor,nama_kegiatan,nama_ruas_jalan,segmen_jalan,no_kontrak,tgl_kontrak,nilai_kontrak,no_spmk,tgl_spmk,panjang,waktu_pelaksanaan,ppk,penyedia_jasa,konsultan_supervisi,nama_ppk,nama_se,nama_gs,lat,lng,lat_akhir,long_akhir,rab,pk,sk,sm,ul_spmk,ul_jadual,ul_rencana,tgl_input) 
        VALUES('$pemda','$opd','$unor','$nama_kegiatan','$ruas_jalan','$segmen_jalan','$no_kontrak','$tgl_kontrak','$nilai_kontrak','$no_spmk','$tgl_spmk','$panjang','$waktu_pelaksanaan','$ppk','$penyedia_jasa','$konsultan','$nama_ppk','$nama_se','$nama_gs','$lat','$lng','$latak','$longak','$rabbaru','$pkbaru','$skbaru','$smbaru','$ul_jadualbaru','$ul_rencanabaru','$tgl')";

        move_uploaded_file($tmp_pk, $path_pk);
        move_uploaded_file($tmp_sm, $path_sm);
        move_uploaded_file($tmp_sk, $path_sk);
        move_uploaded_file($tmp_ul_spmk, $path_ul_spmk);
        move_uploaded_file($tmp_ul_jadual, $path_ul_jadual);
        move_uploaded_file($tmp_ul_rencana, $path_ul_rencana);

        $insert = mysqli_query($konek, $sql);

        if (!$insert) {
            die(mysqli_error($konek));
            die(var_dump($sql) . "<br/>Error query insert data");
        }

        // $process = "Insert data umum";
        // $log_write = $log->recordProcLog($process);

        echo '<script>window.location="../../admin/data_umum.php?page=data_umum&success=tambah-data"</script>';
    } else {
        // Jika gambar gagal diupload, Lakukan :
        echo "Maaf, Gambar gagal untuk diupload.";
        // header('location:../../media.php?modul='.$modul);
    }
}

//menu data umum untuk input jadual
if (!empty($_GET['jadum'])) {
    //Validasi Form Selectbox
    $id = $_GET['data_umum'];
    $jadual = $_POST['jadual'];

    if ($jadual == 0) {
        if (!empty($_GET['data_umum']) && $_GET['data_umum']) {
            $data = $talikuat->get_data_umum($_GET['data_umum']);
            $data_detail = $talikuat->get_data_umum_detail($_GET['data_umum']);
        }
        header("Location:../../admin/buat_jadual.php?data_umum=" . $id . "&msg=kosong");
    } else {
        //do something with code...;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();

        $spreadsheet = $reader->load($_FILES['fileexcel']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        //logging history
        $process = "Insert data buat jadual umum";
        $log_write = $log->recordProcLog($process);

        for($i = 1; $i < count($sheetData); $i++) {
            $tanggal = $sheetData[$i]['0'];
            $x = explode('/', $tanggal);
            $tgl = $x[2]. "-" . $x[1] . "-" . $x[0];
            $nmp = $sheetData[$i]['1'];
            $uraian = $sheetData[$i]['2'];
            $hsatuan = $sheetData[$i]['3'];
            $volume = $sheetData[$i]['4'];
            $satuan = $sheetData[$i]['5'];
            $jumharga = $sheetData[$i]['6'];
            
            //rencana volume
            // $renvol_harian = $sheetData[$i]['5'];
            // $renvol_komulatif = $sheetData[$i]['6'];
            //progress fisik
            // $progfisik_renbobot = $sheetData[$i]['7'];
            // $progfisik_renkomulatif = $sheetData[$i]['8'];
            //rencana keuangan
            // $renkeuangan_harian = $sheetData[$i]['9'];
            // $renkeuangan_komulatif = $sheetData[$i]['10'];

            $bobot = $sheetData[$i]['7'];
            $koefisien = $sheetData[$i]['8'];
            $nilai = $sheetData[$i]['9'];

            // $sql = "INSERT INTO detail_jadual(id_jadual, tgl, nmp, uraian, satuan, harga_satuan, volume, jumlah_harga, bobot, koefisien, nilai) 
            //         VALUES ($jadual, '$tgl','$nmp','$uraian','$satuan',$hsatuan,$volume,$jumharga,$bobot,$koefisien,$nilai)";
            
            $sql = "INSERT INTO detail_jadual(id_jadual, tgl, nmp, uraian, satuan, harga_satuan, volume, jumlah_harga, bobot, koefisien, nilai) 
                    VALUES ($jadual,'$tgl','$nmp','$uraian','$satuan',$hsatuan,$volume,$jumharga,$bobot,$koefisien,$nilai)";
            
            // echo($sql);
            $execute = mysqli_query($konek, $sql);
    
            if($execute) {
                header("Location:../../admin/data_umum.php");
            } else {
                echo "Kesalahan Sistem dalam memproses data... <br>";
                // echo mysqli_error($konek);
            }
        }
    }
}


# ==================================================================================================================Disposisi====================================================================================================================================================================================================================================
# ==========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================
if (!empty($_GET['disinstruksi'])) {
    $instruksi = $_POST['instruksi'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO master_disposisi_instruksi(jenis_instruksi, keterangan) VALUES(
        '$instruksi',
        '$keterangan'
    )";

    $execute = mysqli_query($konek, $sql);

    if ($execute) {
        //logging history
        $process = "Insert data disposisi instruksi";
        $log_write = $log->recordProcLog($process);
        header("Location:../../admin/disposisi/disposisi_instruksi.php");
    } else {
        echo "Kesalahan Sistem dalam memproses data... <br>";
        echo mysqli_error($konek);
    }
}

if(!empty($_GET['diskirim'])) {
    $id = $_SESSION['id_logged'];
    $dari = $_POST['dari'];
    $perihal = $_POST['perihal'];
    $tglsurat = $_POST['tglsurat'];
    $awal = substr($tglsurat, 0,2);
    $pecah = explode('-', $tglsurat);
    $disposisi_code = $awal . $pecah[1] . $pecah[2];
    $nosurat = $_POST['nosurat'];
    $kepada = $_POST['kepada']; 
    $j_instruksi = $_POST['instruksi']; 
    $tgldeadline = $_POST['penyelesaian'];
    $lampiran = $_FILES['lampiran']['name'];
    $tmp_lampiran = $_FILES['lampiran']['tmp_name'];
    $created_at = date('Y-m-d H:i:s');

    //Pada fungsi ini terdapat kirim email ke disposisi kepada

    $path_lampiran = "../../lampiran/disposisi/".$lampiran;

    //Insert tabel disposisi
    if(move_uploaded_file($tmp_lampiran, $path_lampiran)) { 
        //File exists
        //Compare kepada
        $ke = "";
        foreach ($kepada as $kpd) {
            $ke .= "'$kpd'".",";
        }

        // $arr = array_merge($arr, $kepada); 
        $kpd = substr($ke, 0, -1); 

        $sql1 = "INSERT INTO disposisi(disposisi_code, dari, perihal, tgl_surat, no_surat, tanggal_penyelesaian, status, file, created_date, created_by, updated_date, updated_by) VALUES(
            '$disposisi_code',
            '$dari',
            '$perihal',
            '$tglsurat',
            '$nosurat',
            '$tgldeadline',
            '1',
            '$created_at',
            '$id',
            '0000-00-00',
            ''
        )";

        move_uploaded_file($tmp_lampiran, $path_lampiran);
        $execute = mysqli_query($konek, $sql1);

        //Kirim Email
        
        if ($execute) {
            //Insert tabel disposisi_penanggung_jawab
            saveDisposisiKepada($disposisi_code, $arr, $kpd);
            //Insert tabel jenis_instruksi
            foreach ($j_instruksi as $value) {
                $sql2 = "INSERT INTO disposisi_jenis_instruksi(disposisi_code, disposisi_instruksi_id) VALUES (
                '$disposisi_code',
                '$value'
            )";

                $execute2 = mysqli_query($konek, $sql2);
            }
            header("Location: ../../admin/disposisi/kirim_disposisi.php");
        } else {
            echo mysqli_error($konek);
        }
    } 
    else {
        //File not exists
        //Compare kepada
        $ke = ""; $arr = [];
        foreach ($kepada as $kpd) {
            $ke .= $kpd . ",";
        }

        $arr = array_merge($arr, $kepada);
        $kpd = substr($ke, 0, -1);
        
        $sql1 = "INSERT INTO disposisi(disposisi_code, dari, perihal, tgl_surat, no_surat, tanggal_penyelesaian, status, file, created_date, created_by, updated_date, updated_by) VALUES(
            '$disposisi_code',
            '$dari',
            '$perihal',
            '$tglsurat',
            '$nosurat',
            '$tgldeadline',
            '1',
            '',
            '$created_at',
            '$id',
            '0000-00-00',
            ''
        )";


        $execute = mysqli_query($konek, $sql1);

        if ($execute) {
            //Insert tabel disposisi_penanggung_jawab
            saveDisposisiKepada($disposisi_code, $arr, $kpd);
            //Insert tabel jenis_instruksi
            foreach ($j_instruksi as $value) {
                $sql2 = "INSERT INTO disposisi_jenis_instruksi(disposisi_code, disposisi_instruksi_id) VALUES (
                '$disposisi_code',
                '$value'
            )";

                $execute2 = mysqli_query($konek, $sql2);
            }
            header("Location: ../../admin/disposisi/kirim_disposisi.php");
        } else {
            echo mysqli_error($konek);
        }
    }
}

# Untuk disposisi masuk dan tindak lanjut
if (!empty($_GET['accept'])) {
    $id = $_GET['id'];
    $status = "3";

    $string = "UPDATE disposisi SET status = ".$status." WHERE id = " . $id;
    $update = mysqli_query($konek, $string);

    $dispos = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM disposisi WHERE id = " . $id));
    $disposisi_id = $dispos['id'];
    $user_id = $_SESSION['id_logged'];
    $created = date('Y-m-d H:i:s');
    
    $string = "INSERT INTO disposisi_approved(disposisi_id, user_id, created_date) VALUES (
        '$disposisi_id',
        '$user_id',
        '$created'
    )";

    $insert = mysqli_query($konek, $string);
    
    if($insert) {
        disposisiHistory($dispos, "2", "Menerima Disposisi");
        updateStatusDisposisiPJ($id, $dispos);
        //Redirect
        header("Location: ../../admin/disposisi/disposisi_masuk.php");
    }
}

if(!empty($_GET['disposisi'])) {
    $tindak = $_POST['tindak_lanjut'];
    // $level = 0;
    $status = $_POST['status'];
    $disposid = $_POST['disposisi_id'];
    $kepada = $_POST['target_disposisi'];
    $keterangan = $_POST['keterangan'];
    $created = date('Y-m-d H:i:s');
    $createdby = $_SESSION['id_logged'];

    /** FILES */
    $file = $_FILES['lampiran']['name'];
    $tmp_file = date('dmYHis').$file;
    $path_file = "../../lampiran/disposisi_tindaklanjut/" . $tmp_file;
    /** END FILES */

    if(move_uploaded_file($tmp_file, $path_file)) {
        //File Exists
        $string = "INSERT INTO disposisi_tindak_lanjut(disposisi_id, tindak_lanjut, status, keterangan, file, created_date, created_by) VALUES(
            '$disposid',
            '$tindak',
            '$status',
            '$keterangan',
            '$tmp_file',
            '$created',
            '$createdby'
        )";

        $insert = mysqli_query($konek, $string);
        
        if(!$insert) {
            echo mysqli_error($konek);
        } else {
            move_uploaded_file($tmp_file, $path_file);
            header("Location: ../../admin/disposisi/disposisi_masuk.php");
        }
    } else {
        //File Not Exists
        $string = "INSERT INTO disposisi_tindak_lanjut(disposisi_id, tindak_lanjut, status, keterangan, created_date, created_by) VALUES(
            '$disposid',
            '$tindak',
            '$status',
            '$keterangan',
            '$created',
            '$createdby'
        )";
        $insert = mysqli_query($konek, $string);

        if (!$insert) {
            echo mysqli_error($konek);
        } else {
            header("Location: ../../admin/disposisi/disposisi_masuk.php");
        }
    }
}

if(!empty($_GET['laporkirim'])) {
    $disposid = $_POST['disposisi_id'];
    $tindak = $_POST['tindak_lanjut'];
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'];
    $persentase = "0";
    $createdby = $_SESSION['id_logged'];
    $created = date('Y-m-d H:i:s');
    $level = 1;

    /** FILES */
    $file = $_FILES['file']['name'];
    $tmp_file = date('dmYHis') . $file;
    $path_file = "../../lampiran/disposisi_tindaklanjut/" . $tmp_file;
    /** END FILES */

    $string = "INSERT INTO disposisi_tindak_lanjut(disposisi_id, tindak_lanjut, status, persentase, keterangan, file, created_date, created_by, level) VALUES(
            '$disposid',
            '$tindak',
            '$status',
            '$persentase',
            '$keterangan',
            '$tmp_file',
            '$created',
            '$createdby',
            '$level'
        )";

    die($string);

    $insert = mysqli_query($konek, $string);

    if(!$insert) {
        echo mysqli_error($konek);
    } else {
        move_uploaded_file($tmp_file, $path_file);
        disposisiHistory($disposid, "3", "Melaporkan Tindak Lanjut");
        updateStatusDisposisiPJ($disposid, $status);

        //update disposisi yang belum harus melalui validasi ke 
        header("Location: ../../admin/disposisi/disposisi_masuk.php");
    }
}


# ========================================================= Fungsi Disposisi =========================================================
function saveDisposisiKepada($code, $target, $isi) {
    require '../../konfigurasi/koneksi.php';

    $id = $_SESSION['id_logged'];
    $pis = explode(",", $isi);

    $users = [];
    for($i = 0; $i < count($target); $i++) {

        $disposisi_code = $code;
        $user_role_id = $pis[$i];
        $pemberi = $id;
        $level = "1";
        $status = "1";

        $query = "INSERT INTO disposisi_penanggung_jawab(disposisi_code, user_role_id, status, level, pemberi_disposisi) VALUES(
            '$disposisi_code',
            '$user_role_id',
            '$pemberi',
            '$level',
            '$status'
        )";

        $run = mysqli_query($konek, $query);

        if($run) {
            header("Location: ../../admin/disposisi/kirim_disposisi.php");
        } else {
            echo mysqli_error($konek);
        }
    }


}

function disposisiHistory($data, $ket) {
    require '../../konfigurasi/koneksi.php';

    $keterangan = $ket;
    $status = $data['status'];
    $disposisi_id = $data['id'];
    $created = date('Y-m-d H:i:s');
    $created_by = $_SESSION['id_logged'];
    
    $string = "INSERT INTO disposisi_history(disposisi_id, status, keterangan, created_date, created_by) VALUES (
        '$disposisi_id',
        '$status',
        '$keterangan',
        '$created',
        '$created_by'
    )";

    $insert = mysqli_query($konek, $string);

    if(!$insert) {
        mysqli_error($konek);
    }
}

function updateStatusDisposisiPJ($id, $data) {
    require '../../konfigurasi/koneksi.php';

    $disposcode = $data['disposisi_code'];
    $user_role_id = $data['created_by'];

    $string = "UPDATE disposisi_penanggung_jawab SET disposisi_code = '$disposcode', user_role_id = '$user_role_id' WHERE id = " .  $id;
    $update = mysqli_query($konek, $string);

    if(!$update) {
        echo mysqli_error($konek);
    }
}