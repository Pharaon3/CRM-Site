<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");

$sql = "select * FROM services";
$r = mysqli_query($sql_conn, $sql);

$url = "http://www.solarprimeg.co.za/admin/service_search.php";

if ($_POST){
	$db = new clsDB();
	$db->tableName = "services";
	$db->primaryField = "service_id";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("service_job_code", FormPost("txtservice_job_code"), "string");
	$db->addparameter("date_logged", FormPost("txtdate_logged"), "string");
	$db->addparameter("date_att", FormPost("txtdate_att"), "string");
	$db->addparameter("problem", FormPost("txtproblem"), "string");
    $db->addparameter("action", FormPost("txtaction"), "string");
	$db->addparameter("team", FormPost("txtteam"), "string");
	$db->addparameter("complete", FormPost("txtcomplete"), "string");
	$db->addparameter("next_service", date("Y-m-d", strtotime("+2 years", strtotime(FormPost("txtdate_created")))), "string");

	
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
	<td width="121" class="do_b"><div style="margin:10px">Service Job Code:</div></td>
    <td width="561"><?php echo $db->getFieldString("service_id");?></td>
    <td width="127" align="right">Service Status:</td>
    <td width="132"><div style="margin:5px">
      <select name="txtcomplete">
        <option value="not_complete"<?php if ($row['job_id'] == $_GET['job_id'])echo ' selected="selected"'; ?> >Select option
        	 <option value="complete">Complete</option>
             <option value="not_complete">Incomplete</option>
        </option>
      </select></div></td>
</tr>
<tr>
  <td width="121" class="do_b"><div style="margin:10px">Job No.:</div></td>
  <td width="561"><?php echo $db->getFieldString("service_job_code"); ?></td>
  <td width="127" height="75" align="right" valign="middle" style="margin:10px">View Client:</td> 
  <td><a href="job_card_edit.php?id=<?php echo $db->getFieldString("service_job_code");?>"><div style="margin:5px"><img src="images/icon-client.jpg" width="65" height="65" /></div></a></td>
</tr>
<tr>
  <td valign="top" class="do_b"><div style="margin:10px">Date Logged:</div></td>
  <td colspan="3"><input type="text" style="height:30px" autocomplete="off" name="txtdate_logged" class="txt2" id="datepicker" value="<?php echo $db->getFieldString("date_logged"); ?>" /></td>
<input type="hidden" name="txtdate_created" class="txt2" value="<?php echo $db->getFieldString("current_date"); ?>" />

</tr>
<tr>
  <td valign="top" class="do_b"><div style="margin:10px">Date Attended:</div></td>
  <td colspan="3"><input type="hidden" name="txtnext_service" value="<?php echo $db->getFieldString("next_service"); ?>" /><input type="text" style="height:30px" autocomplete="off" name="txtdate_att" class="txt2" id="datepicker2" value="<?php echo $db->getFieldString("date_att"); ?>" /></td>
</tr>
<tr>
  <td valign="top" class="do_b"><div style="margin:10px">Team:</div></td>
  <td colspan="3"><input type="text" style="height:30px" autocomplete="off" name="txtteam" class="txt2" id="txtteam" value="<?php echo $db->getFieldString("team"); ?>" />
  </td>
</tr>
<tr>
  <td valign="top" class="do_b"><div style="margin:10px">Problem:</div></td>
  <td colspan="3"><div><textarea name="txtproblem" id="fckproblem" rows="10" style="width:700px" class="txt2" autocomplete="off"><?php echo $db->getFieldString("problem"); ?></textarea></div></td>
</tr>
<tr>
  <td valign="top" class="do_b"><div style="margin:10px">Actions:</div></td>
  <td colspan="3"><div><textarea name="txtaction" id="fckaction" rows="10" style="width:700px" class="txt2" autocomplete="off"><?php echo $db->getFieldString("action"); ?></textarea></div></td>
</tr>
<tr>
  <td valign="top" class="do_b">&nbsp;</td>
  <td colspan="3">
<!--------------------------------------------- Upload document  ----------------------------------------------->
<a href="test_service_doc.php?id=0&user=<?php echo $_GET["id"];?>" style="text-decoration:none" /><div class="upload_btn1">UPLOAD DOCUMENTS</div></a>
  <!--------------------------------- ADD DOCUMENT ----------------------------->
  <?php
    $service_job_code = $_GET["id"];
    echo "<script>console.log('service_job_codes: " . $service_job_code ."' );</script>";
    $join_code = $service_job_code = $job_code;
    $sql06 = "select * from service_doc WHERE service_job_code = ".$_GET['id'];
    $r06 = mysqli_query($sql_conn, $sql06); 
    
    if ($service_job_code = 0) {
        echo "No documents available!";
        };
    ?>    
     <fieldset style="border:thin solid #999; background-color: #FFF">
      <table border="0" cellpadding="3" cellspacing="3" class="tableadd" width="100%">
        <tr>
          <td colspan="4" bgcolor="#CCCCCC" class="do_b"><table width="100%" border="0" cellspacing="10" cellpadding="10">
            <tr>
              <th align="left" valign="top" class="heading_01" scope="col">Service Documents</th>
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
          <td class="do_b"><?php echo $row['service_doc_id'] ?></td>
          <td><?php echo $row['date'] ?></td>
          <td><?php echo $row['description'] ?></td>
          <td><a href="http://www.solarprimeg.co.za/upload/upload_service_doc/<?php echo $row['image'] ?>"><?php echo $row['image'] ?></a></td>
        </tr>
        <?php } ?>
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
<!--
        <script>
            CKEDITOR.replace( 'fckproblem' );
			CKEDITOR.replace( 'fckaction' );
        </script>
-->
</form>


<?php include("admin_footer.php"); ?>

