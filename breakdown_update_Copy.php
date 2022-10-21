<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");
$added=false;
if(!empty($_POST['mc_posted'])){
	$first_name=FormPost("first_name");
	$surname=FormPost("surname");
	$mobile=FormPost("mobile");
	$email=FormPost("email");
	$address=FormPost("address");
	$client_id=FormPost("client_id");
	$sql="UPDATE clients SET `first_name`='$first_name', `sur_name`='$surname', `mobile`='$mobile', `email`='$email', `address`='$address' WHERE id=$client_id";
	$added = mysqli_query($sql_conn, $sql);
	$client_id=mysqli_insert_id($sql_conn);
	$service_status=FormPost("service_status");
	$date_logged=FormPost("date_logged");
	$date_attended=FormPost("date_attended");
	$team=FormPost("team");
	$problem=FormPost("problem");
	$actions=FormPost("actions");
	$service_id=FormPost("service_id");
	$sql="UPDATE `services` SET `date_logged`='$date_logged', `date_att`='$date_attended', `problem`='$problem', `action`='$actions', `team`='$team', `complete`='$service_status' WHERE service_id=$service_id";
	$added = mysqli_query($sql_conn, $sql);
}	
$sql="SELECT * FROM clients";
$result = mysqli_query($sql_conn,$sql);
?>
<?php include("admin_header.php"); ?>
<h1>Update Breakdown</h1>
<?php
if($added){
	echo '<div class="alert alert-success"><strong>Successfully! </strong> Breakdown updated.</div>';
}
?>
<div id="add_new_breakdown_form">
	<form id="add_new_form"  method="post">
	<h2>CLIENT DETAIL</h2>
	<div class="formfeild">
	<label>Customer:</label>
	<select name="client" id="client_id" class="select2">
	<?php
	if(empty($_GET['client_id'])){
		echo '<option value="">Select Customer</option>';
	}
	?>
	<?php
	$current_client=0;
	if(!empty($_GET['client_id'])){
		$current_client=$_GET['client_id'];
	}
	while($client=mysqli_fetch_assoc($result)){
		if($current_client==0){
			$current_client=$client['id'];
		}
		$selected='';
		if(!empty($_GET['client_id']) && $_GET['client_id']==$client['id']){
			$selected='selected';
		}
		echo '<option value="'.$client['id'].'" '.$selected.'>'.$client['first_name'].'('.$client['mobile'].')'.'</option>';
	}
	?>
	</select>
	</div>
	<?php
	if(!empty($_GET['client_id'])){
		if(empty($current_client)){
			echo '<h1>Invalid client reference.</h1>';
			exit;
		}
		$sql="SELECT * FROM clients WHERE id=$current_client";
		$result = mysqli_query($sql_conn,$sql);
		$client=mysqli_fetch_assoc($result);
		$sql="SELECT * FROM services WHERE client_id=$current_client";
		$result = mysqli_query($sql_conn,$sql);
		$service=mysqli_fetch_assoc($result);
	?>
	<input type="hidden" name="client_id" value="<?php echo $current_client; ?>">
	<div class="formfeild">
	<label>First Name:</label>
	<input type="text" name="first_name" value="<?php echo $client['first_name'];?>" placeholder="First Name">
	</div>
	<div class="formfeild">
	<label>Surname:</label>
	<input type="text" name="surname" value="<?php echo $client['sur_name'];?>" placeholder="Surname">
	</div>
	<div class="formfeild">
	<label>Mobile:</label>
	<input type="text" name="mobile" autocomplete="off" value="<?php echo $client['mobile'];?>" placeholder="Mobile">
	</div>
	<div class="formfeild">
	<label>Email:</label>
	<input type="email" name="email" autocomplete="off" value="<?php echo $client['email'];?>" placeholder="Email">
	</div>
	<div class="formfeild">
	<label>Address:</label>
	<textarea name="address"rows="6" Placeholder="Address"><?php echo $client['address'];?></textarea>
	</div>
	<h3>BREAKDOWN</h3>
	<input type="hidden" name="service_id" value="<?php echo $service['service_id'];?>">
	<div class="formfeild">
	<label>Service Status:</label>
	<select name="service_status">
		<option value="">Service Status</option>
		<option value="complete" <?php if($service['complete']=='complete'){ echo 'selected'; }?>>Completed</option>
		<option value="not_complete" <?php if($service['complete']=='not_complete'){ echo 'selected'; }?>>Incompleted</option>
	</select>
	</div>
	<div class="formfeild">
	<label>Date Logged:</label>
	<input type="text" name="date_logged" value="<?php echo $service['date_logged'];?>" class="mc_date_picker">
	</div>
	<div class="formfeild">
	<label>Date Attended:</label>
	<input type="text" name="date_attended" value="<?php echo $service['date_att'];?>" class="mc_date_picker">
	</div>
	<div class="formfeild">
	<label>Team:</label>
	<input type="text" name="team" value="<?php echo $service['team'];?>" class="">
	</div>
	<div class="formfeild">
	<label>Problem:</label>
	<textarea name="problem"rows="6" Placeholder="Problem"><?php echo $service['problem'];?></textarea>
	</div>
	<div class="formfeild">
	<label>Actions:</label>
	<textarea name="actions"rows="6" Placeholder="Actions"><?php echo $service['action'];?></textarea>
	</div>
	<div class="formfeild">
	<label>Upload Documents</label>
	<a href="test_service_doc.php?id=0&user=<?php echo $service['service_id'];?>&client_id=<?php echo $current_client; ?>" style="    text-decoration: none;
    display: inline-block;
    background: #4caf50;
    color: #fff;
    padding: 10px 15px;
    border-radius: 5px;" /><div class="upload_btn1">UPLOAD</div></a>
	</div>
	<div class="formfeild">
	<button type="submit" class="mc-btnsubmit">Save</button>
	</div>
	<input type="hidden" name="mc_posted" value="add">
	</form>
	<?php
    $service_job_code = $service['service_id'];
    echo "<script>console.log('service_job_codes: " . $service_job_code ."' );</script>";
    $join_code = $service_job_code = $job_code;
    $sql06 = "select * from service_doc WHERE service_job_code = ".$service['service_id'];

    if ($service_job_code = 0) {
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
	  <?php
	}
	?>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

<!--select with search -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<style>
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
		window.location = '/admin2/breakdown_update.php?client_id='+client_id;
	});
	$("#client_id").select2();
  });
</script>
<!-- datepicker style -->
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<?php include("admin_footer.php"); ?>

