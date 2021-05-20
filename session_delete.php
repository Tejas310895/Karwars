<?php
 
$chatApiToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2MTEzMzUxNjcsInVzZXIiOiI5MTgxNjkwMTY4NTMifQ.Su2flaTpRCph67Rj7njmXeUj6wDkQgLlCQ9NBYN48IY"; // Get it from https://www.phphive.info/255/get-whatsapp-password/
 
$number = "919867765397"; // Number
$message = "Karwars"; // Message
 
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://chat-api.phphive.info/message/send/text',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode(array("jid"=> $number."@s.whatsapp.net", "message" => $message)),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$chatApiToken,
    'Content-Type: application/json'
  ),
));
 
$response = curl_exec($curl);
curl_close($curl);
echo $response;
?>