<!DOCTYPE html>
<html lang="en">


<?php include("config/header.php");  ?>


<body>
	
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<div class="preloader1">
			<div class="preloader-blk">
				<div class="1preloader__image"></div>
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
									<h3 class="page-title">Company Overview</h3>
								</div>
								<div class="col-md-8 float-end ms-auto">
									<div class="d-flex title-head">
										<div class="daterange-picker d-flex align-items-center justify-content-center">
											<div class="form-sort me-2">
												<i class="ti ti-calendar"></i>
												<input type="text" class="form-control  date-range bookingrange">
											</div>	
											<div class="head-icons mb-0">
												<a href="index.html" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
												<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header"><i class="ti ti-chevrons-up"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


					</div>
					
					
					<!-- Deal Dashboard -->
				<?php
if ( isset( $_POST['submit'] ) ){

    
    
    
    
    $SubMenuName = $_POST['SubMenuName'];
    
    $Url = $_POST['Url'];
	
	$Menu = $_POST['Menu'];
	 
	$showmenu = $_POST['showmenu'];
    $position=$_POST['position'];
    
    
	
	
   $id = rand(10000,99999);
//SELECT `id`, `main_menu_id`, `title`, `url`, `position` FROM `sub_menu` WHERE 1
   $user = "INSERT INTO sub_menu(`title`, `main_menu_id`,`showmenu`,`url`) 
		VALUES('$SubMenuName', '$Menu','$showmenu','$Url')";
        		
				
		$acr = mysqli_query($dbc,$user);
		
		
   
	
		
        if ($acr) {
            //move_uploaded_file($cImage_tmp_name,"pictures/$new_image_name");
			
	//echo $api;
	//echo $message;
            echo '<center><p class=" h4 alert alert-success" role="alert">App successfully Created </p> <br> </center>';
        } else {
            echo '<p class=" h4 alert alert-danger" role="alert">An Error Occur Please Try Again! or Code already in use';
			
			
        }
    #} else
       # echo '<p class=" h4 alert alert-danger" role="alert">Image file not supported';

}
?>
	
					 <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    
                                    <h4><b>Add New App</b></h4>

<form method="post">                                 
					
<div class="row">
					




		<div class="col-6">
		
		
		
<div class="form-group">
<label class="control-label">Application Name: </label> 
			
<input type="text" class="form-control validate[required]" id="SubMenuName" name="SubMenuName" value="">
				
  
</div>


<div class="form-group">
                 <label for="Value">Position  </label>
                <input type="number" class="form-control" id="position" name="position" value="">
            </div>
            
			<div class="form-group">
                  <input type="radio" name="showmenu" value="1">Show Menu<br>
  <input type="radio" name="showmenu" value="0">Hide Menu<br>
            
	
            
            </div>


			
</div>




	
	
	
<div class="col-6">	


<div class="form-group">
                 <label for="Value">URL  </label>
                <input type="text" class="form-control" id="Url" name="Url" value="">
            </div>
			
			
			
			
			
			
<div class="form-group">
             <label for="Value">Parent Menu  </label>
                <select name="Menu" class="form-control">
				
				
				<?php
                    $iconname = mysqli_query($dbc,"SELECT * FROM main_menu");
                        while($iconnameData = mysqli_fetch_array($iconname)){
							
							$ModuleName=$iconnameData["title"];
							$ModuleID=$iconnameData["id"];
							
                echo "<option value='$ModuleID' >
                    $ModuleName
                </option>";
							
							 }
                        ?>		
				
				
				</select>
			
          </div>
			
			
			
		  
		  
		  
			
			
			
	</div>	




			
			
     
		


		
		
		
	

<div class="col-6">

			 <input class="btn btn-primary" type="submit" value="Save" name="submit" >
</div>





</div>


</form>		
	
                                </div>
                            </div><!-- end col -->
                        </div>		
					
					
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