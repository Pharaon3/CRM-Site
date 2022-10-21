<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>
<?php include("admin_header.php");?>	
<?php
global $ref;

if(isset($_GET["delete_tank_list"])){
    $ref=$_GET["delete_tank_list"]; 
	echo  "<div style='background-color:#fda8ab; padding: 10px'>Are you sure you want to delete this entry  <a href='http://www.solarprimeg.co.za/admin/delete_tank_list.php?pram_id=$ref&cd2=true'>Yes</a>  <a href='http://www.solarprimeg.co.za/admin/delete_tank_list.php'>No</a>?</div>";

	}


if(isset($_GET['cd2']) && isset($_GET['pram_id'])){
$ref=$_GET['pram_id'];
echo $ref;
$sql_delete = "DELETE FROM fac_job_tank WHERE id_tank ='$ref'";
$delete = mysqli_query($sql_delete);
echo '<span class="success"> Successfully Deleted!</span>';
echo '<br/><a href="http://solarprimeg.co.za/admin/factory_job_card_tank_view.php"><img src="images/icon-back.png" /></a>';
exit;
}
?>
<?php include("admin_footer.php"); ?>