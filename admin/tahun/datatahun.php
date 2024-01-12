<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Tahun</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-tahun" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Tahun Bantuan</a>
			</div>
			<br>
            <table id="example1" class="table table-warning table-hover">
				<thead>
					<tr>
                        <th>No</th>
						<th>Tahun</th>
						<th>Kuota</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$query = "select idtahun, nama_tahun, kuota from tahun order by nama_tahun asc;";
					$nomor = 0;
					$hasil = mysqli_query($koneksi, $query);
					while ($row = mysqli_fetch_array($hasil)) {
						?>
					<tr>
					<td><?php echo $nomor=$nomor+1; ?></td>
						<td><?php echo $row['nama_tahun']; ?></td>
						<td><?php echo $row['kuota']; ?></td>
						<td>
							<a href="?page=edit-tahun&kode=<?php echo $row['idtahun']; ?>" onclick="return confirm('Apakah anda yakin merubah data ?')"
								title="Hapus" class="btn btn-primary btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-tahun&kode=<?php echo $row['idtahun']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
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