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
  
  <script>
 // grecaptcha.ready(function() {
   //   grecaptcha.execute('6LfvSqQUAAAAADNPqTuVPU6C1Jnyy6bChdIzabHI', {action: 'homepage'}).then(function(token) {
         
     // });
  //});
</script>

    
</head>
<body>

	
<form  method="post" name="payuForm" enctype="multipart/form-data">

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
      <div class="form-group">
                        <label class="col-md-4 control-label">Captcha:</label>
                        <div class="col-md-6">
                          <div id="recaptcha" class="g-recaptcha" data-sitekey="6LfvSqQUAAAAADNPqTuVPU6C1Jnyy6bChdIzabHI"></div>
                    </div>
                    <span style="color: red;" class="msg-error error"></span>
  </div>
  <div class="col-md-6" align="center"><button id="rzp-button"  onclick="sush()" class="btn btn-primary">Submit</button></div>
  
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
   if(ext!="pdf" && ext!="docx" && ext!="doc"){
   	
   		 alert("Only Pdf or Doc files are allowed.");
      return false;
   }
  
    var $captcha = $( '#recaptcha' ),
      response = grecaptcha.getResponse();
  
  if (response.length === 0) {
    $( '.msg-error').text( "reCAPTCHA is mandatory." );
    if( !$captcha.hasClass( "error" ) ){
      $captcha.addClass( "error" );
      return false;
    }
  } else {
    $( '.msg-error' ).text('');
    $captcha.removeClass( "error" );
    
  }
}


</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$(document).ready(function(){
var options = {
    "key": "rzp_test_ZfRCFUXqVZxZmv",
    "amount": "29935",
    "name": "Acme Corp",
    "description": "A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami",
    "image": "http://example.com/your_logo.png",
    "handler": function (response){
      debugger
        alert(response.razorpay_payment_id);
    },
    /**
      * You can track the modal lifecycle by * adding the below code in your options
      */
    "modal": {
        "ondismiss": function(){
          debugger
            console.log('Checkout form closed');
        }
    }
};
var rzp1 = new Razorpay(options);
 function sush(){
    rzp1.open();
    debugger
    preventDefault();
}
});
</script>