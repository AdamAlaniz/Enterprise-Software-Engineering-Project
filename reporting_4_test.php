<?php
$page="reporting_3.php";
include("functions.php");
$dblink=db_connect("docstorage");

$sqlDoc="Select * from `api_documents`";
$result=$dblink->query($sqlDoc) or
		die("Something went wrong with $sql<br>".$dblink->error);

$loan_array=array();
while($data=$result->fetch_array(MYSQLI_ASSOC)){
	//echo '<div>Loan Number: '.$data['loan_number'].'</div>';
	$tmp=$data['loan_number'];
	$loan_array[]=$tmp;
}

$loan_unique=array_unique($loan_array);
$credit_array=array();
//foreach($loan_unique as $key=>$value){
	//echo '<div>Loan Number: '.$value.'</div>';
	//$sqlNum="Select * from `api_documents` where `file_type` NOT LIKE '%Credit%';";
	//$rst=$dblink->query($sqlNum) or
		//die("Something went wrong with $sql<br>".$dblink->error);
	//$tmp=$rst->fetch_array(MYSQLI_ASSOC);
	//$credit_array[]=$rst->fetch_array(MYSQLI_NUM);
	//$count=$tmp[0];
	//$count2=$count2+1;
	//echo '<div>Loan Number: '.$value.' does not contain a Credit File';
//}
//echo'<div>'.print_r($credit_array).'</div>';
//$sqlNum="Select * from `api_documents` where `file_type` NOT LIKE '%Credit%';";
//$rst=$dblink->query($sqlNum) or
	//die("Something went wrong with $sql<br>".$dblink->error);
//while($data=$rst->fetch_array(MYSQLI_ASSOC)){
	//echo '<div>Loan Number: '.$data['loan_number'].'</div>';
	//$tmp=$data['loan_number'];
	//$credit_array[]=$tmp;
//}
//$credit_unique=array_unique($credit_array);
//foreach($credit_unique as $key=>$value){
	//$tmp=$data['loan_number'];
	//echo '<div>Loan Number: '.$value.' does not contain a Credit File';
//}

$loan_unique=array_unique($loan_array);
foreach($loan_unique as $key=>$value){
	//echo '<div>Loan Number: '.$value.'</div>';
	$sqlNum="Select count(`file_type`) from `api_documents` where `file_type` like '%Credit%'";
	$rst=$dblink->query($sqlNum) or
		die("Something went wrong with $sql<br>".$dblink->error);
	$tmp=$rst->fetch_array(MYSQLI_NUM);
	$count=$tmp[0];
	$count2=$count2+1;
	//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents</div>';
}
echo '<div>Total Credit Count: '.$count.'</div>';

foreach($loan_unique as $key=>$value){
	//echo '<div>Loan Number: '.$value.'</div>';
	$sqlNum="Select count(`file_type`) from `api_documents` where `file_type` like '%Closing%'";
	$rst=$dblink->query($sqlNum) or
		die("Something went wrong with $sql<br>".$dblink->error);
	$tmp=$rst->fetch_array(MYSQLI_NUM);
	$count=$tmp[0];
	$count2=$count2+1;
	//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents</div>';
}
echo '<div>Total Closing Count: '.$count.'</div>';

foreach($loan_unique as $key=>$value){
	//echo '<div>Loan Number: '.$value.'</div>';
	$sqlNum="Select count(`file_type`) from `api_documents` where `file_type` like '%Title%'";
	$rst=$dblink->query($sqlNum) or
		die("Something went wrong with $sql<br>".$dblink->error);
	$tmp=$rst->fetch_array(MYSQLI_NUM);
	$count=$tmp[0];
	$count2=$count2+1;
	//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents</div>';
}
echo '<div>Total Title Count: '.$count.'</div>';

foreach($loan_unique as $key=>$value){
	//echo '<div>Loan Number: '.$value.'</div>';
	$sqlNum="Select count(`file_type`) from `api_documents` where `file_type` like '%Financial%'";
	$rst=$dblink->query($sqlNum) or
		die("Something went wrong with $sql<br>".$dblink->error);
	$tmp=$rst->fetch_array(MYSQLI_NUM);
	$count=$tmp[0];
	$count2=$count2+1;
	//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents</div>';
}
echo '<div>Total Financial Count: '.$count.'</div>';

foreach($loan_unique as $key=>$value){
	//echo '<div>Loan Number: '.$value.'</div>';
	$sqlNum="Select count(`file_type`) from `api_documents` where `file_type` like '%Personal%'";
	$rst=$dblink->query($sqlNum) or
		die("Something went wrong with $sql<br>".$dblink->error);
	$tmp=$rst->fetch_array(MYSQLI_NUM);
	$count=$tmp[0];
	$count2=$count2+1;
	//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents</div>';
}
echo '<div>Total Personal Count: '.$count.'</div>';

foreach($loan_unique as $key=>$value){
	//echo '<div>Loan Number: '.$value.'</div>';
	$sqlNum="Select count(`file_type`) from `api_documents` where `file_type` like '%Internal%'";
	$rst=$dblink->query($sqlNum) or
		die("Something went wrong with $sql<br>".$dblink->error);
	$tmp=$rst->fetch_array(MYSQLI_NUM);
	$count=$tmp[0];
	$count2=$count2+1;
	//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents</div>';
}
echo '<div>Total Internal Count: '.$count.'</div>';

foreach($loan_unique as $key=>$value){
	//echo '<div>Loan Number: '.$value.'</div>';
	$sqlNum="Select count(`file_type`) from `api_documents` where `file_type` like '%Legal%'";
	$rst=$dblink->query($sqlNum) or
		die("Something went wrong with $sql<br>".$dblink->error);
	$tmp=$rst->fetch_array(MYSQLI_NUM);
	$count=$tmp[0];
	$count2=$count2+1;
	//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents</div>';
}
echo '<div>Total Legal Count: '.$count.'</div>';

foreach($loan_unique as $key=>$value){
	//echo '<div>Loan Number: '.$value.'</div>';
	$sqlNum="Select count(`file_type`) from `api_documents` where `file_type` like '%Other%'";
	$rst=$dblink->query($sqlNum) or
		die("Something went wrong with $sql<br>".$dblink->error);
	$tmp=$rst->fetch_array(MYSQLI_NUM);
	$count=$tmp[0];
	$count2=$count2+1;
	//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents</div>';
}
echo '<div>Total Other Count: '.$count.'</div>';
//$average=array_sum($tmp)/count($tmp);
//echo '<div>The Average Number of Documents: '.$average.'</div>';
//$sum=$count/$count2;
//echo '<div>'.$count.'</div>';
//echo '<div>'.$count2.'</div>';
//echo '<div>The Average Number of Documents: '.$sum.'</div>';


//foreach($loan_unique as $key=>$value){
	//$sqlNum="Select count(`loan_number`) from `api_documents` where `loan_number` like '%$value%'";
	//$rst=$dblink->query($sqlNum) or
		//die("Something went wrong with $sql<br>".$dblink->error);
	//$tmp=$rst->fetch_array(MYSQLI_NUM);
	//if($tmp[0]>$sum){
		//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' documents and is above average!';
	//}
	//elseif($tmp[0]<$average){
		//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' documents and is below average!';
	//}
	//else{
		//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' documents and is the average!';
	//}
//}
//$num=count($loan_unique);
//echo '<div>Total Loan Numbers: '.$num.'</div>';
?>