<?php
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    function bulan_indo($bulan)
    {
        switch ($bulan) {
            case 0:
                $bulan = "";
                break;
            case 1:
                $bulan = "Januari";
                break;
            case 2:
                $bulan = "Februari";
                break;
            case 3:
                $bulan = "Maret";
                break;
            case 4:
                $bulan = "April";
                break;
            case 5:
                $bulan = "Mei";
                break;
            case 6:
                $bulan = "Juni";
                break;
            case 7:
                $bulan = "Juli";
                break;
            case 8:
                $bulan = "Agustus";
                break;
            case 9:
                $bulan = "September";
                break;
            case 10:
                $bulan = "Oktober";
                break;
            case 11:
                $bulan = "November";
                break;
            case 12:
                $bulan = "Desember";
                break;
        }
        return $bulan;
    }

    function bulan_indo_explicit($bulan)
    {
        switch ($bulan) {
            case 0:
                $bulan = "";
                break;
            case 1:
                $bulan = "Jan";
                break;
            case 2:
                $bulan = "Feb";
                break;
            case 3:
                $bulan = "Mar";
                break;
            case 4:
                $bulan = "Apr";
                break;
            case 5:
                $bulan = "Mei";
                break;
            case 6:
                $bulan = "Jun";
                break;
            case 7:
                $bulan = "Jul";
                break;
            case 8:
                $bulan = "Agu";
                break;
            case 9:
                $bulan = "Sep";
                break;
            case 10:
                $bulan = "Okt";
                break;
            case 11:
                $bulan = "Nov";
                break;
            case 12:
                $bulan = "Des";
                break;
        }
        return $bulan;
    }

    function jumlah_hari($bulan = 0, $tahun = 0) 
    {
        $bulan = $bulan > 0 ? $bulan : date("m");
        $tahun = $tahun > 0 ? $tahun : date("Y");

        switch ($bulan) {
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                return 31;
                break;
            case 4:
            case 6:
            case 9:
            case 11:
                return 30;
                break;
            case 2:
                return $tahun % 4 == 0 ? 29 : 28;
                break;
        }

        //Catatan bulan ke- 1,3,5,7,8,10,12 tanggal akhirnya 31
        //untuk bulan ke- 4,6,9,11, tanggal akhirnya 30
        //dan khusus 1 bulan ke- 2 itu tanggal akhirnya antara 28 / 29 
    }

    function jml_minggu($tgl_awal, $tgl_akhir)
    {
        $detik = 24 * 3600;
        $tgl_awal = strtotime($tgl_awal);
        $tgl_akhir = strtotime($tgl_akhir);

        $minggu = 0;
        for ($i = $tgl_awal; $i < $tgl_akhir; $i += $detik) {
            if (date('w', $i) == '0') {
                $minggu++;
            }
        }
        return $minggu;
    }
?>