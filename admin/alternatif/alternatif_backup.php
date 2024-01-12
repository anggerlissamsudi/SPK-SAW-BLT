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
					<td><a href="?page=piltahun" class="btn btn-primary"><i class="fa fa-edit"></i> Tambah Penilaian</a></td>
					<td>
						<select name="idtahun" id="idtahun" class="form-control select2bs4" required onchange="loaddata();">
							<option value="">- Tahun -</option>
							<?php
							// ambil data dari database
							$query = "select * from tahun";
							$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_array($hasil)) {
							?>
							<option value="<?php echo $row['idtahun'] ?>">
								<?php echo $row['nama_tahun'] ?>
							</option>
							<?php
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
                        <th>No Calon Penerima</th>
						<th>Nama Calon Penerima</th>
						<th>Kriteria</th>
						<th>Nilai</th>
						<th>Tahun</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT a.kd_alternatif, b.kd_alternatif_detil, b.id_penerima, c.nama_penerima, b.idkriteria, d.namakriteria, b.kdnilai, e.nilai, f.nama_tahun FROM alter_head a, alter_detil b, penerima c, kriteria d, nilaikriteria e, tahun f WHERE a.kd_alternatif = b.kd_alternatif AND a.idtahun = f.idtahun AND b.id_penerima = c.id_penerima AND b.idkriteria = d.idkriteria AND d.idtahun = f.idtahun AND b.kdnilai = e.kdnilai";

					if(isset($_GET['tahun'])){
						$query = "SELECT a.kd_alternatif, b.kd_alternatif_detil, b.id_penerima, c.nama_penerima, b.idkriteria, d.namakriteria, b.kdnilai, e.nilai, f.nama_tahun FROM alter_head a, alter_detil b, penerima c, kriteria d, nilaikriteria e, tahun f WHERE a.kd_alternatif = b.kd_alternatif AND a.idtahun = f.idtahun AND b.id_penerima = c.id_penerima AND b.idkriteria = d.idkriteria AND d.idtahun = f.idtahun AND b.kdnilai = e.kdnilai AND a.idtahun = '".$_GET['tahun']."';";
					}

					$nomor = 0;
					$hasil = mysqli_query($koneksi, $query);
					while ($row = mysqli_fetch_array($hasil)) {
						?>
					<tr>
						<td><?php echo $row['id_penerima']; ?></td>
						<td><?php echo $row['nama_penerima']; ?></td>
						<td><?php echo $row['namakriteria']; ?></td>
						<td><?php echo $row['nilai']; ?></td>
						<td><?php echo $row['nama_tahun']; ?></td>
						<td>
							<a href="?page=edit-alternatif&kode=<?php echo $row['kd_alternatif_detil']; ?>" onclick="return confirm('Apakah anda yakin merubah data ?')"
								title="Hapus" class="btn btn-primary btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-alternatif&kode=<?php echo $row['kd_alternatif_detil']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
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