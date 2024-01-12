<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Tahun Anggaran </h3>
	</div>
	<div class="card-body">
        <ul class="list-group">
            <?php
            // ambil data dari database
            $q_tahun = mysqli_query($koneksi, "SELECT * FROM tahun");
            while ($row = mysqli_fetch_array($q_tahun)) {
                ?>
            <li onclick="pilih('<?php echo $row['idtahun']; ?>')" style="cursor:pointer;" class="list-group-item"><?php echo $row['nama_tahun']; ?></li>
                <?php
            }
            ?>
        </ul>
	</div>
</div>
<script>
    function pilih(tahun){
        window.location.href = "index.php?page=add-alternatif&tahun="+tahun;
    }
</script>

