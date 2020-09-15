<?php
$url_api = "https://api.github.com";
$url_login = "https://github.com/login/oauth/authorize?client_id=d1eef707a6568ef48440";
$curl_url = $url_api;
$curl_token_auth = 'Authorization: token ' . $token;
$ch = curl_init($curl_url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'User-Agent: $username', $curl_token_auth ));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

$response = curl_exec($ch);  
curl_close($ch);
$response = json_decode($response);

return $response;
