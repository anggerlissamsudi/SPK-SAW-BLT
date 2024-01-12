<script>
	function loaddata(){
		var tahun = document.getElementById('idtahun').value;
		window.location.href = "index.php?page=bkriteria&tahun="+tahun;
	}
</script>

<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Nilai Bobot Kriteria</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
			<table id="tampil">
				<tr>
					<td><a href="?page=add-nkriteria" class="btn btn-primary"><i class="fa fa-edit"></i> Tambah Kriteria</a></td>
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
			<table id="example1" class="table table-warning table-hover">
				<thead>
					<tr>
                        <th>No</th>
						<th>Nama Kriteria</th>
						<th>Bobot</th>
						<th>Tahun</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$query = "select a.idbbobot, b.namakriteria, a.bobot, c.nama_tahun from bobot a, kriteria b, tahun c where a.idkriteria = b.idkriteria and a.idtahun = c.idtahun and a.idtahun = b.idtahun;";

					if(isset($_GET['tahun'])){
						$query = "select a.idbbobot, b.namakriteria, a.bobot, c.nama_tahun from bobot a, kriteria b, tahun c where a.idkriteria = b.idkriteria and a.idtahun = c.idtahun and a.idtahun = b.idtahun and a.idtahun = '".$_GET['tahun']."';";
					}

					$nomor = 0;
					$hasil = mysqli_query($koneksi, $query);
					while ($row = mysqli_fetch_array($hasil)) {
						?>
					<tr>
					<td><?php echo $nomor=$nomor+1; ?></td>
						<td><?php echo $row['namakriteria']; ?></td>
						<td><?php echo $row['bobot']; ?></td>
						<td><?php echo $row['nama_tahun']; ?></td>
						<td>
							<a href="?page=edit-nkriteria&kode=<?php echo $row['idbbobot']; ?>" onclick="return confirm('Apakah anda yakin merubah data ?')"
								title="Hapus" class="btn btn-primary btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-nkriteria&kode=<?php echo $row['idbbobot']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
								title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
							</a>
						</td>
					</tr>
						<?php
					}
					?>
                </tbody>
				</tfoot>
			</table>
		</div>
	</div>