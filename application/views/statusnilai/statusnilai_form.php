<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Statusnilai <?php echo $button ?></h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Jenis Lelang <?php echo form_error('jenis_lelang') ?></label>
            <input type="text" class="form-control" name="jenis_lelang" id="jenis_lelang" placeholder="Jenis Lelang" value="<?php echo $jenis_lelang; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Estimasi <?php echo form_error('estimasi') ?></label>
            <input type="text" class="form-control" name="estimasi" id="estimasi" placeholder="Estimasi" value="<?php echo $estimasi; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tkdn <?php echo form_error('tkdn') ?></label>
            <input type="text" class="form-control" name="tkdn" id="tkdn" placeholder="Tkdn" value="<?php echo $tkdn; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Spesifikasi <?php echo form_error('spesifikasi') ?></label>
            <input type="text" class="form-control" name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi" value="<?php echo $spesifikasi; ?>" />
        </div>
	    <input type="hidden" name="id_statusnilai" value="<?php echo $id_statusnilai; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('statusnilai') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>