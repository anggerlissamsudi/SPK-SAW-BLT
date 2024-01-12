<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tahun WHERE idtahun = '".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
		$data_cek = mysqli_fetch_array($query_cek);
    }
?>

<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Tahun</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Id Tahun</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" id="idtahun" name="idtahun" value="<?php echo $data_cek['idtahun']; ?>"
					 readonly/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Tahun</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_tahun" name="nama_tahun" value="<?php echo $data_cek['nama_tahun']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kuota Bantuan</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="kuota" name="kuota" value="<?php echo $data_cek['kuota']; ?>"
					/>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-info">
			<a href="?page=datatahun" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

if (isset ($_POST['Ubah'])){
    $sql_ubah = "update tahun set nama_tahun = '".$_POST['nama_tahun']."', kuota = '".$_POST['kuota']."' where idtahun = '".$_POST['idtahun']."';";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
      echo "<script>
      Swal.fire({title: 'Edit Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=datatahun';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Edit Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=datatahun';
          }
      })</script>";
    }}
