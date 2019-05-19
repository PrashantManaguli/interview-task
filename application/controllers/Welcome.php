<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require(base_url()."vendor/instamojo/instamojo-php/src/Instamojo.php");

class Welcome extends CI_Controller {

	 function __construct() {
        parent::__construct();
        // $str=base_url()."vendor/instamojo/instamojo-php/src/Instamojo.php";
        // echo base_url()."vendor/instamojo/instamojo-php/src/Instamojo.php";
       // $api = new Instamojo\Instamojo('687e914c5168a5b9b40881601b3b26d0', 'cbbf3076e750fbc50a430b4fc869076e');
        
    }
	 
	public function index()
	{
		
			$this->load->view('welcome_message');
		
		
	}

	public function doPayment() {
		$api = new Instamojo\Instamojo('687e914c5168a5b9b40881601b3b26d0', 'cbbf3076e750fbc50a430b4fc869076e');
		try {
		    $response = $api->paymentRequestCreate(array(
		        "purpose" => "FIFA 16",
		        "amount" => "3499",
		        // "send_email" => true,
		        "email" => "foo@example.com",
		        "redirect_url" => "https://interview-task-five-feed.herokuapp.com/payment_success"
		        ));
		    
		}
		catch (Exception $e) {
		    print('Error: ' . $e->getMessage());
		}
	}
	public function payment_success(){
		$this->load->view('success');
	}
	public function payment_failure(){
		$this->load->view('failure');
	}

	

}
