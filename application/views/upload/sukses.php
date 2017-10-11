<?php $this->load->view('templates/header');?>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h3>Upload Kelengkapan</h3>
            </div>
            <div class="col-md-4 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
				<div style="margin-top:20px;">
        </div></div>
        </div>
        <?php if ($this->session->userdata('stat')=="Peserta Lelang") { ?>
        <table class="table table-bordered table-striped" id="mytable">
        <h4>File Telah Berhasil diupload</h4>
        <a href="<?php echo site_url('downup') ?>" class="btn btn-primary">Kembali</a>	    
        </table><?php } ?>
        <?php $this->load->view('templates/footer'); ?>