<?php   

include("config/connection.php");
include("formfunction.php");

include("transfertoEthix.php");

error_reporting(0);
//include("generateinfinitytoken.php"); ETHIXREF

//$tokennew=generateToken($dbc); TRANSFERTOETHIX 

$authToken=generateEthixToken($dbc);


 
 //while(1) {


//$q = mysqli_query($dbc,"SELECT * FROM `transfertoethix` where `ETHIXREF`='API'");

$q = mysqli_query($dbc,"SELECT * FROM `transfertoethix` where `exthixnumber`=''");
//$q = mysqli_query($dbc,"SELECT * FROM `transfertoethix` where `@iD`='FT24243HPY5Y'");

while($data = mysqli_fetch_assoc($q)){

//SELECT `ids`, `@ID`, `DATE_TIME`, `TRANSACTION_TYPE`, `CREDIT_ACCT_NO`, `CCY1`, `AMOUNT_CREDITED`, `DEBIT_ACCT_NO`, `DEBIT_ACCT_NAME`, `CCY2`, `AMOUNT_DEBITED`, `PAYMENT_DETAILS`, `INPUTTER`, `ALTDEBiTACCOUNT`, `ALTCREDITACCOUNT`, `ETHIXREF`, `status`, `transactionmode` FROM `transfertoethix` WHERE 1


echo $t24transferid=trim($data['@ID']);

$TRANSACTION_TYPE=trim($data['TRANSACTION_TYPE']);
$CREDIT_ACCT_NO=$data['CREDIT_ACCT_NO'];
echo $amount=trim($data['AMOUNT_CREDITED']);
$DEBIT_ACCT_NO=$data['DEBIT_ACCT_NO'];

$sourceAccount=trim($data['ALTDEBiTACCOUNT']);

$destinationAccount=trim($data['ALTCREDITACCOUNT']);
$ETHIXREF=trim($data['ETHIXREF']);

$destinationAccountCcy=trim($data['CCY1']);

$sourceAccountCcy=trim($data['CCY1']);

$INPUTTER=$data['INPUTTER'];
$transferDescription=$data['PAYMENT_DETAILS'];

$transType='ACCT_TO_ACCT';

$dateTime = new DateTime($valueDate);
//$effectiveDate = $dateTime->format('Ymd');
$DEBIT_VALUE_DATE=trim($data['DEBIT_VALUE_DATE']);
//$effectiveDate=date("Y-m-d");
$hidreceiptprint='No';	
	
ECHO $effectiveDate=formatDatetoEthix($date=$DEBIT_VALUE_DATE);
	
$amount=extractAmount($amountWithCurrency=$amount);

//$effectiveDate=date("Y-m-d");

//$effectiveDate='2024-10-04';

global $ip,$port,$jbossuser,$command,$jbosspassword,$tablename,$dbc,$CUSTOMERID,$myspliter; 

//SELECT `ptid`, `accountNumber`, `transactionDetails`, `processingBranch`, `tellerName`, `credit`, `debit`, `valueDate`, `postingDateTime`, `effectiveDate`, `atmLocation`, `tfrAcctNo`, `amount`, `originTracerNo`, `description`, `t24reference`, `t24status` FROM `transfertoethix` WHERE 1

ECHO $jsonResponse=makeZenithTransfer($sourceAccount, $destinationAccount, $amount, $effectiveDate, $transferDescription, $reference="$t24transferid", $transType, $sourceAccountCcy, $destinationAccountCcy, $tranPostingId="$t24transferid", $authToken);


$details=extractEthixTransferResponse($jsonResponse);

$description=$details['description'];
$phoenixTransId=$details['phoenixTransId'];
$message=$details['message'];

//echo "<br>";

if($details['message']=='FAILED'){
	
//echo "<br>response messages: $response</br>";
	
mysqli_query($dbc,"UPDATE `transfertoethix` set `status`='$message',`ethixerror`='$description' where `@ID`='$t24transferid'");		
	
}else{
	
mysqli_query($dbc,"UPDATE `transfertoethix` set `status`='$message',`ETHIXREF`='$phoenixTransId',`exthixnumber`='$phoenixTransId',`ethixerror`='NO ERROR' where `@ID`='$t24transferid'");	

echo "<br>UPDATE `transfertoethix` set `status`='$message',`ETHIXREF`='$phoenixTransId',`ethixerror`='NO ERROR' where `@ID`='$t24transferid'<br>";

	
}





	

}//end of loop


//}//end of main loop

?>
