<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Barang_model');
        $this->load->model('Perusahaan_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('barang/barang_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        if ($this->session->userdata('stat')=="Peserta Lelang") {
             $per=$this->Perusahaan_model->get_by_iduser($this->session->userdata('id_user'));
           $id_user=$per->id_perusahaan;
           echo $this->Barang_model->json2($id_user);
        }else if ($this->session->userdata('stat')=="Staff Pengadaan"){
            echo $this->Barang_model->json3();
        }else{
            echo $this->Barang_model->json();
        }
        
    }

    public function read($id) 
    {
        $row = $this->Barang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_barang' => $row->id_barang,
		'id_perusahaan' => $row->id_perusahaan,
        'jenis_lelang' => $row->jenis_lelang,
		'harga' => $row->harga,
		'estimasi' => $row->estimasi,
		'tkdn' => $row->tkdn,
		'spesifikasi' => $row->spesifikasi,
	    );
            $this->load->view('barang/barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function create() 
    {
        $per=$this->Perusahaan_model->get_by_iduser($this->session->userdata('id_user'));
        if (!empty($per)) {
            $data = array(
            'button' => 'Tambah',
            'action' => site_url('barang/create_action'),
        'id_barang' => set_value('id_barang'),
        'id_perusahaan' => $per->id_perusahaan,
        'jenis_lelang' => set_value('jenis_lelang'),
        'harga' => set_value('harga'),
        'estimasi' => set_value('estimasi'),
        'tkdn' => set_value('tkdn'),
        'spesifikasi' => set_value('spesifikasi'),
    );
        }else{
            $data = array(
            'button' => 'Tambah',
            'action' => site_url('barang/create_action'),
        'id_barang' => set_value('id_barang'),
        'id_perusahaan' => set_value('id_perusahaan'),
        'jenis_lelang' => set_value('jenis_lelang'),
        'harga' => set_value('harga'),
        'estimasi' => set_value('estimasi'),
        'tkdn' => set_value('tkdn'),
        'spesifikasi' => set_value('spesifikasi'),
    );
        }
        
      
        $this->load->view('barang/barang_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_perusahaan' => $this->input->post('id_perusahaan',TRUE),
		'jenis_lelang' => $this->input->post('jenis_lelang',TRUE),
        'harga' => $this->input->post('harga',TRUE),
        'estimasi' => $this->input->post('estimasi',TRUE),
		'tkdn' => $this->input->post('tkdn',TRUE),
		'spesifikasi' => $this->input->post('spesifikasi',TRUE),
	    );
            $cek_id=$this->Barang_model->get_by_idperusahaan($this->input->post('id_perusahaan'));
            if(empty($cek_id)){
            $this->Barang_model->insert($data);
            $this->session->set_flashdata('message', 'Buat Data Berhasil');
            redirect(site_url('barang'));
        }else{
            $this->session->set_flashdata('message', 'Perusahaan Sudah Ada');
            redirect(site_url('barang'));
        }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('barang/update_action'),
		'id_barang' => set_value('id_barang', $row->id_barang),
		'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
		'jenis_lelang' => set_value('jenis_lelang', $row->harga),
        'harga' => set_value('harga', $row->harga),
        'estimasi' => set_value('estimasi', $row->estimasi),
		'tkdn' => set_value('tkdn', $row->tkdn),
		'spesifikasi' => set_value('spesifikasi', $row->spesifikasi),
	    );
            $this->load->view('barang/barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_barang', TRUE));
        } else {
            $data = array(
		'id_perusahaan' => $this->input->post('id_perusahaan',TRUE),
		'jenis_lelang' => $this->input->post('jenis_lelang',TRUE),
        'harga' => $this->input->post('harga',TRUE),
        'estimasi' => $this->input->post('estimasi',TRUE),
		'tkdn' => $this->input->post('tkdn',TRUE),
		'spesifikasi' => $this->input->post('spesifikasi',TRUE),
	    );
            $id_perusahaan=$this->input->post('id_perusahaan',TRUE);
             $a=$this->input->post('harga',TRUE)/1000000;
             $b=$this->input->post('estimasi',TRUE);
             $c=$this->input->post('tkdn',TRUE);
             $d=$this->input->post('spesifikasi',TRUE);
            $this->Barang_model->update_kriteria($id_perusahaan,$a,$b,$c,$d);
            $this->Barang_model->update($this->input->post('id_barang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('barang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $this->Barang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('barang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_perusahaan', 'id perusahaan', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
    $this->form_validation->set_rules('jenis_lelang', 'jenis lelang', 'trim|required');
    $this->form_validation->set_rules('estimasi', 'estimasi', 'trim|required');
	$this->form_validation->set_rules('tkdn', 'tkdn', 'trim|required');
	$this->form_validation->set_rules('spesifikasi', 'spesifikasi', 'trim|required');

	$this->form_validation->set_rules('id_barang', 'id_barang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "barang.xls";
        $judul = "barang";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Perusahaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
	xlsWriteLabel($tablehead, $kolomhead++, "Estimasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Tkdn");
	xlsWriteLabel($tablehead, $kolomhead++, "Spesifikasi");

	foreach ($this->Barang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_perusahaan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga);
	    xlsWriteNumber($tablebody, $kolombody++, $data->estimasi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tkdn);
	    xlsWriteNumber($tablebody, $kolombody++, $data->spesifikasi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=barang.doc");

        $data = array(
            'barang_data' => $this->Barang_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('barang/barang_doc',$data);
    }

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-06 14:54:06 */
/* http://harviacode.com */