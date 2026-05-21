<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Nilai Kriteria
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-4">
                    <select name="idtahun" id="idtahun" class="form-control select2bs4" required onchange="pilih_kri();">
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

            <label class="col-sm-2 col-form-label">Nama Kriteria</label>
				<div class="col-sm-4">
					<select name="idkriteria" id="idkriteria" class="form-control select2bs4" required>
						<option selected="selected">- Pilih Kriteria -</option>
					</select>
				</div>
			</div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Tidak ada/1/2/3/4/5" required>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nilai</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nilai" name="nilai" placeholder="0/1/2/3/4/5/6/7/8/9" required>
                </div>
            </div>
            

		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=skriteria" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<script>
    function pilih_kri(){
        var tahun = document.getElementById('idtahun').value;
        
        var form_data = new FormData();
		form_data.append('tahun', tahun);

		$.ajax({
			url: "admin/bkriteria/getkriteria.php",
			dataType: 'JSON',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'POST',
			success: function (response) {
                
				$('#idkriteria').html(response.status);
			},error: function (response) {
				alert(response.status);
			}
		});
    }
</script>

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
