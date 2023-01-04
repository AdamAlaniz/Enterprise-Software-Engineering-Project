<?php
$page="reporting_2.php";
include("functions.php");
$dblink=db_connect("docstorage");

$sqlDoc="Select * from `api_documents`";
$result=$dblink->query($sqlDoc) or
		die("Something went wrong with $sql<br>".$dblink->error);

//$sqlNum="Select sum(length(`content`)) from `api_documents` where `loan_number` like '%$value%'";
//$rst=$dblink->query($sqlNum) or
	//die("Something went wrong with $sql<br>".$dblink->error);

$sqlNum="Select sum(length(`content`)) from `api_documents`";
	$rst=$dblink->query($sqlNum) or
		die("Something went wrong with $sql<br>".$dblink->error);
$num=$rst->fetch_array(MYSQLI_ASSOC);

$loan_array=array();
//$content_array=array();
while($data=$result->fetch_array(MYSQLI_ASSOC)){
	//echo '<div>Loan Number: '.$data['loan_number'].'</div>';
	$tmp=$data['loan_number'];
	//$tmp2=$data['content'];
	$loan_array[]=$tmp;
	//$content_array[]=$tmp2;
	//$sqlNum="Select sum(length(`content`)) from `api_documents` where 'loan_number' like '%$tmp%'";
	//$rst=$dblink->query($sqlNum) or
		//die("Something went wrong with $sql<br>".$dblink->error);
	//$tmp2=$rst->fetch_array(MYSQLI_NUM);
	//echo '<div>Content: '.$tmp2.'</div>';
	//$content_array=$tmp2;
}

echo '<div>'.$num.'</div>';
$loan_unique=array_unique($loan_array);
foreach($loan_unique as $key=>$value){
	echo '<div>Loan Number: '.$value.'</div>';
	//$sqlNum="Select sum(length(`content`)) from `api_documents` where `loan_number` like '%$value%'";
	//$rst=$dblink->query($sqlNum) or
		//die("Something went wrong with $sql<br>".$dblink->error);
	//$tmp=$rst->fetch_array(MYSQLI_NUM);
	//echo '<div>Content: '.$tmp.'</div>';
}
//while($test=$rst->fetch_array(MYSQLI_TYPE_MEDIUM_BLOB)){
	//echo '<div>'.$test.'</div>';
//}
//$num=count($loan_unique);
//echo '<div>Total Loan Numbers: '.$num.'</div>';
?>