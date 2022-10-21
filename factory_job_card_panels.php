<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");
//set to delete code
$ref =  $_GET['id'];

if(isset($_GET["delete"])){
    
	$feedback = "<div style='background-color:#fda8ab; padding: 10px'>Are you sure you want to delete this entry  <a href='http://www.solarprimeg.co.za/admin/factory_job_card_panels.php?id=$ref&cd=true'>Yes</a>  <a href='http://www.solarprimeg.co.za/admin/factory_job_card_panels.php'>No</a>?</div>";
}

if(isset($_GET['cd'])){

$sql_delete = "DELETE FROM fac_job_panels WHERE id_panels ='$ref'";
$delete = mysqli_query($sql_delete);
header("Location: factory_job_card_panels_view.php");
exit;

}
//end of set to delete

$sql = "select * FROM fac_job_panels";
$r = mysqli_query($sql_conn, $sql);

$url = "http://www.solarprimeg.co.za/admin/factory_job_card_panels_view.php";

if ($_POST){
	$db = new clsDB();
	$db->tableName = "fac_job_panels";
	$db->primaryField = "id_panels";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("card_no", FormPost("txtcard_no"), "string");
	$db->addparameter("serial_no", FormPost("txtserial_no"), "string");
	$db->addparameter("size", FormPost("txtsize"), "string");
    $db->addparameter("instructions", FormPost("fckinstructions"), "string");
	/* Copper Instructions */
	$db->addparameter("copper_guys_by", FormPost("txtcopper_guys_by"), "string");
	$db->addparameter("copper_date", FormPost("txtcopper_date"), "string");
	/* Approval Instructions */
	$db->addparameter("approval_date", FormPost("txtapproval_date"), "string");
	$db->addparameter("approval_by", FormPost("txtapproval_by"), "string");
	
	$db->addparameter("date", FormPost("txtdate"), "string");

	$id = $db->save();
    CheckSave($id);
	
	$feedback .= "The update was successful";
	header ('Location: factory_job_card_panels_view.php');	
}
?>
<?php include("admin_header.php"); ?>
<script src="../js/js.js"></script>
<script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
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
<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">JOB CARD - PANELS</div>
<form name="frmMain" action="" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<?php
$db = new clsDB;
$db->tableName = "fac_job_panels";
$db->primaryField = "id_panels";
$db->primaryValue = $_GET["id"];
$db->loadRecord();
?>

<?=  isset($feedback)? $feedback."<br /><br />" : "";  ?>

    <table border="0" cellpadding="3" cellspacing="3" class="tableadd" width="100%">
<tr>
	<td class="do_b" width="130">Date:</td>
    <td colspan="3"><input type="text" autocomplete="off" name="txtdate" class="txt2" id="datepicker" value="<?php echo $db->getFieldString("date"); ?>" /></td>
</tr>
<tr>
	<td class="do_b" width="130">Job Card No.:</td>
    <td colspan="3"><input type="text" autocomplete="off" name="txtcard_no" class="txt2" id="txtName3" value="<?php echo $db->getFieldString("card_no"); ?>" /></td>
</tr>
<tr>
    <td valign="top" class="do_b">Serial No.:</td>
    <td colspan="3"><input type="text" autocomplete="off" name="txtserial_no" class="txt2" id="txtName2" value="<?php echo $db->getFieldString("serial_no"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">Product Size: </td>
  <td colspan="3"><input type="text" autocomplete="off" name="txtsize" class="txt2" id="txtName4" value="<?php echo $db->getFieldString("size"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">Specifications:</td>
  <td colspan="3"><textarea name="fckinstructions" class="txt2" id="fckinstructions" autocomplete="off"><?php echo $db->getFieldString("instructions"); ?></textarea></td>
</tr>
<tr>
  <td valign="top" class="do_b">&nbsp;</td>
  <td width="364">
    <!-- copper instructions -->
    <fieldset style="border:thin solid #999; padding:10px; width:350px; margin:10px; margin-left:0px">
      <table width="340" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <th width="129" align="left" scope="col">Copper Guts By:</th>
          <th width="197" align="left" valign="top" class="do_b" scope="col">
            <input type="text" autocomplete="off" name="txtcopper_guys_by" class="txt2" id="txtcopper_guys_by" value="<?php echo $db->getFieldString("copper_guys_by"); ?>" /></th>
          </tr>
        <tr>
          <td align="left">Date:</td>
          <td align="left" valign="top"><input type="text" autocomplete="off" name="txtcopper_date" class="txt2" id="datepicker2" value="<?php echo $db->getFieldString("copper_date"); ?>" /></td>
          </tr>
        </table>
      </fieldset>
    
    </td>
  <td width="254">
    <!-- Approval instructions -->
    <fieldset style="border:thin solid #999; padding:10px; width:350px; margin:10px;">
      <table width="450" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <th width="129" align="left" scope="col">Final Approval:</th>
          <th width="307" align="left" valign="top" class="do_b" scope="col"><input type="text" autocomplete="off" name="txtapproval_by" class="txt2" id="txtName5" value="<?php echo $db->getFieldString("approval_by"); ?>" /></th>
          </tr>
        <tr>
          <td align="left">Date:</td>
          <td align="left" valign="top"><input type="text" autocomplete="off" name="txtapproval_date" class="txt2" id="datepicker3" value="<?php echo $db->getFieldString("approval_date"); ?>" /></td>
          </tr>
        </table>
      </fieldset>
    
    
    </td>
  <td width="255">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="do_b">&nbsp;</td>
  <td colspan="3">
<!--------------------------------------------- Upload document  ----------------------------------------------->
<a href="test_panel_doc.php?id=0&user=<?php echo $_GET["id"];?>" style="text-decoration:none" /><div class="upload_btn1">UPLOAD DOCUMENTS</div></a>
<!-------------------------------------------- quotation documents ---------------------------------------------->
   <?php
   
    $serial_code = $_GET["id"];
    //$join_code = $service_job_code = $job_code;
    $sql7 = "select * from panel_doc where service_job_code=".$serial_code;
    $r7 = mysqli_query($sql_conn, $sql7); 
	
	
	$doc_id = $row['panel_doc_id'];
	
    ?>    
  <fieldset style="border:thin solid #999; background-color: #FFF">
      <table border="0" cellpadding="3" cellspacing="3" class="tableadd" width="100%">
        <tr>
          <td colspan="4" bgcolor="#CCCCCC" class="do_b"><table width="100%" border="0" cellspacing="10" cellpadding="10">
            <tr>
              <th align="left" valign="top" class="heading_01" scope="col">Panel Documents</th>
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
          <td class="do_b"><?php echo $row['panel_doc_id'] ?></td>
          <td class="do_b"><?php echo $row['date'] ?></td>
          <td class="do_b"><?php echo $row['description'] ?></td>
          <td class="do_b"><a href="http://www.solarprimeg.co.za/upload/upload_panel_doc/<?php echo $row['image'] ?>"><?php echo $row['image'] ?></a></td>
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
		
	"<a href='factory_job_card_panels.php? id=$ref&delete=true'><img src='images/icon-delete.jpg' /></a>";

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



<?php include("admin_footer.php"); ?>

