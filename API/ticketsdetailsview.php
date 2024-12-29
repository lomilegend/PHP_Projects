


<?php


if(isset($_GET['cust_id'])){
$username1=$_SESSION['username']; 
global $cust_id;

		//$cust_id = $_GET['cust_id'];
$productcode=explode(',',$_GET['cust_id']);
		
$cust_id =$productcode[0];

$productcode=$productcode[1];
		

$productcode="ISS";
	
global $idlenght,$productcode;
$idlenght=strlen($cust_id);
		//echo $idlenght;
switch($productcode)
{
	case($productcode=="SNP"):
$tablename="t24snapcustomers";
$columname="@ID";

$application="Customer";

	break;
	
	
	case($productcode=="CUS"):
	

$tablename="psl.customer";	
//$tablename="account_api";
$columname="customer_id";

$application="Customer";

	break;
	
	case($productcode=="FT"):
$tablename="atm_transfer_api";
$columname="@ID";

$application="Local Transfers";

	break;
	
	
	
	case($productcode=="LD"):
$tablename="loan_api";
$columname="@ID";

$application="Loan Details";

	break;
	
	
	case ($productcode=="ISS"):
	//echo "this is customer";
	
	
	$tablename="helpdeskissuelogged";
	$columname="issue_id";
$application="Issue";
	break;
	
	case ($productcode=="LD"):
	$tablename="t24ldloans";
	$columname="loanids";
	$application="LD";

	break;
	
default:
//echo "Nothing at all";
	
}



	#loan Data
        $groupall = mysqli_query($dbc,"SELECT * FROM `helpdeskissuelogged` where `issue_id`='$cust_id'");
		$groupdata=mysqli_fetch_array($groupall);
		
		//print_r($groupdata);
		
		$Request_Type = $groupdata['Request_Type'];
		//$NAME_1 = $groupdata['NAME_1']." ".$SHORT_NAME;
		$customerimage = $groupdata['customerimage'];
		

		$telephone = $groupdata['TEL_MOBILE'];
		$user_type = $groupdata['user_type'];
		$user_id = $groupdata['customer_id'];
		$t24customerid=$groupdata['t24customerid'];
		
		$approval_Status=$groupdata['approval_Status'];
		
		$dao_recommended = $groupdata['dao_recommended'];
		$audit_recommended = $groupdata['audit_recommended'];
		$credit_recommended = $groupdata['credit_recommended'];
		
		$inputter=$groupdata['SNAP_INP'];
		
		
		$smsverified=$groupdata['smsverified'];
		

		$channel=$groupdata['channel'];
		
		if($channel=='Web'){
		$CUSTOMERIDNO = $groupdata['MNEMONIC'];
			
		}else{
			
	$CUSTOMERIDNO = $groupdata['CUSTOMERID'];
			
		}
		
		//$username = $groupdata['username'];

		//$customername="$SHORT_NAME $NAME_1 $NAME_2";
		
	

    }
	

global $CUSTOMERIDNO;


function authorizedallinput($tablename,$columname,$dbc){
				
				global $formfields, $dbc, $tablename,$cust_id,$columname,$CUSTOMERIDNO;
				
				//echo "SELECT * FROM $tablename where $columname='$cust_id'";
				
			$offlineld = mysqli_query($dbc,"SELECT * FROM `$tablename` where `$columname`='$cust_id'");
			
			$offlinelddata=mysqli_fetch_array($offlineld);
			
			
			echo "<div class='row'>";
			
			foreach($offlinelddata as $fieldname=>$fielddata){
				
				//for displaying only fields with data
				 //if($fieldname/$fieldname ==1 || $fielddata ==0 ) continue;
				//echo "<br>$fielddata<br>";
				
				//for displaying all fields  t24customerid
				
				if($fieldname=='CUSTOMERID'){
					$CUSTOMERIDNO=$fielddata;
					//echo $fieldname;
					
				}
				
				
				if($fieldname/$fieldname==1) continue;
				
				if($fieldname=='h_password' or $fieldname=='Submit' or $fieldname=='ids' or $fieldname=='status' or $fieldname=='t24customerid' or $fieldname=='t24id' or $fieldname=='transactionmode' or $fieldname=='USERNAME' or $fieldname=='OFSUSERNAME' or $fieldname=='salt' or $fieldname=='ofsusername' or $fieldname=='ofspassword' or $fieldname=='password' or $fieldname=='document') continue;
				
				//replace all _ in the field name with space      image/jpeg;base64
				$fieldname=ucwords(str_replace('_',' ',$fieldname));
				
				if($fieldname=='Image'){
				//echo "$fielddata<br>";
				//$imagedisplay=base64_decode($fielddata);
					$fielddata='<img src="images/avatarplaceholder.png" height="100" width="100" />';
					//$fielddata='<img src="'.base64_encode($fielddata).'" height="80" width="100" />';
				}
				
				
				if($fieldname == 'Assigned To'){
                    //Get Assigned to data from issue_users
                    // $q = "Select * from issue_users where issue_id = '$cust_id'";
                    // $res = mysqli_query($dbc, $q);
                    // while($user_data = mysqli_fetch_array($res)){
                    //     $asngd_to = $user_data[];
                    // } 

                    $ass_to=mysqli_query($dbc,"select * from issue_users where `issue_id`='$cust_id'");
                    $asngd_to = "";
                    while($ass_todata = mysqli_fetch_assoc($ass_to)){
                    $ass_to_user_id =  $ass_todata['user_id'];
                    $asngd_to .= get_user_name($ass_to_user_id, $dbc)."; <br />";
                    }
                    $fielddata = '<div>'.$asngd_to.'</div>';
                    // $Request_Type = $fielddata;
                }
				
				
				
				/* 	if($fieldname=='latitude'){
				//echo "$fielddata<br>";
				//$imagedisplay=base64_decode($fielddata);
					//$fielddata='<img src='.$imagedisplay.' height="100" width="100" />';
					$fielddata='<iframe width="774" height="347" id="gmap_canvas" src="https://maps.google.com/maps?q=<?php //echo "$Latitude,$Longitude";  ?>-6.974426,110.38498099999993&t=k&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
		</iframe>';
				} */
				
				
				if($fieldname=='Document'){
					$fielddata='<img src="data:image/jpeg;base64,'.base64_decode($fielddata).'" height="80" width="100" />';
				}
				
				
				
				
				if($fielddata=='') continue;
				
				
		echo "
<div class='col-lg-4'>
                               
                                <div class='card'>
                                    <div class='card-header bg-warning py-3 text-white'>
                                        <div class='card-widgets'>
                                            <a href='javascript:;' data-toggle='reload'><i class='mdi mdi-refresh'></i></a>
                                            <a data-toggle='collapse' href='#cardCollpase9' role='button' aria-expanded='false' aria-controls='cardCollpase2'><i class='mdi mdi-minus'></i></a>
                                            <a href='#' data-toggle='remove'><i class='mdi mdi-close'></i></a>
                                        </div>
                                        <h5 class='card-title mb-0 text-white'>$fieldname</h5>
                                    </div>
                                    <div id='cardCollpase9' class='collapse show'>
                                        <div class='card-body'>
                                            $fielddata
                                        </div>
                                    </div>
                                </div> 
                            </div>
				   
		  ";
			
//echo '<img src="data:image/jpeg;base64,'.base64_decode($fielddata).'" height="80" width="100" />';			
				
			}
			
			echo "</div>";
			//echo "<br>";
			
			
			}//end of functions
	






	
?>


<div class="row">
					<div class="col-md-12">

						<!-- Contact User -->
						<div class="contact-head">
							<div class="row align-items-center">
								<div class="col-sm-6">
									<ul class="contact-breadcrumb">
										<li><a href="companies"><i class="ti ti-arrow-narrow-left"></i>Ticket</a></li>
										<li><?php  echo $Request_Type ?> / <?php  echo $groupdata['issue_id']; ?></li>
									</ul>
								</div>
								<div class="col-sm-6 text-sm-end">
									
								</div>
							</div>
						</div>

						<div class="contact-wrap">
							<div class="contact-profile">
								<div class="avatar company-avatar">									
									
									<img  src="assets/img/profiles/avatar-19.jpg" alt="User Image">
									
									<?php //echo $customerimage ?>
								</div>
								<div class="name-user">
									<h5><?php  echo $groupdata['Request_Type']; ?></h5>
									<p><i class="ti ti-map-pin-pin me-1"></i><?php echo $groupdata['issue_id']; ?></p>
									
								</div>
							</div>
							<div class="contacts-action">
								
								<a href="#" class="btn btn-danger add-popup11" data-bs-target="#notes">
									<i class="ti ti-circle-plus"></i>Update Ticket
								</a>
								<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_compose">
									<i class="ti ti-mail"></i>Send Email
								</a>
								<a href="chat.html" class="btn-icon">
									<i class="ti ti-brand-hipchat"></i>
								</a>
								<a href="#" class="btn-icon edit-popup"><i class="ti ti-edit-circle"></i></a>	
								<div class="act-dropdown">
									<a href="#" data-bs-toggle="dropdown" aria-expanded="false">
										<i class="ti ti-dots-vertical"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i>Delete</a>
									</div>
								</div>
							</div>	
						</div>
						<!-- /Contact User -->

					</div>

					<!-- Contact Sidebar -->
					<div class="col-xl-3 theiaStickySidebar">
						<div class="contact-sidebar">
							<h6>Ticket Information</h6>
							<ul class="basic-info">
								<li>
									<span>
										<i class="ti ti-mail"></i>
									</span>
									<p><?php  echo $groupdata['issue_id']; ?></p>
								</li>
								<li>
									<span>
										<i class="ti ti-phone"></i>
									</span>
									<p><?php 
									$status=$groupdata['status']; 
									
									
									getStatusColor($status);
									
									?></p>
								</li>
								<li>
									<span>
										<i class="ti ti-calendar-exclamation"></i>
									</span>
									<p>Created on <?php  echo $groupdata['issue_log_date']; ?></p>
								</li>
							</ul>
							<h6>Customer's Information</h6>
							<ul class="other-info">
								<li><span class="other-title">Number</span><span><?php  echo $customer_id=$groupdata['CONTACT_CLIENT']; ?></span></li>
								<li><span class="other-title">Name</span><span><?php  echo $groupdata['nameofapplicant']; ?></span></li>
								<li><span class="other-title">Email</span><span><?php  echo $groupdata['emailaddress']; ?></span></li>
								<li><span class="other-title">Mobile</span><span><?php  echo $groupdata['mobilenumber']; ?></span></li>
							</ul>								
							
							
							<ul class="company-info com-info">
								
<?php 


$cust_id=$groupdata['issue_id'];
check_sla_status($issue_id=$groupdata['issue_id']);

?>
							</ul>
							
							<h6>Settings</h6>
							<ul class="set-info">
								
								
							<table width="100%" border="1" class="table table-striped table-bordered table-hover">  
			
    <tr>
	<td colspan='5'>
	<h3>History</h3>
	</td>
	</tr>
	<tr>
	
 
    <td><b>Update</td>
	
	<td><b>Comment</td>
	
	<td><b>Date Modified</td>
	
	<td><b>User</td>
	
	</b>
    </tr>
    <?php
	//echo "this is $CUSTOMERIDNO";
	//INSERT INTO `loan_trail`(`id`, `loan_id`, `action_taken`, `reason`, `action_date`, `user_name`) 
	global $id,$CUSTOMERIDNO;
$sql="SELECT * FROM `loan_trail` where `loan_id`='$cust_id'";

//$sql="SELECT * FROM `loan_trail`";
	
	
	$result_set=mysqli_query($dbc,$sql);
	while($row=mysqli_fetch_array($result_set))
	{
		?>
        <tr>
		
        <td><?php echo $row['action_taken'] ?></td>
		 <td><?php echo $row['reason'] ?></td>
		  <td><?php echo $row['action_date'] ?></td>
		   <td><?php echo $row['user_name'] ?></td>
        
        </tr>
        <?php
		
	}
	?>
    </table>	
								
								
								
								
							</ul>
						</div>
					</div>
					<!-- /Contact Sidebar -->

					<!-- Contact Details -->
					<div class="col-xl-9">
						<div class="contact-tab-wrap">
							<ul class="contact-nav nav">
								<li>
									<a href="#" data-bs-toggle="tab" data-bs-target="#activities" class="active"><i class="ti ti-alarm-minus"></i>Details</a>
								</li>
								<li>
									<a href="#" data-bs-toggle="tab" data-bs-target="#notes"><i class="ti ti-notes"></i>Update</a>
								</li>
								<li>
									<a href="#" data-bs-toggle="tab" data-bs-target="#calls"><i class="ti ti-phone"></i>Calls</a>
								</li>
								<li>
									<a href="#" data-bs-toggle="tab" data-bs-target="#filesat"><i class="ti ti-file"></i>Files</a>
								</li>
								<li>
									<a href="#" data-bs-toggle="tab" data-bs-target="#email"><i class="ti ti-mail-check"></i>Trail</a>
								</li>
							</ul>
						</div>

						<!-- Tab Content -->
						<div class="contact-tab-view">
							<div  class="tab-content pt-0">

								<!-- Activities -->
								<div  class="tab-pane active show" id="activities">
									<div class="view-header">
										<h4>Details</h4>
										
									</div>
									<div class="contact-activity">
									
									<div class="col-12">
<?php 

authorizedallinput($tablename,$columname,$dbc,$cust_id);

?>

</div>

										
									</div>
								</div>
								<!-- /Activities -->



								<!-- Notes -->
<div  class="tab-pane fade" id="notes">
									<div class="view-header">
										<h4>Update</h4>
									
									</div>
<div class="notes-activity">
	
<?php include("ticketupdateform.php")    ?>

											

	

						
                                           
</div>

			
										
</div>							
								<!-- /Notes -->

								<!-- Calls -->
								<div  class="tab-pane fade" id="calls">
									<div class="view-header">
										<h4>Calls</h4>
										<ul>
											<li>
												<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#create_call" class="com-add"><i class="ti ti-circle-plus me-1"></i>Add New</a>
											</li>
										</ul>
									</div>
									<div class="calls-activity">
										
										<?php   
										$sql="SELECT * FROM `create_calllogs` WHERE `issue_id`='$cust_id'";
	$result_set12=mysqli_query($dbc,$sql);
	while($row12=mysqli_fetch_array($result_set12))
	{
		//$file=$row12['file'];
										
										?>
										
										<div class="calls-box">
											<div class="caller-info">
												<div class="calls-user">
													<img src="assets/img/profiles/avatar-19.jpg" alt="img">
									<p><span><?php echo $row12['logged_by'];  ?></span> logged a call on <?php echo $row12['timestamp'];  ?></p>
												</div>
												<div class="calls-action">
													<div class="dropdown call-drop">
													
				
														
														<?php 
														$call_status=$row12['call_status'];
														
														geCalltStatus($call_status);

														?>
														
														<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0);">Answered</a>
															<a class="dropdown-item" href="javascript:void(0);">Busy</a>
															<a class="dropdown-item" href="javascript:void(0);">No Answer</a>
															<a class="dropdown-item" href="javascript:void(0);">Unavailable</a>
															<a class="dropdown-item" href="javascript:void(0);">Wrong Number</a>
															<a class="dropdown-item" href="javascript:void(0);">Left Voice Message</a>
															<a class="dropdown-item" href="javascript:void(0);">Moving Forward</a>
														</div>
													</div>
													
												</div>
											</div>										
											<p><?php echo $row12['call_notes'];  ?></p>
										</div>	
										
										
										<?php 
										
	}
										
										?>
										
											
									</div>
								</div>
								<!-- /Calls -->

								<!-- Files -->
								<div  class="tab-pane fade" id="filesat">
								
									<div class="view-header">
										<h4>Files</h4>
									</div>
									<div class="files-activity">
										
										<table border='1'>
<tr>											
												
<?php
	global $id;
$sql="SELECT * FROM `tbl_uploads` WHERE `issue_id`='$cust_id'";
	$result_set=mysqli_query($dbc,$sql);
	while($row=mysqli_fetch_array($result_set))
	{
		$file=$row['file'];
		//echo $action_taken;
echo "<td><a href='pictures/$file' target='_blank'><embed src='pictures/$file' class='rounded  img-fluid' alt='' width='100' height='100'></a></td>"; 


	}
		?>
		                       
                     						

</tr>
</table>     
																					
										
									</div>
								</div>
								<!-- /Files -->

								<!-- Email -->
								<div  class="tab-pane fade" id="email">
									<div class="view-header">
										<h4>Trails</h4>
										<ul>
											<li>
												<a href="javascript:void(0);" class="com-add create-mail" data-bs-toggle="tooltip"  data-bs-placement="left" data-bs-custom-class="tooltip-dark" data-bs-original-title="There are no email accounts configured, Please configured your email account in order to Send/ Create EMails"><i class="ti ti-circle-plus me-1"></i>Create Email</a>
											</li>
										</ul>
									</div>
									<div class="files-activity">
									
									
									
									
											<h4>Ticket Resolution Trail</h4>
										
											<?php
						
									
                        $ac = mysqli_query($dbc,"SELECT * FROM heldeskactivities WHERE `issue_id`='$cust_id'");
                        while($acData = mysqli_fetch_array($ac)){
							$updated_by=$acData['updated_by'];
							$action_taken=$acData['action_taken'];
							
							
							
							
						$q = mysqli_query($dbc,"SELECT * FROM users where username='$updated_by'");	
						$data = mysqli_fetch_assoc($q);
						
						$editpics = $data['profile_pic'];	

                        ?>
							
							
                                                <div class="media">
												
												
												<?php
								

				if($editpics!=''){
					
			echo "<img src='profilepics/$editpics' height='128' width='128' class='mr-2 avatar-sm rounded-circle'/>";
				
				}else{
					
					echo "<img src='images/logo.png' class='mr-2 avatar-sm rounded-circle'  width='128' height='128' />";
				}
					
				?> 
		
		
			
					
                                                    <div class="media-body">
                                                        <h5 class="m-0"><?php echo $acData['updated_by'] ?></h5>
                                                        <p class="text-muted"><small><?php echo $acData['date'] ?></small></p>
														
                                                    </div>
                                                </div>
												
                                             <p><?php echo $acData['action_taken'] ?></p>
												
											
<table>
<tr>											
												
<?php
	global $id;
	$sql="SELECT * FROM `tbl_uploads` WHERE `issue_id`='$cust_id' and `upload_by`='$updated_by'";
	$result_set=mysqli_query($dbc,$sql);
	while($row=mysqli_fetch_array($result_set))
	{
		$file=$row['file'];
		//echo $action_taken;
echo "<td><a href='pictures/$file' target='_blank'><embed src='pictures/$file' class='rounded  img-fluid' alt='' width='100' height='100'></a></td>"; 
		?>
		                       
                     						

</tr>
</table>                                        
									
												
												
												 <?php
		
	}
	?>
												
<p class="text-muted"><small>Updated Status: <?php echo $acData['status'] ?></small></p>

<?php
}

?>



									
									
									
									
									
									</div>
								</div>
								<!-- /Email -->

							</div>
						</div>
						<!-- /Tab Content -->

					</div>
					<!-- /Contact Details -->
					
				</div>
						
						
						
						
						<?php  include("modals/companydetailsmodals.php"); ?>
						
						
						
						