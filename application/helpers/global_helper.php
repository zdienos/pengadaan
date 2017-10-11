<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");
	function cmb_dinamis($name, $table, $field, $pk, $selected = null, $extra = null) {
    $ci = & get_instance();
    $cmb = "<select name='$name' class='form-control' $extra>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $row) {
        $cmb .="<option value='" . $row->$pk . "'";
        $cmb .= $selected == $row->$pk ? 'selected' : '';
        $cmb .=">" . $row->$field . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
	}
	
	function generate_sidemenu()
	{
		return '<li>
		<a href="'.site_url('barang').'"><i class="fa fa-list fa-fw"></i> Barang</a>
	</li><li>
		<a href="'.site_url('pengadaan').'"><i class="fa fa-list fa-fw"></i> Pengadaan</a>
	</li><li>
		<a href="'.site_url('perusahaan').'"><i class="fa fa-list fa-fw"></i> Perusahaan</a>
	</li><li>
		<a href="'.site_url('user').'"><i class="fa fa-list fa-fw"></i> User</a>
	</li>';
	}
