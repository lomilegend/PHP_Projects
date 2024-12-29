<?php

include ('config/connection.php');
$Request_Category = $_POST['Request_Category'];
//$Request_Category ='C01';

$sql = "SELECT * FROM heritagecompaintdetails WHERE Category_Type = '$Request_Category' order by ids";

$query = mysqli_query($dbc, $sql);
echo '<option value ="">Select a Service Name</option>';
 while($result=mysqli_fetch_assoc($query)){
	echo '<option value="'.$result['Complaints'].'">'.$result['Complaints'].'</option>';
//echo json_encode($result);
	
}

mysqli_close($dbc);
?>

