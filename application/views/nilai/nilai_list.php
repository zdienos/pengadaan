<?php $this->load->view('templates/header');?>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h4>Hasil Penilaian <br> Calon Pemenang Tender <?php if (isset($_GET['jenis_lelang'])) {echo $_GET['jenis_lelang'];} ?></h4 >
                <h5>Silahkan Pilih Berdasarkan Jenis Lelang</h5>
                <form action="<?php echo site_url('nilai'); ?>">
                <label for="int" align="center"><?php echo form_error('jenis_lelang') ?>
                    <?php echo cmb_dinamis('jenis_lelang','pengumuman','jenis_lelang','jenis_lelang'); ?>
                </label>
                <input type="submit" value="Lihat Rangking" class="btn btn-primary">
                </form>                
            </div>
            <div class="col-md-4 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
				<div style="margin-top:20px;">
                <!--<?php if ($this->session->userdata('stat')=="Admin" || $this->session->userdata('stat')=="Staff Pengadaan") {echo anchor(site_url('kriteria/reset'), 'Reset', 'class="btn btn-warning"'); }?>-->
                <?php if ($this->session->userdata('stat')=="Admin" || $this->session->userdata('stat')=="Staff Pengadaan") { ?>
                <a href="<?php echo site_url('kriteria') ?>" class="btn btn-success">Kembali</a>
                <?php } ?>
                <!--<a href="<?php echo site_url('kriteria/reset') ?>" class="btn btn-warning"> R e s e t </a>
                <?php echo anchor(site_url('nilai/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('nilai/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('nilai/word'), 'Word', 'class="btn btn-primary"'); ?>-->
	    </div></div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
        <h5><b><i>Catatan</i></b> : Hasil nilai yang ditampilkan pada sistem ini bukan hasil akhir, nilai ini digunakan untuk menentukan calon pemenang</h5>
            <thead>
                <tr>
                    <th width="35px">No</th>
		    <th>Nama</th>
            <?php if ($this->session->userdata('stat')=="Admin" || $this->session->userdata('stat')=="Staff Pengadaan") { ?>
            <th>Nilai</th>
            <?php } ?>
            <th>Status</th>            
		    <!--<th width="200px">Action</th>-->
                </tr>
            </thead>
	    
        </table><?php $this->load->view('templates/footer'); ?><script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "<?php if (isset($_GET['jenis_lelang'])) {echo 'nilai/json?jenis_lelang='.$_GET['jenis_lelang'];}else{echo 'nilai/json';} ?>", "type": "POST"},
                    columns: [
                        {
                            "data": "id_perusahaan",
                            "orderable": false
                        },{"data": "nama"},<?php if ($this->session->userdata('stat')=="Admin" || $this->session->userdata('stat')=="Staff Pengadaan") {echo '{"data": "nilai"},';} ?>{"data": "status"},
                        //{
                        //    "data" : "action",
                        //    "orderable": false,
                        //    "className" : "text-center"
                        //}
                    ],
                    order: [[2, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>
