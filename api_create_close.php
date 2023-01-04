<?php
include("functions.php");
$dblink=db_connect("docstorage");

$username="pza251";
$password="rpKJ6bhTPjGkRL";
$data="username=$username&password=$password";//log this
$ch=curl_init('https://cs4743.professorvaladez.com/api/create_session');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'content-type: application/x-www-form-urlencoded',
	'content-length: ' . strlen($data))
);
$time_start=microtime(true);
$result=curl_exec($ch);//log this
$time_end=microtime(true);
$exe_time=($time_end - $time_start)/60;
curl_close($ch);
$cinfo=json_decode($result, true);
if($cinfo[0]=="Status: OK" && $cinfo[1]=="MSG: Session Created"){
	$sid=$cinfo[2];//log session id
	$data="sid=$sid&uid=$username";//log this
	echo "\r\nSession Created Successfully!\r\n";
	echo "SID: $sid\r\n";
	echo "Create Session Execution Time: $exe_time\r\n";
	$ch=curl_init('https://cs4743.professorvaladez.com/api/close_session');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'content-type: application/x-www-form-urlencoded',
		'content-length: ' . strlen($data))
	);
	$time_start=microtime(true);
	$result=curl_exec($ch);//log this
	$time_end=microtime(true);
	$exe_time_end=($time_end - $time_start)/60;
	curl_close($ch);
	$cinfo=json_decode($result, true);
	if($cinfo[0]=="Status: OK"){
		echo "Session Successfully Closed!\r\n";
		echo "SID: $sid\r\n";
		echo "Close Session Execution Time: $exe_time_end\r\n";
	}
	else{
		echo $cinfo[0];
		echo "\r\n";
		echo $cinfo[1];
		echo "\r\n";
		echo $cinfo[2];
		echo "\r\n";
	}
}
else{
	echo $cinfo[0];
	echo "\r\n";
	echo $cinfo[1];
	echo "\r\n";
	echo $cinfo[2];
	echo "\r\n";
}
$sqlDoc="Insert into `session_tracking` (`SID`, `username`, `password`, `time_start`, `time_end`) values ('$sid', '$username', '$password', '$exe_time', '$exe_time_end')";
	//runs query
	$dblink->query($sqlDoc) or
		die("Something went wrong with $sql<br>".$dblink->error);
?>