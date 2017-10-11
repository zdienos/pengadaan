<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kriteria extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Kriteria_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('kriteria/kriteria_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Kriteria_model->json();
    }

    public function read($id) 
    {
        $row = $this->Kriteria_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kriteria' => $row->id_kriteria,
		'id_perusahaan' => $row->id_perusahaan,
		'id_user' => $row->id_user,
		'kriteria1' => $row->kriteria1,
		'kriteria2' => $row->kriteria2,
		'kriteria3' => $row->kriteria3,
		'kriteria4' => $row->kriteria4,
	    );
            $this->load->view('kriteria/kriteria_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kriteria'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kriteria/create_action'),
	    'id_kriteria' => set_value('id_kriteria'),
	    'id_perusahaan' => set_value('id_perusahaan'),
	    'id_user' => set_value('id_user'),
	    'kriteria1' => set_value('kriteria1'),
	    'kriteria2' => set_value('kriteria2'),
	    'kriteria3' => set_value('kriteria3'),
	    'kriteria4' => set_value('kriteria4'),
	);
        $this->load->view('kriteria/kriteria_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_perusahaan' => $this->input->post('id_perusahaan',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'kriteria1' => $this->input->post('kriteria1',TRUE),
		'kriteria2' => $this->input->post('kriteria2',TRUE),
		'kriteria3' => $this->input->post('kriteria3',TRUE),
		'kriteria4' => $this->input->post('kriteria4',TRUE),
	    );

            $this->Kriteria_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kriteria'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kriteria_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kriteria/update_action'),
		'id_kriteria' => set_value('id_kriteria', $row->id_kriteria),
		'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
		'id_user' => set_value('id_user', $row->id_user),
		'kriteria1' => set_value('kriteria1', $row->kriteria1),
		'kriteria2' => set_value('kriteria2', $row->kriteria2),
		'kriteria3' => set_value('kriteria3', $row->kriteria3),
		'kriteria4' => set_value('kriteria4', $row->kriteria4),
	    );
            $this->load->view('kriteria/kriteria_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kriteria'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kriteria', TRUE));
        } else {
            $data = array(
		'id_perusahaan' => $this->input->post('id_perusahaan',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'kriteria1' => $this->input->post('kriteria1',TRUE),
		'kriteria2' => $this->input->post('kriteria2',TRUE),
		'kriteria3' => $this->input->post('kriteria3',TRUE),
		'kriteria4' => $this->input->post('kriteria4',TRUE),
	    );

            $this->Kriteria_model->update($this->input->post('id_kriteria', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kriteria'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kriteria_model->get_by_id($id);

        if ($row) {
            $this->Kriteria_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kriteria'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kriteria'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_perusahaan', 'id perusahaan', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
	$this->form_validation->set_rules('kriteria1', 'kriteria1', 'trim|required|numeric');
	$this->form_validation->set_rules('kriteria2', 'kriteria2', 'trim|required|numeric');
	$this->form_validation->set_rules('kriteria3', 'kriteria3', 'trim|required|numeric');
	$this->form_validation->set_rules('kriteria4', 'kriteria4', 'trim|required');

	$this->form_validation->set_rules('id_kriteria', 'id_kriteria', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kriteria.php */
/* Location: ./application/controllers/Kriteria.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-03 20:30:47 */
/* http://harviacode.com */