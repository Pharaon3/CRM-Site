<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>

<?php include("admin_header.php"); 


?>
<?php
$Filter = "";
if(isset($_POST["txtFilter"])) $Filter = $_POST["txtFilter"];
?>
<form name="frmMain" action="" method="post">
<table border="0" cellpadding="0" cellspacing="0" class="tablefilter" bordercolor="#DDDDDD">
<tr>
    <td><input type="text" name="txtFilter" id="txtFilter" class="txt2" value="<?php echo $Filter; ?>" /></td>
    <td><input type="image" name="filter" value="Go" src="images/icon-search.png" /></td>
</tr>
</table>
</form>
<br />
<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">JOB CARD LIST - INSTALLATION</div>



<?php
/*$sql = "select from fac_job_panels where username and user_id >= 1 order by username";*/
$sql = "select * from installation";
$r = mysqli_query($sql);
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
<tr>
	<td width="166">&nbsp;</td>
	<td width="216" class="do_b">Date</td>
    <td width="285" class="do_b">Client</td>
    <td width="522" class="do_b">Address</td>
    <td width="522" class="do_b">Telephone</td>
</tr>
<?php
while($row = mysqli_fetch_array($r)){
?>
<tr>
 <td><a href="factory_job_card_panels.php?id=<?php echo $row['id_install'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
 <td><?php echo date_format(date_create($row['modified_date']),'d/m/Y') ?></td>
 <td><?php echo $row['client'] ?></td>
 <td><?php echo $row['address'] ?></td>
 <td><?php echo $row['tel'] ?></td>
</tr>
<?php
 }
?>
</table>

<p><a href="installation.php?id=0" title="Add New Item"><img src="images/icon-add.png" border="0" alt="Add New Record" /></a>


<?php include("admin_footer.php"); ?>
