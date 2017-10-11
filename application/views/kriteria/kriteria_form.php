<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2><?php echo $button ?> Kriteria</h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Perusahaan <?php echo form_error('id_perusahaan') ?></label>
            <?php echo cmb_dinamis('id_perusahaan','perusahaan','nama','id_perusahaan'); ?>
            <!--<input type="text" class="form-control" name="id_perusahaan" id="id_perusahaan" readonly value="<?php echo $this->session->userdata('id_user'); ?>"/>
            -->
        </div>
	    <div class="form-group">
            <label for="int">Id User <?php echo form_error('id_user') ?></label>
            <input type="text" class="form-control" name="id_user" id="id_user" readonly value="<?php echo $this->session->userdata('id_user'); ?>" />
        </div>
	    <div class="form-group">
            <label for="double">C1 (HARGA)<?php echo form_error('kriteria1') ?></label>
            <input type="number" class="form-control" name="kriteria1" id="kriteria1" placeholder="Kriteria1" value="<?php echo $kriteria1; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">C2 (ESTIMASI)<?php echo form_error('kriteria2') ?></label>
            <input type="number" class="form-control" name="kriteria2" id="kriteria2" placeholder="Kriteria2" value="<?php echo $kriteria2; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">C3 (TKDN)<?php echo form_error('kriteria3') ?></label>
            <input type="number" class="form-control" step="0.01" name="kriteria3" id="kriteria3" placeholder="Kriteria3" value="<?php echo $kriteria3; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">C4 (NILAI ITEM)<?php echo form_error('kriteria4') ?></label>
            <input type="number" class="form-control" name="kriteria4" id="kriteria4" placeholder="Kriteria4" value="<?php echo $kriteria4; ?>" />
        </div>
	    <input type="hidden" name="id_kriteria" value="<?php echo $id_kriteria; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kriteria') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>