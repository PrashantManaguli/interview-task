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
		// $api = new Instamojo\Instamojo('687e914c5168a5b9b40881601b3b26d0', 'cbbf3076e750fbc50a430b4fc869076e');
		// try {
		//     $response = $api->paymentRequestCreate(array(
		//         "purpose" => "FIFA 16",
		//         "amount" => "3499",
		//         // "send_email" => true,
		//         "email" => "foo@example.com",
		//         "redirect_url" => "https://interview-task-five-feed.herokuapp.com/index.php/welcome/payment_success"
		//         ));
		//     print_r($response);
		// }
		// catch (Exception $e) {
		//     print('Error: ' . $e->getMessage());
		// }
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
		            array("X-Api-Key:687e914c5168a5b9b40881601b3b26d0",
		                  "X-Auth-Token:cbbf3076e750fbc50a430b4fc869076e"));
		$payload = Array(
		    'purpose' => 'FIFA 16',
		    'amount' => '2500',
		    'phone' => '9999999999',
		    'buyer_name' => 'John Doe',
		    'redirect_url' => 'https://interview-task-five-feed.herokuapp.com/index.php/welcome/payment_success',
		    'send_email' => true,
		    'webhook' => 'http://www.example.com/webhook/',
		    'send_sms' => true,
		    'email' => 'foo@example.com',
		    'allow_repeated_payments' => false
		);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);
		curl_close($ch); 

		echo $response;
		// echo "hi";
		// die();
	}
	public function payment_success(){
		$this->load->view('success');
	}
	public function payment_failure(){
		$this->load->view('failure');
	}

	

}
