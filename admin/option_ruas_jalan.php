<?php

include "../konfigurasi/koneksi.php";

$id_ruasjalan = $_POST['ruas'];

$qry = "SELECT * FROM ruas_jalan WHERE id_sup = " . $id_ruasjalan;
$select = mysqli_query($konek, $qry);

if(mysqli_num_rows($select) > 0) {
    $html = "<option value='0'>Pilih Ruas Jalan</option>";
} else {
    $html = "<option value='0'>Belum Ada Ruas Jalan</option>";
}

while($data = mysqli_fetch_array($select)) {
    // $html .= $data['nama_ruas'];
    $html .= "<option value='".$data['id']."'>".$data['nama_ruas']."</option>";
}

$callback = array('data_ruas_jalan' => $html);
// die(var_dump($callback));

echo json_encode($callback);