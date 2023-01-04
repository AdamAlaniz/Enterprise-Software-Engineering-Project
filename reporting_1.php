<?php
$page="reporting_1.php";
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
foreach($loan_unique as $key=>$value)
	echo '<div>Loan Number: '.$value.'</div>';

$num=count($loan_unique);
echo '<div>Total Loan Numbers: '.$num.'</div>';
?>