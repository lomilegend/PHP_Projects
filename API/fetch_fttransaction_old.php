<?php
//error_reporting(0);
//$dbc=mysqli_connect("localhost","root","","inlakscrm");

include("config/connection.php");
include("formfunction.php");
global $dbc;
//$customer_id ='190198';
global $dbc,$accountnumber,$formatter,$tablename,$fieldname,$branchcodeid,$Channel_ID,$id,$CUSTOMERID,$customer_id;
global $dbc,$accountnumber,$formatter,$tablename,$fieldname,$accountnumber,$fieldname,$tablename,$enquiryName,$company,$operand,$t24User,$t24Pass;
//$customer_id = trim($_POST['customer_id']);
$customer_id = $_POST['customer_id'];

error_reporting(E_ALL);

$CUSTOMERID=trim("$customer_id");

//325792752
//while(1) {

$CUSTOMERID='API';

	
$enquiryname='TRANSFERTOETHIX';

$tablename='TRANSFERTOETHIX';

$operator='EQ';

$fieldname="ETHIXREF";
//$fieldname="@ID";


global $CUSTOMERID;

//77968
	
//$command="ENQUIRY.SELECT,,$t24username/$t24password/,$enquiryname";100283



//echo $command="ENQUIRY.SELECT,,$t24username/$t24password/,$enquiryname,$fieldname:$operator=$CUSTOMERID,CREDIT.VALUE.DATE:EQ=!TODAY";

echo $command="ENQUIRY.SELECT,,$t24username/$t24password/,$enquiryname";


tafjr19api_customer($ip,$port,$jbossuser,$command,$jbosspassword,$tablename,$dbc,$CUSTOMERID);


	
	
//}	

//$sql = "SELECT * FROM `psl.customer` WHERE `customer_id`='$CUSTOMERID' or `SMS_1`='$CUSTOMERID' OR `PHONE_1`='$CUSTOMERID' OR `EMAIL_1`='$CUSTOMERID'";



?>