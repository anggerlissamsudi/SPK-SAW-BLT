<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM penerima WHERE id_penerima = '".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
		$data_cek = mysqli_fetch_array($query_cek);
    }
?>

<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Id Penerima</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" id="id_penerima" name="id_penerima" value="<?php echo $data_cek['id_penerima']; ?>"
					 readonly/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_penerima" name="nama_penerima" value="<?php echo $data_cek['nama_penerima']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Asal</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="asal" name="asal" value="<?php echo $data_cek['asal']; ?>"
					/>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-info">
			<a href="?page=calon-penerima" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Ubah'])){
    $sql_ubah = "update penerima set nama_penerima = '".$_POST['nama_penerima']."', asal = '".$_POST['asal']."' 
	where id_penerima = '".$_POST['id_penerima']."';";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {
			window.location.href = 'index.php?page=calon-penerima';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=calon_penerima';
        }
      })</script>";
    }}
