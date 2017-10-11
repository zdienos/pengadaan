<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Pengumuman <?php echo $button ?></h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id User <?php echo form_error('id_user') ?></label>
            <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?php echo $id_user; ?>" />
        </div>
	    <div class="form-group">
            <label for="judul_pengumuman">Judul Pengumuman <?php echo form_error('judul_pengumuman') ?></label>
            <textarea class="form-control" rows="3" name="judul_pengumuman" id="judul_pengumuman" placeholder="Judul Pengumuman"><?php echo $judul_pengumuman; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="isi_pengumuman">Isi Pengumuman <?php echo form_error('isi_pengumuman') ?></label>
            <textarea class="form-control" rows="3" name="isi_pengumuman" id="isi_pengumuman" placeholder="Isi Pengumuman"><?php echo $isi_pengumuman; ?></textarea>
        </div>
	    <input type="hidden" name="id_pengumuman" value="<?php echo $id_pengumuman; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pengumuman') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>