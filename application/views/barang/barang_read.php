<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Barang</h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <table class="table">
	    <tr><td>Id Perusahaan</td><td><?php echo $id_perusahaan; ?></td></tr>
	    <tr><td>Harga</td><td>Rp. <?php echo  number_format($harga,0,".","."); ?></td></tr>
	    <tr><td>Estimasi</td><td><?php echo $estimasi; ?> Minggu</td></tr>
	    <tr><td>Tkdn</td><td><?php echo $tkdn; ?> %</td></tr>
	    <tr><td>Spesifikasi</td><td><?php echo $spesifikasi; ?> ShoreA</td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table><?php $this->load->view('templates/footer');?>