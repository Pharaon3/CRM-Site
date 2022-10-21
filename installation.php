<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../fckeditor/fckeditor.php");
include("../includes/dbconn.php");

$sql = "select * FROM installation";
$r = mysqli_query($sql);

$location = "http://www.solarprimeg.co.za/admin/installation_view.php";

if ($_POST){
	$db = new clsDB();
	$db->tableName = "installtion";
	$db->primaryField = "id_install";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("client", FormPost("txtclient"), "spring");
	$db->addparameter("address", FormPost("txtaddress"), "spring");
    $db->addparameter("tel", FormPost("txttel"), "string");
    $db->addparameter("system_install", FormPost("fcktxtsystem_install"), "string");
    $db->addparameter("install_type", FormPost("txtinstall_type"), "string");
    $db->addparameter("tank", FormPost("txttank"), "string");
    $db->addparameter("panel", FormPost("txtpanel"), "string");
	
	$db->addparameter("install_date", FormPost("txtinstall_date"), "date");

	$id = $db->save();
    CheckSave($id);
	
	$feedback .= "The update was successful";
	header ('Location: users.php');	
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

<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">JOB CARD VIEW - INSTALLATION</div>

<form name="frmMain" action="" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<?php
$db = new clsDB;
$db->tableName = "installation";
$db->primaryField = "id_install";
$db->primaryValue = $_GET["id"];
$db->loadRecord();
?>

    <table border="0" cellpadding="0" cellspacing="0" class="tableadd" width="100%">
<tr>
	<td class="do_b" width="130">Date:</td>
    <td><input type="text" autocomplete="off" name="txtinstall_date" class="txt2" id="txtName" value="<?php echo $db->getFieldString("install_date"); ?>" /></td>
</tr>
<tr>
	<td class="do_b" width="130">Client:</td>
    <td><input type="text" autocomplete="off" name="txtclient" class="txt2" id="txtName3" value="<?php echo $db->getFieldString("client"); ?>" /></td>
</tr>
<tr>
    <td valign="top" class="do_b">Address:</td>
    <td><input type="text" autocomplete="off" name="txtaddress" class="txt2" id="txtName2" value="<?php echo $db->getFieldString("address"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">Telephone No.: </td>
  <td><input type="text" autocomplete="off" name="txttel" class="txt2" id="txtName4" value="<?php echo $db->getFieldString("tel"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">Cell No.:</td>
  <td><input type="text" autocomplete="off" name="txtcell" class="txt2" id="txtName5" value="<?php echo $db->getFieldString("cell"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">System Installing:</td>
  <td>
  <!-- special instructions -->
  <?php
	$sBasePath = "/fckeditor/";
	$oFCKeditor             = new FCKeditor('fcktxtsystem_install') ;
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Value		= $db->getFieldString("system_install");
	$oFCKeditor->ToolbarSet = "Medium";
	$oFCKeditor->Height     = "200";
	$oFCKeditor->Create() ;
   ?>
  </td>
</tr>
<tr>
  <td valign="top" class="do_b">Tank::</td>
  <td><input type="text" autocomplete="off" name="txttank" class="txt2" id="txtName6" value="<?php echo $db->getFieldString("tank"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">Panel:</td>
  <td><input type="text" autocomplete="off" name="txtpanel" class="txt2" id="txtName7" value="<?php echo $db->getFieldString("panel"); ?>" /></td>
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

