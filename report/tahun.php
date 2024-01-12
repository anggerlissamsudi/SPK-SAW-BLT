<?php
include "../inc/koneksi.php";

if (isset($_POST['btnCetak'])) {
	$id = $_POST['idthn'];
}

$tanggal = date("m/y");
$tgl = date("d/m/y");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>CETAK LAPORAN</title>
</head>

<body>
	<script>
		window.print();
	</script>
</body>

</html>