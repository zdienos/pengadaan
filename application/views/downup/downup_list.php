<?php $this->load->view('templates/header');?>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <?php if ($this->session->userdata('stat')=="Admin" || $this->session->userdata('stat')=="Staff Pengadaan") { ?>
                <h2>Download Kelengkapan</h2>
                <?php } ?>
                <?php if ($this->session->userdata('stat')=="Peserta Lelang") { ?>
                <h2>Kelengkapan Kualifikasi</h2>
                <?php } ?>
            </div>
            <div class="col-md-4 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
				<div style="margin-top:20px;">
                <?php if ($this->session->userdata('stat')=="Peserta Lelang") { 
                    echo anchor(site_url('upload'), 'Upload File', 'class="btn btn-primary"'); 
                } ?>
                <!--<?php echo anchor(site_url('downup/create'), 'Create', 'class="btn btn-primary"'); ?>-->
	    </div></div>
        </div>
        <!--File Peserta -->
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama File</th>
		    <th>Id Perusahaan</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table>
            
        <?php $this->load->view('templates/footer'); ?><script type="text/javascript">
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
                    ajax: {"url": "downup/json", "type": "POST"},
                    columns: [
                        {
                            "data": "no",
                            "orderable": false
                        },{"data": "nama_file"},{"data": "id_perusahaan"},
                        {
                            "data" : "action",
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

