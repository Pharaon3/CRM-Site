<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>

<?php include("admin_header.php"); ?>

<style>
.search_RESULT{
	background-color: #E9E9E9;
	border:thin solid #FFF;
	transition:ease 0.65s;
}
.search_RESULT:hover{
	background-color: #999;
}
.search_line{
	height:25px; 
	width:1px; 
	background-color: #FFF; 
}
.search_RESULT_h1{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	font-weight:bold;
	color:black;
	padding:5px;
}
.search_RESULT_copy{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	color: #CCC;
	padding:5px;
}
.search_DESC{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 14px;
    color: white;
    padding-bottom: 20px;
    margin-top: -20px;
}
input {
    background-color: #EEE;
    width: 49%;
    height: 50px;
    font-size: 20px;
    font-weight: bold;
}
input:hover{ background-color: #CCC;}
.copy2{
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	font-size:16px;
	max-width:135px;
}
.tags11{
	font-family:Arial, Helvetica, sans-serif;
	font-size:15px;
	color:#333;
}
.complete{
	background-color: #5eea81;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    width: 100px;
    padding: 10px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    border-radius: 7px;
	font-weight:normal !important;
}
.complete:after{
	content:"Complete";
}
.not_complete{
	background-color: #e9a4a9;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    width: 100px;
    padding: 10px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    border-radius: 7px;
	font-weight:normal !important;
}
.not_complete:after{
	content:"Incomplete";
}


.Approved{
	background-color: green;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    width: 100px;
    padding: 10px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    border-radius: 7px;
	font-weight:normal !important;
}
.Approved:after{
	content:"Approved";
}
.Rejected{
	background-color: #E48080;	
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    width: 100px;
    padding: 10px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    border-radius: 7px;
	font-weight:normal !important;
}
.Rejected:after{
	content:"Rejected";
}

.awaiting_approval{
	background-color:#FFC0CB;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    width: 100px;
    padding: 10px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    border-radius: 7px;
	font-weight:normal !important;
}
.awaiting_approval:after{
	content:"Awaiting Approval";
}
</style>
<!--
<div style="background-color:#333; padding:10px">

<form action="" method="post" style="margin:20px;">
  <input name="search" type="search" autofocus><input type="submit" placeholder="No spaces..." name="button" style="margin-left:10px" value="Search">

</form>

</div>
-->
<hr />
<!--form -->
<!-- search results -->
<?php

if(isset($_POST['button'])){    //trigger button click

  $search=$_POST['search'];

  $query = mysqli_query($sql_conn, "select * from services where service_job_code like '%{$search}%'");

if (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_array($query)) {
    echo "<div class='search_RESULT'>
		   <table width='100%' border='0' cellspacing='0' cellpadding='0' >
			   <tr>
				<td class='copy2' style='width:44px !important'><a href='service_edit_view2.php?id=".$row['job_code']."'><img src='images/icon-edit.png'/></a></td>
				<td class='copy2' style='width:70px !important'>".$row['job_code']."</td>
					<td width='8px'><div class='search_line'></div></td>
				<td class='copy2' style='width:110px !important'>".$row['first_name']."</td>
					<td width='8px'><div class='search_line'></div></td>
				<td class='copy2' style='width:230px !important'>".$row['tel']."</td>
					<td width='8px'><div class='search_line'></div></td>
				<td class='copy2' style='width:250px !important'>".$row['email']."</td>
					<td width='8px'><div class='search_line'></div></td>
				<td class='copy2' style='width:150px !important'>".$row['cell']."</td>
			   </tr>
		  </table>
		 </div>
		  ";
  }
}else{
    echo "<div class='search_RESULT_copy' style='margin-top:30px'>Customer not found! Please try again...</div><br><br>";
  }

}else{  
	//while not in use of search  returns all the values
	//$query=mysqli_query("select * from job_card order by job_id desc");																   
	//while ($row = mysqli_fetch_array($query)) {													 
	//$date        =  date_format(date_create($file_row['modified_date']),'d/m/Y');
	//$user_id     =  $file_row['job_id'];
	?>  

<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">BREAKDOWN SERVICE</div>


<!-- default view --> 
<?php
$sql20 = "select * from services order by service_id desc";
$r20 = mysqli_query($sql_conn, $sql20);
?>                              
<table style="display:none;" width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
<tr>
	<td width="74">Edit</td>
    <td width="52">ID:</td>
    <td width="135">Client:</td>
    <td width="133">Telephone:</td>
    <!-- <td width="90px">Email:</td> -->
    <!-- <td width="122">Logged:</td> -->
    <td width="174">Date Attended:</td>
    <td width="92">Status</td>
	<!-- <td width="87">Client Approval:</td> -->
    <!-- <td width="182">Next Service</td> -->
	<!-- <td width="124">Date Created:</td> -->
	<!-- <td width="100">Auto Email:</td> -->
</tr>
<?php
while($row = mysqli_fetch_array($r20)){
?>
<tr>
 <td><a href="service_edit_view2.php?id=<?php echo $row['service_id'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
 <td width="52"><?php echo $row['service_id'] ?></td>
  <td width="135">
   <?php
	$service_id = $row['service_job_code'];
    $sql3 = "select * from job_card WHERE job_id = ".$service_id; 
    $r3 = mysqli_query($sql_conn, $sql3);
    while($row3 = mysqli_fetch_array($r3)){
                
		echo $row3['first_name'];
		echo "&nbsp;";
		echo $row3['surname'];
		
		$service_status ="awaiting_approval";
		if($row['service_status']!=""){
			$service_status = $row['service_status'];
		
		}
	?>		
 </td> 
 <td width="133">
 <?php
	$service_id = $row['service_job_code'];
    $sql3 = "select * from job_card WHERE job_id = ".$service_id;
    $r3 = mysqli_query($sql_conn, $sql3);
    while($row3 = mysqli_fetch_array($r3)){
		echo $row3['cell'];
	}
  ?>	
 </td> 
 <!-- <td width="111">
  <?php
	$service_id = $row['service_job_code'];
    $sql3 = "select * from job_card WHERE job_id = ".$service_id;
    $r3 = mysqli_query($sql_conn, $sql3);
    while($row3 = mysqli_fetch_array($r3)){
		echo $row3['email'];
	}
  ?>
 
 </td> -->
 <!-- <td width="122"><?php echo $row['date_logged'] ?></td> -->
 <td width="174"><?php echo $row['date_att'] ?></td>
 <td width="92"><div class="<?php echo $row['complete'] ?>"></div></td> 
 <!-- <td width="87"><div class="<?php echo $service_status ?>"></div></td> -->
 <!-- <td width="182" style="color:red"><?php //echo $row['next_service'] ?></td> -->
 <!-- <td width="124"><?php echo $row['current_date'] ?></td> -->
 <!-- <td width="100">
 <?php if($row['auto_email'] == 0){?>
 <input type="checkbox" name="auto-email" data-id="<?php echo  $row['service_id'];?>"/>
 <?php }else{?>
 <input type="checkbox" name="auto-email" data-id="<?php echo  $row['service_id'];?>" checked="checked"/>
 <?php }?>
 </td> -->
 
</tr>
<?php
 }}
 
?>
</table>
											
    <?php  
	
	}
	mysqli_close($sql_conn);
	
	?>
										
<script>
$(document).ready(function() {
   
 $('input[name="auto-email"]').change(function() {
	 var serviceId = $(this).data('id');
    	  var flag;
    if(this.checked) {
	   flag = 1;
    }else{
    flag = 0;	
	}
     console.log(serviceId); 
			$.ajax({
                type: "POST",
                url: "update_email_service.php",
                data: {"service_id":serviceId ,"flag":flag},
                success: function(msg) {
					console.log(msg); 
                    if(msg.includes("0"))
                    {
						alert('Auto Alert Email Service has been deactivated!');
                        return true;
                    }
                    else
                    {
                        alert('Auto Alert Email Service has been reactivated!');
                        return true;
                    }
                }
            });

  });

 
});
</script>
<!-->
