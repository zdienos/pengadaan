<?php $this->load->view('templates/header');?>
        <div class="row" style="margin-bottom: 20px; background: #76AFD0" >
            <div class="row" style="margin-bottom: 20px;">
                <h2 style="text-align: center; color: white">SELAMAT DATANG</h2>
                <h3 style="text-align: center; color: white; text-transform: uppercase"><?php echo $this->session->userdata('stat'); ?></h3>
                <br>
                <center>
                <tr>
                <th><img style="width: 15%" src="http://[::1]/pengadaan/chevron.png"></th>
                <th>&nbsp &nbsp &nbsp &nbsp </th>
                <th><img style="width: 30%" src="http://[::1]/pengadaan/pcr.png"></th>
                </tr>
                </center>
                <br>
            </div>
        </div>
        <br>
<?php $this->load->view('templates/footer'); ?>