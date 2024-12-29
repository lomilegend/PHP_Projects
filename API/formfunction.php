<?php

include("loanfunctions.php");

global $t24username,$t24password,$t24serviceurlApplication;

global $t24username,$t24password,$t24serviceurlApplication,$username,$password;
$serversetup = mysqli_query($dbc,"SELECT * FROM sitesetup where status='Active'");
$serversetupdata=mysqli_fetch_array($serversetup);
$t24username=base64_decode($serversetupdata['name']);
$t24password=base64_decode($serversetupdata['t24password']);
$ip=$serversetupdata['ipaddress'];	
$port=$serversetupdata['port'];
$Channels=$serversetupdata['apichannel'];

$T23branchcode=$serversetupdata['branchcode'];

$environment_type=$serversetupdata['environment_type'];



$jbossuser=$serversetupdata['jbossuser'];

$jbosspassword=$serversetupdata['jbosspassword'];




//include('R19API.php');


if($environment_type=='TAFJ'){

$t24serviceurl="http://$ip:$port/TAFJServices/services/OFSService/Invoke?Request=ENQUIRY.SELECT,,$t24username/$t24password";

$t24serviceurlApplication="http://$ip:$port/TAFJServices/services/OFSService/Invoke?Request=";

include('R19API.php');

}elseif($environment_type=='TAFJR19'){
	
include('R19API.php');

$enquiryname='CUSTOMERVIEW3';

$tablename='brainbox_accounts12';

$operator='EQ';

$fieldname="@ID";

global $CUSTOMERID;

//77968
	
//$command="ENQUIRY.SELECT,,$t24username/$t24password/,$enquiryname";100369

$command="ENQUIRY.SELECT,,$t24username/$t24password/,$enquiryname,$fieldname:$operator=100369";
	
	

//tafjr19api($ip,$port,$jbossuser,$command,$jbosspassword,$tablename,$dbc,$CUSTOMERID);


	
}else{

$t24serviceurl="http://$ip:$port/$Channels/webresources/OFSAPI?ENQUIRY.SELECT,,$t24username/$t24password/";

$t24serviceurlApplication="http://$ip:$port/$Channels/webresources/OFSAPI?";

include('R19API.php');	
	
}								//updatecustomerdetails($id,$dbc);

 
 

 
 
 
 
 
 
 

function T24_LOCAL_TABLES($APPLICATION,$FIELDS){

global $ip,$port,$t24username,$t24password,$customernumber,$cmd,$enquiry,$response,$command,$t24serviceurl,$fullname,$id,$customernumber,$t24customerid,$t24serviceurlApplication,$myspliter,$response,$messaget,$t24customeridcode,$code1,$code2;
global $SHORT_NAME;




$command="LOCAL.TABLE,/I/PROCESS//0,$t24username/$t24password,,DESCRIPTION=$FIELDS,SHORT.NAME=$SHORT_NAME,NAME.1=$SHORT_NAME,SECTOR=1001,LANGUAGE=1,STREET=$ADDRESS,ACCOUNT.OFFICER=1,INDUSTRY=1000,TARGET=1,NATIONALITY=GH,CUSTOMER.STATUS=1,RESIDENCE=GH,EMAIL.1=$EMAIL_1,SMS.1=$PHONE_1";

//$t24serviceurl="http://7.200.128.60:8085/TAFJServices/services/OFSService/Invoke?Request=";

//$t24serviceurl="http://localhost:8085/TAFJServices/services/OFSService/Invoke?Request=";

$messaget="$t24serviceurlApplication$command";

$command=urlencode($command);


$response=file_get_contents("$t24serviceurlApplication$command");	


$myspliter=array_unique(explode('/',$response));
$t24customeridcode=explode('>',$myspliter[7]);
$t24customerid=$t24customeridcode[2];

//$code1=$myspliter[7];
$code233=explode(',',$myspliter[9]);






}	

 
 
 
 
 
 
 
 function Createcustomer($SHORT_NAME,$MNEMONIC,$PHONE_1){
	
global $ip,$port,$t24username,$t24password,$customernumber,$cmd,$enquiry,$response,$command,$t24serviceurl,$fullname,$id,$customernumber,$t24customerid,$t24serviceurlApplication,$myspliter,$response,$messaget,$t24customeridcode,$code1,$code2;
global $SHORT_NAME;

global $passwordregister;

global $DATE_OF_BIRTH;

global $GENDER;

global $PHONE_1;

global $MARITAL_STATUS;

global $ADDRESS;

global $EMAIL_1;	


$command="CUSTOMER,/I/PROCESS//0,$t24username/$t24password,,MNEMONIC=$MNEMONIC,SHORT.NAME=$SHORT_NAME,NAME.1=$SHORT_NAME,SECTOR=1001,LANGUAGE=1,STREET=$ADDRESS,ACCOUNT.OFFICER=1,INDUSTRY=1000,TARGET=1,NATIONALITY=GH,CUSTOMER.STATUS=1,RESIDENCE=GH,EMAIL.1=$EMAIL_1,SMS.1=$PHONE_1";

//$t24serviceurl="http://7.200.128.60:8085/TAFJServices/services/OFSService/Invoke?Request=";

//$t24serviceurl="http://localhost:8085/TAFJServices/services/OFSService/Invoke?Request=";

$messaget="$t24serviceurlApplication$command";

$command=urlencode($command);


$response=file_get_contents("$t24serviceurlApplication$command");	


$myspliter=array_unique(explode('/',$response));
$t24customeridcode=explode('>',$myspliter[7]);
$t24customerid=$t24customeridcode[2];

//$code1=$myspliter[7];
$code233=explode(',',$myspliter[9]);

$code2=$code233[0];
$code1=$myspliter[1];
//echo "<br>This is the Customer ID $t24customerid <br>";

return $t24customerid;
		
}//end of customer function




function CheckConnectionStatus($Channel_ID){
		      
	  global $id,$dbc,$enquiryname,$DEBIT_ACCT_NO,$tablename,$channel_status,$Channel_ID;
        $records=null;
       
        
		
        $recordquery=mysqli_query($dbc,"SELECT `status` FROM servicemonitoring where `id`='$Channel_ID'");

		$data = mysqli_fetch_assoc($recordquery);
       
        $channel_status=$data['status'];
      
		//$channel_status="online";
		
		//return $channel_status;
	
	return $channel_status;
	
	
	}
	//end of function
	

//get all records of account


  function GetAllAccountDetails($accountnumber,$fieldname,$tablename)
    {
		global $dbc,$accountnumber,$formatter,$tablename,$fieldname;

       // $q = mysqli_query($this->databaseconnection,"SELECT * FROM CUSTOMERVIEW");
       $q = mysqli_query($dbc,"SELECT * FROM $tablename where `$fieldname`='$accountnumber'");
        while ($datar = mysqli_fetch_assoc($q))
        {
          $records[]=$datar;
        }	
        return $records;
		//echo "test";
       
    }







function GetAccountBalance($DEBIT_ACCT_NO){
		      
	  global $id,$dbc,$enquiryname,$DEBIT_ACCT_NO,$tablename,$operator,$ONLINE_ACTUAL_BAL;
        $records=null;
       
        //$tablename=$this->tablename;
		//$tablename='calbankaccount_snapp';
		
        $recordquery=mysqli_query($dbc,"SELECT `ONLINE_ACTUAL_BAL` FROM `calbankaccount_snapp` where `@ID`='$DEBIT_ACCT_NO'");

		$data = mysqli_fetch_assoc($recordquery);
       
        $ONLINE_ACTUAL_BAL=$data['ONLINE_ACTUAL_BAL'];
      
		//return number_format(str_replace(',','',trim($ONLINE_ACTUAL_BAL)));
		
		return str_replace(',','',trim($ONLINE_ACTUAL_BAL));
	
	}
	//end of function
	



function CreateAtmTransfer_SNAP($DEBIT_ACCT_NO){
	
global $ip,$port,$t24username,$t24password,$customernumber,$cmd,$enquiry,$response,$command,$t24serviceurl,$fullname,$id,$customernumber,$t24customerid,$t24serviceurlApplication,$myspliter,$response,$messaget,$t24customeridcode,$code1,$code2,$t24accountid,$channel_status,$Channel_ID,$code1;

global $DEBIT_ACCT_NO,$DEBIT_AMOUNT,$CREDIT_AMOUNT,$CREDIT_ACCT_NO,$NARRATION,$DATE,$uploadid,$snapinp,$snapp_id,$transaction,$dbc,$DEBIT_CURRENCY,$TRANSACTION_TYPE,$PAYMENT_DETAILS;

global $version,$application,$transactionId,$function,$operation,$gtsControl,$messageId,$agentCode,$dynamicUser,$criteria,$company,$t24Pass,$t24User,$company;

global $DEBIT_ACCT_NO_fieldName,$DEBIT_AMOUNT_fieldName,$CREDIT_AMOUNT_fieldName,$CREDIT_ACCT_NO_fieldName,$NARRATION,$DATE,$uploadid,$snapinp,$snapp_id,$transaction,$dbc,$DEBIT_CURRENCY_fieldName,$TRANSACTION_TYPE_fieldName,$PAYMENT_DETAILS_fieldName;


$DEBIT_AMOUNT=str_replace(',','',trim($DEBIT_AMOUNT));

$Channel_ID='5';

$channel_status=CheckConnectionStatus($Channel_ID);

//check if system is online snapp_id $DEBIT_THEIR_REF_fieldName
if($channel_status=="Online"){


//$CUSTOMERLOGIN="FUNDS.TRANSFER,/I/PROCESS//0,$t24username/$t24password,";

$CUSTOMERLOGIN="$application,$version/$function/$operation//$gtsControl,$t24username/$t24password/$company,";

//$command="$CUSTOMERLOGIN,DEBIT.ACCT.NO=$DEBIT_ACCT_NO,DEBIT.AMOUNT=$DEBIT_AMOUNT,CREDIT.ACCT.NO=$CREDIT_ACCT_NO,DEBIT.CURRENCY=$DEBIT_CURRENCY,PAYMENT.DETAILS=$NARRATION,TRANSACTION.TYPE=AC,CREDIT.VALUE.DATE=$DATE,SNAP.ID=$snapp_id,SNAP.INP=$snapinp,SNAP.AUT=$snapaut";	
	
	
$command="$CUSTOMERLOGIN,$DEBIT_ACCT_NO_fieldName=$DEBIT_ACCT_NO,$DEBIT_AMOUNT_fieldName=$DEBIT_AMOUNT,$CREDIT_ACCT_NO_fieldName=$CREDIT_ACCT_NO,$DEBIT_CURRENCY_fieldName=$DEBIT_CURRENCY,$PAYMENT_DETAILS_fieldName=$PAYMENT_DETAILS,$TRANSACTION_TYPE_fieldName=$TRANSACTION_TYPE,CREDIT.VALUE.DATE=$DATE,SNAP.ID=$snapp_id,SNAP.INP=$snapinp,SNAP.AUT=$snapaut";	
	
$messaget="$t24serviceurlApplication$command <BR>";

$command=urlencode($command);


$response=file_get_contents("$t24serviceurlApplication$command");	


$myspliter=array_unique(explode('/',$response));

//print_r($myspliter);

$t24customeridcode=explode('>',$myspliter[7]);

//print_r($t24customeridcode);
$t24accountid=$t24customeridcode[2];

//$code1=$myspliter[7];
$code233=explode(',',$myspliter[9]);

$code2=$code233[0];
$code1=$myspliter[1];
//echo "<br>This is the Customer ID $code2 <br>";


}else{
	
	
	
$transaction = mysqli_query($dbc,"SELECT * FROM `calbankaccount_snapp` where `@ID`='$DEBIT_ACCT_NO' ");
$transactiondata=mysqli_fetch_array($transaction);	
$balance=trim($transactiondata['ONLINE_ACTUAL_BAL']);



$transactioncredit = mysqli_query($dbc,"SELECT * FROM `calbankaccount_snapp` where `@ID`='$CREDIT_ACCT_NO' ");
$transactioncreditdata=mysqli_fetch_array($transactioncredit);	
$balancecredit=trim($transactioncreditdata['ONLINE_ACTUAL_BAL']);



$balance=str_replace(',','',$balance);;
$DEBIT_AMOUNT=str_replace(',','',trim($DEBIT_AMOUNT));	
		
//if($balance>$DEBIT_AMOUNT){
$newbalance=$balance-$DEBIT_AMOUNT;

//GetAccountBalance($DEBIT_ACCT_NO);	

$balanceupdate = mysqli_query($dbc,"UPDATE `calbankaccount_snapp` SET `ONLINE_ACTUAL_BAL` ='$newbalance'  WHERE `@ID`='$DEBIT_ACCT_NO'");	
	
$randaomed=rand(100,99000);	
	
$t24accountid="SNAPP$randaomed";

$code2=5;
//}
//check balance
	
	
	
	
	
}

//end of online check








return $t24accountid;
		
}






function CreateAtmTransfer($DEBIT_ACCT_NO){
	
global $ip,$port,$t24username,$t24password,$customernumber,$cmd,$enquiry,$response,$command,$t24serviceurl,$fullname,$id,$customernumber,$t24customerid,$t24serviceurlApplication,$myspliter,$response,$messaget,$t24customeridcode,$code1,$code2,$t24accountid,$channel_status,$Channel_ID;

global $DEBIT_ACCT_NO,$DEBIT_AMOUNT,$CREDIT_AMOUNT,$CREDIT_ACCT_NO,$NARRATION,$DATE,$uploadid,$snapinp,$snapp_id,$transaction,$dbc,$DEBIT_CURRENCY;

$DEBIT_AMOUNT=str_replace(',','',trim($DEBIT_AMOUNT));

$Channel_ID='5';

$channel_status=CheckConnectionStatus($Channel_ID);

//check if system is online snapp_id DEBIT.CURRENCY
if($channel_status=="Online"){


$CUSTOMERLOGIN="FUNDS.TRANSFER,CALPAY/I/PROCESS//0,$t24username/$t24password,";

$command="$CUSTOMERLOGIN,DEBIT.ACCT.NO=$DEBIT_ACCT_NO,DEBIT.AMOUNT=$DEBIT_AMOUNT,CREDIT.ACCT.NO=$CREDIT_ACCT_NO,DEBIT.CURRENCY=$DEBIT_CURRENCY,PAYMENT.DETAILS=$NARRATION,TRANSACTION.TYPE=ACSD,CREDIT.VALUE.DATE=$DATE,SNAP.ID=$snapp_id,SNAP.INP=$snapinp,SNAP.AUT=$snapaut";	
	
$messaget="$t24serviceurlApplication$command <BR>";

$command=urlencode($command);


$response=file_get_contents("$t24serviceurlApplication$command");	


$myspliter=array_unique(explode('/',$response));
$t24customeridcode=explode('>',$myspliter[7]);
$t24accountid=$t24customeridcode[2];

//$code1=$myspliter[7];
$code233=explode(',',$myspliter[9]);

$code2=$code233[0];
$code1=$myspliter[1];
//echo "<br>This is the Customer ID $t24customerid <br>";


}else{
	
	
	
$transaction = mysqli_query($dbc,"SELECT * FROM `calbankaccount_snapp` where `@ID`='$DEBIT_ACCT_NO' ");
$transactiondata=mysqli_fetch_array($transaction);	
$balance=trim($transactiondata['ONLINE_ACTUAL_BAL']);



$transactioncredit = mysqli_query($dbc,"SELECT * FROM `calbankaccount_snapp` where `@ID`='$CREDIT_ACCT_NO' ");
$transactioncreditdata=mysqli_fetch_array($transactioncredit);	
$balancecredit=trim($transactioncreditdata['ONLINE_ACTUAL_BAL']);



$balance=str_replace(',','',$balance);;
$DEBIT_AMOUNT=str_replace(',','',trim($DEBIT_AMOUNT));	
		
//if($balance>$DEBIT_AMOUNT){
$newbalance=$balance-$DEBIT_AMOUNT;

//GetAccountBalance($DEBIT_ACCT_NO);	

$balanceupdate = mysqli_query($dbc,"UPDATE `calbankaccount_snapp` SET `ONLINE_ACTUAL_BAL` ='$newbalance'  WHERE `@ID`='$DEBIT_ACCT_NO'");	
	
$randaomed=rand(100,99000);	
	
$t24accountid="SNAPP$randaomed";

$code2=5;
//}
//check balance
	
	
	
	
	
}

//end of online check








return $t24accountid;
		
}









//create accounts
function Createt24account($t24customerid){
	
global $ip,$port,$t24username,$t24password,$customernumber,$cmd,$enquiry,$response,$command,$t24serviceurl,$fullname,$id,$customernumber,$t24customerid,$t24serviceurlApplication,$myspliter,$response,$messaget,$t24customeridcode,$code1,$code2,$t24accountid;

global $constituency,$district,$region,$city,$digitalAddress,$registeredBusiness,$emailaddress,$postalAddress,$mobilenumber,$applicanttype,$myspliter,$nameofapplicant,$t24accountid;
	
//$t24customerid='190417';

//$command="ACCOUNT,/I/PROCESS//0,$t24username/$t24password,,CUSTOMER=$t24customerid,ACCOUNT.TITLE.1=$nameofapplicant,SHORT.TITLE=$nameofapplicant,CATEGORY=1001,CURRENCY=USD,DIGITALADRESS=$digitalAddress,REGISTEDBUSS=$registeredBusiness,POSTALADDRESS=$postalAddress";

$command="ACCOUNT,/I/PROCESS//0,$t24username/$t24password,,CUSTOMER=$t24customerid,ACCOUNT.TITLE.1=$nameofapplicant,SHORT.TITLE=$nameofapplicant,CATEGORY=1001,CURRENCY=USD";

//$t24serviceurl="http://7.200.128.60:8085/TAFJServices/services/OFSService/Invoke?Request="; 190417

//$t24serviceurl="http://localhost:8085/TAFJServices/services/OFSService/Invoke?Request=";

$messaget="$t24serviceurlApplication$command";

$command=urlencode($command);


$response=file_get_contents("$t24serviceurlApplication$command");	


$myspliter=array_unique(explode('/',$response));
$t24customeridcode=explode('>',$myspliter[7]);
$t24accountid=$t24customeridcode[2];

//$code1=$myspliter[7];
$code233=explode(',',$myspliter[9]);

$code2=$code233[0];
$code1=$myspliter[1];
//echo "<br>This is the Customer ID $t24customerid <br>";

return $t24accountid;
		
}
 
 
 
 
 
 function createinsert_all_enquiry_calbank($id,$dbc,$enquiryname,$fieldname,$tablename,$operator,$branchcodeid){
global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname,$operator,$id;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$dbc,$branchcodeid;
//$id="1002100709";

//echo "$t24serviceurl,$enquiryname,$fieldname:EQ=$id <br>";
//$response=file_get_contents("OFS_RESPONSE1.txt");
//$response=file_get_contents("$t24serviceurl,AMFB.ACCOUNT.LIST,@ID:EQ=$id");
//echo "$t24serviceurl,$enquiryname,$fieldname:$operator=$id <br>";
$response=file_get_contents("$t24serviceurl,$enquiryname,$fieldname:$operator=$id");
	
$myspliter=explode(',"',$response);


//var_dump($myspliter);

 global $logo,$valuedata,$crmd,$keys1;
 //global $dbc,$CRMDATA,$value,$fielddata,$tablefields1,$tablefieldsforinsert;
  $counts=count($myspliter);
  $myspliter1=explode(',',$myspliter[0]);
  

  
  
  $header1=explode('/',$myspliter1[1]);
   $headers=explode('/',$header1[0]);
 
 
 foreach($header1 as $header ){
	$newheader=explode(':',$header);
	if (strpos(':',$header) == false) {
        $newheader=explode(':',$header);
		//print_r($newheader);
		
		
		$fielddata .= "`$newheader[0]`,";
		//$fielddata .= str_replace('.','_',"`$newheader[0]`,");
	
	//$fields=$newheader[0];
	$fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	//$query = "CREATE TABLE IF NOT EXISTS `crmtest`($keys1)";
	
	
	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	
}
	else{
		
	 //echo ("<td><b><$newheader[1]-></b></td>");
	 $fielddata .= "`$newheader[1]`";
	 
	 
	 
	 //$fielddata .= str_replace('.','_',"`$newheader[1]`,");
	 //$replace1=str_replace('_','.',$key);
	 //$fields=$newheader[0];
	 $fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
	
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	

	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	
	}
 }
 //$tablefields = implode(',', $keys1);
 //DROP TABLE `25ld_loans_and_deposits_enquiry`"
 
 if($fields=''){
		ECHO "Can not create Table";
	}else{
$query = "CREATE TABLE IF NOT EXISTS `$tablename`($tablefields1`status` VARCHAR(225),`transactionmode` VARCHAR(225))";
$result = mysqli_query($dbc,$query);

$q = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD PRIMARY KEY (`@ID`)");

$q1 = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD COLUMN `ids` INT AUTO_INCREMENT UNIQUE FIRST");

	}
 

	
//end of creating table part of the function


for($i = 1; $i<count($myspliter);$i++){
	   $row =$myspliter[$i];
	  
	   //echo "$row <br>";
	
	  $cells =explode('"',$row);
	  
	  //echo $cells[3];
	   //echo "<br>";
	 //print_r($cells);
	//echo "<br>";   
	  $values = array();

	  foreach($cells as $key=>$value){
		  
 
				if($key % 2!=0){
				 continue;
				 }
				 $value=trim($value);
				   $values[] = "'$value'"; 
			
  		 
	  }
	  
	  
	  GLOBAL $CUSTOMERIDNEW,$Bankcode,$ACCOUNT_NUMBER;
	  $CUSTOMERIDNEW=trim($cells[0]);
	  
	  $ACCOUNT_NUMBER=trim($cells[4]);
	    
		  $Bankcode=trim($cells[14]);
		    //$Bankcode='NG0010001';
	  $query_values = implode(',',$values);

//echo "<br>INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values) ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online' <br>";
	  
//closed_accounts($ACCOUNT_NUMBER,$Bankcode); 
	 	  
		  

/* $CRMDATA =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online',`ONLINE_ACTUAL_BAL`='$cells[12]',`DATE_TIME`='$cells[24]',`DATE_LAST_UPDATE`='$cells[26]'");
	
$CRMDATA1 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'','') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online',`ONLINE_ACTUAL_BAL`='$cells[12]',`DATE_TIME`='$cells[24]',`DATE_LAST_UPDATE`='$cells[26]'");

$CRMDATA2 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert) VALUES($query_values) ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online',`ONLINE_ACTUAL_BAL`='$cells[12]',`DATE_TIME`='$cells[24]',`DATE_LAST_UPDATE`='$cells[26]'");



	
$CRMDATA3 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert,`status`) VALUES($query_values) ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online',`ONLINE_ACTUAL_BAL`='$cells[12]',`DATE_TIME`='$cells[24]',`DATE_LAST_UPDATE`='$cells[26]'");

$CRMDATA4 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values) ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online',`ONLINE_ACTUAL_BAL`='$cells[12]',`DATE_TIME`='$cells[24]',`DATE_LAST_UPDATE`='$cells[26]'");
	 */	  
		  
		  
		  
		  
		  
		  
		  
		  
		  
$CRMDATA =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online',`ONLINE_ACTUAL_BAL`='$cells[10]',`DATE_TIME`='$cells[22]',`DATE_LAST_UPDATE`='$cells[24]'");
	
$CRMDATA1 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'','') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online',`ONLINE_ACTUAL_BAL`='$cells[10]',`DATE_TIME`='$cells[22]',`DATE_LAST_UPDATE`='$cells[24]'");

$CRMDATA2 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert) VALUES($query_values) ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online',`ONLINE_ACTUAL_BAL`='$cells[10]',`DATE_TIME`='$cells[22]',`DATE_LAST_UPDATE`='$cells[24]'");
	
$CRMDATA3 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert,`status`) VALUES($query_values) ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online',`ONLINE_ACTUAL_BAL`='$cells[10]',`DATE_TIME`='$cells[22]',`DATE_LAST_UPDATE`='$cells[24]'");

$CRMDATA4 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values) ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online',`ONLINE_ACTUAL_BAL`='$cells[10]',`DATE_TIME`='$cells[22]',`DATE_LAST_UPDATE`='$cells[24]'");
			 
		  
  }//end of for loop
 


}
 
 
 
 
 
 
 
 
 
 
 
//TELNET CONNECTIONS 
function telnetconnect($ip,$port,$t24username,$t24password,$enquiry){

global $ip,$port,$t24username,$t24password,$customernumber,$cmd,$enquiry,$response;

$fp=fsockopen("$ip", $port, $errno, $errstr, 100); 
if($fp){ 
    //echo 'Connected!<br>'; 
    //fwrite($fp, ""); 
    $ur=fgets($fp); 
//echo $ur.'<br>';  
    //fwrite($fp, "PASS password\r\n"); 
    $pr=fgets($fp); 
    //echo $pr.'<br>';   
	//$cmd="ENQUIRY.SELECT,,BAIDOO/Qwerty123,CUSTOMERVIEW,@ID:EQ=282836\r\n";
	$cmd="ENQUIRY.SELECT,,$t24username/$t24password$enquiry\r\n";
    fwrite($fp, "$cmd"); 
    $res=fgets($fp); 
    //$parts=explode(" ", $res); 
    //echo $parts[4].' messages on server<br><br>';      
    //$cmd="LIST\r\n"; 
    $get=fwrite($fp, $res, strlen($res)); 
    $response=fgets($fp, 81920); 
   // echo '<pre>'.$msg.'</pre>';  
	
	
	
   
} 
else{ 
    echo 'Failed Connecting!<br>'; 
} 
fclose($fp);

}//end of telnetconnect function

	
	


	
function t24connector($enquiry){

global $ip,$port,$t24username,$t24password,$customernumber,$cmd,$enquiry,$response,$command,$t24serviceurl,$dbc;

 $serversetup = mysqli_query($dbc,"SELECT * FROM sitesetup where status='Active'");
$serversetupdata=mysqli_fetch_array($serversetup);
$t24username=base64_decode($serversetupdata['name']);
$t24password=base64_decode($serversetupdata['t24password']);
$ip=$serversetupdata['ipaddress'];	
$port=$serversetupdata['port'];

$T23branchcode=$serversetupdata['branchcode'];
	 
									//updatecustomerdetails($id,$dbc);
$t24serviceurl="http://$ip:$port/Channels/webresources/OFSAPI?ENQUIRY.SELECT,,$t24username/$t24password";

								



//echo "<br>$t24serviceurl$enquiry <br>";

//http://192.168.10.43:8085/NAMBUITChannels/webresources/OFSAPI?

//file_get_contents("$t24serviceurl,MYCRMACCOUNT");

$enquiry=urlencode($enquiry);


$response=file_get_contents("$t24serviceurl$enquiry");	
	
    
    //$response=file_get_contents("http://$ip:8085/NAMBUITChannels/webresources/OFSAPI?$command"); 
   // echo '<pre>'.$msg.'</pre>';  
	
	
	
   


}//end of telnetconnect function	
	
	
	
	
	
	









//finance reports functions 




//function to create table from form post

function createtable($tablename,$formfields,$dbc){
	global $dbc;
	global $tablename;
	global $formfields;
	static $query;
	
//$formfields=$_POST;
$values = array();
$keys1=array();
$allfieldsarray=array();
$exceptions=array();
$allfieldsarraynew=array();
foreach ($formfields as $key => $value) {
	
	$fields=$key;
    $keys1[]="`$fields` text(100)";
	$alterkeys[]="ADD COLUMN `$fields` VARCHAR(100)";
	$allfields.="$fields,";
	$allfieldsarraynew[]=$key;
}
$tablefields = implode(',', $keys1);
$altertablefields = implode(',', $alterkeys);


$query = "CREATE TABLE IF NOT EXISTS `$tablename`($tablefields)";

$result = mysqli_query($dbc,$query);


$q = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD COLUMN `ids` INT AUTO_INCREMENT UNIQUE FIRST");

$allfieldsarray=array($allfields);
//$allfieldsarray=implode(',',$allfieldsarray);
//print_r($allfieldsarraynew);
//echo "this $allfieldsarray<br>";
$collumnselect=mysqli_query($dbc,"SHOW COLUMNS from `$tablename`");
while($collumnselectdata = mysqli_fetch_array($collumnselect)){
							
							$exceptioncolumns1 = $collumnselectdata['Field'];
							$exceptioncolumns.="$exceptioncolumns1,";
							
						$exceptions[]=$exceptioncolumns1;
							//if(!in_array($exceptioncolumns1, $allfieldsarray)){
								//continue;
							//}else{
								//print_r($allfieldsarray);
							//}
							
							//echo "<br> $exceptioncolumns1 <br>";
							
							 }
//echo $exceptioncolumns;

	//$exceptions = array($exceptioncolumns);
	
	//echo "<br>";
	//print_r($exceptions);
	//print_r($exceptions);
//echo "<br>the fields $allfields <br> ";

$arrarydiff=array_diff($allfieldsarraynew,$exceptions);

//echo "the difference $arrarydiff <br>";

	//print_r($arrarydiff);
	foreach($arrarydiff as $diffkey=>$diffvalue){
		
		//echo "<br> $diffvalue";
		//$diffvalue[]=""; text(100)
		//$alterkeys1[]="ADD COLUMN `$diffvalue` VARCHAR(225)";
		$alterkeys1[]="ADD COLUMN `$diffvalue` text(100)";
		
	}
	
	$diffvalue=implode(',',$alterkeys1);
	
	$alters = mysqli_query($dbc,"ALTER TABLE `$tablename` $diffvalue");
	
	
	//echo "<br>ALTER TABLE `$tablename` $diffvalue";
	//print_r($exceptions);
//echo "SHOW COLUMNS from `$tablename` this are the columns $exceptioncolumns ";

//echo "<br>ALTER TABLE `$tablename` $altertablefields<br>";
return $result;







}
//end of function



//modify table fields to accept empty values during insert
function modify_table($tablename,$dbc){
	global $dbc;
	global $tablename;
	global $formfields;
	static $query;
	
//$formfields=$_POST;
$values = array();
$keys1=array();
$allfieldsarray=array();
$exceptions=array();
$allfieldsarraynew=array();

$collumnselect=mysqli_query($dbc,"SHOW COLUMNS from `$tablename`");
while($collumnselectdata = mysqli_fetch_array($collumnselect)){
							
							$exceptioncolumns1 = $collumnselectdata['Field'];
							$exceptioncolumns.="$exceptioncolumns1,";


							if($exceptioncolumns1=='id' or $exceptioncolumns1=='ids' or $exceptioncolumns1=='transac_id'){
								continue;

							}
							$q = mysqli_query($dbc,"ALTER TABLE `$tablename` MODIFY `$exceptioncolumns1` varchar(255) null;");

							echo "<br> ALTER TABLE `$tablename` MODIFY  `$exceptioncolumns1` varchar(255) null<br>";

						
}
						

return $result;







}//end of function







function createtable_old1($tablename,$formfields,$dbc){
	global $dbc;
	global $tablename;
	global $formfields;
	static $query;
	
//$formfields=$_POST;
$values = array();
$keys1=array();

foreach ($formfields as $key => $value) {
	
	$fields=($key);
    $keys1[]="`$fields` VARCHAR(225)";
}
$tablefields = implode(',', $keys1);

$query = "CREATE TABLE IF NOT EXISTS `$tablename`($tablefields)";

$result = mysqli_query($dbc,$query);
//echo $query;
return $result;

}
//end of function



//OFS STRING GENERATOR FUNCTION for complaints
    function ofs_string_generator_customer($formfields){

	global 	$ofsstring,$formfields;
	
//$exceptions = array('Submit2','t24customerid','t24id','transactionmode','status','CUST_TYPE','CUST_TYPE1','FORMER_NAME','INITIALS','OPENING_DATE','RESIDE_Y_N','ID_TYPES','BVN','CUST_LANGUAGE','CURR_ADDRESS','PO_BOX_NO','CLASSIFICATION','STAFF_OFFICIAL','rSTAFF_OFFICIAL');

$exceptions = array('CONTACT_DESC','PROD_TYPE','CONTACT_NOTES','CONTACT_STAFF','CONTACT_DATE','CONTACT_TIME','COMPL_CHAL','CR_ACCT','PROD_CATEG','WALK_IN_CUSTOMER','COMPLIANT_LEVEL','CR_LOCATION','ALTER_ID_NO','CR_SHORT_NAME','CR_RELATION','CONTACT_STATUS','CR_AGE','CR_CUST_CAT','CR_PRE_FB','CR_CUST_DATE','CR_CUST_OUT','CR_AMT_DISP','CR_AMT_SETTLE','CR_AMT_LOSS','CR_ROOT_CAUSES','CR_ACTION','CR_UNRESOL','CONTACT_CLIENT','CR_CATEGORY','CONTACT_NOTES','CONTACT_STAFF','CR_POSTAL_ADD','CR_RESIDENT','LEVEL_EDU','PHONE_NUMBER','CR_EMAIL','CR_TYPE_ID','CR_ID_NUMBER','RESOLUTION_TYPE','CONTACT.CLIENT');
	
	foreach($formfields as $key=>$value){
		//for($x=0; $x<=count($exceptions); $x++){
	//if ($key=='Submit2' or $key=='t24customerid' or $key=='t24id' or $key=='transactionmode' or $key=='status' or $key=='CUST_TYPE' or $key=='CUST_TYPE1' or $key=='FORMER_NAME' or $key=='INITIALS' or $key=='OPENING_DATE' or $key=='RESIDE_Y_N' or $key=='ID_TYPES' or $key=='BVN' or $key=='CUST_LANGUAGE' or $key=='CURR_ADDRESS'){
if(!in_array($key, $exceptions)){
		
		continue;
	}

	$replace1=str_replace('_','.',$key);
	
	$ofsstring1="$replace1=$value,";
	$ofsstring.=$ofsstring1;
	
	
}
}//end of function	



//OFS STRING GENERATOR FUNCTION for SERVICE REQUEST
    function ofs_string_generator_service_request($formfields){

	global 	$ofsstring,$formfields,$dbc;
	
	
	$servicequiery=mysqli_query($dbc,"select * from crmservicetable");
		
	$complaintsquierydata=mysqli_fetch_assoc($servicequiery);
	
		
	//print_r($complaintsquierydata);
	
	//$arr = array(1,2,3,4,6,8,8,8,9);

$str = '';
//creating the array for the string
foreach ($complaintsquierydata as $key1 => $value) {

if ($key1=='Submit2' or $key1=='t24customerid' or $key1=='t24id' or $key1=='transactionmode' or $key1=='status' or $key1=='MNEMONIC' or $key1=='loggeduser'){
	continue;
}

        $str = ($str == '' ? '' : $str . ',') . "'$key1'";

}

//echo $str;
	
	//echo "<br>";
	
	
	
	//echo "<br> $userassinged <br>";
	
	
	
//$exceptions = array('Submit2','t24customerid','t24id','transactionmode','status','CUST_TYPE','CUST_TYPE1','FORMER_NAME','INITIALS','OPENING_DATE','RESIDE_Y_N','ID_TYPES','BVN','CUST_LANGUAGE','CURR_ADDRESS','PO_BOX_NO','CLASSIFICATION','STAFF_OFFICIAL','rSTAFF_OFFICIAL');

//$exceptions = array('CR_REF','CONTACT_DESC','PROD_TYPE','CONTACT_NOTES','CONTACT_STAFF','CONTACT_DATE','CONTACT_TIME','COMPL_CHAL','CR_ACCT','PROD_CATEG','WALK_IN_CUSTOMER','COMPLIANT_LEVEL','CR_LOCATION','ALTER_ID_NO','CR_SHORT_NAME','CR_RELATION','CONTACT_STATUS','CR_AGE','CR_CUST_CAT','CR_PRE_FB','CR_CUST_DATE','CR_CUST_OUT','CR_AMT_DISP','CR_AMT_SETTLE','CR_AMT_LOSS','CR_ROOT_CAUSES','CR_ACTION','CR_UNRESOL','CONTACT_CLIENT','CR_CATEGORY','CONTACT_NOTES','CONTACT_STAFF','CR_POSTAL_ADD','CR_RESIDENT','LEVEL_EDU','PHONE_NUMBER','CR_EMAIL','CR_TYPE_ID','CR_ID_NUMBER','RESOLUTION_TYPE','CONTACT_CHANNEL');

$exceptions1 = array($str);
	//print_r($exceptions1);

foreach($formfields as $key1=>$value){
		//for($x=0; $x<=count($exceptions); $x++){
	//if ($key=='Submit2' or $key=='t24customerid' or $key=='t24id' or $key=='transactionmode' or $key=='status' or $key=='CUST_TYPE' or $key=='CUST_TYPE1' or $key=='FORMER_NAME' or $key=='INITIALS' or $key=='OPENING_DATE' or $key=='RESIDE_Y_N' or $key=='ID_TYPES' or $key=='BVN' or $key=='CUST_LANGUAGE' or $key=='CURR_ADDRESS'){
if ($key1=='Submit2' or $key1=='t24customerid' or $key1=='t24id' or $key1=='transactionmode' or $key1=='status' or $key1=='MNEMONIC' or $key1=='loggeduser'){
	continue;
}

	$replace1=str_replace('_','.',$key1);
	
	$ofsstring1="$replace1=$value,";
	$ofsstring.=$ofsstring1;
	
}
}//end of function	

//insert into database function
function insertdata($tablename,$formfields,$dbc){
	global $dbc;
	global $tablename;
	global $formfields;
	global $result,$MNEMONIC;
	
//$formfields=$_POST;
$values = array();
$keys1=array();
//$MNEMONIC='MNEMONIC';
foreach ($formfields as $key => $value) {
	
	//updated on 20240407
/* if($key=="issue_id"){
$value="$MNEMONIC";	

} */

if($key=="issue_DATE"){
	//$value="$MNEMONIC";
	continue;	
	
	}

//check if value has data issue_DATE
if($value==''){
	unset($formfields[$key]);
	continue;
}
//end checking



	
    $qvalue = $value;
	$qfields=$key;
    $values[] = "'$value'"; 
	$keys1[]="`$qfields`";


	//$q = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD COLUMN `ids` INT AUTO_INCREMENT UNIQUE FIRST");
//ALTER TABLE mytable MODIFY mycolumn varchar(255) null;



	if($qfields == 'Request_Type'){
		$r_category_type = $value;
		$r_cat_type_q = "Select approval, id from heritagecompaintdetails where `Complaints` = '$r_category_type'";
		$r_cat_type_r = mysqli_query($dbc,$r_cat_type_q);
		$r_cat_type_data = mysqli_fetch_array($r_cat_type_r);
		$approval_check = $r_cat_type_data['approval'];
		$service_name_id = $r_cat_type_data['id'];


		if ($approval_check == 'Yes'){
			
			$usr_branch =$_SESSION['branch_name'];

			$branch_q = "Select `user_id`, name, username from users where `user_type` = 'Supervisor' and `branch_name` = '$usr_branch'";
			$branch_r = mysqli_query($dbc,$branch_q);
			$approvers_array = array();
			while($branch_data = mysqli_fetch_array($branch_r)){
				$approver = $branch_data['name'];
				$approver_user_name = $branch_data['username'];
				$approver_user_id = $branch_data['user_id'];
				array_push($approvers_array,$branch_data);
			}
			
		}
		// exit;
	}
}//end of for each

//$issue_id = $values[0];
//$MNEMONIC

//updated on 20240407
//$issue_id=$MNEMONIC;
if(isset($approver)){ 
	//assign supervisor in the branch as approver
	$values[12] = "'Supervisor'";
	// $values[6] = "'Pending Approval - $approver'";
	$values[6] = "'Pending Approval'";

	foreach($approvers_array as $one_approver){
		$approver_user_id = $one_approver['user_id'];
		$pending_w_q = "INSERT INTO issue_users (`issue_id`, `user_id`) VALUES ('$issue_id','$approver_user_id')";
		$pending_w_r = mysqli_query($dbc,$pending_w_q);
	}
	
}else{
	//assign straight to agents responsible

	$ar_q = "Select user_id from heritagecompaintdetails_users where group_id ='$service_name_id'";
	$ar_r = mysqli_query($dbc,$ar_q);
	while($ar_data = mysqli_fetch_array($ar_r)){
		$responsible_user_id = $ar_data['user_id'];
$responsible_user_id1.="$responsible_user_id,";
$pending_w_q = "INSERT INTO issue_users (`issue_id`, `user_id`) VALUES ('$issue_id','$responsible_user_id')";
		$pending_w_r = mysqli_query($dbc,$pending_w_q);
	}
	

}


$query_values = implode(',', $values);
$fields = implode(',', $keys1);



$query = "INSERT INTO `$tablename`($fields) VALUES ($query_values)";
//echo "<br>$query<br>";

$result = mysqli_query($dbc,$query);

if($result){
		//echo "it is successfully done";
		if(isset($approver_user_name)){ //assign supervisor in the branch as approver
			return $approver_user_name;
			//$issue_id,'$responsible_user_id'
	
		}
		if($tablename=='account_api'){
			
			//echo $response='{"name":"John","age":30,"city":"New York"}';
			
		}
		
		
$updateuserassigned = mysqli_query($dbc,"update `$tablename` set `assigned_to`='$responsible_user_id1' where `issue_id`='$issue_id' ");

//echo "update `$tablename` set `assigned_to`='$responsible_user_id1' where `issue_id`='$issue_id' <br> id $issue_id ";	
		
		
	}else{
		//echo "sorry insert not successful";
		//echo mysqli_error(0);
		
	}
	
	return $result;
	


}//end of function

		
		
//funtion to insert form post array into mysql database.
function insertdataoriginal($tablename,$formfields,$dbc){
	global $dbc;
	global $tablename;
	global $formfields;
	global $result;
	
//$formfields=$_POST;
$values = array();
$keys1=array();
//$MNEMONIC='MNEMONIC';
foreach ($formfields as $key=>$value) {
	
    $qvalue = ($value);
	$qfields=($key);
    $values[] = "'$value'"; 
	$keys1[]="`$qfields`";
}
$query_values = implode(',',$values);
$fields = implode(',', $keys1);

$query = "INSERT INTO `$tablename`($fields) VALUES ($query_values)";
//echo "<br> $query </br>";
$result = mysqli_query($dbc,$query);

if($result==1){
		//echo "it is successfully done";
	}else{
		echo "sorry insert not successful";
		//echo mysqli_error(0);
		
	}

}//end of function



//funtion to insert form post array into mysql database.
function insertcalldata($tablename,$formfields,$dbc){
	global $dbc;
	global $tablename;
	global $formfields;
	global $result;
	
//$formfields=$_POST;
$values = array();
$keys1=array();
//$MNEMONIC='MNEMONIC';

$exceptions = array('t24customerid','t24id','MNEMONIC','transactionmode','status','loggeduser','CONTACT_CLIENT','CR_SHORT_NAME','PHONE_NUMBER','CALL_TYPE','CONTACT_STATUS','CONTACT_DESC','CONTACT_DATE','CONTACT_NOTES','RESOLUTION_TYPE','CR_ACTION','CONTACT_TIME','CONTACT_STAFF','COMPL_CHAL','WALK_IN_CUSTOMER','Submit2');

foreach ($formfields as $key=>$value) {
	
	
	if(!in_array($key, $exceptions)){
		
		continue;
	}
	
	//echo "<br>$key <br>";
	
	
    $qvalue = ($value);
	$qfields=($key);
    $values[] = "'$value'"; 
	$keys1[]="`$qfields`";
	
	
}
$query_values = implode(',',$values);
$fields = implode(',', $keys1);


$query = "INSERT INTO `$tablename`($fields) VALUES ($query_values)";

//echo $query;

$result = mysqli_query($dbc,$query);

if($result=1){
		//echo "it is successfully done";
	}else{
		//echo "sorry insert not successful";
		//echo mysqli_error(0);
		
	}

}//end of function







//T24 customer ID UPDATE FUNCTION

function updatet24ids($tablename,$t24customerid,$MNEMONIC,$dbc){
			
			global $tablename,$t24customerid,$MNEMONIC,$dbc,$T23branchcode;
		
		$q = mysqli_query($dbc,"UPDATE `$tablename` SET `t24id`='$t24customerid' WHERE `MNEMONIC`='$MNEMONIC'");
		if($q){
			//echo "it was successful";
		}else{
			//echo "something went wrong";
			
			//echo "$tablename <br> $t24customerid <br> $MNEMONIC <br> $q";
		}
		
		}//END OF FUNCTION
		

		
		//FUNCTION FOR UPDATE ON ALL TABLES 
function updatetable($formfields,$dbc,$tablename,$cust_id,$columname) {
   
global $formfields, $dbc, $tablename,$cust_id,$columname;
   
   //echo "<br>this is the customer ID $cust_id <br>";
$values = array();
$keys1=array();




foreach ($formfields as $key => $value) {
	
    $qvalue = $value;
	$qfields=$key;
    $values[] = "'$value'"; 
	$keys1[]="`$qfields`";
	
$q = mysqli_query($dbc,"UPDATE `$tablename` SET `$qfields`='$qvalue' where `$columname`='$cust_id'; ");
	
	 //echo "UPDATE `$tablename` SET `$qfields`='$qvalue' where `$columname`='$cust_id'; ";       
	
}//END OF FOREACH LOOP

if ($q=1){
       echo '<center><p class=" h4 alert alert-success" role="alert">Updated Successfully.<br>  </center>';
        				
		} else {
            echo '<center><p class=" h4 alert alert-danger" role="alert">An Error Occur Please Try Again! </center>';
        }


}//end of functions//end of functions



function updatetableview($formfields,$dbc,$tablename,$cust_id,$columname) {
   
global $formfields, $dbc, $tablename,$cust_id,$columname;
   
   //echo "<br>this is the customer ID $cust_id <br>";
$values = array();
$keys1=array();




foreach ($formfields as $key => $value) {
	
    $qvalue = $value;
	$qfields=$key;
    $values[] = "'$value'"; 
	$keys1[]="`$qfields`";
	
$q = mysqli_query($dbc,"UPDATE `$tablename` SET `$qfields`='$qvalue' where `$columname`='$cust_id'; ");
	
	 //echo "UPDATE `$tablename` SET `$qfields`='$qvalue' where `$columname`='$cust_id'; ";       
	
}//END OF FOREACH LOOP

if ($q=1){
	
	return 1;
       //echo '<center><p class=" h4 alert alert-success" role="alert">Updated Successfully.<br>  </center>';
        				
		} else {
           // echo '<center><p class=" h4 alert alert-danger" role="alert">An Error Occur Please Try Again! </center>';
        }


}











	//start sms functions
function sendsms($t24customerid){
	global $MOBILENUMBERS,$SENDER,$t24customerid;
	//$MOBILENUMBERS="233544001489";
		global $email_to,$username,$t24customerid,$dbc,$supervisorsemail;
	//$MOBILENUMBERS="233544001489";
		//$email_subject = "HERITAGE BANK CRM TEST";
			
		$complaintsquiery=mysqli_query($dbc,"select * from crmcomplainttable where t24id='$t24customerid'");
		
		$complaintsquierydata=mysqli_fetch_array($complaintsquiery);
	
		$userassinged = $complaintsquierydata['CONTACT_STAFF'];
		$loggedby = $complaintsquierydata['loggeduser'];
		$priority = $complaintsquierydata['COMPLIANT_LEVEL'];
		$timelogged = $complaintsquierydata['CONTACT_DATE'];
		$branch = $complaintsquierydata['CR_LOCATION'];
		$category = $complaintsquierydata['CONTACT_DESC'];
		$issuedesc = $complaintsquierydata['CONTACT_NOTES'];
		//search heritage usertable for actual user name, email address and mobile number
		$userquiery=mysqli_query($dbc,"select * from heritageusertable where `@ID`='$userassinged'");
		
		$userquierydata=mysqli_fetch_array($userquiery);
			
		$userassignedfullname =$userquierydata['USER_NAME'];
		
		$MOBILENUMBERS=$userquierydata['USERPHONE'];
			//echo "<br>Mobile number $MOBILENUMBERS  name $userassignedfullname id $t24customerid<br>";
		
			
		//$MOBILENUMBERS="233544001489";
		
		
		$SENDER = "GHLBank";
			
			
			//$SENDER="ST_TERESAS";
				//$staff=$row['FirstName'];
				
				$message="Dear $userassignedfullname, a complaint has been logged and assigned to your account. Complaints ID is $t24customerid. Kindly login to the CRM platform to attend to it within 24 hrs. Thank you";
				
				
				$ENCODEDMESSAGE=urlencode($message);
		//$api ="http://api.nalosolutions.com/bulksms/?username=perez&password=perez2016&type=0&dlr=1&destination=$MOBILENUMBERS&source=$SENDER&message=$ENCODEDMESSAGE";		
	 $api ="https://api.hubtel.com/v1/messages/send?From=$SENDER&To=$MOBILENUMBERS&Content=$ENCODEDMESSAGE&ClientId=lxpsrryh&ClientSecret=mmsmztcf";
	// http://api.nalosolutions.com/bulksms/?username=perez&password=perez2016&type=0&dlr=1&destination=$MOBILENUMBERS&source=$SENDER&message=$ENCODEDMESSAGE
	 //echo "<br> $api<br>";
	file_get_contents($api);	
		
	
	
}

//end sms functions

//COMPLAINTS MESSAGE


//end sms functions





	function percentagecalculator($NEW,$COMPLETED,$PENDING,$CONFIRMED){
		
		global $NEW,$COMPLETED,$PENDING,$CONFIRMED;
		global $newpercent,$completedpercent,$pendingpercent,$confirmpercent,$alltotals;
		
		$alltotals=$NEW+$COMPLETED+$PENDING+$CONFIRMED;
		$newpercent=round(($NEW/$alltotals)*100,2);
		$completedpercent=round(($COMPLETED/$alltotals)*100,2);
		
		$pendingpercent=round(($PENDING/$alltotals)*100,2);
		$confirmpercent=round(($CONFIRMED/$alltotals)*100,2);
		
		
		
	}
							

function ACCOUNTSTATEMENT($ACCOUNTNUMBER){
global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response;

$response=file_get_contents("$t24serviceurl,E.USSD.MINI.STMT,ACCT.ID:EQ=$ACCOUNTNUMBER,USER.ACTION:EQ=FIRST,NO.OF.TRANS:EQ=5");
		
$myspliter=explode(',',$response);
 global $logo,$valuedata,$crmd,$keys1;
 global $dbc,$CRMDATA,$value,$fielddata,$tablefields1;
  $counts=count($myspliter);
  //$values = array();
//$keys1=array();
  echo "<p>";
  $header1=explode('/',$myspliter[1]);
   $headers=explode('/',$header1[1]);
  
 echo'<p><table border=1 class="table table-striped table-bordered" width="350px"><thead><tr>';
 
 foreach($header1 as $header ){
	$newheader=explode(':',$header);
	if (strpos(':',$header) == false) {
        $newheader=explode(':',$header);
		
		echo ("<td><b>$newheader[0]</b></td>");	
		
		$fielddata .= "`$newheader[0]`,";
	
	$fields=$newheader[0];
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	//$query = "CREATE TABLE IF NOT EXISTS `crmtest`($keys1)";
	
	
}
	else{
		
	 echo ("<td><b><$newheader[1]</b></td>");
	
	

	}
 }


echo "</tr></thead><tbody><tr>";
$splitcell1=array();
    for($i = 2; $i<count($myspliter);$i++){
	   $row =$myspliter[$i];
	  
	   
	  $cells =explode('"',$row);
	   
	  
	  $cellscrm =array_filter(explode('"',$row));
	  				
	 
	  foreach($cells as $key=>$value){
		  
  //$final=array_filter(array_map('trim', $value));
if($key % 2==0 ){
				 continue;
				 }
  
		echo "<td>$value</td>"; 
		 
	  }
	 	  		 
	  echo "</tr>"; 
	  
  }

	echo"</tbody></table>";
}



function Accountstatment($CUSTOMERID,$fdate1,$tdate1){
	global $t24serviceurl,$CUSTOMERID,$ip,$port,$t24username,$t24password,$enquiry,$response,$T23branchcode,$t24serviceurl1,$fdate1,$tdate1;
	
	//echo "This is account $CUSTOMERID $fdate1 %20 $tdate1 <br>"; STMT.ENT.BOOK.R16
//telnetconnect($ip,$port,$t24username,$t24password,$enquiry);2011000001 CRM.ACCOUNTSTAMENTS
//$response=file_get_contents("$t24serviceurl,STATEMENT3,ACCT.ID:EQ=$CUSTOMERID,BOOKING.DATE:RG=$fdate1%20$tdate1");
//$response=file_get_contents("$t24serviceurl,STMT.ENT.BOOK,ACCOUNT:EQ=$CUSTOMERID,BOOKING.DATE:RG=$fdate1%20$tdate1");

$response=file_get_contents("$t24serviceurl,STMT.ENT.BOOK.CRM3,ACCT.ID:EQ=$CUSTOMERID,BOOKING.DATE:RG=$fdate1%20$tdate1");

//$response=file_get_contents("$t24serviceurl,NEWSTATEMENTS,ACCT.ID:EQ=$CUSTOMERID,BOOKING.DATE:RG=$fdate1%20$tdate1");

//$response=file_get_contents("OFS_RESPONSE1.txt");
//echo $response;
$myspliter=explode(',',$response);
 global $logo,$valuedata,$crmd,$keys1,$CUSTOMERID;
 global $dbc,$CRMDATA,$value,$fielddata,$tablefields1;
  $counts=count($myspliter);
  //$values = array();
//$keys1=array();
$myspliter=array_map('trim',$myspliter);

//print_r($myspliter);

 //echo "$myspliter";
  $header1=explode('/',$myspliter[1]);
   $headers=explode('/',$header1[1]);
  
	foreach($header1 as $header ){
	$newheader=explode(':',$header);
	if (strpos(':',$header) == false) {
        $newheader=explode(':',$header);
		
		//echo ("<td><b>$newheader[0]</b></td>");	
		
		$fielddata .= "`$newheader[0]`,";
		//$fielddata .= str_replace('.','_',"`$newheader[0]`,");
	
	//$fields=$newheader[0];
	$fields=str_replace('.','_',$newheader[0]);
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	//$query = "CREATE TABLE IF NOT EXISTS `crmtest`($keys1)";
	
	
}
	else{
		
	// echo ("<td><b><$newheader[1]</b></td>");
	 $fielddata .= "`$newheader[1]`";
	 //$fielddata .= str_replace('.','_',"`$newheader[1]`,");
	 //$replace1=str_replace('_','.',$key);
	 //$fields=$newheader[0];
	$fields=str_replace('.','_',$newheader[0]);
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	

	}
 }
 //$tablefields = implode(',', $keys1);
//$query = "CREATE TABLE IF NOT EXISTS `t24customerstatement`($tablefields1`status` VARCHAR(225),`transactionmode` VARCHAR(225))";
//echo "<br>$query <br>";
//$result = mysqli_query($dbc,$query);
	

 echo'<p><table border="0.1" id="datatable-buttons1" class="table table-striped table-bordered"  width="100%" > <thead><tr>';
 
 
echo ("<td><b>Date of Transaction</td><td><b>Description</td><td><b>Value Date	
</td><td><b>Debit</td><td><b>Credit</td><td><b>Balance</td>");	
echo "</tr></thead><tbody>";

$splitcell1=array();
    for($i = 2; $i<count($myspliter);$i++){
	   $row =$myspliter[$i];
	  
	   
	  $cells =explode('"',$row);
	  
	  
	  //$cellscrm =array_filter(explode('"',$row));
	  
	  $source_array=array_filter(explode('"',$row));
	  //array_map('trim', $source_array);
	  $cellscrm =array_map('trim', $source_array);
	  if($cellscrm[3]==""){
		  continue;
	  }
	  
	  $newfieddata=str_replace('.','_',$fielddata);
	  
    foreach($cells as $key=>$value){
		  
  //$final=array_filter(array_map('trim', $value));
				if($key % 2==0){
				 continue;
				 }
				 
				 
				 $ref=explode('\\',$cellscrm[7]);
				 
				 //print_r($ref);
				 $refencenumber=$ref[0];
				 
				 //if($refencenumber='Balance Takeo')
					 
					// {
						// $refencenumber=$refencenumber.$cellscrm[3].$cellscrm[17].$CUSTOMERID;
						 
					 //}
				 //echo " this the value date $cellscrm[11]";
			 /* echo "<br>";
				print_r($cellscrm);
					echo "<br>";  */
  
  // $CRMDATA =mysqli_query($dbc,"INSERT INTO `t24customerstatement`(`accountnumber`,`POST`, `REFNO`, `NARRATIVE`, `VALDESC`, `DR_AMT`, `CR_AMOUNT`, `BALANCE`) VALUES('$CUSTOMERID','$cellscrm[1]','$cellscrm[3]','$cellscrm[5]','$cellscrm[7]','$cellscrm[9]','$cellscrm[11]','$cellscrm[13]') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online',`DR_AMT`='$cellscrm[9]', `CR_AMOUNT`='$cellscrm[11]',`BALANCE`='$cellscrm[13]'");
    
	  }
	 
  
  
  $closingbalance=number_format($cellscrm[13],2);
  $debitamount=number_format($cellscrm[9],2);
  
  $creditamount=number_format($cellscrm[11],2);
  
  
  
  //formating closing and opening balance
  if($cellscrm[1]=='Balance at Period Start'){
	  
  echo "<tr><td colspan='1'></td><td><b>$cellscrm[1]</b></td><td colspan='3'></td><td><b>". number_format($cellscrm[3],2)."</b></td></tr>";
  
  }elseif($cellscrm[1]=='Balance at Period End'){
	  
  echo "<tr><td colspan='1'></td><td><b>$cellscrm[1]</b></td><td colspan='1'></td><td><b>". number_format($cellscrm[3],2)."</b></td><td><b>". number_format($cellscrm[5],2)."</b></td><td><b>". number_format($cellscrm[13],2)."</b></td></tr>";
  
  }
  else{
	  
	  
	  if($closingbalance<0){// color all negative balance
		  
		  $closingbalance="<font color='red'>( $closingbalance )</font>";
	  }
	  
	  
	 echo "<tr><td>$cellscrm[1]</td><td>$cellscrm[5]</td><td>$cellscrm[7]</td><td style='text-align:right'> $creditamount</td><td style='text-align:right'>  $debitamount</td><td style='text-align:right'>$closingbalance</td></tr>"; 
  
  }//end of closing balance and starting balance formating
  
  
 

		  
  }

  
  //echo "<tr><td colspan='7'> <br></td></tr>";
  
  
  echo "
<tr> </tr>
<tr> </tr>
<tr>

<td colspan='3'><center> <b><i>Managers Name:<br>---------------</i></b></center></td>
<td> </td>
<td colspan='3'><center><b><i>Signature: <br>----------------</i></b> </center></td>

</tr>
		";
echo"</tbody></table>";

//echo($value);
}// end of account statement functions


function accountinfo($CUSTOMERID){
	global $t24serviceurl,$CUSTOMERID,$ip,$port,$t24username,$t24password,$enquiry,$response,$T23branchcode,$t24serviceurl1,$fdate1,$tdate1;
	
//$t24serviceurl='http://172.29.18.16:8080/TAFJServices/services/OFSService/Invoke?Request=ENQUIRY.SELECT,,CRMUSER/ADmin123,';
//$enquiry=",ACCOUNTSTATEMENT2,ACCT.ID:EQ=$CUSTOMERID,BOOKING.DATE:LT=!TODAY";
//echo"<br> $CUSTOMERID";

//telnetconnect($ip,$port,$t24username,$t24password,$enquiry);2011000001


$response=file_get_contents("$t24serviceurl,E.STMT1,ACCOUNT.NUMBER:EQ=$CUSTOMERID");




//echo $response;




//telnetconnect($enquiry);

//echo "<br>This is the test response <br> $response </br>";
	

	
$myspliter=explode(',',$response);
 global $logo,$valuedata,$crmd,$keys1,$CUSTOMERID;
 global $dbc,$CRMDATA,$value,$fielddata,$tablefields1;
  $counts=count($myspliter);
  //$values = array();
//$keys1=array();
$myspliter=array_map('trim',$myspliter);

//print_r($myspliter);

 //echo "$myspliter";
  $header1=explode('/',$myspliter[1]);
   $headers=explode('/',$header1[1]);
   //print_r($header1);
   //echo '<img src="data:image/jpeg;base64,'.base64_encode( $logo).'" height="200"/>'; 
    
	//echo'<p><table><thead><tr><td> <img src="data:image/jpeg;base64,'.base64_encode($logo).'" height="100"/></td></tr></thead></table>';
	
	foreach($header1 as $header ){
	$newheader=explode(':',$header);
	if (strpos(':',$header) == false) {
        $newheader=explode(':',$header);
		
		//echo ("<td><b>$newheader[0]</b></td>");	
		
		$fielddata .= "`$newheader[0]`,";
		//$fielddata .= str_replace('.','_',"`$newheader[0]`,");
	
	//$fields=$newheader[0];
	$fields=str_replace('.','_',$newheader[0]);
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	//$query = "CREATE TABLE IF NOT EXISTS `crmtest`($keys1)";
	
	
}
	else{
		
	// echo ("<td><b><$newheader[1]</b></td>");
	 $fielddata .= "`$newheader[1]`";
	 //$fielddata .= str_replace('.','_',"`$newheader[1]`,");
	 //$replace1=str_replace('_','.',$key);
	 //$fields=$newheader[0];
	$fields=str_replace('.','_',$newheader[0]);
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	

	}
 }

$splitcell1=array();
    for($i = 2; $i<count($myspliter);$i++){
	   $row =$myspliter[$i];
	  
	   
	  $cells =explode('"',$row);
	  
	  
	  //$cellscrm =array_filter(explode('"',$row));
	  
	  $source_array=array_filter(explode('"',$row));
	  //array_map('trim', $source_array);
	  $cellscrm =array_map('trim', $source_array);
	  if($cellscrm[3]==""){
		  continue;
	  }
	  
	  $newfieddata=str_replace('.','_',$fielddata);
	
    foreach($cells as $key=>$value){
		  
  //$final=array_filter(array_map('trim', $value));
				if($key % 2==0){
				 continue;
				 }
				 
				 
				 $ref=explode('\\',$cellscrm[7]);
				 
				 //print_r($ref);
				 $refencenumber=$ref[0];
				 
				 //if($refencenumber='Balance Takeo')
					 
					// {
						// $refencenumber=$refencenumber.$cellscrm[3].$cellscrm[17].$CUSTOMERID;
						 
					 //}
				 //echo " this the value date $cellscrm[11]";
				// echo "<br>";
				//print_r($cellscrm);
				$accountname = mysqli_real_escape_string($dbc, $cellscrm[5]);
  
   $CRMDATA =mysqli_query($dbc,"INSERT INTO `accountinfor`(`customernumber`,`accountnumber`, `accountname`, `currency`) VALUES('$cellscrm[3]','$cellscrm[1]','$accountname','$cellscrm[7]') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online',`accountname`='$accountname', `currency`='$cellscrm[7]' ");
   
   
//echo "INSERT INTO `accountinfor`(`customernumber`,`accountnumber`, `accountname`, `currency`) VALUES('$cellscrm[3]','$cellscrm[1]','$accountname','$cellscrm[7]') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online',`accountname`='$accountname', `currency`='$cellscrm[7]' ";
  
		//echo "<td>$value</td>"; 
		
		
		//$valuedata .= "'$value',";
		
		
			 
		 
		
		 
	  }
	 
  
  
	  
  }

//echo"</tbody></table>";


 



}// end of account statement functions


	
	
	function accountstatementsearch($CUSTOMERID,$fdate1,$tdate1,$fieldname){
	global $t24serviceurl,$CUSTOMERID,$ip,$port,$t24username,$t24password,$enquiry,$response,$T23branchcode,$t24serviceurl1,$fdate1,$tdate1,$fieldname;
	
//$t24serviceurl='http://172.29.18.16:8080/TAFJServices/services/OFSService/Invoke?Request=ENQUIRY.SELECT,,CRMUSER/ADmin123,';
//$enquiry=",ACCOUNTSTATEMENT2,ACCT.ID:EQ=$CUSTOMERID,BOOKING.DATE:LT=!TODAY";
//echo"<br> $CUSTOMERID";

//$response=file_get_contents("$t24serviceurl,CRM.ACCOUNTSTAMENTS,ACCOUNT:EQ=$CUSTOMERID,BOOKING.DATE:RG=$fdate1%20$tdate1");

//telnetconnect($ip,$port,$t24username,$t24password,$enquiry);
$response=file_get_contents("$t24serviceurl,ACCOUNTSTATEMENT2,ACCT.ID:EQ=$CUSTOMERID,BOOKING.DATE:RG=$fdate1%20$tdate1");
//telnetconnect($enquiry);

//echo "<br>This is the test response $response </br>";
	

	
$myspliter=explode(',',$response);
 global $logo,$valuedata,$crmd,$keys1,$CUSTOMERID,$fieldname;
 global $dbc,$CRMDATA,$value,$fielddata,$tablefields1;
  $counts=count($myspliter);
  //$values = array();
//$keys1=array();

//print_r($myspliter);

 //echo "$myspliter";
  $header1=explode('/',$myspliter[1]);
   $headers=explode('/',$header1[1]);
   //print_r($header1);
   //echo '<img src="data:image/jpeg;base64,'.base64_encode( $logo).'" height="200"/>'; 
    
	//echo'<p><table><thead><tr><td> <img src="data:image/jpeg;base64,'.base64_encode($logo).'" height="100"/></td></tr></thead></table>';
	
	foreach($header1 as $header ){
	$newheader=explode(':',$header);
	if (strpos(':',$header) == false) {
        $newheader=explode(':',$header);
		
		//echo ("<td><b>$newheader[0]</b></td>");	
		
		$fielddata .= "`$newheader[0]`,";
		//$fielddata .= str_replace('.','_',"`$newheader[0]`,");
	
	//$fields=$newheader[0];
	$fields=str_replace('.','_',$newheader[0]);
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	//$query = "CREATE TABLE IF NOT EXISTS `crmtest`($keys1)";
	
	
}
	else{
		
	// echo ("<td><b><$newheader[1]</b></td>");
	 $fielddata .= "`$newheader[1]`";
	 //$fielddata .= str_replace('.','_',"`$newheader[1]`,");
	 //$replace1=str_replace('_','.',$key);
	 //$fields=$newheader[0];
	$fields=str_replace('.','_',$newheader[0]);
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	

	}
 }
 //$tablefields = implode(',', $keys1);
$query = "CREATE TABLE IF NOT EXISTS `t24customerstatement`($tablefields1`status` VARCHAR(225),`transactionmode` VARCHAR(225))";
//echo "<br>$query <br>";
$result = mysqli_query($dbc,$query);
	
	
	//echo "<td>Total Deposit</td><td></td><td></td><td>Total Credit
//</td><td>Debit Amount</td><td>Credit Amount</td><td>Closing Balance</td> </tr> <tr>";	
	
//echo'<p><table border=1 id="datatable-buttons1" class="table table-striped table-bordered"><thead><tr>';
 
 //echo'<p><table id="example" class="display table-striped table-bordered" cellspacing="0"><thead><tr>';
 
 
		
//echo ("<td><b>Booking Date</td><td><b>Reference</td><td><b>Description</td><td><b>Value Date	
//</td><td><b>Debit Amount</td><td><b>Credit Amount</td><td><b>Closing Balance</td>");	
		
		
	 

 

//echo "</tr></thead><tbody><tr>";
$splitcell1=array();
    for($i = 2; $i<count($myspliter);$i++){
	   $row =$myspliter[$i];
	  
	   
	  $cells =explode('"',$row);
	  
	  
	  //$cellscrm =array_filter(explode('"',$row));
	  
	  $source_array=array_filter(explode('"',$row));
	  //array_map('trim', $source_array);
	  $cellscrm =array_map('trim', $source_array);
	  if($cellscrm[3]==""){
		  continue;
	  }
	  
	  $newfieddata=str_replace('.','_',$fielddata);
	  
	 //$CRMDATA =mysqli_query($dbc,"insert into `heritageaccountviewtable`(`OPENING_DATE`, `ID`, `CUSTOMER`, `ACCOUNT_TITLE_1`, `CATEGORY`, `CURRENCY`, `INITDEP`, `TEL`, `ACCOUNT_OFFICER`, `OTH_OFF`, `INPUTTER`, `TARG`, `TAG1`, `STREET`, `TOWN_COUNTRY`, `SECTOR`, `INDUSTRY`, `IND_DESC`, `EMAIL_1`, `ONLINE_ACTUAL_BAL`, `OPEN_ACTUAL_BAL`, `WORKING_BALANCE`, `RECORD_STATUS`) VALUES('$cellscrm[1]','$cellscrm[3]','$cellscrm[5]','$cellscrm[7]','$cellscrm[9]','$cellscrm[11]','$cellscrm[13]','$cellscrm[15]','$cellscrm[17]','$cellscrm[19]','$cellscrm[21]','$cellscrm[23]','$cellscrm[25]','$cellscrm[27]','$cellscrm[29]','$cellscrm[31]','$cellscrm[33]','$cellscrm[35]','$cellscrm[37]','$cellscrm[39]','$cellscrm[41]','$cellscrm[43]','$cellscrm[45]') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online',`ONLINE_ACTUAL_BAL`='$cellscrm[39]',`WORKING_BALANCE`='$cellscrm[43]',`RECORD_STATUS`='$cellscrm[45]',`OPEN_ACTUAL_BAL`='$cellscrm[41]'");
  
  
    foreach($cells as $key=>$value){
		  
  //$final=array_filter(array_map('trim', $value));
				if($key % 2==0){
				 continue;
				 }
				 
				 
				 $ref=explode('\\',$cellscrm[7]);
				 
				 //print_r($ref);
				 $refencenumber=$ref[0];
				 
				 //if($refencenumber='Balance Takeo')
					 
					// {
						// $refencenumber=$refencenumber.$cellscrm[3].$cellscrm[17].$CUSTOMERID;
						 
					 //}
				 //echo " this the value date $cellscrm[11]";
				 
				 //print_r($cellscrm);
  
   $CRMDATA =mysqli_query($dbc,"INSERT INTO `t24customerstatement`(`accountnumber`,`POST`, `REFNO`, `NARRATIVE`, `VALDESC`, `DR_AMT`, `CR_AMOUNT`, `BALANCE`) VALUES('$CUSTOMERID','$cellscrm[3]','$refencenumber','$cellscrm[5]','$cellscrm[11]','$cellscrm[13]','$cellscrm[15]','$cellscrm[17]') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online',`DR_AMT`='$cellscrm[13]', `CR_AMOUNT`='$cellscrm[15]',`BALANCE`='$cellscrm[17]'");
   
   
 //echo "INSERT INTO `t24customerstatement`(`accountnumber`,`POST`, `REFNO`, `NARRATIVE`, `VALDESC`, `DR_AMT`, `CR_AMOUNT`, `BALANCE`) VALUES('$CUSTOMERID','$cellscrm[3]','$refencenumber','$cellscrm[5]','$cellscrm[11]','$cellscrm[13]','$cellscrm[15]','$cellscrm[17]') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online' <br>";
  
		//echo "<td>$value</td>"; 
		
		
		//$valuedata .= "'$value',";
		
		
			 
		 
		
		 
	  }
	 
  
  
  $closingbalance=number_format($cellscrm[13],2);
  $debitamount=number_format($cellscrm[11],2);
  
  $creditamount=number_format($cellscrm[9],2);
  
  
  
  //echo "<td>$cellscrm[1]</td><td>$cellscrm[3]</td><td>$cellscrm[5]</td><td>$cellscrm[7]</td><td style='text-align:right'> $creditamount</td><td style='text-align:right'> $debitamount</td><td style='text-align:right'>$closingbalance</td>"; 
  
  
	  
	  		 
	// echo "</tr>"; 
	  
	  

	  
  }

//echo"</tbody></table>";


 


//echo($value);
}// end of account statement functions

	
function get_branch($branch_id, $dbc){
	$q = "select COMPANY_NAME from heritagecompany where `@ID` = '$branch_id'";
	$res = mysqli_query($dbc, $q);
	$branch_data = mysqli_fetch_array($res); 
	return $branch_data['COMPANY_NAME'];
}

function get_user_name($user_id, $dbc){
	$q = "select name,username from users where `user_id` = '$user_id'";
	$res = mysqli_query($dbc, $q);
	$user_data = mysqli_fetch_array($res); 
	return $user_data['name'];
}

function get_service_category($id, $dbc){
	$q = "select Category_Type from heritagecattypetable where `@ID` = '$id'";
	$res = mysqli_query($dbc, $q);
	$cat_data = mysqli_fetch_array($res); 
	return $cat_data['Category_Type'];
}
	
	
	function agentCategoryID($agentCategoryID, $dbc){
		global $agentCategoryID,$dbc;
	$q = "select * from `superagency_agentcategory` where `ID`='$agentCategoryID'";
	$res = mysqli_query($dbc, $q);
	$cat_data = mysqli_fetch_array($res); 
	return  $cat_data['name'];
}
	

function createinsert_enquiry($id,$dbc,$enquiryname,$fieldname,$tablename){
global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname,$branchcodeid;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$dbc;
//$id="1002100709";

//echo "<br>$t24serviceurl,$enquiryname,$fieldname:EQ=$id <br>";
//$response=file_get_contents("OFS_RESPONSE1.txt");
//$response=file_get_contents("$t24serviceurl,AMFB.ACCOUNT.LIST,@ID:EQ=$id");
//echo "<br>create customer $t24serviceurl/$branchcodeid,$enquiryname,$fieldname:EQ=$id <br>";
$response=file_get_contents("$t24serviceurl/$branchcodeid,$enquiryname,$fieldname:EQ=$id");
	
$myspliter=explode(',"',$response);


//var_dump($myspliter);

 global $logo,$valuedata,$crmd,$keys1;
 //global $dbc,$CRMDATA,$value,$fielddata,$tablefields1,$tablefieldsforinsert;
  $counts=count($myspliter);
  $myspliter1=explode(',',$myspliter[0]);
  

  $allfieldsarray=array();
$exceptions=array();
$allfieldsarraynew=array();
  
  $header1=explode('/',$myspliter1[1]);
   $headers=explode('/',$header1[0]);
 
 
 foreach($header1 as $header ){
	$newheader=explode(':',$header);
	if (strpos(':',$header) == false) {
        $newheader=explode(':',$header);
		//print_r($newheader);
		
		
		$fielddata .= "`$newheader[0]`,";
		//$fielddata .= str_replace('.','_',"`$newheader[0]`,");
	
	//$fields=$newheader[0];
	$fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	//$query = "CREATE TABLE IF NOT EXISTS `crmtest`($keys1)";
	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	$allfields.="$fields,";
	$alterkeys[]="ADD COLUMN `$fields` VARCHAR(225)";
	
	$allfieldsarraynew[]=$fields;
	
}
	else{
		
	 echo ("<td><b><$newheader[1]-></b></td>");
	 $fielddata .= "`$newheader[1]`";
	 
	 
	 
	 //$fielddata .= str_replace('.','_',"`$newheader[1]`,");
	 //$replace1=str_replace('_','.',$key);
	 //$fields=$newheader[0];
	 $fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
	
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1.=$keys1;
	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	$allfields.="$fields,";
	$alterkeys[]="ADD COLUMN `$fields` VARCHAR(225)";
	$allfieldsarraynew[]=$fields;
	
	}
 }
 //$tablefields = implode(',', $keys1);
 //DROP TABLE `25ld_loans_and_deposits_enquiry`"
 
 if($fields=''){
		ECHO "Can not create Table";
	}else{
		

$query = "CREATE TABLE IF NOT EXISTS `$tablename`($tablefields1`status` VARCHAR(225),`transactionmode` VARCHAR(225))";
$result = mysqli_query($dbc,$query);

$q = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD PRIMARY KEY (`@ID`)");

$q1 = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD COLUMN `ids` INT AUTO_INCREMENT UNIQUE FIRST");

	}
 
$allfieldsarray=array($allfields);

$collumnselect=mysqli_query($dbc,"SHOW COLUMNS from `$tablename`");
while($collumnselectdata = mysqli_fetch_array($collumnselect)){
							
							$exceptioncolumns1 = $collumnselectdata['Field'];
							$exceptioncolumns.="$exceptioncolumns1,";
							
						$exceptions[]=$exceptioncolumns1;
							//echo "<br> $exceptioncolumns <br>";
							 }

							 //echo "<br> $exceptioncolumns <br>";

$arrarydiff=array_diff($allfieldsarraynew,$exceptions);
//print_r($arrarydiff);
	foreach($arrarydiff as $diffkey=>$diffvalue){
		
		//echo "<br> $diffvalue";
		//$diffvalue[]="";
		$alterkeys1[]="ADD COLUMN `$diffvalue` TEXT";
		
	}
	
	$diffvalue=implode(',',$alterkeys1);
	
	$alters = mysqli_query($dbc,"ALTER TABLE `$tablename` $diffvalue");
	 
 
//echo "<br>ALTER TABLE `$tablename` $diffvalue<br>";
 
 
 
	
//end of creating table part of the function


for($i =1; $i<count($myspliter);$i++){
	   $row =$myspliter[$i];
	  
	   //echo "$row <br>";
	
	  $cells =explode('"',$row);
	  
	  //echo $cells[3];
	 // echo "<br>";
	 // print_r($cells);
		  
	  $values = array();

	  foreach($cells as $key=>$value){
		  
 
				if($key % 2!=0){
				 continue;
				 }
				 $value=trim($value);
				 $value=str_replace("'",'',$value);
				   $values[] = "'$value'"; 
			
  		 
	  }
	  
	  $query_values = implode(',',$values);
	 $tablefieldsforinsert=rtrim($tablefieldsforinsert,',');
	  //echo "<br>$tablefieldsforinsert<br>";
//echo "INSERT INTO `$tablename`($tablefieldsforinsert) VALUES($query_values) ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online' <br>";
$CRMDATA =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online'");
	
$CRMDATA1 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'','') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online'");

$CRMDATA2 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert) VALUES($query_values) ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online'");
	
$CRMDATA3 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert,`status`) VALUES($query_values) ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online'");
		
		  
  }//end of for loop
 


}// end function
		

function createinsert_search_enquiry($id,$dbc,$enquiryname,$fieldname,$tablename){
global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname,$branchcodeid;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$dbc;
//echo "<br>$t24serviceurl/$branchcodeid,$enquiryname,$fieldname:EQ=$id <br>";
$response=file_get_contents("$t24serviceurl/$branchcodeid,$enquiryname,$fieldname:EQ=$id");
	
$myspliter=explode(',"',$response);


//var_dump($myspliter);
global $logo,$valuedata,$crmd,$keys1;
 //global $dbc,$CRMDATA,$value,$fielddata,$tablefields1,$tablefieldsforinsert;
  $counts=count($myspliter);
  $myspliter1=explode(',',$myspliter[0]);
  

  $allfieldsarray=array();
$exceptions=array();
$allfieldsarraynew=array();
  
  $header1=explode('/',$myspliter1[1]);
   $headers=explode('/',$header1[0]);
 
 
 foreach($header1 as $header ){
	$newheader=explode(':',$header);
	if (strpos(':',$header) == false) {
        $newheader=explode(':',$header);
		//print_r($newheader);
		
		
		$fielddata .= "`$newheader[0]`,";
		//$fielddata .= str_replace('.','_',"`$newheader[0]`,");
	
	//$fields=$newheader[0];
	$fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	//$query = "CREATE TABLE IF NOT EXISTS `crmtest`($keys1)";
	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	$allfields.="$fields,";
	$alterkeys[]="ADD COLUMN `$fields` VARCHAR(225)";
	
	$allfieldsarraynew[]=$fields;
	
}
	else{
		
	 echo ("<td><b><$newheader[1]-></b></td>");
	 $fielddata .= "`$newheader[1]`";
	 
	 
	 
	 //$fielddata .= str_replace('.','_',"`$newheader[1]`,");
	 //$replace1=str_replace('_','.',$key);
	 //$fields=$newheader[0];
	 $fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
	
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1.=$keys1;
	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	$allfields.="$fields,";
	$alterkeys[]="ADD COLUMN `$fields` VARCHAR(225)";
	$allfieldsarraynew[]=$fields;
	
	}
 }
 //$tablefields = implode(',', $keys1);
 //DROP TABLE `25ld_loans_and_deposits_enquiry`"
 
 if($fields=''){
		ECHO "Can not create Table";
	}else{
		

$query = "CREATE TABLE IF NOT EXISTS `$tablename`($tablefields1`status` VARCHAR(225),`transactionmode` VARCHAR(225))";
$result = mysqli_query($dbc,$query);

$q = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD PRIMARY KEY (`@ID`)");

$q1 = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD COLUMN `ids` INT AUTO_INCREMENT UNIQUE FIRST");

	}
 
$allfieldsarray=array($allfields);

$collumnselect=mysqli_query($dbc,"SHOW COLUMNS from `$tablename`");
while($collumnselectdata = mysqli_fetch_array($collumnselect)){
							
							$exceptioncolumns1 = $collumnselectdata['Field'];
							$exceptioncolumns.="$exceptioncolumns1,";
							
						$exceptions[]=$exceptioncolumns1;
							//echo "<br> $exceptioncolumns <br>";
							 }

							 //echo "<br> $exceptioncolumns <br>";

$arrarydiff=array_diff($allfieldsarraynew,$exceptions);
//print_r($arrarydiff);
	foreach($arrarydiff as $diffkey=>$diffvalue){
		
		//echo "<br> $diffvalue";
		//$diffvalue[]="";
		$alterkeys1[]="ADD COLUMN `$diffvalue` TEXT";
		
	}
	
	$diffvalue=implode(',',$alterkeys1);
	
	$alters = mysqli_query($dbc,"ALTER TABLE `$tablename` $diffvalue");
	 
 
//echo "<br>ALTER TABLE `$tablename` $diffvalue<br>";
	
 echo'<p><table border=1 id="datatable-buttons" class="table table-striped table-bordered" width="100%"><thead><tr>';
 	
echo ("<td>Account Number</td><td>Customer Number</td><td>Name</td><td>Account Balance</td><td>Mobile Number	
</td><td>View</td>");	

echo "</tr></thead><tbody><tr>";	
//end of creating table part of the function

//print_r($myspliter);



for($i = 1; $i<count($myspliter);$i++){
	   $row =$myspliter[$i];
	  
	   //echo "$row <br>";
	
	  $cells =explode('"',$row);
	  
	  //echo $cells[3];
	  
	   /* echo "<br>";
	 print_r($cells);
		echo "<br>";  */ 
	  $values = array();

	  foreach($cells as $key=>$value){
		  if($key % 2!=0){
				 continue;
				 }
				 $value=trim($value);
				   $values[] = "'$value'"; 
			
  		 
	  }
	  $idcustomer=trim($cells[4]);
	 
	  
	  //if(in_array("No records were found that matched the selection criteria", $myspliter)){
if($idcustomer==''){
echo "<b>No records were found that matched the selection criteria</b><br>";

//unset($cells);
	  }else{
echo "<td>$cells[2]</td><td>$cells[4]</td><td>$cells[6]</td><td>$cells[44]</td><td>$cells[14]</td><td><a href='autodetails_customer.php?id=$idcustomer' ><button type=button class='btn btn-info btn-sm'>360 View</button></a></td>"; 
  
echo "</tr>"; 		  
		  
	  }
	 
$query_values = implode(',',$values);
	  
	//echo "INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online'"; 
	 
$CRMDATA =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online'");
	
$CRMDATA1 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'','') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online'");

$CRMDATA2 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert) VALUES($query_values) ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online'");
	
$CRMDATA3 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert,`status`) VALUES($query_values) ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online'");
		
		  
  }//end of for loop
 
 
echo"</tbody></table>";
}// end function


function createinsert_search_customer($id,$dbc,$enquiryname,$fieldname,$tablename,$operator){
global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname,$branchcodeid;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$operator,$dbc;
//echo "<br> $t24serviceurl/$branchcodeid,$enquiryname,$fieldname:$operator=$id <br>";
$response=file_get_contents("$t24serviceurl/$branchcodeid,$enquiryname,$fieldname:$operator=$id");
	
$myspliter=explode(',"',$response);


global $logo,$valuedata,$crmd,$keys1;
 //global $dbc,$CRMDATA,$value,$fielddata,$tablefields1,$tablefieldsforinsert;
  $counts=count($myspliter);
  $myspliter1=explode(',',$myspliter[0]);
  

  $allfieldsarray=array();
$exceptions=array();
$allfieldsarraynew=array();
  
  $header1=explode('/',$myspliter1[1]);
   $headers=explode('/',$header1[0]);
 
 
 foreach($header1 as $header ){
	$newheader=explode(':',$header);
	if (strpos(':',$header) == false) {
        $newheader=explode(':',$header);
		//print_r($newheader);
		
		
		$fielddata .= "`$newheader[0]`,";
		//$fielddata .= str_replace('.','_',"`$newheader[0]`,");
	
	//$fields=$newheader[0];
	$fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	//$query = "CREATE TABLE IF NOT EXISTS `crmtest`($keys1)";
	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	$allfields.="$fields,";
	$alterkeys[]="ADD COLUMN `$fields` VARCHAR(225)";
	
	$allfieldsarraynew[]=$fields;
	
}
	else{
		
	 echo ("<td><b><$newheader[1]-></b></td>");
	 $fielddata .= "`$newheader[1]`";
	 
	 
	 
	 //$fielddata .= str_replace('.','_',"`$newheader[1]`,");
	 //$replace1=str_replace('_','.',$key);
	 //$fields=$newheader[0];
	 $fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
	
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1.=$keys1;
	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	$allfields.="$fields,";
	$alterkeys[]="ADD COLUMN `$fields` VARCHAR(225)";
	$allfieldsarraynew[]=$fields;
	
	}
 }
 //$tablefields = implode(',', $keys1);
 //DROP TABLE `25ld_loans_and_deposits_enquiry`"
 
 if($fields=''){
		ECHO "Can not create Table";
	}else{
		

$query = "CREATE TABLE IF NOT EXISTS `$tablename`($tablefields1`status` VARCHAR(225),`transactionmode` VARCHAR(225))";
$result = mysqli_query($dbc,$query);

$q = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD PRIMARY KEY (`@ID`)");

$q1 = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD COLUMN `ids` INT AUTO_INCREMENT UNIQUE FIRST");

	}
 
$allfieldsarray=array($allfields);

$collumnselect=mysqli_query($dbc,"SHOW COLUMNS from `$tablename`");
while($collumnselectdata = mysqli_fetch_array($collumnselect)){
							
							$exceptioncolumns1 = $collumnselectdata['Field'];
							$exceptioncolumns.="$exceptioncolumns1,";
							
						$exceptions[]=$exceptioncolumns1;
							//echo "<br> $exceptioncolumns <br>";
							 }

							 //echo "<br> $exceptioncolumns <br>";

$arrarydiff=array_diff($allfieldsarraynew,$exceptions);
//print_r($arrarydiff);
	foreach($arrarydiff as $diffkey=>$diffvalue){
		
		//echo "<br> $diffvalue";
		//$diffvalue[]="";
		$alterkeys1[]="ADD COLUMN `$diffvalue` TEXT";
		
	}
	
	$diffvalue=implode(',',$alterkeys1);
	
	$alters = mysqli_query($dbc,"ALTER TABLE `$tablename` $diffvalue");
	 
 
//echo "<br>ALTER TABLE `$tablename` $diffvalue<br>";
 
 
 
	
//end of creating table part of the function

 echo'<p><table border=1 id="datatable-buttons" class="table table-striped table-bordered" width="100%"><thead><tr>';
 	
echo ("<td>Customer Number</td><td>Customer Name</td><td>Phone Number</td><td>Email</td><td>Account Officer</td><td>Branch	
</td><td>View</td>");	

echo "</tr></thead><tbody><tr>";	
//end of creating table part of the function

//print_r($myspliter);



for($i = 1; $i<count($myspliter);$i++){
	   $row =$myspliter[$i];
	  
	   //echo "$row <br>";
	
	  $cells =explode('"',$row);
	  
	  //echo $cells[3];
	  
 	  /* echo "<br>";
	 print_r($cells);
		echo "<br>";    */
	  $values = array();

	  foreach($cells as $key=>$value){
		  if($key % 2!=0){
				 continue;
				 }
				 $value=trim($value);
				   $values[] = "'$value'"; 
			
  		 
	  }
	  $idcustomer=trim($cells[0]);
	 
	  
	  //if(in_array("No records were found that matched the selection criteria", $myspliter)){
if($idcustomer==''){
echo "<b>No records were found that matched the selection criteria</b><br>";

//unset($cells);
	  }else{
echo "<td>$cells[0]</td><td>$cells[6]</td><td>$cells[60]</td><td>$cells[62]</td><td>$cells[8]</td><td>$cells[38]</td><td><a href='autodetails_customer.php?id=$idcustomer' ><button type=button class='btn btn-info btn-sm'>360 View</button></a></td>"; 
  
echo "</tr>"; 		  
		  
	  }
	 
$query_values = implode(',',$values);
	  
	 	  
$CRMDATA =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online'");
	
$CRMDATA1 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'','') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online'");

$CRMDATA2 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert) VALUES($query_values) ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online'");
	
$CRMDATA3 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert,`status`) VALUES($query_values) ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online'");
			 
		  
  }//end of for loop
 
 
echo"</tbody></table>";
}// end function

function createinsert_account_360($id,$dbc,$enquiryname,$fieldname,$tablename){
global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$dbc;

$response=file_get_contents("$t24serviceurl,$enquiryname,$fieldname:EQ=$id");
	
$myspliter=explode(',"',$response);

 /* echo "<br>";
var_dump($myspliter);
echo "<br>"; */ 
 global $logo,$valuedata,$crmd,$keys1;
 //global $dbc,$CRMDATA,$value,$fielddata,$tablefields1,$tablefieldsforinsert;
  $counts=count($myspliter);
  $myspliter1=explode(',',$myspliter[0]);
  
  //array_unique
  /* echo "<br>";
  print_r($myspliter1);
  echo "<br>"; */
  
  $header1=explode('/',$myspliter1[1]);
   $headers=explode('/',$header1[0]);
 
 foreach($header1 as $header ){
	$newheader=explode(':',$header);
	if (strpos(':',$header) == false) {
        $newheader=explode(':',$header);
		/*  echo "<br>";
		print_r($newheader);	
 echo "<br>"; */		
$fielddata .= "`$newheader[0]`,";
		//$fielddata .= str_replace('.','_',"`$newheader[0]`,");
	
	//$fields=$newheader[0];
	$fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
    $keys1="`$fields` TEXT(225),";
	$tablefields1 .=$keys1;
	//$query = "CREATE TABLE IF NOT EXISTS `crmtest`($keys1)";
	
	
	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	
}
	else{
		
	 echo ("<td><b><$newheader[1]-></b></td>");
	 $fielddata .= "`$newheader[1]`";
	 
	 
	 
	 //$fielddata .= str_replace('.','_',"`$newheader[1]`,");
	 //$replace1=str_replace('_','.',$key);
	 //$fields=$newheader[0];
	 
	 $fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
	
    $keys1="`$fields` TEXT(225),";
	$tablefields1 .=$keys1;
	

	$keysforinsert="`$fields`,";
	$tablefieldsforinsert.=$keysforinsert;
	
	
	}
 }
 //$tablefields = implode(',', $keys1);
 //DROP TABLE `25ld_loans_and_deposits_enquiry`"
 
 if($fields=''){
		ECHO "Can not create Table";
	}else{
		




//echo "<br>CREATE TABLE IF NOT EXISTS `$tablename`($tablefields1`status` VARCHAR(225),`transactionmode` VARCHAR(225)) <br>";
	
		
$query = "CREATE TABLE IF NOT EXISTS `$tablename`($tablefields1`status` VARCHAR(225),`transactionmode` VARCHAR(225))";
$result = mysqli_query($dbc,$query);

$q = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD PRIMARY KEY (`@ID`)");

$q1 = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD COLUMN `ids` INT AUTO_INCREMENT UNIQUE FIRST");

	}
	
 echo'<p><table border=1 id="datatable-buttons" class="table table-striped table-bordered" width="100%"><thead><tr>';
 	
echo ("<td>Account Number</td><td>Customer Number</td><td>Name</td><td>Mobile</td><td>Account Balance</td><td>View</td>");	

echo "</tr></thead><tbody><tr>";	
//end of creating table part of the function

//print_r($myspliter);



for($i = 1; $i<count($myspliter);$i++){
	   $row =$myspliter[$i];
	  
	   //echo "$row <br>";
	
	  $cells =explode('"',$row);
	  
	  //echo $cells[3];
	  
	  /* echo "<br>";
	 print_r($cells);
		echo "<br>";  */ 
	  $values = array();

	  foreach($cells as $key=>$value){
		  if($key % 2!=0){
				 continue;
				 }
				 $value=trim($value);
				   $values[] = "'$value'"; 
			
  		 
	  }
	  $idcustomer=trim($cells[2]);
	 
	  
	  //if(in_array("No records were found that matched the selection criteria", $myspliter)){
if($idcustomer==''){
echo "<b>No records were found that matched the selection criteria</b><br>";

//unset($cells);
	  }else{
echo "<td>$cells[2]</td><td>$cells[4]</td><td>$cells[6]</td><td>$cells[14]</td><td>$cells[42]</td><td><a href='statementofaccount_acciom.php?id=$idcustomer' ><button type=button class='btn btn-info btn-sm'>Statement</button></a></td>"; 
  
echo "</tr>"; 		  
		  
	  }
	 
$query_values = implode(',',$values);
	  
	
//echo "<br>INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online' <br>";
	
$CRMDATA =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online'");
	
$CRMDATA1 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'','') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online'");
			 
		  
  }//end of for loop
 
 
echo"</tbody></table>";
}// end function


function sendsmsmessageooold($message,$receipient_number){
global $message,$receipient_number,$dbc,$response1;
//SELECT `id`, `smsurl`, `smsusername`, `smspassword`, `sendername`, `smsmessage`, `status` FROM `smssetupdetails` WHERE 1

$complaintsquiery=mysqli_query($dbc,"select * from smssetupdetails where status='Active'");

$complaintsquierydata=mysqli_fetch_array($complaintsquiery);
$smsurl = $complaintsquierydata['smsurl'];
$smsusername = $complaintsquierydata['smsusername'];
$smspassword = $complaintsquierydata['smspassword'];	
$message=strip_tags($message);

	
$ENCODEDMESSAGE=urlencode($message);

$api ="$smsurl?username=$smsusername&password=$smspassword&to=$receipient_number&text=$ENCODEDMESSAGE";
	
$response1=file_get_contents($api);	


}




function sendsmsmessage($message,$receipient_number){
global $message,$receipient_number,$dbc,$response1;
//SELECT `id`, `smsurl`, `smsusername`, `smspassword`, `sendername`, `smsmessage`, `status` FROM `smssetupdetails` WHERE 1

$complaintsquiery=mysqli_query($dbc,"select * from smssetupdetails where status='Active'");

$complaintsquierydata=mysqli_fetch_array($complaintsquiery);
$smsurl = $complaintsquierydata['smsurl'];
$smsusername = $complaintsquierydata['smsusername'];
$smspassword = $complaintsquierydata['smspassword'];
$sendername=$complaintsquierydata['sendername'];	
$message=strip_tags($message);

	
$ENCODEDMESSAGE=urlencode($message);

//$api ="$smsurl?username=$smsusername&password=$smspassword&destination=$receipient_number&source=brainbox&type=1&dlr=1&message=$ENCODEDMESSAGE";

$api="$smsurl?username=$smsusername&password=$smspassword&destination=$receipient_number&source=$sendername&type=1&dlr=1&message=$ENCODEDMESSAGE";

//echo $api="https://sms.arkesel.com/sms/api?action=send-sms&api_key=OjY5VlpIOXNlTjRDejg4NHY=&to=$receipient_number&from=MembersApp&sms=$ENCODEDMESSAGE";
	
$response1=file_get_contents($api);	



}



//get mobile numbers fo customers
function getmobilenumbers($uniqueidentifier){
global $dbc,$uniqueidentifier;
$searchtable = mysqli_query($dbc,"SELECT * FROM groupfilters where `identifier`='$uniqueidentifier'");

$searchtabledata = mysqli_fetch_array($searchtable);
	
$grouptablename=$searchtabledata['grouptablename'];
$group_name=$searchtabledata['group_name'];
$altfieldnames=$searchtabledata['altfieldnames'];
$datavalues=$searchtabledata['datavalues'];
$Operator=$searchtabledata['Operator'];
$fieldnames=$searchtabledata['fieldnames'];

	$splitfields=explode(',',$fieldnames);
	//$splitfields=explode(',',$group_name);
			
	$splitOperator=explode(',',$Operator);
	$splitaltfieldnames=explode(',',$altfieldnames);
	$splitdatavalues=explode(',',$datavalues);
			
	//print_r($splitfields);		
			//echo "$splitlebels <br>";
			
			$nearraysfieldsandvalues=array_combine($splitfields,$splitdatavalues);
			$nearrays2=array_combine($splitfields,$splitdatavalues);
			
foreach($nearraysfieldsandvalues as $tabid=>$tablabel){

foreach($splitOperator as $key=>$values){
			
				$sqlstring.="`$tabid` $values '$tablabel' OR ";
				}
				
				
			}


			
$conditions=substr($sqlstring, 0, -3);
	
	//echo "SELECT * FROM `$grouptablename` where $conditions <br>";

	
$sth = mysqli_query($dbc,"SELECT `TEL`,`ACCOUNT_TITLE_1` FROM `$grouptablename` where $conditions ");
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
	$mobilenumber=$r['TEL'];
	$tel.="$mobilenumber,";
}
//echo json_encode($rows);

//print_r($rows);
	
	return "$tel";
		
}		
		

		
function createinsert_all_enquiry($id,$dbc,$enquiryname,$fieldname,$tablename,$operator,$branchcodeid){
global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$dbc,$branchcodeid;
//$id="1002100709";

//echo "$t24serviceurl,$enquiryname,$fieldname:EQ=$id <br>";
//$response=file_get_contents("OFS_RESPONSE1.txt");
//$response=file_get_contents("$t24serviceurl,AMFB.ACCOUNT.LIST,@ID:EQ=$id");
echo "$t24serviceurl/$branchcodeid,$enquiryname,$fieldname:$operator=$id <br>";
$response=file_get_contents("$t24serviceurl/$branchcodeid,$enquiryname,$fieldname:$operator=$id");
	
$myspliter=explode(',"',$response);


var_dump($myspliter);

 global $logo,$valuedata,$crmd,$keys1;
 //global $dbc,$CRMDATA,$value,$fielddata,$tablefields1,$tablefieldsforinsert;
  $counts=count($myspliter);
  $myspliter1=explode(',',$myspliter[0]);
  

  
  
  $header1=explode('/',$myspliter1[1]);
   $headers=explode('/',$header1[0]);
 
 
 foreach($header1 as $header ){
	$newheader=explode(':',$header);
	if (strpos(':',$header) == false) {
        $newheader=explode(':',$header);
		//print_r($newheader);
		
		
		$fielddata .= "`$newheader[0]`,";
		//$fielddata .= str_replace('.','_',"`$newheader[0]`,");
	
	//$fields=$newheader[0];
	$fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	//$query = "CREATE TABLE IF NOT EXISTS `crmtest`($keys1)";
	
	
	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	
}
	else{
		
	 //echo ("<td><b><$newheader[1]-></b></td>");
	 $fielddata .= "`$newheader[1]`";
	 
	 
	 
	 //$fielddata .= str_replace('.','_',"`$newheader[1]`,");
	 //$replace1=str_replace('_','.',$key);
	 //$fields=$newheader[0];
	 $fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
	
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	

	$keysforinsert="`$fields`,";
	//for inserting fields
	$tablefieldsforinsert .=$keysforinsert;
	
	
	}
 }
 //$tablefields = implode(',', $keys1);
 //DROP TABLE `25ld_loans_and_deposits_enquiry`"
 
 if($fields=''){
		ECHO "Can not create Table";
	}else{
$query = "CREATE TABLE IF NOT EXISTS `$tablename`($tablefields1`status` VARCHAR(225),`transactionmode` VARCHAR(225))";
$result = mysqli_query($dbc,$query);

$q = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD PRIMARY KEY (`@ID`)");

$q1 = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD COLUMN `ids` INT AUTO_INCREMENT UNIQUE FIRST");
$q2 = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD COLUMN `$fieldname` VARCHAR(225)");

//"ALTER TABLE `%25ACCOUNT` ADD UNIQUE(`@ID`);"
	}
 

	
//end of creating table part of the function


for($i = 1; $i<count($myspliter);$i++){
	   $row =$myspliter[$i];
	  
	  // echo "$row <br>";
	
	  $cells =explode('"',$row);
	  
	  //echo $cells[3];
	  /* echo "<br>";
	 print_r($cells);
	echo "<br>"; */	  
	  $values = array();

	  foreach($cells as $key=>$value){
		  
 
				if($key % 2!=0){
				 continue;
				 }
				 
		if (strpos($value,',') !== false) 
 {
	 //echo trim($value);
   $value=trim(str_replace(',','',$value));
 }else{
$value=trim($value);
 }	 
				 
				 //echo $value=trim(str_replace(',','',$value));
				 
				   $values[] ="'$value'"; 
			
  		 
	  }
	  
	  
	  
	  GLOBAL $CUSTOMERIDNEW,$Bankcode,$ACCOUNT_NUMBER;
	  $CUSTOMERIDNEW=trim($cells[0]);
	  
	  $ACCOUNT_NUMBER=trim($cells[4]);
	    
		  $Bankcode=trim($cells[14]);
		    //$Bankcode='NG0010001';
	 $query_values = implode(',',$values);
	  
	  $newfieldarray=explode(',',$tablefieldsforinsert);
	  $newfieldarrayvakues=explode(',',$query_values);
	  $newfieldarray2=array_pop($newfieldarray);
	  
	 $newarraycombine= array_combine($newfieldarray,$values);
	 // print_r($newarraycombine);
	  foreach($newarraycombine as $combinekey=>$combinevalue){
		  $forupdate[]="$combinekey=$combinevalue";
		  //echo "$combinekey=$combinevalue,";
		 // echo "$forupdate";
	  }
	  
	 // echo "$forupdate";
	  // print_r($forupdate);
	 //print_r($newarraycombine);
	  
	  $forupdate_values = implode(',',$forupdate);

	//echo "<BR>INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE $forupdate_values <br>";
//closed_accounts($ACCOUNT_NUMBER,$Bankcode); 
	 	  
$CRMDATA =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE $forupdate_values");
	
$CRMDATA1 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'','') ON DUPLICATE KEY UPDATE $forupdate_values");
			 
		  
  }//end of for loop
 


}// end function		



function createinsert_all_enquiry_dormant($id,$dbc,$enquiryname,$fieldname,$tablename,$operator,$branchcodeid){
global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$dbc,$branchcodeid;
//$id="1002100709";

//echo "$t24serviceurl,$enquiryname,$fieldname:EQ=$id <br>";
//$response=file_get_contents("OFS_RESPONSE1.txt");
//$response=file_get_contents("$t24serviceurl,AMFB.ACCOUNT.LIST,@ID:EQ=$id");
echo "<br>dormat $t24serviceurl/$branchcodeid,$enquiryname,$fieldname:$operator=$id <br>";
$response=file_get_contents("$t24serviceurl/$branchcodeid,$enquiryname,$fieldname:$operator=$id");
	
$myspliter=explode(',"',$response);


//var_dump($myspliter);

 global $logo,$valuedata,$crmd,$keys1;
 //global $dbc,$CRMDATA,$value,$fielddata,$tablefields1,$tablefieldsforinsert;
  $counts=count($myspliter);
  $myspliter1=explode(',',$myspliter[0]);
  

  $allfieldsarray=array();
$exceptions=array();
$allfieldsarraynew=array();
  
  $header1=explode('/',$myspliter1[1]);
   $headers=explode('/',$header1[0]);
 
 
 foreach($header1 as $header ){
	$newheader=explode(':',$header);
	if (strpos(':',$header) == false) {
        $newheader=explode(':',$header);
		//print_r($newheader);
		
		
		$fielddata .= "`$newheader[0]`,";
		//$fielddata .= str_replace('.','_',"`$newheader[0]`,");
	
	//$fields=$newheader[0];
	$fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1 .=$keys1;
	//$query = "CREATE TABLE IF NOT EXISTS `crmtest`($keys1)";
	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	$allfields.="$fields,";
	$alterkeys[]="ADD COLUMN `$fields` VARCHAR(225)";
	
	$allfieldsarraynew[]=$fields;
	
}
	else{
		
	 echo ("<td><b><$newheader[1]-></b></td>");
	 $fielddata .= "`$newheader[1]`";
	 
	 
	 
	 //$fielddata .= str_replace('.','_',"`$newheader[1]`,");
	 //$replace1=str_replace('_','.',$key);
	 //$fields=$newheader[0];
	 $fields=str_replace(',','',$newheader[0]);
	$fields=str_replace('.','_',$fields);
	
	if($fields==''){
		continue;
	}
	
    $keys1="`$fields` VARCHAR(225),";
	$tablefields1.=$keys1;
	$keysforinsert="`$fields`,";
	$tablefieldsforinsert .=$keysforinsert;
	
	$allfields.="$fields,";
	$alterkeys[]="ADD COLUMN `$fields` VARCHAR(225)";
	$allfieldsarraynew[]=$fields;
	
	}
 }
 //$tablefields = implode(',', $keys1);
 //DROP TABLE `25ld_loans_and_deposits_enquiry`"
 
 if($fields=''){
		ECHO "Can not create Table";
	}else{
		

$query = "CREATE TABLE IF NOT EXISTS `$tablename`($tablefields1`status` VARCHAR(225),`transactionmode` VARCHAR(225))";
$result = mysqli_query($dbc,$query);

$q = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD PRIMARY KEY (`@ID`)");

$q1 = mysqli_query($dbc,"ALTER TABLE `$tablename` ADD COLUMN `ids` INT AUTO_INCREMENT UNIQUE FIRST");

	}
 
$allfieldsarray=array($allfields);

$collumnselect=mysqli_query($dbc,"SHOW COLUMNS from `$tablename`");
while($collumnselectdata = mysqli_fetch_array($collumnselect)){
							
							$exceptioncolumns1 = $collumnselectdata['Field'];
							$exceptioncolumns.="$exceptioncolumns1,";
							
						$exceptions[]=$exceptioncolumns1;
							//echo "<br> $exceptioncolumns <br>";
							 }

							 //echo "<br> $exceptioncolumns <br>";

$arrarydiff=array_diff($allfieldsarraynew,$exceptions);
//print_r($arrarydiff);
	foreach($arrarydiff as $diffkey=>$diffvalue){
		
		//echo "<br> $diffvalue";
		//$diffvalue[]="";
		$alterkeys1[]="ADD COLUMN `$diffvalue` TEXT";
		
	}
	
	$diffvalue=implode(',',$alterkeys1);
	
	$alters = mysqli_query($dbc,"ALTER TABLE `$tablename` $diffvalue");
	 
 
	
//end of creating table part of the function


for($i = 1; $i<count($myspliter);$i++){
	   $row =$myspliter[$i];
	  
	   //echo "$row <br>";
	
	  $cells =explode('"',$row);
	  
	  //echo $cells[3];
	  echo "<br> Dormant enquiry";
	 print_r($cells);
	echo "<br>";	  
	  $values = array();

	  foreach($cells as $key=>$value){
		  
 
				if($key % 2!=0){
				 continue;
				 }
				 $value=trim($value);
				   $values[] = "'$value'"; 
			
  		 
	  }
	  
	  
	  GLOBAL $CUSTOMERIDNEW,$Bankcode,$ACCOUNT_NUMBER,$t24serviceurlApplication;
	  $CUSTOMERIDNEW=trim($cells[0]);
	  
	  $ACCOUNT_NUMBER=trim($cells[4]);
	    
		  $Bankcode=trim($cells[14]);
		    //$Bankcode='NG0010001';
	  $query_values = implode(',',$values);

	  
 
	 	  
$CRMDATA =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online'");
	
$CRMDATA1 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'','') ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online'");

$CRMDATA2 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert) VALUES($query_values) ON DUPLICATE KEY UPDATE `status`='Active',`transactionmode`='Online'");
	
$CRMDATA3 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert,`status`) VALUES($query_values) ON DUPLICATE KEY UPDATE `status` ='Active',`transactionmode`='Online'");
		

//ebit the account
//$responseedit=file_get_contents("$t24serviceurl/$branchcodeid,$enquiryname");
//http://10.7.1.21:8080/Channels/webresources/OFSAPI?ACCOUNT,/I/PROCESS//0,INLAKSCRM1/John3@16/GH0010001,0010120000003111,CRM.SPOOL.MARKE=Y

$commandedit="ACCOUNT,/I/PROCESS//0,$t24username/$t24password/$Bankcode,$ACCOUNT_NUMBER,CRM.SPOOL.MARKE=Y";

	echo "<br>for edit $t24serviceurlApplication$commandedit <br>";

$commandedit=urlencode($commandedit);


$responseedit=file_get_contents("$t24serviceurlApplication$commandedit");


closed_accounts($ACCOUNT_NUMBER,$Bankcode);			 
		  
  }//end of for loop
 


}// end function


function closed_accounts($ACCOUNT_NUMBER,$Bankcode){
	
global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$t24serviceurlApplication,$dbc,$Bankcode,$ACCOUNT_NUMBER;


$qsearch = mysqli_query($dbc,"SELECT * from `settlement_account` where `branch_code`='$Bankcode' AND `status`='Approved'");
$dataq = mysqli_fetch_assoc($qsearch);
    
$SETTLEMENT_ACCT=$dataq['account_number'];
	

$CAPITAL_DATE=date("Ymd");
//$CAPITAL_DATE='20190226';
//$SETTLEMENT_ACCT="NGN142300001";

if($SETTLEMENT_ACCT!=''){

$CLOSURE_REASON="Account Moved to CRM";
//$t24serviceurlApplication	
$ofscommand="ACCOUNT.CLOSURE,/I/PROCESS//0,$t24username/$t24password/$Bankcode,$ACCOUNT_NUMBER,SETTLEMENT.ACCT=$SETTLEMENT_ACCT,CAPITAL.DATE=$CAPITAL_DATE,CLOSURE.REASON=$CLOSURE_REASON,POSTING.RESTRICT=97";

	

$command=urlencode($ofscommand);


$response=file_get_contents("$t24serviceurlApplication$command");	
	
echo "<br> $t24serviceurlApplication$ofscommand <br>";

	
echo "<br> $response <br>";

}else{
	
	echo "No Settlement Account";
}
	
	
}


function updatetable_images($formfields,$dbc,$tablename,$cust_id,$columname) {
   
global $formfields, $dbc, $tablename,$cust_id,$columname;
   
   //echo "<br>this is the customer ID $cust_id <br>";
$values = array();
$keys1=array();




foreach ($formfields as $key => $value) {
	
    $qvalue = $value;
	$qfields=$key;
    $values[] = "'$value'"; 
	$keys1[]="`$qfields`";
	
$q = mysqli_query($dbc,"UPDATE `$tablename` SET `$qfields`='$qvalue' where `$columname`='$cust_id'; ");
	
	 //echo "UPDATE `$tablename` SET `$qfields`='$qvalue' where `$columname`='$cust_id'; ";       
	
}//END OF FOREACH LOOP

if ($q=1){
       //echo '<center><p class=" h4 alert alert-success" role="alert">Updated Successfully.<br>  </center>';
	   echo "100";
        				
		} else {
            echo '<center><p class=" h4 alert alert-danger" role="alert">An Error Occur Please Try Again! </center>';
        }


}

//accounting entry function





function credit_movement($accounttype,$amount,$dbc){

global $accounttype,$amount,$dbc,$date;
	
	echo "SELECT * FROM accountcodes where codenumer='$accounttype'";
//search account category balance
			$categorycodetype = mysqli_query($dbc,"SELECT * FROM accountcodes where codenumer='$accounttype'");
			$categorycodetypedata=mysqli_fetch_array($categorycodetype);
			
			
			print_r($categorycodetypedata);
			
	
			$categorybalance = $categorycodetypedata['balance'];
			$codename = $categorycodetypedata['codename'];
			
			$openingbalance = $categorycodetypedata['openingbalance'];
			$debitmovement = $categorycodetypedata['debitmovement'];
			$creditmovement = $categorycodetypedata['creditmovement'];
			$closingbalance = $categorycodetypedata['closingbalance'];
			
			echo $COA = $categorycodetypedata['COA'];
			
			$account_group=$categorycodetypedata['account_group'];
			
			
			//financial accounting
			$COA = $categorycodetypedata['COA'];
			
			$account_group=$categorycodetypedata['account_group'];
			
			
			$categorycodetypeCOA = mysqli_query($dbc,"SELECT * FROM coa_table where ids='$COA'");
			$categorycodetypedataCOA=mysqli_fetch_array($categorycodetypeCOA);
	
			$coatotal_balance = $categorycodetypedataCOA['total_balance'];

			$coa_code = $categorycodetypedataCOA['coa_code'];



			$account_group_qr = mysqli_query($dbc,"SELECT * FROM account_group where ids='$account_group'");
			$account_group_qr_data=mysqli_fetch_array($account_group_qr);
	
			$account_group_balance = $account_group_qr_data['total_balance'];

			$account_group_id = $account_group_qr_data['ids'];
			
			
			
			//Asset and Libility Account
		
		$newcategorybalance=$categorybalance+$amount;
		
		$openingbalance =$categorybalance;
		$creditmovementnew =$creditmovement+$amount;


		//finacial accounting updates

		 $coa_totals=$coatotal_balance+$amount;

		$groupacc_totals=$account_group_balance+$amount;
		
		//echo "UPDATE $amount `coa_table` SET `total_balance` ='$coa_totals'  WHERE `ids` = '$COA';";

		$categorybalanceupdatecoa = mysqli_query($dbc,"UPDATE `coa_table` SET `total_balance` ='$coa_totals'  WHERE `coa_code` = '$COA';");

		
		$categorybalanceupdateaccgroup = mysqli_query($dbc,"UPDATE `account_group` SET `total_balance` ='$groupacc_totals'  WHERE `ids` = '$account_group';");
		
		
		

		
		
		
		$categorybalanceupdate = mysqli_query($dbc,"UPDATE `accountcodes` SET `balance` ='$newcategorybalance',`openingbalance`='$openingbalance',`creditmovement` = '$creditmovementnew',`closingbalance` = '$newcategorybalance'  WHERE `codenumer` = '$accounttype';");
		
		
	echo $assetandliability = "INSERT INTO assetandliability(`line`,`description`,`openingbalance`,`debitmovement`,`creditmovement`,`closingbalance`,`date`)
		VALUES ('$accounttype','$codename', '$categorybalance', '0','$amount', '$newcategorybalance', '$date')";
        $assetandliabilitydata = mysqli_query($dbc,$assetandliability);
		
			
						
	
	
}
//end of function credit function




function debit_movement($accounttype,$amount,$dbc){

global $accounttype,$amount,$dbc,$date;	
	
	
//search account category balance
			$categorycodetype = mysqli_query($dbc,"SELECT * FROM accountcodes where codenumer='$accounttype'");
			$categorycodetypedata=mysqli_fetch_array($categorycodetype);
	
			$categorybalance = $categorycodetypedata['balance'];
			$codename = $categorycodetypedata['codename'];
			
			$openingbalance = $categorycodetypedata['openingbalance'];
			$debitmovement = $categorycodetypedata['debitmovement'];
			$creditmovement = $categorycodetypedata['creditmovement'];
			$closingbalance = $categorycodetypedata['closingbalance'];
			
			//$COA = $categorycodetypedata['COA'];
			
			$account_group=$categorycodetypedata['account_group'];
			
			
			//financial accounting
			$COA = $categorycodetypedata['COA'];
			
			$account_group=$categorycodetypedata['account_group'];
			
			
			$categorycodetypeCOA = mysqli_query($dbc,"SELECT * FROM `coa_table` where `ids`='$COA'");
			$categorycodetypedataCOA=mysqli_fetch_array($categorycodetypeCOA);
	
		 $coatotal_balance=$categorycodetypedataCOA['total_balance'];

			$coa_code=$categorycodetypedataCOA['coa_code'];



			$account_group_qr = mysqli_query($dbc,"SELECT * FROM account_group where ids='$account_group'");
			$account_group_qr_data=mysqli_fetch_array($account_group_qr);
	
			$account_group_balance = $account_group_qr_data['total_balance'];

			$account_group_id = $account_group_qr_data['ids'];
			
			
			
			//Asset and Libility Account
		
$newcategorybalance=$categorybalance -$amount;
		
		$openingbalance =$categorybalance;
		$debitmovementnew =$debitmovement+$amount;
		
		
		$assetnarration="$narration by $name";
		
		$categorybalanceupdate = mysqli_query($dbc,"UPDATE `accountcodes` SET `balance` ='$newcategorybalance',`openingbalance`='$openingbalance',`debitmovement` = '$debitmovementnew',`closingbalance` = '$newcategorybalance'  WHERE `codenumer` = '$accounttype';");
		
		
		 $assetandliability = "INSERT INTO assetandliability(`line`,`description`,`openingbalance`,`debitmovement`,`creditmovement`,`closingbalance`,`date`,`narration`)
		VALUES ('$accounttype','$codename', '$categorybalance', '$amount','0', '$newcategorybalance', '$date', '$assetnarration')";
        $assetandliabilitydata = mysqli_query($dbc,$assetandliability);
		
		
		
		//finacial accounting updates

		// echo $coa_totals=$coatotal_balance-$amount;
		 
		 $coa_totals=$coatotal_balance-$amount;

		$groupacc_totals =$account_group_balance-$amount;
		
		//echo "UPDATE `coa_table` SET `total_balance`='$coa_totals'  WHERE `ids` = '$COA' <br>";

		$categorybalanceupdatecoa = mysqli_query($dbc,"UPDATE `coa_table` SET `total_balance`='$coa_totals'  WHERE `ids` = '$COA'");
		
		$categorybalanceupdateaccgroup = mysqli_query($dbc,"UPDATE `account_group` SET `total_balance` ='$groupacc_totals'  WHERE `ids` = '$account_group';");
		
		
		
		//transactions jounal update with the creditted interest
		
		$jounal = "INSERT INTO jounal (`description`, `credit`, `user`, `date`) 
		VALUES ('Income from withdrawal from $name Transaction ', '$chargeamount', '$username1','$date')";
        		
		$jounaldata = mysqli_query($dbc,$jounal);
		
		
	
}
//end function



		
		
		
		
		



//start credit fuctions



function credit_accounts($account_number_main,$dbc,$amount,$username1,$transactionid,$narration){
			
global $account_number_main,$dbc,$amount,$username1,$new,$transactionid,$narration,$accounttype,$tillnumber;

$narration1="$narration";



$tellercash1 = mysqli_query($dbc,"SELECT * FROM tellers WHERE `teller_name`='$username1'");							
$tellercash1data=mysqli_fetch_assoc($tellercash1);

$telleraccounts=$tellercash1data['account_number'];
 $telleramount=$tellercash1data['amount'];

 $tellercash=$tellercash1data['amount'];
 
 $tellerlimit=$tellercash1data['limit'];

 $tillnumber=$tellercash1data['till'];
	

//debit_account($account_number_main=$telleraccounts,$dbc,$amount,$username1,$transactionid,$narration="Cash Received for loan repayment");



$date1=date("Y-m-d");



$transaction = mysqli_query($dbc,"SELECT * FROM transactions where `id`='$account_number_main'");
$transactiondata=mysqli_fetch_array($transaction);


//print_r($transactiondata);

//$customerimage=$transactiondata['customerimage'];
$id=$transactiondata['id'];

$account_id=$transactiondata['id'];

$CUSTOMERNUMBER=$transactiondata['MNEMONIC'];

$individual12 = mysqli_query($dbc,"SELECT * FROM t24customertable where (`MNEMONIC`='$CUSTOMERNUMBER')");
$individual12data=mysqli_fetch_array($individual12);

$mobileNumber = $individual12data['TEL_MOBILE'];


//$name2 = $accountndata['group_name'];
//$image = $personal_details['cust_image'];
 $name = $transactiondata['name'];


$approval_Status = $transactiondata['approval_Status'];



$balance = $transactiondata['balance'];
$totalsaving = $transactiondata['totalsaving'];
$totalwithdrawal = $transactiondata['totalwithdrawal'];
$interest = $transactiondata['interest'];

$status = $transactiondata['status'];
$date=date("Y-m-d");
//$dateOfTransaction = $transactiondata['date_of_transaction'];
$narration = $transactiondata['narration'];

$zone = $transactiondata['zone'];

$officer = $transactiondata['officer'];

$accountcurrency = $transactiondata['currency'];



$accounttype = $transactiondata['accounttype'];

$PRODUCT_CATEGORY = $transactiondata['PRODUCT_CATEGORY'];


//call_user_func(debit_movement($accounttype,$amount,$dbc));

//debit_movement($accounttype,$amount,$dbc);

//credit_movement($accounttype,$amount,$dbc);

$qsearch = mysqli_query($dbc,"SELECT * from withdrawal_limit order by ids DESC limit 1");
$dataq = mysqli_fetch_assoc($qsearch);

$tt_offline_amount_all=$dataq['tt_offline_amount_all']/100;
$tt_offline_amount_aut=$dataq['tt_offline_amount_aut']/100;

$allowedbyteller=$balance*$tt_offline_amount_all;

$requiredauth=$balance*$tt_offline_amount_aut;



$t24databasecheck = mysqli_query($dbc,"SELECT * FROM t24snapaccounts where (`@ID`='$account_number_main')");
$t24databasecheckdata=mysqli_fetch_array($t24databasecheck);

$ONLINE_ACTUAL_BAL = $t24databasecheckdata['ONLINE_ACTUAL_BAL'];

$snappcurrency = $t24databasecheckdata['CURRENCY'];		


$t24accountnumber=$transactiondata['t24accountnumber'];


//search charges on account
$charges = mysqli_query($dbc,"SELECT * FROM accountcharges where categorycode='$accounttype'");
$chargesdata=mysqli_fetch_array($charges);

$chargeamount = $chargesdata['chargeamount'];
//$accounttype = $chargesdata['accounttype'];


//search account category balance
$categorycodetype = mysqli_query($dbc,"SELECT * FROM accountcodes where codenumer='$accounttype'");
$categorycodetypedata=mysqli_fetch_array($categorycodetype);


//print_r($categorycodetypedata);

$categorybalance = $categorycodetypedata['balance'];
$codename = $categorycodetypedata['codename'];

$openingbalance = $categorycodetypedata['openingbalance'];
$debitmovement = $categorycodetypedata['debitmovement'];
$creditmovement = $categorycodetypedata['creditmovement'];
$closingbalance = $categorycodetypedata['closingbalance'];

 $principal_account=$categorycodetypedata['principal_account'];

$interest_account=$categorycodetypedata['interest_account'];

$charge_account=$categorycodetypedata['charge_account'];



//financial accounting interest_account
$COA = $categorycodetypedata['COA'];

$account_group=$categorycodetypedata['account_group'];


$categorycodetypeCOA = mysqli_query($dbc,"SELECT * FROM coa_table where ids='$COA'");
$categorycodetypedataCOA=mysqli_fetch_array($categorycodetypeCOA);

$coatotal_balance = $categorycodetypedataCOA['total_balance'];

$coa_code = $categorycodetypedataCOA['coa_code'];



$account_group_qr = mysqli_query($dbc,"SELECT * FROM account_group where ids='$account_group'");
$account_group_qr_data=mysqli_fetch_array($account_group_qr);

$account_group_balance = $account_group_qr_data['total_balance'];

$account_group_id = $account_group_qr_data['ids'];



			
$balance1=$balance;




$narration2="by $name";
$debitaccount=$telleraccounts;
$creditaccount=$account_number_main;

$new=$balance+$amount;
$totalsaving=$amount+$totalsaving;
$balance1=$new;

$telleramountnew=$tellercash-$amount;
//echo $telleramountnew;

$Tellertransactionsid=substr("$getdepositresults", 0, 12);

//Asset and Libility Account

$newcategorybalance=$categorybalance +$amount;

$openingbalance =$categorybalance;
$creditmovementnew =$creditmovement+$amount;


//finacial accounting updates

$coa_totals =$coatotal_balance+$amount;

$groupacc_totals =$account_group_balance+$amount;

$categorybalanceupdatecoa = mysqli_query($dbc,"UPDATE `coa_table` SET `total_balance` ='$coa_totals'  WHERE `ids` = '$COA';");

$categorybalanceupdateaccgroup = mysqli_query($dbc,"UPDATE `account_group` SET `total_balance` ='$groupacc_totals'  WHERE `ids` = '$account_group';");





$categorybalanceupdate = mysqli_query($dbc,"UPDATE `accountcodes` SET `balance` ='$newcategorybalance',`openingbalance`='$openingbalance',`creditmovement` = '$creditmovementnew',`closingbalance` = '$newcategorybalance'  WHERE `codenumer` = '$accounttype';");


$assetandliability = "INSERT INTO assetandliability(`line`,`description`,`openingbalance`,`debitmovement`,`creditmovement`,`closingbalance`,`date`)
VALUES ('$accounttype','$codename', '$categorybalance', '0','$amount', '$newcategorybalance', '$date')";
$assetandliabilitydata = mysqli_query($dbc,$assetandliability);


$tellercashdupdate = mysqli_query($dbc,"UPDATE `tellers` SET `amount`='$telleramountnew'  WHERE `till` = '$tillnumber';");


$tellertransaction = "INSERT INTO tellertransactions (`telleraccount`, `tellername`, `debit`, `credit`, `till`, `customername`, `transactionid`,`date`) 
VALUES ('$debitaccount','$username1', '$amount', '0','$tillnumber', '$name', '$transactionid','$date1')";
$tellertransactiondata = mysqli_query($dbc,$tellertransaction);



$applicant = mysqli_query($dbc,"UPDATE `transactions` SET `balance` = '$new', `date` ='$date1', `totalsaving` = '$totalsaving', `totalwithdrawal` = '$totalwithdrawal', `narration` ='$narration1'  WHERE (`id`='$account_number_main');");
    
	
	$applicantsnap = mysqli_query($dbc,"UPDATE `psl.accounts` SET `balance` = '$new'  WHERE (`SNAP_ID`='$account_number_main' OR `t24id`= '$account_number_main');");

$acq = "INSERT INTO savings (`id`, `withdrawal`, `deposit`, `narration`, `date`, `balance`, `totalsaving`, `totalwithdrawal`, `interest`,`tellername`,`customername`, `transactionid`, `status`, `zone`, `officer`,`t24accountnumber`,`transactiontype`,`transactionmode`,`Tellertransactionsid`,`cashaccountnumber`,`Units`,`Denomination`,`DEPOSIT_NO`,`COMPANY`,`PRODUCT_CATEGORY`) VALUES ('$account_number_main', '0', '$amount', '$narration1','$date1', '$new', '$totalsaving', '$totalwithdrawal', '$interest','$username1','$name', '$transactionid', 'authorized','$zone','$officer','$t24accountnumber','Deposit','Online','$Tellertransactionsid','$telleraccounts','$unit','$denom','$DEPOSIT_NO','$activbranch_name','$accounttype')";

$acr = mysqli_query($dbc,$acq);

		
		
		}

//end credit function 


		
		
		
// start debit function 



function debit_account($account_number_main,$dbc,$amount,$username1,$transactionid,$narration){
	

global $account_number_main,$dbc,$amount,$username1,$transactionid,$narration;

$narration1="$narration";


//Teller Details Check 


$tellercash1 = mysqli_query($dbc,"SELECT * FROM tellers WHERE `teller_name`='$username1'");							
$tellercash1data=mysqli_fetch_assoc($tellercash1);

$telleraccounts=$tellercash1data['account_number'];
 $telleramount=$tellercash1data['amount'];

 $tellercash=$tellercash1data['amount'];
 
 $tellerlimit=$tellercash1data['limit'];

 $tillnumber=$tellercash1data['till'];
	





$date1=date("Y-m-d");
		
		$transaction = mysqli_query($dbc,"SELECT * FROM transactions where `id`='$account_number_main'");
	    $transactiondata=mysqli_fetch_array($transaction);
	
	
		
        //$personal_details = personal_details($dbc,$account_number_main);


        
            //$qq = mysqli_query($dbc,"SELECT * FROM personaldetails_tbl WHERE customer_id = '$account_number_main'");
            //$dataa = mysqli_fetch_array($qq);
			$customerimage=$transactiondata['customerimage'];
			$id=$transactiondata['id'];
			
			$account_id=$transactiondata['id'];
			
			$CUSTOMERNUMBER=$transactiondata['MNEMONIC'];

			$individual12 = mysqli_query($dbc,"SELECT * FROM t24customertable where (`MNEMONIC`='$CUSTOMERNUMBER')");
			$individual12data=mysqli_fetch_array($individual12);
	
			$mobileNumber = $individual12data['TEL_MOBILE'];
			
			
            //$name2 = $accountndata['group_name'];
			//$image = $personal_details['cust_image'];
			 $name = $transactiondata['name'];

			
			 $approval_Status = $transactiondata['approval_Status'];



            $balance = $transactiondata['balance'];
            $totalsaving = $transactiondata['totalsaving'];
            $totalwithdrawal = $transactiondata['totalwithdrawal'];
            $interest = $transactiondata['interest'];
			
			$status = $transactiondata['status'];
            $date=date("Y-m-d");
            //$dateOfTransaction = $transactiondata['date_of_transaction'];
            $narration = $transactiondata['narration'];
			
			$zone = $transactiondata['zone'];
			
			$officer = $transactiondata['officer'];
			
			$accountcurrency = $transactiondata['currency'];
			
			
			
			$accounttype = $transactiondata['accounttype'];
			
			$PRODUCT_CATEGORY = $transactiondata['PRODUCT_CATEGORY'];
			
			
			
			
			$qsearch = mysqli_query($dbc,"SELECT * from withdrawal_limit order by ids DESC limit 1");
$dataq = mysqli_fetch_assoc($qsearch);

$tt_offline_amount_all=$dataq['tt_offline_amount_all']/100;
$tt_offline_amount_aut=$dataq['tt_offline_amount_aut']/100;

$allowedbyteller=$balance*$tt_offline_amount_all;

$requiredauth=$balance*$tt_offline_amount_aut;
       
			
			
	$t24databasecheck = mysqli_query($dbc,"SELECT * FROM t24snapaccounts where (`@ID`='$account_number_main')");
			$t24databasecheckdata=mysqli_fetch_array($t24databasecheck);
	
			$ONLINE_ACTUAL_BAL = $t24databasecheckdata['ONLINE_ACTUAL_BAL'];
			
			$snappcurrency = $t24databasecheckdata['CURRENCY'];		
			
			
			
			
			
			//search charges on account
			$charges = mysqli_query($dbc,"SELECT * FROM accountcharges where categorycode='$accounttype'");
			$chargesdata=mysqli_fetch_array($charges);
	
			$chargeamount = $chargesdata['chargeamount'];
			//$accounttype = $chargesdata['accounttype'];
			
	
			//search account category balance
			$categorycodetype = mysqli_query($dbc,"SELECT * FROM accountcodes where codenumer='$accounttype'");
			$categorycodetypedata=mysqli_fetch_array($categorycodetype);
	
			$categorybalance = $categorycodetypedata['balance'];
			$codename = $categorycodetypedata['codename'];
			
			$openingbalance = $categorycodetypedata['openingbalance'];
			$debitmovement = $categorycodetypedata['debitmovement'];
			$creditmovement = $categorycodetypedata['creditmovement'];
			$closingbalance = $categorycodetypedata['closingbalance'];
			
			$t24accountnumber=$transactiondata['t24accountnumber'];
			
			

//financial accounting
			$COA = $categorycodetypedata['COA'];
			
			$account_group=$categorycodetypedata['account_group'];
			
			
			$categorycodetypeCOA = mysqli_query($dbc,"SELECT * FROM coa_table where ids='$COA'");
			$categorycodetypedataCOA=mysqli_fetch_array($categorycodetypeCOA);
	
			$coatotal_balance = $categorycodetypedataCOA['total_balance'];

			$coa_code = $categorycodetypedataCOA['coa_code'];



			$account_group_qr = mysqli_query($dbc,"SELECT * FROM account_group where ids='$account_group'");
			$account_group_qr_data=mysqli_fetch_array($account_group_qr);
	
			$account_group_balance = $account_group_qr_data['total_balance'];

			$account_group_id = $account_group_qr_data['ids'];


	
		
		
		
	$narration2="by $name";
	
		$debitaccount=$account_number_main;
		$creditaccount=$telleraccounts;
	
        $new=$balance-$amount-$chargeamount;
		$totalwithdrawal=$amount+$totalwithdrawal;
		
		$balance1=$new;

	//check if their is connection to the remote server	

		$newcategorybalance=$categorybalance-$amount;
		
		$openingbalance =$categorybalance;
		$debitmovementnew =$debitmovement+$amount;
		
		
		$assetnarration="$narration by $name";
		
		$categorybalanceupdate = mysqli_query($dbc,"UPDATE `accountcodes` SET `balance` ='$newcategorybalance',`openingbalance`='$openingbalance',`debitmovement` = '$debitmovementnew',`closingbalance` = '$newcategorybalance'  WHERE `codenumer` = '$loanType';");
		
		
		$assetandliability = "INSERT INTO assetandliability(`line`,`description`,`openingbalance`,`debitmovement`,`creditmovement`,`closingbalance`,`date`,`narration`)
		VALUES ('$loanType','$codename', '$categorybalance', '$amount','0', '$newcategorybalance', '$date', '$assetnarration')";
        $assetandliabilitydata = mysqli_query($dbc,$assetandliability);
		
		

		


		
		//teller cash update
		
		$telleramountnew=$tellercash + $amount;
		//echo $telleramountnew;
		
		
		$tellercashdupdate = mysqli_query($dbc,"UPDATE `tellers` SET `amount` = '$telleramountnew'  WHERE `till` = '$tillnumber';");
		
		
		$tellertransaction = "INSERT INTO tellertransactions (`telleraccount`, `tellername`, `debit`, `credit`, `till`, `customername`, `transactionid`) 
		VALUES ('$debitaccount','$username1', '0', '$amount','$tillnumber', '$name', '$transactionid')";
        $tellertransactiondata = mysqli_query($dbc,$tellertransaction);
		
		
		
		
		
		//transactions jounal update with the creditted interest
		
		$jounal = "INSERT INTO jounal (`description`, `credit`, `user`, `date`) 
		VALUES ('Income from withdrawal from $name Transaction ', '$chargeamount', '$username1','$date')";
        		
		$jounaldata = mysqli_query($dbc,$jounal);
		
		
		
		
		$ofs = "INSERT INTO ofs (`date`,`narration1`, `narration2`, `amount`, `debitaccount`, `creditaccount`, `transactionid`, `status`) 
		VALUES ('$date','$narration1', '$narration2', '$amount','$debitaccount', '$creditaccount', '$transactionid', 'authorized')";
        
		$ofsdata = mysqli_query($dbc,$ofs);
		
		
		 $acq = "INSERT INTO savings (`id`,`group_id`,`withdrawal`, `deposit`, `narration`, `date`, `balance`, `totalsaving`, `totalwithdrawal`, `interest`, `tellername`, `customername`, `transactionid`, `status`, `zone`, `officer`,`cashaccountnumber`,`Units`,`Denomination`,`t24accountnumber`,`DEPOSIT_NO`,`COMPANY`) 
		VALUES ('$account_number_main','$account_number_main','$amount', '0', '$narration1','$date1', '$new', '$totalsaving', '$totalwithdrawal', '$interest', '$username1', '$name', '$transactionid', 'authorized','$zone','$officer','$telleraccounts','$unit','$denom','$t24accountnumber','$DEPOSIT_NO','$activbranch_name')";
        		
		$acr = mysqli_query($dbc,$acq);
		
		
		
		
		
		
		
		//$link='<p class=" h4 alert alert-success" role="alert">Transaction Successfuly Executed<br></p> ';
		
		//WITHDRAWAL TRANSACTION RESPONSE
		//$link='<center><p class=" h4 alert alert-success" role="alert">Transaction Successfuly Executed Transaction ID is.<b> '.$transactionid.'</b> </center></p>';
		
	
      $applicant = mysqli_query($dbc,"UPDATE `transactions` SET `balance` = '$new', `date` = '$date1', `totalsaving` = '$totalsaving', `totalwithdrawal` = '$totalwithdrawal', `narration` ='$narration1'  WHERE (`id` = '$account_number_main' OR `t24accountnumber`='$account_number_main');");
		
		

$ac = mysqli_query($dbc,$applicant);






}
//end debit function		
		
		
		
//loan credit function with ledger


function credit_accounts_loans($account_number_main,$dbc,$amount,$username1,$transactionid,$narration,$corresponding_ledger){
			
global $account_number_main,$dbc,$amount,$username1,$new,$transactionid,$narration,$accounttype,$tillnumber,$corresponding_ledger;

$narration1="$narration";



$tellercash1 = mysqli_query($dbc,"SELECT * FROM tellers WHERE `teller_name`='$username1'");							
$tellercash1data=mysqli_fetch_assoc($tellercash1);

$telleraccounts=$tellercash1data['account_number'];
 $telleramount=$tellercash1data['amount'];

 $tellercash=$tellercash1data['amount'];
 
 $tellerlimit=$tellercash1data['limit'];

 $tillnumber=$tellercash1data['till'];
	

//debit_account($account_number_main=$telleraccounts,$dbc,$amount,$username1,$transactionid,$narration="Cash Received for loan repayment");



$date1=date("Y-m-d");



$transaction = mysqli_query($dbc,"SELECT * FROM transactions where `id`='$account_number_main'");
$transactiondata=mysqli_fetch_array($transaction);


//print_r($transactiondata);

//$customerimage=$transactiondata['customerimage'];
$id=$transactiondata['id'];

$account_id=$transactiondata['id'];

$CUSTOMERNUMBER=$transactiondata['MNEMONIC'];

$individual12 = mysqli_query($dbc,"SELECT * FROM t24customertable where (`MNEMONIC`='$CUSTOMERNUMBER')");
$individual12data=mysqli_fetch_array($individual12);

$mobileNumber = $individual12data['TEL_MOBILE'];


//$name2 = $accountndata['group_name'];
//$image = $personal_details['cust_image'];
 $name = $transactiondata['name'];


$approval_Status = $transactiondata['approval_Status'];



$balance = $transactiondata['balance'];
$totalsaving = $transactiondata['totalsaving'];
$totalwithdrawal = $transactiondata['totalwithdrawal'];
$interest = $transactiondata['interest'];

$status = $transactiondata['status'];
$date=date("Y-m-d");

$timestamp=date("Y-m-d s");
//$dateOfTransaction = $transactiondata['date_of_transaction'];
$narration = $transactiondata['narration'];

$zone = $transactiondata['zone'];

$officer = $transactiondata['officer'];

$accountcurrency = $transactiondata['currency'];



$accounttype = $transactiondata['accounttype'];

$PRODUCT_CATEGORY = $transactiondata['PRODUCT_CATEGORY'];


//call_user_func(debit_movement($accounttype,$amount,$dbc));

//debit_movement($accounttype,$amount,$dbc);

//credit_movement($accounttype,$amount,$dbc);

$qsearch = mysqli_query($dbc,"SELECT * from withdrawal_limit order by ids DESC limit 1");
$dataq = mysqli_fetch_assoc($qsearch);

$tt_offline_amount_all=$dataq['tt_offline_amount_all']/100;
$tt_offline_amount_aut=$dataq['tt_offline_amount_aut']/100;

$allowedbyteller=$balance*$tt_offline_amount_all;

$requiredauth=$balance*$tt_offline_amount_aut;



$t24databasecheck = mysqli_query($dbc,"SELECT * FROM t24snapaccounts where (`@ID`='$account_number_main')");
$t24databasecheckdata=mysqli_fetch_array($t24databasecheck);

$ONLINE_ACTUAL_BAL = $t24databasecheckdata['ONLINE_ACTUAL_BAL'];

$snappcurrency = $t24databasecheckdata['CURRENCY'];		


$t24accountnumber=$transactiondata['t24accountnumber'];


//search charges on account
$charges = mysqli_query($dbc,"SELECT * FROM accountcharges where categorycode='$accounttype'");
$chargesdata=mysqli_fetch_array($charges);

$chargeamount = $chargesdata['chargeamount'];
//$accounttype = $chargesdata['accounttype'];


//search account category balance
$categorycodetype = mysqli_query($dbc,"SELECT * FROM accountcodes where codenumer='$accounttype'");
$categorycodetypedata=mysqli_fetch_array($categorycodetype);


//print_r($categorycodetypedata);

$categorybalance = $categorycodetypedata['balance'];
$codename = $categorycodetypedata['codename'];

$openingbalance = $categorycodetypedata['openingbalance'];
$debitmovement = $categorycodetypedata['debitmovement'];
$creditmovement = $categorycodetypedata['creditmovement'];
$closingbalance = $categorycodetypedata['closingbalance'];

 $principal_account=$categorycodetypedata['principal_account'];

$interest_account=$categorycodetypedata['interest_account'];

$charge_account=$categorycodetypedata['charge_account'];



//financial accounting interest_account
$COA = $categorycodetypedata['COA'];

$account_group=$categorycodetypedata['account_group'];


$ledger_line=$categorycodetypedata['account_group'];


$categorycodetypeCOA = mysqli_query($dbc,"SELECT * FROM `coa_table` where `coa_code`='$COA'");
$categorycodetypedataCOA=mysqli_fetch_array($categorycodetypeCOA);

$coatotal_balance = $categorycodetypedataCOA['total_balance'];

$coa_code = $categorycodetypedataCOA['coa_code'];



$account_group_qr = mysqli_query($dbc,"SELECT * FROM `account_ledger` where `ledger_line`='$ledger_line'");
$account_group_qr_data=mysqli_fetch_array($account_group_qr);

$account_group_balance = $account_group_qr_data['credit_amount'];

$account_ledger_name = $account_group_qr_data['account_ledger_name'];

$opening_balance = $account_group_qr_data['opening_balance'];
$COMPANY_ledger = $account_group_qr_data['COMPANY'];
$branch_code = $account_group_qr_data['branch_code'];
$debit_amount = $account_group_qr_data['debit_amount'];
$ledger_no = $account_group_qr_data['ledger_no'];
$account_type_1 = $account_group_qr_data['account_type_1'];
$account_type_2 = $account_group_qr_data['account_type_2'];


//`ledger_journal`(`ids`, `logged_by`,`account_ledger_name`,`opening_balance`,`timestamp`, `datecreated`,`transaction_type`, `COMPANY`, `branch_code`, `coa_code`, `credit_amount`, `debit_amount`, `closing_balance`, `ledger_line`, `ledger_no`, `account_type_1`, `account_type_2`


$ledger_closing_balance = $account_group_qr_data['closing_balance'];

$account_group_id = $account_group_qr_data['ids'];



			
$balance1=$balance;




$narration2="by $name";
$debitaccount=$telleraccounts;
$creditaccount=$account_number_main;

$new=$balance+$amount;
$totalsaving=$amount-$totalsaving;
$balance1=$new;

$telleramountnew=$tellercash-$amount;
//echo $telleramountnew;

$Tellertransactionsid=substr("$getdepositresults", 0, 12);

//Asset and Libility Account

$newcategorybalance=$categorybalance-$amount;

$openingbalance =$categorybalance;
$creditmovementnew =$creditmovement-$amount;


//finacial accounting updates

$coa_totals =$coatotal_balance-$amount;

$groupacc_totals =$account_group_balance-$amount;

//$ledger_closing_balance=$ledger_closing_balance-$amount;

$closing_balance=$ledger_closing_balance-$amount;



$categorybalanceupdatecoa = mysqli_query($dbc,"UPDATE `coa_table` SET `total_balance` ='$coa_totals'  WHERE `coa_code` = '$COA';");

//$categorybalanceupdateaccgroup = mysqli_query($dbc,"UPDATE `account_ledger` SET `credit_amount`=`credit_amount`+'$amount',`closing_balance`=`closing_balance`-'$amount'  WHERE `ledger_line` = '$ledger_account';");


//$categorybalanceupdateaccgroup = mysqli_query($dbc,"UPDATE `account_ledger` SET `credit_amount` =`credit_amount`+'$amount',`closing_balance` =`closing_balance`-'$amount',`opening_balance`='$ledger_closing_balance'  WHERE `ledger_line` = '$account_group';");


$categorybalanceupdateaccgroup = mysqli_query($dbc,"UPDATE `account_ledger` SET `credit_amount` =`credit_amount`+'$amount',`closing_balance` =`closing_balance`-'$amount'  WHERE `ledger_line`='$account_group';");





$categorybalanceupdate = mysqli_query($dbc,"UPDATE `accountcodes` SET `balance` ='$newcategorybalance',`openingbalance`='$openingbalance',`creditmovement` = '$creditmovementnew',`closingbalance` = '$newcategorybalance'  WHERE `codenumer` = '$accounttype';");


$assetandliability = "INSERT INTO assetandliability(`line`,`description`,`openingbalance`,`debitmovement`,`creditmovement`,`closingbalance`,`date`)
VALUES ('$accounttype','$codename', '$categorybalance', '0','$amount', '$newcategorybalance', '$date')";
$assetandliabilitydata = mysqli_query($dbc,$assetandliability);

//INSERT INTO `ledger_journal`(`ids`, `logged_by`, `tablename`, `application_name`, `account_ledger_name`, `accout_group`, `opening_balance`, `debit_credit`, `description`, `timestamp`, `datecreated`, `channel`, `transaction_type`, `COMPANY`, `branch_code`, `coa_code`, `credit_amount`, `debit_amount`, `closing_balance`, `ledger_line`, `ledger_no`, `account_type_1`, `account_type_2`) `opening_balance`='$ledger_closing_balance'

$assetandliabilityledger = "INSERT INTO `ledger_journal`(`logged_by`,`account_ledger_name`,`opening_balance`,`timestamp`, `datecreated`,`transaction_type`,`COMPANY`, `branch_code`, `coa_code`, `credit_amount`, `debit_amount`, `closing_balance`, `ledger_line`, `ledger_no`, `account_type_1`, `account_type_2`,`corresponding_ledger`) VALUES ('$username1','$account_ledger_name', '$ledger_closing_balance','$timestamp', '$date', 'CR','$COMPANY_ledger','$branch_code', '$coa_code','$amount','0','$closing_balance','$ledger_line','$ledger_no','$account_type_1','$account_type_2','$corresponding_ledger')";
$assetandliabilitydataledger = mysqli_query($dbc,$assetandliabilityledger);




$tellercashdupdate = mysqli_query($dbc,"UPDATE `tellers` SET `amount`='$telleramountnew'  WHERE `till` = '$tillnumber';");


$tellertransaction = "INSERT INTO tellertransactions (`telleraccount`, `tellername`, `debit`, `credit`, `till`, `customername`, `transactionid`,`date`) 
VALUES ('$debitaccount','$username1', '$amount', '0','$tillnumber', '$name', '$transactionid','$date1')";
$tellertransactiondata = mysqli_query($dbc,$tellertransaction);



$applicant = mysqli_query($dbc,"UPDATE `transactions` SET `balance` = '$new', `date` ='$date1', `totalsaving` = '$totalsaving', `totalwithdrawal` = '$totalwithdrawal', `narration` ='$narration1'  WHERE (`id`='$account_number_main');");
    
	
$applicantsnap = mysqli_query($dbc,"UPDATE `psl.accounts` SET `balance` = '$new'  WHERE (`SNAP_ID`='$account_number_main' OR `t24id`= '$account_number_main');");

$acq = "INSERT INTO savings (`id`, `withdrawal`, `deposit`, `narration`, `date`, `balance`, `totalsaving`, `totalwithdrawal`, `interest`,`tellername`,`customername`, `transactionid`, `status`, `zone`, `officer`,`t24accountnumber`,`transactiontype`,`transactionmode`,`Tellertransactionsid`,`cashaccountnumber`,`Units`,`Denomination`,`DEPOSIT_NO`,`COMPANY`,`PRODUCT_CATEGORY`) VALUES ('$account_number_main', '0', '$amount', '$narration1','$date1', '$new', '$totalsaving', '$totalwithdrawal', '$interest','$username1','$name', '$transactionid', 'authorized','$zone','$officer','$t24accountnumber','Deposit','Online','$Tellertransactionsid','$telleraccounts','$unit','$denom','$DEPOSIT_NO','$activbranch_name','$accounttype')";

$acr = mysqli_query($dbc,$acq);

		
		
		}

//end loan credit function		
		
		
		
//debit accounts loans


function debit_account_loans($account_number_main,$dbc,$amount,$username1,$transactionid,$narration,$corresponding_ledger){
	

global $account_number_main,$dbc,$amount,$username1,$transactionid,$narration,$corresponding_ledger;

$narration1="$narration";


//Teller Details Check 


$tellercash1 = mysqli_query($dbc,"SELECT * FROM tellers WHERE `teller_name`='$username1'");							
$tellercash1data=mysqli_fetch_assoc($tellercash1);

$telleraccounts=$tellercash1data['account_number'];
 $telleramount=$tellercash1data['amount'];

 $tellercash=$tellercash1data['amount'];
 
 $tellerlimit=$tellercash1data['limit'];

 $tillnumber=$tellercash1data['till'];
	



		
$date=date("Y-m-d");

$timestamp=date("Y-m-d H:i:s");		
	

$date1=date("Y-m-d");
		
		$transaction = mysqli_query($dbc,"SELECT * FROM transactions where `id`='$account_number_main'");
	    $transactiondata=mysqli_fetch_array($transaction);
	
	
		
        //$personal_details = personal_details($dbc,$account_number_main);


        
            //$qq = mysqli_query($dbc,"SELECT * FROM personaldetails_tbl WHERE customer_id = '$account_number_main'");
            //$dataa = mysqli_fetch_array($qq);
			$customerimage=$transactiondata['customerimage'];
			$id=$transactiondata['id'];
			
			$account_id=$transactiondata['id'];
			
			
			$CUSTOMERNUMBER=$transactiondata['MNEMONIC'];

			$individual12 = mysqli_query($dbc,"SELECT * FROM t24customertable where (`MNEMONIC`='$CUSTOMERNUMBER')");
			$individual12data=mysqli_fetch_array($individual12);
	
			$mobileNumber = $individual12data['TEL_MOBILE'];
			
			
            //$name2 = $accountndata['group_name'];
			//$image = $personal_details['cust_image'];
			 $name = $transactiondata['name'];

			
			 $approval_Status = $transactiondata['approval_Status'];



            $balance = $transactiondata['balance'];
            $totalsaving = $transactiondata['totalsaving'];
            $totalwithdrawal = $transactiondata['totalwithdrawal'];
            $interest = $transactiondata['interest'];
			
			$status = $transactiondata['status'];
            $date=date("Y-m-d");
            //$dateOfTransaction = $transactiondata['date_of_transaction'];
            $narration = $transactiondata['narration'];
			
			$zone = $transactiondata['zone'];
			
			$officer = $transactiondata['officer'];
			
			$accountcurrency = $transactiondata['currency'];
			
			
			
			$accounttype = $transactiondata['accounttype'];
			
			$PRODUCT_CATEGORY = $transactiondata['PRODUCT_CATEGORY'];
			
			
			
			
			$qsearch = mysqli_query($dbc,"SELECT * from withdrawal_limit order by ids DESC limit 1");
$dataq = mysqli_fetch_assoc($qsearch);

$tt_offline_amount_all=$dataq['tt_offline_amount_all']/100;
$tt_offline_amount_aut=$dataq['tt_offline_amount_aut']/100;

$allowedbyteller=$balance*$tt_offline_amount_all;

$requiredauth=$balance*$tt_offline_amount_aut;
       
			
			
	$t24databasecheck = mysqli_query($dbc,"SELECT * FROM t24snapaccounts where (`@ID`='$account_number_main')");
			$t24databasecheckdata=mysqli_fetch_array($t24databasecheck);
	
			$ONLINE_ACTUAL_BAL = $t24databasecheckdata['ONLINE_ACTUAL_BAL'];
			
			$snappcurrency = $t24databasecheckdata['CURRENCY'];		
			
			
			
			
			
			//search charges on account
			$charges = mysqli_query($dbc,"SELECT * FROM accountcharges where categorycode='$accounttype'");
			$chargesdata=mysqli_fetch_array($charges);
	
			$chargeamount = $chargesdata['chargeamount'];
			//$accounttype = $chargesdata['accounttype'];
			
	
			//search account category balance
			$categorycodetype = mysqli_query($dbc,"SELECT * FROM accountcodes where codenumer='$accounttype'");
			$categorycodetypedata=mysqli_fetch_array($categorycodetype);
	
			$categorybalance = $categorycodetypedata['balance'];
			$codename = $categorycodetypedata['codename'];
			
			$openingbalance = $categorycodetypedata['openingbalance'];
			$debitmovement = $categorycodetypedata['debitmovement'];
			$creditmovement = $categorycodetypedata['creditmovement'];
			$closingbalance = $categorycodetypedata['closingbalance'];
			
			$t24accountnumber=$transactiondata['t24accountnumber'];
			
			

//financial accounting
			$COA = $categorycodetypedata['COA'];
			
			$account_group=$categorycodetypedata['account_group'];
			
			$ledger_line=$categorycodetypedata['account_group'];
			
			
			$categorycodetypeCOA = mysqli_query($dbc,"SELECT * FROM coa_table where coa_code='$COA'");
			$categorycodetypedataCOA=mysqli_fetch_array($categorycodetypeCOA);
	
			$coatotal_balance = $categorycodetypedataCOA['total_balance'];

			$coa_code = $categorycodetypedataCOA['coa_code'];



			$account_group_qr = mysqli_query($dbc,"SELECT * FROM `account_ledger` where `ledger_line`='$ledger_line'");
$account_group_qr_data=mysqli_fetch_array($account_group_qr);

$account_group_balance = $account_group_qr_data['credit_amount'];

$account_ledger_name = $account_group_qr_data['account_ledger_name'];

$opening_balance = $account_group_qr_data['opening_balance'];
$COMPANY_ledger = $account_group_qr_data['COMPANY'];
$branch_code = $account_group_qr_data['branch_code'];
$debit_amount = $account_group_qr_data['debit_amount'];
$ledger_no = $account_group_qr_data['ledger_no'];
$account_type_1 = $account_group_qr_data['account_type_1'];
$account_type_2 = $account_group_qr_data['account_type_2'];


$ledger_closing_balance = $account_group_qr_data['closing_balance'];

$account_group_id = $account_group_qr_data['ids'];	
		
		
		
	$narration2="by $name";
	
		$debitaccount=$account_number_main;
		$creditaccount=$telleraccounts;
	
        $new=$balance-$amount+$chargeamount;
		$totalwithdrawal=$amount+$totalwithdrawal;
		
		$balance1=$new;

	//check if their is connection to the remote server	

$newcategorybalance=$categorybalance+$amount;

$openingbalance =$categorybalance;
$debitmovementnew =$debitmovement+$amount;



$coa_totals=$coatotal_balance+$amount;

$groupacc_totals=$account_group_balance+$amount;

//$ledger_closing_balance=$ledger_closing_balance+$amount;

$closing_balance=$ledger_closing_balance+$amount;


		
		
		
$assetnarration="$narration by $name";
		
$categorybalanceupdate = mysqli_query($dbc,"UPDATE `accountcodes` SET `balance` ='$newcategorybalance',`openingbalance`='$openingbalance',`debitmovement` = '$debitmovementnew',`closingbalance` = '$newcategorybalance'  WHERE `codenumer` = '$loanType';");
		
$categorybalanceupdatecoa = mysqli_query($dbc,"UPDATE `coa_table` SET `total_balance` ='$coa_totals'  WHERE `coa_code` = '$COA';");

$categorybalanceupdateaccgroup = mysqli_query($dbc,"UPDATE `account_ledger` SET `debit_amount` ='$groupacc_totals',`closing_balance` ='$closing_balance',`opening_balance`='$ledger_closing_balance'  WHERE `ledger_line` = '$account_group';");

	
		

$assetandliabilityledger = "INSERT INTO `ledger_journal`(`logged_by`,`account_ledger_name`,`opening_balance`,`timestamp`, `datecreated`,`transaction_type`,`COMPANY`, `branch_code`, `coa_code`, `debit_amount`, `credit_amount`, `closing_balance`, `ledger_line`, `ledger_no`, `account_type_1`, `account_type_2`,`corresponding_ledger`) VALUES ('$username1','$account_ledger_name', '$ledger_closing_balance','$timestamp', '$date', 'DR','$COMPANY_ledger','$branch_code', '$coa_code','$amount','0','$closing_balance','$ledger_line','$ledger_no','$account_type_1','$account_type_2','$corresponding_ledger')";
$assetandliabilitydataledger = mysqli_query($dbc,$assetandliabilityledger);



	
	
		
		
		$assetandliability = "INSERT INTO assetandliability(`line`,`description`,`openingbalance`,`debitmovement`,`creditmovement`,`closingbalance`,`date`,`narration`)
		VALUES ('$loanType','$codename', '$categorybalance', '$amount','0', '$newcategorybalance', '$date', '$assetnarration')";
        $assetandliabilitydata = mysqli_query($dbc,$assetandliability);
		
		

		


		
		//teller cash update
		
		$telleramountnew=$tellercash + $amount;
		//echo $telleramountnew;
		
		
		$tellercashdupdate = mysqli_query($dbc,"UPDATE `tellers` SET `amount` = '$telleramountnew'  WHERE `till` = '$tillnumber';");
		
		
		$tellertransaction = "INSERT INTO tellertransactions (`telleraccount`, `tellername`, `debit`, `credit`, `till`, `customername`, `transactionid`) 
		VALUES ('$debitaccount','$username1', '0', '$amount','$tillnumber', '$name', '$transactionid')";
        $tellertransactiondata = mysqli_query($dbc,$tellertransaction);
		
		
		
		
		
		//transactions jounal update with the creditted interest
		
		$jounal = "INSERT INTO jounal (`description`, `credit`, `user`, `date`) 
		VALUES ('Income from withdrawal from $name Transaction ', '$chargeamount', '$username1','$date')";
        		
		$jounaldata = mysqli_query($dbc,$jounal);
		
		
		
		
		$ofs = "INSERT INTO ofs (`date`,`narration1`, `narration2`, `amount`, `debitaccount`, `creditaccount`, `transactionid`, `status`) 
		VALUES ('$date','$narration1', '$narration2', '$amount','$debitaccount', '$creditaccount', '$transactionid', 'authorized')";
        
		$ofsdata = mysqli_query($dbc,$ofs);
		
		
		 $acq = "INSERT INTO savings(`id`,`group_id`,`withdrawal`, `deposit`, `narration`, `date`, `balance`, `totalsaving`, `totalwithdrawal`, `interest`, `tellername`, `customername`, `transactionid`, `status`, `zone`, `officer`,`cashaccountnumber`,`Units`,`Denomination`,`t24accountnumber`,`DEPOSIT_NO`,`COMPANY`) 
		VALUES ('$account_number_main','$account_number_main','$amount', '0', '$narration1','$date1', '$new', '$totalsaving', '$totalwithdrawal', '$interest', '$username1', '$name', '$transactionid', 'authorized','$zone','$officer','$telleraccounts','$unit','$denom','$t24accountnumber','$DEPOSIT_NO','$activbranch_name')";
        		
		$acr = mysqli_query($dbc,$acq);
		
		
		
		
		
		
		
		//$link='<p class=" h4 alert alert-success" role="alert">Transaction Successfuly Executed<br></p> ';
		
		//WITHDRAWAL TRANSACTION RESPONSE
		//$link='<center><p class=" h4 alert alert-success" role="alert">Transaction Successfuly Executed Transaction ID is.<b> '.$transactionid.'</b> </center></p>';
		
	
      $applicant = mysqli_query($dbc,"UPDATE `transactions` SET `balance` = '$new', `date` = '$date1', `totalsaving` = '$totalsaving', `totalwithdrawal` = '$totalwithdrawal', `narration` ='$narration1'  WHERE (`id` = '$account_number_main' OR `t24accountnumber`='$account_number_main');");
		
		

$ac = mysqli_query($dbc,$applicant);






}




function debit_ledger_account($account_number_main,$dbc,$amount,$username1,$transactionid,$narration,$ledger_account,$corresponding_ledger){
	

global $account_number_main,$dbc,$amount,$username1,$transactionid,$narration,$ledger_account,$corresponding_ledger;

$narration1="$narration";


$date1=date("Y-m-d");
		
$date=date("Y-m-d");

$timestamp=date("Y-m-d H:i:s");		
			
//search for account product code 

$transaction = mysqli_query($dbc,"SELECT * FROM transactions where `id`='$account_number_main'");
$transactiondata=mysqli_fetch_array($transaction);
				
	
$accounttype = $transactiondata['accounttype'];
			





$categorycodetype = mysqli_query($dbc,"SELECT * FROM accountcodes where codenumer='$accounttype'");
			$categorycodetypedata=mysqli_fetch_array($categorycodetype);
	
			$ledger_line=$categorycodetypedata['account_group'];
			

	
			

if($corresponding_ledger==''){

$accounttype=$categorycodetypedata['account_group'];

}else{

$accounttype ="$corresponding_ledger";

}	
			
			
			
//search ledger details


$account_group_qr = mysqli_query($dbc,"SELECT * FROM `account_ledger` where `ledger_line`='$ledger_account'");
$account_group_qr_data=mysqli_fetch_array($account_group_qr);

$credit_amount = $account_group_qr_data['credit_amount'];
$debit_amount = $account_group_qr_data['debit_amount'];

$ledger_closing_balance = $account_group_qr_data['closing_balance'];

$account_ledger_name = $account_group_qr_data['account_ledger_name'];

$opening_balance = $account_group_qr_data['opening_balance'];

$COMPANY_ledger = $account_group_qr_data['COMPANY'];
$branch_code = $account_group_qr_data['branch_code'];

$ledger_no = $account_group_qr_data['ledger_no'];
$account_type_1 = $account_group_qr_data['account_type_1'];
$account_type_2 = $account_group_qr_data['account_type_2'];

$coa_code=$account_group_qr_data['coa_code'];



$account_group_id = $account_group_qr_data['ids'];	
		
$totaldebitbalance=$debit_amount+$amount;

$closing_balance=$ledger_closing_balance+$amount;


//$categorybalanceupdateaccgroup = mysqli_query($dbc,"UPDATE `account_ledger` SET `debit_amount` ='$totaldebitbalance',`closing_balance` ='$closing_balance',`opening_balance`='$ledger_closing_balance'  WHERE `ledger_line` = '$ledger_account';");



$categorybalanceupdateaccgroup = mysqli_query($dbc,"UPDATE `account_ledger` SET `debit_amount` ='$totaldebitbalance',`closing_balance` ='$closing_balance'  WHERE `ledger_line` = '$ledger_account';");


//check if their is connection to the remote server	

			
$categorycodetypeCOA = mysqli_query($dbc,"SELECT * FROM coa_table where coa_code='$coa_code'");
$categorycodetypedataCOA=mysqli_fetch_array($categorycodetypeCOA);

$coatotal_balance = $categorycodetypedataCOA['total_balance'];

$coa_code = $categorycodetypedataCOA['coa_code'];


$narration2="by $name";




$coa_totals =$coatotal_balance+$amount;

$groupacc_totals =$account_group_balance+$amount;

	

$categorybalanceupdatecoa = mysqli_query($dbc,"UPDATE `coa_table` SET `total_balance` ='$coa_totals'  WHERE `coa_code` = '$coa_code';");


	//$accounttype
	
$assetandliabilityledger = "INSERT INTO `ledger_journal`(`logged_by`,`account_ledger_name`,`opening_balance`,`timestamp`, `datecreated`,`transaction_type`,`COMPANY`, `branch_code`, `coa_code`, `debit_amount`, `credit_amount`, `closing_balance`, `ledger_line`, `ledger_no`, `account_type_1`, `account_type_2`,`corresponding_ledger`,`description`) VALUES ('$username1','$account_ledger_name', '$ledger_closing_balance','$timestamp', '$date', 'DR','$COMPANY_ledger','$branch_code', '$coa_code','$amount','0','$closing_balance','$ledger_account','$ledger_no','$account_type_1','$account_type_2','$accounttype','$narration1')";

$assetandliabilitydataledger = mysqli_query($dbc,$assetandliabilityledger);


		
		
$assetandliability = "INSERT INTO assetandliability(`line`,`description`,`openingbalance`,`debitmovement`,`creditmovement`,`closingbalance`,`date`,`narration`) VALUES ('$loanType','$codename','$categorybalance', '$amount','0', '$newcategorybalance', '$date', '$assetnarration')";

$assetandliabilitydata = mysqli_query($dbc,$assetandliability);
		

}		
		
//end debit account 





//start credit account	




function credit_ledger_account($account_number_main,$dbc,$amount,$username1,$transactionid,$narration,$ledger_account,$corresponding_ledger){
	

global $account_number_main,$dbc,$amount,$username1,$transactionid,$narration,$ledger_account,$corresponding_ledger;

$narration1="$narration";


$date1=date("Y-m-d");
		
$date=date("Y-m-d");

$timestamp=date("Y-m-d H:i:s");		
			
			

$transaction = mysqli_query($dbc,"SELECT * FROM transactions where `id`='$account_number_main'");
$transactiondata=mysqli_fetch_array($transaction);
				
	
$accounttype = $transactiondata['accounttype'];
			

$categorycodetype = mysqli_query($dbc,"SELECT * FROM accountcodes where codenumer='$accounttype'");
			$categorycodetypedata=mysqli_fetch_array($categorycodetype);
	
			$ledger_line=$categorycodetypedata['account_group'];
			

	
			

if($corresponding_ledger==''){

$accounttype=$categorycodetypedata['account_group'];

}else{

$accounttype ="$corresponding_ledger";

}
			
			
			
//search ledger details


$account_group_qr = mysqli_query($dbc,"SELECT * FROM `account_ledger` where `ledger_line`='$ledger_account'");
$account_group_qr_data=mysqli_fetch_array($account_group_qr);

$credit_amount = $account_group_qr_data['credit_amount'];
$debit_amount = $account_group_qr_data['debit_amount'];

$ledger_closing_balance =$account_group_qr_data['closing_balance'];

$account_ledger_name = $account_group_qr_data['account_ledger_name'];

$opening_balance = $account_group_qr_data['opening_balance'];

$COMPANY_ledger = $account_group_qr_data['COMPANY'];
$branch_code = $account_group_qr_data['branch_code'];

$ledger_no = $account_group_qr_data['ledger_no'];
$account_type_1 = $account_group_qr_data['account_type_1'];
$account_type_2 = $account_group_qr_data['account_type_2'];

$coa_code=$account_group_qr_data['coa_code'];



$account_group_id = $account_group_qr_data['ids'];	
		
//$totaldebitbalance=$credit_amount-$amount;

//$totaldebitbalance=($credit_amount-$amount);

$closing_balance=$ledger_closing_balance-$amount;


//$categorybalanceupdateaccgroup = mysqli_query($dbc,"UPDATE `account_ledger` SET `credit_amount` =`credit_amount`+'$amount',`closing_balance`='`closing_balance`-$amount',`opening_balance`='$ledger_closing_balance'  WHERE `ledger_line` = '$ledger_account';");




$categorybalanceupdateaccgroup = mysqli_query($dbc,"UPDATE `account_ledger` SET `credit_amount`=`credit_amount`+'$amount',`closing_balance`=`closing_balance`-'$amount'  WHERE `ledger_line` = '$ledger_account';");


//check if their is connection to the remote server	

			
$categorycodetypeCOA = mysqli_query($dbc,"SELECT * FROM coa_table where coa_code='$coa_code'");
$categorycodetypedataCOA=mysqli_fetch_array($categorycodetypeCOA);

$coatotal_balance = $categorycodetypedataCOA['total_balance'];

$coa_code = $categorycodetypedataCOA['coa_code'];


$narration2="by $name";




$coa_totals =$coatotal_balance-$amount;

$groupacc_totals =$account_group_balance-$amount;

	

$categorybalanceupdatecoa = mysqli_query($dbc,"UPDATE `coa_table` SET `total_balance` ='$coa_totals'  WHERE `coa_code` = '$coa_code';");


	
	//$accounttype
 $assetandliabilityledger = "INSERT INTO `ledger_journal`(`logged_by`,`account_ledger_name`,`opening_balance`,`timestamp`, `datecreated`,`transaction_type`,`COMPANY`, `branch_code`, `coa_code`, `credit_amount`, `debit_amount`, `closing_balance`, `ledger_line`, `ledger_no`, `account_type_1`, `account_type_2`,`corresponding_ledger`,`description`) VALUES ('$username1','$account_ledger_name','$ledger_closing_balance','$timestamp', '$date', 'CR','$COMPANY_ledger','$branch_code', '$coa_code','$amount','0','$closing_balance','$ledger_account','$ledger_no','$account_type_1','$account_type_2','$accounttype','$narration1')";
$assetandliabilitydataledger = mysqli_query($dbc,$assetandliabilityledger);









		
		
$assetandliability = "INSERT INTO assetandliability(`line`,`description`,`openingbalance`,`debitmovement`,`creditmovement`,`closingbalance`,`date`,`narration`) VALUES ('$loanType','$codename','$categorybalance', '$amount','0', '$closing_balance', '$date','$assetnarration')";

$assetandliabilitydata = mysqli_query($dbc,$assetandliability);
		

}		
	







//end credit account 	


//get profile image
function get_user_profile_pic($user_id, $dbc){
	
	global $user_id, $dbc;
	$q = "select name,username,profile_pic from users where `user_id`='$user_id' or `username`='$user_id'";
	$res = mysqli_query($dbc, $q);
	$user_data = mysqli_fetch_array($res); 
	
	$editpics = $user_data['profile_pic'];
	
if($editpics!=''){
					
$profilepic="<img src='profilepics/$editpics' height='128' width='128' class='mr-2 avatar-sm rounded-circle'/>";
				
				}else{
					
$profilepic="<img src='images/logo.png' class='mr-2 avatar-sm rounded-circle'  width='128' height='128' />";
				}
					
					
return $profilepic;


}//end function 







//get profile image
function get_user_user_assigned_tasks($user_id, $dbc){
	
	global $user_id, $dbc;
	$q = "select count(*) as allissues from heritagecompaintdetails_users where `user_id`='$user_id'";
	$res = mysqli_query($dbc, $q);
	$user_data = mysqli_fetch_array($res); 
	
	$allissues = $user_data['allissues'];
	
$issuesassignedtemp="
<div class='mt-3'>
<h6 class='text-uppercase'>Total Assigned Tickets<span class='float-right'>$allissues</span></h6>
<div class='progress progress-sm m-0'>
	<div class='progress-bar bg-success' role='progressbar' aria-valuenow='$allissues' aria-valuemin='0' aria-valuemax='100' style='width: $allissues%'>
		<span class='sr-only'>$allissues Assigned</span>
	</div>
</div>
</div>";

					
					
return $issuesassignedtemp;


}




function check_sla_status($issue_id){
	
global $user_id, $dbc,$issue_id;
							
$todaysdate=date("Y/m/d H:i:s"); 
	
//2022/08/10 03:21:15 issue_id
	
//$q = "select count(*) as allissues from heritagecompaintdetails_users where `user_id`='$user_id'";
//$q = "select * from helpdeskissuelogged where `status` !='Close'";

$q = "select * from `helpdeskissuelogged` where `issue_id`='$issue_id'";

$res = mysqli_query($dbc, $q);
	//$user_data = mysqli_fetch_assoc($res); 
	
while($user_data = mysqli_fetch_assoc($res)){
	
$issue_log_date=$user_data['issue_log_date'];
	
$start_date = new DateTime("$issue_log_date");
$since_start = $start_date->diff(new DateTime("$todaysdate"));

echo "<br>--------------------------<br>";
/* echo $since_start->days.' days total<br>';
echo $since_start->y.' years<br>';
echo $since_start->m.' months<br>';
echo $since_start->d.' days<br>';
echo $since_start->h.' hours<br>';
echo $since_start->i.' minutes<br>';
echo $since_start->s.' seconds<br>';	
 */
//style='background-color:#BDB76B;color:#ffffff;'
//echo "TICKET SLA";

echo "<table class='table table-sm'>
        <tr>
            <th>SLA TABLE</th>
            <th>NUMBER</th>
          
        </tr>
		<tr>
            <td>Seconds</td>
            <td>$since_start->s</td>
        </tr>
		
		<tr>
            <td>Minutes</td>
            <td>$since_start->i</td>
        </tr>
		
		<tr>
            <td>Hours</td>
            <td>$since_start->h</td>
        </tr>
		
		<tr>
            <td>Days</td>
            <td>$since_start->d</td>
        </tr>
		
		<tr>
            <td>Months</td>
            <td>$since_start->m</td>
        </tr>
		
		<tr>
            <td>Years</td>
            <td>$since_start->y</td>
        </tr>
		
		
		
		
		
</table>";



	
echo "<br>*************************<br>";	
	
	
	
	
	//echo "$issue_log_date<br>";
	
	//print_r($user_data);
	
	//$allissues = $user_data['allissues'];	
	
}




	
}



function close_vrs_openned_status($user_id, $dbc){
	
global $dbc,$user_id,$dbc;	


$assignedloop1=mysqli_query($dbc,"SELECT `issue_log_date`,`status`,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='PENDING' AND `assigned_to`='$user_id') AS PENDING,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='Close' AND `assigned_to`='$user_id') AS Close,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='Open' AND `assigned_to`='$user_id' ) AS Open1,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='Resolved' AND `assigned_to`='$user_id' ) AS Resolved,(SELECT COUNT(*) FROM helpdeskissuelogged where `assigned_to`='$user_id') AS totalissues FROM helpdeskissuelogged group by `issue_log_date`");


$assignedloop1data = mysqli_fetch_assoc($assignedloop1);

//$Closeservicecountsloop1=$Closedataserviceloop1['COUNT(*)']; assigned_to

$Closeassiged=$assignedloop1data['Close'];
$Openassiged=$assignedloop1data['Open1'];
$PENDINGassiged=$assignedloop1data['PENDING'];

$totalassiged=$assignedloop1data['totalissues'];

$Resolvedassiged=$assignedloop1data['Resolved'];












$Closeserviceloop1=mysqli_query($dbc,"SELECT `issue_log_date`,`status`,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='PENDING') AS PENDING,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='Close') AS Close,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='Open') AS Open1,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='Resolved') AS Resolved,(SELECT COUNT(*) FROM helpdeskissuelogged) AS totalissues FROM helpdeskissuelogged group by `issue_log_date`"); 


$Closedataserviceloop1 = mysqli_fetch_assoc($Closeserviceloop1);

//$Closeservicecountsloop1=$Closedataserviceloop1['COUNT(*)'];

$Close=$Closedataserviceloop1['Close'];
$Open=$Closedataserviceloop1['Open1'];
$PENDING=$Closedataserviceloop1['PENDING'];

$total=$Closedataserviceloop1['totalissues'];

$Resolved=$Closedataserviceloop1['Resolved'];

$total=$Closedataserviceloop1['totalissues'];
$total=$Closedataserviceloop1['totalissues'];

$unresolved=$Open+$PENDING;
//$Closeservicecountsdata1 .="$Closeservicecountsloop1,";

							
echo "<div class='col-lg-3 col-md-4 col-sm-5 col-xs-12'>
						
					

<div class='panel card-view bg-blue'>


<div class='panel-wrapper collapse in'>
<div class='panel-body row pa-0'>
<div class='sm-data-box'>
<div class='container-fluid'>


<div class='row'>

<div class='col-xs-3 text-center pl-0 pr-0 data-wrap-left txt-light'>
<span class='weight-500 uppercase-font block'>Total Pending</span>
<a href='customerlistactive.php?pg=Open'><span class='block counter'><span class='counter-anim'>$PENDING</span></span></a>
</div>






<div class='col-xs-3 text-center  pl-0 pr-0 data-wrap-right txt-light'>
<span class='weight-500 uppercase-font block'>Total Closed</span>
<a href='customerlistactive.php?pg=Close'><span class='block counter'><span class='counter-anim data-wrap-right'>$Close</span></span></a>
</div>


<div class='col-xs-3 text-center  pl-0 pr-0 data-wrap-right txt-light'>
<span class='weight-500 uppercase-font block'>Total Resolved</span>
<a href='customerlistactive.php?pg=Resolved'><span class='block counter'><span class='counter-anim data-wrap-right'>$Resolved</span></span></a>
</div>


<div class='col-xs-3 text-center  pl-0 pr-0 data-wrap-right txt-light'>
<span class='weight-500 uppercase-font block'>Total Openned</span>
<a href='customerlistactive.php?pg=Open'><span class='block counter'><span class='counter-anim data-wrap-right'>$Open</span></span></a>
</div>


</div>									

</div>
</div>
</div>
</div>



</div>

				
<div class='panel card-view'>
<div class='panel-heading small-panel-heading relative'>
<div class='pull-left'>
<h6 class='panel-title'>All issues</h6>
</div>
<div class='clearfix'></div>
<div class='head-overlay'></div>
</div>		
<div class='panel-wrapper collapse in'>
<div class='panel-body row pa-0'>
<div class='sm-data-box'>
<div class='container-fluid'>
<div class='row'>
<div class='col-xs-6 text-center pl-0 pr-0 data-wrap-left'>
<span class='block'><i class='zmdi zmdi-trending-up txt-success font-18 mr-5'></i><span class='weight-500 uppercase-font'>Total</span></span>
<a href='customerlistactive.php'><span class='txt-dark block counter'><span class='counter-anim'>$total</span></span></a>
</div>
<div class='col-xs-6 text-center  pl-0 pr-0 data-wrap-right'>
<div id='sparkline_4' class='sp-small-chart' ></div>
</div>
</div>	
</div>
</div>
</div>
</div>
</div>
<div class='panel panel-default card-view'>
<div class='panel-heading'>
<div class='pull-left'>
<h6 class='panel-title txt-dark'>My Stats</h6>
</div>
<div class='clearfix'></div>
</div>
<div class='panel-wrapper collapse in'>
<div class='panel-body row'>
<div class=''>
<div class='pl-15 pr-15 mb-15'>
<div class='pull-left'>
<i class='zmdi zmdi-collection-folder-image inline-block mr-10 font-16'></i>
<span class='inline-block txt-dark'>Total Assigned</span>
</div>	
<span class='inline-block txt-warning pull-right weight-500'>$totalassiged</span>
<div class='clearfix'></div>
</div>


<hr class='light-grey-hr mt-0 mb-15'/>
<div class='pl-15 pr-15 mb-15'>
<div class='pull-left'>
<i class='zmdi zmdi-format-list-bulleted inline-block mr-10 font-16'></i>
<span class='inline-block txt-dark'>Openned Tickets</span>
</div>	
<span class='inline-block txt-danger pull-right weight-500'> $Openassiged</span>
<div class='clearfix'></div>
</div>



<hr class='light-grey-hr mt-0 mb-15'/>
<div class='pl-15 pr-15 mb-15'>
<div class='pull-left'>
<i class='zmdi zmdi-format-list-bulleted inline-block mr-10 font-16'></i>
<span class='inline-block txt-dark'>Tickets Pending</span>
</div>	
<span class='inline-block txt-danger pull-right weight-500'> $PENDINGassiged</span>
<div class='clearfix'></div>
</div>

<hr class='light-grey-hr mt-0 mb-15'/>
<div class='pl-15 pr-15 mb-15'>
<div class='pull-left'>
<i class='zmdi zmdi-ticket-star inline-block mr-10 font-16'></i>
<span class='inline-block txt-dark'>Tickets Resolved</span>
</div>	
<span class='inline-block txt-primary pull-right weight-500'> $Resolvedassiged</span>
<div class='clearfix'></div>
</div>

<hr class='light-grey-hr mt-0 mb-15'/>


<div class='pl-15 pr-15 mb-15'>
<div class='pull-left'>
<i class='zmdi zmdi-ticket-star inline-block mr-10 font-16'></i>
<span class='inline-block txt-dark'>Closed Tickets</span>
</div>	
<span class='inline-block txt-primary pull-right weight-500'> $Closeassiged</span>
<div class='clearfix'></div>
</div>



</div>
</div>
</div>
</div>
</div>";


	
}





















function get_account_category($id, $dbc){
	$q = "select DESCRIPTION from t24categories where `@ID` = '$id'";
	$res = mysqli_query($dbc, $q);
	$cat_data = mysqli_fetch_array($res); 
	return $cat_data['DESCRIPTION'];
}
			
		
	
	
function close_vrs_masloc_status($domicile_branch, $dbc){
	
global $dbc,$domicile_branch,$dbc;	


$assignedloop1=mysqli_query($dbc,"SELECT `other_status`,`status`,(SELECT COUNT(*) FROM group_loans where  `other_status`='Submitted' AND `COMPANY`='$user_id') AS Submitted,(SELECT COUNT(*) FROM group_loans where  `other_status`='Sanctioned' AND `assigned_to`='$domicile_branch') AS Close,(SELECT COUNT(*) FROM group_loans where  `status`='Open' AND `assigned_to`='$domicile_branch' ) AS Open1,(SELECT COUNT(*) FROM group_loans where  `status`='Resolved' AND `assigned_to`='$domicile_branch' ) AS Resolved,(SELECT COUNT(*) FROM group_loans where `assigned_to`='$domicile_branch') AS totalissues FROM group_loans group by `issue_log_date`");


$assignedloop1data = mysqli_fetch_assoc($assignedloop1);

//$Closeservicecountsloop1=$Closedataserviceloop1['COUNT(*)']; assigned_to

$Sanctioned=$assignedloop1data['Sanctioned'];
$Openassiged=$assignedloop1data['Open1'];
$Submitted=$assignedloop1data['Submitted'];

$totalassiged=$assignedloop1data['totalissues'];

$Resolvedassiged=$assignedloop1data['Resolved'];












$Closeserviceloop1=mysqli_query($dbc,"SELECT `issue_log_date`,`status`,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='PENDING') AS PENDING,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='Close') AS Close,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='Open') AS Open1,(SELECT COUNT(*) FROM helpdeskissuelogged where  `status`='Resolved') AS Resolved,(SELECT COUNT(*) FROM helpdeskissuelogged) AS totalissues FROM helpdeskissuelogged group by `issue_log_date`"); 


$Closedataserviceloop1 = mysqli_fetch_assoc($Closeserviceloop1);

//$Closeservicecountsloop1=$Closedataserviceloop1['COUNT(*)'];

$Close=$Closedataserviceloop1['Close'];
$Open=$Closedataserviceloop1['Open1'];
$PENDING=$Closedataserviceloop1['PENDING'];

$total=$Closedataserviceloop1['totalissues'];

$Resolved=$Closedataserviceloop1['Resolved'];

$total=$Closedataserviceloop1['totalissues'];
$total=$Closedataserviceloop1['totalissues'];

$unresolved=$Open+$PENDING;
//$Closeservicecountsdata1 .="$Closeservicecountsloop1,";

							
echo "<div class='col-lg-3 col-md-4 col-sm-5 col-xs-12'>
						
					

<div class='panel card-view bg-blue'>


<div class='panel-wrapper collapse in'>
<div class='panel-body row pa-0'>
<div class='sm-data-box'>
<div class='container-fluid'>


<div class='row'>

<div class='col-xs-3 text-center pl-0 pr-0 data-wrap-left txt-light'>
<span class='weight-500 uppercase-font block'>Total Pending</span>
<a href='customerlistactive.php?pg=Open'><span class='block counter'><span class='counter-anim'>$PENDING</span></span></a>
</div>






<div class='col-xs-3 text-center  pl-0 pr-0 data-wrap-right txt-light'>
<span class='weight-500 uppercase-font block'>Total Closed</span>
<a href='customerlistactive.php?pg=Close'><span class='block counter'><span class='counter-anim data-wrap-right'>$Close</span></span></a>
</div>


<div class='col-xs-3 text-center  pl-0 pr-0 data-wrap-right txt-light'>
<span class='weight-500 uppercase-font block'>Total Resolved</span>
<a href='customerlistactive.php?pg=Resolved'><span class='block counter'><span class='counter-anim data-wrap-right'>$Resolved</span></span></a>
</div>


<div class='col-xs-3 text-center  pl-0 pr-0 data-wrap-right txt-light'>
<span class='weight-500 uppercase-font block'>Total Openned</span>
<a href='customerlistactive.php?pg=Open'><span class='block counter'><span class='counter-anim data-wrap-right'>$Open</span></span></a>
</div>


</div>									

</div>
</div>
</div>
</div>



</div>

				
<div class='panel card-view'>
<div class='panel-heading small-panel-heading relative'>
<div class='pull-left'>
<h6 class='panel-title'>All issues</h6>
</div>
<div class='clearfix'></div>
<div class='head-overlay'></div>
</div>		
<div class='panel-wrapper collapse in'>
<div class='panel-body row pa-0'>
<div class='sm-data-box'>
<div class='container-fluid'>
<div class='row'>
<div class='col-xs-6 text-center pl-0 pr-0 data-wrap-left'>
<span class='block'><i class='zmdi zmdi-trending-up txt-success font-18 mr-5'></i><span class='weight-500 uppercase-font'>Total</span></span>
<a href='customerlistactive.php'><span class='txt-dark block counter'><span class='counter-anim'>$total</span></span></a>
</div>
<div class='col-xs-6 text-center  pl-0 pr-0 data-wrap-right'>
<div id='sparkline_4' class='sp-small-chart' ></div>
</div>
</div>	
</div>
</div>
</div>
</div>
</div>
<div class='panel panel-default card-view'>
<div class='panel-heading'>
<div class='pull-left'>
<h6 class='panel-title txt-dark'>My Stats</h6>
</div>
<div class='clearfix'></div>
</div>
<div class='panel-wrapper collapse in'>
<div class='panel-body row'>
<div class=''>
<div class='pl-15 pr-15 mb-15'>
<div class='pull-left'>
<i class='zmdi zmdi-collection-folder-image inline-block mr-10 font-16'></i>
<span class='inline-block txt-dark'>Total Assigned</span>
</div>	
<span class='inline-block txt-warning pull-right weight-500'>$totalassiged</span>
<div class='clearfix'></div>
</div>


<hr class='light-grey-hr mt-0 mb-15'/>
<div class='pl-15 pr-15 mb-15'>
<div class='pull-left'>
<i class='zmdi zmdi-format-list-bulleted inline-block mr-10 font-16'></i>
<span class='inline-block txt-dark'>Openned Tickets</span>
</div>	
<span class='inline-block txt-danger pull-right weight-500'> $Openassiged</span>
<div class='clearfix'></div>
</div>



<hr class='light-grey-hr mt-0 mb-15'/>
<div class='pl-15 pr-15 mb-15'>
<div class='pull-left'>
<i class='zmdi zmdi-format-list-bulleted inline-block mr-10 font-16'></i>
<span class='inline-block txt-dark'>Tickets Pending</span>
</div>	
<span class='inline-block txt-danger pull-right weight-500'> $Submitted</span>
<div class='clearfix'></div>
</div>

<hr class='light-grey-hr mt-0 mb-15'/>
<div class='pl-15 pr-15 mb-15'>
<div class='pull-left'>
<i class='zmdi zmdi-ticket-star inline-block mr-10 font-16'></i>
<span class='inline-block txt-dark'>Tickets Resolved</span>
</div>	
<span class='inline-block txt-primary pull-right weight-500'> $Resolvedassiged</span>
<div class='clearfix'></div>
</div>

<hr class='light-grey-hr mt-0 mb-15'/>


<div class='pl-15 pr-15 mb-15'>
<div class='pull-left'>
<i class='zmdi zmdi-ticket-star inline-block mr-10 font-16'></i>
<span class='inline-block txt-dark'>Closed Tickets</span>
</div>	
<span class='inline-block txt-primary pull-right weight-500'> $Closeassiged</span>
<div class='clearfix'></div>
</div>



</div>
</div>
</div>
</div>
</div>";


	
}





global $sytem_id,$dbc;
function displayEmails($dbc,$sytem_id) {
	global $sytem_id,$dbc;
    $output = '';
    $q = "SELECT * FROM emails WHERE `issue_id`='$sytem_id'";
    $res = mysqli_query($dbc, $q);
    while ($unsent_data = mysqli_fetch_array($res)) {
        $id = $unsent_data['id'];
        $email_subject = $unsent_data['subject'];
        $received_on = $unsent_data['received_on'];
        $email_to = $unsent_data['receiver'];
        $issue_id = $unsent_data['issue_id'];
        $message = $unsent_data['message'];

        // Uncomment the line below if you want to update the status to 'sent'
        // mysqli_query($dbc, "UPDATE emails SET status = 'sent' WHERE id = '$id'");

        $output .= "<li>
                        <div class='col-mail col-mail-1'>
                            <div class='checkbox-wrapper-mail'>
                                <input type='checkbox' id='chk$id'>
                                <label for='chk$id' class='toggle'></label>
                            </div>

                            <span class='star-toggle far fa-star text-warning'></span>
                            <a href='emailcomposebody.php?id=$id' class='title'>$email_to</a>
                        </div>
                        <div class='col-mail col-mail-2'>
                            <a href='emailcomposebody.php?id=$id' class='subject'>$email_subject&nbsp;&ndash;&nbsp;
                                <span class='teaser'>&gt; $email_subject</span>
                            </a>
                            <div class='date'>$received_on</div>
                        </div>
                    </li>";
    }
    return $output;

}





function displayEvents($dbc,$sytem_id) {
	global $sytem_id,$dbc;
    $output = '';
    $q = "SELECT * FROM sales_events WHERE `entity_id`='$sytem_id'";
    $res = mysqli_query($dbc, $q);
    while ($unsent_data = mysqli_fetch_array($res)) {
        $id = $unsent_data['id'];
        $email_subject = $unsent_data['subject'];
        $eventLocation = $unsent_data['eventLocation'];
        $eventTitle = $unsent_data['eventTitle'];
        $eventDate = $unsent_data['eventDate'];
        $status = $unsent_data['status'];
		
		
//INSERT INTO `sales_events`(`ids`, `logged_by`, `tablename`, `applicationtype`, `application_name`, `status`, `sytem_id`, `timestamp`, `datecreated`, `channel`, `eventDescription`, `eventDate`, `eventTime`, `eventLocation`, `eventOrganizer`)


        // Uncomment the line below if you want to update the status to 'sent'
        // mysqli_query($dbc, "UPDATE emails SET status = 'sent' WHERE id = '$id'");

        $output .= "<li>
                        <div class='col-mail col-mail-1'>
                      <table><tr><td><b>Event Name</b></td><td><b>Event Date</b></td><td><b>Status</b></td></tr>
					  <tr><td>$eventTitle</td><td>$eventDate</td><td> $status</td></tr>
					  </table>
                      <i class='fas fa-calendar-plus fa-sm' style='color:green'></i>      
                    
                        </div>
                    </li>";
    }
    return $output;

}




function displayTask($dbc,$sytem_id) {
	global $sytem_id,$dbc;
    $output = '';
   $q = "SELECT * FROM sales_task WHERE `entity_id`='$sytem_id'";
    $res = mysqli_query($dbc, $q);
    while ($unsent_data = mysqli_fetch_array($res)) {
        $id = $unsent_data['id'];
        $callsubject = $unsent_data['callsubject'];
        $taskDescription = $unsent_data['taskDescription'];
        $eventTitle = $unsent_data['eventTitle'];
        $eventDate = $unsent_data['eventDate'];
       
		
		
//INSERT INTO `sales_events`(`ids`, `logged_by`, `tablename`, `applicationtype`, `application_name`, `status`, `sytem_id`, `timestamp`, `datecreated`, `channel`, `eventDescription`, `eventDate`, `eventTime`, `eventLocation`, `eventOrganizer`)


        // Uncomment the line below if you want to update the status to 'sent'
        // mysqli_query($dbc, "UPDATE emails SET status = 'sent' WHERE id = '$id'"); callsubject

        $output .= "<li class='event' data-date=''>
                        <h3>$callsubject $eventDate</h3>
						<p>$taskDescription </p>
                    </li>";
    }
    return $output;

}








function showOpportunities($dbc,$sytem_id) {
	global $sytem_id,$dbc;
    $output = '';
   $q = "SELECT * FROM `sales_opportunity` WHERE `entity_id`='$sytem_id' limit 3";
    $res = mysqli_query($dbc, $q);
    while ($unsent_data = mysqli_fetch_array($res)) {
        $id = $unsent_data['id'];
        $opportunityName = $unsent_data['opportunityName'];
        $Stage = $unsent_data['Stage'];
        $endDate = $unsent_data['endDate'];
        $amount = $unsent_data['amount'];
        $status = $unsent_data['status'];
		
		
//INSERT INTO `sales_opportunity`(`ids`, `logged_by`, `tablename`, `applicationtype`, `application_name`, `event_status`, `entity_id`, `opportunityName`, `contactPerson`, `email`, `phone`, `description`, `opportunityType`, `status`, `startDate`, `endDate`, `amount`, `notes`, `timestamp`, `datecreated`, `channel`, `sytem_id`, `Stage`)

        // Uncomment the line below if you want to update the status to 'sent'
        // mysqli_query($dbc, "UPDATE emails SET status = 'sent' WHERE id = '$id'");

        $output .= "
                        <div class='col-mail col-mail-1'>
                      <table>
					  <tr><td><b><h5><u>$opportunityName</u></h5></b></td></tr>
					  
					  <tr><td><b>Stage</b></td><td><b>$Stage</b></td></tr>
					  <tr><td>Amount</td><td>$amount</td></tr>
					   <tr><td>End Date</td><td>$endDate</td></tr>
					  
					  </table>
                    
                    
                        </div>
                    ";
    }
    return $output;

}




function getStatusColor($status) {
    switch ($status) {
        case 'New':
            $color = '#FF0000'; // Red
            break;
        case 'Open':
            $color = '#FFA500'; // Orange
            break;
        case 'Pending':
            $color = '#FFFF00'; // Yellow
            break;
        case 'Closed':
            $color = '#008000'; // Green
            break;
        case 'Resolved':
            $color = '#0000FF'; // Blue
            break;
        default:
            $color = '#808080'; // Grey for unknown status
            break;
    }

    echo "<label style='background-color: $color; padding: 5px; color: white; border-radius: 5px;'>$status</label>";
}


function geCalltStatus($status) {
    switch ($status) {
        case 'Answered':
            $color = '#28a745'; // Green
            break;
        case 'Busy':
            $color = '#dc3545'; // Red
            break;
        case 'No Answer':
            $color = '#ffc107'; // Yellow
            break;
        case 'Unavailable':
            $color = '#6c757d'; // Grey
            break;
        case 'Wrong Number':
            $color = '#17a2b8'; // Blue
            break;
        case 'Left Voice Message':
            $color = '#007bff'; // Light Blue
            break;
        case 'Moving Forward':
            $color = '#20c997'; // Light Green
            break;
        default:
            $color = '#343a40'; // Dark Grey for unknown status
            break;
    }

    echo "<a class='dropdown-toggle' href='javascript:void(0);' data-bs-toggle='dropdown' style='background-color: $color;' aria-expanded='false'>$status</a>";
	
	
}



function logXmlMessage($message, $logFilePath) {
    // Get the current timestamp
    $currentDateTime = date('Y-m-d H:i:s');
$currentDateTimelog=date('Ymd');
$logFilePath="$logFilePath$currentDateTimelog";
    // Format the log message with XML and timestamp
    $logEntry = "[$currentDateTime]--> $message\n <br>";
//$logFilePath="bmslogs\\";
    // Append the log message to the file bmslogs\
    file_put_contents($logFilePath, $logEntry, FILE_APPEND);
}



function generateEthixToken($dbc){
global $dbc;

$curl = curl_init();
//172.32.254.23
curl_setopt_array($curl, array(
  //CURLOPT_URL => 'https://aspd.zenithbank.com.gh/EthixDirect/api/v1/User/Authenticate',
  //CURLOPT_URL =>'https://172.32.254.23/ethixdirect/api/v1/User/Authenticate',
  CURLOPT_URL => 'https://172.19.0.119/ethixdirect/api/v1/User/Authenticate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "userName": "T24",
  "password": "UupcpH6UIakp2jsc"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($curl);

curl_close($curl);

//echo $response;

$tokengenerated=json_decode($response, true);
//return $tokengenerated;
	
return $tokennew=$tokengenerated['data']['token'];
	
	
//print_r($tokengenerated);
}


function extractAmount($amountWithCurrency) {
    // Use preg_replace to remove everything except digits and the decimal point
    $amount = preg_replace("/[^0-9.]/", "", $amountWithCurrency);
    return $amount;
}





function extractEthixTransferResponse($jsonResponse) {
    // Decode the JSON response into an associative array
    $response = json_decode($jsonResponse, true);

    // Check if the response is valid and has the required fields
    if (isset($response['status'], $response['message'], $response['data'])) {
        $status = $response['status'];
        $message = $response['message'];
        $description = $response['data']['description'];
        $clientReference = $response['data']['clientReference'];
        $transId = $response['data']['transId'];
        $phoenixTransId = $response['data']['phoenixTransId'];

        // Return the extracted details in an array
        return [
            'status' => $status,
            'message' => $message,
            'description' => $description,
            'clientReference' => $clientReference,
            'transId' => $transId,
            'phoenixTransId' => $phoenixTransId
        ];
    } else {
        // Return null or an empty array if the response is invalid
        return null;
    }
}




function formatDatetoEthix($date) {
    return DateTime::createFromFormat('Ymd', $date)->format('Y-m-d');
}



