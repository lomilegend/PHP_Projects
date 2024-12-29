<?php
// Increase execution time and memory limit
ini_set('max_execution_time', 300); // 5 minutes
ini_set('memory_limit', '512M');

include("config/connection.php");
// Check connection $dbc
	print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['data'])) {
 $data = json_decode($_POST['data'], true);
	print_r($data);
    $batchSize = 1000; // Number of rows to insert at a time
    $batchData = [];

$upload_id=random_int(100000000,999999999);

    foreach ($data as $row) {
	
	//	`legalEntityId`, `serviceDefinitionId`, `cif`, `accountId`, `primaryCif`, `phoneNumber`, `phoneCountryCode`, `email`, `country`, `cityName`, `state`, `zipCode`, `addressLine1`, `addressLine2`, `faxId`, `timestamp`, `phoneCountryCodecreated`, `channel`, `sytem_id`, `customerimage`, `contract_status`, `uploadid`, `upload_error`, `upload_id` FROM `infinity_contract` WHERE 1
		
        $legalEntityId = mysqli_real_escape_string($dbc, $row[0]);
        $serviceDefinitionId = mysqli_real_escape_string($dbc, $row[1]);
        $cif = mysqli_real_escape_string($dbc, $row[2]);
        $accountId = mysqli_real_escape_string($dbc, $row[3]);
        $primaryCif = mysqli_real_escape_string($dbc, $row[4]);
        $phoneNumber = mysqli_real_escape_string($dbc, $row[5]);
        $phoneCountryCode = mysqli_real_escape_string($dbc, $row[6]);
        $email = mysqli_real_escape_string($dbc, $row[7]);
        $country = mysqli_real_escape_string($dbc, $row[8]);
	
		$cityName = mysqli_real_escape_string($dbc, $row[9]);
        $state = mysqli_real_escape_string($dbc, $row[10]);
        $zipCode = mysqli_real_escape_string($dbc, $row[11]);
        $addressLine1 = mysqli_real_escape_string($dbc, $row[12]);
		
		$addressLine2 = mysqli_real_escape_string($dbc, $row[13]);
        $faxId = mysqli_real_escape_string($dbc, $row[14]);
        


        $batchData[] = "('$legalEntityId', '$serviceDefinitionId', '$cif', '$accountId', '$primaryCif', '$phoneNumber', '$phoneCountryCode', '$email', '$country','$cityName', '$state', '$zipCode', '$addressLine1', '$addressLine2','$faxId','$upload_id','New')";

        if (count($batchData) >= $batchSize) {
            $sql = "INSERT INTO infinity_contract(legalEntityId, serviceDefinitionId, cif, accountId, primaryCif, phoneNumber, phoneCountryCode, email, country,cityName, state, zipCode, addressLine1, addressLine2, faxId,upload_id,company_status) VALUES " . implode(',', $batchData);
            if (!mysqli_query($dbc, $sql)) {
                echo "Error: " . mysqli_error($dbc);
            }
            $batchData = [];
        }
    }

    // Insert any remaining data
    if (count($batchData) > 0) {
        $sql = "INSERT INTO infinity_contract(legalEntityId, serviceDefinitionId, cif, accountId, primaryCif, phoneNumber, phoneCountryCode, email, country,cityName, state, zipCode, addressLine1, addressLine2, faxId,upload_id,company_status) VALUES " . implode(',', $batchData);
        if (!mysqli_query($dbc, $sql)) {
            echo "Error: " . mysqli_error($dbc);
        }
    }

    echo "File uploaded and data saved successfully";
	
	echo "$data";
	print_r($data);
	echo "<br>";
	echo "$sql";
	echo "<br>";
} else {
    echo "Invalid request";
}

mysqli_close($dbc);
?>

