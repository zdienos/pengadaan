<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2><?php echo $button ?> Data Perusahaan </h2>
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
            <?php if($this->session->userdata('stat')=="Admin"){?>
            <?php echo cmb_dinamis('id_user','user','username','id_user'); ?>
            <?php }else if($this->session->userdata('stat')=="Peserta Lelang"){?>
            <input type="text" class="form-control" name="id_user" id="id_user" readonly value="<?php echo $this->session->userdata('id_user'); ?>" />
            <?php } ?>
        </div>
        <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>
        <?php if ($this->session->userdata('stat')=="Peserta Lelang") { ?>
        <div class="form-group">
            <label for="varchar"><?php echo form_error('status') ?></label>
            <input type="hidden" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar"><?php echo form_error('keterangan') ?></label>
            <input type="hidden" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
        </div>
        <?php }else{ ?>
         <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label>
            <select class="form-control" name="status" id="status">
                <option value="Belum divalidasi">Belum divalidasi</option>
                <option value="Valid">Valid</option>
                <option value="Data ada yang kurang">Data ada yang kurang</option>
                <option value="Blacklist">Blacklist</option>
            </select>
            <!--<input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />-->
        </div>
        <div class="form-group">
            <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
        </div>
        <?php } ?>
        <input type="hidden" name="id_perusahaan" value="<?php echo $id_perusahaan; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('perusahaan') ?>" class="btn btn-default">Cancel</a>
    </form><?php $this->load->view('templates/footer');?>