<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
                $this->load->model('User_model');
                $this->load->model('Pengumuman_model');
    }

    public function index()
    {
    	$this->load->view('login');
		
    	if (isset($_POST['username'])) {
    		$username=$_POST['username'];
    		$password=$_POST['password'];
    		$hasil=$this->User_model->login($username,$password);
    		if (!empty($hasil)) {
    			$this->session->set_userdata('logined', true);
    			$this->session->set_userdata('jumlah', count($this->Pengumuman_model->get_all()));
    			$this->session->set_userdata('stat', $hasil[0]->stat);
    			$this->session->set_userdata('id_user', $hasil[0]->id_user);
    			$this->session->set_userdata('id_perusahaan', $hasil[0]->id_perusahaan);
    			//echo $hasil[0]->stat;
    			$this->session->set_userdata($hasil);

    			//print_r($hasil);
    			redirect('home');
    		}else{
    			redirect("/");	
    		}
    	}
		/*if($this->session->userdata('logined') && $this->session->userdata('logined') == true)
		{
			redirect('home');
		}
		
		if(!$this->input->post())
		{
			$this->load->view('login');
		}
		else
		{
			if(
				strtolower($this->input->post('username')) == LOGIN_USERNAME &&
				$this->input->post('password')  == LOGIN_PASSWORD
			)
			{
				$this->session->set_userdata('logined', true);
				
				redirect("home");
			}
			else 
			{
				redirect("/");
			}
		}*/
        
    } 
	
	public function logout()
    {
		$this->session->unset_userdata('logined');
		redirect("/");
    } 
}

/* End of file Workflows.php */
/* Location: ./application/controllers/Workflows.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-15 00:43:10 */
/* http://harviacode.com */