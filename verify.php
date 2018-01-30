<?php
$access_token = 'whUzOKrLCUPHpQeZ41C1RN+fZiaNCcChlP9cEL+Uinn5gnPlWD4C8zkLKvbi/CIM12QL98+QGFIP5rrNH/ojc8uXTCtFmzGwSaJcptLoPxNaYqtNV9/RlSoy3qRQEyyEH4mbLiKL4PaxuRkT3XHHqwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;