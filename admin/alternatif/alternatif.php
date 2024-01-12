<script>
	function loaddata(){
		var tahun = document.getElementById('idtahun').value;
		window.location.href = "index.php?page=alternatif&tahun="+tahun;
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
						<td><?php echo $nomor=$nomor+1; ?></td>
						<td><?php echo $row_penerima['id_penerima']; ?></td>
						<td><?php echo $row_penerima['nama_penerima']; ?></td>
						
						<?php
						// menampilkan semua kriteria pada tahun tersebut
						$kri = mysqli_query($koneksi, "SELECT * FROM kriteria where idtahun = '".$_GET['tahun']."';");
						while ($row = mysqli_fetch_array($kri)) {
							?>
						<td>
							<select name="<?php echo $row_penerima['id_penerima'].'-'.$row['idkriteria']; ?>" id="<?php echo $row_penerima['id_penerima'].'-'.$row['idkriteria']; ?>" class="form-control select2bs4">
								<?php
								$nilai_kri = mysqli_query($koneksi, "SELECT * FROM nilaikriteria WHERE idkriteria = '".$row['idkriteria']."';");
								while ($row_nilai = mysqli_fetch_array($nilai_kri)) {
									?>
								<option value="<?php echo $row_nilai['kdnilai']; ?>"><?php echo $row_nilai['keterangan']; ?></option>
									<?php
								}
								?>
							</select>
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
				
				alert(response.status);

			},error: function (response) {

				alert(response.status);
			}
		});

    }

</script>