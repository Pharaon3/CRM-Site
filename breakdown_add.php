<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");
$added=false;
if(!empty($_POST['mc_posted'])){
	/*
	$first_name=FormPost("first_name");
	$surname=FormPost("surname");
	$mobile=FormPost("mobile");
	$email=FormPost("email");
	$address=FormPost("address");
	$sql="INSERT INTO clients (`first_name`, `surname`, `mobile`, `email`, `address`) VALUES('$first_name', '$surname', '$mobile','$email','$address' )";
	$added = mysqli_query($sql_conn, $sql);
	$client_id=mysqli_insert_id($sql_conn);
	*/
	//$client_id= ( int ) $_POST['client_id'];
	$breakdown_id = 0;
	$client_id=FormPost("client_id");
	$service_status=FormPost("service_status");
	$date_logged=FormPost("date_logged");
	$date_attended=FormPost("date_attended");
	$team=FormPost("team");
	$problem=FormPost("problem");
	$actions=FormPost("actions");
	$sql="INSERT INTO `breakdown`(`service_status`, `breakdown_date_log`, `breakdown_date_att`, `breakdown_team`, `breakdown_problem`, `breakdown_action`, `job_code`, `client_id`) VALUES(
									'$service_status','$date_logged','$date_attended','$team','$problem','$actions','0','$client_id')";
	
	if( mysqli_query($sql_conn, $sql) ){
		$breakdown_id =  mysqli_insert_id($sql_conn);
		$added = true;
		if( $breakdown_id ){
			
			
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

			
			
			
			
			
			
			
		} // key check
		

		
	}
}
?>
<?php include("admin_header.php"); ?>
<h1>Add New Breakdown</h1>
<?php
if($added){
	echo '<div onclick="$(this).remove();" class="alert alert-success"><strong>Successfully! </strong> Breakdown added.</div>';
}
?>
<div id="add_new_breakdown_form" style="width:70%;max-width: 100%;">
	<form id="add_new_form"  method="post" enctype="multipart/form-data">
	<h2>CLIENT DETAIL</h2>
	<div class="formfeild">
	<label>Customer:</label>
	<select id="client_id" name="client_id" class="select2">
	<?php
		echo '<option value="">Select Customer</option>';

$sql="SELECT * FROM job_card";
$result = mysqli_query($sql_conn,$sql);
	while($client=mysqli_fetch_assoc($result)){
		
		echo '<option value="'.$client['job_id'].'" >'.$client['job_code'].'-'.$client['first_name'].'('.$client['cell'].')</option>';
	}
	?>
	</select>
	</div>
	
	
	
	
	
	
	
	<h3>BREAKDOWN</h3>

	<input type="hidden" name="service_status" value="complete">

	<div class="formfeild">
	<label>Date Logged:</label>
	<input type="text" name="date_logged" value="" class="mc_date_picker">
	</div>
	<div class="formfeild">
	<label>Date Attended:</label>
	<input type="text" name="date_attended" value="" class="mc_date_picker">
	</div>
	<div class="formfeild">
	<label>Team:</label>
	<input type="text" name="team" value="" class="">
	</div>
	<div class="formfeild">
	<label>Problem:</label>
	<textarea name="problem"rows="6" Placeholder="Problem"></textarea>
	</div>
	<div class="formfeild">
	<label>Actions:</label>
	<textarea name="actions"rows="6" Placeholder="Actions"></textarea>
	</div>
	<div class="formfeild">
	<label>Upload Documents</label>
<input type="file" name="file_upload" class="txt2" id="file_upload" style="width:100% !important" accept="image/*,application/pdf" value="" />
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

<!-- datepicker style -->
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<!--select with search -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<?php include("admin_footer.php"); ?>
<script>
  $(document).ready(function() {
    $(".mc_date_picker").datepicker({
	dateFormat: 'yy-mm-dd',
	startDate:'01/01/2000', // first selectable date is 1st Jan 2000
	});

	$("#client_id").select2();
  });
</script>

