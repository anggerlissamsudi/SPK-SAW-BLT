<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Kriteria
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-4">
                    <select name="idtahun" id="idtahun" class="form-control select2bs4" required>
                        <option selected="selected">- Tahun -</option>
                        <?php
                        // ambil data dari database
                        $query = "select idtahun, nama_tahun from tahun order by nama_tahun asc;";
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
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Kriteria</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="namakriteria" name="namakriteria" placeholder="Nama Kriteria" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kriteria</label>
                <div class="col-sm-6">
                    <label><input type="radio" name="atribut" value="Cost" checked>Cost</label>
                    &nbsp;&nbsp;
                    <label><input type="radio" name="atribut" value="Benefit">Benefit</label>
                </div>
            </div>
		</div>

		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=kriteria" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset ($_POST['Simpan'])){

    $Simpan = $_POST['Simpan'];

    $sql_cek = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE namakriteria = '".$_POST['namakriteria']."' and idtahun = '".$_POST['idtahun']."';");
    
    if ($sql_cek->num_rows > 0) {
        echo "<script>alert('Kriteria sudah ada');</script>";
    } else {
        $sql_simpan = "INSERT INTO kriteria (namakriteria, atribut, idtahun) VALUES (
            '".$_POST['namakriteria']."',
            '".$_POST['atribut']."',
            '".$_POST['idtahun']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);
    
        if ($query_simpan) {
          echo "<script>
          Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
          }).then((result) => {if (result.value){
              window.location = 'index.php?page=kriteria';
              }
          })</script>";
          }else{
          echo "<script>
          Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
          }).then((result) => {if (result.value){
              window.location = 'index.php?page=kriteria';
              }
          })</script>";
        }
    }
}

