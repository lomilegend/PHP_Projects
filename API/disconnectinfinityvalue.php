<?php 

include("config/connection.php");

$id=$_GET['id'];

//echo "$id";

$userstatusupdateremoveactive = mysqli_query($dbc,"UPDATE `infinity_variables` SET `status` = 'INACTIVE' WHERE `ids` = '$id';") or mysqli_error("Error in Update");

header("location:infinityapisetup");

?>