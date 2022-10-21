<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../fckeditor/fckeditor.php");
include("../includes/dbconn.php");

$sql = "select * FROM fac_job_panels";
$r = mysqli_query($sql);

$location = "http://www.solarprimeg.co.za/admin/service_view.php";

if ($_POST){
	$db = new clsDB();
	$db->tableName = "service";
	$db->primaryField = "service_id";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("client", FormPost("txtclient"), "spring");
	$db->addparameter("date_logged", FormPost("txtdate_logged"), "date");
	$db->addparameter("address", FormPost("txtaddress"), "spring");
    $db->addparameter("tel", FormPost("txttel"), "string");
    $db->addparameter("system", FormPost("txtsystem"), "string");
    $db->addparameter("mobile", FormPost("txtmobile"), "string");
    $db->addparameter("reason", FormPost("fckreason"), "string");
    $db->addparameter("date_attended", FormPost("txtdate_attended"), "string");
    $db->addparameter("team_attended", FormPost("txtteam_attended"), "string");
    $db->addparameter("problem", FormPost("txtproblem"), "string");
    $db->addparameter("action", FormPost("txtaction"), "string");

	$id = $db->save();
    CheckSave($id);
	
	$feedback .= "The update was successful";
	header ('Location: users.php');	
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
<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">JOB CARD - SERVICE</div>

<form name="frmMain" action="" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<?php
$db = new clsDB;
$db->tableName = "service";
$db->primaryField = "service_id";
$db->primaryValue = $_GET["id"];
$db->loadRecord();
?>

    <table border="0" cellpadding="3" cellspacing="3" class="tableadd" width="100%">
<tr>
	<td class="do_b" width="130">Service Job No.:</td>
    <td><span class="do_b"><?php echo $row['date_logged'] ?></span></td>
</tr>
<tr>
	<td class="do_b" width="130">Date Logged:</td>
    <td><input type="text" autocomplete="off" name="txtdate_logged" class="txt2" id="txtdate_logged" value="<?php echo $db->getFieldString("date_logged"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">System:</td>
  <td><input type="text" autocomplete="off" name="txtsystem" class="txt2" id="txtsystem" value="<?php echo $db->getFieldString("system"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b">Problem:</td>
  <td><textarea name="fckinstructions" class="txt2" id="fckinstructions" autocomplete="off"><?php echo $db->getFieldString("instructions"); ?></textarea> </td>
</tr>
<tr>
  <td valign="top" class="do_b">&nbsp;</td>
  <td>
    <!-- attendence -->
  <fieldset style="border:thin solid #999; padding:10px; max-width:450px">
      <table width="450" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <th width="129" align="left" scope="col">Date Attended to:</th>
          <th width="307" align="left" valign="top" scope="col">
          		<input type="text" autocomplete="off" name="txtdate_attended" class="txt2" id="txtwater_test_by" value="<?php echo $db->getFieldString("date_attended"); ?>" /></th>
        </tr>
        <tr>
          <td align="left">Team Attended:</td>
          <td align="left" valign="top"><input type="text" autocomplete="off" name="txtteam_attended" class="txt2" id="txtteam_attended" value="<?php echo $db->getFieldString("team_attended"); ?>" /></td>
        </tr>
      </table>
  </fieldset>
  </td>
</tr>
<tr>
  <td valign="top" class="do_b">&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="do_b">&nbsp;</td>
  <td>
      <!-- problem -->
  <fieldset style="border:thin solid #999; padding:10px; max-width:450px">
      <table width="450" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <th width="129" align="left" scope="col">Problem Identified:</th>
          <th width="307" align="left" valign="top" class="do_b" scope="col">
          		<input type="text" autocomplete="off" name="txtproblem" class="txt2" id="txtproblem" value="<?php echo $db->getFieldString("problem"); ?>" /></th>
        </tr>
        <tr>
          <td align="left">Action Taken:</td>
          <td align="left" valign="top">
          		<input type="text" autocomplete="off" name="txtaction" class="txt2" id="txtaction" value="<?php echo $db->getFieldString("action"); ?>" /></td>
        </tr>
      </table>
  </fieldset>
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
      <script>
            CKEDITOR.replace( 'fckinstructions' );
        </script>
</form>



<?php include("admin_footer.php"); ?>

