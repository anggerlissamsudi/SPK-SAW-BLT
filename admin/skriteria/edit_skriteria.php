<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM nilaikriteria WHERE kdnilai = '".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
		$data_cek = mysqli_fetch_array($query_cek);
    }
?>

<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Edit Nilai Kriteria
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" id="kdnilai" name="kdnilai" value="<?php echo $_GET['kode']; ?>">
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
                            if($row['idkriteria'] == $data_cek['idkriteria']){
                                ?>
                            <option value="<?php echo $row['idkriteria'] ?>" selected>
                                <?php echo $row['namakriteria'] ?>
                            </option>
                                <?php
                            }else{
                                ?>
                        <option value="<?php echo $row['idkriteria'] ?>">
                            <?php echo $row['namakriteria'] ?>
						</option>
                                <?php
                            }
                        }
                        ?>
					</select>
				</div>
			</div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Contoh Keterangan 1 - 3" required value="<?php echo $data_cek['keterangan']; ?>">
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nilai</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Nilai Per Kriteria" required value="<?php echo $data_cek['nilai']; ?>">
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
    
        $sql_simpan = "update nilaikriteria set idkriteria = '".$_POST['idkriteria']."', keterangan = '".$_POST['keterangan']."', nilai = '".$_POST['nilai']."' where kdnilai = '".$_POST['kdnilai']."';";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Edit Nilai Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=skriteria';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Edit Nilai Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=skriteria';
          }
      })</script>";
    }}

     //selesai proses simpan data
