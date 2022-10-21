<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>

<?php include("admin_header.php"); ?>
<?php
if( isset( $_GET['added'] ) ){
	echo '<div onclick="$(this).remove();" class="alert alert-success"><strong>Successfully! </strong> Breakdown added.</div>';
}

if( isset( $_GET['updated'] ) ){
	echo '<div onclick="$(this).remove();" class="alert alert-success"><strong>Successfully! </strong> Breakdown updated.</div>';
}
?>
<style>
.search_RESULT{
	background-color: #E9E9E9;
	border:thin solid #FFF;
	transition:ease 0.65s;
}
.search_RESULT:hover{
	background-color: #999;
}
.search_line{
	height:25px; 
	width:1px; 
	background-color: #FFF; 
}
.search_RESULT_h1{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	font-weight:bold;
	color:black;
	padding:5px;
}
.search_RESULT_copy{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	color: #CCC;
	padding:5px;
}
.search_DESC{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 14px;
    color: white;
    padding-bottom: 20px;
    margin-top: -20px;
}
input {
    background-color: #EEE;
    width: 49%;
    height: 50px;
    font-size: 20px;
    font-weight: bold;
}
input:hover{ background-color: #CCC;}
.copy2{
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	font-size:16px;
	max-width:135px;
}
.tags11{
	font-family:Arial, Helvetica, sans-serif;
	font-size:15px;
	color:#333;
}
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


.Approved{
	background-color: green;
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
.Approved:after{
	content:"Approved";
}
.Rejected{
	background-color: #E48080;	
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
.Rejected:after{
	content:"Rejected";
}

.awaiting_approval{
	background-color:#FFC0CB;
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
.awaiting_approval:after{
	content:"Awaiting Approval";
}
.dataTables_wrapper {
    margin-top: 30px;
}
.dataTables_wrapper .dataTables_filter input {
    height: 30px !important;
    margin-bottom: 10px;
    background: #fff;
    min-width: 200px !important;
}
.alert.alert-success {
    background: green;
    color: #fff;
    padding: 15px 10px;
    border-radius: 5px;
    max-width: 400px;
}
</style>
<hr />

<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">BREAKDOWN SERVICE</div>
<a href="breakdown_add.php" style="background: green;color: #fff;padding: 10px 15px;text-decoration: none;border-radius: 5px;"><i class="fa fa-plus"></i> Add New</a>
<a href="breakdown_update.php" style="background: #2196f3;color: #fff;padding: 10px 15px;text-decoration: none;border-radius: 5px;"><i class="fa fa-pencil"></i> Existing Customer</a>





<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
<thead>
<tr>
	<th width="74">Edit</th>
    <th width="52">ID:</th>
    <th width="135">Client:</th>
    <th width="133">Telephone:</th>
    <th width="90px">Email:</th>
    <th width="174">Date Attended:</th>
</tr>
</thead>
<tbody>
<?php
$sql20 = "select * from breakdown order by breakdown_id desc";
$r20 = mysqli_query($sql_conn, $sql20);
while($breakdownData = mysqli_fetch_array($r20)){
	
	$sql3 = "select * from job_card WHERE job_id = ".$breakdownData['client_id']; 
    $r3 = mysqli_query($sql_conn, $sql3);
	if(mysqli_num_rows($r3)<=0){
		continue;
	}
?>
<tr>
 <td><a href="breakdown_update.php?client_id=<?php echo $breakdownData['client_id'] ?>&breakdown_id=<?php echo $breakdownData['breakdown_id'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
 <td width="52"><?php echo $breakdownData['breakdown_id'] ?></td>
  <td width="135">
   <?php
	$mobile='';
	$email='';
    while($clientData = mysqli_fetch_array($r3)){
                
		echo $clientData['first_name']." ".$clientData['surname'];
		$mobile=$clientData['cell'];
		$email=$clientData['email'];
		
	?>
 </td> 
 <td width="133">
 <?php
	echo $mobile;
  ?>	
 </td> 
 <td width="111">
  <?php
	echo $email;
  ?>
 
 </td>
 <td width="174"><?php echo $breakdownData['breakdown_date_att'] ?></td>
 
</tr>
<?php
 }}
 
?>
</tbody>
</table>
											
    <?php  
	
	
	mysqli_close($sql_conn);
	
	?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>									
<script>
$(document).ready(function() {
   $('.tablelist').DataTable({
    pageLength: 20,
    filter: true,
    deferRender: true,
    scrollY: 200,
    scrollCollapse: true,
    scroller: true
});
 $('input[name="auto-email"]').change(function() {
	 var serviceId = $(this).data('id');
    	  var flag;
    if(this.checked) {
	   flag = 1;
    }else{
    flag = 0;	
	}
     console.log(serviceId); 
			$.ajax({
                type: "POST",
                url: "update_email_service.php",
                data: {"service_id":serviceId ,"flag":flag},
                success: function(msg) {
					console.log(msg); 
                    if(msg.includes("0"))
                    {
						alert('Auto Alert Email Service has been deactivated!');
                        return true;
                    }
                    else
                    {
                        alert('Auto Alert Email Service has been reactivated!');
                        return true;
                    }
                }
            });

  });

 
});
</script>