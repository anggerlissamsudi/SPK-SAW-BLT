<?php
$koneksi = mysqli_connect("localhost","root","","dd");

$status = "";
$idpenerima = $_POST['idpenerima'];
$tahun = $_POST['tahun'];

// cek manusia ini sdh masuk apa belum
$query_cek = mysqli_query($koneksi, "SELECT count(*) as jml FROM alter_head a, alter_detil b where a.kd_alternatif = b.kd_alternatif and a.idtahun = '".$tahun."' and b.id_penerima = '".$idpenerima."';");
$cek_head = mysqli_fetch_array($query_cek)['jml'];
if($cek_head < 1){
    // simpan head
    $sql_simpan_head = "INSERT INTO alter_head (idtahun) VALUES ('".$tahun."');";
    $query_simpan_head = mysqli_query($koneksi, $sql_simpan_head);

    // mencari id terkahir yang diinsert
    $query_last_id = mysqli_query($koneksi, "SELECT kd_alternatif FROM alter_head ORDER BY kd_alternatif DESC LIMIT 1");
    $last_id = mysqli_fetch_array($query_last_id)['kd_alternatif'];

    // membaca kriteria dr tahun tersebut
    $kri = mysqli_query($koneksi, "SELECT * FROM kriteria where idtahun = '".$tahun."';");
    while ($row = mysqli_fetch_array($kri)) {
        $kdnilai = $_POST[$idpenerima.'-'.$row['idkriteria']];

        mysqli_query($koneksi, "INSERT INTO alter_detil (kd_alternatif, id_penerima, idkriteria, kdnilai) VALUES ('"
        .$last_id."','".$idpenerima."','".$row['idkriteria']."','".$kdnilai."');");
    }

    $status = "Data tersimpan";

}else{
    // nanti

    // mencari id terkahir yang diinsert
    $query_last_id = mysqli_query($koneksi, "SELECT a.kd_alternatif FROM alter_head a, alter_detil b where a.kd_alternatif = b.kd_alternatif and a.idtahun = '".$tahun."' and b.id_penerima = '".$idpenerima."' ORDER BY a.kd_alternatif DESC LIMIT 1;");
    $last_id = mysqli_fetch_array($query_last_id)['kd_alternatif'];

    // membaca kriteria dr tahun tersebut
    $kri = mysqli_query($koneksi, "SELECT * FROM kriteria where idtahun = '".$tahun."';");
    while ($row = mysqli_fetch_array($kri)) {
        $kdnilai = $_POST[$idpenerima.'-'.$row['idkriteria']];

        mysqli_query($koneksi, "update alter_detil set kdnilai = '".$kdnilai."' where 
            kd_alternatif = '".$last_id."' and id_penerima = '".$idpenerima."' and idkriteria = '".$row['idkriteria']."';");
    }

    $status = "Data tersimpan";
}


echo json_encode(array("status" => $status));