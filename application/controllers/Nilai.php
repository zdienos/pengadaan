<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nilai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Nilai_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('nilai/nilai_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        
        if (isset($_GET['jenis_lelang'])) {
            $jenis_lelang=$_GET['jenis_lelang'];
            echo $this->Nilai_model->json($jenis_lelang);
        }else{
            echo $this->Nilai_model->jsonn();
        }
        
    }

    public function read($id) 
    {
        $row = $this->Nilai_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_perusahaan' => $row->id_perusahaan,
		'nilai' => $row->nilai,
	    );
            $this->load->view('nilai/nilai_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('nilai'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('nilai/create_action'),
	    'id_perusahaan' => set_value('id_perusahaan'),
	    'nilai' => set_value('nilai'),
	);
        $this->load->view('nilai/nilai_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nilai' => $this->input->post('nilai',TRUE),
	    );

            $this->Nilai_model->insert($data);
            $this->session->set_flashdata('message', 'Buat Data Berhasil');
            redirect(site_url('nilai'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Nilai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('nilai/update_action'),
		'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
		'nilai' => set_value('nilai', $row->nilai),
	    );
            $this->load->view('nilai/nilai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('nilai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_perusahaan', TRUE));
        } else {
            $data = array(
		'nilai' => $this->input->post('nilai',TRUE),
	    );

            $this->Nilai_model->update($this->input->post('id_perusahaan', TRUE), $data);
            $this->session->set_flashdata('message', 'Ubah Data Berhasil');
            redirect(site_url('nilai'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Nilai_model->get_by_id($id);

        if ($row) {
            $this->Nilai_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus Data Berhasil');
            redirect(site_url('nilai'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('nilai'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');

	$this->form_validation->set_rules('id_perusahaan', 'id_perusahaan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "nilai.xls";
        $judul = "nilai";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai");

	foreach ($this->Nilai_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=nilai.doc");

        $data = array(
            'nilai_data' => $this->Nilai_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('nilai/nilai_doc',$data);
    }

}

/* End of file Nilai.php */
/* Location: ./application/controllers/Nilai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-27 13:32:03 */
/* http://harviacode.com */