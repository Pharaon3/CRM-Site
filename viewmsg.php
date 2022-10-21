<?php
$msg = $_REQUEST['msg'];

if(isset($msg) && !empty($msg)){
   if($msg=='Approved'){
	echo"<h4> Your service requesting sucessfully for approved.</h4>"; 
   exit();	
   }
   
   if($msg=='Rejected'){
	echo"<h4> Your service requesting sucessfully for declined.</h4>";    
	exit();
   }
}
?>