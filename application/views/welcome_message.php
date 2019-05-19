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
 //     grecaptcha.execute('6LfvSqQUAAAAADNPqTuVPU6C1Jnyy6bChdIzabHI', {action: 'homepage'}).then(function(token) {
         
 //     });
 //  });
</script>

    
</head>
<body>

	
<form  method="post" name="payuForm" enctype="multipart/form-data">
<div class="container">
  
<div class = "row" align="center">
	<div class="form-group col-md-12" align="center">
     	<label for="exampleInputEmail1"  class="col-md-6" align="center"><h2><b>Add User Details</b></h2></label>
     </div>
    <div class="form-group col-md-12" align="center">
      <div class="row">
        <div class="col-md-5"align="right">
          <label for="exampleInputEmail1"><b>Username</b></label>
        </div>
        <div class="col-md-4" align="left">
          <input type="text" class="form-control" name="firstname" id="user_name" value="" aria-describedby="emailHelp" placeholder="Enter Username">
        </div>
        
      </div>
    </div>
     <div class="form-group col-md-12" align="center">
         <div class="row ">
          <div class="col-md-5"align="right">
            <label for="exampleInputEmail1"><b>Email address</b></label>
          </div>
           <div class="col-md-4" align="left">
          <input type="email" class="form-control" name="email" id="user_email" value="" aria-describedby="emailHelp" placeholder="Enter Email address">
        </div>
    </div>
    </div>	
    <div class=" col-md-12" align="center">
       <div class="row ">
          <div class="col-md-5"align="right">   
                <label for="exampleInputEmail1"><b>Mobile</b></label>
            </div>
            <div class="col-md-4" align="left">
            <input type="text" class="form-control" name="phone" id="user_mobile" value="" aria-describedby="emailHelp" placeholder="Enter Mobile">
        </div>
        </div>
    </div>

	  <div class="form-group col-md-12" align="center">
	  	<div class="custom-control custom-checkbox col-md-5" align="right">&nbsp;</div>
	    <div class="custom-control custom-checkbox col-md-2" align="left">
	      <input type="checkbox" class="custom-control-input" value="100" id="customCheck1" onclick="calculate_amount()">
	      <label class="custom-control-label" for="customCheck1"><b>Editing</b>(USD $100)</label>
	    </div>
	    <div class="custom-control custom-checkbox col-md-2" align="left">
	      <input type="checkbox" class="custom-control-input" value="200" id="customCheck2" onclick="calculate_amount()">
	      <label class="custom-control-label" for="customCheck2"><b>Proofreading</b>(USD $200)</label>
	    </div>
	    <div class="custom-control custom-checkbox col-md-2" align="left">
	      <input type="checkbox" class="custom-control-input" value="500" id="customCheck3" onclick="calculate_amount()">
	      <label class="custom-control-label" for="customCheck3"><b>Formatting</b>(USD $500)</label>
	    </div>
	  </div>

	 <div class="form-group col-md-12" align="center">
        <div class="row ">
          <div class="col-md-5"align="right"> 
            <label for="exampleInputEmail1"  ><b>Price USD</b></label>
        </div>
        <div class="col-md-4" align="left">
            <input type="text" class="form-control" name="amount" id="price" value="" aria-describedby="emailHelp" placeholder="Enter Price">
        </div>
    </div>
    </div>

	<div class="form-group col-md-12" align="center">
		  <div class="row ">
          <div class="col-md-5" align="right"> 
            <label for="exampleInputEmail1"  ><b>Choose File</b></label>
          </div>
            <div class="input-group mb-3 col-md-4" align="left">
              <div class="custom-file ">
                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                <input type="file" class="custom-file-input" id="file_upload" name="file_upload" >
              </div>
          </div>
      </div>
     <!-- onchange=" return check_file() -->
    </div>
      <div class="form-group col-md-12" align="center">
         <div class="row ">
          <div class="col-md-5" align="right"> 
            <label for="exampleInputEmail1"  ><b>Captcha</b></label>
        </div>
        <div class="col-md-4" align="center">
            <div id="recaptcha" class="g-recaptcha" data-sitekey="6LfvSqQUAAAAADNPqTuVPU6C1Jnyy6bChdIzabHI"></div>
        </div>
        <span style="color: red;" class="msg-error error"></span>
        
    </div><br>
    <div class="col-md-8" align="center"><button id="rzp-button"  onclick=" return validate_form(event); " class="btn btn-primary">Submit</button></div>
  </div>
</form>
</div>
</body>
<script type="text/javascript">

function calculate_amount(){
	var amount=0;
	$("input[type=checkbox]:checked").each(function() {
   amount+=parseInt(this.value);
});
	$("#price").val(amount);
}
function validate_form(event){
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
    proccedToPayment(event)
  }
 
}
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var amount = 0;
 function proccedToPayment(e){
  
      amount = parseInt($('#price').val())*100;
        var options = {
            "key": "rzp_test_ZfRCFUXqVZxZmv",
            "amount": amount,
            "name": "Five Feed",
            "description": "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            "image": "https://www.fflspl.com/images/logo.png",
            "handler": function (response){
                console.log(response.razorpay_payment_id);
            },
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
        e.preventDefault();
    
}
</script>