<?php
$username="pza251";
$password="rpKJ6bhTPjGkRL";
$data="username=$username&password=$password";//log this
$ch=curl_init('https://cs4743.professorvaladez.com/api/clear_session');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'content-type: application/x-www-form-urlencoded',
	'content-length: ' . strlen($data))
);
//$time_start=microtime(true);
$result=curl_exec($ch);//log this
//$time_end=microtime(true);
//$exe_time=($time_end - $time_start)/60;
curl_close($ch);
?>