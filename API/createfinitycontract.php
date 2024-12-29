<div class="card main-card">
							<div class="card-body">

								<!-- Search -->
								<div class="search-section">
									<div class="row">
										<div class="col-md-5 col-sm-4">
											<div class="form-wrap icon-form">
												<span class="form-icon"><i class="ti ti-search"></i></span>
												<input type="text" class="form-control" placeholder="Search Contract">
											</div>							
										</div>		
										<div class="col-md-7 col-sm-8">					
											<div class="export-list text-sm-end">
												<ul>
													<li>
														<div class="export-dropdwon">
		<a href="javascript:void(0);" class="dropdown-toggle"  data-bs-toggle="dropdown"><i class="ti ti-package-export"></i>Export</a>
															<div class="dropdown-menu  dropdown-menu-end">
				    											<ul>
				    												<li>
				    													<a href="javascript:void(0);"><i class="ti ti-file-type-pdf text-danger"></i>Export as PDF</a>
				    												</li>
				    												<li>
				    													<a href="javascript:void(0);"><i class="ti ti-file-type-xls text-green"></i>Export as Excel </a>
				    												</li>
				    											</ul>
				  											</div>
														</div>
													</li>									
													<li>
						<a href="javascript:void(0);" class="btn btn-primary add-popup"><i class="ti ti-square-rounded-plus"></i>Add Contract</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- /Search -->

								<!-- Filter -->
								
								<!-- /Filter -->

								<!-- Contact List -->
								<div class="table-responsive custom-table">
									<table class="table" id="atmclientlist121">
										<thead class="thead-light">
											<tr>
												
												<th>Upload ID</th>
													
												<th>Entries</th>
													
												<th>Legal Entity ID</th>
												<th>Account ID</th>
												<th>Phone Number</th>
												<th>Email</th>
												<th>City Name</th>
												<th>Upload Status</th>
												
												
												
												
												<th class="text-end">Action</th>
											</tr>
										</thead>
										<tbody>
											
											

<?php
								
                               $q = mysqli_query($dbc,"SELECT * from infinity_contract group by `upload_id`");

                                while($data = mysqli_fetch_assoc($q)){
  //SELECT `ids`, `logged_by`, `tablename`, `applicationtype`, `application_name`, `bussines_unit`, `company_status`, `entity_id`, `legalEntityId`, `serviceDefinitionId`, `cif`, `accountId`, `primaryCif`, `phoneNumber`, `phoneCountryCode`, `email`, `country`, `cityName`, `state`, `zipCode`, `addressLine1`, `addressLine2`, `faxId`, `timestamp`, `datecreated`, `channel`, `sytem_id`, `customerimage` FROM `infinity_contract` WHERE 1                              
												$company_status=$data['company_status'];

$upload_id=$data['upload_id'];												

$countupload = mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM infinity_contract where `upload_id`='$upload_id'"));

												
                                    ?>
                                    <tr class="odd gradeX">
                                        
										
                                        
										
                                        
                                        	<td  class=""><?php echo $data['upload_id'] ?></td>
											
											<td  class=""><?php echo $countupload ?></td>
											
											
										<td  class=""><?php echo $data['legalEntityId'] ?></td>
									
										<td  class=""><?php echo $data['accountId'] ?></td>
										
										
										<td  class=""><?php echo $data['phoneNumber'] ?></td>
										
										<td  class=""><?php echo $data['email'] ?></td>
										
											<td  class=""><?php echo $data['cityName'] ?></td>
											
											<td  class=""><?php 
											
											if($company_status=='Failed'){
												
												
											echo "<span class='badge badge-pill badge-status bg-danger'>$company_status</span>";
											
											}elseif($company_status=='New'){
												
											echo "<span class='badge badge-pill badge-status bg-warning'>$company_status</span>";	
											}else{
												
												echo "<span class='badge badge-pill badge-status bg-success'>$company_status</span>";	
												
											}
											
											//echo $data['company_status'];
											
											
											
											
											?></td>
										
<td  class=""><a href="viewContractdetails.php?id=<?php echo $data['upload_id']; ?>" ><button type="button" class="btn btn-success btn-l"><?php echo"View"?></button></a>
										
										
										
										
										</td>
										
										
										 
										
                                    </tr>
                                <?php
                                
								
								}
//status
                                ?>


											
											
											
											
											
											
											
											
										</tbody>
									</table>
								</div>
								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="datatable-length"></div>
									</div>
									<div class="col-md-6">
										<div class="datatable-paginate"></div>
									</div>
								</div>
								<!-- /Contact List -->

							</div>
						</div>
						
						
						
						
						<?php  include("modals/addcontractmodals.php"); ?>
						
						
						
						