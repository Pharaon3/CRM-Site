<?php

include("../includes/functions.php");
include('../includes/SimpleImage.php');
include('../includes/sitewide.php'); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");

$message = "Successfully Saved!";
$sql = "select * FROM install_doc";
$r = mysqli_query($sql_conn, $sql);

//$url2 = "http://www.solarprimeg.co.za/admin/job_card_edit.php?id=".$page_id;
//$url = "http://www.solarprimeg.co.za/admin/service_edit_view2.php";
$url3 = '<meta http-equiv="refresh" content="2;URL="http://www.solarprimeg.co.za/admin/service_edit_view2.php"';


if ($_POST){
	$db = new clsDB();
	$db->tableName = "service_doc";
	$db->primaryField = "service_doc_id";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("description", FormPost("txtdescription"), "string");
	$db->addparameter("file", $target_file, "string");
	$db->addparameter("service_job_code", FormPost("txtservice_job_code"), "string");
	$db->addparameter("date", "now", "date");
	//upload_install_doc

	if(isset($_FILES['imageUpload']) && $_FILES['imageUpload']['name'] !=""){
		$ext_arr = array("jpg", "png", "gif", "pdf");
		//$check = getimagesize($_FILES["imageUpload"]["tmp_name"]);
		$uploaded_ext = pathinfo($_FILES["imageUpload"]["name"], PATHINFO_EXTENSION);
    if(in_array($uploaded_ext, $ext_arr) !== false) {
    	$imageValue = $_FILES["imageUpload"]["name"];
    	$target_file = "../upload/upload_service_doc/$imageValue";
    	if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
      	//echo "Image is uploaded";
   	 	}
   	 	else{
   	 		die("Unable to upload document");
   	 	}
    	
    } 
    else{
    	die("Image file is fake");
    }
	}
	$db->addparameter("image", $imageValue, "string");
	$id = $db->save();
    CheckSave($id);
	
	echo '<span class="success">Successfully Uploaded!</span>';
	//echo $message;

}
?>
<?php include("admin_header.php"); ?>
<style>
.success{
	font-family: Arial;
    font-size: 14px;
    color: white !important;
    font-weight: bold;
    top: 100px;
    background-color: green;
    width: 100%;
    position: fixed;
    z-index: 2222;
    padding: 10px;
    margin-left: 194px;
    margin-top: 9px;
    opacity: 0.7;
}
.do_b{
	font-family:Arial;
	font-size:14px;
	color:#333;
}
</style>
<!-- datepicker style -->
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<link href="adminstyle.css" rel = "stylesheet">

<script>
  $(document).ready(function() {
    $("#datepicker").datepicker({
	minDate: 0,
	dateFormat: 'yy-mm-dd'
	});
  });
</script>
<div style="font-family: Arial; font-size: 13px; font-weight: bold; border-bottom: thin solid #333; padding: 2px; margin: 2px; color: #333;">UPLOAD TANK DOCUMENT</div>
<?php
	$jobid=$_GET["id_tank"];
?>	
<br/>
<form name="frmMain" action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
<?php
$db = new clsDB;
$db->tableName = "service_doc";
$db->primaryField = "service_doc_id";
$db->primaryValue = $_GET["id"];
$db->loadRecord();
?>


    <table border="0" cellpadding="4" cellspacing="4" class="tableadd" width="100%">
<tr>
  <td width="200" class="do_b">Job Card:</td>
  <td width="415" align="left"><span class="do_b">Description:</span></td>
  <td width="318"><span class="do_b">File:</span></td>
</tr>
<tr>
  <td class="do_b">
    <input type="text" name="txtservice_job_code" readonly="readonly"  class="txt2" value="<?php echo $_GET["user"];?>" /></td>
  <td align="left"><input type="text" autocomplete="off" name="txtdescription" class="txt2"  value="<?php echo $db->getFieldString("description"); ?>" /></td>
  <td><input type="hidden"  name="imageValue"  value="<?php echo $db->getFieldString('file'); ?>" />
    <input type="file" name="imageUpload" class="txt2" id="imageUpload" style="width:100% !important" accept="image/*,application/pdf" value="" />
</td>
  </tr>
<tr>
  <td colspan="4" class="do_b"><table width="16%" border="0" cellspacing="4" cellpadding="4">
    <tr>
      <th width="8%" scope="col"><input type="image" src="images/icon-save.jpg" /></th>
      <th width="92%" align="left" scope="col"><a href="/admin2/breakdown_update.php?client_id=<?php echo $_GET["client_id"];?>"><img src="images/icon-back.png" alt="" /></a></th>
    </tr>
  </table></td>
  </tr>
    </table>
</form>

<!-- view files uploaded -->
<?php 
$refID = $_GET["id"];
$sql222 = "SELECT * from service_doc ORDER BY service_doc_id desc" ;
$r222 = mysqli_query($sql_conn, $sql222);
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
<tr bgcolor="#CCCCCC">
	<td width="106" class="do_b">No.</td>
	<td width="207" class="do_b">Date</td>
    <td width="333" class="do_b">Description.</td>
    <td width="544" class="do_b">File</td>
    <td width="106" class="do_b">Delete</td>
</tr>
<?php
while($row = mysqli_fetch_array($r222)){
?>
<tr>
 <td><?php echo $row['service_doc_id'] ?></td>
 <td><?php echo $row['date'] ?></td>
 <td><?php echo $row['description'] ?></td>
 <td><?php echo $row['image'] ?></td>
 <td align="center" class="copy2" style="width:44px !important"><a href="delete_service.php?delete_service_doc=<?php echo $row['service_doc_id']; ?>"><img src="images/icon-delete.png"/></a></td>

</tr>
<?php
 }
?>
</table>
<?php include("admin_footer.php"); ?>
