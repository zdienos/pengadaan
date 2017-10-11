<?php $this->load->view('templates/header');?>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Informasi Barang</h2>
            </div>
            <div class="col-md-4 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
				<div style="margin-top:20px;">
                <?php if ($this->session->userdata('stat')=="Admin" || $this->session->userdata('stat')=="Peserta Lelang") { echo anchor(site_url('barang/create'), 'Tambah', 'class="btn btn-danger"'); }?>
		<!--<?php echo anchor(site_url('barang/excel'), 'Excel', 'class="btn btn-success"'); ?>-->
		<!--<?php echo anchor(site_url('barang/word'), 'Word', 'class="btn btn-primary"'); ?>-->
	    </div></div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Id Perusahaan</th>
            <th>Jenis Lelang</th>
		    <th>Harga (Rupiah)</th>
		    <th>Estimasi (Minggu)</th>
		    <th>TKDN (%)</th>
		    <th>Nilai Item</th>
            <th width="200px">Action</th>
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
                    ajax: {"url": "barang/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_barang",
                            "orderable": false
                        },{"data": "id_perusahaan"},{"data": "jenis_lelang"},{"data": "harga"},{"data": "estimasi"},{"data": "tkdn"},{"data": "spesifikasi"},
                        
                            
                          {  "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                          }
                        
                        
                    ],
                    order: [[0, 'asc']],
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