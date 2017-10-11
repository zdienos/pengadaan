<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Bobot Kriteria </h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <form action="" method="post">
	    <div class="form-group">
            <label for="int">Harga <?php echo form_error('harga') ?></label>
            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" />
        </div>
	    <div class="form-group">
            <label for="int">Estimasi <?php echo form_error('estimasi') ?></label>
            <input type="text" class="form-control" name="estimasi" id="estimasi" placeholder="Estimasi" />
        </div>
	    <div class="form-group">
            <label for="int">Tkdn <?php echo form_error('tkdn') ?></label>
            <input type="text" class="form-control" name="tkdn" id="tkdn" placeholder="Tkdn" />
        </div>
	    <div class="form-group">
            <label for="int">Spesifikasi <?php echo form_error('spesifikasi') ?></label>
            <input type="text" class="form-control" name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi"  />
        </div>
	    <button type="submit" name="submit" class="btn btn-primary">Proses</button> 
	    <a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a>
	</form>

<?php 
  $i=1;
  $i2=1;
  $i3=1;
 echo "<H3>Nilai Alternatif disetiap Kriteria</H3>
 <table width=500 style='border:1px; border-color: #636060; background-color: #c7c7c7; solid; border-collapse:collapse' border=1>
  <tr>
   <td>No</td>
   <td>Nama</td>
   <td>C1</td>
   <td>C2</td>
   <td>C3</td>
   <td>C4</td>
  </tr>
  ";
        foreach ($data_kriteria as $row)
        {
            $jumlah=$row->kriteria1+$row->kriteria2+$row->kriteria3+$row->kriteria4;
        echo "<tr>
   <td>$i</td>
   <td>".$row->nama."</td>
   <td>".$row->kriteria1."</td>
   <td>".$row->kriteria2."</td>
   <td>".$row->kriteria3."</td>
   <td>".$row->kriteria4."</td>
  </tr>";

       $i++;
        }
 echo "</table><H3>Hasil Normalisasi</H3>
 <table width=500 style='border:1px; border-color: #636060; background-color: #c7c7c7; solid; border-collapse:collapse' border=1>
  <tr>
   <td>No</td>
   <td>Nama</td>
   <td>C1</td>
   <td>C2</td>
   <td>C3</td>
   <td>C4</td>
   </tr>
  ";
         foreach ($data_kriteria as $row)
        {
            $jumlah=$row->kriteria1+$row->kriteria2+$row->kriteria3+$row->kriteria4;

        echo "<tr>
   <td>$i2</td>
   <td>".$row->nama."</td>
   <td>".round($data_minskriteria[0]->maxK1/$row->kriteria1,2)."</td>
   <td>".round($row->kriteria2/$data_makskriteria[0]->maxK2,2)."</td>
   <td>".round($data_minskriteria[0]->maxK3/$row->kriteria3,2)."</td>
   <td>".round($row->kriteria4/$data_makskriteria[0]->maxK4,2)."</td>
  </tr>";

       $i2++;
        }
         echo "</table><H3>Hasil Pembobotan Akhir</H3>
 <table width=500 style='border:1px; border-color: #636060; background-color: #c7c7c7; solid; border-collapse:collapse' border=1>
  <tr>
   <td>No</td>
   <td>Nama</td>
   <td>C1</td>
   <td>C2</td>
   <td>C3</td>
   <td>C4</td>
   <td>Nilai</td>
  </tr>
  ";
        $c1=array();
        $c2=array();
        $c3=array();
        $c4=array();
        $j=0;
        $i3=1;
         foreach ($data_kriteria as $row)
        {
            $jumlah=$row->kriteria1+$row->kriteria2+$row->kriteria3+$row->kriteria4;
        echo "<tr>
   <td>$i3</td>
   <td>".$row->nama."</td>
   <td>".round($data_minskriteria[0]->maxK1/$row->kriteria1,2)*$bobot[0]."</td>
   <td>".round($row->kriteria2/$data_makskriteria[0]->maxK2,2)*$bobot[1]."</td>
   <td>".round($data_minskriteria[0]->maxK3/$row->kriteria3,2)*$bobot[2]."</td>
   <td>".round($row->kriteria4/$data_makskriteria[0]->maxK4,2)*$bobot[3]."</td>
  </tr>";
    $c1[$j]=round($data_minskriteria[0]->maxK1/$row->kriteria1,2)*$bobot[0];
    $c2[$j]=round($row->kriteria2/$data_makskriteria[0]->maxK2,2)*$bobot[1];
    $c3[$j]=round($data_minskriteria[0]->maxK3/$row->kriteria3,2)*$bobot[2];
    $c4[$j]=round($row->kriteria4/$data_makskriteria[0]->maxK4,2)*$bobot[3];
       $j++;
       $i3++;
        }
         echo "</table><H3>Total Bobot Akhir</H3>";
//Baris Untuk Menghitungn Total Kriteria
  echo $c1[0]+$c2[0]+$c3[0]+$c4[0]; echo "<br>";

  echo $c1[1]+$c2[1]+$c3[1]+$c4[1]; echo "<br>";
  
  echo $c1[2]+$c2[2]+$c3[2]+$c4[2]; echo "<br>";
  
  echo $c1[3]+$c2[3]+$c3[3]+$c4[3]; echo "<br>";
   foreach ($data_kriteria as $i => $row)
        {
            $b=$c1[$i]+$c2[$i]+$c3[$i]+$c4[$i];
            //echo $b;
            $this->Kriteria_model->insert_nilai($row->id_perusahaan,$b);
        }     
  echo "<br>";    
/*
echo"
 <table width=500 style='border:1px; #ddd; solid; border-collapse:collapse' border=1>
  <tr>
   <td>No</td>
   <td>Nama</td>
   <td>C1</td>
   <td>C2</td>
   <td>C3</td>
   <td>C4</td>
   <td>jumlah poin</td>
  </tr>
  ";*/
  
        //echo $simpan_data[1]['k1'];
 /* $d1p= round(sqrt((pow($c1[0]-max($c1),2)+pow($c2[0]-max($c2),2)+pow($c3[0]-max($c3),2)+pow($c4[0]-max($c4),2)+pow($c5[0]-max($c5),2))),2)."<br>";
  $d2p=  round(sqrt((pow($c1[1]-max($c1),2)+pow($c2[1]-max($c2),2)+pow($c3[1]-max($c3),2)+pow($c4[1]-max($c4),2)+pow($c5[1]-max($c5),2))),2)."<br>";
   $d3p=  round(sqrt((pow($c1[2]-max($c1),2)+pow($c2[2]-max($c2),2)+pow($c3[2]-max($c3),2)+pow($c4[2]-max($c4),2)+pow($c5[2]-max($c5),2))),2)."<br>";
  
  $d1m=  round(sqrt((pow($c1[0]-min($c1),2)+pow($c2[0]-min($c2),2)+pow($c3[0]-min($c3),2)+pow($c4[0]-min($c4),2)+pow($c5[0]-min($c5),2))),2)."<br>";
  $d2m=  round(sqrt((pow($c1[1]-min($c1),2)+pow($c2[1]-min($c2),2)+pow($c3[1]-min($c3),2)+pow($c4[1]-min($c4),2)+pow($c5[1]-min($c5),2))),2)."<br>";
   $d3m=  round(sqrt((pow($c1[2]-min($c1),2)+pow($c2[2]-min($c2),2)+pow($c3[2]-min($c3),2)+pow($c4[2]-min($c4),2)+pow($c5[2]-min($c5),2))),2)."<br>";

   $v1= round($d1m/($d1m+$d1p),2);
   $v2= round($d2m/($d2m+$d2p),2);
   $v3= round($d3m/($d3m+$d3p),2);
   echo "V1 : ".$v1." V2 : ".$v2." V3 : ".$v3;*/

       //echo "</table>";
        //print_r($c1);print_r($c2);print_r($c3);print_r($c4);print_r($c5);
    //print_r($data_kriteria);
      /*  // nama tabel
        $table = 'kriteria';
        // nama PK
        $primaryKey = 'id_kriteria';
        // list field
        $columns = array(
            array('db' => 'id_kriteria', 'dt' => 'id_kriteria'),
            array('db' => 'id_user', 'dt' => 'id_user'),
            array('db' => 'id_bibit', 'dt' => 'id_bibit'),
            array('db' => 'keterangan', 'dt' => 'keterangan'),
            array('db' => 'bobot', 'dt' => 'bobot')        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );

        $data= json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
        $json = json_decode($data, true);
        print_r($json['data']);
        //$x=array();
        for ($i=1; $i <=3; $i++) { 
            if ($json['data'][$i]['id_bibit']==$i) {
                $x[$i]['bobotx']=$json['data'][$i]['bobot'];
            }
           
        }
        print_r($x);*/
 ?>
    <?php $this->load->view('templates/footer');?>