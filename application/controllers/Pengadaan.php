<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengadaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Pengadaan_model');
        $this->load->library('form_validation');

        //if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        //{
        //    redirect('/');
        //}        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('pengadaan/pengadaan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Pengadaan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Pengadaan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_perusahaan' => $row->id_perusahaan,
		'id_barang' => $row->id_barang,
		'nilai' => $row->nilai,
	    );
            $this->load->view('pengadaan/pengadaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengadaan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pengadaan/create_action'),
	    'id_perusahaan' => set_value('id_perusahaan'),
	    'id_barang' => set_value('id_barang'),
	    'nilai' => set_value('nilai'),
	);
        $this->load->view('pengadaan/pengadaan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_perusahaan' => $this->input->post('id_perusahaan',TRUE),
		'id_barang' => $this->input->post('id_barang',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
	    );

            $this->Pengadaan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pengadaan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pengadaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengadaan/update_action'),
		'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
		'id_barang' => set_value('id_barang', $row->id_barang),
		'nilai' => set_value('nilai', $row->nilai),
	    );
            $this->load->view('pengadaan/pengadaan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengadaan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'id_perusahaan' => $this->input->post('id_perusahaan',TRUE),
		'id_barang' => $this->input->post('id_barang',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
	    );

            $this->Pengadaan_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengadaan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pengadaan_model->get_by_id($id);

        if ($row) {
            $this->Pengadaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengadaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengadaan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_perusahaan', 'id perusahaan', 'trim|required');
	$this->form_validation->set_rules('id_barang', 'id barang', 'trim|required');
	$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pengadaan.xls";
        $judul = "pengadaan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai");

	foreach ($this->Pengadaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_perusahaan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_barang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nilai);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pengadaan.doc");

        $data = array(
            'pengadaan_data' => $this->Pengadaan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pengadaan/pengadaan_doc',$data);
    }

}

/* End of file Pengadaan.php */
/* Location: ./application/controllers/Pengadaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-06 14:54:07 */
/* http://harviacode.com */