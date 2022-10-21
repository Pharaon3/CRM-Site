<?php
//include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");

//die("====");
$action = $_REQUEST['action'];
$id = $_REQUEST['id'];
if(isset($action)&& $action!=''){
	if(isset($id) && $id !=0 && $id !='' && is_numeric($id)){
		if($action=='accept'){
			$status ="Approved";
		}
		if($action=='reject'){
			$status = "Rejected";
		}
		$sql = "update services set service_status='".$status."' where service_id=".$id;
		$r10 = mysqli_query($sql_conn, $sql); 
	}
	header('Location:http://www.solarprimeg.co.za/admin2/viewmsg.php?msg='.$status); 
}


?>
