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
		$tmp=explode(":",$cinfo[1]);
		$files=explode(",",$tmp[1]);
		$loan=explode("/",$files[1]);
		$loan_tmp=explode("-",$loan[4]);
		$loan_num=$loan_tmp[0];
		$loan_num_int=intval($loan_num);
		$upload_by=$loan[3];
		$upload_date=date("Y-m-d H:i:s");
		if($cinfo[2]=="Action: None"){
			echo "\r\n No new files to import found\r\n";
			echo "SID: $sid\r\n";
			echo "Username: $username\r\n";
			echo "Loan Number: $loan_tmp[0]\r\n";
			echo "Query Files Execution Time: $exe_time_end/r/n";
			$num_files=0;
			$loan_num="No Loan Number";
			$sqlDoc="Insert into `query_tracking` (`SID`, `username`, `password`, `time_start`, `time_end`, `num_of_files`, `loan_number`) values ('$sid', '$username', '$password', '$exe_time', '$exe_time_end', '$num_files', '$loan_num')";
			//runs query
			$dblink->query($sqlDoc) or
				die("Something went wrong with $sql<br>".$dblink->error);
		}
		else{
			//$tmp=explode(":",$cinfo[1]);
			//$files=explode(",",$tmp[1]);
			//$loan=explode("/",$files[1]);
			//$loan_tmp=explode("-",$loan[4]);
			//$loan_num=$loan_tmp[0];
			//$upload_by=$loan[3];
			//$upload_date=date("Y-m-d H:i:s");
			echo "Number of new files to import found: ".count($files)."\r\n"; //log this in data base
			echo "Loan Number: $loan_tmp[0]\r\n";
			$num_files=count($files);
			//echo "Files:\r\n";
			foreach($files as $key=>$value){
				$count=123;
				//echo $value."\r\n";
				$name_tmp=explode("/",$value);
				$name_file=explode("-",$name_tmp[4]);
				$file_type=$name_file[1];
				$file_request=$name_tmp[4];
				$doc_tmp=explode(".", $file_request);
				$doc_type=$doc_tmp[1];
				//$file_tmp = str_replace(Array("\n", "\r", "\n\r"), '', $file_request);
				//$file_size=filesize($file_tmp);
				echo "File: $file_request\r\n";
				$data="sid=$sid&uid=$username&fid=$file_request";
				$ch=curl_init('https://cs4743.professorvaladez.com/api/request_file');
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
				$exe_time_file_end=($time_end - $time_start)/60;
				$content=$result;
				
				$fp=fopen("/var/www/html/uploads/$file_request","wb");
				fwrite($fp,$content);
				fclose($fp);
				echo "\r\n$file_request was written to file system!\r\n";
				//echo "File Size: $file_size";
				
				
				//$tmpName=$value;
				$fp=fopen("/var/www/html/uploads/$file_request", 'r');
				$blob_content=fread($fp, filesize("/var/www/html/uploads/$file_request"));
				fclose($fp);
				$contentsClean=addslashes($blob_content);
				
				//echo "$sid\r\n";
				//echo "$loan_num\r\n";
				//echo "$file_type\r\n";
				//echo "$upload_by\r\n";
				//echo "$upload_date\r\n";
				//echo "$doc_type\r\n";
				//echo $contentsClean;
				
				
				//$fp=fopen("/var/www/html/uploads/$file_request","wb");
				//fwrite($fp,$content);
				//fclose($fp);
				//echo "\r\n$file_request was written to file system!\r\n";
				//echo "File Size: $file_size";
				
				
				
				//TODO: 1. test filesize() and why only 1 file messes database up  2. finish database setup 3. insert into database 4. test database 5. set up cron job 6. let cron gather data 7. write analysis and report 8. turn in!!! 9. put on resume
				
				
				//You got this! Dont give up! THIS IS THE FINAL STRETCH!!!
				
				
				$sqlDoc="Insert into `api_documents` (`SID`, `loan_number`, `file_type` ,`uploaded_by` ,`uploaded_date` ,`doc_type` ,`content`) values ('$sid', '$loan_num' ,'$file_type', '$upload_by', '$upload_date','$doc_type', '$contentsClean')";
				//runs query
				$dblink->query($sqlDoc) or
					die("Something went wrong with $sql<br>".$dblink->error);
				
				
				//$sqlDoc2="Insert into `file_names` (`loan_num`, `file_type`, `SID`) values ('$loan_num', '$file_type', '$sid')";
					//runs query
					//$dblink->query($sqlDoc2) or
						//die("Something went wrong with $sql<br>".$dblink->error);
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
if($count=123){
	$sqlDoc="Insert into `query_tracking` (`SID`, `username`, `password`, `time_start`, `time_end`, `num_of_files`, `loan_number`) values ('$sid', '$username', '$password', '$exe_time', '$exe_time_end', '$num_files', '$loan_num')";
	//runs query
	$dblink->query($sqlDoc) or
		die("Something went wrong with $sql<br>".$dblink->error);
}
$sqlDocCron="Insert into `cron_tracking` (`SID`, `loan_num`, `cron_time`) values ('$sid', '$loan_num', '$upload_date')";
	//runs query
	$dblink->query($sqlDocCron) or
		die("Something went wrong with $sql<br>".$dblink->error);

?>