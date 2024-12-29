
<?php

	

if(isset($_POST['submit'])){
    $reason = $_POST['reason'];
    $status = $_POST['status'];
    $Request_Type = $_POST['Request_Type'];
$Request_Category=$_POST['Request_Category'];

$recommendation=$_POST['recommendation'];

$columname="issue_id";

    if($status == 'Approve'){
        $date=date('Y/m/d H:i:s');
        $que = "UPDATE $tablename SET `status` = 'Open' WHERE `$columname`= '$cust_id'";
        $applicant = mysqli_query($dbc,$que);
        $status = 'Approved';

        //0.
        $r_cat_type_q = "Select id from heritagecompaintdetails where `Complaints` = '$Request_Type'";
		$r_cat_type_r = mysqli_query($dbc,$r_cat_type_q);
		$r_cat_type_data = mysqli_fetch_array($r_cat_type_r);
		$service_name_id = $r_cat_type_data['id'];

        //1. Delete current assigned_to data in issue_users table
        $dq = "delete from issue_users where issue_id = '$cust_id'";
        $del_result = mysqli_query($dbc,$dq);

        //2. assign to respective agents
        $ar_q = "Select user_id from heritagecompaintdetails_users where group_id = '$service_name_id'";
        $ar_r = mysqli_query($dbc,$ar_q);
        $respective_agents_ids=array();
        while($ar_data = mysqli_fetch_array($ar_r)){
            $responsible_user_id = $ar_data['user_id'];
            $pending_w_q = "INSERT INTO issue_users (`issue_id`, `user_id`) VALUES ('$cust_id','$responsible_user_id')";
            $pending_w_r = mysqli_query($dbc,$pending_w_q);
            array_push($respective_agents_ids, $responsible_user_id);
        }

        //. get issue details
        $issue_q = "Select * from helpdeskissuelogged where issue_id = '$cust_id'";
		$issue_r = mysqli_query($dbc,$issue_q);
		$issue_data = mysqli_fetch_array($issue_r);
        $issue_logby_username = $issue_data['log_by'];

        //3a. get approver and agent details
        $approver_q = "Select name,email from users where username in ('$username1','$issue_logby_username')";
		$approver_r = mysqli_query($dbc,$approver_q);
		while($approver_data = mysqli_fetch_array($approver_r)){
            $receiver_name = $approver_data['name'];
            $email_to = $approver_data['email'];

            //3b. send mail to approver and agent
            $email_subject="Status Update";
            include('email_notifications.php');
            mysqli_query($dbc,"INSERT INTO `emails`(`receiver`, `message`, `received_on`, `status`, `type`, `subject`, `issue_id`) 
            VALUES ('$email_to', '$email_message', '$date', 'not sent', 'Issue Update', '$email_subject', '$cust_id')");
        }

        //4a. get assigned agent(s) details
        $respective_agents_ids_str = implode("','",$respective_agents_ids);
        $rcv_q = "Select name,email from users where user_id in ('$respective_agents_ids_str')";
		$rcv_r = mysqli_query($dbc,$rcv_q);
		while($rcv_data = mysqli_fetch_array($rcv_r)){
            $receiver_name = $rcv_data['name'];
            $email_to = $rcv_data['email'];

            //4b. send mail to approver and agent
            $email_subject="Status Update";
            include('email_notifications.php');
            mysqli_query($dbc,"INSERT INTO `emails`(`receiver`, `message`, `received_on`, `status`, `type`, `subject`, `issue_id`) 
            VALUES ('$email_to', '$email_message', '$date', 'not sent', 'Issue Update', '$email_subject', '$cust_id')");
        }
    
        

        // //. get issue details
        // $issue_q = "Select * from helpdeskissuelogged where issue_id = '$cust_id'";
		// $issue_r = mysqli_query($dbc,$issue_q);
		// $issue_data = mysqli_fetch_array($issue_r);
        // $issue_username = $issue_data['username'];
        // $issue_description = $issue_data['description'];
        // $issue_Primary_Location = $issue_data['Primary_Location'];
        // $issue_type = $issue_data['type'];
        // $issue_status = $issue_data['status'];
        // $issue_log_date = $issue_data['log_date'];
        
        // //. send mail to approver
        // include('email_approved_approver.php');
        // $email_to=$approver_email;
        // $message=$email_message;
        // $email_subject='NIB SERVICE DESK REQUEST [Ticket#'.$MNEMONIC.']';
        // mysqli_query($dbc,"INSERT INTO `emails`(`receiver`, `message`, `received_on`, `status`, `type`, `subject`, `issue_id`) 
        // VALUES ('$email_to', '$message', '$timestamp', 'not sent', 'Pending Approval', '$email_subject', '$MNEMONIC')");

        


        header("location:customerlistactive.php");
        


    }elseif($status == 'Close'){
        $date=date('Y/m/d H:i:s');
        $que = "UPDATE $tablename SET `status` = '$status', `resolved_by`= '$username1' ,`resolved_date`='$date' WHERE `$columname`= '$cust_id'";
        $applicant = mysqli_query($dbc,$que);
        header("location:customerlistactive.php");
		
		
		//send confirmation mail to the client
		
		
		$issue_q = "Select * from helpdeskissuelogged where issue_id = '$cust_id'";
		$issue_r = mysqli_query($dbc,$issue_q);
		$issue_data = mysqli_fetch_array($issue_r);
        $issue_logby_username = $issue_data['log_by'];
		
		$receiver_name = $issue_data['nameofapplicant'];
		$resolved_by = $issue_data['resolved_by'];
		$emailaddress = $issue_data['emailaddress'];
		
		
		$email_subject="Ticket #$cust_id Resolved";
            include('email_notifications_resolved_confirm.php');
            mysqli_query($dbc,"INSERT INTO `emails`(`receiver`, `message`, `received_on`, `status`, `type`, `subject`, `issue_id`) 
            VALUES ('$emailaddress', '$email_message', '$date', 'not sent', 'Issue Completion', '$email_subject', '$cust_id')");
		
		
		
		
		$logger_q = "Select name,email from users where username in ('$username1','$issue_logby_username')";
		$logger_q_r = mysqli_query($dbc,$logger_q);
		$logger_q_r_data = mysqli_fetch_array($logger_q_r);
            $receiver_name = $logger_q_r_data['name'];
            $email_to = $logger_q_r_data['email'];
		
		
		$email_subject="Ticket #$cust_id Resolved";
            include('email_notifications_resolved_confirm.php');
            mysqli_query($dbc,"INSERT INTO `emails`(`receiver`, `message`, `received_on`, `status`, `type`, `subject`, `issue_id`) 
            VALUES ('$email_to', '$email_message', '$date', 'not sent', 'Issue Completion', '$email_subject', '$cust_id')");
		
		
		
		
		
		
		
		
		//Make this change later, this is to handle closed status
    }elseif($status == 'Close1'){
        $date=date('Y/m/d H:i:s');
        $que = "UPDATE $tablename SET `status` = '$status', `closed_by`= '$username1' ,`closed_date`='$date' WHERE `$columname`= '$cust_id'";
        $applicant = mysqli_query($dbc,$que);
        header("location:customerlistactive.php");
    }
    else{
        $date=date('Y/m/d H:i:s');
        $que = "UPDATE $tablename SET `status` = '$status' WHERE `$columname`= '$cust_id'";
        $applicant = mysqli_query($dbc,$que);

        if(trim($_SESSION['type']) == 'Staff'|| trim($_SESSION['type'])=='Supervisor'){
            header("location:customerlistmytickets.php");
        }else if (trim($_SESSION['type']) == 'Agent'){
            header("location:customerlistactive.php");
        }
    }
    
    // if($status == 'Resolved'){
    //     $q1 = "Select * from helpdeskissuelogged where issue_id ='$cust_id'";
    //     $r1 = mysqli_query($dbc,$q1);
    //     $d1 = mysqli_fetch_array($r1);
    //     $log_time = $d1['issue_log_date'];
    //     $current_time = date('Y/m/d H:i:s');

    //     elapsedtime($log_time, $current_time);
    //     echo $elapsed;
    //     exit;
    //     $issue_time="INSERT INTO `issue_elapsed`(`issue_id`, `duration`)
	// 				VALUES('$cust_id','$duration')";
	// 		$traildata = mysqli_query($dbc,$trail);
    // }
	$date=date('Y/m/d H:i:s');;
	
	$offlineld = mysqli_query($dbc,"SELECT * FROM helpdeskissuelogged where `issue_id`='$cust_id'");
                            
                            $offlinelddata=mysqli_fetch_array($offlineld);
                           
                            $log_by = $offlinelddata['log_by'];
	
	
	$log_by_q=mysqli_query($dbc,"select * from users where `username`='$log_by' LIMIT 1");
                        $log_by_d = mysqli_fetch_assoc($log_by_q);
                            $log_by_name =  $log_by_d['name'];
                            $log_by_contact =  $log_by_d['telephone'];
                            $log_by_extension =  $log_by_d['extension'];
                            $email_to =  $log_by_d['email'];
	
	
	
	//update the issue status on T24 email_notifications
//$customerresponsefile=file_get_contents("http://10.10.2.18:8080/TAFJServices/services/OFSService/Invoke?Request=CR.CONTACT.LOG,/I/PROCESS//1,CRMUSER/Admin@123,$cust_id,CONTACT.STATUS=PENDING");	
	
	
		$trail="INSERT INTO `heldeskactivities`(`issue_id`, `remarks`, `updated_by`,`action_taken`, `status`, `description`,`request_type`,`Request_Category`,`recommendation`)
					VALUES('$cust_id','$reason','$username1','$reason','$status','$reason','$Request_Type','$Request_Category','$recommendation')";
			$traildata = mysqli_query($dbc,$trail);
	
	
	
	
	
	
	/*
    if($status == "Close"){
        $resolved_by = $_SESSION['username'];
        $query = "UPDATE helpdeskissuelogged SET status = '$status', resolved_by = '$resolved_by' WHERE ids = '$ids'";
    }else{
        $query = "UPDATE helpdeskissuelogged SET status = '$status' WHERE ids = '$ids'";
    }
    
 
    $q = mysqli_query($dbc,$query) or mysqli_connect_error("Error");
*/
    if ($applicant=1){
        echo '<center><p class=" h4 alert alert-success" role="alert">Updated Successfully.<br>  </center>';
             
   } else {
             echo '<center><p class=" h4 alert alert-danger" role="alert">An Error Occur Please Try Again! </center>';
    }

    // header("location:loginpwdchange.php");
	
	
	foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
    $file_name=$_FILES["files"]["name"][$key];
    $file_tmp=$_FILES["files"]["tmp_name"][$key];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);

    
        if(!file_exists("pictures/".$txtGalleryName."/".$file_name)) {
            move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"pictures/".$txtGalleryName."/".$file_name);
        }
        else {
            $filename=basename($file_name,$ext);
            $newFileName=$filename.time().".".$ext;
            move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"pictures/".$txtGalleryName."/".$newFileName);
        }
    

$sql="INSERT INTO `tbl_uploads`(`file`,`type`,`size`,`issue_id`,`usertype`,`upload_by`,`date`) VALUES('$file_name','$ext','$file_name','$cust_id','staff','$username1','$date')";
		
$insert1data = mysqli_query($dbc,$sql);	



}
	
	
	
	
	
	
 
}

?>


<form method="post" enctype="multipart/form-data" class="comment-area-box mt-2 mb-3">
                                            <span class="input-icon">
                                                    <textarea rows="3" class="form-control" placeholder="Write something..." id="reason" name="reason"></textarea>
                                                </span>
 		
<div class="comment-area-btn">
<div class="float-right">





</div>
</div>

			
<div class='row'>

<div class="col-md-4">
<div class="form-group">


<select class="form-control" name="status" required="required">
<option value=''>Update Status</option>
<?php
$user_type = trim($_SESSION['type']);
if($user_type =='Staff'){
if($status == 'Resolved'){
?>
<option value='Open'>Open</option>
<option value='Close'>Close</option>
<?php
}elseif($status == 'Open'){
?>
<option value='PENDING'>Update</option>
<option value='Close'>Close</option>
<?php
}

}
else if($user_type =='Agent'||$user_type =='Administrator') {
if($status == 'Open' OR $status == 'PENDING'){
?>
<option value='PENDING'>Pending</option>
<option value='Resolved'>Resolved</option>
<?php

}
else if($status == 'Resolved'){
if($log_by == $username1){
?>
<option value='Close'>Close</option>
<?php
}else{
?>

<?php	
}


}
?>

<?php
} else if($user_type =='Supervisor'){
?>
<option value='Approve'>Approve</option>
<option value='Disapprove'>Disapprove</option>
<?php
} else if($user_type =='Supervisor' && $log_by == $username1){
?>
<option value='Approve'>Approve</option>
<option value='Disapprove'>Disapprove</option>
<?php
} //else if($log_by == $username1){
?>
<option value='Open'>Open</option>
<option value='Pending'>Pending</option>
<option value='Close'>Close</option>

<option value='Resolved'>Resolved</option>

<?php
//}

?>



</select>


</div>
</div>




<div class="col-md-6">
<div class="form-group">


<input type="submit" value="Add Attachment" id="addattachmentButton" class="btn btn-sm btn-dark waves-effect waves-light"/>

<div class="addattachment" id="addattachment">


<div class="table-responsive" style="overflow-x:auto;">
  <INPUT type="button" value="Add File" onclick="addRow('dataTable')" />

  <INPUT type="button" value="Remove File" onclick="deleteRow('dataTable')" />
    

<table border="1" class="table table-striped table-bordered" width="350px" id="dataTable" >
    <TR>
      <TD><INPUT type="checkbox" name="chk[]"/></TD>
         
          
<td>
<label class="control-label"><input type="file" name="files[]" id="files" accept="" style="margin-top:15px;" class="form-control">

</label>


</td>


</tr>
</table>


</div>





</div>




</div></div>








</div>


<input type="hidden" name="Request_Type" id="Request_Type" class="Request_Type" value="<?php echo $Request_Type; ?>" >

<input type="hidden" name="Request_Category" id="Request_Category" class="Request_Category" value="<?php echo $Request_Category; ?>" >



<br>



<input type="submit" class="btn btn-sm btn-success waves-effect waves-light"  value="Submit" name="submit" id="submit" <?php echo ($user_type =='Staff'&&$status=='Open') ? 'state="lock"':''; ?> >	
												
												

<div class="comment-area-btn">
<div class="float-right">





</div>
</div>											
<div class="loader1" id="loader1"><img src="images/loader.gif" />Loading...</div> 
<div class="result" id="result"></div>
												

<a class='knowledgesearch'>View Sample Solutions on request Type</a>											
		




<div class="comment-area-btn">
<div class="float-right">





</div>
</div>
		
</form>