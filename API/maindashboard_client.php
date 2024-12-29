 

 
 <div class="panel panel-default card-view panel-refresh">
 
  
  
  
  <?php include('welcomedashboard.php');   ?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <?php   



if($functions=='Clients'){
	
	
	
}else{
  ?>
 
<div class="row m-b-1" style='display:none'>
				<div class="col-md-12">
					<div class="card card-block">
						<h4 class="card-title m-b-2">Revenue - 2015 <span class="tag m-l-1" id="revenue-tag">$2,781,450</span></h4>
						<div id="revenue-spline-area-chart"></div>
					</div>
				</div>
			</div>

	<div class="row m-b-1">
				<div class="col-md-12">
					<div class="card card-block">
						<h4 class="card-title m-b-2">Ticket By Category Summary</h4>
						<span class="tag custom-tag hidden-sm-down"></span>
						<div class="row">
							<div class="col-md-4">
								<div id="annual-revenue-by-category-pie-chart4"></div>
							</div>
							<div class="col-md-8 hidden-sm-down">
								<div id="monthly-revenue-by-category-column-chart"></div>
							</div>
						</div>
					</div>
				</div>
</div>
			
			
			<br>
			
			<div class="row">
				<div class="col-xl-6">
					<div class="card card-block">
						<h4 class="card-title m-b-2">
							<span id="visitors-chart-heading">Open  vs Closed </span>
							<button class="btn pull-right " type="button" id="visitors-chart-back-button"><i class="fa fa-angle-left fa-lg" aria-hidden="true"></i> Back</button>
						</h4>
						<span class="tag custom-tag" id="visitors-chart-tag"></span>
						<div id="visitors-chart"></div>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="card card-block">
						<h4 class="card-title m-b-2">Complaint Trend</h4>
						<div id="users-spline-chart"></div>
					</div>
				</div>
			</div>
			
			
			<?php  } ?>
			
			
			
		
			
			
		
			


<div class="container-fluid pt-25">
				<!-- Row -->
				
				
				
  <?php   



if($functions=='Clients'){
	
	echo "<h3 class='card-title m-b-2'>Welcome <b><i>$fullname </i></b>to $company_name </h3> ";
	
}else{
  ?>
				<div class="row">
				
			
				
				
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <div class="panel panel-default card-view panel-refresh">
								<div class="refresh-container">
									<div class="la-anim-1"></div>
								</div>
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Customer Satisfaction Rate</h6>
									</div>
									<div class="pull-right">
										<a href="#" class="pull-left inline-block refresh">
											<i class="zmdi zmdi-replay"></i>
										</a>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
								
									<div class="panel-body">
									
									
										<div id="e_chart_3" class="" style="height:294px;"></div>
										
										
										<div class="label-chatrs mt-15">
											<div class="inline-block mr-15">
												<span class="clabels inline-block bg-green mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Happy</span>
											</div>
											<div class="inline-block">
												<span class="clabels inline-block bg-red mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Unhappy</span>
											</div>									
										</div>
									</div>	
									
									
								</div>
						</div>
					</div>
					
					
					
					
					
					
					
				
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                       <div class="panel panel-default card-view panel-refresh">
								<div class="refresh-container">
									<div class="la-anim-1"></div>
								</div>
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Pending Items</h6>
									</div>
									<div class="pull-right">
										<a href="#" class="pull-left inline-block refresh mr-15">
											<i class="zmdi zmdi-replay"></i>
										</a>
										<div class="pull-left inline-block dropdown">
											<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
											<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
												<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>option 1</a></li>
												<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>option 2</a></li>
												<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>option 3</a></li>
											</ul>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="e_chart_1" class="" style="height:242px;"></div>
									<div class="label-chatrs mt-15">
										<div class="mb-5">
											<span class="clabels inline-block bg-green mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Actions pending</span>
										</div>
										<div class="mb-5">
											<span class="clabels inline-block bg-light-green mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">decision pending</span>
										</div>
										<div class="">
											<span class="clabels inline-block bg-xtra-light-green mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">change request pending</span>
										</div>										
									</div>
								</div>	
							</div>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Task Status</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block refresh">
										<i class="zmdi zmdi-replay"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="e_chart_2" class="" style="height:330px;"></div>
								</div>	
							</div>
						</div>
					</div>
					
					
					
				</div>
				
				
				<?php  } ?>
	
				<!-- /Row -->
				
				<!-- Row -->
				<div class="row">
					
<?php   
//located in formfunction, containing all main functions resuable accross screens

close_vrs_openned_status($user_id, $dbc);

?>

					
					
					
					<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Request Types Analysis</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block full-screen mr-15">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
									<div class="pull-left inline-block dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
										<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Update</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Edit</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>Remove</a></li>
										</ul>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table">
										<div class="table-responsive">
										  
										  
		<table class="table table-hover mb-0" width='100%'>
                                                <thead>
                                                    <tr>
                                                        <th style="width: 40%;">Request Type</th>
                                                        <th>No. Requests</th>
                                                        <th style="width: 50%;">Progress</th>
														
														
                                                    </tr>
                                                </thead>
                                                <tbody>
												
												<?php 


$q = mysqli_query($dbc,"SELECT issue_type, count(*) as countall from helpdeskissuelogged group by issue_type");

							while($data = mysqli_fetch_assoc($q)){
												
								$issue_type=$data['issue_type'];
								
								$countall=$data['countall'];
								$addallcount +=$countall;	
								
							}
												
												
							$q = mysqli_query($dbc,"SELECT issue_type, count(*) as countall from helpdeskissuelogged group by issue_type");

							while($data = mysqli_fetch_assoc($q)){
												
								$issue_type=$data['issue_type'];
								
								$countall=$data['countall'];
								
											
												?>
												
                                                    <tr>
                                                        <td><?php 
														
														echo $issue_type;
														
		$q1 = mysqli_query($dbc,"SELECT * from heritagecompany where `@ID`='$issue_type'");
		$data1 = mysqli_fetch_assoc($q1);
											//echo $data1['COMPANY_NAME'];	


														?></td>
                                                        <td>
														<?php 
														//$countall2 +=$countall;
														
														echo $countall;     
														
														
													  ?></td>
														
														
                                                        <td>
														<?php echo round(($countall/$addallcount)*100,2);   ?>%
                                  <div class="progress" style="height: 20px;">
								  
<div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo ($countall/$addallcount)*100;   ?>%; height: 20px;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>

                                                            
								  </div>
                                                        </td>
														
														
														
                                                    </tr>
													
													
													
													<?php  
													
								}
													
										echo $countall2;
										?>
													
													
													
                                                    
                                                </tbody>
                                            </table>							
	  
										  
										  
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<!-- Row -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">customer support</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block full-screen">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table">
										<div class="table-responsive">
					<table class="table display product-overview border-none" id="support_table">
												<thead>
													<tr>
									<th>Ticket #</th>
									<th>Logged Date</th>
									<th>Request Category</th>
									<th>Request Type</th>
                                    <th>Urgency</th>
									<th>Logged By</th>
                                    <th>Assigned To</th>
                                    <th>Resolved by</th>
                                    <th>Status</th>
                                    
													</tr>
												</thead>
												<tbody>
                                <?php
           
		  // INSERT INTO `helpdeskissuelogged`(`ids`, `issue_id`, `Primary_Location`, `issue_log_date`, `Request_Category`, `Request_Type`, `status`, `Urgency`, `Description`, `transactionmode`, `resolved_date`, `resolved_by`, `log_by`, `Submit`)
		  
		  
								  $myusername = $_SESSION['username']; 
								  $AgentCode=$_SESSION['AgentCode'];
								  
								  $q1 = "SELECT * FROM helpdeskissuelogged where `log_by` = '$myusername' order by `ids` ASC";
								  
								  
								  //$q1 = "SELECT * FROM helpdeskissuelogged order by `ids` ASC";
								  
								  $q = mysqli_query($dbc,$q1);
								
								
                                while($data = mysqli_fetch_assoc($q)){
                                 $id = $data['id'];
                                 $iss_id = $data['issue_id'];
									//$loan_tbl = mysqli_query($dbc,"SELECT * FROM loan_tbl WHERE customer_id='$id' ");
									//$loan = mysqli_fetch_assoc($loan_tbl);
                                    //echo $loan['principal'];
                                    $ass_to=mysqli_query($dbc,"select * from issue_users where `issue_id`='$iss_id'");
                                    $asngd_to = "";
                                    while($ass_todata = mysqli_fetch_assoc($ass_to)){
                                    $ass_to_user_id =  $ass_todata['user_id'];
                                    $asngd_to .= get_user_name($ass_to_user_id, $dbc)."; <br />";
                                    }
                                    $assignedto = '<div>'.$asngd_to.'</div>';
								 ?>
                                    <tr class="odd gradeX">
                                        <td><a href="viewticketsdetails.php?cust_id=ISS,<?php echo $data['issue_id'] ?>"><?php echo $iss_id ?></a></td>
										<td><?php echo $data['issue_log_date'] ?></td>
										<td><?php echo get_service_category($data['Request_Category'], $dbc) ?></td>
										<td><?php echo $data['Request_Type'] ?></td>
										<td><?php echo $data['Urgency']; ?></td>
										<td><?php echo $data['log_by']; ?></td>
                                        <td><?php echo $assignedto ?></td>
                                        <td><?php echo $data['resolved_by']; ?></td>
                                        <td><span class="label label-<?php 
                                        if($data['status'] == 'Open'){
                                            echo 'warning';
                                        }else if($data['status'] == 'Resolved'){
                                            echo 'info';
                                        }else if($data['status'] == 'Close'){
                                            echo 'success';
                                        }
                                        ?>"><?php echo $data['status'] ?></span></td>
                                        								
                                    </tr>
                                <?php
                                }   

                                ?>
                                </tbody>
											</table>
										</div>
									</div>	
								</div>	
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
			</div>
			
			
			
			<?php include("chartstatisitics.php");  ?>