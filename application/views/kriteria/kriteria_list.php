<?php $this->load->view('templates/header');?>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h3>Data Alternatif dan Kriteria</h3>
            </div>
            <div class="col-md-4 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
            <form action="<?php echo site_url('kriteria/index2'); ?>">                
				<div style="margin-top:20px;">
                <label for="int" align="center"><?php echo form_error('jenis_lelang') ?>
                    <?php echo cmb_dinamis('jenis_lelang','pengumuman','jenis_lelang','jenis_lelang'); ?>
                </label>
                <input type="submit" value="Proses SAW" class="btn btn-success">
                <?php /*echo anchor(site_url('kriteria/index2'), 'Proses SAW', 'class="btn btn-success"');*/ ?>
                <?php echo anchor(site_url('kriteria/create'), 'Tambah', 'class="btn btn-danger"'); ?>
		<!--<?php echo anchor(site_url('kriteria/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('kriteria/word'), 'Word', 'class="btn btn-primary"'); ?>-->
	    </div></div>
        <div class="col-md-4">
            
        </div>

            </form>
        </div>
        
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">NO</th>
		            <th>ID PERUSAHAAN</th>
		            <!--<th>Id User</th>-->
		            <th>C1 (HARGA)</th>
		            <th>C2 (ESTIMASI)</th>
		            <th>C3 (TKDN)</th>
		            <th>C4 (NILAI ITEM)</th>
		            <th width="200px">ACTION</th>
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
                    ajax: {"url": "kriteria/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_kriteria",
                            "orderable": false
                        },{"data": "id_perusahaan"}/*,{"data": "id_user"}*/,{"data": "kriteria1"},{"data": "kriteria2"},{"data": "kriteria3"},{"data": "kriteria4"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
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