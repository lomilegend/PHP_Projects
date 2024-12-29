
<?php

$agentCode=$_GET['agentCode'];	



//include("PHPMailer/testmail.php");
/* date_default_timezone_set('UTC');
$time=date('Y/m/d H:i:s');
$timestamp=date('Y-m-d H:i:s');


$auto1 = mysqli_query($dbc,"SHOW TABLE status LIKE 'helpdeskissuelogged'");
$auto1data=mysqli_fetch_assoc($auto1);
	
$autoidnumber = $auto1data['Auto_increment'];

$num="ITH-000-";
$id =$num.$autoidnumber;
// $MNEMONIC=$id;
$MNEMONIC = date('Ymd')."-".$autoidnumber;
 */
		
//echo "this is the time $time";
//$MNEMONIC=$num.$id;
//error_reporting(E_ALL);

?>

<?php //include("submit_ticket.php"); ?>


<script src="vendors/jquery.js"></script>

<script src="vendors/tinymce/js/tinymce/tinymce.min.js"></script>



<script>

$(document).ready(function (){
 
 // this bprevents form validation on required field
   
 
     /* $('input[type=text], select').each(function() {    
       //$(this).removeAttr('required');
	   
	   
	   $(this).addClass('input100');
	   
     });
	  */
	 /* var inputs = document.querySelectorAll('input[type=text]');
    inputs.forEach(function (input) {
        input.classList.add("input100");
		
    })
	  */
	 
	 
	 
	 
  
 }); 

</script>


<script src="vendors/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php include("ticket_js_file_crm.php");  ?>


<div class="loader1" id="loader1"><img src="images/loader.gif" />Submiting...</div> 
<div id="result"></div>


<form class="form-horizontal ticketform" role="form" action="" method="post" width="" enctype="multipart/form-data" id="ticketform">	
                                            <div id="progressbarwizard">

<ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                                                   



<li class="nav-item">
<a class="nav-link active" data-bs-toggle="tab" role="tab"
aria-current="page" href="#profiletab2"
aria-selected="true">
<p class="mb-1"><i class="feather-home"></i></p>
<p class="mb-0 text-break">Customer Profile</p>
</a>
</li>


<li class="nav-item">
<a class="nav-link" data-bs-toggle="tab" role="tab"
aria-current="page" href="#account2"
aria-selected="true">
<p class="mb-1"><i class="feather-phone"></i></p>
<p class="mb-0 text-break">Create Ticket</p></a>
</li>


                                                  
													<!--
                                                    <li class="nav-item">
                                                        <a href="#finish-2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                                            <span class="d-none d-sm-inline">Attachment</span>
                                                        </a>
                                                    </li>
													
													-->
													
													
                                                </ul>
                                            
                                                <div class="tab-content b-0 mb-0 pt-0 card">
                                            
                                                    <div id="bar" class="progress mb-3" style="height: 7px;">
                                                        <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                                                    </div>
                                            
                                                    <div class="tab-pane card" id="account2">
                                                        <div class="row">
														
	<input type="hidden" id="issue_id" name="issue_id" value="<?php echo "$MNEMONIC"; //echo $transactionmode; ?>" >
	<input tabindex="0" size="10" id="issue_log_date" name="issue_log_date" tabname="tab1" value="<?php echo $time; ?>" oldvalue="" class="form-control" maxlength="20" type="hidden">
									   

														
                                                            <div class="col-6">
															
													
													
<div class="form-group row mb-3">
                
<label class="col-md-3 col-form-label"  for="LOAN.PURPOSE">Request Type</label>

 <div class="col-md-9">		 	  
<select class="form-control" id="issue_type" name="issue_type" tabname="tab1" >
<option value="">Select a Request Type</option>
			   <?php		
						
                        $complaintcategory = mysqli_query($dbc,"SELECT * FROM issue_type order by ids");
                        while($complaintcategorydata = mysqli_fetch_array($complaintcategory)){
							
							$complaintcategoryid=$complaintcategorydata["issuedescription"];
							$complaintcategoryCategory_Type=$complaintcategorydata["issuename"];
							
                echo "<option value='$complaintcategoryid'>
                    $complaintcategoryid ($complaintcategoryCategory_Type)
                </option>";
							
							 }
                        ?>
</select>
			  
</div>
</div>





 <div class="form-group row mb-3">
                
          <label class="col-md-3 col-form-label"  for="LOAN.PURPOSE">Service Category</label>
	
 <div class="col-md-9">	
<select class="form-control" id="Request_Category" name="Request_Category" tabname="tab1" >
<option>Select a Category</option>
			   <?php		
						
                //         $complaintcategory = mysqli_query($dbc,"SELECT * FROM heritagecattypetable order by id");
                //         while($complaintcategorydata = mysqli_fetch_array($complaintcategory)){
							
				// 			$complaintcategoryid=$complaintcategorydata["@ID"];
				// 			$complaintcategoryCategory_Type=$complaintcategorydata["Category_Type"];
							
                // echo "<option value='$complaintcategoryid'>
                //     $complaintcategoryCategory_Type ($complaintcategoryid)
                // </option>";
							
				// 			 }
                        ?>
</select>
			  
</div>	

</div>

 <div class="form-group row mb-3">
                
     <label class="col-md-3 col-form-label"  for="LOAN.REASON">Service Name</label>
	 
	  <div class="col-md-9">
<select class="form-control input100" id="Request_Type" name="Request_Type" tabname="tab1" >

<option>Select Description</option>
<?php		
						
//      $complaintdescription = mysqli_query($dbc,"SELECT * FROM heritagecompaintdetails order by Complaints");
//      while($complaintdescriptiondata = mysqli_fetch_array($complaintdescription))
// 	 {
							
// 	$Complaints=$complaintdescriptiondata["Complaints"];
							
//    echo "<option value='$Complaints'> $Complaints</option>";
							
// 	}
?>
</select>

</div>
</div>



<div class="form-group row mb-3">
                
     <label class="col-md-3 col-form-label"  for="LOAN.REASON">Status</label>
	 
	 <div class="col-md-9"> 
<select class="form-control" id="status" name="status" tabname="tab1" >

<option value="Open">Open</option>
<!-- <option value="Pending">Pending</option>
<option value="Close">Close</option>
<option value="Resolved">Resolved</option> -->
</select>

</div>
</div>


<div class="form-group row mb-3">
                
     <label class="col-md-3 col-form-label"  for="LOAN.REASON">Urgency</label>
	 
	  <div class="col-md-9">
<select class="form-control" id="Urgency" name="Urgency" tabname="tab1" >

<option value="High">High</option>
<option value="Medium">Medium</option>
<option value="Low">Low</option>
<option value="None" selected>None</option>
</select>

</div>


</div>





 <div class="form-group row mb-3">
                
           <label class="col-md-3 col-form-label"  for="NOTES">Description</label>
		    <div class="col-md-9">
<textarea id="tinymce_full" name="Description" class="form-control input-xlarge textarea" cols="50" rows="5" wrap="physical"  tabindex="0" tabname="tab1" oldvalue=""></textarea>

</div>
</div>


            
           
															
													
													
													
													
															
                                                                
                                                            </div> <!-- end col -->
															
															
															
															<div class="col-6">
															
															
															
														 <div class="form-group row mb-3">
                
           <label class="col-md-3 col-form-label"  for="NOTES">Transaction Amount</label>
		    <div class="col-md-9">
<input id="transaction_amount" name="transaction_amount" class="form-control" cols="50" rows="5" type="number">
</div>
</div>





<div class="form-group row mb-3 wrap-input100">
                
<label class="col-md-3 col-form-label"  for="NOTES">Transaction Reference</label>
		    
<div class="col-md-9 wrap-input100 validate-input">
	
<input id="transaction_reference_num" name="transaction_reference_num" class="form-control input100" cols="50" rows="5" type="text">
<span class="focus-input100"></span>	
</div>


</div>







<div class="form-group row mb-3">
                
           <label class="col-md-3 col-form-label"  for="NOTES">Root Cause</label>
		   
<div class="col-md-9">	   
<select  name="root_cause" id="root_cause" class="form-control">
<option value="" selected="selected">  </option>
<option value="Document Missing">Document Missing</option>
<option value="Failure to action customer request">Failure To Action Customer Request</option>
<option value="Human Error">Human Error</option>
<option value="Mis-Sold Products/Services">Mis-sold Products/services</option>
<option value="Miscommunication">Miscommunication</option>
<option value="Poor Service Delivery">Poor Service Delivery</option>
<option value="Product Knowledge Gap">Product Knowledge Gap</option>
<option value="Staff Conduct">Staff Conduct</option>
<option value="Suspicious Transactions">Suspicious Transactions</option>
<option value="System Error">System Error</option>
<option value="System Failure">System Failure</option>
<option value="Undue Delays">Undue Delays</option>
</select>	

</div>

</div>




<div class="form-group row mb-3">
<label for="image" class="col-md-3 col-form-label" >Attachment</label>
<fieldset>
                                                    
													
<div class="form-group">
              




<input type="submit" value="Add Attachment" id="addattachmentButton" class="btn-success"/>

<div class="addattachment" id="addattachment">


<div class="table-responsive" style="overflow-x:auto;">
  <INPUT type="button" value="Add More" onclick="addRow('dataTable')" />

  <INPUT type="button" value="Remove File" onclick="deleteRow('dataTable')" />
    

<table border="1" class="table table-striped table-bordered" width="350px" id="dataTable" >
    <TR>
      <TD><INPUT type="checkbox" name="chk[]"/></TD>
         
          
<td>
<label class="control-label"><input type="file" name="files[]" id="files" accept="" style="margin-top:15px;" class="span12">

</label>


</td>


</tr>
</table>





</div>

</div>
		   
      
          		









<input tabindex="0" size="35" id="transactionmode" name="transactionmode"  value="<?php echo "$transactionmode"; //echo $transactionmode;  ?>" class="span11" maxlength="35" type="hidden">



<input tabindex="0" size="35" id="resolved_date" name="resolved_date"  value="" class="span11" maxlength="35" type="hidden">

<input tabindex="0" size="35" id="resolved_by" name="resolved_by"  value="" class="span11" maxlength="35" type="hidden">

<input tabindex="0" size="35" id="assigned_to" name="assigned_to"  value="Not Assigned" class="span11" maxlength="35" type="hidden">

<input tabindex="0" size="35" id="log_by" name="log_by"  value="<?php echo "$username1"; //echo $USERNAME; ?>" class="span11" maxlength="35" type="hidden">	
							
<input tabindex="0" size="35" id="user_type" name="user_type"  value="<?php echo $_SESSION['type']; //echo $USERNAME; ?>" class="span11" maxlength="35" type="hidden">	




<!--<input  size="35" id="AgentCode" name="AgentCode"  value="<?php 

 if($_SESSION['type']=='Clients'){
	 
echo $_SESSION['AgentCode']; 
//echo "This is a test the get";

}else{

$agentCode=$_GET['agentCode'];

echo $agentCode; 
	
}
 
 ?>" class="span11"  type="text">	
 
 -->
				
</fieldset>






</div>	
												
	


	<?php //include("inc/ticket_log_customer_infor.php"); ?>
	
															
															
                                                               
                                                            </div> <!-- end col -->
															
                                                        </div> <!-- end row -->
                                                    </div>

                                                    <div class="tab-pane active" id="profiletab2">
													
													
													
													<div id="customerinfor"></div>
													
													<?php //include("inc/ticket_log_customer_infor.php"); ?>

       
													
                                                        <div class="row">
                                                            
															
															
															<?php include("inc/ticket_log_customer_infor.php"); ?>
															
                                                                
                                                                
                                        
                                                                
                                                           
                                                        </div> <!-- end row -->
                                                    </div>
<!--
                                                    <div class="tab-pane" id="finish-2">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="text-center">
                                                                    
                                                                    

                                            
                                            <div class="fallback">
                                                <input id="customerimage" name="file" class="form-control" type="file" multiple />
                                            </div>
    
                                            <div class="dz-message needsclick">
                                                <p class="h1 text-muted"><i class="mdi mdi-cloud-upload"></i></p>
                                                <h3>Drop files here or click to upload.</h3>
                                                
                                            </div>
                                       
																	
																	
																	
											<div class="dropzone-previews mt-3" id="file-previews"></div>

         <input class="btn btn-primary nextBtn pull-right issueshow" type="submit"  value="finish" name="Submit" id="issueshow">
                       
                                                                </div>
                                                            </div> 
                                                        </div> 
                                                    </div>
													<!-- end row -->
													

                                                    <ul class="list-inline mb-0 wizard">
                                                        
                                                        <li class="next list-inline-item float-center">
														
		<a data-bs-toggle="tab" role="tab" aria-current="page" href="#account2" aria-selected="true" class="btn btn-secondary" >Next</a>
                                                        </li>
														
														<li class="next list-inline-item float-right">
                                        <input class="btn btn-success nextBtn pull-right issueshow" type="submit"  value="Submit" name="Submit" id="issueshow">
                                                        </li>
                                                    </ul>

                                                </div> <!-- tab-content -->
                                            </div> <!-- end #progressbarwizard-->
                                        </form>		
						
						


<SCRIPT language="javascript">
        function addRow(tableID) {

            var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            var colCount = table.rows[0].cells.length;

            for(var i=0; i<colCount; i++) {

                var newcell    = row.insertCell(i);

                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            }
        }

        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }


            }
            }catch(e) {
                alert(e);
            }
        }

    </SCRIPT>

<script>

$(document).ready(function(){
	$('#addattachment').hide('');
 $('#addattachmentButton').on('click', function(event){
  event.preventDefault();
  $('#addattachment').show('');
  addattachment
  //var bank_code = $('.bank_code').val();
  //$('#result').html('Loading');
  //console.log("It Clicked");
  $.ajax({
   url:"",
   method:"POST",
   data:{bank_code: bank_code},
   //dataType:'json',
   //contentType:false,
   //cache:false,
   //processData:false,
   success:function(jsonData)
   {
    //$('#csv_file').val('');
	//$('#errorcheckdiv').html(jsonData);
    
   }
   
  
  
  });
 });
});






$(document).ready(function() {
    $('table.data-table').DataTable();
} );

</script>