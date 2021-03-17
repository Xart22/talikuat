<?php 
    function tgl_indo($tanggal) {
        $bln = array(
            1 =>   'JANUARI',
            'FEBRUARI',
            'MARET',
            'APRIL',
            'MEI',
            'JUNI',
            'JULI',
            'AGUSTUS',
            'SEPTEMBER',
            'OKTOBER',
            'NOVEMBER',
            'DESEMBER'
        );

        $pecahkan = explode("-", $tanggal);

        return $bln[(int)$pecahkan[1]];
    }

    function tgl__indo($tanggal) {

        $bln = array(
            1 =>   'JANUARI',
            'FEBRUARI',
            'MARET',
            'APRIL',
            'MEI',
            'JUNI',
            'JULI',
            'AGUSTUS',
            'SEPTEMBER',
            'OKTOBER',
            'NOVEMBER',
            'DESEMBER'
        );

        $pecahkan = explode("-", $tanggal);

        return $pecahkan[2] . ' ' . $bln[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
?>