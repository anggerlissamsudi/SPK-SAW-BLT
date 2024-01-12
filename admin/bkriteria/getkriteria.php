<?php

$tahun = $_POST['tahun'];
//$tahun = "19";

$hasil = '<option selected="selected">- Pilih Kriteria -</option>';
$koneksi = mysqli_connect("localhost","root","","dd");
$query = mysqli_query($koneksi, "select * from kriteria where idtahun = '".$tahun."';");
while ($row = mysqli_fetch_array($query)) {
    $hasil .= '<option value="'.$row['idkriteria'].'">'.$row['namakriteria'].'</option>';
}

echo json_encode(array("status" => $hasil));