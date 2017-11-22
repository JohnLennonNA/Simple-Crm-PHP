<?php 

header('Content-Type: application/json');

$url = "https://viacep.com.br/ws/".$_GET['cep']."/json/";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
$result = curl_exec($ch);
curl_close($ch);


 ?>