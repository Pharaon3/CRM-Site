<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>

<?php include("admin_header.php"); 
?>


<style>
/* Popup box BEGIN */
.box {
	padding:10px;
}

.button {
  font-size: 1em;
  padding: 10px;
  color: #fff;
  border: 2px solid #06D85F;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  margin-top:200px !important; 
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
/* Popup box BEGIN */
</style>
<?php
	$db_host = 'dedi142.jnb3.host-h.net';
	$db_username = 'solarsjkyr_6';
	$db_password = 'gvnasfbXpH8qR9ARNB98';
	$db_name = 'solarsj_form';

	$sql_conn2 = mysqli_connect($db_host, $db_username, $db_password);
	mysqli_select_db($sql_conn2,$db_name);

?>

<!--- delete start ---->
<?=  isset($feedback)? $feedback."<br /><br />" : "";  ?>
<?php 
$sql = "select * FROM solar_contact";
$r = mysqli_query($sql_conn, $sql);
$url = "http://solarprimeg.co.za/admin2/contactus_view.php";
$ref =  $_GET['id'];

if(isset($_GET["delete"])){
    
	$feedback = "Are you sure you want to delete this message <a href='contactus_view.php?id=$ref&cd=true'>Yes</a>  <a href='contactus_view.php'>No</a>?";
}

if(isset($_GET['cd'])){

$sql = "DELETE FROM solar_contact WHERE customer_id ='$ref'";
$delete = mysqli_query($sql_conn2, $sql);
echo '<script>window.location.href = "'.$url.'";</script>';
exit;

}
?>

<!--- delete end ---->

<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">CONTACT REQUESTS</div>
<?=  isset($feedback)? $feedback."<br /><br />" : "";  ?>
<?php
	
$sql = "select * from solar_contact ORDER BY customer_id desc";
$r = mysqli_query($sql_conn2, $sql);
?>


<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
<tr bgcolor="#CCCCCC">
	<td width="142" class="do_b">No.</td>
	<td width="146" class="do_b">Date</td>
    <td width="236" class="do_b">Name.</td>
    <td width="212" class="do_b">Email.</td>
    <td width="224" class="do_b">Mobile</td>
    <td width="74" class="do_b">View</td>
    <td width="70" class="do_b">Delete</td> 
</tr>
<?php
while($row = mysqli_fetch_array($r)){
?>
<tr>
 <td><?php echo $row['customer_id'] ?></td>
 <td><?php echo $row['date'] ?></td>
 <td><?php echo $row['first_name'] ?>&nbsp;<?php echo $row['last_name'] ?></td>
 <td><?php echo $row['email'] ?></td>
 <td><?php echo $row['mobile'] ?></td>
 <td>
<div class="box">
	<a href="contactus_view.php?id=<?php echo $row['customer_id'] ?>#popup1"><img src="images/icon-search.png"/></a>
</div>
<?php $customerid = $_GET['customer_id'] ?>
<div id="popup1" class="overlay">
	<div class="popup">
		<h2>
        <?php 
		$id = $_GET['id'];
        $sql_popup = "select * from solar_contact WHERE customer_id = $id";
		$r2 = mysqli_query($sql_conn2, $sql_popup);
		while($row2 = mysqli_fetch_array($r2)){
		?>
			
			<?php echo $_GET['id']; ?>
			<?php echo $row2['first_name']; ?>&nbsp;
			<?php echo $row2['last_name']; ?>

        </h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			<?php echo $row2['enquiry'] ?>
		</div>
        <?php
		 }
		?>
	</div>
</div>
 </td>
 <td><a href="contactus_view.php?id=<?php echo $row['customer_id'] ?>&delete=true"><img src="images/icon-delete.png"/></a></td>
</tr>

<?php
 }
?>
</table>

<?php include("admin_footer.php"); ?>
