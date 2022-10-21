<?php
	$db_host = 'sql17.jnb1.host-h.net';
	$db_username = 'pixelssfvk_11';
	$db_password = 'uQhdMRVv5F8';
	$db_name = 'pixel_paymentsub';

	mysqli_connect( $db_host, $db_username, $db_password) or die(mysqli_error());
	mysqli_select_db($db_name); 
    
	$subID = $_POST["sub_id"];
	$Company = $_POST["company"];
	$graphID = $_POST["graph_id"];

$query = "SELECT * FROM `graph`";
$sqlsearch = mysqli_query($query);
$resultcount = mysqli_numrows($sqlsearch);

if ($_POST){
    mysqli_query("UPDATE `table_name` SET 
								'sub_id' = '$subID',
								'company' = '$Company',
								 WHERE 
								`graph_id` = '$graphID'") 
     or die(mysqli_error());
    
} else {

    mysqli_query("INSERT INTO `graph` (graph_id, sub_id, company) VALUES ('$graphID', '$subID', '$Company') ") 
    or die(mysqli_error());  

	echo'<script>window.location="stats_list.php?msg1=Update Successfilly";</script>';
}
?>