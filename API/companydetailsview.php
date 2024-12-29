


<?php


if(isset($_GET['cust_id'])){
       $username1=$_SESSION['username']; 
	   global $cust_id;
	   
		//$cust_id = $_GET['cust_id'];
		$productcode=explode(',',$_GET['cust_id']);
		
 $cust_id =$productcode[1];
		
 $productcode=$productcode[0];
		
		//echo "This is product code $productcode, This is ID $cust_id ";
		//$cust_id = $searchdata['group_id'];

		
		
		//$cust_id = $searchdata['group_id'];

        
		
//$tablename="t24customertable";
//$columname="MNEMONIC";
		
		
	
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
        $groupall = mysqli_query($dbc,"SELECT * FROM `sales_company` where `sytem_id`='$productcode'");
		$groupdata=mysqli_fetch_array($groupall);
		
		
		$company_name = $groupdata['company_name'];
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
         <div class='col-6'>
          
		 <p class='text-muted mb-4 font-13'><strong> $fieldname:</strong> $fielddata </p>
                
                
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
										<li><a href="companies"><i class="ti ti-arrow-narrow-left"></i>Company</a></li>
										<li><?php  echo $company_name ?> / <?php  echo $groupdata['sytem_id']; ?></li>
									</ul>
								</div>
								<div class="col-sm-6 text-sm-end">
									<div class="contact-pagination">
										<p>1 of 40</p>
										<ul>
											<li>
												<a href="company-details.html"><i class="ti ti-chevron-left"></i></a>
											</li>
											<li>
												<a href="company-details.html"><i class="ti ti-chevron-right"></i></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="contact-wrap">
							<div class="contact-profile">
								<div class="avatar company-avatar">									
									
									<img  src="profilepics/<?php echo $customerimage ?>" alt="User Image">
									
									<?php //echo $customerimage ?>
								</div>
								<div class="name-user">
									<h5><?php  echo $groupdata['company_name']; ?></h5>
									<p><i class="ti ti-map-pin-pin me-1"></i><?php //echo $customerimage ?>22, Ave Street, Newyork, USA</p>
									<div class="badge-rate">
										<p><i class="fa-solid fa-star"></i> 5.0</p>
									</div>
								</div>
							</div>
							<div class="contacts-action">
								<a href="#" class="btn-icon rating"><i class="fa-solid fa-star"></i></a>
								<a href="#" class="btn btn-danger add-popup">
									<i class="ti ti-circle-plus"></i>Add Deal
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
							<h6>Basic Information</h6>
							<ul class="basic-info">
								<li>
									<span>
										<i class="ti ti-mail"></i>
									</span>
									<p><?php  echo $groupdata['email']; ?></p>
								</li>
								<li>
									<span>
										<i class="ti ti-phone"></i>
									</span>
									<p><?php  echo $groupdata['Phone_1']; ?></p>
								</li>
								<li>
									<span>
										<i class="ti ti-calendar-exclamation"></i>
									</span>
									<p>Created on <?php  echo $groupdata['datecreated']; ?></p>
								</li>
							</ul>
							<h6>Other Information</h6>
							<ul class="other-info">
								<li><span class="other-title">Language</span><span><?php  echo $groupdata['language']; ?></span></li>
								<li><span class="other-title">Currency</span><span><?php  echo $groupdata['currency']; ?></span></li>
								<li><span class="other-title">Last Modified</span><span>27 Sep 2023, 11:45 pm</span></li>
								<li><span class="other-title">Source</span><span><?php  echo $groupdata['referral_source']; ?></span></li>
							</ul>								
							<h6>Tags</h6>
							<ul class="tag-info">
								<li>
									<a href="javascript:void(0);" class="badge badge-tag badge-success-light">Collab</a>
								</li>
								<li>
									<a href="javascript:void(0);" class="badge badge-tag badge-warning-light">Rated</a>
								</li>
							</ul>
							<div class="con-sidebar-title">
								<h6>Company</h6>
								<a href="javascript:void(0);" class="com-add add-popups"><i class="ti ti-circle-plus me-1"></i>Add New</a>
							</div>
							<ul class="company-info com-info">
								<li>
									<span>
										<img src="assets/img/icons/company-icon-01.svg" alt="Image">
									</span>
									<div>
										<h6>NovaWaveLLC</h6>
										<p><i class="fa-solid fa-star"></i>3.5</p>
									</div>
								</li>
								<li>
									<span>
										<img src="assets/img/icons/company-icon-02.svg" alt="Image">
									</span>
									<div>
										<h6>BlueSky Industries</h6>
										<p><i class="fa-solid fa-star"></i>4.2</p>
									</div>
								</li>
							</ul>
							<h6>Social Profile</h6>
							<ul class="social-info">
								<li>
									<a href="javascript:void(0);"><i class="fa-brands fa-youtube"></i></a>
								</li>
								<li>
									<a href="javascript:void(0);"><i class="fa-brands fa-facebook-f"></i></a>
								</li>
								<li>
									<a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a>
								</li>
								<li>
									<a href="javascript:void(0);"><i class="fa-brands fa-whatsapp"></i></a>
								</li>
								<li>
									<a href="javascript:void(0);"><i class="fa-brands fa-pinterest"></i></a>
								</li>
								<li>
									<a href="javascript:void(0);"><i class="fa-brands fa-linkedin"></i></a>
								</li>
							</ul>
							<h6>Settings</h6>
							<ul class="set-info">
								<li>
									<a href="javascript:void(0);"><i class="ti ti-share-2"></i>Share Company</a>
								</li>
								<li>
									<a href="javascript:void(0);"><i class="ti ti-star"></i>Add to Favourite</a>
								</li>
								<li>
									<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash-x"></i>Delete Company</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /Contact Sidebar -->

					<!-- Contact Details -->
					<div class="col-xl-9">
						<div class="contact-tab-wrap">
							<ul class="contact-nav nav">
								<li>
									<a href="#" data-bs-toggle="tab" data-bs-target="#activities" class="active"><i class="ti ti-alarm-minus"></i>Activities</a>
								</li>
								<li>
									<a href="#" data-bs-toggle="tab" data-bs-target="#notes"><i class="ti ti-notes"></i>Notes</a>
								</li>
								<li>
									<a href="#" data-bs-toggle="tab" data-bs-target="#calls"><i class="ti ti-phone"></i>Calls</a>
								</li>
								<li>
									<a href="#" data-bs-toggle="tab" data-bs-target="#files"><i class="ti ti-file"></i>Files</a>
								</li>
								<li>
									<a href="#" data-bs-toggle="tab" data-bs-target="#email"><i class="ti ti-mail-check"></i>Email</a>
								</li>
							</ul>
						</div>

						<!-- Tab Content -->
						<div class="contact-tab-view">
							<div  class="tab-content pt-0">

								<!-- Activities -->
								<div  class="tab-pane active show" id="activities">
									<div class="view-header">
										<h4>Activities</h4>
										<ul>
											<li>
												<div class="form-sort">
													<i class="ti ti-sort-ascending-2"></i>
													<select class="select">
														<option>Sort By Date</option>
														<option>Ascending</option>
														<option>Descending</option>
													</select>
												</div>
											</li>
										</ul>
									</div>
									<div class="contact-activity">
										<div class="badge-day"><i class="ti ti-calendar-check"></i>29 Aug 2023</div>
										<ul>
											<li class="activity-wrap">
												<span class="activity-icon bg-pending">
													<i class="ti ti-mail-code"></i>
												</span>
												<div class="activity-info">
													<h6>You sent 1 Message to the contact.</h6>
													<p>10:25 pm</p>
												</div>
											</li>
											<li class="activity-wrap">
												<span class="activity-icon bg-secondary-success">
													<i class="ti ti-phone"></i>
												</span>
												<div class="activity-info">
													<h6>Denwar responded to your appointment schedule question by call at 09:30pm.</h6>
													<p>09:25 pm</p>
												</div>
											</li>
											<li class="activity-wrap">
												<span class="activity-icon bg-orange">
													<i class="ti ti-notes"></i>
												</span>
												<div class="activity-info">
													<h6>Notes added by Antony</h6>
													<p>Please accept my apologies for the inconvenience caused. It would be much appreciated if it's possible to reschedule to 6:00 PM, or any other day that week.</p>
													<p>10.00 pm</p>
												</div>
											</li>
										</ul>
										<div class="badge-day"><i class="ti ti-calendar-check"></i>28 Feb 2024</div>
										<ul>												
											<li class="activity-wrap">
												<span class="activity-icon bg-info">
													<i class="ti ti-user-pin"></i>
												</span>
												<div class="activity-info">
													<h6>Meeting With <span class="avatar-xs"><img src="assets/img/profiles/avatar-19.jpg" alt="img"></span> Abraham</h6>
													<p>Schedueled  on 05:00 pm</p>
												</div>
											</li>											
											<li class="activity-wrap">
												<span class="activity-icon bg-secondary-success">
													<i class="ti ti-phone"></i>
												</span>
												<div class="activity-info">
													<h6>Drain responded to your appointment schedule question.</h6>
													<p>09:25 pm</p>
												</div>
											</li>
										</ul>
										<div class="badge-day"><i class="ti ti-calendar-check"></i>Upcoming Activity</div>
										<ul>												
											<li class="activity-wrap">
												<span class="activity-icon bg-info">
													<i class="ti ti-user-pin"></i>
												</span>
												<div class="activity-info">
													<h6>Product Meeting</h6>
													<p>A product team meeting is a gathering of the cross-functional product team — ideally including team members from product, engineering, marketing, and customer support.</p>
													<p>25 Jul 2023, 05:00 pm</p>
													<div class="upcoming-info">
														<div class="row">
															<div class="col-sm-4">
																<p>Reminder</p>
																<div class="dropdown">
																	<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-clock-edit me-1"></i>Reminder<i class="ti ti-chevron-down ms-1"></i></a>
																	<div class="dropdown-menu dropdown-menu-right">
																		<a class="dropdown-item" href="javascript:void(0);">Remainder</a>
																		<a class="dropdown-item" href="javascript:void(0);">1 hr</a>
																		<a class="dropdown-item" href="javascript:void(0);">10 hr</a>
																	</div>
																</div>
															</div>
															<div class="col-sm-4">
																<p>Task Priority</p>
																<div class="dropdown">
																	<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-square-rounded-filled me-1 text-danger circle"></i>High<i class="ti ti-chevron-down ms-1"></i></a>
																	<div class="dropdown-menu dropdown-menu-right">
																		<a class="dropdown-item" href="javascript:void(0);">
																			<i class="ti ti-square-rounded-filled me-1 text-danger circle"></i>High
																		</a>
																		<a class="dropdown-item" href="javascript:void(0);">
																			<i class="ti ti-square-rounded-filled me-1 text-success circle"></i>Low
																		</a>
																	</div>
																</div>
															</div>
															<div class="col-sm-4">
																<p>Assigned to</p>
																<div class="dropdown">
																	<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src="assets/img/profiles/avatar-19.jpg" alt="img" class="avatar-xs">John<i class="ti ti-chevron-down ms-1"></i></a>
																	<div class="dropdown-menu dropdown-menu-right">
																		<a class="dropdown-item" href="javascript:void(0);">
																			<img src="assets/img/profiles/avatar-19.jpg" alt="img" class="avatar-xs">John
																		</a>
																		<a class="dropdown-item" href="javascript:void(0);">
																			<img src="assets/img/profiles/avatar-19.jpg" alt="img" class="avatar-xs">Peter
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>	
										</ul>
									</div>
								</div>
								<!-- /Activities -->

								<!-- Notes -->
								<div  class="tab-pane fade" id="notes">
									<div class="view-header">
										<h4>Notes</h4>
										<ul>
											<li>
												<div class="form-sort">
													<i class="ti ti-sort-ascending-2"></i>
													<select class="select">
														<option>Sort By Date</option>
														<option>Ascending</option>
														<option>Descending</option>
													</select>
												</div>
											</li>
											<li>
												<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add_notes" class="com-add"><i class="ti ti-circle-plus me-1"></i>Add New</a>
											</li>
										</ul>
									</div>
									<div class="notes-activity">
										<div class="calls-box">
											<div class="caller-info">
												<div class="calls-user">
													<img src="assets/img/profiles/avatar-19.jpg" alt="img">
													<div>
														<h6>Darlee Robertson</h6>
														<p>15 Sep 2023, 12:10 pm</p>
													</div>
												</div>
												<div class="calls-action">
													<div class="dropdown action-drop">
														<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-edit text-blue"></i>Edit</a>
															<a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash text-danger"></i>Delete</a>
														</div>
													</div>
												</div>
											</div>		
											<h5>Notes added by Antony</h5>							
											<p>A project review evaluates the success of an initiative and identifies areas for improvement. It can also evaluate a current project to determine whether it's on the right track. Or, it can determine the success of a completed project. </p>
											<ul>
												<li>
													<div class="note-download">
														<div class="note-info">
															<span class="note-icon bg-secondary-success">
																<i class="ti ti-file-spreadsheet"></i>
															</span>
															<div>
																<h6>Project Specs.xls</h6>
																<p>365 KB</p>
															</div>
														</div>
														<a href="javascript:void(0);"><i class="ti ti-arrow-down"></i></a>
													</div>
												</li>
												<li>
													<div class="note-download">
														<div class="note-info">
															<span class="note-icon">
																<img src="assets/img/media/media-35.jpg" alt="img">
															</span>
															<div>
																<h6>090224.jpg</h6>
																<p>365 KB</p>
															</div>
														</div>
														<a href="javascript:void(0);"><i class="ti ti-arrow-down"></i></a>
													</div>
												</li>
											</ul>
											<div class="notes-editor">
												<div class="note-edit-wrap">
													<div class="summernote">Write a new comment, send your team notification by typing @ followed by their name</div>
													<div class="text-end note-btns">
														<a href="javascript:void(0);" class="btn btn-light add-cancel">Cancel</a>
														<a href="javascript:void(0);" class="btn btn-primary">Save</a>
													</div>
												</div>
												<div class="text-end">
													<a href="javascript:void(0);" class="add-comment"><i class="ti ti-square-plus me-1"></i>Add Comment</a>
												</div>
											</div>
										</div>	
										<div class="calls-box">
											<div class="caller-info">
												<div class="calls-user">
													<img src="assets/img/profiles/avatar-20.jpg" alt="img">
													<div>
														<h6>Sharon Roy</h6>
														<p>18 Sep 2023, 09:52 am</p>
													</div>
												</div>
												<div class="calls-action">
													<div class="dropdown action-drop">
														<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-edit text-blue"></i>Edit</a>
															<a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash text-danger"></i>Delete</a>
														</div>
													</div>
												</div>
											</div>		
											<h5>Notes added by Antony</h5>								
											<p>A project plan typically contains a list of the essential elements of a project, such as stakeholders, scope, timelines, estimated cost and communication methods. The project manager typically lists the information based on the assignment.</p>
											<ul>
												<li>
													<div class="note-download">
														<div class="note-info">
															<span class="note-icon bg-secondary-success">
																<i class="ti ti-file-text"></i>
															</span>
															<div>
																<h6>Andrewpass.txt</h6>
																<p>365 KB</p>
															</div>
														</div>
														<a href="javascript:void(0);"><i class="ti ti-arrow-down"></i></a>
													</div>
												</li>
											</ul>
											<div class="reply-box">
												<p>The best way to get a project done faster is to start sooner. A goal without a timeline is just a dream.The goal you set must be challenging. At the same time, it should be realistic and attainable, not impossible to reach.</p>
												<p>Commented by <span class="text-purple">Aeron</span> on 15 Sep 2023, 11:15 pm</p>
												<a href="#" class="btn"><i class="ti ti-arrow-back-up-double"></i>Reply</a>
											</div>
											<div class="notes-editor">
												<div class="note-edit-wrap">
													<div class="summernote">Write a new comment, send your team notification by typing @ followed by their name</div>
													<div class="text-end note-btns">
														<a href="javascript:void(0);" class="btn btn-light add-cancel">Cancel</a>
														<a href="javascript:void(0);" class="btn btn-primary">Save</a>
													</div>
												</div>
												<div class="text-end">
													<a href="javascript:void(0);" class="add-comment"><i class="ti ti-square-plus me-1"></i>Add Comment</a>
												</div>
											</div>
										</div>	
										<div class="calls-box">
											<div class="caller-info">
												<div class="calls-user">
													<img src="assets/img/profiles/avatar-21.jpg" alt="img">
													<div>
														<h6>Vaughan</h6>
														<p>20 Sep 2023, 10:26 pm</p>
													</div>
												</div>
												<div class="calls-action">
													<div class="dropdown action-drop">
														<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-edit text-blue"></i>Edit</a>
															<a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash text-danger"></i>Delete</a>
														</div>
													</div>
												</div>
											</div>									
											<p>Projects play a crucial role in the success of organizations, and their importance cannot be overstated. Whether it's launching a new product, improving an existing</p>
											<div class="notes-editor">
												<div class="note-edit-wrap">
													<div class="summernote">Write a new comment, send your team notification by typing @ followed by their name</div>
													<div class="text-end note-btns">
														<a href="javascript:void(0);" class="btn btn-light add-cancel">Cancel</a>
														<a href="javascript:void(0);" class="btn btn-primary">Save</a>
													</div>
												</div>
												<div class="text-end">
													<a href="javascript:void(0);" class="add-comment"><i class="ti ti-square-plus me-1"></i>Add Comment</a>
												</div>
											</div>
										</div>	
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
										<div class="calls-box">
											<div class="caller-info">
												<div class="calls-user">
													<img src="assets/img/profiles/avatar-19.jpg" alt="img">
													<p><span>Darlee Robertson</span> logged a call on 23 Jul 2023, 10:00 pm</p>
												</div>
												<div class="calls-action">
													<div class="dropdown call-drop">
														<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Busy<i class="ti ti-chevron-down ms-2"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:void(0);">Busy</a>
															<a class="dropdown-item" href="javascript:void(0);">No Answer</a>
															<a class="dropdown-item" href="javascript:void(0);">Unavailable</a>
															<a class="dropdown-item" href="javascript:void(0);">Wrong Number</a>
															<a class="dropdown-item" href="javascript:void(0);">Left Voice Message</a>
															<a class="dropdown-item" href="javascript:void(0);">Moving Forward</a>
														</div>
													</div>
													<div class="dropdown action-drop">
														<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-edit text-blue"></i>Edit</a>
															<a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash text-danger"></i>Delete</a>
														</div>
													</div>
												</div>
											</div>										
											<p>A project review evaluates the success of an initiative and identifies areas for improvement. It can also evaluate a current project to determine whether it's on the right track. Or, it can determine the success of a completed project. </p>
										</div>	
										<div class="calls-box">
											<div class="caller-info">
												<div class="calls-user">
													<img src="assets/img/profiles/avatar-20.jpg" alt="img">
													<p><span>Sharon Roy</span> logged a call on 28 Jul 2023, 09:00 pm</p>
												</div>
												<div class="calls-action">
													<div class="dropdown call-drop">
														<a href="#" class="dropdown-toggle bg-pending" data-bs-toggle="dropdown" aria-expanded="false">No Answer<i class="ti ti-chevron-down ms-2"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:void(0);">Busy</a>
															<a class="dropdown-item" href="javascript:void(0);">No Answer</a>
															<a class="dropdown-item" href="javascript:void(0);">Unavailable</a>
															<a class="dropdown-item" href="javascript:void(0);">Wrong Number</a>
															<a class="dropdown-item" href="javascript:void(0);">Left Voice Message</a>
															<a class="dropdown-item" href="javascript:void(0);">Moving Forward</a>
														</div>
													</div>
													<div class="dropdown action-drop">
														<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:void(0);">
																<i class="ti ti-edit text-blue"></i>Edit
															</a>
															<a class="dropdown-item" href="javascript:void(0);">
																<i class="ti ti-trash text-danger"></i>Delete
															</a>
														</div>
													</div>
												</div>
											</div>										
											<p>A project plan typically contains a list of the essential elements of a project, such as stakeholders, scope, timelines, estimated cost and communication methods. The project manager typically lists the information based on the assignment.</p>
										</div>	
										<div class="calls-box">
											<div class="caller-info">
												<div class="calls-user">
													<img src="assets/img/profiles/avatar-21.jpg" alt="img">
													<p><span>Vaughan</span> logged a call on 30 Jul 2023, 08:00 pm</p>
												</div>
												<div class="calls-action">
													<div class="dropdown call-drop">
														<a href="#" class="dropdown-toggle bg-pending" data-bs-toggle="dropdown" aria-expanded="false">No Answer<i class="ti ti-chevron-down ms-2"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:void(0);">Busy</a>
															<a class="dropdown-item" href="javascript:void(0);">No Answer</a>
															<a class="dropdown-item" href="javascript:void(0);">Unavailable</a>
															<a class="dropdown-item" href="javascript:void(0);">Wrong Number</a>
															<a class="dropdown-item" href="javascript:void(0);">Left Voice Message</a>
															<a class="dropdown-item" href="javascript:void(0);">Moving Forward</a>
														</div>
													</div>
													<div class="dropdown action-drop">
														<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:void(0);">
																<i class="ti ti-edit text-blue"></i>Edit
															</a>
															<a class="dropdown-item" href="javascript:void(0);">
																<i class="ti ti-trash text-danger"></i>Delete
															</a>
														</div>
													</div>
												</div>
											</div>										
											<p>Projects play a crucial role in the success of organizations, and their importance cannot be overstated. Whether it's launching a new product, improving an existing</p>
										</div>	
									</div>
								</div>
								<!-- /Calls -->

								<!-- Files -->
								<div  class="tab-pane fade" id="files">
									<div class="view-header">
										<h4>Files</h4>
									</div>
									<div class="files-activity">
										<div class="files-wrap">	
											<div class="row align-items-center">										
												<div class="col-md-8">											
													<div class="file-info">												
														<h4>Manage Documents</h4>
														<p>Send customizable quotes, proposals and contracts to close deals faster.</p>
													</div>
												</div>										
												<div class="col-md-4 text-md-end">	
													<ul class="file-action">
														<li>
															<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_file">Create Document</a>
														</li>
													</ul>
												</div>		
											</div>
										</div>
										<div class="files-wrap">	
											<div class="row align-items-center">										
												<div class="col-md-8">											
													<div class="file-info">												
														<h4>Collier-Turner Proposal</h4>
														<p>Send customizable quotes, proposals and contracts to close deals faster.</p>
														<div class="file-user">
															<img src="assets/img/profiles/avatar-21.jpg" alt="img">
															<div>
																<p><span>Owner</span> Vaughan</p>
															</div>
														</div>
													</div>
												</div>										
												<div class="col-md-4 text-md-end">	
													<ul class="file-action">
														<li>															
															<span class="badge badge-tag badge-danger-light">Proposal</span>
														</li>
														<li>												
															<span class="badge badge-tag bg-pending priority-badge">Draft</span>
														</li>
														<li>															
															<div class="dropdown action-drop">
																<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
																<div class="dropdown-menu dropdown-menu-right">
																	<a class="dropdown-item" href="javascript:void(0);">
																		<i class="ti ti-edit text-blue"></i>Edit
																	</a>
																	<a class="dropdown-item" href="javascript:void(0);">
																		<i class="ti ti-trash text-danger"></i>Delete
																	</a>
																	<a class="dropdown-item" href="javascript:void(0);">
																		<i class="ti ti-download text-info"></i>Download
																	</a>
																</div>
															</div>
														</li>
													</ul>
												</div>		
											</div>
										</div>
										<div class="files-wrap">	
											<div class="row align-items-center">										
												<div class="col-md-8">											
													<div class="file-info">												
														<h4>Collier-Turner Proposal</h4>
														<p>Send customizable quotes, proposals and contracts to close deals faster.</p>
														<div class="file-user">
															<img src="assets/img/profiles/avatar-01.jpg" alt="img">
															<div>
																<p><span>Owner</span> Jessica</p>
															</div>
														</div>
													</div>
												</div>										
												<div class="col-md-4 text-md-end">	
													<ul class="file-action">
														<li>															
															<span class="badge badge-tag badge-purple-light">Quote</span>
														</li>
														<li>												
															<span class="badge bg-success priority-badge">Sent</span>
														</li>
														<li>															
															<div class="dropdown action-drop">
																<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
																<div class="dropdown-menu dropdown-menu-right">
																	<a class="dropdown-item" href="javascript:void(0);">
																		<i class="ti ti-edit text-blue"></i>Edit
																	</a>
																	<a class="dropdown-item" href="javascript:void(0);">
																		<i class="ti ti-trash text-danger"></i>Delete
																	</a>
																	<a class="dropdown-item" href="javascript:void(0);">
																		<i class="ti ti-download text-info"></i>Download
																	</a>
																</div>
															</div>
														</li>
													</ul>
												</div>		
											</div>
										</div>											
										<div class="files-wrap">	
											<div class="row align-items-center">										
												<div class="col-md-8">											
													<div class="file-info">												
														<h4>Collier-Turner Proposal</h4>
														<p>Send customizable quotes, proposals and contracts to close deals faster.</p>
														<div class="file-user">
															<img src="assets/img/profiles/avatar-22.jpg" alt="img">
															<div>
																<p><span>Owner</span> Vaughan</p>
															</div>
														</div>
													</div>
												</div>										
												<div class="col-md-4 text-md-end">	
													<ul class="file-action">
														<li>															
															<span class="badge badge-tag badge-danger-light">Proposal</span>
														</li>
														<li>												
															<span class="badge badge-tag bg-pending priority-badge">Draft</span>
														</li>
														<li>															
															<div class="dropdown action-drop">
																<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
																<div class="dropdown-menu dropdown-menu-right">
																	<a class="dropdown-item" href="javascript:void(0);">
																		<i class="ti ti-edit text-blue"></i>Edit
																	</a>
																	<a class="dropdown-item" href="javascript:void(0);">
																		<i class="ti ti-trash text-danger"></i>Delete
																	</a>
																	<a class="dropdown-item" href="javascript:void(0);">
																		<i class="ti ti-download text-info"></i>Download
																	</a>
																</div>
															</div>
														</li>
													</ul>
												</div>		
											</div>
										</div>
									</div>
								</div>
								<!-- /Files -->

								<!-- Email -->
								<div  class="tab-pane fade" id="email">
									<div class="view-header">
										<h4>Email</h4>
										<ul>
											<li>
												<a href="javascript:void(0);" class="com-add create-mail" data-bs-toggle="tooltip"  data-bs-placement="left" data-bs-custom-class="tooltip-dark" data-bs-original-title="There are no email accounts configured, Please configured your email account in order to Send/ Create EMails"><i class="ti ti-circle-plus me-1"></i>Create Email</a>
											</li>
										</ul>
									</div>
									<div class="files-activity">
										<div class="files-wrap">	
											<div class="row align-items-center">										
												<div class="col-md-8">											
													<div class="file-info">												
														<h4>Manage Emails</h4>
														<p>You can send and reply to emails directly via this section.</p>
													</div>
												</div>										
												<div class="col-md-4 text-md-end">	
													<ul class="file-action">
														<li>
															<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_email" >Connect Account</a>
														</li>
													</ul>
												</div>		
											</div>
										</div>
										<div class="files-wrap">
											<div class="email-header">
												<div class="row">
													<div class="col top-action-left">
														<div class="float-start d-none d-sm-block">
															<input type="text" placeholder="Search Messages" class="form-control search-message">
														</div>
													</div>
													<div class="col-auto top-action-right">
														<div class="text-end">
															<button type="button" title="Refresh" data-bs-toggle="tooltip" class="btn btn-white d-none d-md-inline-block"><i class="fa-solid fa-rotate"></i></button>
															<div class="btn-group">
																<a class="btn btn-white"><i class="fa-solid fa-angle-left"></i></a>
																<a class="btn btn-white"><i class="fa-solid fa-angle-right"></i></a>
															</div>
														</div>
														<div class="text-end">
															<span class="text-muted d-none d-md-inline-block">Showing 10 of 112 </span>
														</div>
													</div>
												</div>
											</div>
											<div class="email-content">
												<div class="table-responsive">
													<table class="table table-inbox table-hover">
														<thead>
															<tr>
																<th colspan="6" class="ps-2">
																	<input type="checkbox" class="checkbox-all">
																</th>
															</tr>
														</thead>
														<tbody>
															<tr class="unread clickable-row" data-href="mail-view.html">
																<td>
																	<input type="checkbox" class="checkmail">
																</td>
																<td><span class="mail-important"><i class="fa fa-star starred "></i></span></td>
																<td class="name">John Doe</td>
																<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
																<td><i class="fa-solid fa-paperclip"></i></td>
																<td class="mail-date">13:14</td>
															</tr>
															<tr class="unread clickable-row" data-href="mail-view.html">
																<td>
																	<input type="checkbox" class="checkmail">
																</td>
																<td><span class="mail-important"><i class="fa-regular fa-star"></i></span></td>
																<td class="name">Envato Account</td>
																<td class="subject">Important account security update from Envato</td>
																<td></td>
																<td class="mail-date">8:42</td>
															</tr>
															<tr class="clickable-row" data-href="mail-view.html">
																<td>
																	<input type="checkbox" class="checkmail">
																</td>
																<td><span class="mail-important"><i class="fa-regular fa-star"></i></span></td>
																<td class="name">Twitter</td>
																<td class="subject">HRMS Bootstrap Admin Template</td>
																<td></td>
																<td class="mail-date">30 Nov</td>
															</tr>
															<tr class="unread clickable-row" data-href="mail-view.html">
																<td>
																	<input type="checkbox" class="checkmail">
																</td>
																<td><span class="mail-important"><i class="fa-regular fa-star"></i></span></td>
																<td class="name">Richard Parker</td>
																<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
																<td></td>
																<td class="mail-date">18 Sep</td>
															</tr>
															<tr class="clickable-row" data-href="mail-view.html">
																<td>
																	<input type="checkbox" class="checkmail">
																</td>
																<td><span class="mail-important"><i class="fa-regular fa-star"></i></span></td>
																<td class="name">John Smith</td>
																<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
																<td></td>
																<td class="mail-date">21 Aug</td>
															</tr>
															<tr class="clickable-row" data-href="mail-view.html">
																<td>
																	<input type="checkbox" class="checkmail">
																</td>
																<td><span class="mail-important"><i class="fa-regular fa-star"></i></span></td>
																<td class="name">me, Robert Smith (3)</td>
																<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
																<td></td>
																<td class="mail-date">1 Aug</td>
															</tr>
															<tr class="unread clickable-row" data-href="mail-view.html">
																<td>
																	<input type="checkbox" class="checkmail">
																</td>
																<td><span class="mail-important"><i class="fa-regular fa-star"></i></span></td>
																<td class="name">Codecanyon</td>
																<td class="subject">Welcome To Codecanyon</td>
																<td></td>
																<td class="mail-date">Jul 13</td>
															</tr>
															<tr class="clickable-row" data-href="mail-view.html">
																<td>
																	<input type="checkbox" class="checkmail">
																</td>
																<td><span class="mail-important"><i class="fa-regular fa-star"></i></span></td>
																<td class="name">Richard Miles</td>
																<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
																<td><i class="fa-solid fa-paperclip"></i></td>
																<td class="mail-date">May 14</td>
															</tr>
															<tr class="unread clickable-row" data-href="mail-view.html">
																<td>
																	<input type="checkbox" class="checkmail">
																</td>
																<td><span class="mail-important"><i class="fa-regular fa-star"></i></span></td>
																<td class="name">John Smith</td>
																<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
																<td></td>
																<td class="mail-date">11/11/16</td>
															</tr>
															<tr class="clickable-row" data-href="mail-view.html">
																<td>
																	<input type="checkbox" class="checkmail">
																</td>
																<td><span class="mail-important"><i class="fa fa-star starred "></i></span></td>
																<td class="name">Mike Litorus</td>
																<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
																<td></td>
																<td class="mail-date">10/31/16</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
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
						
						
						
						