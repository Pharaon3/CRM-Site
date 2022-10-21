<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");
$added=false;
if(!empty($_POST['mc_posted'])){
	$first_name=FormPost("first_name");
	$surname=FormPost("surname");
	$mobile=FormPost("cell");
	$email=FormPost("email");
	$address=FormPost("address");
	$sql="INSERT INTO clients (`first_name`, `surname`, `cell`, `email`, `address`) VALUES('$first_name', '$surname', '$cell','$email','$address' )";
	$added = mysqli_query($sql_conn, $sql);
	$client_id=mysqli_insert_id($sql_conn);
	$service_status=FormPost("service_status");
	$breakdown_date_log=FormPost("breakdown_date_log");
	$breakdown_date_att=FormPost("breakdown_date_att");
	$breakdown_team=FormPost("breakdown_team");
	$breakdown_problem=FormPost("breakdown_problem");
	$breakdown_action=FormPost("breakdown_action");
	$sql="INSERT INTO `job_card`(`job_code`, `breakdown_date_log`, `breakdown_date_att`, `breakdown_problem`, `breakdown_action`, `breakdown_team`, `breakdown_complete`) VALUES('0','$breakdown_date_log','$breakdown_date_att','$breakdown_problem','$breakdown_actions','$breakdown_team','$service_status')";
	$added = mysqli_query($sql_conn, $sql);
}
?>
<?php include("admin_header.php"); ?>
<h1>Add New Breakdown</h1>
<?php
if($added){
	echo '<div class="alert alert-success"><strong>Successfully! </strong> Breakdown added.</div>';
}
?>
<div id="add_new_breakdown_form">
	<form id="add_new_form"  method="post">
        
    <input type="text" name="job_code" hidden="hidden" value="<?php $_GET["id"] ?>" placeholder="First Name">
        
	<h2>CLIENT DETAIL</h2>
	<div class="formfeild">
	<label>First Name:</label>
	<input type="text" name="first_name" value="" placeholder="First Name">
	</div>
	<div class="formfeild">
	<label>Surname:</label>
	<input type="text" name="surname" value="" placeholder="Surname">
	</div>
	<div class="formfeild">
	<label>Mobile:</label>
	<input type="text" name="cell" autocomplete="off" value="" placeholder="Cell">
	</div>
	<div class="formfeild">
	<label>Email:</label>
	<input type="email" name="email" autocomplete="off" value="" placeholder="Email">
	</div>
	<div class="formfeild">
	<label>Address:</label>
	<textarea name="address"rows="6" Placeholder="Address"></textarea>
	</div>
	<h3>BREAKDOWN</h3>
	<div class="formfeild">
	<label>Service Status:</label>
	<select name="service_status">
		<option value="">Service Status</option>
		<option value="complete">Completed</option>
		<option value="not_complete">Incompleted</option>
	</select>
	</div>
	<div class="formfeild">
	<label>Date Logged:</label>
	<input type="text" name="breakdown_date_log" value="" class="mc_date_picker">
	</div>
	<div class="formfeild">
	<label>Date Attended:</label>
	<input type="text" name="breakdown_date_att" value="" class="mc_date_picker">
	</div>
	<div class="formfeild">
	<label>Team:</label>
	<input type="text" name="breakdown_team" value="" class="">
	</div>
	<div class="formfeild">
	<label>Problem:</label>
	<textarea name="breakdown_problem"rows="6" Placeholder="Problem"></textarea>
	</div>
	<div class="formfeild">
	<label>Actions:</label>
	<textarea name="breakdown_action"rows="6" Placeholder="Actions"></textarea>
	</div>
	<div class="formfeild">
	<button type="submit" class="mc-btnsubmit">Save</button>
	</div>
	<input type="hidden" name="mc_posted" value="add">
	</form>
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

  });
</script>
<!-- datepicker style -->
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<?php include("admin_footer.php"); ?>

