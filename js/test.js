// JavaScript Document


function getValidateTestForm()
  { 
   	
	var fname= $.trim($('#first_name').val());

   	if(fname.length<1)
	 {
		$("#first_name").css({color:"red"});
		$("#first_name").focus();
	   //alert(123);
	    return false;
	 }
	 var lastName= $.trim($('#last_name').val());
	 //alert(fName); 
	
	if(lastName.length<1) 
	 {
		$("#last_name").css({color:"red"});
		$("#last_name").focus();
		return false;	 
	 }
	 //////////////////
	 
	var rege1 = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
   	var email=ltrim($("#user_email").val());
	//alert(email);
	if(email.length<1) 
	 {
		$("#user_email").css({color:"red"});
		$("#user_email").focus();
		return false;	 
	 }
    if(email!=""){
	if(email.length<1) 
	 {
		$("#user_email").css({color:"red"});
		$("#user_email").focus();
		return false;	 
	 }	 
	if(!(rege1.test($('#user_email').val()))){	
		$("#user_email").css({color:"red"});
		$("#user_email").focus();
		return false;
	 }
    }
	var pass=$.trim($('#user_password').val());
	//alert(pass);
	
	if(pass.length<1)
	 {
		$("#user_password").css({color:"red"});
		$("#user_password").focus();
	   //alert(123);
	    return false;
	 }
	var conpass=$.trim($('#conf_password').val());
	if(conpass.length<1)
	 {
		$("#conf_password").css({color:"red"});
		$("#conf_password").focus();
	   //alert(123);
	    return false;
	 }	
	 if(pass!=conpass)
	 {
	 $("#conf_password").css({color:"red"});
		$("#conf_password").focus();
	   //alert(123);
	    return false;
	 
	 }
	
	  
	  
	 var contact = $.trim($('#contactno').val());
	if(isNaN(parseInt(contact)))
	{
		$("#contactno").css({color:"red"});
		$( "#contactno" ).focus();
		return false;
	}
	
	var qualification=$.trim($('#qualification').val());
	
	if(qualification.length<1) 
	 {
		$("#qualification").css({color:"red"});
		$("#qualification").focus();
		return false;	 
	 }
	 if(qualification==1)
	 {
	
	 var otherQual=$.trim($('#otherqual').val());
	 if(otherQual.length<1) 
	 {
	  $("#otherqual").css({color:"red"});
		$("#otherqual").focus();
		return false;	
	 
	 }
	 }
///////////////////
 var stream=$.trim($('#stream').val());
	
	if(stream.length<1) 
	 {
		$("#stream").css({color:"red"});
		$("#stream").focus();
		return false;	 
	 }
	 if(stream==2)
	 {
	
	 var otherStr=$.trim($('#other_stream').val());
	 if(otherStr.length<1) 
	 {
	  $("#other_stream").css({color:"red"});
		$("#other_stream").focus();
		return false;	
	 
	 }
	 }


//////////////////////
	  var college=$.trim($('#college').val());
	
	if(college.length<1) 
	 {
		$("#college").css({color:"red"});
		$("#college").focus();
		return false;	 
	 }
	
	  var city=$.trim($('#city').val());
	
	if(city.length<1) 
	 {
		$("#city").css({color:"red"});
		$("#city").focus();
		return false;	 
	 }
	
	
  } 
  function ltrim(argvalue)
{
	while(1)
	{if(argvalue.substring(0,1)!=" ")
	break;argvalue=argvalue.substring(1,argvalue.length);}
	return argvalue;
} 
function checkPass()

{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('user_password');
    var pass2 = document.getElementById('conf_password');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}  
function isNumberKey(evt)
   {
   //alert(evt);
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
      }
	 return true;
   }
    
function otherstrem(id)
   {
   if(id==2)
   {
   
   $("#otherstream").show();
   
   } else {
   
    $("#otherstream").hide();
   }
 
  } 
function other_qual(id)
  {
 // alert(id);
  if(id==1)
   {
   
 	  $("#other_quali").show();
   
   }
    else {
   
    	$("#other_quali").hide();
   }
 
  
  }
  function alpha(e) {
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
}
