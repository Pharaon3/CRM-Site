<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");

$sql_id = "select job_id FROM job_card ORDER BY job_id desc limit 1";
$r_id = mysqli_query($sql_conn, $sql_id); 
while($row = mysqli_fetch_array($r_id)){
	//echo $row['job_id'];
	
$job_id_1 = $row['job_id'];
$job_id_2 = 1;
$add_id = $job_id_1 + $job_id_2;
$url = "http://solarprimeg.co.za/admin2/select_2.php?id=".$job_id_1;

if ($_POST){
	$db = new clsDB();
	$db->tableName = "job_card";
	$db->primaryField = "job_id";
	$db->primaryValue = $_GET["id"];
	$db->addparameter("first_name", FormPost("txtfirst_name"), "string");
	$db->addparameter("job_code", FormPost("txtjob_code"), "string");
	$db->addparameter("surname", FormPost("txtsurname"), "string");
	$db->addparameter("address", FormPost("txtaddress"), "string");
	$db->addparameter("cell", FormPost("txtcell"), "string");
    $db->addparameter("email", FormPost("txtemail"), "string");
	$db->addparameter("tel", FormPost("txttel"), "string");
	/*  INSTALLATION */
	$db->addparameter("install_tank", FormPost("txtinstall_tank"), "string");
	$db->addparameter("install_panel", FormPost("txtinstall_panel"), "string");
	$db->addparameter("date_install", FormPost("txtdate_install"), "string");
	$db->addparameter("system_install", FormPost("txtsystem_install"), "string");
	$db->addparameter("install_type", FormPost("txtinstall_type"), "string");
	$db->addparameter("install_extra1", FormPost("txtinstall_extra1"), "string");
	$db->addparameter("install_extra2", FormPost("txtinstall_extra2"), "string");
	$db->addparameter("install_extra3", FormPost("txtinstall_extra3"), "string");
	$db->addparameter("install_extra4", FormPost("txtinstall_extra4"), "string");
	$db->addparameter("install_extra5", FormPost("txtinstall_extra5"), "string");
	$id = $db->save();
    CheckSave($id);
		
	echo 'Saving...';
	echo '<script>window.location.href = "'.$url.'";</script>';
}}
?>
<?php include("admin_header.php"); ?>
<script src="../js/js.js"></script>

<script src="https://cdn.ckeditor.com/4.7.0/basic/ckeditor.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- datepicker style -->
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
  
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
?>

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
      <td class="do_b">First Name:</td>
      <td><input type="text" autocomplete="off" name="txtfirst_name"  class="txt2" value="<?php echo $db->getFieldString("first_name"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b">Surname:</td>
      <td><input type="text" autocomplete="off" name="txtsurname" class="txt2" value="<?php echo $db->getFieldString("surname"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b">Mobile: </td>
      <td><input type="text" autocomplete="off" name="txtcell" class="txt2" value="<?php echo $db->getFieldString("cell"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b">Email Id: </td>
      <td><input type="text" autocomplete="off" name="txtemail" class="txt2" value="<?php echo $db->getFieldString("email"); ?>" /></td>
    </tr>

    <tr>
      <td valign="top" class="do_b">Tel:</td>
      <td><input type="text" autocomplete="off" name="txttel" class="txt2" id="txtName3" value="<?php echo $db->getFieldString("tel"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b">Address:</td>
      <td><textarea name="txtaddress" class="txt2"  autocomplete="off"><?php echo $db->getFieldString("address"); ?></textarea></td>
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
      <td width="134" class="do_b">Installation Date:</td>
      <td width="1057"><input type="text" id="datepicker2" autocomplete="off" name="txtdate_install" class="txt2" value="<?php echo $db->getFieldString("date_install"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b">System Install:</td>
      <td><input type="text" autocomplete="off" name="txtsystem_install" class="txt2" value="<?php echo $db->getFieldString("system_install"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b">Installation Type: </td>
      <td><input type="text" autocomplete="off" name="txtinstall_type" class="txt2" id="txtName4" value="<?php echo $db->getFieldString("install_type"); ?>" /></td>
    </tr>
    <tr>
      <td valign="top" class="do_b">Serial - Tank:</td>
      <td>			 
      <?php  $sql20 = mysqli_query($sql_conn,"SELECT * FROM fac_job_tank")     ?>
      				   <select name="txtinstall_tank">
                       <?php  while($row = mysqli_fetch_assoc($sql20) ):  ?>
                        <option value="">Select your factory tank</option>
                        <option value="<?= $row['serial_code']; ?>" <?php if ($row['job_id'] == $_GET['job_id'])echo ' selected="selected"'; ?> >
                            <?= $row['serial_code'];  ?>
                          </option>
                        <?php endwhile; ?>
                      </select>
      </td>
    </tr>
    <tr>
      <td valign="top" class="do_b">Serial - Panel:</td>
      <td>           
      <?php  $sql21 = mysqli_query($sql_conn, "SELECT * FROM fac_job_panels")     ?>
      				   <select name="txtinstall_panel">
                       <?php  while($row = mysqli_fetch_assoc($sql21) ):  ?>
                        <option value="">Select your factory panel</option>
                        <option value="<?= $row['serial_no']; ?>" <?php if ($row['job_id'] == $_GET['job_id'])echo ' selected="selected"'; ?> >
                            <?= $row['serial_no'];  ?>
                          </option>
                       <?php endwhile; ?>
                      </select>
                     </td>
    </tr>
    <tr>
      <td rowspan="5" valign="top" class="do_b">Extra Panels/Parts</td>
      <td><textarea name="txtinstall_extra1" rows="1" style="width:100%"; class="txt2" autocomplete="off"><?php echo $db->getFieldString("install_extra1"); ?></textarea></td>
    </tr>
    <tr>
      <td><textarea name="txtinstall_extra2" rows="1" style="width:100%"; class="txt2" autocomplete="off"><?php echo $db->getFieldString("install_extra2"); ?></textarea></td>
    </tr>
    <tr>
      <td><textarea name="txtinstall_extra3" rows="1" style="width:100%"; class="txt2" autocomplete="off"><?php echo $db->getFieldString("install_extra3"); ?></textarea></td>
    </tr>
    <tr>
      <td><textarea name="txtinstall_extra4" rows="1" style="width:100%"; class="txt2" autocomplete="off"><?php echo $db->getFieldString("install_extra4"); ?></textarea></td>
    </tr>
    <tr>
      <td><textarea name="txtinstall_extra5" rows="1" style="width:100%"; class="txt2" autocomplete="off"><?php echo $db->getFieldString("install_extra5"); ?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" valign="top" class="do_b">
<!--------------------------------------- iframe  ------------------------------------------------------>
<iframe src="http://www.solarprimeg.co.za/admin2/test_install_doc.php" height="125" width="1200"></iframe>
<!------------------------------- installed documentation ---------------------------------------------->

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

<table width="100%">
<tr>
	<td colspan="2" align="left">
        <div id="validate_response"></div>
    </td>
</tr>
</table>
        <script>
            CKEDITOR.replace( 'fckinstructions' );
        </script>
</form>


<?php include("admin_footer.php"); ?>

