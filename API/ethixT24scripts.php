<?php   

include("config/connection.php");
include("formfunction.php");
error_reporting(0);
//include("generateinfinitytoken.php"); ETHIXREF

//$tokennew=generateToken($dbc); TRANSFERTOETHIX 
 
while(1){
	

$q = mysqli_query($dbc,"SELECT * FROM `ethixtransaction` where `t24status`='Failed' or `t24status`=''");

while($data = mysqli_fetch_assoc($q)){



$ptid=$data['ptid'];

$accountNumber=trim($data['accountNumber']);
$transactionDetails=$data['transactionDetails'];
$processingBranch=$data['processingBranch'];
$tellerName=$data['tellerName'];

$credit=trim($data['credit']);
$debit=$data['debit'];
$valueDate=$data['valueDate'];
$postingDateTime=$data['postingDateTime'];

$effectiveDate=$data['effectiveDate'];
$atmLocation=$data['atmLocation'];
$tfrAcctNo=trim($data['tfrAcctNo']);
$amount=trim($data['amount']);


$originTracerNo=$data['originTracerNo'];
$description=$data['description'];



//$eslipCurrency='GHS';

$currency = array('cedi'=>'GHS','dollar'=>'USD');

$accounts_dollar = array("6040100415", "6040172854", "6040186057", "6040180903", "6040167656", 
    "6040170417", "6040180954", "6040146710", "6040180857", "6040146702", "6040170395", "6040146729", 
    "6040170379", "6040170409", "6040170387","01-001-1-11396");

if (in_array(trim($data['tfrAcctNo']),$accounts_dollar) || in_array(trim($data['accountNumber']),$accounts_dollar)){
	$eslipCurrency=$currency['dollar'];}
else{$eslipCurrency=$currency['cedi'];}



$dateTime = new DateTime($effectiveDate);
$effectiveDate = $dateTime->format('Ymd');


//$valueDate='20241101';

$commandlogin="FUNDS.TRANSFER,/I/PROCESS//0,$t24username/$t24password/,";
	
$commandlogslogin="FUNDS.TRANSFER,BMS/I/PROCESS//0,$t24username/..../,";
	

$hidreceiptprint='No';	
	


global $ip,$port,$jbossuser,$command,$jbosspassword,$tablename,$dbc,$CUSTOMERID,$myspliter; 

//SELECT `ptid`, `accountNumber`, `transactionDetails`, `processingBranch`, `tellerName`, `credit`, `debit`, `valueDate`, `postingDateTime`, `effectiveDate`, `atmLocation`, `tfrAcctNo`, `amount`, `originTracerNo`, `description`, `t24reference`, `t24status` FROM `ethixtransaction` WHERE 1

//OLD
//$command="$commandlogin,DEBIT.ACCT.NO=$accountNumber,DEBIT.AMOUNT=$amount,CREDIT.ACCT.NO=$tfrAcctNo,DEBIT.CURRENCY=$eslipCurrency,TRANSACTION.TYPE=AC,DEBIT.VALUE.DATE=$valueDate,CHARGE.TYPE=$charge_code,ORDERING.BANK=Bnk,POSITION.TYPE=TR,ETHIXREF=$ptid,DEBIT.THEIR.REF=$description,$narrationarray";
//OLD
//$commandlogs="$commandlogslogin,DEBIT.ACCT.NO=$accountNumber,DEBIT.AMOUNT=$amount,CREDIT.ACCT.NO=$tfrAcctNo,DEBIT.CURRENCY=$eslipCurrency,TRANSACTION.TYPE=AC,DEBIT.VALUE.DATE=$valueDate,ETHIXREF=$ptid,CHARGE.TYPE=$charge_code,ORDERING.BANK='',DEBIT.THEIR.REF=$description,$narrationarray";



$command="$commandlogin,DEBIT.ACCT.NO=$accountNumber,DEBIT.AMOUNT=$amount,CREDIT.ACCT.NO=$tfrAcctNo,DEBIT.CURRENCY=$eslipCurrency,TRANSACTION.TYPE=AC,DEBIT.VALUE.DATE=$effectiveDate,CREDIT.VALUE.DATE=$effectiveDate,CHARGE.TYPE=$charge_code,ORDERING.BANK=Bnk,POSITION.TYPE=TR,ETHIXREF=$ptid,DEBIT.THEIR.REF=$description,$narrationarray";

$commandlogs="$commandlogslogin,DEBIT.ACCT.NO=$accountNumber,DEBIT.AMOUNT=$amount,CREDIT.ACCT.NO=$tfrAcctNo,DEBIT.CURRENCY=$eslipCurrency,TRANSACTION.TYPE=AC,DEBIT.VALUE.DATE=$effectiveDate,CREDIT.VALUE.DATE=$effectiveDate,ETHIXREF=$ptid,CHARGE.TYPE=$charge_code,ORDERING.BANK='',DEBIT.THEIR.REF=$description,$narrationarray";


$xmlMessage="$commandlogs";

$logFilePath = 'bmslogs\accountpayment_logs.txt';

logXmlMessage($xmlMessage,$logFilePath);


$response=tafjr19api_teller($ip,$port,$jbossuser,$command,$jbosspassword,$tablename,$dbc,$CUSTOMERID);


$xmlMessage="$response";

$logFilePath = 'bmslogs\accountpayment_logs.txt';

logXmlMessage($xmlMessage,$logFilePath);


//ECHO "<BR>";
//print_r($response); DEBIT.THIER.REF

//echo "<br>response messages: $response</br>";

$myspliter=explode('//',$response);


$newsplits=explode(',',$response);

//error_reporting(E_ALL);
echo "<br>";
print_r($myspliter);
echo "<br>";

//echo $newsplits['50'];
//echo $newsplits[50];

$arrayacount=count($myspliter);
echo $myspliter1code=trim($myspliter[1])[0];

$contractresponse=trim($myspliter[1]);

//echo "<br>";

if($arrayacount<=4){
	
//echo "<br>response messages: $response</br>";

echo $t24responsecode=$myspliter[2];

	echo "<br>";
	echo $t24transactionid=$myspliter[0];
	echo "<br> test";
	
$t24responsecode=trim($myspliter[0]);


echo "<br>UPDATE `ethixtransaction` set `t24status`='Loaded',`t24reference`='$t24transactionid'  where `ptid`='$ptid'<br>";



	
if($myspliter1code==1){
	
$keyarray=explode('/',$key);

$myspliter2=explode(',',$myspliter1);


mysqli_query($dbc,"UPDATE `ethixtransaction` set `t24status`='Loaded',`t24reference`='$t24transactionid'  where `ptid`='$ptid'");	
	

echo "<br>UPDATE `ethixtransaction` set `t24status`='$contractresponse' where `ptid`='$ptid'<br>";

}else{
	
mysqli_query($dbc,"UPDATE `ethixtransaction` set `t24status`='Failed',`t24errormessage`='$contractresponse'  where `ptid`='$ptid'");	
	
	
	
}
	
	
	
	
	
	
	
	
}else{
	
echo "no message";
}





	

}//end of loop




}


	?>
