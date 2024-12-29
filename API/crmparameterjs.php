<script src="assets/jquery.js"></script>		
<script type="text/javascript">
$(document).ready(function(e){
	
	
	//show t24 showcategorydiv
$( "#showrequesttype" ).click(function() {
  
$(".t24div").show();

$(".categorydiv").hide();
$(".servicediv").hide();

//$(".lordingspins").show();
const div = document.getElementById('lordingspins');
            div.style.display = 'block';
            setTimeout(() => {
                div.style.display = 'none';
            }, 1000);


  
});	


$( "#showcategorydiv" ).click(function() {
  
$(".categorydiv").show();

$(".t24div").hide();

$(".servicediv").hide();

//$(".lordingspins").show(); showservicediv
const div = document.getElementById('lordingspins');
            div.style.display = 'block';
            setTimeout(() => {
                div.style.display = 'none';
            }, 1000);


  
});	


$( "#showservicediv" ).click(function() {
  
  
  $(".servicediv").show();
$(".categorydiv").hide();

$(".t24div").hide();

//$(".lordingspins").show(); servicediv
const div = document.getElementById('lordingspins');
            div.style.display = 'block';
            setTimeout(() => {
                div.style.display = 'none';
            }, 1000);


  
});	
	
	
	
	
event.preventDefault();

$(".t24div").hide();

$(".servicediv").hide();

$(".lordingspins").hide();

$(".loadernewnew").hide();

$(".categorydiv").hide();
//$("#result").html('Hiii'); categorydiv



$("#categoryform").submit(function(event) {
	
$(".loadernewnew").show();
var ajaxRequest;
event.preventDefault();
var values = $(this).serialize();

ajaxRequest= $.ajax({
url: "postfiles/allpostrequest.php",
method:"POST",
data:new FormData(this),
contentType:false,
cache:false,
processData:false,
});

      /*  request abort by ajaxRequest.abort() */

     ajaxRequest.done(function (response, textStatus, jqXHR){
          // show successfully for submit message
		  //$(".loader1").hide();
		  $(".response1").show();
          $(".response1").html(response);
		  
		  console.log(response);
		  //$(".result").show();
		  //getdistricttable(groupid);
		  
		  $(".loadernewnew").hide();
		  
     });

     /* On failure of request this function will be called  */
     ajaxRequest.fail(function (response, textStatus, jqXHR){

       // show error
      // $("#result").html('There  is an error while submit' + response);
     });



});	



$("#addserviceform").submit(function(event) {
	
$(".loadernewnew").show();
var ajaxRequest;
event.preventDefault();
var values = $(this).serialize();

ajaxRequest= $.ajax({
url: "postfiles/allpostrequest.php",
method:"POST",
data:new FormData(this),
contentType:false,
cache:false,
processData:false,
});

      /*  request abort by ajaxRequest.abort() */

     ajaxRequest.done(function (response, textStatus, jqXHR){
          // show successfully for submit message
		  //$(".loader1").hide();
		  $(".response1").show();
          $(".response1").html(response);
		  
		  console.log(response);
		  //$(".result").show();
		  //getdistricttable(groupid);
		  
		  $(".loadernewnew").hide();
		  
     });

     /* On failure of request this function will be called  */
     ajaxRequest.fail(function (response, textStatus, jqXHR){

       // show error
      // $("#result").html('There  is an error while submit' + response);
     });



});	







$("#requestform").submit(function(event) {
	
$(".loadernewnew").show();
var ajaxRequest;
event.preventDefault();
var values = $(this).serialize();

ajaxRequest= $.ajax({
url: "postfiles/allpostrequest.php",
method:"POST",
data:new FormData(this),
contentType:false,
cache:false,
processData:false,
});

      /*  request abort by ajaxRequest.abort() */

     ajaxRequest.done(function (response, textStatus, jqXHR){
          // show successfully for submit message
		  //$(".loader1").hide();
		  $(".response1").show();
          $(".response1").html(response);
		  
		  console.log(response);
		  //$(".result").show();
		  //getdistricttable(groupid);
		  
		  $(".loadernewnew").hide();
		  
     });

     /* On failure of request this function will be called  */
     ajaxRequest.fail(function (response, textStatus, jqXHR){

       // show error
      // $("#result").html('There is an error while submit' + response);
     });



});		
		

$('.addmembers').click(function(){
            var gid = $(this).attr("gid");
            
            console.log(gid);
            $.ajax({
               url: 'fetchsupportstaff.php',
               type: 'POST',
               data: {gid: gid},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    console.log(data);
                    $('#usr_grp').html(data);
               }
            });
    });		
	
 })//end of document.ready
</script>



 <script type="text/javascript">
 console.log('Andrews');
 
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");

        if(confirm('Are you sure to remove this record ?'))
        {
            
            $.ajax({
               url: 'delete.php',
               type: 'POST',
               data: {id: id, pg: 'heritagecompaintdetails', key: 'Complaints'},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+id).remove();
                    console.log(data);
                    alert("Record removed successfully");  
               }
            });
        }
    });

    $('.addmembers').click(function(){
            var gid = $(this).attr("gid");
            
            console.log(gid);
            $.ajax({
               url: 'fetchsupportstaff.php',
               type: 'POST',
               data: {gid: gid},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    console.log(data);
                    $('#usr_grp').html(data);
               }
            });
    });


</script>