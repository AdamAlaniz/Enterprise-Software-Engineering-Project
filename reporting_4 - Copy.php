<?php
$page="reporting_4.php";
include("functions.php");
$dblink=db_connect("docstorage");

$sqlDoc="Select * from `api_documents`";
$result=$dblink->query($sqlDoc) or
		die("Something went wrong with $sql<br>".$dblink->error);

$sqlTest="Select * from `api_documents` where `file_type` like '%Credit%';";
$rst=$dblink->query($sqlDoc) or
		die("Something went wrong with $sql<br>".$dblink->error);

$loan_array=array();

while($test=$rst->fetch_array(MYSQLI_ASSOC)){
	$tmp=$test['loan_number'];
	$loan_array[]=$tmp;
}





//$loan_array=array();

while($data=$result->fetch_array(MYSQLI_ASSOC)){
	//echo '<div>Loan Number: '.$data['loan_number'].'</div>';
	//$tmp=$data['loan_number'];
	//$loan_array[]=$tmp;
	//$tmp2=$data['file_type'];
	//if($tmp2=='Credit'&&$tmp2&&'Closing'&&$tmp2=='Title'&&$tmp2=='Financial'&&$tmp2=='Personal'&&$tmp2=='Internal'&&$tmp2=='Legal'&&$tmp2=='Other'){
		//$loan_array[]=$tmp;
		//echo '<div>test</div>';
	//}
	//if()
	//$sqlNum="Select * from `api_documents` where `loan_number` like '%$tmp%' AND `file_type` like '%Credit%' AND `file_type` like '%Closing%' AND `file_type` like '%Title%' AND `file_type` like '%Financial%' AND `file_type` like '%Personal%' AND `file_type` like '%Internal%' AND `file_type` like '%Legal%' AND `file_type` like '%Other%'";
	//$rst=$dblink->query($sqlNum) or
		//die("Something went wrong with $sql<br>".$dblink->error);
	//$test=$rst->fetch_array(MYSQLI_ASSOC);
	//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents</div>';
	//echo '<div>'.$tmp.'</div>';
	//$loan_array[]=$tmp;
}
$loan_unique=array_unique($loan_array);
foreach($loan_unique as $key=>$value){
	//$sqlNum="Select * from `api_documents` where `loan_number` like '%$value%' AND `file_type` like '%Credit%' AND `file_type` like '%Closing%' AND `file_type` like '%Title%' AND `file_type` like '%Financial%' AND `file_type` like '%Personal%' AND `file_type` like '%Internal%' AND `file_type` like '%Legal%' AND `file_type` like '%Other%'";
	//$rst=$dblink->query($sqlNum) or
		//die("Something went wrong with $sql<br>".$dblink->error);
	//$test=$rst->fetch_array(MYSQLI_ASSOC);
	//while($test=$rst->fetch_array(MYSQLI_ASSOC)){
		//echo '<div>Loan Number: '.$test.'</div>';
	//}
	echo '<div>Loan Number: '.$value.'</div>';
	//$sqlNum="Select * from `api_documents` where `loan_number` like '%$value%' AND `file_type` like '%Credit%'";
	//$rst=$dblink->query($sqlNum) or
		//die("Something went wrong with $sql<br>".$dblink->error);
	//$tmp=$rst->fetch_array(MYSQLI_NUM);
	//echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents</div>';
	//echo '<div>'.$rst.'</div>';
}


//$num=count($loan_unique);
//echo '<div>Total Loan Numbers: '.$num.'</div>';
?>