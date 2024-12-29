<?php 

error_reporting(0);
include("config/connection.php");

//print_r($_POST);


$pinNumber=$_POST['pinNumber'];

$cameraimage=$_POST['cameraimage'];


$complaintcategory12 = mysqli_query($dbc,"SELECT * FROM atm_company where `nianumber`='$pinNumber'");
$complaintcategorydata12 = mysqli_fetch_array($complaintcategory12);
					
 $company_name=$complaintcategorydata12["company_name"];
$email=$complaintcategorydata12["email"];

$phone_1=$complaintcategorydata12["phone_1"];

$bank_name=$complaintcategorydata12["bank_name"];

//SELECT `ids`, `logged_by`, `tablename`, `applicationtype`, `application_name`, `bussines_unit`, `company_status`, `entity_id`, `company_name`, `nianumber`, `email`, `phone_1`, `Phone_2`, `fax`, `website`, `ratings`, `currency`, `language`, `Description_of_company`, `street_address`, `city`, `state_province`, `country`, `zipcode`, `timestamp`, `datecreated`, `channel`, `sytem_id`, `customerimage` FROM `atm_company` WHERE 1

//C:\Hyosung\MoniPlus2S\bin\MoniPlus2.Loader.exe

//$atmfilepath="C:\Hyosung\MoniPlus2S\bin\MoniPlus2.Loader.exe";

$atmfilepath="C:\Program Files\Notepad++\\notepad++.exe";

if($company_name==''){
	
	echo $resultCodedes="<h3><font color='Red'>Verification Failed</font> </h3>";
	
}else{
	
	
echo "<div class='row'>";



echo "<div class='col-xl-12 col-lg-12'>";

echo "<div class='col-xl-5 col-lg-5 scannchequedetails'>";
 
 echo "<h5>$resultCodedes</h5>";
 
echo $resultCodedes="<h3><font color='green'>Verified</font> </h3>";


echo "<button class='btn btn-success'> <a href='$atmfilepath'>START ATM</a></button>";
 
echo '<table class="table">';

echo '<tr>';
echo '<td><b>Client Name</b></td><td>' . $company_name . '</td>';



echo '</tr>';


echo '<tr>';
echo '<td><b>Email</b></td><td>' . $email . '</td>';



echo '</tr>';


echo '<tr>';
echo '<td><b>Mobile Number</b></td><td>' . $phone_1 . '</td>';


echo '</tr>';

echo '</tbody>';
echo '</table>';

echo "</div>";

}

?>