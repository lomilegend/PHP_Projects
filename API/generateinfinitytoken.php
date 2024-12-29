
<?php 


function generateToken($dbc) {
global $dbc;

global $t24username,$t24password,$t24serviceurlApplication,$username,$password;
$serversetup = mysqli_query($dbc,"SELECT * FROM infinity_variables where status='Active'");
$serversetupdata=mysqli_fetch_array($serversetup);



$ip=$serversetupdata['ipaddress'];	
$port=$serversetupdata['port'];
$Channels=$serversetupdata['apichannel'];

$T23branchcode=$serversetupdata['branchcode'];

$environment_type=$serversetupdata['environment_type'];



$jbossuser=$serversetupdata['jbossuser'];

$jbosspassword=$serversetupdata['jbosspassword'];




	
	
$url = 'https://100000052.auth.temenos-cloud.net/login';
$headers = array(
'X-Kony-App-Key: 70764519a9128bd37f0401200d8c9c06',
'X-Kony-App-Secret: b0e229b62c79876196fb6706617566b2',
'Content-Type: application/json',
'X-Kony-Reportingparams: ""',
'Cookie: AWSALB=zEDTF48P2jWaQQJyu6fuvI5ZKWN5HftSaWce1PffTIguTe7fWBASODZ34tVuHmPYS8pIG3kgE/AGOKMIRo667XMkLtWLm3LO760WL2GKTA0GFfAfrOmhRpAR3jAZ; AWSALBCORS=zEDTF48P2jWaQQJyu6fuvI5ZKWN5HftSaWce1PffTIguTe7fWBASODZ34tVuHmPYS8pIG3kgE/AGOKMIRo667XMkLtWLm3LO760WL2GKTA0GFfAfrOmhRpAR3jAZ'
);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        curl_close($curl);
        return 'Error: ' . $error_msg;
    }

    curl_close($curl);
   // return $response;
	
	
$tokengenerated=json_decode($response, true);
 
 
 return $tokennew=$tokengenerated['claims_token']['value'];
	
	//print_r($response);
}

// Usage
//echo generateToken();






function createContract($tokennew,$data){
	
//print_r($data);
	
global $tokennew,$data;	

$ids=$data['ids'];

$legalEntityId=$data['legalEntityId'];
$serviceDefinitionId=$data['serviceDefinitionId'];
$cif=$data['cif'];
$accountId=$data['accountId'];

$primaryCif=$data['primaryCif'];
$phoneNumber=$data['phoneNumber'];
$phoneCountryCode=$data['phoneCountryCode'];
$email=$data['email'];

$country=$data['country'];
$cityName=$data['cityName'];
$state=$data['state'];
$zipCode=$data['zipCode'];

$addressLine1=$data['addressLine1'];
$addressLine2=$data['addressLine2'];
$faxId=$data['faxId'];
	
	
    $url = 'https://retailbanking2.temenos-cloud.net/services/DataMigration/CreateContract';
   $payload = json_encode(array(
        "legalEntityId" => "$legalEntityId",
        "serviceDefinitionId" => "$serviceDefinitionId",
        "cifList" => '[{"cif":"'.$cif.'","accounts":[{"accountId":"'.$accountId.'"}]}]',
        "primaryCif" => "$primaryCif",
        "communicationDetails" => '{"communication":[{"phoneNumber":"'.$phoneNumber.'","phoneCountryCode":"'.$phoneCountryCode.'","email":"'.$email.'"}],"address":[{"country":"'.$country.'","cityName":"'.$cityName.'","state":"'.$state.'","zipCode":"'.$zipCode.'","addressLine1":"'.$addressLine1.'","addressLine2":"'.$addressLine2.'"}],"faxId":"'.$faxId.'"}'
    ));
    $headers = array(
        'X-Kony-App-Key: 70764519a9128bd37f0401200d8c9c06',
        'X-Kony-App-Secret: b0e229b62c79876196fb6706617566b2',
        'Content-Type: application/json',
        'X-Kony-Reportingparams: {"os":"119.0.0.0","dm":"","did":"3EE32A0C-5A8D-404B-A655-7C9674EF463E","ua":"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0","chnl":"desktop","plat":"web","aver":"1.0.0","atype":"spa","stype":"b2c","mfaid":"3432b7c6-ec25-4701-b71a-600103aa9b25","mfbaseid":"06f317a7-d81b-40dc-849a-9385dabdef51","sdktype":"js","sessiontype":"I","clientUUID":"1685526859093-22ec-0b15-5fa7","rsid":"1700588101142-84f1-0341-f9f2"}',
        'X-Kony-Authorization: ' . $tokennew
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        curl_close($curl);
        return 'Error: ' . $error_msg;
    }

    curl_close($curl);
    return $response;
}

// Usage
//$tokennew = 'your_token_here'; // Replace with your actual token
//echo createContract($tokennew);





?>