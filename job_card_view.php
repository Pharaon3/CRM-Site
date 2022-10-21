<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>

<?php include("admin_header.php"); 


?>
<style>
td{ font-weight:normal !important}
.td{ font-weight:normal !important}
.yes_approved{
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
.yes_approved:after{
	content:"Approved";
}
.not_approved{
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
.not_approved:after{
	content:"Not Approved";
}
</style>
<a href="search.php"><div style="background-color:#333; color:#FFF; font-size:18px; font-weight:bold; text-align:center; padding:10px; border-radius:4px; width:300px">SEARCH</div></a>

<br />
<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">JOB CARD LIST</div>
<br />


<?php
/*$sql = "select * from fac_job_panels where username and user_id >= 1 order by username";*/
$sql = "select * from job_card";
$r = mysqli_query($sql_conn, $sql);
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
<tr>
	<td width="81">&nbsp;</td>
	<td width="70"  class="do_b">Job No.:</td>
	<td width="72"  class="do_b">Serial No.:</td>    
    <td width="216" class="do_b">Full Name: </td>
    <td width="277" class="do_b">Address:</td>
    <td width="116" class="do_b">Cell: </td>
    <td width="95" class="do_b">Date Installed:</td>
    <td width="61" class="do_b">Approved</td>
</tr>
<?php
while($row = mysqli_fetch_array($r)){
?>
<tr>
 <td><a href="job_card_edit.php?id=<?php echo $row['job_id'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
 <td><?php echo $row['job_id'] ?></td>
 <td><?php echo $row['serial_no']?></td>
 <td><?php echo $row['first_name'] ?>&nbsp;<?php echo $row['surname'] ?></td>
 <td><?php echo $row['address'] ?></td>
 <td><?php echo $row['cell'] ?></td>
 <td><?php echo $row['date_install'] ?></td>
 <td><div class="<?php echo $row['approved'] ?>"></div></td>
</tr>
<?php
 }
?>
</table>

<p><a href="job_card_edit.php?id=0" title="Add New Item"><img src="images/icon-add.png" border="0" alt="Add New Record" /></a>


<?php include("admin_footer.php"); ?>
