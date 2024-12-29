<?php

include("config/connection.php");

$issue_type = $_POST['issue_type'];
//$issue_type ='Complaints';

$sql = "SELECT * FROM `heritagecattypetable` WHERE `issue_type` = '$issue_type' order by `ids`";

$query = mysqli_query($dbc, $sql);
echo '<option value ="">Select a Service Category</option>';
 while($result=mysqli_fetch_assoc($query)){
	echo '<option value="'.$result['ids'].'">'.$result['Category_Type'].'</option>';
//echo json_encode($result);
	
}

mysqli_close($dbc);
?>

