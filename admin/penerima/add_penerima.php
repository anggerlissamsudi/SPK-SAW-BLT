<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">No Calon Penerima</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="id_penerima" name="id_penerima" placeholder="No Calon Penerima" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_penerima" name="nama_penerima" placeholder="Nama Penerima" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Asal</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="asal" name="asal" placeholder="Asal" required>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=calon-penerima" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
        $sql_simpan = "INSERT INTO penerima (id_penerima, nama_penerima, asal) VALUES (
            '".$_POST['id_penerima']."',
            '".$_POST['nama_penerima']."',
            '".$_POST['asal']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=calon-penerima';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-kartu';
          }
      })</script>";
    }}
     //selesai proses simpan data

