<?php
// Database connection details

include("../config/connection.php");
// Create a connection
//$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch companies data
$sql = "SELECT ids AS id, company_name, customerimage AS company_image, Phone_1 AS phone, email_Opt_Out AS email, country AS location, ratings AS rating, company_owners AS owner, status FROM sales_company";
$result = mysqli_query($dbc, $sql);

$companies = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Add other necessary fields with default values or transformations
        $row['si_no'] = "";
        $row['select'] = "";
        $row['owner_image'] = "assets/img/profiles/avatar-14.jpg"; // Set default image
        $row['Action'] = "";
        $row['source'] = "Paid Social";
        $row['won_deals'] = "5 Deals, $100000"; // Example values, adjust as needed
        $row['lost_deals'] = "2 Deals, $80000"; // Example values, adjust as needed
        $row['created_date'] = "25 Sep 2023, 01:22 pm"; // Example values, adjust as needed
        $row['tag'] = "0"; // Example value, adjust as needed

        $companies[] = $row;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['data' => $companies]);

// Close the connection
mysqli_close($dbc);
?>
