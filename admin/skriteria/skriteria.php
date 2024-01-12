<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Nilai Kriteria</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-skriteria" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Nilai Kriteria</a>
			</div>
			<br>
			<table id="example1" class="table table-warning table-hover">
				<thead>
					<tr>
                        <th>No</th>
						<th>Nama Kriteria</th>
						<th>Keterangan</th>
						<th>Nilai</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					$query = "SELECT b.kdnilai, b.idkriteria, a.namakriteria, b.keterangan, b.nilai FROM kriteria a, nilaikriteria b WHERE a.idkriteria = b.idkriteria";
					$hasil = mysqli_query($koneksi, $query);
					while ($row = mysqli_fetch_array($hasil)) {
						?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $row['namakriteria']; ?></td>
						<td><?php echo $row['keterangan']; ?></td>
						<td><?php echo $row['nilai']; ?></td>
						<td>
							<a href="?page=edit-skriteria&kode=<?php echo $row['kdnilai']; ?>" onclick="return confirm('Apakah anda yakin merubah data ?')"
								title="Hapus" class="btn btn-primary btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-skriteria&kode=<?php echo $row['kdnilai']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
								title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
							</a>
						</td>
					</tr>
						<?php
						$no++;
					}
					?>
                </tbody>
				</tfoot>
			</table>
		</div>
	</div>