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



<?php
$sql = "select u.user_id, u.username, u.modified_date, u.active, u.IsAdmin from users as u where username like '%$Filter%' and user_id >= 1 order by username";
$r = mysqli_query($sql_conn, $sql);
?>

<table border="1" cellpadding="0" cellspacing="0" class="tablelist" bordercolor="#DDDDDD">
<tr>
	<td>&nbsp;</td>
	<td class="do_b">Username</td>
    <td class="do_b">Status</td>
    <td class="do_b">Security Level</td>
    <td class="do_b">Modified</td>
</tr>
<?php
while($row = mysqli_fetch_array($r)){
?>
<tr>
 <td><a href="user.php?id=<?php echo $row['user_id'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
 <td><?php echo $row['username'] ?></td>
  <td><?php echo BooleanValue($row['active'],"Enabled", "Disabled") ?></td>
    <td><?php echo $row['IsAdmin']; ?></td>
 <td><?php echo date_format(date_create($row['modified_date']),'d/m/Y') ?></td>
</tr>
<?php
 }
?>
</table>

<p><a href="user.php?id=0" title="Add New Item"><img src="images/icon-add.png" border="0" alt="Add New Record" /></a>


<?php include("admin_footer.php"); ?>
