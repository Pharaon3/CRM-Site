<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");

//set to delete code
$ref =  $_GET['id'];

if(isset($_GET["delete"])){
    
	$feedback = "<div style='background-color:#fda8ab; padding: 10px'>Are you sure you want to delete this entry  <a href='http://www.solarprimeg.co.za/admin/factory_job_card_tank.php?id=$ref&cd=true'>Yes</a>  <a href='http://www.solarprimeg.co.za/admin/factory_job_card_tank.php'>No</a>?</div>";
}

if(isset($_GET['cd'])){

$sql_delete = "DELETE FROM fac_job_tank WHERE id_tank ='$ref'";
$delete = mysqli_query($sql_delete);
header("Location: factory_job_card_tank_view.php");
exit;

}
//end of set to delete

$sql = "select * FROM fac_job_tank";
$r = mysqli_query($sql_conn, $sql);

$url = "http://www.solarprimeg.co.za/admin/factory_job_card_tank_view.php";

if ($_POST){
	$db = new clsDB();
	$db->tableName = "fac_job_tank";
	$db->primaryField = "id_tank";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("size", FormPost("txtsize"), "string");
	$db->addparameter("serial_code", FormPost("txtserial_code"), "string");
	$db->addparameter("colour", FormPost("txtcolour"), "string");
      $db->addparameter("instructions", FormPost("fckinstructions"), "string");
	$db->addparameter("card_no", FormPost("txtcard_no"), "string");
	/* Water Instructions */
	$db->addparameter("water_test_by", FormPost("txtwater_test_by"), "string");
	$db->addparameter("water_test_date", FormPost("txtwater_test_date"), "string");
	/* Approval Instructions */
	$db->addparameter("approval_date", FormPost("txtapproval_date"), "string");
	$db->addparameter("approval_by", FormPost("txtapproval_by"), "string");
	
	$db->addparameter("date", FormPost("txtdate"), "string");
	$id = $db->save();
    CheckSave($id);
		
	echo 'Saving...';
	echo '<script>window.location = "'.$url.'";</script>';
}
?>
<?php include("admin_header.php"); ?>
<script src="../js/js.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

<!-- datepicker style -->
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">

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
	$("#datepicker3").datepicker({
	dateFormat: 'yy-mm-dd',
	startDate:'01/01/2000', // first selectable date is 1st Jan 2000
	});
  });
</script>
<style>
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
<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">JOB CARD - TANKS</div>


<form name="frmMain" action="" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<?php
$db = new clsDB;
$db->tableName = "fac_job_tank";
$db->primaryField = "id_tank";
$db->primaryValue = $_GET["id"];
$db->loadRecord();
?>

<?=  isset($feedback)? $feedback."<br /><br />" : "";  ?>

    <table border="0" cellpadding="4" cellspacing="4" class="tableadd" width="100%">
 <tr>
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
?>
 
      <td width="125" class="do_b">Doc No.:</td>
      <td style="font-size:20px; font-weight:bold">
      <input name="txtjob_code" type="hidden" value="
	  <?php 
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
  <td class="do_b" style="width:125px !important">Date:</td>
  <td colspan="2"><input type="text" id="datepicker" autocomplete="off" name="txtdate" class="txt2" value="<?php echo $db->getFieldString("date"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">Serial No.:</td>
  <td colspan="2"><input type="text" autocomplete="off" name="txtserial_code" class="txt2" id="txtName2" value="<?php echo $db->getFieldString("serial_code"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">Job Card No.:</td>
  <td colspan="2"><input type="text" autocomplete="off" name="txtcard_no" class="txt2" id="txtName" value="<?php echo $db->getFieldString("card_no"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">Product Size: </td>
  <td colspan="2"><input type="text" autocomplete="off" name="txtsize" class="txt2" id="txtName4" value="<?php echo $db->getFieldString("size"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">Colour:</td>
  <td colspan="2"><input type="text" autocomplete="off" name="txtcolour" class="txt2" id="txtName3" value="<?php echo $db->getFieldString("colour"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">Specifications:</td>
  <td colspan="2"><textarea name="fckinstructions" class="txt2" id="fckinstructions" autocomplete="off"><?php echo $db->getFieldString("instructions"); ?></textarea></td>
</tr>
<tr>
  <td valign="top" class="do_b">&nbsp;</td>
  <td width="394" align="left">
    <!-- water instructions -->
    <fieldset style="border:thin solid #999; padding:5px; width:350px; margin:5px;">
      <table width="350" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <th width="200" align="left" scope="col">Water tested By:</th>
          <th width="307" align="left" valign="top" class="do_b" scope="col">
            <input type="text" autocomplete="off" name="txtwater_test_by" class="txt2" id="txtwater_test_by" value="<?php echo $db->getFieldString("water_test_by"); ?>" /></th>
          </tr>
        <tr>
          <td width="200" align="left">Date:</td>
          <td align="left" valign="top"><input type="text" autocomplete="off" name="txtwater_test_date" class="txt2" id="datepicker2" value="<?php echo $db->getFieldString("water_test_date"); ?>" /></td>
          </tr>
        </table>
      </fieldset></td>
  <td width="414" align="right">
    <!-- Approval instructions -->
    <fieldset style="border:thin solid #999; padding:10px; width:350px; margin:10px;">
      <table width="350" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <th width="102" align="left" scope="col">Final Approval by:</th>
          <th width="234" align="left" valign="top" class="do_b" scope="col"><input type="text" autocomplete="off" name="txtapproval_by" class="txt2" id="txtName5" value="<?php echo $db->getFieldString("approval_by"); ?>" /></th>
          </tr>
        <tr>
          <td width="102" align="left">Date:</td>
          <td align="left" valign="top"><input type="text" autocomplete="off" name="txtapproval_date" class="txt2" id="datepicker3" value="<?php echo $db->getFieldString("approval_date"); ?>" /></td>
          </tr>
        </table>
      </fieldset>
    </td>
</tr>
<tr>
  <td valign="top" class="do_b">&nbsp;</td>
  <td colspan="2">
<!--------------------------------------------- upload document  ----------------------------------------------->
<a href="test_tank_doc.php?id=0&user=<?php echo $_GET["id"];?>" style="text-decoration:none" /><div class="upload_btn1">UPLOAD DOCUMENTS</div></a>
<!--------------------------------------- quotation documents ----------------------------------------->
    <?php
    $serial_code = $_GET["id"];
    //$join_code = $service_job_code = $job_code;
    $sql7 = "select * from tank_doc where service_job_code=".$serial_code;
    $r7 = mysqli_query($sql_conn, $sql7); 
	$doc_id = $row['tank_doc_id'];
{

    ?>    
    <fieldset style="border:thin solid #999; background-color: #FFF">
      <table border="0" cellpadding="3" cellspacing="3" class="tableadd" width="100%">
        <tr>
          <td colspan="4" bgcolor="#CCCCCC" class="do_b"><table width="100%" border="0" cellspacing="10" cellpadding="10">
            <tr>
              <th align="left" valign="top" class="heading_01" scope="col">Tank Documents</th>
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
          <td class="do_b"><?php echo $row['tank_doc_id'] ?></td>
          <td><?php echo $row['date'] ?></td>
          <td><?php echo $row['description'] ?></td>
          <td><a href="http://www.solarprimeg.co.za/upload/upload_tank_doc/<?php echo $row['image'] ?>"><?php echo $row['image'] ?></a></td>
          </tr>
        <?php } ?>
        </table>
      </fieldset>



    </td>
</tr>
    </table>

<table width="100%">
<tr>
	<td colspan="2" align="left"><input type="image" src="images/icon-save.jpg" /></td>
    <td width="95%">
    <!--admin can ONLY see this -->
    <?php 
	//$level = $_SESSION['UserName'];
    //$sql_level = "select IsAdmin from users";
	//$r_level = mysqli_query($sql_level);
	//while($row = mysqli_fetch_array($r_level)){
    
	if($_SESSION['UserName'] == 'Jorge'){
		echo
		
	"<a href='factory_job_card_tank.php? id=$ref&delete=true'><img src='images/icon-delete.jpg' /></a>";

		}else{
			if($_SESSION['UserName'] == 'Megan'){
		echo
		
	"<a href='factory_job_card_panels.php? id=$ref&delete=true'><img src='images/icon-delete.jpg' /></a>";
			
			}else{
			}}
	 ?>
    <!--admin can ONLY see this -->
    </td>
</tr>
</table>
      <script>
            CKEDITOR.replace( 'fckinstructions' );
        </script>
</form>


<?php } ?>
<?php include("admin_footer.php"); ?>

