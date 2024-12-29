<?php
include("config/connection.php");
    $ids=$_POST['id'];
    $pg=$_POST['pg'];
    $key=$_POST['key'];

//echo "DELETE FROM `$pg` WHERE `$key`='$ids';";

$applicant12 = mysqli_query($dbc,"DELETE FROM `$pg` WHERE `$key`='$ids';");


if ($applicant12) {
           
    echo 'Successfully Removed';
			
	
        } else {
		
				
            echo 'An Errored Occur Please Try Again!';
        }



	


?>