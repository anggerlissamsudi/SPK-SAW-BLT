<script>
	function loaddata(){
		var tahun = document.getElementById('idtahun').value;
		window.location.href = "index.php?page=pendaftar&tahun="+tahun;
	}
</script>

<table id="tampil" class="d-flex justify-content-center mb-3">
	<tr>
		<td>
			<p class="mx-3 my-3 align-middle">Pilih tahun</p>
		</td>
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
		<td>
		<a href="lap_pertahun.php" target="_blank" class="btn btn-light"><i class="fa fa-file-pdf-o"></i> &nbsp PRINT</a>
		</td>
	</tr>
</table>
    
<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Laporan Pertahun</h3>
	</div>
	<div class="card-body">
    <!-- Table pertama Dusun A -->
    	<div class="row">
        <!-- <p class="text-center">DusunS</p> -->
        <div>
        </div>
        
        <div class="table-responsive col-6">
		<?php
			if(isset($_GET['tahun'])){
				$query = mysqli_query($koneksi, "select count(*) as jml from penerima a, tb_terima b where a.id_penerima = b.idpenerima and b.idtahun = '".$_GET['tahun']."';");
				$row = mysqli_fetch_array($query);

				$diterima = $row['jml'];
			}else{
				$diterima = 0;
			}
			
		?>
        <p class="text-center h-5">Diterima : <?php echo $diterima; ?> </p>
			<table class="table table-warning table-hover">
				<thead>
                	<tr>
                        <th>No</th>
						<th>NIK</th>
						<th>Nama </th>
						<th>Dusun</th>
						<th>Tahun</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$nomor = 0;
						if(isset($_GET['tahun'])){
							$query = "SELECT a.idterima, b.id_penerima, b.nama_penerima, b.asal, c.nama_tahun FROM tb_terima a, penerima b, tahun c WHERE a.idpenerima = b.id_penerima and a.idtahun = c.idtahun and c.idtahun = '".$_GET['tahun']."';";
							$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_array($hasil)) {
								?>
							<tr>
								<td><?php echo $nomor=$nomor+1; ?></td>
								<td><?php echo $row['id_penerima']; ?></td>
								<td><?php echo $row['nama_penerima']; ?></td>
								<td><?php echo $row['asal']; ?></td>
								<td><?php echo $row['nama_tahun']; ?></td>
								
							</tr>
								<?php
							}
						}
					?>
					
                </tbody>
			</table>
		</div>
        <div class="table-responsive col-6">
		<?php
			if(isset($_GET['tahun'])){
				$query = mysqli_query($koneksi, "select count(*) as jml from penerima a, tb_tolak b where a.id_penerima = b.idpenerima and b.idtahun = '".$_GET['tahun']."';");
				$row = mysqli_fetch_array($query);

				$ditolak = $row['jml'];
			}else{
				$ditolak = 0;
			}
			
		?>
        <p class="text-center h-5">Ditolak : <?php echo $ditolak ?> </p>
			<table class="table table-warning table-hover">
				<thead>
                	<tr>
						<th>No</th>
						<th>NIK</th>
						<th>Nama </th>
						<th>Dusun</th>
						<th>Tahun</th>
					</tr>
				</thead>
				<tbody>
                <?php
					$nomor = 0;
					if(isset($_GET['tahun'])){
						$query = "SELECT a.idtolak, b.id_penerima, b.nama_penerima, b.asal, c.nama_tahun FROM tb_tolak a, penerima b, tahun c WHERE a.idpenerima = b.id_penerima and a.idtahun = c.idtahun and c.idtahun = '".$_GET['tahun']."';";
						$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_array($hasil)) {
								?>
							<tr>
								<td><?php echo $nomor=$nomor+1; ?></td>
								<td><?php echo $row['id_penerima']; ?></td>
								<td><?php echo $row['nama_penerima']; ?></td>
								<td><?php echo $row['asal']; ?></td>
								<td><?php echo $row['nama_tahun']; ?></td>
							</tr>
								<?php
							}
					}
					?>
                </tbody>
			</table>
		</div>
    </div>

	</div>
</div>