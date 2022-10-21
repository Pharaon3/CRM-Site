<?php
include("../includes/dbconn.php");

$serviceId = $_POST["service_id"];
$flag = $_POST["flag"];

$query = "UPDATE services SET auto_email=$flag WHERE service_id=$serviceId";

if(mysqli_query($sql_conn,$query)){
	echo "'.$flag.'";
}else{
echo $query;
}
mysqli_close($sql_conn);
?>