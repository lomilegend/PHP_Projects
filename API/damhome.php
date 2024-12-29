<!DOCTYPE html>
<html lang="en">


<?php include("config/header.php");  ?>


<body>
	
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<div class="preloader">
			<div class="preloader-blk">
				<div class="preloader__image"></div>
			</div>
		</div>

		<!-- Header -->
		
		<?php include("config/topmenubar.php");  ?>
		<!-- /Header -->

		<!-- Sidebar  sidebarmenus.php -->
		<?php include("config/sidebarmenus.php");  ?>
		<!-- /Sidebar -->

		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content">

				<div class="row">
					
					<div class="col-md-12">
					
					
						<div class="page-header">
							<div class="row align-items-center ">
								<div class="col-md-4">
									<h3 class="page-title">CRM Dashboard</h3>
								</div>
								<div class="col-md-8 float-end ms-auto">
									<div class="d-flex title-head">
										<div class="daterange-picker d-flex align-items-center justify-content-center">
											<div class="form-sort me-2">
												<i class="ti ti-calendar"></i>
												<input type="text" class="form-control  date-range bookingrange">
											</div>	
											<div class="head-icons mb-0">
												<a href="index.php" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
												<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header"><i class="ti ti-chevrons-up"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


					</div>
					 <?php 
					 
					 //error_reporting(E_ALL);
					 
					 //include('welcomedashboard.php');   ?>
					
					<!-- Deal Dashboard -->
					<?php 
					
					
					//include("maindashboard_client.php");
					
					include('inc/dormantsummaryview.php'); ?>
					
					
					 <?php  include("dashboard_four.php")    ?>
						 
						 
						  <?php  include("dashboard_five.php")    ?>
						 
						 
                        <!-- end row -->

						<?php  include("dashboard_three.php")    ?>


                        <?php  include("dashboard_one.php")    ?>
						
						
                        
						 <?php  include("dashboard_two.php")    ?>
                        
					
					
					<?php //include("homedasboard.php");  ?>
					
					<!-- End of Deal Dashboard -->
					
					
				</div>

			</div>
		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->
	

	
	<?php include("config/jsfiles.php");  ?>

	

</body>
</html>