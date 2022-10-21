<?php

include("../includes/functions.php");
include('../includes/SimpleImage.php');
include('../includes/sitewide.php');
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");

$message = "Successfully Saved!";
$sql = "select * FROM install_doc";
$r = mysqli_query($sql_conn, $sql);
$page_id = $_GET["id"];
	//echo $page_id;
$url2 = "http://www.solarprimeg.co.za/admin2/job_card_edit.php?id=";
//$url = "http://www.solarprimeg.co.za/admin/quote_doc.php";

if ($_POST){
	$db = new clsDB();
	$db->tableName = "quote_doc";
	$db->primaryField = "quote_doc_id";
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
    	$target_file = "../upload/upload_quote_doc/$imageValue";
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
	//echo 'Saving...';
	//header("Location:".$url2.FormPost("txtservice_job_code"));
	//echo $message;
	//echo "<script>window.location='http://maestrossoftware.com';</script>";
	
	//echo "<script>window.location='http://www.solarprimeg.co.za/admin2/job_card_edit.php?id=".$_GET['job_card_id2']."';</script>"; 
}
?>

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
<link href="adminstyle.css" rel = "stylesheet">
<style type="text/css">
body {
	background-color: #f7e5d6;
}
</style>
<script>
  $(document).ready(function() {
    $("#datepicker").datepicker({
	minDate: 0,
	dateFormat: 'yy-mm-dd'
	});
  });
</script>



<script>
$(document).ready(function(){
	
    $.post("abhi.php",
    {
        name: "Donald Duck",
        city: "Duckburg"
    },	
	//$("#test_LL").hide();
	//$('#test_quote_doc_data').load('abhi.php?job_card_id2=<?php echo $_GET['id']; ?>');
});
</script>

<!--<span id="test_quote_doc_data"></div>-->

<div style="font-family: Arial; font-size: 13px; font-weight: bold; border-bottom: thin solid #333; padding: 2px; margin: 2px; color: #333;">UPLOAD QUOTATION DOCUMENT</div><br/>
<form name="frmMain" action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
<?php
$db = new clsDB;
$db->tableName = "quote_doc";
$db->primaryField = "quote_doc_id";
$db->primaryValue = $_GET["id"];
$db->loadRecord();
?>


  <table border="0" cellpadding="0" cellspacing="0" class="tableadd" width="100%">
<tr>
	<td class="do_b" width="85">Job Card:</td>
    <td width="215"><span class="do_b">Doc No.:</span></td>
    <td width="241"><span class="do_b">Description:</span></td>
    <td width="248"><span class="do_b">File:</span></td>
    <td width="209" rowspan="2" align="right"><input type="image" id="new_submit" src="images/icon-save.jpg" /></td>
</tr>
<tr> 
  <td class="do_b">
 
  <?php  $sql2 = mysqli_query($sql_conn,"SELECT * FROM job_card") ?>
    <select name="txtservice_job_code" style="pointer-events: none;">
      <?php  while($row = mysqli_fetch_assoc($sql2) ): ?>
      <option value="<?= $row['job_id']; ?>" <?php if ($row['job_id'] == $_GET['job_card_id2'])echo ' selected="selected"'; ?> >
        <?= $row['job_code'];  ?>
        &nbsp;-&nbsp;
        <?= $row['first_name'];  ?>
        &nbsp;
        <?= $row['surname'];  ?>
        </option>
      <?php endwhile; ?>
    </select>
    </td>
	
  <td width="215"><input type="text" autocomplete="off" name="txtdoc_code" class="txt2" id="txtName2" value="<?php echo $db->getFieldString("doc_code"); ?>" /></td>
  <td width="241"><input type="text" autocomplete="off" name="txtdescription" class="txt2" id="txtName" value="<?php echo $db->getFieldString("description"); ?>" /></td>
  <td width="248"><input type="hidden"  name="imageValue"  value="<?php echo $db->getFieldString('file'); ?>" />
  <input type="file" name="imageUpload" class="txt2" id="imageUpload" style="width:100% !important" accept="image/*,application/pdf" value="" />

  </td>
  </tr>
</table>
</form>




