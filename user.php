<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");

$sql = "select * FROM users";
$r = mysqli_query($sql_conn, $sql);

$location = "http://www.pixelgraphics.co.za/admin/user.php";

if ($_POST){
	$db = new clsDB();
	$db->tableName = "users";
	$db->primaryField = "user_id";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("username", FormPost("txtName"), "string");
	$db->addparameter("password", FormPost("txtPassword"), "string");
	$db->addparameter("active", FormPost("chkActive",false,0), "bit");
	$db->addparameter("modified_date", "now", "date");

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
<form name="frmMain" action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
<?php
$db = new clsDB;
$db->tableName = "users";
$db->primaryField = "user_id";
$db->primaryValue = $_GET["id"];
$db->loadRecord();
?>

    <table border="0" cellpadding="0" cellspacing="0" class="tableadd" width="100%">
<tr>
	<td class="do_b" width="130">Username:</td>
    <td><input type="text" autocomplete="off" name="txtName" class="txt2" id="txtName" value="<?php echo $db->getFieldString("username"); ?>" /></td>
</tr>
<tr>
	<td class="do_b" width="130">Password:</td>
    <td><input type="password" autocomplete="off" name="txtPassword" class="txt2" id="txtPassword" value="<?php echo $db->getFieldString("password"); ?>" /></td>
</tr>
<tr>
    <td class="do_b" valign="top">Enabled:</td>
    <td><input type="checkbox" name="chkActive" id="chkActive" value="1"<?php echo $db->getFieldChecked("active") ?>></td>
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

