<?php
$koneksi = mysqli_connect("localhost","root","","dd");

$selected = $_POST['selected'];

// potong koma
$status = '';
$var1 = trim($selected);
$var2 = explode(",", $var1); // porong berdasarkan ,

$tahun = 0;

for($i=0; $i<count($var2); $i++){
    $penerima = $var2[$i];
    // potong berdasarkan -
    $var3 = explode("-", $penerima);
    $tahun = $var3[0];
    mysqli_query($koneksi, "delete from tb_terima where idtahun = '".$tahun."';");
    mysqli_query($koneksi, "delete from tb_tolak where idtahun = '".$tahun."';");

    break;
}

for($i=0; $i<count($var2); $i++){
    // nilai per manusia
    $penerima = $var2[$i];
    // potong berdasarkan -
    $var3 = explode("-", $penerima);
    $tahun = $var3[0];
    $idpenerima = $var3[1];
    $nilai = $var3[2];

    // cek id terima pada tahun itu

    $qcek = mysqli_query($koneksi, "select count(*) as jml from tb_terima where idtahun = '".$tahun."' and idpenerima = '".$idpenerima."';");
    $rowcek = mysqli_fetch_array($qcek);
    if($rowcek['jml'] > 0){
        mysqli_query($koneksi, "delete from tb_terima where idtahun = '".$tahun."' and idpenerima = '".$idpenerima."';");
        // masukkan ke data diterima
        mysqli_query($koneksi, "INSERT INTO tb_terima (idtahun, idpenerima, nilai) VALUES ('".$tahun."','".$idpenerima."','".$nilai."')");
    }else{
        // masukkan ke data diterima
        mysqli_query($koneksi, "INSERT INTO tb_terima (idtahun, idpenerima, nilai) VALUES ('".$tahun."','".$idpenerima."','".$nilai."')");
    }
    
}

$q_tolak = mysqli_query($koneksi, "select * from nilai where idtahun = '".$tahun."' and id_penerima not in(select idpenerima from tb_terima where idtahun = '".$tahun."') order by nilai desc;");
while($row = mysqli_fetch_array($q_tolak)){
    mysqli_query($koneksi, "INSERT INTO tb_tolak (idtahun, idpenerima, nilai) VALUES ('".$tahun."','".$row['id_penerima']."','".$row['nilai']."')");
}



$status = "Data tersimpan";
echo json_encode(array("status" => $status));