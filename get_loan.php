<?php
$username="pza251";
$password="rpKJ6bhTPjGkRL";
$sesh= "63e6210d829bddd17832790b16320213a12a61d8";
$data="sid=$sesh&uid=$username";
$ch=curl_init('https://cs4743.professorvaladez.com/api/request_loans');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'content-type: application/x-www-form-urlencoded',
	'content-length: ' . strlen($data))
);
$result=curl_exec($ch);
curl_close($ch);
$cinfo=json_decode($result, true);
echo $cinfo[1].'\r\n';
?>