<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Pengumuman Lelang</h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <table class="table">
	    <?php if ($this->session->userdata('stat')=="Admin" || $this->session->userdata('stat')=="Staff Pengadaan") { ?>
        <tr><td>Id User</td><td><?php echo $id_user; ?></td></tr>
        <?php } ?>
	    <tr><td>Jenis Lelang</td><td><?php echo $jenis_lelang; ?></td></tr>
        <tr><td>Judul Pelelangan </td><td><?php echo $judul_pengumuman; ?></td></tr>
        <tr><td>Rincian Singkat</td><td><pre><?php echo $isi_pengumuman; ?></pre></td></tr>
	    <tr><td>Tanggal Berakhir</td><td><?php echo $tanggal; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pengumuman') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table><?php $this->load->view('templates/footer');?>