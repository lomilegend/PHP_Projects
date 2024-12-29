
<?php 

include("config/connection.php");

include("formfunction.php");

error_reporting(0);

// Usage
//echo generateToken();





 echo $tokennew=generateEthixToken($dbc);

//print_r(generateEthixToken($dbc));

function getAccountStatement($tokennew,$data,$startDate,$endDate){
	global $tokennew,$data,$startDate,$endDate;
//print_r($data);
echo $startDate=$startDate;
echo "<br>";
echo $endDate=$endDate;

$curl = curl_init();

curl_setopt_array($curl, array(
  //CURLOPT_URL => 'https://aspd.zenithbank.com.gh/ethixdirect/api/v1/Account/ClassCodeActivity',
  //CURLOPT_URL => 'https://172.32.254.23/ethixdirect/api/v1/Account/ClassCodeActivity',
  CURLOPT_URL => 'https://172.19.0.119/ethixdirect/api/v1/Account/ClassCodeActivity',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "ptid":"0",
  "startDate": "'.$startDate.'",
  "endDate": "'.$endDate.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$tokennew.''
  ),
));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($curl);

curl_close($curl);

//$response=file_get_contents('response_20241104.json');

return $response;



}

// Usage
//$tokennew = 'your_token_here'; // Replace with your actual token
//echo createContract($tokennew);



// Function to insert data into the transactions table
function insertTransaction($dbc, $transaction) {
	
	
$ptid = $transaction['ptid'];

$credit = $transaction['credit'];

$debit = $transaction['debit'];

$accountNumber=trim($transaction['accountNumber']);

//$tfrAcctNo = $transaction['tfrAcctNo'] ? mysqli_real_escape_string($dbc, $transaction['tfrAcctNo']) : 'GHS140100001';


//$accountNumber = !empty($transaction['accountNumber']) ? mysqli_real_escape_string($dbc, $transaction['accountNumber']) : 'GHS140050001';



if (empty($transaction['tfrAcctNo']) && $credit == '0') {
    $tfrAcctNo = 'GHS140100001';
    $accountNumber = trim($transaction['accountNumber']);
} elseif (empty($transaction['tfrAcctNo']) && $debit == '0') {
    $accountNumber = 'GHS140050001';
    $tfrAcctNo = trim($transaction['accountNumber']);
} elseif (!empty($transaction['tfrAcctNo']) && $credit == '0') {
    $accountNumber = trim($transaction['accountNumber']);
    $tfrAcctNo = trim($transaction['tfrAcctNo']);
} elseif (!empty($transaction['tfrAcctNo']) && $debit == '0') {
    $accountNumber = trim($transaction['tfrAcctNo']);
    $tfrAcctNo = trim($transaction['accountNumber']);
} 

	
	
	
	
	
	
    $transactionDetails = mysqli_real_escape_string($dbc, $transaction['transactionDetails']);
	
    $processingBranch = mysqli_real_escape_string($dbc, $transaction['processingBranch']);
	
    $tellerName = mysqli_real_escape_string($dbc, $transaction['tellerName']);
	
   
	
    $valueDate = $transaction['valueDate'];
    $postingDateTime = $transaction['postingDateTime'];
    $effectiveDate = $transaction['effectiveDate'];
    $atmLocation = $transaction['atmLocation'] ? mysqli_real_escape_string($dbc, $transaction['atmLocation']) : NULL;
	
	
   
	
    $amount = $transaction['amount'];
    $originTracerNo = $transaction['originTracerNo'] ? mysqli_real_escape_string($dbc, $transaction['originTracerNo']) : NULL;
    $description = $transaction['description'] ? mysqli_real_escape_string($dbc, $transaction['description']) : NULL;

    $sql = "INSERT INTO ethixTransaction(ptid, accountNumber, transactionDetails, processingBranch, tellerName, credit, debit, valueDate, postingDateTime, effectiveDate, atmLocation, tfrAcctNo, amount, originTracerNo, description)
            VALUES ('$ptid', '$accountNumber', '$transactionDetails', '$processingBranch', '$tellerName', '$credit', '$debit', '$valueDate', '$postingDateTime', '$effectiveDate', '$atmLocation', '$tfrAcctNo', '$amount', '$originTracerNo', '$description')";

    if (!mysqli_query($dbc, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
    } else {
        echo "Transaction with PTID $ptid inserted successfully.<br>";
    }
}


//$startDate=date("Y-m-d"); FUNDS.TRANSFER,TRANSFER


//while(1){
	
	
$startDate=date("Y-m-d");
$endDate=date("Y-m-d");

echo $data = json_decode(getAccountStatement($tokennew,$data,$startDate,$endDate), true)['data'];


print_r($data);

// Loop through each transaction and insert it into the database  getAccountStatement($tokennew,$data,$startDate,$endDate)
foreach ($data as $transaction) {
    insertTransaction($dbc, $transaction);
}




//}

//getAccountStatement($tokennew,$data);









?>