<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
	function loaddata(){
		var tahun = document.getElementById('idtahun').value;
		window.location.href = "index.php?page=alternatif&tahun="+tahun;
	}

	function hanyaAngka(e, decimal) {
		var key;
		var keychar;
		if (window.event) {
			key = window.event.keyCode;
		} else if (e) {
			key = e.which;
		} else {
			return true;
		}
		keychar = String.fromCharCode(key);
		if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
			return true;
		} else if ((("0123456789").indexOf(keychar) > -1)) {
			return true;
		} else if (decimal && (keychar == ".")) {
			return true;
		} else {
			return false;
		}
	}
</script>
<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Penilaian</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
			<table id="tampil">
				<tr>
					<td>
						<select name="idtahun" id="idtahun" class="form-control select2bs4" required onchange="loaddata();">
							<option value="">- Tahun -</option>
							<?php
							// ambil data dari database
							$query = "select idtahun, nama_tahun from tahun order by nama_tahun asc;";
							$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_array($hasil)) {
								if($row['idtahun'] == $_GET['tahun']){
									?>
							<option value="<?php echo $row['idtahun'] ?>" selected>
								<?php echo $row['nama_tahun'] ?>
							</option>
									<?php
								}else{
									?>
							<option value="<?php echo $row['idtahun'] ?>">
								<?php echo $row['nama_tahun'] ?>
							</option>
									<?php
								}
							}
							?>
						</select>
					</td>
				</tr>
			</table>
			</div>
			<br>
			<table class="table table-warning table-hover">
				<thead>
					<tr>
						<th></th>
						<th>No</th>
                        <th>NIK</th>
						<th>Nama Calon</th>
						
						<?php
						if(isset($_GET['tahun'])){
							$q_kri_head = mysqli_query($koneksi, "SELECT idkriteria, namakriteria FROM kriteria where idtahun = '".$_GET['tahun']."';");
							while ($row_head = mysqli_fetch_array($q_kri_head)) {
								echo "<th>".$row_head['namakriteria']."</th>";
							}
						}else{
							echo "<th>Nama Kriteria</th>";
						}
						?>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$nomor = 0;
					if(isset($_GET['tahun'])){
						$q_penerima = mysqli_query($koneksi, "select * from penerima");
						while ($row_penerima = mysqli_fetch_array($q_penerima)) {
						?>
					<tr>
						<?php
							$query = mysqli_query($koneksi, "select count(*) as jml from alter_detil where id_penerima = '".$row_penerima['id_penerima']."';");
							$row = mysqli_fetch_array($query);

							if($row['jml'] > 0)	{
								?>
						<td><i id='icon_<?php echo $row_penerima['id_penerima']; ?>' style="font-size:24px; display:block;" class="fa">&#xf046;</i></td>
								<?php
							}
							else{
								?>
						<td><i id='icon_<?php echo $row_penerima['id_penerima']; ?>' style="font-size:24px; display:none;" class="fa">&#xf046;</i></td>
								<?php
							}
						?>

						
						<td><?php echo $nomor=$nomor+1; ?></td>
						<td><?php echo $row_penerima['id_penerima']; ?></td>
						<td><?php echo $row_penerima['nama_penerima']; ?></td>
						
						<?php
						// menampilkan semua kriteria pada tahun tersebut
						$kri = mysqli_query($koneksi, "SELECT * FROM kriteria where idtahun = '".$_GET['tahun']."';");
						while ($row = mysqli_fetch_array($kri)) {
							?>
						<td>
								<?php
								$nilai_kri = mysqli_query($koneksi, "SELECT * FROM nilaikriteria WHERE idkriteria = '".$row['idkriteria']."';");
								//text pertama
								if (mysqli_num_rows($nilai_kri)==0){
									// $q="SELECT kdnilai FROM alter_detil ad where id_penerima = '".$row_penerima['id_penerima']."' and idkriteria = '".$row['idkriteria']."' and kd_alternatif = (select DISTINCT (d.kd_alternatif) from alter_detil d join alter_head h on d.kd_alternatif = h.kd_alternatif where idtahun = '".$_GET['tahun']."' and id_penerima = '".$row_penerima['id_penerima']."')";
									// echo $q;
									$nilai_alter = mysqli_query($koneksi, "SELECT kdnilai FROM alter_detil ad where id_penerima = '".$row_penerima['id_penerima']."' and idkriteria = '".$row['idkriteria']."' and kd_alternatif = (select DISTINCT (d.kd_alternatif) from alter_detil d join alter_head h on d.kd_alternatif = h.kd_alternatif where idtahun = '".$_GET['tahun']."' and id_penerima = '".$row_penerima['id_penerima']."');");
									if(mysqli_num_rows($nilai_alter)==0)
									{
										$nilai_nilai = '';
									}
									else{
										$row_nil = mysqli_fetch_array($nilai_alter);
										$nilai_nilai = $row_nil['kdnilai'];
									}
									
									?>
										<input type="text" name="<?php echo $row_penerima['id_penerima'].'-'.$row['idkriteria']; ?>" id="<?php echo $row_penerima['id_penerima'].'-'.$row['idkriteria']; ?>" value = "<?php echo $nilai_nilai; ?>" onkeypress="return hanyaAngka(event, false);">
									<?php
								}//else untuk combo box
								else
								{
									$nilai_alter = mysqli_query($koneksi, "SELECT kdnilai FROM alter_detil ad where id_penerima = '".$row_penerima['id_penerima']."' and idkriteria = '".$row['idkriteria']."' and kd_alternatif = (select DISTINCT (d.kd_alternatif) from alter_detil d join alter_head h on d.kd_alternatif = h.kd_alternatif where idtahun = '".$_GET['tahun']."' and id_penerima = '".$row_penerima['id_penerima']."');");
									if(mysqli_num_rows($nilai_alter)==0)
									{
										$nilai_nilai = '';
									}
									else{
										$row_nil = mysqli_fetch_array($nilai_alter);
										$nilai_nilai = $row_nil['kdnilai'];
									}

									?>
									<select name="<?php echo $row_penerima['id_penerima'].'-'.$row['idkriteria']; ?>" id="<?php echo $row_penerima['id_penerima'].'-'.$row['idkriteria']; ?>" class="form-control select2bs4">
										<?php	
											while ($row_nilai = mysqli_fetch_array($nilai_kri)) {
												if($row_nilai['kdnilai'] == $nilai_nilai){
													?>
											<option selected value="<?php echo $row_nilai['kdnilai']; ?>"><?php echo $row_nilai['keterangan']; ?></option>
													<?php
												}else{
													?>
											<option value="<?php echo $row_nilai['kdnilai']; ?>"><?php echo $row_nilai['keterangan']; ?></option>
													<?php
												}
												
												
											}?>
									</select>	

									<?php
									
								}
								?>
							
						</td>
							<?php
						}
						
						?>
						<td><button class="btn btn-primary" onclick="simpan('<?php echo $row_penerima['id_penerima']; ?>','<?php echo $_GET['tahun']; ?>');";>Simpan</button></td>
					</tr>
							<?php
						}
					}
					?>
                </tbody>
				</tfoot>
			</table>
		</div>
	</div>

<script>

    function simpan(idpenerima, tahun){
        
		var form_data = new FormData();
		form_data.append('idpenerima', idpenerima);
		form_data.append('tahun', tahun);
		
		<?php
		$kri = mysqli_query($koneksi, "SELECT * FROM kriteria where idtahun = '".$_GET['tahun']."';");
		while ($row = mysqli_fetch_array($kri)) {
			?>
		var a = document.getElementById(idpenerima + "-<?php echo $row['idkriteria']; ?>").value;
		// alert (a);
		form_data.append(idpenerima + '-<?php echo $row['idkriteria']; ?>', a);
			<?php
		}
		?>

		$.ajax({
			url: "admin/alternatif/simpanalter.php",
			dataType: 'JSON',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'POST',
			success: function (response) {
				$('#icon_' + idpenerima).css("display", "block");
				alert(response.status);

			},error: function (response) {

				alert(response.status);
			}
		});

    }

</script>