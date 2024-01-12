<script>
	function loaddata(){
		var tahun = document.getElementById('idtahun').value;
		window.location.href = "index.php?page=tahun&tahun="+tahun;
	}
    function proses(asal){
			var thn_pil = document.getElementById('idtahun').value;

			if(thn_pil === ""){
				alert("Tahun tidak boleh kosong");
			}else{
				window.location.href = "?page=dusun&asal=" + asal + "&tahun=" + thn_pil;
			}
		}
</script>

<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Laporan Perdusun</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
        <div>
            <table id="tampil">
                <tr>
                    <td></td>
                    <td>
                        <select name="idtahun" id="idtahun" class="form-control select2bs4" required onchange="loaddata();">
                            <option value="">- Tahun -</option>
                            <?php
                            // ambil data dari database
                            $query = "select idtahun, nama_tahun from tahun order by nama_tahun asc;";
                            $hasil = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_array($hasil)) {
                                if($row['idtahun'] == $_GET['tahun']){
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
                </tr>
            </table>
			</div>
			<br>
            <table id="example1" class="table table-warning table-hover">
				<thead>
					<tr>
                        <th>No</th>
                        <th>Dusun</th>
                        <th>Diterima</th>
                        <th>Ditolak</th>
                        <th>Tahun</th>
                        <th>Detail</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                        $query = "select distinct asal from penerima;";
                        if(isset($_GET['tahun'])){
                            $query = "select distinct asal from penerima;";
                        }
                        $nomor = 1;
                        $hasil = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                            ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $row['asal']; ?></td>
                            <td>
                                <?php 
                                // menampilkan diterima
                                if(isset($_GET['tahun'])){
                                    $q_diterima = mysqli_query($koneksi, "select count(*) as jml from penerima a, tb_terima b where a.id_penerima = b.idpenerima and b.idtahun = '".$_GET['tahun']."' and a.asal = '".$row['asal']."';");
                                    $jml_diterima = mysqli_fetch_array($q_diterima)['jml'];
                                    echo $jml_diterima;
                                }else{
                                    echo "0";
                                }
                                ?>
                            </td>
                            <td>
                                <?php 
                                // menampilkan ditolak
                                if(isset($_GET['tahun'])){
                                    $q_ditolak = mysqli_query($koneksi, "select count(*) as jml from penerima a, tb_tolak b where a.id_penerima = b.idpenerima and b.idtahun = '".$_GET['tahun']."' and a.asal = '".$row['asal']."';");
                                    $jml_ditolak = mysqli_fetch_array($q_ditolak)['jml'];
                                    echo $jml_ditolak;
                                }else{
                                    echo "0";
                                }
                                ?>
                            </td>
                            <td>
                            <?php 
                                // menampilkan diterima
                                if(isset($_GET['tahun'])){
                                    if(strlen($_GET['tahun'])>0){
                                        $q_tahun = mysqli_query($koneksi, "select nama_tahun from tahun where idtahun = '".$_GET['tahun']."';");
                                        $nama_tahun = mysqli_fetch_array($q_tahun)['nama_tahun'];
                                        echo $nama_tahun;
                                    }else{
                                        echo "";    
                                    }
                                }else{
                                    echo "";
                                }
                                ?>
                            </td>
                            <td>
                                <!-- <a href="javascript:void(0);" class="btn btn-primary" onclick="proses();"><i class="fa fa-eye"></i> Detil</a> -->
                                <!-- <a href="?page=dusun" class="btn btn-primary" ><i class="fa fa-eye"></i> Detil</a> -->
                                <a href="javascript:void(0);" class="btn btn-primary" onclick="proses('<?php echo str_replace(' ','_', $row['asal']); ?>');"><i class="fa fa-eye"></i> Detil</a>
                            </td>
                        </tr>
                            <?php
                            $nomor++;
                        }
                        ?>
                </tbody>
			</table>
		</div>
	</div>