<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Statusnilai Read</h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <table class="table">
	    <tr><td>Jenis Lelang</td><td><?php echo $jenis_lelang; ?></td></tr>
	    <tr><td>Estimasi</td><td><?php echo $estimasi; ?></td></tr>
	    <tr><td>Tkdn</td><td><?php echo $tkdn; ?></td></tr>
	    <tr><td>Spesifikasi</td><td><?php echo $spesifikasi; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('statusnilai') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table><?php $this->load->view('templates/footer');?>