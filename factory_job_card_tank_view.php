<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>

<?php include("admin_header.php"); 


?>


<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">JOB CARD LIST - TANKS</div>
<a href="factory_job_card_tank.php?id=0" title="Add New Item"><div style="margin:10px; font-size:16px; color:#333; font-family:Arial; font-weight:bold"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;ADD NEW</div></a>


<?php
/*$sql = "select * from fac_job_panels where username and user_id >= 1 order by username";*/
$sql = "select * from fac_job_tank ORDER BY id_tank desc";
$r = mysqli_query($sql_conn, $sql);
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
<tr>
	<td width="166">Edit</td>
    <td width="216" class="do_b">No.</td>
	<td width="216" class="do_b">Date</td>
    <td width="285" class="do_b">Serial No.</td>
    <td width="285" class="do_b">Card No.</td>
    <td width="522" class="do_b">Colour</td>
</tr>
<?php
while($row = mysqli_fetch_array($r)){
?>
<tr>
 <td><a href="factory_job_card_tank.php?id=<?php echo $row['id_tank'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
 <td><?php echo $row['id_tank'] ?></td>
 <td><?php echo $row['date'] ?></td>
 <td><?php echo $row['serial_code'] ?></td>
 <td><?php echo $row['card_no'] ?></td>
 <td><?php echo $row['colour'] ?></td>
</tr>
<?php
 }
?>
</table>


<?php include("admin_footer.php"); ?>
