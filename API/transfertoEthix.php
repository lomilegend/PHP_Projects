<?php 






function makeZenithTransfer($sourceAccount, $destinationAccount, $amount, $effectiveDate, $transferDescription, $reference, $transType, $sourceAccountCcy, $destinationAccountCcy, $tranPostingId, $authToken) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://172.32.254.23/ethixdirect/api/v1/Transfer/ZenithTransfer',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode([
            "sourceAccount" => $sourceAccount,
            "destinationAccount" => $destinationAccount,
            "amount" => $amount,
            "effectiveDate" => $effectiveDate,
            "transferDescription" => $transferDescription,
            "reference" => $reference,
            "transType" => $transType,
            "sourceAccountCcy" => $sourceAccountCcy,
            "destinationAccountCcy" => $destinationAccountCcy,
            "tranPostingId" => $tranPostingId
        ]),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $authToken
        ),
    ));
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}



//$response = makeZenithTransfer($sourceAccount, $destinationAccount, $amount, $effectiveDate, $transferDescription, $reference, $transType, $sourceAccountCcy, $destinationAccountCcy, $tranPostingId, $authToken);

echo $response;
