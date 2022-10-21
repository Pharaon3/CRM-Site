<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");
$updated=false;
if(!empty($_POST['mc_posted'])){
	$client_id=FormPost("client_id");
	$service_status=FormPost("service_status");
	$breakdown_date_log=FormPost("breakdown_date_log");
	$breakdown_date_att=FormPost("breakdown_date_att");
	$breakdown_team=FormPost("breakdown_team");
	$breakdown_problem=FormPost("breakdown_problem");
	$breakdown_action=FormPost("breakdown_action");
	$breakdown_id=FormPost("breakdown_id");
	$sql="UPDATE `breakdown` SET 
				`breakdown_date_log`='$breakdown_date_log', 
				`breakdown_date_att`='$breakdown_date_att', 
				`breakdown_team`='$breakdown_team', 
				`breakdown_problem`='$breakdown_problem', 
				`breakdown_action`='$breakdown_action', 
				`service_status`='$service_status' 
				WHERE breakdown_id=$breakdown_id";
	if( mysqli_query($sql_conn, $sql) ){
		$updated = true;
		
		if(isset($_FILES['file_upload']) && $_FILES['file_upload']['name'] !=""){
			$ext_arr = array("jpg", "png", "gif", "pdf");
			
			$uploaded_ext = pathinfo($_FILES["file_upload"]["name"], PATHINFO_EXTENSION);
			if(in_array($uploaded_ext, $ext_arr) !== false) {
				$imageValue = $_FILES["file_upload"]["name"];
				$target_file = "../upload/breakdown_doc/$imageValue";
				if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
				//INSERT INTO breakdown docs
					$qu_breakdown_doc_ins = "INSERT INTO `breakdown_doc` (
										`image`, 
										`breakdown_id`
									) VALUES (
										'".$imageValue."', 
										'".$breakdown_id."'
									);";

					if(!mysqli_query($sql_conn, $qu_breakdown_doc_ins)){
						die("ERROR UPLOAD");
					}
					
					
					
					
					
					
				}
				else{
					die("Unable to upload document");
				}
				
			} 
			else{
				die("Image file is fake");
			}
		}

		
	}
}



$client_id = 0;
if( isset( $_GET['client_id'] ) ){
	$client_id = ( int ) $_GET['client_id'];
}

$breakdown_id = 0;
if( isset( $_GET['breakdown_id'] ) ){
	$breakdown_id = ( int ) $_GET['breakdown_id'];
}











?>
<?php include("admin_header.php"); ?>


<?php

//set to delete code
$ref =  $_GET['breakdown_id'];

if(isset($_GET["delete"])){
    
	$feedback = "<div style='background-color:#fda8ab; padding: 10px'>Are you sure you want to delete this entry  <a href='http://www.solarprimeg.co.za/admin2/breakdown_update.php?breakdown_id=$ref&cd=true'>Yes</a>  <a href='http://www.solarprimeg.co.za/admin/breakdown_update.php'>No</a>?</div>";
}

if(isset($_GET['cd'])){

 // echo "Hello";
//  exit;
$sql_delete = "DELETE FROM breakdown WHERE breakdown_id ='$ref'";
$delete = mysqli_query($sql_conn,$sql_delete);
header("Location:breakdown_update.php");
exit;

}
//end of set to delete

?>
<h1>Update Breakdown</h1>
<?=  isset($feedback)? $feedback."<br /><br />" : "";  ?>

View client Job Card:<br/>
<a href="job_card_edit.php?id=<?php echo $client_id;?>"><div style="margin:5px"><img src="images/icon-client.jpg" width="65" height="65" /></div></a>

<?php
if($updated){
	echo '<div onclick="$(this).remove();" class="alert alert-success"><strong>Successfully! </strong> Breakdown updated.</div>';
}
?>
<div id="add_new_breakdown_form" style="width:70%;max-width: 100%;">
	<form id="add_new_form"  method="post" enctype="multipart/form-data">
	<h2>CLIENT DETAIL</h2>
	
	<div class="formfeild">
	<label>Customer:</label>
	<select name="client_id" id="client_id" class="select2">
	<?php
	$sql="SELECT * FROM job_card";
	$result = mysqli_query($sql_conn,$sql);
	echo '<option value="0">Select Customer</option>';
	
	while($client=mysqli_fetch_assoc($result)){
		echo '<option value="'.$client['job_id'].'" >'.$client['job_code'].'-'.$client['first_name'].'('.$client['cell'].')</option>';
	}
	?>
	</select>
<script>
$('#client_id').val('<?php echo $client_id; ?>');
</script>
	</div>
<?php
if( $client_id == 0 ){
	//show client selector
?>

<?php
} else {
	//select client and show details
	$sql="SELECT * FROM job_card WHERE job_id=$client_id";
	$result = mysqli_query($sql_conn,$sql);
	$client=mysqli_fetch_assoc($result);
?>
	<input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
	<div class="formfeild">
	<label>First Name:</label>
	<input type="text" name="first_name" value="<?php echo $client['first_name'];?>" placeholder="First Name" disabled>
	</div>
	<div class="formfeild">
	<label>Surname:</label>
	<input type="text" name="surname" value="<?php echo $client['surname'];?>" placeholder="Surname" disabled>
	</div>
	<div class="formfeild">
	<label>Mobile:</label>
	<input type="text" name="mobile" autocomplete="off" value="<?php echo $client['cell'];?>" placeholder="Mobile" disabled>
	</div>
	<div class="formfeild">
	<label>Email:</label>
	<input type="email" name="email" autocomplete="off" value="<?php echo $client['email'];?>" placeholder="Email" disabled>
	</div>
	<div class="formfeild">
	<label>Address:</label>
	<textarea name="address"rows="6" Placeholder="Address" disabled><?php echo $client['address'];?></textarea>
	</div>
<?php
}
?>
<?php
// either list all breakdowns or list specific one


if( $breakdown_id == 0 ){
	//list all break downs
	if( $client_id == 0 ){
		echo "Select Client to View Breakdowns";
	} else {
		//list all break downs as per client selected
?>
		

	<h3>BREAKDOWNS LIST</h3>

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
$sql20 = "select * from breakdown WHERE client_id = '$client_id' order by breakdown_id desc";
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
		
		
		
		
		
		
<?php
	}
	
} else {
	//list specific breakdown
		$sql="SELECT * FROM breakdown WHERE breakdown_id=$breakdown_id";
		$result = mysqli_query($sql_conn,$sql);
		$breakdownData=mysqli_fetch_assoc($result);
?>
	<h3>BREAKDOWN DETAILS</h3>
	<input type="hidden" name="breakdown_id" value="<?php echo $breakdownData['breakdown_id'];?>">
	<input type="hidden" name="service_status" value="complete">
	<div class="formfeild">
	<label>Breakdown Id:</label>
	<input type="text" name="whatever" value="<?php echo $breakdownData['breakdown_id'];?>" class="" disabled>
	</div>

	<div class="formfeild">
	<label>Date Logged:</label>
	<input type="text" name="breakdown_date_log" value="<?php echo $breakdownData['breakdown_date_log'];?>" class="mc_date_picker">
	</div>
	<div class="formfeild">
	<label>Date Attended:</label>
	<input type="text" name="breakdown_date_att" value="<?php echo $breakdownData['breakdown_date_att'];?>" class="mc_date_picker">
	</div>
	<div class="formfeild">
	<label>Team:</label>
	<input type="text" name="breakdown_team" value="<?php echo $breakdownData['breakdown_team'];?>" class="">
	</div>
	<div class="formfeild">
	<label>Problem:</label>
	<textarea name="breakdown_problem" rows="6" Placeholder="Problem"><?php echo $breakdownData['breakdown_problem'];?></textarea>
	</div>
	<div class="formfeild">
	<label>Actions:</label>
	<textarea name="breakdown_action"rows="6" Placeholder="Actions"><?php echo $breakdownData['breakdown_action'];?></textarea>
	</div>

	<div class="formfeild">
	<label>Upload Documents</label>
<input type="file" name="file_upload" class="txt2" id="file_upload" style="width:100% !important" accept="image/*,application/pdf" value="" />
	</div>
	
	<div class="formfeild">
	<button type="submit" class="mc-btnsubmit">Save</button>
	</div>
	<input type="hidden" name="mc_posted" value="add">
<?php
}
?>
<?php

?>

<br>
<br>
<br>

<?php
$sql21 = "select * from breakdown_doc WHERE breakdown_id = '$breakdown_id' order by breakdown_id desc";
$r21 = mysqli_query($sql_conn, $sql21);
$tot = 0;
if( mysqli_num_rows($r21) > 0 ){
?>
	<h3>BreakDOWN DOCUMENTS</h3>
<table style="width:100%;" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
<thead>
<tr>
	<th width="74">View</th>
	<th width="74">ID</th>
    <th width="174">Date Uploaded</th>
    <th width="174">Doc Name</th>
</tr>
</thead>
<tbody>
<?php
while($breakdownDoc = mysqli_fetch_array($r21)){
	$tot++;
?>
<tr>
	<td><a href="../upload/breakdown_doc/<?php echo $breakdownDoc['image'] ?>" target="_blank"><img src="images/icon-edit.png" border="0" /></a></td>
	<td width="052"><?php echo $breakdownDoc['breakdown_doc_id'] ?></td>
	<td width="174"><?php echo $breakdownDoc['current_date'] ?></td>
	<td width="174"><?php echo $breakdownDoc['image'] ?></td>
</tr>
<?php
 }
?>
</tbody>
</table>
<?php
 }
?>
	</form>
</div><!-- END OF MAIN DIV -->



<table width="100%">
<tr>
    <td width="95%">
    <!--admin can ONLY see this -->
    <?php 
   
	if($_SESSION['UserName'] == 'jorge'){
		echo
		
	"<a href='breakdown_update.php?breakdown_id=$ref&delete=true'><img src='images/icon-delete.jpg' /></a>";

		}else{
			if($_SESSION['UserName'] == 'megan'){
		echo
		
	"<a href='breakdown_update.php?breakdown_id=$ref&delete=true'><img src='images/icon-delete.jpg' /></a>";
			
			}else{
			}}
	 ?>
    <!--admin can ONLY see this -->
    </td>
</tr>
</table>


<?php
/*

	<?php
    $breakdownData_job_code = $breakdownData['breakdown_id'];
    echo "<script>console.log('service_job_codes: " . $breakdownData_job_code ."' );</script>";
    $join_code = $breakdownData_job_code = $job_code;
    $sql06 = "select * from service_doc WHERE service_job_code = ".$breakdownData['breakdown_id'];

    if ($breakdownData_job_code = 0) {
        echo "No documents available!";
        };
    ?>    
     <fieldset style="border: thin solid #999;
    background-color: #FFF;
    display: block;
    width: 100%;
    margin-top: 63px;">
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
		if(mysqli_query($sql_conn, $sql06)){
		$r06 = mysqli_query($sql_conn, $sql06);
		while($row = mysqli_fetch_array($r06)){
			
		?>
        <tr>
          <td class="do_b"><?php echo $row['service_doc_id'] ?></td>
          <td><?php echo $row['date'] ?></td>
          <td><?php echo $row['description'] ?></td>
          <td><a href="http://www.solarprimeg.co.za/upload/upload_service_doc/<?php echo $row['image'] ?>"><?php echo $row['image'] ?></a></td>
        </tr>
        <?php } }?>
      </table>
      </fieldset>

*/
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

<!--select with search -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<style>
.complete{
	background-color: #5eea81;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    width: 100px;
    padding: 10px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    border-radius: 7px;
	font-weight:normal !important;
}
.complete:after{
	content:"Complete";
}
.not_complete{
	background-color: #e9a4a9;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    width: 100px;
    padding: 10px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    border-radius: 7px;
	font-weight:normal !important;
}
.not_complete:after{
	content:"Incomplete";
}

div#add_new_breakdown_form {
    max-width: 400px;
    margin-bottom: 100px;
}
form#add_new_form .formfeild {
    width: 100%;
    margin-top: 10px;
}

form#add_new_form .formfeild label {
    display: inline-block;
    width: 20%;
    vertical-align: top;
    font-weight: bold;
}

form#add_new_form .formfeild input, form#add_new_form .formfeild textarea, form#add_new_form .formfeild select {
    width: 76%;
    border: 1px solid #ccc;
    min-height: 20px;
    padding: 5px;
}

form#add_new_form .formfeild select {
    height: 29px;
    width: 78%;
}

form#add_new_form 
 button.mc-btnsubmit {
    background: #000;
    color: #fff;
    padding: 10px 15px;
    border-radius: 0px;
    font-size: 15px;
    border-radius: 5px;
    float: right;
    cursor: pointer;
}
.alert.alert-success {
    background: green;
    color: #fff;
    padding: 15px 10px;
    border-radius: 5px;
    max-width: 400px;
}
</style>
<script>
  $(document).ready(function() {
    $(".mc_date_picker").datepicker({
	dateFormat: 'yy-mm-dd',
	startDate:'01/01/2000', // first selectable date is 1st Jan 2000
	});
	$("#client_id").change(function(e){
		e.preventDefault();
		var client_id=$("#client_id :selected").val();
		window.location = 'breakdown_update.php?client_id='+client_id;
	});
	$("#client_id").select2();
  });
</script>
<!-- datepicker style -->
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<?php include("admin_footer.php"); ?>

