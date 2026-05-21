<div class="card card-secondary">
	<div class="card-header" style ="cursor:pointer">
		<h3 class="card-title" onClick= "sim()">
			<i class="fa fa-table"></i> Tabel Kecocokan
        </h3>
	</div>
	<div class="card-body">
        <input type="hidden" id="tahun" value="<?php echo $_GET['tahun']?>">
		<div class="table-responsive" id="mk">
            <?php
            mysqli_query($koneksi, "delete from nilai where idtahun = '".$_GET['tahun']."';");

            // mengetahui jumlah kriteria
            $q_jml_kri = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM kriteria;");
            $jml_kri = mysqli_fetch_array($q_jml_kri)['jml'];
            ?>
			<table class="table table-warning table-hover">
				<thead>
					<tr>
                        <th style="text-align:center;" rowspan="2">Alternatif</th>
						<th style="text-align:center;" colspan="<?php echo $jml_kri; ?>">Kriteria</th>
					</tr>
                    <tr>
                        <?php
                        $no = 1;
                        $q_kri = mysqli_query($koneksi, "SELECT * FROM kriteria where idtahun = '".$_GET['tahun']."';");
                        while ($row = mysqli_fetch_array($q_kri)) {
                            ?>
                        <th style="text-align:center;"><?php echo "C".$no; ?></th>
                            <?php
                            $no++;
                        }
                        ?>              
					</tr>
				</thead>
				<tbody>
					<?php
                    $tahun = $_GET['tahun'];
                    $no = 1;
                    $q_penerima = mysqli_query($koneksi, "SELECT DISTINCT(a.id_penerima) as idpenerima, b.nama_penerima FROM alter_detil a, penerima b, alter_head c WHERE a.id_penerima = b.id_penerima AND a.kd_alternatif = c.kd_alternatif AND c.idtahun = '".$tahun."'");
                    while ($row_penerima = mysqli_fetch_array($q_penerima)) {
                        $kd_alter = "A".$no;
                        // insert tenporary table
                        mysqli_query($koneksi, "INSERT INTO nilai (kd_alter, id_penerima, nama_penerima, idtahun, nilai) VALUES ('"
                            .$kd_alter."','".$row_penerima['idpenerima']."','".$row_penerima['nama_penerima']."','".$tahun."','')");

                        ?>
                    <tr>
                        <td style="text-align:center;"><?php echo "A".$no.' ('.$row_penerima['nama_penerima'].') '; ?></td>
                        <?php
                        $q_kri = mysqli_query($koneksi, "SELECT * FROM kriteria where idtahun = '".$_GET['tahun']."';");
                        
                        while ($rowkri = mysqli_fetch_array($q_kri)) {
                            $nilai_kri = mysqli_query($koneksi, "SELECT * FROM nilaikriteria WHERE idkriteria = '".$rowkri['idkriteria']."';");
								if (mysqli_num_rows($nilai_kri)==0) {
                                    $q_nilai = mysqli_query($koneksi, "SELECT kdnilai FROM alter_detil ad where id_penerima = '".$row_penerima['idpenerima']."' and idkriteria = '".$rowkri['idkriteria']."' and kd_alternatif = (select DISTINCT (d.kd_alternatif) from alter_detil d join alter_head h on d.kd_alternatif = h.kd_alternatif where idtahun = '".$_GET['tahun']."' and id_penerima = '".$row_penerima['idpenerima']."')");
                                    $nilai = mysqli_fetch_array($q_nilai)['kdnilai'];
                                }
                                else{
                                    $q_nilai = mysqli_query($koneksi, "SELECT b.nilai FROM alter_detil a, nilaikriteria b WHERE a.idkriteria = '".$rowkri['idkriteria']."' AND a.id_penerima = '".$row_penerima['idpenerima']."' AND a.kdnilai = b.kdnilai");
                                    $nilai = mysqli_fetch_array($q_nilai)['nilai'];
                                }
                            ?>
                        <td style="text-align:center;"><?php echo $nilai; ?></td>
                            <?php
                            
                        }
                        ?>
                    </tr>
                        <?php
                        $no++;
                    }
                    ?>
                </tbody>
			</table>
		</div>
	</div>
</div>

<script>
    function sim(){
        var x = document.getElementById("mk");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
    
    <tr></tr>

<div class="card card-secondary">
	<div class="card-header" style ="cursor:pointer">
		<h3 class="card-title" onClick= "hide()">
			<i class="fa fa-table"></i> Matrik Normalisasi</h3>
	</div>
	<div class="card-body">
		<div class="table-responsive" id="mn">
            <?php
            
            $arr1 = array();
            $baris = 0;
            
            $q_penerima = mysqli_query($koneksi, "SELECT DISTINCT(id_penerima) as idpenerima FROM alter_detil a, alter_head b WHERE a.kd_alternatif = b.kd_alternatif AND b.idtahun = '".$tahun."';");
            while ($row_penerima = mysqli_fetch_array($q_penerima)) {
                $kolom = 0;
                $q_kri = mysqli_query($koneksi, "SELECT * FROM kriteria where idtahun = '".$_GET['tahun']."' ORDER BY idkriteria");
                while ($rowkri = mysqli_fetch_array($q_kri)) {

                    $cost_benefit = $rowkri['atribut'];

                    // $q_nilai = mysqli_query($koneksi, "SELECT b.nilai FROM alter_detil a, nilaikriteria b 
                    //     WHERE a.idkriteria = '".$rowkri['idkriteria']."' AND a.id_penerima = '".$row_penerima['idpenerima']."' AND a.kdnilai = b.kdnilai");
                    // $nilai = mysqli_fetch_array($q_nilai)['kdnilai'];

                    $nilai_kri = mysqli_query($koneksi, "SELECT * FROM nilaikriteria WHERE idkriteria = '".$rowkri['idkriteria']."';");
                    if (mysqli_num_rows($nilai_kri)==0) {
                        $q_nilai = mysqli_query($koneksi, "SELECT kdnilai FROM alter_detil ad where id_penerima = '".$row_penerima['idpenerima']."' and idkriteria = '".$rowkri['idkriteria']."' and kd_alternatif = (select DISTINCT (d.kd_alternatif) from alter_detil d join alter_head h on d.kd_alternatif = h.kd_alternatif where idtahun = '".$_GET['tahun']."' and id_penerima = '".$row_penerima['idpenerima']."')");
                        $nilai = mysqli_fetch_array($q_nilai)['kdnilai'];
                    }
                    else{
                        $q_nilai = mysqli_query($koneksi, "SELECT b.nilai FROM alter_detil a, nilaikriteria b WHERE a.idkriteria = '".$rowkri['idkriteria']."' AND a.id_penerima = '".$row_penerima['idpenerima']."' AND a.kdnilai = b.kdnilai");
                        $nilai = mysqli_fetch_array($q_nilai)['nilai'];
                    }

                    if($cost_benefit == "Benefit"){
                        $q_nilai_max = mysqli_query($koneksi, "SELECT max(b.nilai) as maksimal FROM alter_detil a, nilaikriteria b 
                            WHERE a.idkriteria = '".$rowkri['idkriteria']."' AND a.kdnilai = b.kdnilai");
                        $nilai_max = mysqli_fetch_array($q_nilai_max)['maksimal'];

                        if($nilai_max == 0){
                            $hasil = 0;
                        }else{
                            $hasil = $nilai / $nilai_max;
                        }
                        

                        $arr1[$baris][$kolom] = round($hasil,2);

                    }else if($cost_benefit == "Cost"){
                        
                        // yang dipilih yang kecil
                        $q_nilai_min = mysqli_query($koneksi, "SELECT min(b.nilai) as minimal FROM alter_detil a, nilaikriteria b 
                            WHERE a.idkriteria = '".$rowkri['idkriteria']."' AND a.kdnilai = b.kdnilai");
                        $nilai_min = mysqli_fetch_array($q_nilai_min)['minimal'];

                        if($nilai == 0){
                            $arr1[$baris][$kolom] = 0;
                        }else{
                            $hasil = $nilai_min / $nilai;
                            $arr1[$baris][$kolom] = round($hasil,2);
                        }
                        
                    }

                    $kolom++;
                }
                $baris++;
            }

            ?>
			<table class="table table-warning table-hover">
				<tbody>
                    <?php
                    for ($i=0; $i < $baris; $i++) { 
                        ?>
                    <tr>
                        <?php
                        for ($j=0; $j < $kolom; $j++) { 
                            ?>
                        <td style="text-align:center;"><?php echo $arr1[$i][$j]; ?></td>
                            <?php
                        }
                        ?>
                    </tr>
                        <?php
                    }
                    ?>       
                </tbody>
			</table>
		</div>
	</div>
</div>
<script>
    function hide(){
        var x = document.getElementById("mn");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

<tr></tr>

<div class="card card-secondary">
	<div class="card-header">
        <div class="row">
            <div class="col align-self-center">
                <h3 class="card-title">
                    <i class="fa fa-table"></i> Tabel Rekomendasi Penerima
                </h3>
            </div>
            <div class="col" align = "right">
                <select name="quota" id="quota" class="form-control col-md-6 " required onchange="loaddata();">
                    <option value="-">Pilih Kuota</option>
                    <?php
                    // ambil data dari database
                    $squery = "select kuota from tahun where idtahun = '".$_GET['tahun']."';";
                    $query = mysqli_query($koneksi, $squery);
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                    <option value="<?php echo $row['kuota']; ?>"><?php echo $row['kuota']; ?></option>
                        <?php
                    }
                    ?>
                    <option value="all">All</option>
                </select>
            </div>
        </div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
            <?php
            $data_bobot = array();
            $q_bobot = mysqli_query($koneksi, "SELECT b.bobot FROM kriteria a, bobot b WHERE a.idkriteria = b.idkriteria and a.idtahun = '".$_GET['tahun']."' ORDER BY a.idkriteria");
            while ($row_bobot = mysqli_fetch_array($q_bobot)) {
                array_push($data_bobot, $row_bobot['bobot']);
            }
            ?>
            <table class="table table-warning table-hover">
				<tbody>
                <?php

                $arr_sort1 = array();
                $arr_sort2 = array();

                $alternatif_counter = 1;
                for ($i=0; $i < $baris; $i++) { 
                    $format = '';
                    $format1 = '';

                    for ($j=0; $j < $kolom; $j++) { 
                        $format .= "(" . $data_bobot[$j] . " X " . $arr1[$i][$j] . ") ";
                        
                        $format1 .= "(" . $data_bobot[$j] . " * " . $arr1[$i][$j] . ") ";

                        if($j == $kolom - 1){
                            $format .= " = ";
                        }else{
                            $format .= " + ";
                            $format1 .= " + ";
                        }
                        
                    }
                    
                    $p = eval('return '.$format1.';');

                    $kodealter = "A".$alternatif_counter;

                    // echo "A".$alternatif_counter . " => " ;
                    // echo $format;
                    // echo $p;

                    // syntax update
                    mysqli_query($koneksi, "UPDATE nilai SET nilai = '".$p."' WHERE kd_alter = '".$kodealter."' AND idtahun = '".$_GET['tahun']."';");

                    $arr_sort1[$alternatif_counter] = "A".$alternatif_counter;
                    $arr_sort2[$alternatif_counter] = $p;

                    $alternatif_counter++;

                    // echo '<br>';
                }

                ?> 

            <table class="table table-warning table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" onchange="checkAll(this)"></th>
                    <th>No</th>
                    <th>Alternatif </th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Dusun</th>
                    <th>Nilai</th>
                </tr>
            </thead>
				<tbody>
                    
                    <?php
                    if (isset($_GET['quota'])) {
                        $quota = $_GET['quota'];
                        if($quota == "-"){
                            $q = "select a.kd_alter, a.id_penerima, a.nama_penerima, b.asal, a.nilai from nilai a, penerima b where a.id_penerima = b.id_penerima and idtahun = '".$tahun."' order by nilai desc";
                        }else if($quota == "all"){
                            $q = "select a.kd_alter, a.id_penerima, a.nama_penerima, b.asal, a.nilai from nilai a, penerima b where a.id_penerima = b.id_penerima and idtahun = '".$tahun."' order by nilai desc";    
                        }else{
                            $q = "select a.kd_alter, a.id_penerima, a.nama_penerima, b.asal, a.nilai from nilai a, penerima b where a.id_penerima = b.id_penerima and idtahun = '".$tahun."' order by nilai desc limit ".$quota;
                        }
                    }else{
                        $q = "select a.kd_alter, a.id_penerima, a.nama_penerima, b.asal, a.nilai from nilai a, penerima b where a.id_penerima = b.id_penerima and idtahun = '".$tahun."' order by nilai desc";
                    }
                    
                    //echo $q;
                    
                    // isi baca dr database
                    // $q_kuota = mysqli_query($koneksi, "select kuota from tahun where idtahun = '".$tahun."';");
                    // $kut = mysqli_fetch_array($q_kuota);

                    // $total_diterima = $kut['kuota'];
                    $nomor = 0;
                    $q_sort = mysqli_query($koneksi, $q);
                    while ($row_sort = mysqli_fetch_array($q_sort)) {
                        ?>
                        <tr>
                    <td>
                        <div class="col-sm-6">
                            <label><input type="checkbox" name="atribut[]" value="<?php echo $tahun.'-'.$row_sort['id_penerima'].'-'.$row_sort['nilai']; ?>"></label>
                        </div>
                    </td>
                    <td><?php echo $nomor=$nomor+1; ?></td>
                    <td style="margin-left: 30px;"><?php echo $row_sort['kd_alter']; ?></td>
                    <td style="margin-left: 30px;"><?php echo $row_sort['id_penerima']; ?></td>
                    <td style="margin-left: 30px;"><?php echo $row_sort['nama_penerima']; ?></td>
                    <td style="margin-left: 30px;"><?php echo $row_sort['asal']; ?></td>
                    <td style="margin-left: 30px;"><?php echo $row_sort['nilai']; ?></td>
                    </tr>
                        <?php
                    }                    
                    ?>  
                      
                </tbody>
                
			</table>
                <div>
				    <button class="btn btn-primary" onclick="proses();"><i class="fa fa-save"></i> Simpan Penerima</button>
			    </div>
                </tbody>
			</table>
		</div>
	</div>
</div>

<script>

    function proses(){
        var checkboxes = document.getElementsByName('atribut[]');
        var checkboxesChecked = [];
        
        for (var i=0; i<checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checkboxesChecked.push(checkboxes[i]);
            }
        }

        if(checkboxesChecked.length > 0){
            var selected = Array.from(checkboxesChecked).map(x => x.value)
            console.log(selected);

            var form_data = new FormData();
            form_data.append('selected', selected);

            $.ajax({
                url: "admin/rangking/simpanpenerima.php",
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (response) {
                    
                    alert(response.status);

                },error: function (response) {

                    alert(response.status);
                }
            });

        }else{
            alert("Minimal 1 Calon penerima terpilih");
        }
    }

    function checkAll(ele) {
       var checkboxes = document.getElementsByName('atribut[]');
       if (ele.checked) {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox' ) {
                   checkboxes[i].checked = true;
               }
           }
       } else {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox') {
                   checkboxes[i].checked = false;
               }
           }
       }
    }

    function loaddata(){
        var tahun = document.getElementById('tahun').value;
        var quota = document.getElementById('quota').value;
		window.location.href = "index.php?page=rangking&tahun="+tahun + "&quota="+quota;
    }

</script>