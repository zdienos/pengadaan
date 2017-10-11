<?php $this->load->view('templates/header');?>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Data Perusahaan</h2>
            </div>
            <div class="col-md-4 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <div style="margin-top:20px;">
                <?php if ($this->session->userdata('stat')=="Admin" || $this->session->userdata('stat')=="Peserta Lelang") {echo anchor(site_url('perusahaan/create'), 'Tambah', 'class="btn btn-danger"'); }?>
        <!--<?php echo anchor(site_url('perusahaan/excel'), 'Excel', 'class="btn btn-success"'); ?>-->
        <!--<?php echo anchor(site_url('perusahaan/word'), 'Word', 'class="btn btn-primary"'); ?>-->
        </div></div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
            <th>Id User</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Keterangan</th>
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
                    ajax: {"url": "perusahaan/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_perusahaan",
                            "orderable": false
                        },{"data": "id_user"},{"data": "nama"},{"data": "alamat"},{"data": "status"},{"data": "keterangan"},
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