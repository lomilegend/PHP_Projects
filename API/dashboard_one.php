<?php 

$qdata = mysqli_query($dbc,"SELECT count(*) as totalvisit FROM page_views");
$qdatadata = mysqli_fetch_assoc($qdata);	

$numberofvisits=$qdatadata['totalvisit'];



$qdata1 = mysqli_query($dbc,"SELECT count(*) as completedvisits FROM page_views where `status`='Completed'");
$qdatadata1 = mysqli_fetch_assoc($qdata1);	

$completedvisits=$qdatadata1['completedvisits'];



$qdata1failed = mysqli_query($dbc,"SELECT count(*) as completedvisitsfailed FROM page_views where `status`=''");
$qdatadata1failed = mysqli_fetch_assoc($qdata1failed);	

$completedvisitsfailed=$qdatadata1failed['completedvisitsfailed'];



$qdata1failed = mysqli_query($dbc,"SELECT count(*) as pagevisitsonly FROM page_views where `stage`='page_visit'");
$qdatadata1failed = mysqli_fetch_assoc($qdata1failed);	

$pagevisitsonly=$qdatadata1failed['pagevisitsonly'];

?>

<div class="row">
                            <div class="col-xl-3 col-lg-4">
                                <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class='uil uil-users-alt float-right'></i>
                                        <h6 class="text-uppercase mt-0">Total Reactivation Form Visits</h6>
                                        <h2 class="my-2" id="active-users-count1"><a href='activationclicks.php'><?php echo $numberofvisits;  ?></a></h2>
                                        <p class="mb-0 text-muted">
                                            <span class="text-success mr-2"><span class="mdi mdi-arrow-up-bold"></span> <?php echo ($numberofvisits/$numberofvisits)*100;  ?>%</span>
                                            <span class="text-nowrap">This Month</span>  
                                        </p>
                                    </div> <!-- end card-body-->
                                </div>
								
								
								
								<div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class='uil uil-users-alt float-right'></i>
                                        <h6 class="text-uppercase mt-0">Reactivation Form Clicks</h6>
                                        <h2 class="my-2" id="active-users-count1"><a href='activationclickspagevisits.php'><?php echo $pagevisitsonly;  ?></a></h2>
                                        <p class="mb-0 text-muted">
                                            <span class="text-success mr-2"><span class="mdi mdi-arrow-up-bold"></span> <?php echo number_format(($pagevisitsonly/$numberofvisits)*100,2);  ?>%</span>
                                            <span class="text-nowrap">This Month</span>  
                                        </p>
                                    </div> <!-- end card-body-->
                                </div>
								
								
								
								
                                <!--end card-->

                                <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class='uil uil-window-restore float-right'></i>
                                        <h6 class="text-uppercase mt-0">Submitted Reactivation Requests</h6>
                                        <h2 class="my-2" id="active-views-count1"><a href='activationclickscompleted.php'><?php echo $completedvisits;  ?></a></h2>
                                        <p class="mb-0 text-muted">
                                            <span class="text-danger mr-2"><span class="mdi mdi-arrow-down-bold"></span> <?php echo number_format(($completedvisits/$numberofvisits)*100,2);  ?>%</span>
                                            <span class="text-nowrap">This Month</span>
                                        </p>
                                    </div> <!-- end card-body-->
                                </div>
								
								
								
								
								 <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class='uil uil-window-restore float-right'></i>
                                        <h6 class="text-uppercase mt-0">Uncompleted Reactivation Requests</h6>
                                        <h2 class="my-2" id="active-views-count1"><a href='activationclicksuncompleted.php'><?php echo $completedvisitsfailed;  ?></a></h2>
                                        <p class="mb-0 text-muted">
                                            <span class="text-danger mr-2"><span class="mdi mdi-arrow-down-bold"></span> <?php echo number_format(($completedvisitsfailed/$numberofvisits)*100,2);  ?>%</span>
                                            <span class="text-nowrap">This Month</span>
                                        </p>
                                    </div> <!-- end card-body-->
                                </div>
								
								
								
								
                                <!--end card-->

                                <div class="card cta-box overflow-hidden">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body">
              <h3 class="m-0 font-weight-normal cta-box-title">View <b>Campaign</b><a href='smstemplates.php'> Messages </a><i class="mdi mdi-arrow-right"></i></h3>
                                            </div>
                                            <img class="ml-3" src="assets/images/email-campaign.svg" width="92" alt="Generic placeholder image">
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                            </div> <!-- end col -->

                            <div class="col-xl-9 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <ul class="nav float-right d-none d-lg-flex">
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">Today</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">7d</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#">15d</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">1m</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">1y</a>
                                            </li>
                                        </ul>
                                        <h4 class="header-title mb-3">Trend Analysis</h4>

                                        <div id="sessions-overview" class="apex-charts mt-3" data-colors="#0acf97"></div>
										<br>
										<h4 class="header-title mb-3">Dormant Vrs Active</h4>
										<div id="revenue12-chart" class="apex-charts mt-3" data-colors="#727cf5,#0acf97"></div>
										
										
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div>
                        </div>
						
					 <script src="assets/js/vendor/apexcharts.min.js"></script>	