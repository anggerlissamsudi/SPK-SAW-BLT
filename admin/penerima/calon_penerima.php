<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Calon Penerima</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-penerima" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-warning table-hover">
				<thead>
					<tr>
                        <th>NIK</th>
						<th>Nama Calon Penerima</th>
						<th>Dusun</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
                    <?php
					$query = "select * from penerima";
					$hasil = mysqli_query($koneksi, $query);
					while ($row = mysqli_fetch_array($hasil)) {
						?>
					<tr>
						<td><?php echo $row['id_penerima']; ?></td>
						<td><?php echo $row['nama_penerima']; ?></td>
						<td><?php echo $row['asal']; ?></td>
						<td>
							<a href="?page=edit-penerima&kode=<?php echo $row['id_penerima']; ?>" onclick="return confirm('Apakah anda yakin merubah data ?')"
								title="Hapus" class="btn btn-primary btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-penerima&kode=<?php echo $row['id_penerima']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
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
	<!-- /.card-body -->