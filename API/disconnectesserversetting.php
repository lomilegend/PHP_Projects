<?php 

include("config/connection.php");

$id=$_GET['id'];

//echo "$id";

$userstatusupdateremoveactive = mysqli_query($dbc,"UPDATE `sitesetup` SET `status` = 'Inactive' WHERE `siteidnumber` = '$id';") or mysqli_error("Error in Update");

header("location:setupserver.php");

?>