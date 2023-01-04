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
	$ch=curl_init('https://cs4743.professorvaladez.com/api/query_files');
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
		if($cinfo[1]=="Action: None"){
			echo "\r\n No new files to import found\r\n";
			echo "SID: $sid\r\n";
			echo "Username: $username\r\n";
			echo "Query Files Execution Time: $exe_time_end/r/n";
		}
		else{
			$tmp=explode(":",$cinfo[1]);
			$files=explode(",",$tmp[1]);
			$loan=explode("/",$files[1]);
			$loan_tmp=explode("-",$loan[4]);
			$loan_num=$loan_tmp[0];
			echo "Number of new files to import found: ".count($files)."\r\n"; //log this in data base
			echo "Loan Number: $loan_tmp[0]\r\n";
			$num_files=count($files);
			echo "Files:\r\n";
			foreach($files as $key=>$value){
				echo $value."\r\n";
				$name_tmp=explode("/",$value);
				$name_file=explode("-",$name_tmp[4]);
				$file_type=$name_file[1];
				$sqlDoc2="Insert into `file_names` (`loan_num`, `file_type`, `SID`) values ('$loan_num', '$file_type', '$sid')";
					//runs query
					$dblink->query($sqlDoc2) or
						die("Something went wrong with $sql<br>".$dblink->error);
			}
			echo "Query Files Execution Time: $exe_time_end\r\n";
			//echo $file_type;
		}
		$data="sid=$sid";
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
}
$sqlDoc="Insert into `query_tracking` (`SID`, `username`, `password`, `time_start`, `time_end`, `num_of_files`, `loan_number`) values ('$sid', '$username', '$password', '$exe_time', '$exe_time_end', '$num_files', '$loan_num')";
	//runs query
	$dblink->query($sqlDoc) or
		die("Something went wrong with $sql<br>".$dblink->error);
?>