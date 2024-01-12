<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM alter_head a, alter_detil b WHERE b.kd_alternatif_detil = '".$_GET['kode']."' AND a.kd_alternatif = b.kd_alternatif;";
        $query_cek = mysqli_query($koneksi, $sql_cek);
		$data_cek = mysqli_fetch_array($query_cek);

        // mengambil data tahun
        $q_tahun = mysqli_query($koneksi, "select nama_tahun from tahun where idtahun = '".$data_cek['idtahun']."';");
		$data_tahun = mysqli_fetch_array($q_tahun);
    }
?>

<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Edit Alternatif
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" id="kd_detil" name="kd_detil" value="<?php echo $_GET['kode']; ?>" >
        <input type="hidden" id="kd_head" name="kd_head" value="<?php echo $data_cek['kd_alternatif']; ?>" >
		<div class="card-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tahun Anggaran</label>
                <div class="col-sm-4">
                    <input type="hidden" id="idtahun" name="idtahun" readonly value="<?php echo $data_cek['idtahun']; ?>";>
                    <input type="text" class="form-control" id="tahunanggaran" name="tahunanggaran" placeholder="Tahun Anggaran" readonly value="<?php echo $data_tahun['nama_tahun']; ?>";>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Calon Penerima</label>
                    <div class="col-sm-4">
                    <select name="calon" id="calon" class="form-control select2bs4" required>
						<option selected="selected">- Nama Calon -</option>
						<?php
                        // ambil data dari database
                        $query = "select * from penerima";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                            if($row['id_penerima'] == $data_cek['id_penerima']){
                                ?>
                        <option value="<?php echo $row['id_penerima'] ?>" selected>
                            <?php echo $row['nama_penerima'].' ('.$row['id_penerima'].')' ?>
                        </option>
                                <?php
                            }else{
                                ?>
                        <option value="<?php echo $row['id_penerima'] ?>">
                            <?php echo $row['nama_penerima'].' ('.$row['id_penerima'].')' ?>
                        </option>
                                <?php
                            }
                            
                        }
                        ?>
					</select>
                    </div>
            </div>

            <?php
            $kri = mysqli_query($koneksi, "SELECT * FROM kriteria where idtahun = '".$data_cek['idtahun']."';");
            while ($row = mysqli_fetch_array($kri)) {
                ?>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?php echo $row['namakriteria']; ?></label>
                <div class="col-sm-4">
                    <select name="<?php echo $row['idkriteria']; ?>" id="<?php echo $row['idkriteria']; ?>" class="form-control select2bs4" required>
                        <?php
                        $nilai_kri = mysqli_query($koneksi, "SELECT * FROM nilaikriteria WHERE idkriteria = '".$row['idkriteria']."';");
                        while ($row_nilai = mysqli_fetch_array($nilai_kri)) {
                            if($row_nilai['kdnilai'] == $data_cek['kdnilai']){
                                ?>
                        <option selected value="<?php echo $row_nilai['kdnilai']; ?>"><?php echo $row_nilai['keterangan']; ?></option>
                                <?php
                            }else{
                                ?>
                        <option value="<?php echo $row_nilai['kdnilai']; ?>"><?php echo $row_nilai['keterangan']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
                <?php
            }
            ?>
            
		</div>

		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=alternatif" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset ($_POST['Simpan'])){
    
    //mysqli_query($koneksi, "delete from alter_detil where kd_alternatif = '".$_POST['kd_head']."';");
    mysqli_query($koneksi, "delete from alter_head where kd_alternatif = '".$_POST['kd_head']."';");
    

    // simpan head
    $sql_simpan_head = "INSERT INTO alter_head (idtahun) VALUES ('".$_POST['idtahun']."');";
    $query_simpan_head = mysqli_query($koneksi, $sql_simpan_head);
    
    // mencari id terkahir yang diinsert
    $query_last_id = mysqli_query($koneksi, "SELECT kd_alternatif FROM alter_head ORDER BY kd_alternatif DESC LIMIT 1");
    $last_id = mysqli_fetch_array($query_last_id)['kd_alternatif'];;

    // simpan detil
    $kri = mysqli_query($koneksi, "SELECT * FROM kriteria");
    while ($row = mysqli_fetch_array($kri)) {
        $kdnilai = $_POST[$row['idkriteria']];
        
        $query_simpan_detil = mysqli_query($koneksi, "INSERT INTO alter_detil (kd_alternatif, id_penerima, idkriteria, kdnilai) VALUES ('"
        .$last_id."','".$_POST['calon']."','".$row['idkriteria']."','".$kdnilai."');");
    }
    mysqli_close($koneksi);

    if ($query_simpan_head) {
    echo "<script>
    Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=alternatif';
        }
    })</script>";
    }else{
    echo "<script>
    Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=alternatif';
        }
    })</script>";
    }
}