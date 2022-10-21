<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");

$sql = "select * FROM team";
$r = mysqli_query($sql_conn, $sql);

$location = "http://www.solarprimeg.co.za/admin/team_view.php";

if ($_POST){
	$db = new clsDB();
	$db->tableName = "team";
	$db->primaryField = "team_id";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("first_name", FormPost("txtfirst_name"), "string");
	$db->addparameter("last_name", FormPost("txtlast_name"), "string");
	$db->addparameter("active", FormPost("chkActive",false,0), "bit");
	$db->addparameter("modified_date", "now", "date");

	$id = $db->save();
    CheckSave($id);
	
	$feedback .= "The update was successful";
	header ('Location: team_view.php');	
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
<form name="frmMain" action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
<?php
$db = new clsDB;
$db->tableName = "team";
$db->primaryField = "team_id";
$db->primaryValue = $_GET["id"];
$db->loadRecord();
?>

    <table border="0" cellpadding="3" cellspacing="3" class="tableadd" width="100%">
<tr>
	<td class="do_b" width="130">first Name:</td>
    <td><input type="text" autocomplete="off" name="txtfirst_name" class="txt2" id="txtName" value="<?php echo $db->getFieldString("first_name"); ?>" /></td>
</tr>
<tr>
	<td class="do_b" width="130">Last Name:</td>
    <td><input type="text" autocomplete="off" name="txtlast_name" class="txt2" id="txtName" value="<?php echo $db->getFieldString("last_name"); ?>" /></td>
</tr>
<tr>
    <td class="do_b" valign="top">Enabled:</td>
    <td><input type="checkbox" name="chkActive" id="chkActive" value="1"<?php echo $db->getFieldChecked("active") ?> <?php if ($row['team_id'] == $_GET['id'])echo ' selected="selected"'; ?>></td>
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

