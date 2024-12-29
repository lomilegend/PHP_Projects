<!-- Settings Menu -->

<style>
.vertical-tabs-2 .nav-item .nav-link {
    min-width: 7.5rem;
   max-width: 25.5rem;
    text-align: center;
    border: 1px solid #6F6F6F;
    margin-bottom: 0.5rem;
    color: #9595b5;
    background-color: #FDFDFE;
}
</style>


						<div class="card settings-tab">
							<div class="card-body pb-0">
								<div class="settings-menu">
									<ul class="nav">
										<li>
											<a href="infinityapisetup" class="active">
												<i class="ti ti-settings-cog"></i> General Settings
											</a>
										</li>
										
										
										
										
										
										
										
										
										
										<li>
											<a href="leadcompanysettings">
												<i class="ti ti-flag-cog"></i> Environment Settings
											</a>
										</li>
										
										<!--<li>
											<a href="storage.html">
												<i class="ti ti-flag-cog"></i> Other Settings
											</a>
										</li> -->
									</ul>
								</div>
							</div>
						</div>
						<!-- /Settings Menu -->
<div class="row">
							<div class="col-xl-3 col-lg-12 theiaStickySidebar">

								<!-- Settings Sidebar -->
								<div class="card">
									<div class="card-body">
										<div class="settings-sidebar">
										
										
										
										
											<h4>General Settings</h4>
											
											 <ul class="nav nav-tabs flex-column vertical-tabs-2" role="tablist">
											   <li class="nav-item">
												   <a class="nav-link active" data-bs-toggle="tab" role="tab"
													   aria-current="page" href="#home-vertical-custom"
													   aria-selected="true">
													   <p class="mb-1"><i class="feather-home"></i></p>
													   <p class="mb-0 text-break">API Variable</p>
												   </a>
											   </li>
											   <li class="nav-item">
												   <a class="nav-link" data-bs-toggle="tab" role="tab"
													   aria-current="page" href="#about-vertical-custom"
													   aria-selected="true">
													   <p class="mb-1"><i class="feather-phone"></i></p>
													   <p class="mb-0 text-break">Security</p></a>
											   </li>
											   <li class="nav-item">
												   <a class="nav-link mb-0" data-bs-toggle="tab" role="tab"
													   aria-current="page" href="#services-vertical-custom"
													   aria-selected="true">
													   <p class="mb-1"><i class="feather-headphones"></i></p>
													   <p class="mb-0 text-break">Notifications</p>
												   </a>
											   </li>
											   
											   
											 
											   
										   </ul>
										   
											
											
										</div>
										
										 
										
										
										
									</div>
								</div>
								<!-- /Settings Sidebar -->

							</div>

							<div class="col-xl-9 col-lg-12">



<div class="tab-content">
<div class="tab-pane show active text-muted" id="home-vertical-custom" role="tabpanel">
 
 
 <?php include("infinitypages/infinityvariables.php")  ?>

 
 
 
 
 
 
 
</div>
											   
											   
											   
<div class="tab-pane text-muted" id="about-vertical-custom" role="tabpanel"> 

<?php include("pages/securityforms.php")  ?>


</div>

											   
											   
<div class="tab-pane text-muted" id="services-vertical-custom"  role="tabpanel">
<?php include("pages/notificationforms.php")  ?> 

</div>
											   
											   
 </div>








								
							</div>
						</div>