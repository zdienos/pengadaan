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
                <!--
                <a href="http://[::1]/pengadaan/downup" class="btn btn-danger">Kelengkapan Kualifikasi</a>
                -->
        </div></div>
        </div>
        <?php if ($this->session->userdata('stat')=="Peserta Lelang") { ?>
        <table class="table table-bordered table-striped" id="mytable">
        <pre>
            Silahkan Masukan File Kelengkapan untuk Proses Kualifikasi kedalam Satu Folder Zip/Rar yang Berisikan :
            1. Salinan Akte Pendirian
            2. Salinan Surat Keterangan Domisili
            3. Salinan Surat Izin Usaha (Seperti: SIUP, SIUPAL, SIOPSUS, SIUJK dan TDP)
            4. Surat Keterangan Terdaftar
            5. Salinan sertifikat TKDN yang diterbitkan oleh Instansi Pemerintah yang membawahi bidang perindustrian
        </pre>    
                <?php echo $error;?>

                <?php echo form_open_multipart('upload/do_upload');?>

                <input type="file" name="userfile" size="20" />

                <br />

                <input class="btn btn-primary" type="submit" value="UPLOAD" />
                
                </form>
                <nbsp>
                <a href="http://[::1]/pengadaan/downup" class="btn btn-warning">BATAL</a>
            	</table><?php } ?>
        <?php $this->load->view('templates/footer'); ?>
        

        