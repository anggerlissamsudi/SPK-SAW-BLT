<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM bobot WHERE idbbobot = '".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
		$data_cek = mysqli_fetch_array($query_cek);
    }
?>
<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Edit bobot Kriteria
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group row">
                <input type="hidden" id="idtahun" name="idtahun" value="<?php echo $_GET['kode']; ?>">
                    <label class="col-sm-2 col-form-label">Tahun</label>
                        <div class="col-sm-4">
                            <select name="idtahun" id="idtahun" class="form-control select2bs4" required>
                                <option selected="selected">- Tahun -</option>
                                <?php
                                // ambil data dari database
                                $query = "select * from tahun";
                                $hasil = mysqli_query($koneksi, $query);
                                while ($row = mysqli_fetch_array($hasil)) {
                                    if($row['idtahun'] == $data_cek['idtahun']){
                                        ?>
                                <option value="<?php echo $row['idtahun'] ?>" selected>
                                    <?php echo $row['nama_tahun'] ?>
                                </option>
                                        <?php
                                    }else{
                                        ?>
                                <option value="<?php echo $row['idtahun'] ?>">
                                    <?php echo $row['nama_tahun'] ?>
                                </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
			</div>

        <div class="form-group row">
        
            <input type="hidden" id="idbbobot" name="idbbobot" value="<?php echo $_GET['kode']; ?>">
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
                <label class="col-sm-2 col-form-label">Bobot</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="bobot" name="bobot" placeholder="Bobot Per Kriteria" required value="<?php echo $data_cek['bobot']; ?>">
                </div>
            </div>
            

		</div>

		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=bkriteria" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset ($_POST['Simpan'])){
    $sql_ubah = "update bobot set idkriteria = '".$_POST['idkriteria']."', bobot = '".$_POST['bobot']."', idtahun = '".$_POST['idtahun']."' where idbbobot = '".$_POST['idbbobot']."';";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=bkriteria';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=bkriteria';
          }
      })</script>";
    }}
