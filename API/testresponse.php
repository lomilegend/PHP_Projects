<?php
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

// The message string
$message = "PSL Head Office Alert Notification - Account Credited,A/c No.: *********4101,Txn Amt: GHS10000.00,Txn Date: 16 MAY 2024,A/c Balance: GHS95570.00";

// Call the function and get the parsed data
$parsedMessage = parseMessage($message);

// Output the extracted values
echo "Account Number: " . $parsedMessage['account_number'] . "<br>";
echo "Transaction Amount: " . $parsedMessage['txn_amt'] . "<br>";
echo "Transaction Date: " . $parsedMessage['txn_date'] . "<br>";
echo "Account Balance: " . $parsedMessage['balance'] . "<br>";
echo "Account Action: " . $parsedMessage['account_action'] . "<br>";
?>
