<script>
	function loaddata(){
		var tahun = document.getElementById('idtahun').value;
		window.location.href = "index.php?page=kriteria&tahun="+tahun;
	}
</script>
<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Kriteria</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<table id="tampil">
				<tr>
					<td><a href="?page=add-kriteria" class="btn btn-primary"><i class="fa fa-edit"></i> Tambah Kriteria</a></td>
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
		<div>
				
			</div>
			<br>
			<table id="example1" class="table table-warning table-hover">
				<thead>
					<tr>
                        <th>No</th>
						<th>Nama Kriteria</th>
						<th>Jenis Kriteria</th>
						<th>Tahun</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$query = "SELECT a.idkriteria, a.namakriteria, a.atribut, b.nama_tahun FROM kriteria a, tahun b WHERE a.idtahun = b.idtahun";
					if(isset($_GET['tahun'])){
						$query = "SELECT a.idkriteria, a.namakriteria, a.atribut, b.nama_tahun FROM kriteria a, tahun b WHERE a.idtahun = b.idtahun and a.idtahun = '".$_GET['tahun']."'";
					}
					$nomor = 0;
					$hasil = mysqli_query($koneksi, $query);
					while ($row = mysqli_fetch_array($hasil)) {
						?>
					<tr>
						<td><?php echo $nomor=$nomor+1; ?></td>
						<td><?php echo $row['namakriteria']; ?></td>
						<td><?php echo $row['atribut']; ?></td>
						<td><?php echo $row['nama_tahun']; ?></td>
						<td>
							<a href="?page=edit-kriteria&kode=<?php echo $row['idkriteria']; ?>" onclick="return confirm('Apakah anda yakin merubah data ?')"
								title="Hapus" class="btn btn-primary btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-kriteria&kode=<?php echo $row['idkriteria']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
								title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
							</a>
						</td>
					</tr>
						<?php
					}
				?>
                </tbody>
			</table>
		</div>
	</div>
	<!-- /.card-body -->