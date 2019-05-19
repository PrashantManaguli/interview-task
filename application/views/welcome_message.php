<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lumen/bootstrap.min.css">
	<style type="text/css">
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://js.instamojo.com/v1/checkout.js"></script>
   <script src='https://www.google.com/recaptcha/api.js'></script>
   <script src="https://www.google.com/recaptcha/api.js?render=6LeRSqQUAAAAAD7P0dJo4t9D0VDdWBCqqFGIXSGc"></script>
  <script>
  grecaptcha.ready(function() {
      grecaptcha.execute('6LeRSqQUAAAAAD7P0dJo4t9D0VDdWBCqqFGIXSGc', {action: 'homepage'}).then(function(token) {
         
      });
  });
</script>
    
</head>
<body>

	
<form action="<?php echo site_url('welcome/doPayment') ?>" method="post" name="payuForm" enctype="multipart/form-data">

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
  	myfile= $("#file_upload").val();
   var ext = myfile.split('.').pop();
   if(ext.trim()==""){
   	alert("Please select file to upload.");
   	return false;
   }
   if(ext=="pdf" || ext=="docx" || ext=="doc"){
   	
   		return true;
   }else{
   	alert(ext);
   		alert("Only Pdf or Doc files are allowed.");
   		return false;
   }
}

</script>