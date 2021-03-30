<?php

include "../konfigurasi/koneksi.php";

$unor = $_POST['unor'];

$qry = "SELECT * FROM utils_sup WHERE kantor_id = " . $unor;
$select = mysqli_query($konek, $qry);

if (mysqli_num_rows($select) > 0) {
    $html = "<option value='0'>Pilih SUP</option>";
} else {
    $html = "<option value='0'>Belum Ada SUP</option>";
}

while ($data = mysqli_fetch_array($select)) {
    // $html .= $data['nama_ruas'];
    $html .= "<option value='" . $data['id'] . "'>" . $data['nama'] . "</option>";
}

$callback = array('data_umum_ruas' => $html);
// die(var_dump($callback));

echo json_encode($callback);
