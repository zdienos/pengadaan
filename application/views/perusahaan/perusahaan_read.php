<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Perusahaan Read</h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <table class="table">
        <tr><td>Id User</td><td><?php echo $id_user; ?></td></tr>
        <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
        <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
        <tr><td>Status</td><td><?php echo $status; ?></td></tr>
        <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
        <tr><td></td><td><a href="<?php echo site_url('perusahaan') ?>" class="btn btn-default">Cancel</a></td></tr>
    </table><?php $this->load->view('templates/footer');?>