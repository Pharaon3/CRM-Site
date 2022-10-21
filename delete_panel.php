<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>
<?php include("admin_header.php");?>	
<?php
global $ref;

if(isset($_GET["delete_panel_doc"])){
    $ref=$_GET["delete_panel_doc"]; 
	echo  "<div style='background-color:#fda8ab; padding: 10px'>Are you sure you want to delete this entry  <a href='http://www.solarprimeg.co.za/admin/delete_panel.php?pram_id=$ref&cd2=true'>Yes</a>  <a href='http://www.solarprimeg.co.za/admin/test_panel_doc.php'>No</a>?</div>";

	}


if(isset($_GET['cd2']) && isset($_GET['pram_id'])){
$ref=$_GET['pram_id'];
echo $ref;
$sql_delete = "DELETE FROM panel_doc WHERE panel_doc_id ='$ref'";
$delete = mysqli_query($sql_delete);
echo '<span class="success"> Successfully Deleted!</span>';
echo '<br/><a href="http://solarprimeg.co.za/admin/factory_job_card_panels_view.php"><img src="images/icon-back.png" /></a>';
exit;
}
?>
<?php include("admin_footer.php"); ?>