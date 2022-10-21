<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>
<?php include("admin_header.php");?>	
<?php
$url_service = $_GET["pram_id"];
global $ref;

if(isset($_GET["delete_service_doc"])){
    $ref=$_GET["delete_service_doc"]; 
	echo  "<div style='background-color:#fda8ab; padding: 10px'>Are you sure you want to delete this entry  <a href='http://www.solarprimeg.co.za/admin/delete_service.php?pram_id=$ref&cd2=true'>Yes</a>  <a href='http://www.solarprimeg.co.za/admin/test_service_doc.php'>No</a>?</div>";

	}


if(isset($_GET['cd2']) && isset($_GET['pram_id'])){
$ref=$_GET['pram_id'];
echo $ref;
$sql_delete = "DELETE FROM service_doc WHERE service_doc_id ='$ref'";
$delete = mysqli_query($sql_delete);
echo '<span class="success"> Successfully Deleted!</span>';
echo "<div style='background-color:#fda8ab; padding: 10px'><a href='http://www.solarprimeg.co.za/admin/service_search.php'>Back</a>";
exit;
}
?>
<?php include("admin_footer.php"); ?>