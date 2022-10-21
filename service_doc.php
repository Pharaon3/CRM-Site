<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");

$message = "Successfully Saved!";
$sql = "select * FROM service_doc";
$r = mysqli_query($sql);
$page_id = $_GET["id"];
	//echo $page_id;
$url2 = "http://www.solarprimeg.co.za/admin/job_card_edit.php?id=";

if ($_POST){
	$db = new clsDB();
	$db->tableName = "service_doc";
	$db->primaryField = "service_doc_id";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("description", FormPost("txtdescription"), "string");
	$db->addparameter("doc_code", FormPost("txtdoc_code"), "string");
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
	
	//echo 'Saving...';
	header("Location:".$url2.FormPost("txtservice_job_code"));
	//echo $message;
}
?>
<?php include("admin_header.php"); ?>
<script src="../js/js.js"></script>
<script language="javascript" type="text/javascript">
function validate(){
    var tTarget = "validate_response";
    cleardata(tTarget);
    bValid = true;
    if(checkfield('txtName', 'Please enter a username',tTarget,'required')!='true'){bValid = false}
    if(checkfield('txtPassword', 'Please enter a password',tTarget,'required')!='true'){bValid = false}
    if(bValid == false){
        return false;
    }
}
</script>
<!-- datepicker style -->
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script>
  $(document).ready(function() {
    $("#datepicker").datepicker({
	minDate: 0,
	dateFormat: 'yy-mm-dd'
	});
  });
</script>
<form name="frmMain" action="" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<?php
$db = new clsDB;
$db->tableName = "service_doc";
$db->primaryField = "service_doc_id";
$db->primaryValue = $_GET["id"];
$db->loadRecord();
?>


    <table border="0" cellpadding="3" cellspacing="3" class="tableadd" width="100%">
<tr>
	<td class="do_b" width="130">Job Card:</td>
    <td>
    <?php  $sql2 = mysqli_query("SELECT * FROM job_card")     ?>
      				   <select name="txtservice_job_code">
                       <?php  while($row = mysqli_fetch_assoc($sql2) ):  ?>
                          <option value="<?= $row['job_id']; ?>" <?php if ($row['job_code'] == $_GET['id'])echo ' selected="selected"'; ?> >
                            <?= $row['job_code'];  ?>&nbsp;-&nbsp;<?= $row['first_name'];  ?>&nbsp;<?= $row['surname'];  ?>
                          </option>
                       <?php endwhile; ?>
                      </select>
    </td>
</tr>
<tr>
  <td class="do_b">Date:</td>
  <td><input type="text" id="datepicker" autocomplete="off" name="date" class="txt2" value="<?php echo $db->getFieldString("date"); ?>" /></td>
</tr>
<tr>
  <td class="do_b">Document No.:</td>
  <td><input type="text" autocomplete="off" name="txtdoc_code" class="txt2" id="txtName2" value="<?php echo $db->getFieldString("doc_code"); ?>" /></td>
</tr>
<tr>
	<td class="do_b" width="130">Description:</td>
    <td><input type="text" autocomplete="off" name="txtdescription" class="txt2" id="txtName" value="<?php echo $db->getFieldString("description"); ?>" /></td>
</tr>
<tr>
    <td class="do_b" valign="top">File:</td>
    <td>
    <input type="hidden"  name="imageValue"  value="<?php echo $db->getFieldString('file'); ?>" />
  	<input type="file" name="imageUpload" class="txt2" id="imageUpload" style="width:100% !important" accept="image/*,application/pdf" value="" />
  	<img src="http://www.solarprimeg.co.za/upload/upload_service_doc/<?php if($db->getFieldString('image') != "") echo $db->getFieldString('image');else echo "default.jpg"?>" style="width: 100px; height: 100px;" >
    </td>
</tr>
</table>

<table width="100%">
<tr>
	<td colspan="2" align="left">
        <input type="image" src="images/icon-save.jpg" />
        <div id="validate_response"></div>
    </td>
</tr>
</table>

</form>



<?php include("admin_footer.php"); ?>

