<?php




function generateEthixToken($dbc){
global $dbc;

$curl = curl_init();
//172.32.254.23
curl_setopt_array($curl, array(
  //CURLOPT_URL => 'https://aspd.zenithbank.com.gh/EthixDirect/api/v1/User/Authenticate',
  CURLOPT_URL =>'https://172.19.0.119/ethixdirect/api/v1/User/Authenticate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "userName": "T24",
  "password": "UupcpH6UIakp2jsc"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($curl);

curl_close($curl);

//echo $response;

$tokengenerated=json_decode($response, true);
//return $tokengenerated;
	
return $tokennew=$tokengenerated['data']['token'];
	
	
//print_r($tokengenerated);
}



echo generateEthixToken($dbc);

?>