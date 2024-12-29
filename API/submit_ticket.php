<?php
error_reporting(0);
include("config/connection.php");

include("formfunction.php");



//$agentCode=$_GET['agentCode'];	




		
//echo "this is the time $time";
//$MNEMONIC=$num.$id;
//error_reporting(E_ALL);

?>



<?php
if ( isset( $_POST) ){



//include("PHPMailer/testmail.php");
date_default_timezone_set('GMT');
$time=date('Y/m/d H:i:s');
$timestamp=date('Y-m-d H:i:s');


$auto1 = mysqli_query($dbc,"SHOW TABLE status LIKE 'helpdeskissuelogged'");
$auto1data=mysqli_fetch_assoc($auto1);
	
$autoidnumber = $auto1data['Auto_increment'];

$num="ITH-000-";
$id =$num.$autoidnumber;
// $MNEMONIC=$id;
$MNEMONIC = date('Ymd')."-".$autoidnumber;




 $Request_Type=$_POST['Request_Type'];

$requesttypesearch = mysqli_query($dbc,"Select * from `heritagecompaintdetails` where `Complaints` ='$Request_Type'");
		$requesttypesearchdata = mysqli_fetch_array($requesttypesearch);
		$sla=$requesttypesearchdata['sla'];





//create customer table from post
global $dbc;
global $tablename;
global $table;
global $formfields;

$tablename="helpdeskissuelogged";
$formfields=$_POST;
$t24customerid;




$newarray=array("issue_id"=>"$MNEMONIC","@ID"=>"$MNEMONIC","CUSTOMERID"=>"12345","sla"=>"$sla");
//$body[]=$_POST;
$formfields=array_merge($_POST,$newarray);


/*  echo "<prev><br>";
	print_r($formfields);
	echo "</prev>"; */
	 
	$issue_id=$MNEMONIC;
	$Primary_Location=$_POST['Primary_Location'];
	$issue_log_date=$_POST['issue_log_date'];
	$issue_type=$_POST['issue_type'];
	$status=$_POST['status'];
    $description=$_POST['Description'];
	
	
	
	 
	 $username1=$_POST['log_by'];
	 
	 $log_for=$_POST['log_for'];
	 
	 $subject=$_POST['subject'];
	
	$user_type=$_POST['user_type'];
	
	
	$nameofapplicant=$_POST['nameofapplicant'];
	
	$mobilenumber=$_POST['mobilenumber'];
	
	$emailaddress=$_POST['emailaddress'];
	
	$GENDER=$_POST['CR_CUST_CAT'];
	
	$LEGAL_ID=$_POST['CR_ID_NUMBER'];
	
	$CONTACT_CLIENT=$_POST['CONTACT_CLIENT'];
	
	
	
	//create customer
$trailcust="INSERT INTO `brainbox_customer`(`@ID`,`FLD_CU`,`SHORT_NAME`,`PHONE_1`, `SMS_1`,`EMAIL_1`,`GENDER`,`LEGAL_ID`)
VALUES('$MNEMONIC','$CONTACT_CLIENT','$nameofapplicant','$mobilenumber','$mobilenumber','$emailaddress','$GENDER','$LEGAL_ID')";
$traildatacust = mysqli_query($dbc,$trailcust);	


//INSERT INTO `brainbox_customer`(`ids`, `@ID`, `FLD_CU`, `MNEMONIC`, `SHORT_NAME`, `ACCOUNT_OFFICER`, `NATIONALITY`, `RESIDENCE`, `SECTOR`, `INDUSTRY`, `CUSTOMER_STATUS`, `CONTACT_DATE`, `INTRODUCER`, `LEGAL_ID`, `REVIEW_FREQUENCY`, `BIRTH_INCORP_DATE`, `GLOBAL_CUSTOMER`, `CUSTOMER_LIABILITY`, `SECTOR_NAME`, `POSTING_RESTRICT`, `COMPANY_BOOK`, `ASSET_CLASS`, `CUSTOMER_RATING`, `ADDRESS`, `CR_PROFILE_TYPE`, `CR_PROFILE`, `NO_UPDATE_CRM`, `DATE_OF_BIRTH`, `GENDER`, `MARITAL_STATUS`, `PHONE_1`, `SMS_1`, `EMAIL_1`, `EMPLOYMENT_STATUS`, `OCCUPATION`, `ACCOUNT`, `CUSTOMER_TYPE`, `ACCOUNT_NO`, `INCLUDE_IMAGE`, `ADDR_LOCATION`, `MOBILE_BANKING_SERVICE`, `RISK_ASSET_TYPE`, `SPOKEN_LANGUAGE`, `DOMICILE`, `JOB_TITLE`, `CUSTOMER_SINCE`, `PREVIOUS_NAME`, `ALLOW_BULK_PROCESS`, `INTERNET_BANKING_SERVICE`, `NO_OF_DEPENDENTS`, `ISSUE_CHEQUES`, `status`, `transactionmode`, `SMS.1`, `EMAIL.1`) VALUES 


	
	
	
	//CREATE TABLE FUNCTIONS
createtable($tablename,$formfields,$dbc);

$application_name='UNITY BANK WE_CARE';
//INSERT INTO DATABASE        
		
	$approver = insertdata($tablename,$formfields,$dbc);
    
    if(isset($approver) && $approver != ''){
        $status = "Pending Approval";
    }
		
$trail="INSERT INTO `heldeskactivities`(`issue_id`,`remarks`,`updated_by`,`Logged_By`,`action_taken`, `status`,`description`)
VALUES('$MNEMONIC','$description','$username1','$username1','$description','$status','$description')";
$traildata = mysqli_query($dbc,$trail);	

	
	
	
	
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
    

$sql="INSERT INTO `tbl_uploads`(`file`,`type`,`size`,`issue_id`,`upload_by`,`date`) VALUES('$file_name','$ext','$file_name','$MNEMONIC','$username1','$date')";
		
		$insert1data = mysqli_query($dbc,$sql);	




	
}	
	
	
	
	
	
	
	
	
	
	
	
	$cImage_name = $_FILES['image']['name'];
    $cImage_tmp_name = $_FILES['image']['tmp_name'];
    $cImage_type = $_FILES['image']['type'];
    $cImage_size = $_FILES['image']['size'];

    $format = array('image/JPG', 'image/jpeg', 'image/png', 'image/JPEG');
	
	//Attach Document variables
	
	
	
	
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$folder="pictures/";
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$sql="INSERT INTO `tbl_uploads`(`file`,`type`,`size`,`issue_id`) VALUES('$final_file','$file_type','$new_size','$MNEMONIC')";
		
		$insert1data = mysqli_query($dbc,$sql);	
//echo "loaded";
		
	}
	else
	{
		//echo "not loaded";
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$document=basename($_FILES['fileToUpload']['name']);
$customerimage=$_FILES["customerimage"]["name"]; 

//Get the content of the image and then add slashes to it 
$customerimagedata=addslashes(file_get_contents($_FILES['customerimage']['tmp_name']));


//echo "$customerimagedata";

//print_r($customerimagedata);

$new_image_name = microtime(1).$cImage_name;

	 
move_uploaded_file($cImage_tmp_name,"pictures/$new_image_name");
		
			

//echo " the response $result <br>";



 $logged_for_q = "Select bank_name, contact_email from mfb_details where bank_code='$log_for'";
        $logged_for_r = mysqli_query($dbc,$logged_for_q);
        $logged_for_data = mysqli_fetch_array($logged_for_r);
        $logged_for_email = $logged_for_data['contact_email'];
        $logged_for_name = $logged_for_data['bank_name'];
		 


	
        if ($result) {
            
			
//$imagesq = mysqli_query($dbc,"UPDATE `helpdeskissuelogged` SET `customerimage`='$customerimagedata' WHERE `issue_id`='$MNEMONIC'") or mysqli_connect_error("Error");	

//$imagesq = mysqli_query($dbc,"UPDATE `helpdeskissuelogged` SET `customerimage`='$customerimagedata' WHERE `issue_id`='$MNEMONIC'") or mysqli_connect_error("Error");	
	
	    $logged_by_q = "Select email, name from users where username='$username1'";
        $logged_by_r = mysqli_query($dbc,$logged_by_q);
        $logged_by_data = mysqli_fetch_array($logged_by_r);
        $logged_by_email = $logged_by_data['email'];
        $logged_by_name = $logged_by_data['name'];
	
    if(isset($approver) && $approver!=''){
        //get approver email and name;
        $approver_details_q = "Select email, name from users where username='$approver'";
        $approver_details_r = mysqli_query($dbc,$approver_details_q);
        $approver_details_data = mysqli_fetch_array($approver_details_r);
        $approver_email = $approver_details_data['email'];
        $approver_name = $approver_details_data['name'];
		
        
      // echo "this the email $approver_email";
        include('email_approver.php');
         $email_to=$approver_email;
         
         $message=$email_message;
         $email_subject='UNITY BANK WE_CARE [Ticket#'.$MNEMONIC.']';
    //approver email
    //mysqli_query($dbc,"INSERT INTO `emails`(`receiver`, `message`, `received_on`, `status`, `type`, `subject`, `issue_id`) VALUES ('$email_to', '$message', '$timestamp', 'not sent', 'Pending Approval', '$email_subject', '$MNEMONIC')");

    }
    else{
        // //0.
        // $r_cat_type_q = "Select id from heritagecompaintdetails where `Complaints` = '$Request_Type'";
		// $r_cat_type_r = mysqli_query($dbc,$r_cat_type_q);
		// $r_cat_type_data = mysqli_fetch_array($r_cat_type_r);
		// $service_name_id = $r_cat_type_data['id'];

        // //1. Delete current assigned_to data in issue_users table
        // $dq = "delete from issue_users where issue_id = '$cust_id'";
        // $del_result = mysqli_query($dbc,$dq);

        // //2. assign to respective agents
        // $ar_q = "Select user_id from heritagecompaintdetails_users where group_id = '$service_name_id'";
        // $ar_r = mysqli_query($dbc,$ar_q);
        // $respective_agents_ids=array();
        // while($ar_data = mysqli_fetch_array($ar_r)){
        //     $responsible_user_id = $ar_data['user_id'];
        //     $pending_w_q = "INSERT INTO issue_users (`issue_id`, `user_id`) VALUES ('$cust_id','$responsible_user_id')";
        //     $pending_w_r = mysqli_query($dbc,$pending_w_q);
        //     array_push($respective_agents_ids, $responsible_user_id);
        // }
		
		//email to the agents
		
		//$ar_q = "Select * from heritagecompaintdetails_users where id = '$Request_Type'";
		
		
		
		$requesttypesearch = mysqli_query($dbc,"Select * from `heritagecompaintdetails` where `Complaints` ='$Request_Type'");
		$requesttypesearchdata = mysqli_fetch_array($requesttypesearch);
		$Request_Typevalue=$requesttypesearchdata['id'];
		
		
		$ar_r = mysqli_query($dbc,"Select * from `heritagecompaintdetails_users` where `group_id` ='$Request_Typevalue'");
		while($ar_data = mysqli_fetch_array($ar_r)){
			$agentids=$ar_data['user_id'];
			
		$searcagentmail = mysqli_query($dbc,"Select email,name from users where `user_id` ='$agentids'");
		$searcagentmaildata = mysqli_fetch_array($searcagentmail);
			
		$email_to=$searcagentmaildata['email'];
		$approver_name=$searcagentmaildata['name'];
		
		//echo "this are the agents $searcagentemail  $searcagentename<br>";
		
		
		include('email_agents.php');
        
         
         $message=$email_message;
          $email_subject='UNITY BANK WE_CARE [Ticket#'.$MNEMONIC.']';
    //approver email
    //mysqli_query($dbc,"INSERT INTO `emails`(`receiver`, `message`, `received_on`, `status`, `type`, `subject`, `issue_id`) VALUES ('$email_to', '$message', '$timestamp', 'not sent', 'Pending Approval', '$email_subject', '$MNEMONIC')");

		
			
		}//end of while

		
		
		
        
		
    }
	
	
	
	
		
	
	
	//echo "Select * from `heritagecompaintdetails_users` where `group_id` ='$Request_Typevalue'";
	
	
    include('email.php');
    //echo "this the email 2 $approver_email";
	
	

    $email_to=$logged_by_email;
    
	//echo "<br>This is email $email_to <br>";
	
	//$email_to='andrewsoberko@yahoo.com,ebobentil@yahoo.com';
	
	//$email_to='aoberko@inlaks.com';
	$message=$email_message;
    $email_subject='UNITY BANK WE_CARE [Ticket#'.$MNEMONIC.']';
    
    mysqli_query($dbc,"INSERT INTO `emails`(`receiver`, `message`, `received_on`, `status`, `type`, `subject`, `issue_id`) VALUES ('$email_to', '$message', '$timestamp', 'not sent', 'New Issue', '$email_subject', '$MNEMONIC')");
	
    // Mailer($email_to,$message,$email_subject);	
	
	
	
	//if($log_for!=''){
		
		
		
	//$logged_for_q = "Select brainbo, contact_email,contact_number,contact_name,contact_email from mfb_details where bank_code='$log_for'";
        //$logged_for_r = mysqli_query($dbc,$logged_for_q);
        //$logged_for_data = mysqli_fetch_array($logged_for_r);
		
		$nameofapplicant=$_POST['nameofapplicant'];
	
	$mobilenumber=$_POST['mobilenumber'];
	
	$emailaddress=$_POST['emailaddress'];
	
	$GENDER=$_POST['CR_CUST_CAT'];
	
		
		
        $logged_for_email ="$emailaddress";
        $logged_for_name = "$nameofapplicant";
		 $contact_number = "$mobilenumber";
		 //$contact_name = $logged_for_data['contact_name'];
		 //$contact_email = ;
		
		
		
		
	include('email_to_mfb.php');
    //echo "this the email 2 $approver_email";
	
	

    $email_to=$logged_for_email;
    
	//echo "<br>This is email $email_to <br>";
	
	//$email_to='andrewsoberko@yahoo.com,ebobentil@yahoo.com';
	
	//$email_to='aoberko@inlaks.com';
	$message=$email_message;
    $email_subject='UNITY BANK WE_CARE [Ticket#'.$MNEMONIC.']';
    
    mysqli_query($dbc,"INSERT INTO `emails`(`receiver`, `message`, `received_on`, `status`, `type`, `subject`, `issue_id`) VALUES ('$email_to', '$message', '$timestamp', 'not sent', 'New Issue', '$email_subject', '$MNEMONIC')");
		
		
		
		
		
		
	//}
	
	
	
	if($user_type=='Clients'){
		
		
		
	
include('email_to_support.php');
   

   //echo "this the email 2 $approver_email";
	
	

    ///$email_to="nambuithelpdesk@inlaks.com";
	
	//$email_to="aoberko@inlaks.com";
    
	//echo "<br>This is email $email_to <br>";
	
	//$email_to='andrewsoberko@yahoo.com,ebobentil@yahoo.com';
	
	//$email_to='aoberko@inlaks.com';
	$message=$email_message;
    $email_subject='New Request [Ticket#'.$MNEMONIC.'] ';
    
    mysqli_query($dbc,"INSERT INTO `emails`(`receiver`, `message`, `received_on`, `status`, `type`, `subject`, `issue_id`) VALUES ('$email_to', '$message', '$timestamp', 'not sent', 'New Issue', '$email_subject', '$MNEMONIC')");
		
			
		
		
		
		
	}
	
	
	
	
	
	
    
					
 echo '<br><center><p class=" h3 alert alert-success" role="alert">Issue Successfully Logged<b> '.$MNEMONIC.'</b>.<br></center> ';
        
		
		
		
		} else {
           // echo '<p class=" h4 alert alert-danger" role="alert">Sorry Local Database Could not update';
			
			echo '<center><p class=" h3 alert alert-danger" role="alert">Sorry Issue Could Not be Logged </p> </center> ';
			
			
			
			$audittrail = "INSERT INTO audittables(`id`,`application_name`,`functions`, `username`,`date`,`description`,`status`,`ip_address`,`host_name`) VALUES ('$MNEMONIC','Customer Creation Form','$functions','$username1','$date1','$username1 Created A customer with ID $MNEMONIC and T24 Number $t24customerid at $time on $clientcomputername but was not saved in the database','failed','$ipaddress','$clientcomputername')";
        		
			$auditquiry = mysqli_query($dbc,$audittrail) or mysqli_connect_error("Error");
		

			
        }


	//OFS STRING GENERATOR FUNCTION CALL
	
}



?>