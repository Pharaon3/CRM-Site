<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>
<?php include("admin_header.php"); ?>

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




</style>
<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">JOB CARD LIST - SERVICES</div>
<a href="service_edit.php?id=0" title="Add New Item"><div style="margin:10px; font-size:16px; color:#333; font-family:Arial; font-weight:bold"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;ADD NEW</div></a>

<?php
$sql = "select * from services";
$r = mysqli_query($sql);
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
<tr>
	<td width="74">Edit</td>
    <td width="39">ID:</td>
    <td width="92" class="do_b">Client:</td>
    <td width="97" class="do_b">Telephone:</td>
    <td width="80" class="do_b">Email :</td>
    <td width="102" class="do_b">Address:</td>
    <td width="92" class="do_b"> Logged:</td>
    <td width="91" class="do_b">Date Attended:</td>
    <td width="140" align="center" class="do_b">Complete</td>
	<td width="93" class="do_b">Client Approval:</td>
    <td width="82" class="do_b">Next Service</td>
</tr>
<?php
while($row = mysqli_fetch_array($r)){
?>
<tr>
 <td><a href="service_edit.php?id=<?php echo $row['service_job_code'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
 <td width="39"><?php echo $row['service_id'] ?></td>
 <td width="92">
   <?php
	$service_id = $row['service_job_code'];
    $sql2 = "select * from job_card WHERE job_id = ".$service_id;
    $r2 = mysqli_query($sql2);
    while($row2 = mysqli_fetch_array($r2)){
        
                
		echo $row2['first_name'];
		echo "&nbsp;";
		echo $row2['surname'];
		
		$service_status ="awaiting_approval";
		if($row['service_status']!=""){
			$service_status = $row['service_status'];
		}

	?>		
 </td>
 <td width="97"><?php echo $row2['cell'] ?></td>
 <td width="80"><?php echo $row2['email'] ?></td>
 <td width="102"><?php echo $row2['address'] ?></td>
 <td width="92"><?php echo $row['date_logged'] ?></td>
 <td width="91"><?php echo $row['date_att'] ?></td>
 <td width="140"><div class="<?php echo $row['complete'] ?>"></div></td>
 <td width="93"><div class="<?php echo $service_status ?>"></div></td>
 <td width="82" style="color:red"><?php echo $row['next_service'] ?></td>
 
</tr>
<?php
 }
}
?>
</table>


<?php include("admin_footer.php"); ?>
