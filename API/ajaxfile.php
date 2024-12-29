
<h4>Knowledge Base</h4>
                  <table class="table table-striped table-bordered table-hover" id="example">
                        <thead>
                        <tr>
                         <th>Proposed Solution</th>	
						 
						 <th>Recommendation</th>	
						 <!-- <th>Details</th> -->
						<th>Provided By</th>
							
							
							

                        </tr>
						
                        </thead>
                        <tbody>

<?php

error_reporting(0);
include "config/connection.php";
//include("jsfiles.php");

//include("customs_css/agentviews.php");
$Request_Category = $_POST['Request_Category'];

$Request_Type = $_POST['Request_Type'];



//$Request_Category ='';

//$Request_Type = '';



/* $response = "<table class='table table-striped table-bordered table-hover'>";
$response = "<thead>
<tr>
<td>Solution</td>						 

<td>Provided By</td>


</tr>
</thead>

<tbody>

"; */

if($Request_Category=='' and $Request_Type==''){
	
echo "<font color='red'>Sorry there are no available solution in the knowledge base </font>";
$sql = "";	

}elseif($Request_Category=='' and $Request_Type !=''){
	
$sql = "select * from heldeskactivities where `Request_Type` like '%$Request_Type%'";
	
	

}else{

$sql = "select * from heldeskactivities where `Request_Type` like '%$Request_Type%' or `Request_Category` like '%$Request_Category%'";
}

$result = mysqli_query($dbc,$sql);

while( $row = mysqli_fetch_array($result) ){
    $id = $row['id'];
    $description = $row['description'];
    $updated_by = $row['updated_by'];
	$recommendation = $row['recommendation'];
    
    
    
    $response .= "<tr><td><label>".wordwrap($description)."</label></td>";
    

    $response .= "<td><label>".wordwrap($recommendation)."</label></td>";
    
   
    $response .= "<td>".$updated_by."</td> </tr>";
    

}
$response .= "</tbody></table>";

echo $response;
//exit;


//include("jsfiles.php");

?>