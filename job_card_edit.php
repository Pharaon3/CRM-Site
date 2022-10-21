<?php
include("validation_job_card.php");
include("../includes/admin.php"); 
include("../includes/dbconn.php");
include("../includes/clsDB.php"); 

//set to delete code
$ref =  $_GET['id'];

if(isset($_GET["delete"])){
    
	$feedback = "<div style='background-color:#fda8ab; padding: 10px'>Are you sure you want to delete this entry  <a href='http://www.solarprimeg.co.za/admin2/job_card_edit.php?id=$ref&cd=true'>Yes</a>  <a href='http://www.solarprimeg.co.za/admin/job_card_edit.php'>No</a>?</div>";
}

if(isset($_GET['cd'])){

 // echo "Hello";
//  exit;
$sql_delete = "DELETE FROM job_card WHERE job_id ='$ref'";
$delete = mysqli_query($sql_conn,$sql_delete);
header("Location:job_card_view.php");
exit;

}
//end of set to delete

$job_code = $_GET["job_id"];
$url = "http://solarprimeg.co.za/admin/search.php";


if ($_POST){
//quote file upload	 - perfect!
if($_FILES['imageUpload']['name'])
{
$seconds=$_SERVER['REQUEST_TIME'];
$file1=explode('.', $_FILES['imageUpload']['name']);
$imageUpload=$seconds.'.'.$file1[1];
move_uploaded_file($_FILES['imageUpload']['tmp_name'],"../upload/upload_quote_doc/".$imageUpload);	
$date_today=date('Y-m-d');
	
	mysqli_query($sql_conn,"INSERT INTO `quote_doc`(`doc_code`,`description`,`image`,`service_job_code`,`date`)VALUES('".$_POST['txtdoc_code']."','".$_POST['txtdescription']."','$imageUpload','".$_GET["id"]."','".$date_today."')");
}	
//install file upload - perfect
if($_FILES['imageUpload1']['name'])
{
$seconds2=$_SERVER['REQUEST_TIME'];
$file2=explode('.', $_FILES['imageUpload1']['name']);
$imageUpload2=$seconds2.'.'.$file2[1];
move_uploaded_file($_FILES['imageUpload1']['tmp_name'],"../upload/upload_install_doc/".$imageUpload2); // for some reason the document is being saved to the quote folder instead of this line
$date_today2=date('Y-m-d');
	
	mysqli_query($sql_conn,"INSERT INTO `install_doc`(`doc_code`,`description`,`image`,`service_job_code`,`date`)VALUES('".$_POST['txtdoc_code1']."','".$_POST['txtdescription1']."','$imageUpload2','".$_GET["id"]."','".$date_today2."')");
}	

	
	if(count($_POST['txtinstall_tank']))
	{
	$txtinstall_tank=implode(',',$_POST['txtinstall_tank']);
	}
	
	if(count($_POST['txtinstall_panel']))
	{
	$txtinstall_panel=implode(',',$_POST['txtinstall_panel']);
	}
	
	$db = new clsDB();
	$db->tableName = "job_card";
	$db->primaryField = "job_id";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("first_name", FormPost("txtfirst_name"), "string");
	$db->addparameter("job_code", FormPost("txtjob_code"), "string");
	$db->addparameter("approved", FormPost("txtapproved"), "string");
	$db->addparameter("surname", FormPost("txtsurname"), "string");
	$db->addparameter("address", FormPost("txtaddress"), "string");
	$db->addparameter("cell", FormPost("txtcell"), "string");
    $db->addparameter("email", FormPost("txtemail"), "string");
	$db->addparameter("tel", FormPost("txttel"), "string");
	/* 	QUOTATION  */
	$db->addparameter("date_quote", FormPost("txtdate_quote"), "string");
	$db->addparameter("instructions", FormPost("fckinstructions"), "string");
	//$db->addparameter("install_tank", FormPost("txtinstall_tank"), "string");
	//$db->addparameter("install_panel", FormPost("txtinstall_panel"), "string");

	$db->addparameter("install_tank", $txtinstall_tank, "string");
	$db->addparameter("install_panel", $txtinstall_panel, "string");
	/*  INSTALLATION */
	$db->addparameter("date_install", FormPost("txtdate_install"), "string");
	$db->addparameter("system_install", FormPost("txtsystem_install"), "string");
	$db->addparameter("install_type", FormPost("txtinstall_type"), "string");
	$db->addparameter("install_instruction", FormPost("fckinstall"), "string");
	
	$db->addparameter("serial_code", FormPost("txtserial_code"), "string");

	$id = $db->save();
    CheckSave($id);
	echo 'Saving...';
	echo '<script>window.location.href = "job_card_edit.php?id='.$_GET['id'].'";</script>';
}
?>
<?php include("admin_header.php"); ?>
<script src="../js/js.js"></script>
<script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>


<!-- datepicker style -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<style>
input:required {
    background:hsl(180, 50%, 90%);
    border:1px solid #999;
}
</style>
<script language="javascript" type="text/javascript">
function validate(){
    var tTarget = "validate_response";
    cleardata(tTarget);
    bValid = true;
    if(checkfield('txtfirst_name', 'Please enter the customers name',tTarget,'required')!='true'){bValid = true}
    if(checkfield('txtsurname', 'Please enter the customers surname',tTarget,'required')!='true'){bValid = true}
	if(checkfield('txtcell', 'Please enter the customers mobile number',tTarget,'required')!='true'){bValid = true}
    if(bValid == false){
        return false;
    }
}
</script>
<script>
  $(document).ready(function() {
    $("#datepicker").datepicker({
	dateFormat: 'yy-mm-dd',
	startDate:'01/01/2000', // first selectable date is 1st Jan 2000
		});
	$("#datepicker2").datepicker({
	dateFormat: 'yy-mm-dd',
	startDate:'01/01/2000', // first selectable date is 1st Jan 2000
		});
  });
  </script>
  
<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">JOB CARD</div>


<form name="frmMain" action="" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<?php

$Name = $_GET["first_name"];
$Surname = $_GET["surname"];
$Address = $_GET["address"];
$Cell = $_GET["cell"];
$Email = $_GET["email"];
$Tel = $_GET["tel"];
$error1 = "Missing Data!";

$db = new clsDB;
$db->tableName = "job_card";
$db->primaryField = "job_id";
$db->primaryValue = $_GET["id"];
$db->loadRecord();

?>

<?php 
$sql10 = "select job_id FROM job_card ORDER BY job_id desc limit 1";
$r10 = mysqli_query($sql_conn, $sql10); 
while($row = mysqli_fetch_array($r10)){
	//echo $row['job_id'];

$job_id1 = $row['job_id'];
$job_id2 = 1;
$new_job_id = $job_id1+$job_id2;
	//echo "<br/>";
	//echo $new_job_id;
$errorMesssage = "<div style='color:red'>Missing Data!</div>"
?>
<?=  isset($feedback)? $feedback."<br /><br />" : "";  ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th align="right" scope="col"><input type="image" src="images/icon-save5.jpg" /></th>
  </tr>
</table>

<!-- clients details -->
<fieldset style="border:thin solid #333; margin:10px">
    <table border="0" cellpadding="3" cellspacing="3" class="tableadd" width="100%">
    <tr>
        <td colspan="2" bgcolor="#333333" class="do_b"><table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <th align="left" valign="top" class="heading_02" scope="col">CLIENTS DETAILS</th>
            </tr>
          </table></td>
        </tr>
    <tr>
      <td colspan="2" class="do_b"><span style="color:red">* </span> Required fields</td>
    </tr>
    <tr>
      <td width="130" class="do_b">Job Card No.:</td>
      <td style="font-size:20px; font-weight:bold">
      <input name="txtjob_code" type="hidden" value="<?php 
	  if ($job_id1 == 0){ 
	  	echo $new_job_id; 
	  }else{ 
	  	echo $_GET["id"];
	  };?>" />
	  <!-- echo value -->
	  <?php
	  if ($job_id1 == 0){
	   echo $new_job_id; 
	  }else{
	   echo $_GET["id"]; 
	  };?></td>
    </tr>
    <? } ?>
    <tr>
      <td class="do_b"><span style="color:red">*</span> First Name:</td>
      <td><input type="text" autocomplete="off" name="txtfirst_name" required   class="txt2" value="<?php echo $db->getFieldString("first_name"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b"><span style="color:red"> * </span>Surname:</td>
      <td><input type="text" autocomplete="off" name="txtsurname" required  class="txt2" value="<?php echo $db->getFieldString("surname"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b"><span style="color:red">*</span> Mobile: </td>
      <td><input type="text" autocomplete="off" name="txtcell" required  class="txt2" value="<?php echo $db->getFieldString("cell"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b"><span style="color:red">*</span> Email: </td>
      <td><input type="text" autocomplete="off" name="txtemail" required  class="txt2" value="<?php echo $db->getFieldString("email"); ?>" /></td>
    </tr>

    <tr>
      <td valign="top" class="do_b"><span style="color:red">*</span> Tel:</td>
      <td><input type="text" autocomplete="off" name="txttel" required  class="txt2" id="txtName3" value="<?php echo $db->getFieldString("tel"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b"><span style="color:red">*</span> Address:</td>
      <td><textarea name="txtaddress" class="txt2" required  autocomplete="off"><?php echo $db->getFieldString("address"); ?></textarea></td>
    </tr>
        </table>
</fieldset>

<!--------------------------------------- Quotation section ------------------------------------------------------------------->
<fieldset style="border:thin solid #333; margin:10px">
    <table border="0" cellpadding="3" cellspacing="3" class="tableadd" width="100%">
    <tr bgcolor="#333333">
        <td colspan="2" class="do_b"><table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <th align="left" valign="top" class="heading_02" scope="col">QUOTATION</th>
            </tr>
          </table></td>
        </tr>
    <tr>
      <td width="135" valign="top" class="do_b">Date Quoted: </td>
      <td width="1056"><input type="text" autocomplete="off" name="txtdate_quote" class="txt2" id="datepicker" value="<?php echo $db->getFieldString("date_quote"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b">Instructions/ Commens:</td>
      <td align="left" valign="top"><textarea name="fckinstructions" class="txt2" id="fckinstructions" autocomplete="off"><?php echo $db->getFieldString("instructions"); ?></textarea></td>
    </tr>
    <tr>
      <td valign="top" class="do_b">Quotation Approval:</td>
      <td><label for="approved"></label>
                <select name="txtapproved" id="approved">
                      <option value="<?php echo $db->getFieldString("approved"); ?>"><?php echo $db->getFieldString("approved"); ?></option>
                      <option value="not_approved">Not Approved</option>
                      <option value="Approved">Approved</option>
                </select>&nbsp; This quote is currently: <strong><?php echo $db->getFieldString("approved"); ?></strong></td>
    </tr>
    <tr>
      <td colspan="2" valign="top" class="do_b">
<!--http://www.solarprimeg.co.za/admin/test_quote_doc.php?id=<?php echo $_GET['id']; ?>	-->  
<!--------------------------------------- iframe  ----------------------------------------------------->
<!--<iframe src="http://www.solarprimeg.co.za/admin/test_quote_doc.php?id=<?php echo $_GET['job_card_id2']; ?>" height="125" width="1200"></iframe>-->
<!--------------------------------------- quotation documents ----------------------------------------->
 
<!--<span id="test_quote_doc_data"></span>-->
<style>
.tbl_body{
	    background: #f7e5d6;
    padding: 10px;
    border: 2.5px solid gray;
}
.upload_btn1{
	background-color:#D0CECE; 
	color:#999; 
	text-align:center; 
	border-radius:5px; 
	padding:10px; 
	width:96%; 
	margin:10px;
	transition:0.65s;
}
.upload_btn1:hover{
	background-color:#666;
	color:#CCC;
}
</style>
<div class="tbl_body">
<!------------------------my form--------------------->
<div style="font-family: Arial; font-size: 13px; font-weight: bold; border-bottom: thin solid #333; padding: 2px; margin: 2px; color: #333;">UPLOAD QUOTATION DOCUMENT</div>
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
      <option value="<?= $row['job_id']; ?>" <?php if ($row['job_id'] == $_GET['id'])echo ' selected="selected"'; ?> >
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
  <td width="248">
  <!--<input type="hidden"  name="imageValue"  value="<?php echo $db->getFieldString('file'); ?>" />-->
  <input type="file" name="imageUpload" class="txt2" id="imageUpload" style="width:100% !important" accept="image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf, .mp4" value="" />

  </td>
  </tr>
</table>

</div>
<!------------------------my form--------------------->

 <?php
    $service_job_code = $_GET["id"]; 
    $join_code = $service_job_code = $job_code;
    $sql7 = "select * from quote_doc WHERE service_job_code = ".$_GET['id'];
    $r7 = mysqli_query($sql_conn, $sql7); 
    
    if ($service_job_code = 0) {
        echo "No quotations available!";
        };
    ?>    
      <fieldset style="border:thin solid #999; background-color: #FFF">
      <table border="0" cellpadding="3" cellspacing="3" class="tableadd" width="100%">
        <tr>
          <td colspan="4" bgcolor="#CCCCCC" class="do_b"><table width="100%" border="0" cellspacing="10" cellpadding="10">
            <tr>
              <th align="left" valign="top" class="heading_01" scope="col">Quotation Documents</th>
            </tr>
          </table></td>
        </tr>
        <tr bgcolor="#F4F4F4">
          <td width="174" class="do_b">ID:</td>
          <td width="249">Date: </td>
          <td width="179">Description</td>
          <td width="361">File</td>
        </tr>
        <?php		
		while($row = mysqli_fetch_array($r7)){
		?>
        <tr>
          <td class="do_b"><?php echo $row['quote_doc_id'] ?></td>
          <td><?php echo $row['date'] ?></td>
          <td><?php echo $row['description'] ?></td>
          <td><a href="http://www.solarprimeg.co.za/upload/upload_quote_doc/<?php echo $row['image'] ?>"><?php echo $row['image'] ?></a></td>
        </tr>
        <?php } ?>
      </table>
      </fieldset>
      </td>
      </tr>
        </table>
</fieldset>

<!-- INSTALLATION section -->
<fieldset style="border:thin solid #333; margin:10px">
    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3" class="tableadd">
    <tr bgcolor="#333333">
        <td colspan="2" class="do_b"><table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <th align="left" valign="top" class="heading_02" scope="col">INSTALLATION</th>
            </tr>
          </table></td>
        </tr>
    <tr>
      <td width="138" class="do_b">Installation Date:</td>
      <td width="1053"><input type="text" id="datepicker2" autocomplete="off" name="txtdate_install" class="txt2" value="<?php echo $db->getFieldString("date_install"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b">System Install:</td>
      <td><input type="text" autocomplete="off" name="txtsystem_install" class="txt2" value="<?php echo $db->getFieldString("system_install"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b">Installation Type: </td>
      <td><input type="text" autocomplete="off" name="txtinstall_type" class="txt2" id="txtName4" value="<?php echo $db->getFieldString("install_type"); ?>" /></td>
    </tr>
	


<script>
$(document).ready(function(){
    $("#btn1").click(function(){
		var btn_data1 = $('#btn_data1').val();
        $("#btn_show1").append('<br><input type="text" name="txtinstall_tank[]" placeholder="Serial Tank" value="'+btn_data1+'">');
    });
    $("#btn2").click(function(){
		var btn_data2 = $('#btn_data2').val();
        $("#btn_show2").append('<br><input type="text" name="txtinstall_panel[]" placeholder="Serial Panel" value="'+btn_data2+'">');
    });
	 
	 
$('#test_quote_doc_data').load('test_quote_doc.php?job_card_id2=<?php echo $_GET['id']; ?>');
	
	$("#new_submit").click(function(){
		//window.location='http://solarprimeg.co.za/admin/job_card_edit.php?id=<?php echo $_GET['id']; ?>';
		//var btn_data2 = $('#btn_data2').val();
        //$("#btn_show2").append('<br><input type="text" name="txtinstall_panel[]" placeholder="Serial Panel" value="'+btn_data2+'">');
    });
	
});


function txtinstall_tank_delete(data)
{
	$('#txtinstall_tank_delete'+data).remove();
}

function txtinstall_panel_delete(data)
{
	$('#txtinstall_panel_delete'+data).remove();
}
$( function() {
   
    $( "#btn_data1" ).autocomplete({
      source: 'autocomplete.php'
    });
  } );	
$( function() {
   
    $( "#btn_data2" ).autocomplete({
      source: 'auto.php'
    });
  } );	
</script>

	   
	
    <tr>
      
      <td align="left" valign="top">Serial Code:</td>
      <td><textarea name="txtserial_code" rows="5" class="txt2" id="txtserial_code" autocomplete="off"><?php echo $db->getFieldString("serial_code"); ?></textarea></td>
      
      
    </tr>
	
	<tr>
	  <td valign="top" class="do_b">Instructions/ Commens:</td>
	  <td><textarea name="fckinstall" id="fckinstall" rows="5" style="width:100%; height:250px" class="txt2" autocomplete="off"><?php echo $db->getFieldString("install_instruction"); ?></textarea></td>
	  </tr>
    <tr>
      <td colspan="2" valign="top" class="do_b">
    
	
<!--------------------------------------- iframe  ------------------------------------------------------>
<!--<iframe src="http://www.solarprimeg.co.za/admin/test_install_doc.php" height="125" width="1200"></iframe>-->
<!------------------------------- installed documentation ---------------------------------------------->
<!--installation form -->
<div class="tbl_body">
<div style="font-family: Arial; font-size: 13px; font-weight: bold; border-bottom: thin solid #333; padding: 2px; margin: 2px; color: #333;">UPLOAD INSTALLATION DOCUMENT</div>
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
 
  <?php  $sql02 = mysqli_query($sql_conn,"SELECT * FROM job_card") ?>
    <select name="txtservice_job_code" style="pointer-events: none;">
      <?php  while($row02 = mysqli_fetch_assoc($sql02) ): ?>
      <option value="<?= $row02['job_id']; ?>" <?php if ($row02['job_id'] == $_GET['id'])echo ' selected="selected"'; ?> >
        <?= $row02['job_code'];  ?>
        &nbsp;-&nbsp;
        <?= $row02['first_name'];  ?>
        &nbsp;
        <?= $row02['surname'];  ?>
        </option>
      <?php endwhile; ?>
    </select>
    </td>
	
  <td width="215"><input type="text" autocomplete="off" name="txtdoc_code1" class="txt2" id="txtName2" value="<?php echo $db->getFieldString("doc_code"); ?>" /></td>
  <td width="241"><input type="text" autocomplete="off" name="txtdescription1" class="txt2" id="txtName" value="<?php echo $db->getFieldString("description"); ?>" /></td>
  <td width="248">
  <!--<input type="hidden"  name="imageValue"  value="<?php echo $db->getFieldString('file'); ?>" />-->
  <input type="file" name="imageUpload1" class="txt2" id="imageUpload" style="width:100% !important" accept="image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" value="" />

  </td>
  </tr>
</table>
</div>
<!--end of installation form -->
	<?php
    $service_job_code = $_GET["id"]; 
    $join_code = $service_job_code = $job_code;
    $sql06 = "select * from install_doc WHERE service_job_code = ".$_GET['id'];
    $r06 = mysqli_query($sql_conn, $sql06); 
    
    if ($service_job_code = 0) {
        echo "No installation documents available!";
        };
    ?>    
     <fieldset style="border:thin solid #999; background-color: #FFF">
      <table border="0" cellpadding="3" cellspacing="3" class="tableadd" width="100%">
        <tr>
          <td colspan="4" bgcolor="#CCCCCC" class="do_b"><table width="100%" border="0" cellspacing="10" cellpadding="10">
            <tr>
              <th align="left" valign="top" class="heading_01" scope="col">Installation Documents</th>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F4F4F4" class="do_b">ID:</td>
          <td width="249" bgcolor="#F4F4F4">Date: </td>
          <td width="179" bgcolor="#F4F4F4">Description</td>
          <td width="361" bgcolor="#F4F4F4">File</td>
        </tr>
        <?php
		
		while($row = mysqli_fetch_array($r06)){
		?>
        <tr>
          <td class="do_b"><?php echo $row['installDoc_id'] ?></td>
          <td><?php echo $row['date'] ?></td>
          <td><?php echo $row['description'] ?></td>
          <td><a href="http://www.solarprimeg.co.za/upload/upload_install_doc/<?php echo $row['image'] ?>"><?php echo $row['image'] ?></a></td>
        </tr>
        <?php } ?>
      </table>
      </fieldset>
      </td>
      </tr>
        </table>
</fieldset>

<!------------------------- SERVICES section -------------------------------------->
<fieldset style="border:thin solid #333; margin:10px">

<?php
//$service_job_code = $_GET["id"];
$service_job_code = $_GET["id"]; 
$join_code = $service_job_code = $job_code;
$sql4 = "select * from services WHERE service_job_code = ".$_GET['id'];
$r4 = mysqli_query($sql_conn, $sql4); 

if ($service_job_code = 0) {
	echo "No services have been scheduled!";
	};
?>
<!--------------------------------------------- upload document  ----------------------------------------------->
<a href="service_edit.php?id=0&user=<?php echo $_GET["id"];?>" style="text-decoration:none" /><div class="upload_btn1">LOG A NEW SERVICE</div></a>
<!--------------------------------------- quotation documents ----------------------------------------->
    <table style="width:100%;" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
    <tr>
        <td colspan="5" bgcolor="#333333" class="do_b">
            <table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <th align="left" valign="top" class="heading_02" scope="col">SCHEDULED SERVICES</th>
            </tr>
          </table>
        </td>
        </tr>
    <tr bgcolor="#FFFFFF">
      <td width="85" class="do_b">ID:</td>
      <td width="86" class="do_b">Date Logged:</td>
      <td width="249">Date Attended: </td>
      <td width="179">Team</td>
      <td width="361">View</td>
    </tr>
<?php
while($row = mysqli_fetch_array($r4)){
?>
    <tr>
      <td class="do_b"><?php echo $row['service_id'] ?></td>
      <td><?php echo $row['date_logged'] ?></td>
      <td><?php echo $row['date_att'] ?></td>
      <td><?php echo $row['team'] ?></td>
      <td><a href="service_edit_view2.php?id=<?php echo $row['service_id'] ?>">View More Details</a></td>
    </tr>
<?php
 }
?>
        </table>
</fieldset>

<!------------------------- BREAKDOWN section -------------------------------------->
<fieldset style="border:thin solid #333; margin:10px">
    <table style="width: 100%">
            <tr>
        <td colspan="5" bgcolor="#333333" class="do_b">
            <table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <th align="left" valign="top" class="heading_02" scope="col">BREAKDOWN SERVICES</th>
            </tr>
          </table>
        </td>
        </tr>
    </table>
<table style="width:100%;" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
<thead>
<tr>
	<th width="74">Edit</th>
	<th width="74">ID</th>
    <th width="174">Date Logged:</th>
    <th width="174">Date Attended:</th>
    <th width="174">Problem:</th>
    <th width="174">team:</th>
    <th width="92">Status</th>
</tr>
</thead>
<tbody>
<?php
$sql20 = "select * from breakdown WHERE client_id = '$ref' order by breakdown_id desc";
$r20 = mysqli_query($sql_conn, $sql20);
$tot = 0;
while($breakdownData = mysqli_fetch_array($r20)){
	$tot++;
?>
<tr>
 <td><a href="breakdown_update.php?client_id=<?php echo $breakdownData['client_id'] ?>&breakdown_id=<?php echo $breakdownData['breakdown_id'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
 <td width="52"><?php echo $breakdownData['breakdown_id'] ?></td>
 <td width="174"><?php echo $breakdownData['breakdown_date_log'] ?></td>
 <td width="174"><?php echo $breakdownData['breakdown_date_att'] ?></td>
 <td width="174"><?php echo $breakdownData['breakdown_problem'] ?></td>
 <td width="174"><?php echo $breakdownData['breakdown_team'] ?></td>
 <td width="92"><div class="<?php echo $breakdownData['service_status'] ?>"></div></td> 
 
</tr>
<?php
 }
 if( $tot == 0 ){
	echo '<tr><td colspan="7">NO DATA FOUND</td></tr>';
 }
?>
</tbody>
</table>
</fieldset>
<table width="100%">
<tr>
    <td width="95%">
    <!--admin can ONLY see this -->
    <?php 
   
	if($_SESSION['UserName'] == 'jorge'){
		echo
		
	"<a href='job_card_edit.php? id=$ref&delete=true'><img src='images/icon-delete.jpg' /></a>";

		}else{
			if($_SESSION['UserName'] == 'megan'){
		echo
		
	"<a href='job_card_edit.php? id=$ref&delete=true'><img src='images/icon-delete.jpg' /></a>";
			
			}else{
			}}
	 ?>
    <!--admin can ONLY see this -->
    </td>
</tr>
</table>
        <script>
            CKEDITOR.replace( 'fckinstructions' );
			CKEDITOR.replace( 'fckinstall' );
        </script>
</form>


<?php include("admin_footer.php"); ?>

