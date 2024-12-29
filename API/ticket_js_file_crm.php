

<script>
function fetchcustomer() {
	var customer_id = $('.customer_id').val();
	 /* $('.customername').val('');
     $('.postaladdress').val('');
	 $('.email').val('');
	 $('.idnumber').val('');
	 $('.idtype').val('');
	
	  $('.PHONE_NUMBER').val('');
	   $('.DATE_OF_BIRTH').val('');
	   $('.OCCUPATION').val('');
	 $('.custname1').html(''); */
	 
	 
	 
	 console.log("This is good");
	 
$.ajax({ url: 'fetchcustomer.php',
 data: {customer_id: customer_id},
 type: 'post',
 success: function(output) {
 output = JSON.parse(output);
 
 
 $(".infordiv").show();
 
 
  console.log(output);
var customerid33 = output.customer_id;
 
 var customername = output.SHORT_NAME;
 $('.customername').val(customername);
 var postaladdress = output.STREET;
 $('.postaladdress').val(postaladdress);
 
 var email = output.EMAIL_1;
 $('.email').val(email);
 
 var idnumber = output.LEGAL_ID;
 $('.idnumber').val(idnumber);
 
 var idtype = output.LEGAL_DOC_NAME;
 $('.idtype').val(idtype);
 

 var custname1 = output.SHORT_NAME;
 $('.custname1').html("The customer exist view profile <br><a href='customerprofile.php?cust_id="+customerid33+"'> Click Me</a>");
 
 
 var PHONE_NUMBER = output.TEL_MOBILE;
 $('.PHONE_NUMBER').val(PHONE_NUMBER);
 
 var GENDER = output.GENDER;
 $('.GENDER').val(GENDER);
 
 var OCCUPATION = output.OCCUPATION;
 $('.OCCUPATION').val(OCCUPATION);
 
 
 var AgentCode = output.ID;
 $('.AgentCode').val(AgentCode);
 
 var STREET = output.STREET;
 $('.STREET').val(STREET);
 
 var DATE_OF_BIRTH = output.DATE_OF_BIRTH;
 $('.DATE_OF_BIRTH').val(DATE_OF_BIRTH);
 //var CONVERT =
 
//var mydate= new date(DATE_OF_BIRTH,'yyyy-m-d')

var date = DATE_OF_BIRTH; 
var year = date.slice(0,4);
 month = date.slice(4,6);
day = date.slice(-2);

// create new Date obj
var date123 = new Date(year, month, day);

// format using toLocaleDateString
//console.log(new Date(year, month, day).toLocaleDateString('en-GB'));

// custom format
//console.log(date.getFullYear() + ' ' + (date.getMonth()) + ' ' + date.getDate())


//output 2017 JUL 21


//calculate date of birthdate
var birthdate = new Date(date123);
var cur = new Date();
var diff = cur-birthdate; // This is the difference in milliseconds
var age = Math.floor(diff/31557600000); // Divide by 1000*60*60*24*365.25
  
  //
  var x = output.AGE;
switch (true) {
    case (x < 34):
        $('.DATE_OF_BIRTH1').val('18-34');
		
        break;
    case (x > 35 && x < 44):
        $('.DATE_OF_BIRTH1').val('35-44');
		
        break;
    case (x > 45 && x < 55):
       $('.DATE_OF_BIRTH1').val('45-55');
        break;
		
		case (x > 55):
       $('.DATE_OF_BIRTH1').val('ABOVE-55');
        break;
		
    default:
        $('.DATE_OF_BIRTH1').val('Choose a range');
        break;
}

  
  
  
 
 
 
 
 
 }
});
}






function fetchcustomermobile() {
	var customer_id = $('.PHONE_NUMBER').val();
	 /* $('.customername').val('');
     $('.postaladdress').val('');
	 $('.email').val('');
	 $('.idnumber').val('');
	 $('.idtype').val('');
	
	  //$('.PHONE_NUMBER').val('');
	   $('.DATE_OF_BIRTH').val('');
	   $('.OCCUPATION').val('');
	 $('.custname1').html(''); */
	 
	 
	  $(".infordiv").show();
	 console.log("This is good mobile");
	 
$.ajax({ url: 'fetchcustomermobile.php',
 data: {customer_id: customer_id},
 type: 'post',
 success: function(output) {
 output = JSON.parse(output);
 

  console.log(output);
var customerid33 = output.FLD_CU;
 
 
 var customer_id = output.customer_id;
 $('.customer_id').val(customer_id);
 
 
 var customername = output.SHORT_NAME;
 $('.customername').val(customername);
 var postaladdress = output.STREET;
 $('.postaladdress').val(postaladdress);
 
 var email = output.EMAIL_1;
 $('.email').val(email);
 
 var idnumber = output.LEGAL_ID;
 $('.idnumber').val(idnumber);
 
 var idtype = output.LEGAL_DOC_NAME;
 $('.idtype').val(idtype);
 

 var custname1 = output.SHORT_NAME;
 $('.custname1').html("The customer exist view profile <br><a href='customerprofile.php?cust_id="+customerid33+"'> Click Me</a>");
 
 
 var PHONE_NUMBER=output.SMS_1;
 //$('.PHONE_NUMBER').val(PHONE_NUMBER);
 
 var GENDER = output.GENDER;
 $('.GENDER').val(GENDER);
 
 var OCCUPATION = output.OCCUPATION;
 $('.OCCUPATION').val(OCCUPATION);
 
 
 var AgentCode = output.ID;
 $('.AgentCode').val(AgentCode);
 
 var STREET = output.STREET;
 $('.STREET').val(STREET);
 
 var DATE_OF_BIRTH = output.DATE_OF_BIRTH;
 $('.DATE_OF_BIRTH').val(DATE_OF_BIRTH);
 
 //var CONVERT =
 
//var mydate= new date(DATE_OF_BIRTH,'yyyy-m-d')

var date = DATE_OF_BIRTH; 
var year = date.slice(0,4);
 month = date.slice(4,6);
day = date.slice(-2);

// create new Date obj
var date123 = new Date(year, month, day);

// format using toLocaleDateString
//console.log(new Date(year, month, day).toLocaleDateString('en-GB'));

// custom format
//console.log(date.getFullYear() + ' ' + (date.getMonth()) + ' ' + date.getDate())


//output 2017 JUL 21


//calculate date of birthdate
var birthdate = new Date(date123);
var cur = new Date();
var diff = cur-birthdate; // This is the difference in milliseconds
var age = Math.floor(diff/31557600000); // Divide by 1000*60*60*24*365.25
  
  //
  var x = output.AGE;
switch (true) {
    case (x < 34):
        $('.DATE_OF_BIRTH1').val('18-34');
		
        break;
    case (x > 35 && x < 44):
        $('.DATE_OF_BIRTH1').val('35-44');
		
        break;
    case (x > 45 && x < 55):
       $('.DATE_OF_BIRTH1').val('45-55');
        break;
		
		case (x > 55):
       $('.DATE_OF_BIRTH1').val('ABOVE-55');
        break;
		
    default:
        $('.DATE_OF_BIRTH1').val('Choose a range');
        break;
}

  
  
  
 
 
 
 
 
 }
});
}




function fetchcustomerlegal() {
	var customer_id = $('.idnumber').val();
	 /* $('.customername').val('');
     $('.postaladdress').val('');
	 $('.email').val('');
	 $('.idnumber').val('');
	 $('.idtype').val('');
	
	  //$('.PHONE_NUMBER').val('');
	   $('.DATE_OF_BIRTH').val('');
	   $('.OCCUPATION').val('');
	 $('.custname1').html(''); */
	 
	 
	  $(".infordiv").show();
	 console.log("This is good Legal");
	 
$.ajax({ url: 'fetchcustomerlegalnumber.php',
 data: {customer_id: customer_id},
 type: 'post',
 success: function(output) {
 output = JSON.parse(output);
 

  console.log(output);
var customerid33 = output.FLD_CU;
 
 
 var customer_id = output.customer_id;
 $('.customer_id').val(customer_id);
 
 
 var customername = output.SHORT_NAME;
 $('.customername').val(customername);
 var postaladdress = output.STREET;
 $('.postaladdress').val(postaladdress);
 
 var email = output.EMAIL_1;
 $('.email').val(email);
 
 var idnumber = output.LEGAL_ID;
 //$('.idnumber').val(idnumber);
 
 var idtype = output.LEGAL_DOC_NAME;
 $('.idtype').val(idtype);
 

 var custname1 = output.SHORT_NAME;
 $('.custname1').html("The customer exist view profile <br><a href='customerprofile.php?cust_id="+customerid33+"'> Click Me</a>");
 
 
 var PHONE_NUMBER=output.SMS_1;
 $('.PHONE_NUMBER').val(PHONE_NUMBER);
 
 var GENDER = output.GENDER;
 $('.GENDER').val(GENDER);
 
 var OCCUPATION = output.OCCUPATION;
 $('.OCCUPATION').val(OCCUPATION);
 
 
 var AgentCode = output.ID;
 $('.AgentCode').val(AgentCode);
 
 var STREET = output.STREET;
 $('.STREET').val(STREET);
 
 var DATE_OF_BIRTH = output.DATE_OF_BIRTH;
 $('.DATE_OF_BIRTH').val(DATE_OF_BIRTH);
 
 //var CONVERT =
 
//var mydate= new date(DATE_OF_BIRTH,'yyyy-m-d')

var date = DATE_OF_BIRTH; 
var year = date.slice(0,4);
 month = date.slice(4,6);
day = date.slice(-2);

// create new Date obj
var date123 = new Date(year, month, day);

// format using toLocaleDateString
//console.log(new Date(year, month, day).toLocaleDateString('en-GB'));

// custom format
//console.log(date.getFullYear() + ' ' + (date.getMonth()) + ' ' + date.getDate())


//output 2017 JUL 21


//calculate date of birthdate
var birthdate = new Date(date123);
var cur = new Date();
var diff = cur-birthdate; // This is the difference in milliseconds
var age = Math.floor(diff/31557600000); // Divide by 1000*60*60*24*365.25
  

 }
});
}






		
		
</script>


<script type="text/javascript">

/* Attach a submit handler to the form */
$(".issueshow").click(function(event) {
     var ajaxRequest;

    /* Clear result div*/
    $("#result").html('');

    /* Get from elements values */
    var values = $(this).serialize();

    /* Send the data using post and put the results in a div */
    /* I am not aborting previous request because It's an asynchronous request, meaning 
       Once it's sent it's out there. but in case you want to abort it  you can do it by  
       abort(). jQuery Ajax methods return an XMLHttpRequest object, so you can just use abort(). */
       ajaxRequest= $.ajax({
            url: "submit_ticket.php",
            type: "post",
            data: values
        });

      /*  request cab be abort by ajaxRequest.abort() */

     ajaxRequest.done(function (response, textStatus, jqXHR){
          // show successfully for submit message
          $("#result").html('Submitted successfully');
     });

     /* On failure of request this function will be called  */
     ajaxRequest.fail(function (){

       // show error
       $("#result").html('There is error while submit');
     });



});


</script>




<script type="text/javascript">
//for handling the category and complaint description dropdown
$(document).ready(function(){
	event.preventDefault();
//console.log("Hello world!"); infordiv
 $(".loader1").hide();
	$(".Device_model").hide();
	
	
	$(".infordiv").hide();
	
	
	
	
	$(".transaction_reference_num1").hide();  
	
	
	
$("#ticketform").submit(function(event) {
     var ajaxRequest;
	 $(".loader1").show();
	 //$(".finish").disabled();
	 $("#finish").attr("disabled", true);
//console.log("Testing"); finish
//console.log("Hello world!");
    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
    $("#result").html('');

    /* Get from elements values */
    var values = $(this).serialize();

    /* Send the data using post and put the results in a div */
    /* I am not aborting previous request because It's an asynchronous request, meaning 
       Once it's sent it's out there. but in case you want to abort it  you can do it by  
       abort(). jQuery Ajax methods return an XMLHttpRequest object, so you can just use abort(). */
       ajaxRequest= $.ajax({
            url: "submit_ticket.php",
            method:"POST",
   data:new FormData(this),
   //data:{new FormData(this),csv_file:csv_file},
   //dataType:'String',
   contentType:false,
   cache:false,
   processData:false,
        });

      /*  request abort by ajaxRequest.abort() */

     ajaxRequest.done(function (response, textStatus, jqXHR){
          // show successfully for submit message
		  $(".loader1").hide();
          $("#result").html(response);
		  //$(".finish").enabled();
		  $("#finish").attr("disabled", false);
		  
		  
		  
Swal.fire({
  title: 'Submitted Successfully',
  icon: 'success',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#00BFFF',
  confirmButtonText: 'Finished',
  cancelButtonText: 'Add New Request',
}).then((result) => {
  if (result.value) {
   window.location.replace("customerlistactive.php"); 
  }
});
		  
		  
		  
		  //window.location.replace("customerlistactive.php");
		  //console.log(response);
     });

     /* On failure of request this function will be called  */
     ajaxRequest.fail(function (response, textStatus, jqXHR){

       // show error
       $("#result").html('There is an error while submit' + response);
     });



});	
	
	
	
	
	
	
	
	
	
	
	// console.log('Hello');
    $('#Request_Category').on('change',function(){
        var Request_Category = $(this).val();
		
		if(Request_Category=='54'){
			
		$(".transaction_reference_num1").show();
		
		}else{
		$(".transaction_reference_num1").hide();	
		}
		
        if(Request_Category){
            $.ajax({
                type:'POST',
                url:'fetchservicetype.php',
                data:'Request_Category='+Request_Category,
                success:function(html){
                    $('#Request_Type').html(html);
					//$(".Device_model").Show();
					// console.log('Hello');
                    //$('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#Request_Type').html('<option value="">Select Category first</option>');
            //$('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
});




//for handling the issue_type  dropdown
$(document).ready(function(){
    $('#issue_type').on('change',function(){
    //    var issue_type = $(this).val();
       var issue_type_long = $('#issue_type option:selected').text();
       var issue_type = issue_type_long.substring(
        issue_type_long.lastIndexOf("(") + 1, 
        issue_type_long.lastIndexOf(")")
        );
    //    alert(issue_type);
    $('#Request_Category').html('');
        if(issue_type){
            $.ajax({
                type:'POST',
                url:'fetchissuetype.php',
                data:'issue_type='+issue_type,
                success:function(html){
                    $('#Request_Category').html(html);
                    //$('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('.Request_Category').html('<option value="">Select country first</option>');
            //$('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
});



</script>