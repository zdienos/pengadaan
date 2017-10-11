<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Downup extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Downup_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('downup/downup_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        if ($this->session->userdata('stat')=="Peserta Lelang") {
           $id_user=$this->session->userdata('id_user');
        echo $this->Downup_model->json3($id_user);
        }else if ($this->session->userdata('stat')=="Staff Pengadaan"){
            echo $this->Downup_model->json2();
        }else{
            echo $this->Downup_model->json();
        }
    }

    public function read($id) 
    {
        $row = $this->Downup_model->get_by_id($id);
        if ($row) {
            $data = array(
		'no' => $row->no,
		'nama_file' => $row->nama_file,
		'id_perusahaan' => $row->id_perusahaan,
	    );
            $this->load->view('downup/downup_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('downup'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('downup/create_action'),
	    'no' => set_value('no'),
	    'nama_file' => set_value('nama_file'),
	    'id_perusahaan' => set_value('id_perusahaan'),
	);
        $this->load->view('downup/downup_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_file' => $this->input->post('nama_file',TRUE),
		'id_perusahaan' => $this->input->post('id_perusahaan',TRUE),
	    );

            $this->Downup_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('downup'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Downup_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('downup/update_action'),
		'no' => set_value('no', $row->no),
		'nama_file' => set_value('nama_file', $row->nama_file),
		'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
	    );
            $this->load->view('downup/downup_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('downup'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no', TRUE));
        } else {
            $data = array(
		'nama_file' => $this->input->post('nama_file',TRUE),
		//'id_perusahaan' => $this->input->post('id_perusahaan',TRUE),
	    );

            $this->Downup_model->update($this->input->post('no', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('downup'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Downup_model->get_by_id($id);

        if ($row) {
            $this->Downup_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('downup'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('downup'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_file', 'nama file', 'trim|required');
	$this->form_validation->set_rules('id_perusahaan', 'id perusahaan', 'trim|required');

	$this->form_validation->set_rules('no', 'no', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Downup.php */
/* Location: ./application/controllers/Downup.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-08-26 11:17:02 */
/* http://harviacode.com */