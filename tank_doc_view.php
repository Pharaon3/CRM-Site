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
$sql = "select * from tank_doc";
$r = mysqli_query($sql);
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
<tr>
	<td width="8%">&nbsp;</td>
	<td width="12%" class="do_b">Doc Code:</td>
    <td width="21%" class="do_b">Decription:</td>
    <td width="39%" class="do_b">Document:</td>
    <td width="20%" class="do_b">Modified:</td>
</tr>
<?php
$Doc_file = $row['image'];
while($row = mysqli_fetch_array($r)){
?>
<tr>
 <td><a href="tank_doc.php?id=<?php echo $row['tank_doc_id'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
 <td><?php echo $row['doc_code'] ?></td>
 <td><?php echo $row['description'] ?></td>
 <td><a href="http://www.solarprimeg.co.za/upload/upload_quote_doc/<?php echo $row['image'] ?>"><?php echo $row['image'] ?></a></td>
 <td><?php echo $row['date']?></td>
</tr>
<?php
 }
?>
</table>

<p><a href="tank_doc.php?id=0" title="Add New Item"><img src="images/icon-add.png" border="0" alt="Add New Record" /></a>


<?php include("admin_footer.php"); ?>
