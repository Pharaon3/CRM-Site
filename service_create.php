<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");

$sql = "select * FROM services";
$r = mysqli_query($sql);

$url = "http://www.solarprimeg.co.za/admin/service_view.php";

if ($_POST){
	$db = new clsDB();
	$db->tableName = "services";
	$db->primaryField = "service_id";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("date_logged", FormPost("txtdate_logged"), "string");
	$db->addparameter("date_att", FormPost("txtdate_att"), "string");
	$db->addparameter("problem", FormPost("txtproblem"), "string");
    $db->addparameter("action", FormPost("txtaction"), "string");
	$db->addparameter("team", FormPost("txtteam"), "string");
	$db->addparameter("next_service", date("Y-m-d", strtotime("+2 years", strtotime(FormPost("txtdate_att")))), "string");

	
	$id = $db->save();
    CheckSave($id);
		
	echo 'Saving...';
	echo '<script>window.location = "'.$url.'";</script>';
	echo '<div style="background-color:#d1ffd3; padding:10px; color: black; width:100%; margin:10px">Successfully saved!</div>';
}
?>
<?php include("admin_header.php"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

<!--select with search -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $(".js-example-basic-single").select2();
});
</script>

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

  });
</script>
<!-- print function -->
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>

<div style="float:right; margin:5px; margin-top:-10px"><button onClick="printContent('div1')" >Print Content</button></div>

<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">SERVICE</div>


<form name="frmMain" action="" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<?php
$db = new clsDB;
$db->tableName = "services";
$db->primaryField = "service_id";
$db->primaryValue = $_GET["id"];
$db->loadRecord();
?>

    <table border="0" cellpadding="5" cellspacing="5" class="tableadd" width="100%" id="div1">
<tr>
  <td width="121" valign="top" class="do_b"><div style="margin:10px">Date Logged:</div></td>
  <td><input type="text" style="height:30px" autocomplete="off" name="txtdate_logged" class="txt2" id="datepicker" value="<?php echo $db->getFieldString("date_logged"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b"><div style="margin:10px">Date Attended:</div></td>
  <td><input type="hidden" name="txtnext_service" value="<?php echo $db->getFieldString("next_service"); ?>" /><input type="text" style="height:30px" autocomplete="off" name="txtdate_att" class="txt2" id="datepicker2" value="<?php echo $db->getFieldString("date_att"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b"><div style="margin:10px">Team:</div></td>
  <td><div>
  <?php  $sql3 = mysqli_query("SELECT * FROM team")     ?>
      				   <select name="txtteam">
                       <?php  while($row = mysqli_fetch_assoc($sql3) ):  ?>
                        <option value="<?= $row['first_name']; ?>" <?php if ($row['service_id'] == $_GET['service_id'])echo ' selected="selected"'; ?> >
                            <?= $row['first_name'];  ?>&nbsp;<?= $row['last_name'];  ?>
                          </option>
                       <?php endwhile; ?>
                      </select>
  </div>
  </td>
</tr>
<tr>
  <td valign="top" class="do_b"><div style="margin:10px">Problem:</div></td>
  <td><div><textarea name="txtproblem" id="fckproblem" rows="10" style="width:700px" class="txt2" autocomplete="off"><?php echo $db->getFieldString("problem"); ?></textarea></div></td>
</tr>
<tr>
  <td valign="top" class="do_b"><div style="margin:10px">Actions:</div></td>
  <td><div><textarea name="txtaction" id="fckaction" rows="10" style="width:700px" class="txt2" autocomplete="off"><?php echo $db->getFieldString("action"); ?></textarea></div></td>
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
            CKEDITOR.replace( 'fckproblem' );
			CKEDITOR.replace( 'fckaction' );
        </script>
</form>


<?php include("admin_footer.php"); ?>

