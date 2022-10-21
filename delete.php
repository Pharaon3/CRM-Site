<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>
<?php include("admin_header.php");?>	
<?php
global $ref;

if(isset($_GET["delete_fac_job_panel"])){
    $ref=$_GET["delete_fac_job_panel"];
	echo "<div style='background-color:#fda8ab; padding: 10px'>Are you sure you want to delete this entry  <a href='http://solarprimeg.co.za/admin/delete.php?pram_id=$ref&cd=true'>Yes</a>  <a href='http://www.solarprimeg.co.za/admin/factory_job_card_panels_view.php'>No</a>?</div>";
		
}
	
if(isset($_GET["delete_fac_job_tank"])){
    $ref=$_GET["delete_fac_job_tank"];
	echo  "<div style='background-color:#fda8ab; padding: 10px'>Are you sure you want to delete this entry  <a href='http://www.solarprimeg.co.za/admin/delete.php?pram_id=$ref&cd1=true'>Yes</a>  <a href='http://www.solarprimeg.co.za/admin/factory_job_card_tank_view.php'>No</a>?</div>";
		
	}

if(isset($_GET["delete_job_card"])){
    $ref=$_GET["delete_job_card"]; 
	echo  "<div style='background-color:#fda8ab; padding: 10px'>Are you sure you want to delete this entry  <a href='http://www.solarprimeg.co.za/admin/delete.php?pram_id=$ref&cd2=true'>Yes</a>  <a href='http://www.solarprimeg.co.za/admin/search.php'>No</a>?</div>";

	}

if(isset($_GET['cd'])&& isset($_GET['pram_id'])){
$ref=$_GET['pram_id'];
echo $ref;
$sql_delete = "DELETE FROM fac_job_panels WHERE id_panels ='$ref'";
$delete = mysqli_query($sql_delete);
echo '<span class="success"> Successfully Deleted!</span>';
exit;
}
if(isset($_GET['cd1'])&& isset($_GET['pram_id'])){
$ref=$_GET['pram_id'];
echo $ref;
$sql_delete = "DELETE FROM fac_job_tank WHERE id_tank ='$ref'";
$delete = mysqli_query($sql_delete);
echo '<span class="success"> Successfully Deleted!</span>';
exit;
}
if(isset($_GET['cd2']) && isset($_GET['pram_id'])){
$ref=$_GET['pram_id'];
echo $ref;
$sql_delete = "DELETE FROM job_card WHERE job_id ='$ref'";
$delete = mysqli_query($sql_delete);
echo '<span class="success"> Successfully Deleted!</span>';
exit;
}
?>
<?php include("admin_footer.php"); ?>