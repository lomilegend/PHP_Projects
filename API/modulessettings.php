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
											<a href="generalsettings" >
												<i class="ti ti-settings-cog"></i> General Settings
											</a>
										</li>
										
										
										<li>
											<a href="appinvoicesettings" class="active">
												<i class="ti ti-apps"></i> App Settings
											</a>
										</li>
										
										
										
										
										<li>
											<a href="emailsettings">
												<i class="ti ti-device-laptop"></i> System Settings
											</a>
										</li>
										<li>
											<a href="payment-gateways.html">
												<i class="ti ti-moneybag"></i> Financial Settings
											</a>
										</li>
										
										<li>
											<a href="leadcompanysettings">
												<i class="ti ti-flag-cog"></i> Company Settings
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
										
										
										
										
											<h4>App Settings</h4>
											
											 <ul class="nav nav-tabs flex-column vertical-tabs-2" role="tablist">
											   <li class="nav-item">
												   <a class="nav-link active" data-bs-toggle="tab" role="tab"
													   aria-current="page" href="#home-vertical-custom"
													   aria-selected="true">
													   <p class="mb-1"><i class="feather-home"></i></p>
													   <p class="mb-0 text-break">CRM Settings</p>
												   </a>
											   </li>
											   <li class="nav-item">
												   <a class="nav-link" data-bs-toggle="tab" role="tab"
													   aria-current="page" href="#about-vertical-custom"
													   aria-selected="true">
													   <p class="mb-1"><i class="feather-phone"></i></p>
													   <p class="mb-0 text-break">Lead Setting</p></a>
											   </li>
											   <li class="nav-item">
												   <a class="nav-link mb-0" data-bs-toggle="tab" role="tab"
													   aria-current="page" href="#services-vertical-custom"
													   aria-selected="true">
													   <p class="mb-1"><i class="feather-headphones"></i></p>
													   <p class="mb-0 text-break">Opportunity Setting</p>
												   </a>
											   </li>
											   
											   
											  
										<li class="nav-item">
												   <a class="nav-link mb-0" data-bs-toggle="tab" role="tab"
													   aria-current="page" href="#services-vertical-Prefixes"
													   aria-selected="true">
													   <p class="mb-1"><i class="feather-headphones"></i></p>
													   <p class="mb-0 text-break">Contact</p>
												   </a>
											   </li>											  
											   
											   
											   
											   
											   
											   <li class="nav-item">
												   <a class="nav-link mb-0" data-bs-toggle="tab" role="tab"
													   aria-current="page" href="#services-vertical-Localization"
													   aria-selected="true">
													   <p class="mb-1"><i class="feather-headphones"></i></p>
													   <p class="mb-0 text-break">Localization</p>
												   </a>
											   </li>											  
											   
											   
											   
											   <li class="nav-item">
												   <a class="nav-link mb-0" data-bs-toggle="tab" role="tab"
													   aria-current="page" href="#services-vertical-language"
													   aria-selected="true">
													   <p class="mb-1"><i class="feather-headphones"></i></p>
													   <p class="mb-0 text-break">Language</p>
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
 
 
 <?php include("pages/crmsettingforms.php")  ?>

 
 
 
 
 
 
 
</div>
											   
											   
											   
<div class="tab-pane text-muted" id="about-vertical-custom" role="tabpanel"> 

<?php include("pages/printersforms.php")  ?>


</div>

											   
											   
<div class="tab-pane text-muted" id="services-vertical-custom"  role="tabpanel">
<?php include("pages/printerscustomeform.php")  ?> 

</div>



<div class="tab-pane text-muted" id="services-vertical-Prefixes"  role="tabpanel">
<?php include("pages/appsettingsprefixform.php")  ?> 

</div>
		



<div class="tab-pane text-muted" id="services-vertical-Localization"  role="tabpanel">
<?php include("pages/appsettinglocalationform.php")  ?> 

</div>


<div class="tab-pane text-muted" id="services-vertical-language"  role="tabpanel">
<?php include("pages/appsettinglanguageform.php")  ?> 

</div>
		
											   
 </div>








								
							</div>
						</div>