<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Kriteria Read</h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <table class="table">
	    <tr><td>Id Perusahaan</td><td><?php echo $id_perusahaan; ?></td></tr>
	    <tr><td>Id User</td><td><?php echo $id_user; ?></td></tr>
	    <tr><td>Kriteria1</td><td><?php echo $kriteria1; ?></td></tr>
	    <tr><td>Kriteria2</td><td><?php echo $kriteria2; ?></td></tr>
	    <tr><td>Kriteria3</td><td><?php echo $kriteria3; ?></td></tr>
	    <tr><td>Kriteria4</td><td><?php echo $kriteria4; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('kriteria') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table><?php $this->load->view('templates/footer');?>