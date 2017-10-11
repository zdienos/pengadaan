<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perusahaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

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
        $this->load->view('perusahaan/perusahaan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        if ($this->session->userdata('stat')=="Peserta Lelang") {
           $id_user=$this->session->userdata('id_user');
           echo $this->Perusahaan_model->json2($id_user);
        }else if ($this->session->userdata('stat')=="Staff Pengadaan"){
            echo $this->Perusahaan_model->json();
        }else{
            echo $this->Perusahaan_model->json3();
        }
    }

    public function read($id) 
    {
        $row = $this->Perusahaan_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id_perusahaan' => $row->id_perusahaan,
        'id_user' => $row->id_user,
        'nama' => $row->nama,
        'alamat' => $row->alamat,
        'status' => $row->status,
        'keterangan' => $row->keterangan,
        );
            $this->load->view('perusahaan/perusahaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('perusahaan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Buat',
            'action' => site_url('perusahaan/create_action'),
        'id_perusahaan' => set_value('id_perusahaan'),
        'id_user' => set_value('id_user'),
        'nama' => set_value('nama'),
        'alamat' => set_value('alamat'),
        'status' => set_value('status'),
        'keterangan' => set_value('keterangan'),
    );

        $this->load->view('perusahaan/perusahaan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'id_user' => $this->input->post('id_user',TRUE),
        'nama' => $this->input->post('nama',TRUE),
        'alamat' => $this->input->post('alamat',TRUE),
        'status' => $this->input->post('status',TRUE),
        'keterangan' => $this->input->post('keterangan',TRUE),
        );
            $cek_nama=$this->Perusahaan_model->get_by_nama($this->input->post('nama'));
            if(empty($cek_nama)){
            $this->Perusahaan_model->insert($data);
            $this->session->set_flashdata('message', 'Buat Data Berhasil');
            redirect(site_url('perusahaan'));
        }else{
            $this->session->set_flashdata('message', 'Nama Perusahaan Sudah Ada');
            redirect(site_url('perusahaan'));
        }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Perusahaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('perusahaan/update_action'),
        'id_perusahaan' => set_value('id_perusahaan', $row->id_perusahaan),
        'id_user' => set_value('id_user', $row->id_user),
        'nama' => set_value('nama', $row->nama),
        'alamat' => set_value('alamat', $row->alamat),
        'status' => set_value('status', $row->status),
        'keterangan' => set_value('keterangan', $row->keterangan),
        );
            $this->load->view('perusahaan/perusahaan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_perusahaan', TRUE));
        } else {
            $data = array(
        'id_user' => $this->input->post('id_user',TRUE),
        'nama' => $this->input->post('nama',TRUE),
        'alamat' => $this->input->post('alamat',TRUE),
        'status' => $this->input->post('status',TRUE),
        'keterangan' => $this->input->post('keterangan',TRUE),
        );

            $this->Perusahaan_model->update($this->input->post('id_perusahaan', TRUE), $data);
            $this->session->set_flashdata('message', 'Ubah Data Sukses');
            redirect(site_url('perusahaan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Perusahaan_model->get_by_id($id);

        if ($row) {
            $this->Perusahaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('perusahaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('id_user', 'id user', 'trim|required');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required');
    $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

    $this->form_validation->set_rules('id_perusahaan', 'id_perusahaan', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Perusahaan.php */
/* Location: ./application/controllers/Perusahaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-08 16:38:19 */
/* http://harviacode.com */