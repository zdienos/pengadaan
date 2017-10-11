<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->model('Downup_model');
        }

        public function index()
        {
                $this->load->view('upload/index', array('error' => '' ));
        }

        public function do_upload()
        {
                $config['upload_path']          = './assets/uploads/';
                $config['allowed_types']        = '*';
                $config['max_size']             = 10000;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload/index', $error);
                }
                else
                {
                        $id_user=$this->session->userdata('id_user');
                        $data = array('upload_data' => $this->upload->data());
                        $nama =$data['upload_data']['file_name'];
                        $datas = array(
                        'nama_file' =>$nama,
                        'id_perusahaan' => $id_user,
            );

                        $this->Downup_model->insert($datas);
                        $this->load->view('upload/sukses', $data);
                }
        }
}
?>