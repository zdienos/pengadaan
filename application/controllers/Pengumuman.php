<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengumuman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Pengumuman_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('pengumuman/pengumuman_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        if ($this->session->userdata('stat')=="Admin" || $this->session->userdata('stat')=="Staff Pengadaan") {
           $id_user=$this->session->userdata('id_user');
           echo $this->Pengumuman_model->json2();
        }else{
            echo $this->Pengumuman_model->json();
        }
    }

    public function read($id) 
    {
        $row = $this->Pengumuman_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pengumuman' => $row->id_pengumuman,
		'id_user' => $row->id_user,
        'jenis_lelang' => $row->jenis_lelang,
		'judul_pengumuman' => $row->judul_pengumuman,
		'isi_pengumuman' => $row->isi_pengumuman,
		'tanggal' => $row->tanggal,
        'spek_item' => $row->spek_iem,
        'est_item' => $row->est_item,
        'tkdn_item' => $row->tkdn_item,
	    );
            $this->load->view('pengumuman/pengumuman_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pengumuman'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('pengumuman/create_action'),
	    'id_pengumuman' => set_value('id_pengumuman'),
	    'id_user' => set_value('id_user'),
        'jenis_lelang' => set_value('jenis_lelang'),
	    'judul_pengumuman' => set_value('judul_pengumuman'),
	    'isi_pengumuman' => set_value('isi_pengumuman'),
        'tanggal' => set_value('tanggal'),
        'spek_item' => set_value('spek_item'),
        'est_item' => set_value('est_item'),
        'tkdn_item' => set_value('tkdn_item'),
	);
        $this->load->view('pengumuman/pengumuman_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_user' => $this->input->post('id_user',TRUE),
        'jenis_lelang' => $this->input->post('jenis_lelang',TRUE),
        'judul_pengumuman' => $this->input->post('judul_pengumuman',TRUE),
		'isi_pengumuman' => $this->input->post('isi_pengumuman',TRUE),
        'tanggal' => $this->input->post('tanggal',TRUE),
        'spek_item' => $this->input->post('spek_item',TRUE),
        'est_item' => $this->input->post('est_item',TRUE),
        'tkdn_item' => $this->input->post('tkdn_item',TRUE),
	    );

            $this->Pengumuman_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pengumuman'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pengumuman_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('pengumuman/update_action'),
		'id_pengumuman' => set_value('id_pengumuman', $row->id_pengumuman),
		'id_user' => set_value('id_user', $row->id_user),
        'jenis_lelang' => set_value('jenis_lelang', $row->jenis_lelang),
        'judul_pengumuman' => set_value('judul_pengumuman', $row->judul_pengumuman),
		'isi_pengumuman' => set_value('isi_pengumuman', $row->isi_pengumuman),
        'tanggal' => set_value('tanggal', $row->tanggal),
        'spek_item' => set_value('spek_item', $row->spek_item),
        'est_item' => set_value('est_item', $row->est_item),
        'tkdn_item' => set_value('tkdn_item', $row->tkdn_item),
	    );
            $this->load->view('pengumuman/pengumuman_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengumuman'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pengumuman', TRUE));
        } else {
            $data = array(
		'id_user' => $this->input->post('id_user',TRUE),
        'jenis_lelang' => $this->input->post('jenis_lelang',TRUE),
		'judul_pengumuman' => $this->input->post('judul_pengumuman',TRUE),
		'isi_pengumuman' => $this->input->post('isi_pengumuman',TRUE),
        'tanggal' => $this->input->post('tanggal',TRUE),
        'spek_item' => $this->input->post('spek_item',TRUE),
        'est_item' => $this->input->post('est_item',TRUE),
        'tkdn_item' => $this->input->post('tkdn_item',TRUE),
	    );

            $this->Pengumuman_model->update($this->input->post('id_pengumuman', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengumuman'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pengumuman_model->get_by_id($id);

        if ($row) {
            $this->Pengumuman_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengumuman'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengumuman'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
    $this->form_validation->set_rules('jenis_lelang', 'jenis lelang', 'trim|required');
    $this->form_validation->set_rules('judul_pengumuman', 'judul pengumuman', 'trim|required');
	$this->form_validation->set_rules('isi_pengumuman', 'isi pengumuman', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');

	$this->form_validation->set_rules('id_pengumuman', 'id_pengumuman', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pengumuman.php */
/* Location: ./application/controllers/Pengumuman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-10 15:08:44 */
/* http://harviacode.com */