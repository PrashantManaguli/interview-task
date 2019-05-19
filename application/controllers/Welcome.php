<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	 function __construct() {
        parent::__construct();
        $this->load->model("main_model");
    }
	 
	public function index()
	{
		
			$this->load->view('welcome_message');
		
		
	}
	public function payment_success(){
		$this->load->view('success');
	}
	public function payment_failure(){
		$this->load->view('failure');
	}

	

}
