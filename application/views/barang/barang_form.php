<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 75%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>

<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2><?php echo $button ?> Barang</h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <!--Info Bantuan-->
            <div class="col-md-8 text-right">
                <!--<button class="btn btn-primary" id="myBtn">Info Bantuan</button>-->
            </div>    
            <!-- The Modal -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h3><center>Panduan Cara Menginputkan Data Barang</center></h3>

                </div>
            </div>
            <!--Info Bantuan-->
        </div>

<!-- Trigger/Open The Modal -->


<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>



    <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Perusahaan <?php echo form_error('id_perusahaan') ?></label>
            <?php if($this->session->userdata('stat')=="Admin"){?>
            <?php echo cmb_dinamis('id_perusahaan','perusahaan','nama','id_perusahaan'); ?>
            <?php }else if($this->session->userdata('stat')=="Peserta Lelang"){?>
            <input type="number" class="form-control" name="id_perusahaan" id="id_perusahaan" readonly value="<?php echo $id_perusahaan ?>" />
            <?php } ?>
        </div>
        <div class="form-group">
            <label for="int">Jenis Lelang<?php echo form_error('jenis_lelang') ?></label>
            <?php echo cmb_dinamis('jenis_lelang','pengumuman','jenis_lelang','jenis_lelang'); ?>
        </div>
	    <div class="form-group">
            <label for="int">Total Harga Penawaran<?php echo form_error('harga') ?></label>
            <input type="number" class="form-control" name="harga" id="harga" placeholder="Rupiah" value="<?php echo $harga; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Estimasi Kedatangan Barang <?php echo form_error('estimasi') ?></label>
            <input type="number" class="form-control" name="estimasi" id="estimasi" placeholder="Minggu" value="<?php echo $estimasi; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Tingkat Komponen Dalam Negeri (TKDN) <?php echo form_error('tkdn') ?></label>
            <input type="number" class="form-control" step="0.01" name="tkdn" id="tkdn" placeholder="%" value="<?php echo $tkdn; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Nilai Spesifikasi Item Yang Ditawarkan<?php echo form_error('spesifikasi') ?></label>
            <input type="number" class="form-control" name="spesifikasi" id="spesifikasi" placeholder="Sesuai Permintaan" value="<?php echo $spesifikasi; ?>" />
        </div>
	    <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('barang') ?>" class="btn btn-default">Batal</a>

	</form><?php $this->load->view('templates/footer');?>