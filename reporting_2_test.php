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
foreach($loan_unique as $key=>$value){
	//echo '<div>Loan Number: '.$value.'</div>';
	$sqlNum="Select length(`content`) from `api_documents` where `loan_number` like '%$value%'";
	$rst=$dblink->query($sqlNum) or
		die("Something went wrong with $sql<br>".$dblink->error);
	$tmp=$rst->fetch_array(MYSQLI_NUM);
	echo '<div>Loan Number: '.$value.' is size '.$tmp[0].'.</div>';
	$count=$count+$tmp[0];
	$count2=$count2+1;
}
//$sum=array_sum($tmp);
//$average=array_sum($tmp)/count($tmp);
$average=$count/$count2;
//echo '<div>'.$count2.'</div>';
echo '<div>The Average Size: '.$average.'</div>';
echo '<div>Total Size: '.$count.'</div>';

//$num=count($loan_unique);
//echo '<div>Total Loan Numbers: '.$num.'</div>';
?>