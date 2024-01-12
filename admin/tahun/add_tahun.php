<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Tahun
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Kriteria</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama_tahun" name="nama_tahun" placeholder="Nama Tahun Contoh: 2020" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kuota</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="kuota" name="kuota" placeholder="50" required>
                </div>
            </div>
		</div>

		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=datatahun" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset ($_POST['Simpan'])){

    $Simpan = $_POST['Simpan'];

    $sql_cek = mysqli_query($koneksi, "SELECT nama_tahun FROM tahun WHERE nama_tahun LIKE '%$_POST[nama_tahun]%'");

        if ($sql_cek->num_rows > 0) {
            echo "<script>alert('Tahun sudah ada');</script>";
        } else {
            $sql_simpan = "INSERT INTO tahun (nama_tahun, kuota) VALUES (
                '".$_POST['nama_tahun']."',
                '".$_POST['kuota']."')";
            $query_simpan = mysqli_query($koneksi, $sql_simpan);
            mysqli_close($koneksi);   
            
            if ($query_simpan) {
                echo "<script>
                  Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                  }).then((result) => {if (result.value){
                      window.location = 'index.php?page=datatahun';
                      }
                  })</script>";
                }else{
                echo "<script>
                  Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                  }).then((result) => {if (result.value){
                      window.location = 'index.php?page=datatahun';
                      }
                  })</script>";
              }
        }
}
