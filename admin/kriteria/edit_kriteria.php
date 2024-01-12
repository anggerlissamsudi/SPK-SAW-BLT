<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM kriteria WHERE idkriteria = '".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
		$data_cek = mysqli_fetch_array($query_cek);
    }
?>

<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ganti Kriteria
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" id="idkriteria" name="idkriteria" value="<?php echo $data_cek['idkriteria']; ?>">
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
                <label class="col-sm-2 col-form-label">Nama Kriteria</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="namakriteria" name="namakriteria" placeholder="Nama Kriteria" required value="<?php echo $data_cek['namakriteria']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kriteria</label>
                <div class="col-sm-6">
                    <?php
                    if($data_cek['atribut'] == "Cost"){
                        ?>
                    <label><input type="radio" name="atribut" value="Cost" checked>Cost</label>
                    &nbsp;&nbsp;
                    <label><input type="radio" name="atribut" value="Benefit">Benefit</label>
                        <?php
                    }else if($data_cek['atribut'] == "Benefit"){
                        ?>
                        <label><input type="radio" name="atribut" value="Cost" >Cost</label>
                        &nbsp;&nbsp;
                        <label><input type="radio" name="atribut" value="Benefit" checked>Benefit</label>
                        <?php
                    }else{
                        ?>
                        <label><input type="radio" name="atribut" value="Cost" >Cost</label>
                        &nbsp;&nbsp;
                        <label><input type="radio" name="atribut" value="Benefit">Benefit</label>
                        <?php
                    }
                    ?>
                    
                </div>
            </div>
		</div>

		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-info">
			<a href="?page=kriteria" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

if (isset ($_POST['Ubah'])){
    $sql_ubah = "update kriteria set namakriteria = '".$_POST['namakriteria']."', 
    atribut = '".$_POST['atribut']."', idtahun = '".$_POST['idtahun']."' where idkriteria = '".$_POST['idkriteria']."';";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
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
    }}

