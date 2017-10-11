<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2><?php echo $button ?> Pengumuman</h2>
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
            <input type="text" class="form-control" name="id_user" id="id_user" readonly value="<?php echo $this->session->userdata('id_user'); ?>" />
        </div>
        <div class="form-group">
            <label for="int">Jenis Lelang<?php echo form_error('jenis_lelang') ?></label>
            <select class="form-control" name="jenis_lelang" id="jenis_lelang">
                <option value="Pipa">Pipa</option>
                <option value="Mesin">Mesin</option>
                <option value="Pompa">Pompa</option>
                <option value="Seal Pipa">Seal Pipa</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            <!--<input type="text" class="form-control" name="jenis_lelang" id="jenis_lelang" readonly value="<?php echo $this->session->userdata('jenis_lelang'); ?>" />-->
        </div>
	    <div class="form-group">
            <label for="judul_pengumuman">Judul Pengumuman <?php echo form_error('judul_pengumuman') ?></label>
            <textarea class="form-control" rows="3" name="judul_pengumuman" id="judul_pengumuman" placeholder="Judul Pengumuman"><?php echo $judul_pengumuman; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="isi_pengumuman">Isi Pengumuman <?php echo form_error('isi_pengumuman') ?></label>
            <textarea class="form-control" rows="3" name="isi_pengumuman" id="isi_pengumuman" placeholder="Isi Pengumuman"><?php echo $isi_pengumuman; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('tanggal') ?></label>
            <input type="date" class="form-control" name="tanggal" min="<?php echo date('Y-m-d',strtotime('+7 days')); ?>" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
        </div>
        <div class="form-group">
            <label for="spek_item">Nilai Permintaan Spesifikasi Item<?php echo form_error('spek_item') ?></label>
            <textarea class="form-control" rows="3" name="spek_item" id="spek_item" placeholder="Nilai Item"><?php echo $spek_item; ?></textarea>
        </div>
        <div class="form-group">
            <label for="est_item">Nilai Permintaan Estimasi Item (Minggu) <?php echo form_error('est_item') ?></label>
            <textarea class="form-control" rows="3" name="est_item" id="est_item" placeholder="Minggu"><?php echo $est_item; ?></textarea>
        </div>
        <div class="form-group">
            <label for="tkdn_item">Nilai Permintaan TKDN Item (%) <?php echo form_error('tkdn_item') ?></label>
            <textarea class="form-control" rows="3" name="tkdn_item" id="tkdn_item" placeholder="%"><?php echo $tkdn_item; ?></textarea>
        </div>
	    <input type="hidden" name="id_pengumuman" value="<?php echo $id_pengumuman; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pengumuman') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>