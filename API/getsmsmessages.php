<?php


error_reporting(0);

$xmlData=file_get_contents('php://input');

include("config/connection.php");

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











$xmlMessage="$xmlData";

$logFilePath = 'smslogs\smslogs.txt';

logXmlMessage($xmlMessage,$logFilePath);


global $message,$receipient_number,$dbc,$response1;


function sendsmsmessage($message,$receipient_number){
global $message,$receipient_number,$dbc,$response1;
//SELECT `id`, `smsurl`, `smsusername`, `smspassword`, `sendername`, `smsmessage`, `status` FROM `smssetupdetails` WHERE 1

$complaintsquiery=mysqli_query($dbc,"select * from smssetupdetails where status='Active'");

$complaintsquierydata=mysqli_fetch_array($complaintsquiery);
/* $smsurl = $complaintsquierydata['smsurl'];
$smsusername = $complaintsquierydata['smsusername'];
$smspassword = $complaintsquierydata['smspassword'];
$sendername=$complaintsquierydata['sendername'];	 */
$message=strip_tags($message);

	
$ENCODEDMESSAGE=urlencode($message);

$smsurl ="https://sms.nalosolutions.com/smsbackend/clientapi/ANDY_RESL/send-message/";
$smsusername ="Progress";
$smspassword ="12345678";
$sendername="PROGRESS";

//$api ="$smsurl?username=$smsusername&password=$smspassword&destination=$receipient_number&source=brainbox&type=1&dlr=1&message=$ENCODEDMESSAGE";

//echo $api="$smsurl?username=$smsusername&password=$smspassword&destination=$receipient_number&source=$sendername&type=1&dlr=1&message=$ENCODEDMESSAGE";

echo $api="$smsurl?username=$smsusername&password=$smspassword&destination=$receipient_number&source=$sendername&type=1&dlr=1&message=$ENCODEDMESSAGE";

//https://sms.nalosolutions.com/smsbackend/clientapi/ANDY_RESL/send-message/?username=Progress&password=12345678&destination=233544001489&source=PROGRESS&type=1&dlr=1&message=AndrewsOberko%20test

//echo $api="https://sms.arkesel.com/sms/api?action=send-sms&api_key=OjY5VlpIOXNlTjRDejg4NHY=&to=$receipient_number&from=MembersApp&sms=$ENCODEDMESSAGE";
	
$response1=file_get_contents($api);	



}





function getXmlData($url, $xmlData) {
    $headers = array(
        'Content-Type: text/xml',
    );

    // Append the XML data to the URL query string
    $url .= '?' . http_build_query(['data' => $xmlData]);

    $ch = curl_init($url);

    // Set cURL options for GET request
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    // Execute cURL session and get the result MTU5NjIyNTAyMjk3NzQ1NzY
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Return the response
    return $response;
}



function parseXMLData($xmlData) {
	
	global $xmlData;
	
	  // Strip the 'data=' prefix if it exists
    if (strpos($xmlData, 'data=') === 0) {
        $xmlData = substr($xmlData, 5);
    }
    // Load the XML data into a SimpleXMLElement object
    $xml = simplexml_load_string($xmlData);

    // Extract the values
    $data = [
        'api_id' => (string) $xml->sendMsg->api_id,
        'user' => (string) $xml->sendMsg->user,
        'password' => (string) $xml->sendMsg->password,
        'to' => (string) $xml->sendMsg->to,
        'text' => (string) $xml->sendMsg->text,
        'from' => (string) $xml->sendMsg->from,
        'concat' => (string) $xml->sendMsg->concat
    ];

    return $data;
}


function parseMessage($message) {
    $parsedData = [];

    // Use regular expressions to extract the required information
    preg_match('/A\/c No\.: ([^,]+)/', $message, $accountNumberMatch);
    preg_match('/Txn Amt: ([^,]+)/', $message, $txnAmtMatch);
    preg_match('/Txn Date: ([^,]+)/', $message, $txnDateMatch);
    preg_match('/A\/c Balance: ([^,]+)/', $message, $balanceMatch);
    preg_match('/Account (Credited|Debited)/', $message, $accountActionMatch);

    // Store the extracted information in the associative array
    $parsedData['account_number'] = $accountNumberMatch[1] ?? null;
    $parsedData['txn_amt'] = $txnAmtMatch[1] ?? null;
    $parsedData['txn_date'] = $txnDateMatch[1] ?? null;
    $parsedData['balance'] = $balanceMatch[1] ?? null;
    $parsedData['account_action'] = $accountActionMatch[1] ?? null;

    return $parsedData;
}



// Example usage:

//comment out this to disable messages from going out to client
//$url='https://esb.republicghana.com:1984/restgateway/services/T24SMS/t24sms';


//https://esb.republicghana.com:1984/restgateway/services/T24SMS/t24sms

$xmlData ="data=<clickAPI><sendMsg><api_id>t24sms</api_id><user>t24</user><password></password><to>233244686396</to><text>Alert!! GHS-5,000.00 debited from your acct *********0101 , on 12 JUN 2024 at REPUBLIC BANK-HQ by Cheque. Your Bal is GHS-204,470.7</text><from>REPUBLICBNK</from><concat>1</concat></sendMsg></clickAPI>"; 
 

global $xmlData;
$parsedData = parseXMLData($xmlData);


print_r($parsedData);

$message=$parsedData['text'];

$receipient_number=$parsedData['to'];
//sendsmsmessage($message,$receipient_number);






$parsedMessage = parseMessage($message);

// Output the extracted values
echo "<br> Account Number: " . $parsedMessage['account_number'] . "<br>";
echo "Transaction Amount: " . $parsedMessage['txn_amt'] . "<br>";
echo "Transaction Date: " . $parsedMessage['txn_date'] . "<br>";
echo "Account Balance: " . $parsedMessage['balance'] . "<br>";
echo "Account Action: " . $parsedMessage['account_action'] . "<br>";



$response=getXmlData($url,$xmlData);

// Output the response PETama@MST1
echo $response;





$xmlMessage="$response";

$logFilePath = 'smslogs\smslogs.txt';

logXmlMessage($xmlMessage,$logFilePath);




?>

