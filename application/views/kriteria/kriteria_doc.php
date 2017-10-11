<!doctype html>
<html>
    <head>
        <title>SOCIANOVATION - Web Administration</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Kriteria List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Perusahaan</th>
		<th>Id User</th>
		<th>Kriteria1</th>
		<th>Kriteria2</th>
		<th>Kriteria3</th>
		<th>Kriteria4</th>
		
            </tr><?php
            foreach ($kriteria_data as $kriteria)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kriteria->id_perusahaan ?></td>
		      <td><?php echo $kriteria->id_user ?></td>
		      <td><?php echo $kriteria->kriteria1 ?></td>
		      <td><?php echo $kriteria->kriteria2 ?></td>
		      <td><?php echo $kriteria->kriteria3 ?></td>
		      <td><?php echo $kriteria->kriteria4 ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>