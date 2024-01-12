<table id="tampil" class="d-flex justify-content-center mb-3">
        <tr>
            <td>
                <p class="mx-3 my-3 align-middle">Pilih tahun</p>
            </td>
            <td>
            <select name="th_awal" id="th_awal" class="form-control select2bs4" style="width: 100px;">
                <option value="">- Tahun -</option>
                <?php
                // ambil data dari database
                $query = "select idtahun, nama_tahun from tahun order by nama_tahun asc;";
                $hasil = mysqli_query($koneksi, $query);
                while ($row = mysqli_fetch_array($hasil)) {
					if($row['idtahun'] == $_GET['t1']){
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
            </td>
            <td>
                &nbsp;&nbsp;s.d&nbsp;&nbsp;
            </td>
            <td>
            <select name="th_akhir" id="th_akhir" class="form-control select2bs4" style="width: 100px;">
                <option value="">- Tahun -</option>
                <?php
                // ambil data dari database
                $query = "select idtahun, nama_tahun from tahun order by nama_tahun asc;";
                $hasil = mysqli_query($koneksi, $query);
                while ($row = mysqli_fetch_array($hasil)) {
					if($row['idtahun'] == $_GET['t2']){
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
            </td>
            <td> &nbsp;&nbsp; <a href="javascript:void(0);" class="btn btn-primary" onclick="proses();"><i class="fa fa-hourglass-half"></i> Proses</a> &nbsp;&nbsp;</td>
        </tr>
    </table>

<script type="text/javascript" src="plugins/chartjs/Chart.js"></script>
<div class="row">
	<div style="width: 800px;margin: 0px auto;">
		<canvas id="myChart1"></canvas>
	</div>
</div>

<div class="row">
	<?php
	if(isset($_GET['t1']) && isset($_GET['t2'])){
		$q_tahun1 = mysqli_query($koneksi, "select nama_tahun from tahun where idtahun = '".$_GET['t1']."';");
		$tahun_awal = mysqli_fetch_array($q_tahun1)['nama_tahun'];

		$q_tahun2 = mysqli_query($koneksi, "select nama_tahun from tahun where idtahun = '".$_GET['t2']."';");
		$tahun_akhir = mysqli_fetch_array($q_tahun2)['nama_tahun'];

		$data_tahun = array();
		for($i=$tahun_awal; $i <= $tahun_akhir; $i++){
			array_push($data_tahun, $i);
		}
		$temp_tahun1 = substr(json_encode($data_tahun), 1, strlen(json_encode($data_tahun)));
		$temp_tahun2 = substr($temp_tahun1, 0, strlen($temp_tahun1)-1);

	}else{
		date_default_timezone_set('Asia/Jakarta');
		$tahun_sekarang = date("Y");
		$tahun_awal = $tahun_sekarang - 2;
		$tahun_akhir = $tahun_sekarang + 2;
	
		$data_tahun = array();
		for($i=$tahun_awal; $i <= $tahun_akhir; $i++){
			array_push($data_tahun, $i);
		}
		$temp_tahun1 = substr(json_encode($data_tahun), 1, strlen(json_encode($data_tahun)));
		$temp_tahun2 = substr($temp_tahun1, 0, strlen($temp_tahun1)-1);
	}
	?>
</div>

<div class="row">
	<div style="width: 800px;margin: 0px auto; margin-top: 50px;">
		<canvas id="myChart2"></canvas>
	</div>
</div>

<script>

		function proses(){
			var tgl_awal = document.getElementById('th_awal').value;
			var tgl_akhir = document.getElementById('th_akhir').value;

			if(tgl_awal === ""){
				alert("Tahun awal tidak boleh kosong");
			}else if(tgl_akhir === ""){
				alert("Tahun akhir tidak boleh kosong");
			}else{
				window.location.href = "?t1=" + tgl_awal + "&t2=" + tgl_akhir;
			}
		}

		// chart 1
		var ctx1 = document.getElementById("myChart1").getContext('2d');
		var myChart1 = new Chart(ctx1, {
			type: 'bar',
			data: {
				labels: [<?php echo $temp_tahun2; ?>],
				datasets: [
					<?php
					$data_diterima = array();
					$data_ditolak = array();

					for($i=$tahun_awal; $i <= $tahun_akhir; $i++){
						// cek tahun available
						$q_tahun_a = mysqli_query($koneksi, "select count(idtahun) as jml from tahun where nama_tahun = '".$i."';");
						$jml_tahun = mysqli_fetch_array($q_tahun_a)['jml'];

						if($jml_tahun > 0){
							// mencari tahun
							$q_tahun = mysqli_query($koneksi, "select idtahun from tahun where nama_tahun = '".$i."';");
							$idtahun = mysqli_fetch_array($q_tahun)['idtahun'];

							// diterima
							$q_diterima = mysqli_query($koneksi, "SELECT count(*) as jml FROM tb_terima where idtahun = '".$idtahun."';");
							$jml_diterima = mysqli_fetch_array($q_diterima)['jml'];

							// ditolak	
							$q_ditolak = mysqli_query($koneksi, "SELECT count(*) as jml FROM tb_tolak where idtahun = '".$idtahun."';");
							$jml_ditolak = mysqli_fetch_array($q_ditolak)['jml'];

							// masuk ke array diterima
							array_push($data_diterima, $jml_diterima);

							// masuk ke array ditolak
							array_push($data_ditolak, $jml_ditolak);

						}else{
							// masuk ke array diterima
							array_push($data_diterima, 0);

							// masuk ke array ditolak
							array_push($data_ditolak, 0);

						}
					}

					$temp_terima1 = substr(json_encode($data_diterima), 1, strlen(json_encode($data_diterima)));
					$temp_terima2 = substr($temp_terima1, 0, strlen($temp_terima1)-1);

					$temp_tolak1 = substr(json_encode($data_ditolak), 1, strlen(json_encode($data_ditolak)));
					$temp_tolak2 = substr($temp_tolak1, 0, strlen($temp_tolak1)-1);

					?>
					{
						label: 'Diterima',
						data: [<?php echo $temp_terima2; ?>],
						backgroundColor: 'rgba(255, 99, 132, 0.2)',
						borderColor: 'rgba(255,99,132,1)',
						borderWidth: 1
					},
					{
						label: 'Ditolak',
						data: [<?php echo $temp_tolak2; ?>],
						backgroundColor: 'rgba(54, 162, 235, 0.2)',
						borderColor: 'rgba(54, 162, 235, 1)',
						borderWidth: 1
					}
			]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});

</script>




