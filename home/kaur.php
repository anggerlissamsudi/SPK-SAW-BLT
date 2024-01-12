<?php
	$tgl = date("Y-m-d");
	if (isset($_POST['submit'])) {
		$tgl = $_POST['hari'];
	}
?>

	<div class="col-3 ml-auto">
		<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" class="form-inline">  
			<input type="date" class="form-control" id="hari" name="hari" value="<?= $tgl;?>">
			<input type="submit" name="submit" value="Ganti" class="btn btn-primary ml-1">  
		</form>
	</div>
<br>