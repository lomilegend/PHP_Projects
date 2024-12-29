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
									<h3 class="page-title">Tickets Details</h3>
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
					
					<?php include("ticketsdetailsview.php");  ?>
					
					<!-- End of Deal Dashboard -->
					
					
				</div>

			</div>
		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->
	
<script type='text/javascript'>
            $(document).ready(function(){
$(".loader1").hide();
                $('.knowledgesearch').click(function(){
                   $(".loader1").show();
                    //var userid = $(this).data('Request_Type');Request_Category
					var Request_Type=$("#Request_Type").val();
					var Request_Category=$("#Request_Category").val();
                    // AJAX request
                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {Request_Type: Request_Type,Request_Category:Request_Category},
                        success: function(response){ 
                            // Add response in Modal body
							$(".loader1").hide();
                            $('.result').html(response); 

                            // Display Modal
                            
                        }
                    });
                });
            });
            </script>


<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>



 <script type='text/javascript'>
        $( "#submit" ).click(function( event ) {
            event.preventdefault();
            alert('Your ticket is currently closed.');
        }
        
        </script>
					
				
				
				
<SCRIPT language="javascript">
        function addRow(tableID) {

            var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            var colCount = table.rows[0].cells.length;

            for(var i=0; i<colCount; i++) {

                var newcell    = row.insertCell(i);

                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            }
        }

        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }


            }
            }catch(e) {
                alert(e);
            }
        }

    </SCRIPT>

<script>

$(document).ready(function(){
	$('#addattachment').hide('');
 $('#addattachmentButton').on('click', function(event){
  event.preventDefault();
  $('#addattachment').show('');
  //addattachment
  //var bank_code = $('.bank_code').val();
  //$('#result').html('Loading');
  //console.log("It Clicked");
  $.ajax({
   url:"",
   method:"POST",
   data:{bank_code: bank_code},
   //dataType:'json',
   //contentType:false,
   //cache:false,
   //processData:false,
   success:function(jsonData)
   {
    //$('#csv_file').val('');
	//$('#errorcheckdiv').html(jsonData);
    
   }
   
  
  
  });
 });
});






$(document).ready(function() {
    $('table.data-table').DataTable();
} );

</script>				
				
		
	

<?php include("config/jsfiles.php");  ?>

</body>
</html>