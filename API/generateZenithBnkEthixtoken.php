<?php 

include("config/connection.php");
include("formfunction.php");

error_reporting(0);

// Usage
echo $tokennew = generateEthixToken($dbc);

//print_r(generateEthixToken($dbc));


// Function to read the latest PTID from the file
function getCurrentPtidFromFile($filePath_1) {
    if (file_exists($filePath_1)) {
        $currentPtid = file_get_contents($filePath_1);
        return (int)$currentPtid; // Ensure it's an integer
    }
    return 0; // Default value if file doesn't exist
}

// Function to save the latest PTID to the file
function savePtidToFile($filePath_1, $currentPtid) {
    file_put_contents($filePath_1, $currentPtid); // Save the latest PTID to the file
}

// Function to get the account statement and handle PTID tracking
function getAccountStatement($tokennew, $startDate, $endDate, &$currentPtid, $filePath_1){
    global $tokennew, $startDate, $endDate;

    // Debugging output for dates
    echo $startDate = $startDate;
    echo "<br>";
    echo $endDate = $endDate;

    $curl = curl_init();

    // API call with current PTID
    curl_setopt_array($curl, array(
        //CURLOPT_URL => 'https://172.32.254.23/ethixdirect/api/v1/Account/ClassCodeActivity',
		//CURLOPT_URL => 'https://172.32.254.23/ethixdirect/api/v1/Account/ClassCodeActivity',
		CURLOPT_URL => 'https://172.19.0.119/ethixdirect/api/v1/Account/ClassCodeActivity',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode([
            "ptid" => $currentPtid, // Use the last PTID (initialized as 0 for the first call)
            "startDate" => $startDate,
            "endDate" => $endDate
        ]),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $tokennew
        ),
    ));

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);


    // Execute API call
    $response = curl_exec($curl);
    curl_close($curl);
	
    // Reading the mock response from the local file (simulating an API response)
  /*   $filePath = 'C:\xampp\htdocs\zenithethixs\response_20241211B.json'; // Path to the JSON file
    if (!file_exists($filePath)) {
        echo "Error: File $filePath not found.";
        return null;
    }

    // Get the JSON data from the file
    $response = file_get_contents($filePath);

    // Check if file_get_contents worked
    if ($response === false) {
        echo "Error reading the file $filePath.";
        return null;
    } */

    // Decode response
    $data = json_decode($response, true);

    // Handle the case where the response contains transactions and PTID
    if (isset($data['data']) && !empty($data['data'])) {
        // Find the greatest PTID from the response
        $maxPtid = $currentPtid;
        foreach ($data['data'] as $transaction) {
            if (isset($transaction['ptid']) && $transaction['ptid'] > $maxPtid) {
                $maxPtid = $transaction['ptid']; // Update max PTID
            }
        }
        // Update the global PTID for next request
        $currentPtid = $maxPtid;
    } else {
        echo "No data found in response or no PTID in response.";
    }

    return $data;
}

	$accounts_cedi = array("6010909359", "01-001-1-11396", "6010189233", "6070111117",
        "4011367400", "6110108049","6011908314", "6090101818", "6090105147",
        "6090105724", "6090106649", "6090106968", "6090108189", "6090109932", "6011310508",
        "01-001-1-16416", "6012500580", "6010121396", "6010125200", "6010227739", "6011207685", 
        "6011900267", "6010100032","6010309557","6011321763", "4013008041","6010192439",  
        "4110476631", "4011763879", "6010144256",  "6010126975", "4111104487", "6021305019", 
        "2000412637","9061900664", "4011788669", "9060818393", "01-027-1-16416","4090111250", 
        "4010457856", "6070104013", "01-001-1-42009","9061505844", "6021407520", "4110421357", 
        "4010482639", "4010232862", "4011400099","4011789240", "9062008984", "6011205917", 
        "6010144574", "6020418162","4090107628", "4090125278", "6020147525", "9060114531", 
        "4012730997", "4011385123","4012802089", "4111129226", "9060706447", "6010192439", 
        "6010179874", "6070556178","6012214774", "6010909359", "6011100114", "6010192439" ,"6070100566", "6070101960"
    );

    $accounts_dollar = array("6040100415", "6040172854", "6040186057", "6040180903", "6040167656", 
    "6040170417", "6040180954", "6040146710", "6040180857", "6040146702", "6040170395", "6040146729", 
    "6040170379", "6040170409", "6040170387","01-001-1-11396");



// Function to insert data into the transactions table
	function insertTransaction($dbc, $transaction) {
    $ptid = $transaction['ptid'];
    $credit = $transaction['credit'];
    $debit = $transaction['debit'];
    $accountNumber = trim($transaction['accountNumber']);
	$originTracerNo = $transaction['originTracerNo'];
	$postingDateTime = $transaction['postingDateTime'];
	$amount = $transaction['amount'];
    $tfrAcctNo = $transaction['tfrAcctNo'];
	
	if($originTracerNo == NULL && $debit == 0){
		$change = substr($postingDateTime, 0, 19);
        $originTracerNo = $change.$amount.$accountNumber;
    } elseif($originTracerNo == NULL && $credit == 0){
        $change = substr($postingDateTime, 0, 19);
        $originTracerNo = $change.$amount.$tfrAcctNo;

    }
	
	


    // Define logic for missing account numbers or tfrAcctNo
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
	
	
		    // Define logic for account numbers not on T24
     if (in_array($tfrAcctNo,$accounts_cedi) && $credit == '0') {
        $tfrAcctNo = 'GHS140100001';
        $accountNumber = trim($transaction['accountNumber']);
    } elseif (in_array($tfrAcctNo,$accounts_cedi) && $debit == '0') {
        $accountNumber = 'GHS140050001';
        $tfrAcctNo = trim($transaction['accountNumber']);
    } elseif (in_array($tfrAcctNo,$accounts_cedi) && $credit == '0') {
        $tfrAcctNo = 'USD140100002';
        $accountNumber = trim($transaction['accountNumber']);
    } elseif (in_array($tfrAcctNo,$accounts_cedi) && $debit == '0') {
        $accountNumber = 'USD140050002';
        $tfrAcctNo = trim($transaction['accountNumber']);
    }

    // Escape other fields before inserting into database
    $transactionDetails = mysqli_real_escape_string($dbc, $transaction['transactionDetails']);
    $processingBranch = mysqli_real_escape_string($dbc, $transaction['processingBranch']);
    $tellerName = mysqli_real_escape_string($dbc, $transaction['tellerName']);
    $valueDate = $transaction['valueDate'];
    //$postingDateTime = $transaction['postingDateTime'];
    $effectiveDate = $transaction['effectiveDate'];
    $atmLocation = $transaction['atmLocation'] ? mysqli_real_escape_string($dbc, $transaction['atmLocation']) : NULL;
    //$amount = $transaction['amount'];
    //$originTracerNo = $transaction['originTracerNo'] ? mysqli_real_escape_string($dbc, $transaction['originTracerNo']) : NULL;
    $description = $transaction['description'] ? mysqli_real_escape_string($dbc, $transaction['description']) : NULL;

    // Insert the transaction into the database
    $sql = "INSERT INTO ethixTransaction(ptid, accountNumber, transactionDetails, processingBranch, tellerName, credit, debit, valueDate, postingDateTime, effectiveDate, atmLocation, tfrAcctNo, amount, originTracerNo, description)
            VALUES ('$ptid', '$accountNumber', '$transactionDetails', '$processingBranch', '$tellerName', '$credit', '$debit', '$valueDate', '$postingDateTime', '$effectiveDate', '$atmLocation', '$tfrAcctNo', '$amount', '$originTracerNo', '$description')";

    if (!mysqli_query($dbc, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
    } else {
        echo "Transaction with PTID $ptid inserted successfully.<br>";
    }

}

// Main execution logic
$startDate = date("Y-m-d"); // Use today's date or modify as needed
$endDate = date("Y-m-d");   // Use today's date or modify as needed

// File path to store PTID
$filePath_1 = 'C:\xampp\htdocs\zenithethixs\ptid\ptid.txt'; // Specify the file path for PTID storage

// Initialize PTID from file (if it exists)
$currentPtid = getCurrentPtidFromFile($filePath_1);

// Fetch account statement and process transactions in a loop
for ($i = 0; $i < 5; $i++) {
    echo "Fetching data for PTID: $currentPtid\n";
    $data = getAccountStatement($tokennew, $startDate, $endDate, $currentPtid, $filePath_1);

    // Check if 'data' is present and loop through each transaction to insert into DB
    if (isset($data['data']) && !empty($data['data'])) {
        foreach ($data['data'] as $transaction) {
            insertTransaction($dbc, $transaction);
        }
    } else {
        echo "No data available for PTID: $currentPtid\n";
        break; // Stop if no data is available
    }

    // Save the latest PTID to the file after processing
    savePtidToFile($filePath_1, $currentPtid);
    // Optional: Add a sleep delay if needed to throttle requests
    //sleep(1);
}

echo "<br>";

echo "Final PTID after the loop: $currentPtid\n";

?>