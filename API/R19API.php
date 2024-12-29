
<?php
//include("connection.php");


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




function tafjr19api_teller($ip,$port,$jbossuser,$command,$jbosspassword,$tablename,$dbc,$CUSTOMERID){
	global $requestID,$channelCode,$hash,$allagent,$data,$ip,$port,$jbossuser,$command,$jbosspassword,$tablename,$dbc,$CUSTOMERID;
	global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname,$CUSTOMERID,$myspliter;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$dbc,$branchcodeid;

	
$data = array(
    'ofsRequest'=>"$command",
   
); 

$data_string = json_encode($data);                                                                                   
//$url="http://13.91.36.180:5000/ams/index.php/oss/api/$allagent";
//$url="http://13.91.36.180:5000/ams/index.php/oss/api/$allagent";
//$url="http://172.19.1.98:8085/TAFJRestServices/resources/ofs";
echo $url="http://$ip:$port/TAFJRestServices/resources/ofs";

//base64_encode("user:password")
$username1="$jbossuser";
$password1="$jbosspassword";
//$url="http://13.91.36.180:5000/ams/index.php/api/transaction/$allagent"; dGFmanVzZXI6UGFzc3dvcmRAMQ==  
//SU5MQUtTOklubGFrc0AxMjM=                                                                                                           
$ch = curl_init($url);                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                       


curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json', 
    'Authorization: Basic '.base64_encode("$username1:$password1"),                                                                               
    'Content-Length: ' . strlen($data_string))                                                                       
);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


/*curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json', 
    "Authorization: Basic dGFmanVzZXI6QWRtaW5AMTIz",                                                                               
    'Content-Length: ' . strlen($data_string))                                                                       
);  

*/  

                                                                                                                     
$result = curl_exec($ch);

curl_close($ch);


//var_dump($result);

//echo "why sdsdsd";
$data = json_decode($result, TRUE);

//$data=file_get_contents("textfile.txt");

 $agent_array_response =$data; // Replace ... with your PHP Array textfile.txt
  
 $agent_array_response= $agent_array_response['ofsResponse'];
 
 
 //var_dump($agent_array_response);
 
 

$myspliter=explode('/',$agent_array_response);


return $agent_array_response;












}//end of fucntion





function unitybank_token($ip,$port,$jbossuser,$command,$jbosspassword,$tablename,$dbc,$CUSTOMERID){
	global $requestID,$channelCode,$hash,$allagent,$data;
	global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname,$CUSTOMERID;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$dbc,$branchcodeid;

	


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://unityapitest.unitybankng.com/UnityCRMSAPI/api/CRMS/Login',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "username": "crmsapi",
  "password": "pa$$word"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: incap_ses_6547_2976646=TBsPA44GZgqAkWwlQp7bWugeCGUAAAAA40+rR0PwvXfLwL2cycSb8w==; visid_incap_2976646=SIc1l4qGSZeQJjQIXNIVQ+vjAGUAAAAAQUIPAAAAAADpylQQOlM5EMrwzgE+dwSh'
  ),
));

$response = curl_exec($curl);

$data = json_decode($response);

$token = $data->token;
curl_close($curl);
return $token;




}//end function





function tafjr19api_customer_unitybank($token,$accountNumber,$tablename,$dbc){
	global $requestID,$channelCode,$hash,$allagent,$data;
	global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname,$CUSTOMERID,$token,$accountNumber,$tablename,$dbc;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$dbc,$branchcodeid;

	


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://unityapitest.unitybankng.com/UnityCRMSAPI/api/CRMS/GetCustomerDetails',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "Nuban": "'.$accountNumber.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
        'Authorization: Bearer '.$token,
        'Cookie: incap_ses_6547_2976646=T+59Bd5O4m6s3UclQp7bWr4BCGUAAAAAUhk8ajmUndNQ+89EZFULZQ==; visid_incap_2976646=SIc1l4qGSZeQJjQIXNIVQ+vjAGUAAAAAQUIPAAAAAADpylQQOlM5EMrwzgE+dwSh'
  ),
));

$response = curl_exec($curl);

curl_close($curl);



return $response;






}//end function






function insertData_unitybank($json, $mysqli) {
    // Decode JSON data
	global $mysqli;
    
	$data = json_decode($json);

    // Prepare the SQL statement
    $stmt = $mysqli->prepare("INSERT INTO accounts (
        customerName, firstName, middleName, lastName, phoneNo, email, address, 
        bvn, gender, currency, accountStatus, customerType, accountTier, dob, 
        branchName, tin, rcNo, ussdInfo, success, responseCode, responseMessage
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param(
        "ssssssssssssssssssbis",
        $data->accountDetails->customerName,
        $data->accountDetails->firstName,
        $data->accountDetails->middleName,
        $data->accountDetails->lastName,
        $data->accountDetails->phoneNo,
        $data->accountDetails->email,
        $data->accountDetails->address,
        $data->accountDetails->bvn,
        $data->accountDetails->gender,
        $data->accountDetails->currency,
        $data->accountDetails->accountStatus,
        $data->accountDetails->customerType,
        $data->accountDetails->accountTier,
        $data->accountDetails->dob,
        $data->accountDetails->branchName,
        $data->accountDetails->tin,
        $data->accountDetails->rcNo,
        $data->accountDetails->ussdInfo,
        $data->success,
        $data->responseCode,
        $data->responseMessage
    );

    // Execute the statement
    if ($stmt->execute()) {
        //return "Data inserted successfully!";
    } else {
        return "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}





function insertData_unitybankmain($json, $dbc,$cust_id) {
    // Decode JSON data
	
	global $dbc,$json,$cust_id;
    $data = json_decode($json, true);

    $accountDetails = $data['accountDetails'];
	
	
	
	
	
//$CRMDATApsl =mysqli_query($dbc,"INSERT INTO `psl.customer`(`SHORT_NAME`,`E_MAIL_ADDRESS`,`TEL_MOBILE`,`@ID`,`customer_id`,`EMAIL_1`,`PHONE_1`,`GENDER`,`COMPANY`,`CURR_ADDRESS`,`BIRTH_INCORP_DATE`) VALUES('{$accountDetails['customerName']}','{$accountDetails['email']}','{$accountDetails['phoneNo']}','$cust_id','$cust_id','{$accountDetails['email']}','{$accountDetails['phoneNo']}','{$accountDetails['gender']}','{$accountDetails['branchName']}','{$accountDetails['address']}','{$accountDetails['dob']}')");
	
	$CRMDATApsl = mysqli_query($dbc, "
    INSERT INTO `psl.customer`(
        `SHORT_NAME`, 
        `E_MAIL_ADDRESS`, 
        `TEL_MOBILE`, 
        `@ID`, 
        `customer_id`, 
        `EMAIL_1`, 
        `PHONE_1`, 
        `GENDER`, 
        `COMPANY`, 
        `CURR_ADDRESS`, 
        `BIRTH_INCORP_DATE`
    ) VALUES (
        '{$accountDetails['customerName']}',
        '{$accountDetails['email']}',
        '{$accountDetails['phoneNo']}',
        '$cust_id',
        '$cust_id',
        '{$accountDetails['email']}',
        '{$accountDetails['phoneNo']}',
        '{$accountDetails['gender']}',
        '{$accountDetails['branchName']}',
        '{$accountDetails['address']}',
        '{$accountDetails['dob']}'
    )
    ON DUPLICATE KEY UPDATE 
        `SHORT_NAME` = '{$accountDetails['customerName']}',
        `E_MAIL_ADDRESS` = '{$accountDetails['email']}',
        `TEL_MOBILE` = '{$accountDetails['phoneNo']}',
        `EMAIL_1` = '{$accountDetails['email']}',
        `PHONE_1` = '{$accountDetails['phoneNo']}',
        `GENDER` = '{$accountDetails['gender']}',
        `COMPANY` = '{$accountDetails['branchName']}',
        `CURR_ADDRESS` = '{$accountDetails['address']}',
        `BIRTH_INCORP_DATE` = '{$accountDetails['dob']}'
");





//$CRMDATApslnew =mysqli_query($dbc,"INSERT INTO `brainbox_customer`(`SHORT_NAME`,`EMAIL_1`,`SMS_1`,`@ID`,`FLD_CU`,`PHONE_1`,`GENDER`,`COMPANY_BOOK`,`ADDRESS`,`BIRTH_INCORP_DATE`,`BVN`) VALUES('{$accountDetails['customerName']}','{$accountDetails['email']}','{$accountDetails['phoneNo']}','$cust_id','$cust_id','{$accountDetails['phoneNo']}','{$accountDetails['gender']}','{$accountDetails['branchName']}','{$accountDetails['address']}','{$accountDetails['dob']}','{$accountDetails['bvn']}')");
	
	$CRMDATApslnew = mysqli_query($dbc, "
    INSERT INTO `brainbox_customer`(
        `SHORT_NAME`, 
        `EMAIL_1`, 
        `SMS_1`, 
        `@ID`, 
        `FLD_CU`, 
        `PHONE_1`, 
        `GENDER`, 
        `COMPANY_BOOK`, 
        `ADDRESS`, 
        `BIRTH_INCORP_DATE`, 
        `BVN`
    ) VALUES (
        '{$accountDetails['customerName']}',
        '{$accountDetails['email']}',
        '{$accountDetails['phoneNo']}',
        '$cust_id',
        '$cust_id',
        '{$accountDetails['phoneNo']}',
        '{$accountDetails['gender']}',
        '{$accountDetails['branchName']}',
        '{$accountDetails['address']}',
        '{$accountDetails['dob']}',
        '{$accountDetails['bvn']}'
    )
    ON DUPLICATE KEY UPDATE 
        `SHORT_NAME` = '{$accountDetails['customerName']}',
        `EMAIL_1` = '{$accountDetails['email']}',
        `SMS_1` = '{$accountDetails['phoneNo']}',
        `PHONE_1` = '{$accountDetails['phoneNo']}',
        `GENDER` = '{$accountDetails['gender']}',
        `COMPANY_BOOK` = '{$accountDetails['branchName']}',
        `ADDRESS` = '{$accountDetails['address']}',
        `BIRTH_INCORP_DATE` = '{$accountDetails['dob']}',
        `BVN` = '{$accountDetails['bvn']}'
");

	
	
	
	
	
	$sql = "INSERT INTO unityaccounts (
        customerName, firstName, middleName, lastName, phoneNo, email, address, 
        bvn, gender, currency, accountStatus, customerType, accountTier, dob, 
        branchName, tin, rcNo, ussdInfo, success, responseCode, responseMessage,accountnumber
    ) VALUES (
        '{$accountDetails['customerName']}',
        '{$accountDetails['firstName']}',
        '{$accountDetails['middleName']}',
        '{$accountDetails['lastName']}',
        '{$accountDetails['phoneNo']}',
        '{$accountDetails['email']}',
        '{$accountDetails['address']}',
        '{$accountDetails['bvn']}',
        '{$accountDetails['gender']}',
        '{$accountDetails['currency']}',
        '{$accountDetails['accountStatus']}',
        '{$accountDetails['customerType']}',
        '{$accountDetails['accountTier']}',
        '{$accountDetails['dob']}',
        '{$accountDetails['branchName']}',
        '{$accountDetails['tin']}',
        '{$accountDetails['rcNo']}',
        '{$accountDetails['ussdInfo']}',
        '{$data['success']}',
        '{$data['responseCode']}',
        '{$data['responseMessage']}',
		'$cust_id'
    )
    ON DUPLICATE KEY UPDATE 
        customerName = '{$accountDetails['customerName']}',
        firstName = '{$accountDetails['firstName']}',
        middleName = '{$accountDetails['middleName']}',
        lastName = '{$accountDetails['lastName']}',
        phoneNo = '{$accountDetails['phoneNo']}',
        email = '{$accountDetails['email']}',
        address = '{$accountDetails['address']}',
        bvn = '{$accountDetails['bvn']}',
        gender = '{$accountDetails['gender']}',
        currency = '{$accountDetails['currency']}',
        accountStatus = '{$accountDetails['accountStatus']}',
        customerType = '{$accountDetails['customerType']}',
        accountTier = '{$accountDetails['accountTier']}',
        dob = '{$accountDetails['dob']}',
        branchName = '{$accountDetails['branchName']}',
        tin = '{$accountDetails['tin']}',
        rcNo = '{$accountDetails['rcNo']}',
        ussdInfo = '{$accountDetails['ussdInfo']}'";
	
	

/* $sql = "INSERT INTO unityaccounts (
        customerName, firstName, middleName, lastName, phoneNo, email, address, 
        bvn, gender, currency, accountStatus, customerType, accountTier, dob, 
        branchName, tin, rcNo, ussdInfo, success, responseCode, responseMessage,accountnumber
    ) VALUES (
        '{$accountDetails['customerName']}',
        '{$accountDetails['firstName']}',
        '{$accountDetails['middleName']}',
        '{$accountDetails['lastName']}',
        '{$accountDetails['phoneNo']}',
        '{$accountDetails['email']}',
        '{$accountDetails['address']}',
        '{$accountDetails['bvn']}',
        '{$accountDetails['gender']}',
        '{$accountDetails['currency']}',
        '{$accountDetails['accountStatus']}',
        '{$accountDetails['customerType']}',
        '{$accountDetails['accountTier']}',
        '{$accountDetails['dob']}',
        '{$accountDetails['branchName']}',
        '{$accountDetails['tin']}',
        '{$accountDetails['rcNo']}',
        '{$accountDetails['ussdInfo']}',
        '{$data['success']}',
        '{$data['responseCode']}',
        '{$data['responseMessage']}',
		'$cust_id'
    )"; */

    if (mysqli_query($dbc,$sql)) {
        return "Data inserted successfully!";
		
		
		
		




    } else {
        return "Error: " . mysqli_error($dbc);
    }



//echo "INSERT INTO `brainbox_customer`(`SHORT_NAME`,`EMAIL_1`,`SMS_1`,`@ID`,`FLD_CU`,`EMAIL_1`,`PHONE_1`,`GENDER`,`COMPANY_BOOK`,`ADDRESS`,`BIRTH_INCORP_DATE`) VALUES('{$accountDetails['customerName']}','{$accountDetails['email']}','{$accountDetails['phoneNo']}','{$accountDetails['bvn']}','{$accountDetails['bvn']}','{$accountDetails['email']}','{$accountDetails['phoneNo']}','{$accountDetails['gender']}','{$accountDetails['branchName']}','{$accountDetails['address']}','{$accountDetails['dob']}')<br>";



//echo "<br>INSERT INTO `psl.customer`(`SHORT_NAME`,`E_MAIL_ADDRESS`,`TEL_MOBILE`,`@ID`,`customer_id`,`EMAIL_1`,`PHONE_1`,`GENDER`,`COMPANY`,`CURR_ADDRESS`,`BIRTH_INCORP_DATE`) VALUES('{$accountDetails['customerName']}','{$accountDetails['email']}','{$accountDetails['phoneNo']}','{$accountDetails['bvn']}','{$accountDetails['bvn']}','{$accountDetails['email']}','{$accountDetails['phoneNo']}','{$accountDetails['gender']}','{$accountDetails['branchName']}','{$accountDetails['address']}','{$accountDetails['dob']}')";








}









global $data;
function tafjr19api($ip,$port,$jbossuser,$command,$jbosspassword,$tablename,$dbc,$CUSTOMERID){
	
	
	global $requestID,$channelCode,$hash,$allagent,$data;
	global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname,$CUSTOMERID;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$dbc,$branchcodeid;

	
$data = array(
    'ofsRequest'=>"$command",
   
); 


$data_string = json_encode($data);                                                                                   

ECHO $url="http://$ip:$port/TAFJRestServices/resources/ofs";

//base64_encode("user:password")
$username1="$jbossuser";
$password1="$jbosspassword";
//$url="http://13.91.36.180:5000/ams/index.php/api/transaction/$allagent"; dGFmanVzZXI6UGFzc3dvcmRAMQ==  
//SU5MQUtTOklubGFrc0AxMjM=                                                                                                           
$ch = curl_init($url);                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                       


curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json', 
    'Authorization: Basic '.base64_encode("$username1:$password1"),                                                                               
    'Content-Length: ' . strlen($data_string))                                                                       
);

                                                                                                                     
$result = curl_exec($ch);

curl_close($ch);


//var_dump($result);

//echo "why sdsdsd";
$data = json_decode($result, TRUE);

 $agent_array_response =$data; // Replace ... with your PHP Array textfile.txt
  
 $agent_array_response= $agent_array_response['ofsResponse'];
 
 
 //var_dump($agent_array_response);
 
 

$myspliter=explode(',"',$agent_array_response);

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

	//echo "<br>INSERT INTO `$tablename`($tablefieldsforinsert`CUSTOMERID`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE $forupdate_values <br>";
//closed_accounts($ACCOUNT_NUMBER,$Bankcode);

//echo "<br>INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE $forupdate_values<br>";


//echo "<br>INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'','') ON DUPLICATE KEY UPDATE $forupdate_values<br>";
$CRMDATA3 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE $forupdate_values");

	 	  
$CRMDATA =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values)");
	
$CRMDATA1 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'','') ON DUPLICATE KEY UPDATE $forupdate_values");
			 
		  
  }//end of for loop
 //end of for loop
 


}//end function











function tafjr19api_customer($ip,$port,$jbossuser,$command,$jbosspassword,$tablename,$dbc,$CUSTOMERID){
	global $requestID,$channelCode,$hash,$allagent,$data;
	global $logo,$valuedata,$crmd,$keys1,$id,$t24serviceurl,$T23branchcode,$enquiryname,$fieldname,$CUSTOMERID;	

global $ACCOUNTNUMBER,$t24serviceurl,$ip,$port,$t24username,$t24password,$enquiry,$response,$dbc,$branchcodeid;

	
$data = array(
    'ofsRequest'=>"$command",
   
); 

$data_string = json_encode($data);                                                                                   

 $url="http://$ip:$port/TAFJRestServices/resources/ofs";

//base64_encode("user:password")
$username1="$jbossuser";
$password1="$jbosspassword";
//$url="http://13.91.36.180:5000/ams/index.php/api/transaction/$allagent"; dGFmanVzZXI6UGFzc3dvcmRAMQ==  
//SU5MQUtTOklubGFrc0AxMjM=                                                                                                           
$ch = curl_init($url);                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                       


curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json', 
    'Authorization: Basic '.base64_encode("$username1:$password1"),                                                                               
    'Content-Length: ' . strlen($data_string))                                                                       
);

                                                                                                                     
$result = curl_exec($ch);

curl_close($ch);


//var_dump($result);

//echo "why sdsdsd";
$data = json_decode($result, TRUE);

 $agent_array_response =$data; // Replace ... with your PHP Array textfile.txt
  
 $agent_array_response= $agent_array_response['ofsResponse'];
 
 
 //var_dump($agent_array_response);
 
 

$myspliter=explode(',"',$agent_array_response);

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
/* 	  echo "<br>";
	 print_r($cells);
	echo "<br>";  */   
	  $values = array();
	  
	  $SHORT_NAME = $cells[6];
		//$NAME_1 = $cells['NAME_1']." ".$SHORT_NAME;
		$email = $cells[62];
		
		$LEGAL_ID=$cells[24];

		$telephone = $cells[60];
		
		$sms1 = $cells[58];
		
		$DATE_OF_BIRTH=$cells[52];
		
		$FTNUMBER12=$cells[0];
		
		//$user_type = $cells['user_type'];
		//$user_id = $cells['customer_id'];
		

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
	  //echo $tablefieldsforinsert;
	  $newfieldarray=explode(',',$tablefieldsforinsert);
	  $newfieldarrayvakues=explode(',',$query_values);
	//$newfieldarray2=array_pop($newfieldarray);
	  
	  $newarraycombine=array_combine($newfieldarray,$values);
	  //print_r($newfieldarrayvakues);
	  foreach($newarraycombine as $combinekey=>$combinevalue){
		  $forupdate[]="$combinekey=$combinevalue";
		  //echo "$combinekey=$combinevalue,";
		 // echo "$forupdate";
	  }
	  
	   unset($forupdate['50']);
	 // echo "$forupdate";
	   //print_r($forupdate);
	  
	 //print_r($newarraycombine);
	  
	  $forupdate_values = implode(',',$forupdate);

	//echo "<br>INSERT INTO `$tablename`($tablefieldsforinsert`CUSTOMERID`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE $forupdate_values <br>";
//closed_accounts($ACCOUNT_NUMBER,$Bankcode);

//echo "<br>INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE $forupdate_values<br>";


//echo "<br>INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values) ON DUPLICATE KEY UPDATE $forupdate_values<br>";
//$CRMDATA3 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'') ON DUPLICATE KEY UPDATE $forupdate_values");

//echo "INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values) ON DUPLICATE KEY UPDATE $forupdate_values";
echo "\n<br>INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'','') ON DUPLICATE KEY UPDATE $forupdate_values n\\";
	 	  
$q = mysqli_query($dbc,"SELECT * FROM `$tablename` where `@ID`='$FTNUMBER12'");
$data = mysqli_fetch_assoc($q);
$ETHIXREF=$data['exthixnumber'];
	
if($ETHIXREF==''){
		
echo "<br> Systems number is $ETHIXREF TEST<br>";
	
$CRMDATA =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values)");
	
$CRMDATA1 =mysqli_query($dbc,"INSERT INTO `$tablename`($tablefieldsforinsert`status`) VALUES($query_values,'')");
	
	
}else{


echo "<br> Systems number is $ETHIXREF TEST<br>";
echo "<br>Already procceed<br>";

}

//$CRMDATApsl =mysqli_query($dbc,"INSERT INTO `psl.customer`(`SHORT_NAME`,`E_MAIL_ADDRESS`,`TEL_MOBILE`,`@ID`,`customer_id`,`EMAIL_1`,`PHONE_1`,`LEGAL_ID`,`DATE_OF_BIRTH`) VALUES('$SHORT_NAME','$email','$sms1','$CUSTOMERIDNEW','$CUSTOMERIDNEW','$email','$TEL_MOBILE','$LEGAL_ID','$DATE_OF_BIRTH') ON DUPLICATE KEY UPDATE `EMAIL_1`='$email',`PHONE_1`='$sms1',`LEGAL_ID`='$LEGAL_ID',`SHORT_NAME`='$SHORT_NAME',`DATE_OF_BIRTH`='$DATE_OF_BIRTH'");
	
	//echo "INSERT INTO `psl.customer`(`SHORT_NAME`,`E_MAIL_ADDRESS`,`TEL_MOBILE`,`@ID`,`customer_id`,`EMAIL_1`,`PHONE_1`,`LEGAL_ID`) VALUES('$SHORT_NAME','$email','$sms1','$CUSTOMERIDNEW','$CUSTOMERIDNEW','$email','$TEL_MOBILE','$LEGAL_ID') ON DUPLICATE KEY UPDATE `EMAIL_1`='$email',`PHONE_1`='$sms1',`LEGAL_ID`='$LEGAL_ID',`SHORT_NAME`='$SHORT_NAME'";
	
	//echo "INSERT INTO `psl.customer`(`SHORT_NAME`,`E_MAIL_ADDRESS`,`TEL_MOBILE`,`@ID`,`customer_id`,`EMAIL_1`,`PHONE_1`) VALUES('$SHORT_NAME','$email','$sms1','$CUSTOMERIDNEW','$CUSTOMERIDNEW','$email','$TEL_MOBILE')";
		  
  }//end of for loop
 //end of for loop
 


}//end function













//agentapi($command);








 
 






?>