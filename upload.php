<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/bootstrap-fileupload.min.css" rel="stylesheet" />
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.12.4.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/bootstrap-fileupload.js"></script>
<?php
//page setup
echo '<div id="page-inner">';
//hidden success message waiting for request
if (isset($_REQUEST['msg']) && ($_REQUEST['msg']=="success"))
{
	echo '<div class="alert alert-success alert-dismissable">';
	echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
	echo 'Document successfully uploaded!</div>';
}
//header
echo '<h1 class="page-head-line">Upload a New File to DocStorage</h1>';
echo '<div class="panel-body">';
//form
echo '<form method="post" enctype="multipart/form-data" action="">';
echo '<input type="hidden" name="uploadedby" value="user@test.mail">';
echo '<input type="hidden" name="MAX_FILE_SIZE" value="10000000">';
echo '<div class="form-group">';
//sub header
echo '<label class="control-label col-lg-4">File Upload</label>';
//upload thumbnail
echo '<div class="">';
echo '<div class="fileupload fileupload-new" data-provides="fileupload">';
echo '<div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>';
//buttons
echo '<div class="row">';
echo '<div class="col-md-2">';
echo '<span class="btn btn-file btn-primary">';
echo '<span class="fileupload-new">Select File</span>';
echo '<span class="fileupload-exists">Change</span>';
echo '<input name="userfile" type="file"></span></div>';
echo '<div class="col-md-2"><a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></div>';
echo '</div>';//end buttons
echo '</div>';//end fileupload fileupload-new
echo '</div>';//end ""
echo '</div>';//end form-group
echo '<hr>';
//submit button
echo '<button type="submit" name="submit" value="submit" class="btn btn-lg btn-block btn-success">Upload File</button>';
echo '</form>';
echo '</div>';//end panel-body
echo '</div>';//end page-inner
if (isset($_POST['submit']))
{
	//login
   	include("functions.php");
	$dblink=db_connect("docstorage");
	
	//upload information
	$uploadDate=date("Y-m-d H:i:s");
	$uploadDName=date("Y-m-d H:i:s");
	$uploadBy="user@test.mail";
	$fileName=str_replace(" ","_",$_FILES['userfile']['name']);
	$fileName=$fileName;
	$docType="pdf";
	
	//file prep
	$tmpName=$_FILES['userfile']['tmp_name'];
	$fileSize=$_FILES['userfile']['size'];
	$fileType=$_FILES['userfile']['type'];
	
	//location
    //$path="/var/www/html/uploads/";
	
	//upload file read
	$fp=fopen($tmpName, 'r');
	$content=fread($fp, filesize($tmpName));
	fclose($fp);
	$contentsClean=addslashes($content);
	
	//inseting file into documents
	$sqlDoc="Insert into `documents` (`name`,`path`,`upload_by`,`upload_date`,`status`,`file_type`,`content`) values ('$fileName','$path','$uploadBy','$uploadDate','active','$docType','$contentsClean')";
	//runs query
	$dblink->query($sqlDoc) or
		die("Something went wrong with $sql<br>".$dblink->error);
	
	//inserting content into contents
	//$sqlCon="Insert into `contents` (`name`,`content`,`status`) values ('temp','$contentsClean','active')";
	//runs query
	//$dblink->query($sqlCon) or
		//die("Something went wrong with $sql<br>".$dblink->error);
	
	//opens path
	//$fp=fopen($path.$fileName,"wb") or
	//	die("Could not open $path$fileName for writing");
	//writes file
	//fwrite($fp,$content);
	//fclose($fp);
	
	//success message with no infor in url
	redirect("upload.php?msg=success");
}
?>