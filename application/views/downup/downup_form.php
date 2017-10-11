<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Downup <?php echo $button ?></h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama File <?php echo form_error('nama_file') ?></label>
            <input type="text" class="form-control" name="nama_file" id="nama_file" placeholder="Nama File" value="<?php echo $nama_file; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Perusahaan <?php echo form_error('id_perusahaan') ?></label>
            <input type="text" class="form-control" name="id_perusahaan" id="id_perusahaan" placeholder="Id Perusahaan" value="<?php echo $id_perusahaan; ?>" />
        </div>
	    <input type="hidden" name="no" value="<?php echo $no; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('downup') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>