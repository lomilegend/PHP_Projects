<?php
// Increase execution time and memory limit
ini_set('max_execution_time', 300); // 5 minutes
ini_set('memory_limit', '512M');

include("config/connection.php");
// Check connection $dbc


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['data'])) {
    $data = json_decode($_POST['data'], true);

    $batchSize = 1000; // Number of rows to insert at a time
    $batchData = [];

    foreach ($data as $row) {
        $debit_acct = mysqli_real_escape_string($dbc, $row[0]);
        $crediting_acct = mysqli_real_escape_string($dbc, $row[1]);
        $account_name = mysqli_real_escape_string($dbc, $row[2]);
        $amount = mysqli_real_escape_string($dbc, $row[3]);
        $narration = mysqli_real_escape_string($dbc, $row[4]);
        $rate = mysqli_real_escape_string($dbc, $row[5]);
        $date = mysqli_real_escape_string($dbc, $row[6]);
        $dept = mysqli_real_escape_string($dbc, $row[7]);
        $tran_type = mysqli_real_escape_string($dbc, $row[8]);

        $batchData[] = "('$debit_acct', '$crediting_acct', '$account_name', '$amount', '$narration', '$rate', '$date', '$dept', '$tran_type')";

        if (count($batchData) >= $batchSize) {
            $sql = "INSERT INTO bulkftupload (debit_acct, crediting_acct, account_name, amount, narration, rate, date, dept, tran_type) VALUES " . implode(',', $batchData);
            if (!mysqli_query($dbc, $sql)) {
                echo "Error: " . mysqli_error($dbc);
            }
            $batchData = [];
        }
    }

    // Insert any remaining data
    if (count($batchData) > 0) {
        $sql = "INSERT INTO bulkftupload (debit_acct, crediting_acct, account_name, amount, narration, rate, date, dept, tran_type) VALUES " . implode(',', $batchData);
        if (!mysqli_query($dbc, $sql)) {
            echo "Error: " . mysqli_error($dbc);
        }
    }

    echo "File uploaded and data saved successfully";
} else {
    echo "Invalid request";
}

mysqli_close($dbc);
?>

