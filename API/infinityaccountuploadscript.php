<?php   

include("config/connection.php");

//error_reporting(0);
include("generateinfinitytoken.php");

$tokennew=generateToken($dbc);
 


$q = mysqli_query($dbc,"SELECT * FROM `infinity_contract` where `contract_status`=''");

while($data = mysqli_fetch_assoc($q)){

echo "<br>";
echo "<br>";
echo "<br>";	
//print_r($data);

echo "<br>";
//Array ( [ids] => 2 [logged_by] => [tablename] => infinity_contract [applicationtype] => infinity [application_name] => infinity [bussines_unit] => bussines_unit [company_status] => New [entity_id] => [legalEntityId] => 121215454 [serviceDefinitionId] => Testing 2 [cif] => 343434 [accountId] => 65060000500605 [primaryCif] => 3000000 [phoneNumber] => 0544001489 [phoneCountryCode] => 234 [email] => aoberko2@inlaks.com [country] => Ghana [cityName] => Accra [state] => Accra [zipCode] => 233 [addressLine1] => [addressLine2] => [faxId] => 343430000900 [timestamp] => 2024/07/18 [datecreated] => 2024/07/18 [channel] => Web [sytem_id] => infinity00002 [customerimage] => infinity00002- [contract_status] => ) 


$ids=$data['ids'];

$legalEntityId=$data['legalEntityId'];
$serviceDefinitionId=$data['serviceDefinitionId'];
$cif=$data['cif'];
$accountId=$data['accountId'];

$primaryCif=$data['primaryCif'];
$phoneNumber=$data['phoneNumber'];
$phoneCountryCode=$data['phoneCountryCode'];
$email=$data['email'];

$country=$data['country'];
$cityName=$data['cityName'];
$state=$data['state'];
$zipCode=$data['zipCode'];


$addressLine1=$data['addressLine1'];
$addressLine2=$data['addressLine2'];
$faxId=$data['faxId'];






/*  
if($t24responsecode=='1'){
	
	
$q = mysqli_query($dbc,"update `t24accounts` set `credit_alert`='Yes', `credit_id`='$SUSCRIBEID'  where `@ID`='$accountnumber'");	
	
	upload_error
	
}else{

$q = mysqli_query($dbc,"SELECT * FROM `t24accounts` where `@ID`='$accountnumber'");	
	
} */






//createContract($tokennew);

echo $contractresponse=createContract($tokennew,$data);



 mysqli_query($dbc,"UPDATE `infinity_contract` set `upload_error`='$contractresponse',`company_status`='Failed'  where `ids`='$ids'");	
	



}//end of loop





	?>
