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
    public function reset()
    {
        $this->Kriteria_model->reset();
        redirect('/nilai');
    }
    public function index2()
    {
      $data['bobot']="";
      if (isset($_POST['submit'])) {
        $data['bobot']=array($_POST['harga'],$_POST['estimasi'],$_POST['tkdn'],$_POST['spesifikasi']);
      }else{
        $data['bobot'] = array(0.4,0.1,0.1,0.4);
      }
       
        $harga=array();
        $tkdn=array();
        $estimasi=array();
        $spesifikasi=array();
        $id_user=1;
        $i=1;
        $jenis_lelang=$_GET['jenis_lelang'];
        $data['jenis_lelang']=$jenis_lelang;
        $data['data_kriteria']=$this->Kriteria_model->select($id_user,$jenis_lelang);
        //print_r($data['data_kriteria']);
        $data['data_makskriteria']=$this->Kriteria_model->maks_kriteria($id_user,$jenis_lelang);
        $data['data_minskriteria']=$this->Kriteria_model->mins_kriteria($id_user,$jenis_lelang);
$q=$this->db->query("select * from nilai where jenis_lelang='".$jenis_lelang."'")->result();
        $data['cek']=count($q);   
 $this->load->view('kriteria/index2',$data);

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
            'button' => 'Tambah',
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
            $this->session->set_flashdata('message', 'Tambah Data Berhasil');
            redirect(site_url('kriteria'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kriteria_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
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
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
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
            $this->session->set_flashdata('message', 'Ubah Data Berhasil');
            redirect(site_url('kriteria'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kriteria_model->get_by_id($id);

        if ($row) {
            $this->Kriteria_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus Data Berhasil');
            redirect(site_url('kriteria'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('kriteria'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_perusahaan', 'id perusahaan', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
	$this->form_validation->set_rules('kriteria1', 'kriteria1', 'numeric');
	$this->form_validation->set_rules('kriteria2', 'kriteria2', 'numeric');
	$this->form_validation->set_rules('kriteria3', 'kriteria3', 'numeric');
	$this->form_validation->set_rules('kriteria4', 'kriteria4', 'numeric');

	$this->form_validation->set_rules('id_kriteria', 'id_kriteria', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kriteria.xls";
        $judul = "kriteria";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");
	xlsWriteLabel($tablehead, $kolomhead++, "Kriteria1");
	xlsWriteLabel($tablehead, $kolomhead++, "Kriteria2");
	xlsWriteLabel($tablehead, $kolomhead++, "Kriteria3");
	xlsWriteLabel($tablehead, $kolomhead++, "Kriteria4");

	foreach ($this->Kriteria_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_perusahaan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kriteria1);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kriteria2);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kriteria3);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kriteria4);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kriteria.doc");

        $data = array(
            'kriteria_data' => $this->Kriteria_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('kriteria/kriteria_doc',$data);
    }

}

/* End of file Kriteria.php */
/* Location: ./application/controllers/Kriteria.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-03 20:39:15 */
/* http://harviacode.com */