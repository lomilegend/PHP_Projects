<?php
error_reporting(0);
//$dbc=mysqli_connect("localhost","root","","inlakscrm");

include("config/connection.php");
include("formfunction.php");
global $dbc;
//$customer_id ='190198';
global $dbc,$accountnumber,$formatter,$tablename,$fieldname,$branchcodeid,$Channel_ID,$id,$CUSTOMERID,$customer_id;
global $dbc,$accountnumber,$formatter,$tablename,$fieldname,$accountnumber,$fieldname,$tablename,$enquiryName,$company,$operand,$t24User,$t24Pass;
//$customer_id = trim($_POST['customer_id']);
$customer_id = $_POST['customer_id'];

$CUSTOMERID=trim("$customer_id");




//$CUSTOMERID ="+4477464999725";

//$sql = "SELECT * FROM `heritagecustomerviewtable` WHERE `heritagecustomerviewtable`.`FLD_CU`='$customer_id'";



//$sql = "SELECT * FROM `t24customerenq` WHERE `@ID`='$CUSTOMERID'";

//$query = mysqli_query($dbc, $sql);

//$result = mysqli_fetch_assoc($query);

//print_r($result);

//if($result==''){
	
	/* //customersearchid_ticket($CUSTOMERID);
	$id="$CUSTOMERID";
	$enquiryname="ACCOUNTLIST2";
	$fieldname="CUSTOMER";
	$tablename="accountlist2_enquiry"; */
	
	//$id=$CUSTOMERID;
	//$enquiryname="MOBILECUSTOMER";
	//$enquiryname="%25CUSTOMER";
	//$fieldname="@ID";
	//$tablename="MOBILECUSTOMER";
	//$operator='EQ';
	//createinsert_enquiry($id,$dbc,$enquiryname,$fieldname,$tablename);
	//createinsert_all_enquiry($id,$dbc,$enquiryname,$fieldname,$tablename,$operator,$branchcodeid);		
	//createinsert_enquiry($id,$dbc,$enquiryname,$fieldname,$tablename)
	
$enquiryname='CUSTOMERVIEW3';

$tablename='psl.customer';

$operator='EQ';

$fieldname="LEGAL.ID";


global $CUSTOMERID;

//77968
	
//$command="ENQUIRY.SELECT,,$t24username/$t24password/,$enquiryname";100283



 $command="ENQUIRY.SELECT,,$t24username/$t24password/,$enquiryname,$fieldname:$operator=$CUSTOMERID";

tafjr19api_customer($ip,$port,$jbossuser,$command,$jbosspassword,$tablename,$dbc,$CUSTOMERID);


	
	
	

//$sql = "SELECT * FROM `psl.customer` WHERE `customer_id`='$CUSTOMERID' or `SMS_1`='$CUSTOMERID' OR `PHONE_1`='$CUSTOMERID' OR `EMAIL_1`='$CUSTOMERID'";


$sql = "SELECT * FROM `psl.customer` WHERE `LEGAL_ID`='$CUSTOMERID'";

$query1 = mysqli_query($dbc, $sql);

$result1 = mysqli_fetch_assoc($query1);
	
	
echo json_encode($result1);




//print_r($result);
// $result['SHORT.NAME'];



mysqli_close($dbc);
?>