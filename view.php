<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.12.4.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<?php
include("functions.php");
//connects to db
$dblink=db_connect("docstorage");
//requests the auto_id
$autoid=$_REQUEST['fid'];
//page setup
echo '<div id="page-inner">';
echo '<h1 class="page-head-line">View Files on DB</h1>';
echo '<div class="panel-body">';
//sql to view the file 
$sqlDoc="Select `auto_id`,`name`,`path`,`content` from `documents` where `auto_id`='$autoid'";
$resultDoc=$dblink->query($sqlDoc) or //can do logs here
	die("Something went wrong with $sqlDoc<br>".$dblink->error);
//makes db a variable
$data=$resultDoc->fetch_array(MYSQLI_ASSOC);
//if has path, then echo
if ($data['path']!=NULL)
	echo '<p>File: <a href="uploads/'.$data['name'].'" target="_blank">'.$data['name'].'</a></p>';
//doesnt have path 
else
{
	//makes content a variable
	$content=$data['content'];
	//new name in file system
	$fname=date("Y-m-d_H:i:s")."-file.pdf";
	if (!($fp=fopen("/var/www/html/uploads/$fname","w")))
		echo "<p>File could not be loaded at this time</p>";
	else
	{
		//writes name in system
		fwrite($fp,$content);
		fclose($fp);
		//hides file name in url
		echo '<p>File: <a href="uploads/'.$fname.'" target="_blank">'.$data['name'].'</a></p>';
	}
}
//page end
echo '</div>';//end panel-body
echo '</div>';//end page-inner
?>