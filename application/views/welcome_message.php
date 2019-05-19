<?php

$MERCHANT_KEY = "7PuBQofD";
$SALT = "a8kzsJtWpB";
// Merchant Key and Salt as provided by Payu.

$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);

  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
   //echo "<pre>";print_r($posted);exit;
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id

  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;

    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lumen/bootstrap.min.css">
	<style type="text/css">
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body onload="submitPayuForm()">
	<?php
		
    if($formError) { ?>
	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>

	
<form action="<?php echo $action; ?>" method="post" name="payuForm" enctype="multipart/form-data">

	  <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
	  <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
	  <input type="hidden" name="productinfo" value="Payment Gateway"  />
	  <input type="hidden" name="surl" value="<?php echo site_url('welcome/payment_success') ?>" size="64" />
	  <input type="hidden" name="furl" value="<?php echo site_url('welcome/payment_failure') ?>" size="64" />
	  


	<div class="form-group row">
     	<label for="exampleInputEmail1"  class="col-md-6" align="center"><h2><b>Add User Details</b></h2></label>
     </div>
    <div class="form-group row" align="right">
      <label for="exampleInputEmail1"  class="col-md-2"><b>Username</b></label>
      <input type="text" class="form-control col-md-4" name="firstname" id="user_name" value="" aria-describedby="emailHelp" placeholder="Enter Username">
    </div>
     <div class="form-group row" align="right">
      <label for="exampleInputEmail1"  class="col-md-2"><b>Email address</b></label>
      <input type="email" class="form-control col-md-4" name="email" id="user_email" value="" aria-describedby="emailHelp" placeholder="Enter Email address">
    </div>	
    <div class="form-group row" align="right">
      <label for="exampleInputEmail1"  class="col-md-2"><b>Mobile</b></label>
      <input type="text" class="form-control col-md-4" name="phone" id="user_mobile" value="" aria-describedby="emailHelp" placeholder="Enter Mobile">
    </div>

	  <div class="form-group row col-md-10" align="center">
	  	<div class="custom-control custom-checkbox col-md-2"></div>
	    <div class="custom-control custom-checkbox col-md-2">
	      <input type="checkbox" class="custom-control-input" value="100" id="customCheck1" onclick="calculate_amount()">
	      <label class="custom-control-label" for="customCheck1">Editing(USD 100)</label>
	    </div>
	    <div class="custom-control custom-checkbox col-md-2">
	      <input type="checkbox" class="custom-control-input" value="200" id="customCheck2" onclick="calculate_amount()">
	      <label class="custom-control-label" for="customCheck2">Proofreading(USD 200)</label>
	    </div>
	    <div class="custom-control custom-checkbox col-md-2">
	      <input type="checkbox" class="custom-control-input" value="500" id="customCheck3" onclick="calculate_amount()">
	      <label class="custom-control-label" for="customCheck3">Formatting(USD 500)</label>
	    </div>
	  </div>

	 <div class="form-group row" align="right">
      <label for="exampleInputEmail1"  class="col-md-2"><b>Price USD</b></label>
      <input type="text" class="form-control col-md-4" name="amount" id="price" value="" aria-describedby="emailHelp" placeholder="Enter Price">
    </div>

	<div class="form-group col-md-8" align="center">
		<label for="exampleInputEmail1"  class="col-md-2"><b>Choose File</b></label>
    <div class="input-group mb-3 col-md-5" >
      <div class="custom-file ">
        <input type="file" class="custom-file-input" id="file_upload" name="file_upload" >
        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
      </div>
     <!-- onchange=" return check_file() -->
    </div>
  </div>
  <div class="col-md-6" align="center"><button id="submit"  onclick="return validate_form()" class="btn btn-primary">Submit</button></div>
  
</form>
</body>
<script type="text/javascript">

function calculate_amount(){
	var amount=0;
	$("input[type=checkbox]:checked").each(function() {
   amount+=parseInt(this.value);
});
	$("#price").val(amount);
}
function validate_form(){
	var email=$("#user_email").val();
	var user_name=$("#user_name").val();
	var mobile=$("#user_mobile").val();
	if(user_name.trim()==""){
		alert("Please enter Username.");
	    return false;
	}
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  if(!regex.test(email)) {
	  	alert("Please enter correct email address.");
	    return false;
	  }

	if(mobile.trim()==""){
		alert("Please enter mobile number.");
	    return false;
	}
	if(mobile.length!=10){
		alert("Please enter valid mobile number.");
	    return false;
	}
  	// myfile= $("#file_upload").val();
   // var ext = myfile.split('.').pop();
   // if(ext.trim()==""){
   // 	alert("Please select file to upload.");
   // 	return false;
   // }
   // if(ext=="pdf" || ext=="docx" || ext=="doc"){
   	
   // 		return true;
   // }else{
   // 	alert(ext);
   // 		alert("Only Pdf or Doc files are allowed.");
   // 		return false;
   // }
}

var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }


</script>