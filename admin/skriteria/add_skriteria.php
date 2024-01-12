<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Nilai Kriteria
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Kriteria</label>
				<div class="col-sm-4">
					<select name="idkriteria" id="idkriteria" class="form-control select2bs4" required>
						<option selected="selected">- Nama Kriteria -</option>
						<?php
                        // ambil data dari database
                        $query = "select * from kriteria where idkriteria";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                        ?>
						<option value="<?php echo $row['idkriteria'] ?>">
							<?php echo $row['namakriteria'] ?>
						</option>
						<?php
                        }
                        ?>
					</select>
				</div>
			</div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Contoh Keterangan 1 - 3" required>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nilai</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Nilai Per Kriteria" required>
                </div>
            </div>
            

		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=skriteria" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset ($_POST['Simpan'])){
    
        $sql_simpan = "INSERT INTO nilaikriteria (idkriteria, keterangan, nilai) VALUES (
            '".$_POST['idkriteria']."',
            '".$_POST['keterangan']."',
            '".$_POST['nilai']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=skriteria';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=skriteria';
          }
      })</script>";
    }}

     //selesai proses simpan data
