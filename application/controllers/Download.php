<?php

class Download extends CI_Controller {
        
  function __construct()
  {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }
  
  //index, just load the main page
        public function index() {


                //load the view/download.php
                $this->load->view('download');
                
        }
                //IF download/plaintext,
        public function plaintext() {
                //load the download helper
                $this->load->helper('download');
                //set the textfile's content 
                $data = 'Hello world! Codeigniter rocks!';
                //set the textfile's name
                $name = 'filedownload.txt';
                //use this function to force the session/browser to download the created file
                force_download($name, $data);
        }
                //IF download/upload,
        public function upload() {
                //load the download helper
                $this->load->helper('download');
                //Get the file from whatever the user uploaded (NOTE: Users needs to upload first), @See http://localhost/CI/index.php/upload
                $data = file_get_contents("./uploads/image_upload.jpg");
                //Read the file's contents
                $name = 'niceupload.jpg';

                //use this function to force the session/browser to download the file uploaded by the user 
                force_download($name, $data);
        }

}
}
?>