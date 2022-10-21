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
</style>

<div style="background-color:#333; padding:10px">
<form action="" method="post" style="margin:20px;">
  <input name="search" type="search" autofocus><input type="submit" placeholder="No spaces..." name="button" style="margin-left:10px" value="Search">

</form>
</div>
<hr />
<div class="" >
      <table width="100%" border="0" cellspacing="1" cellpadding="1" style="background-color:#333;">
               <tr class="search_RESULT_copy">
                 <td class="heading_02" style="padding-left:10px; width:5px">Edit</td>
                 <td class="heading_02" style="padding-left:10px; width:70px; text-align:left"><span class="heading_02" style="padding-left:10px">Job No.</span></td>
                 <td class="heading_02" style="width:135px">Name:</td>
                 <td class="heading_02" style="width:216px">Telephone:</td>
                 <td class="heading_02" style="width:261px">Address:</td>
                 <td class="heading_02" style="width:134px">Cell:</td>
                 <td class="heading_02" style="width:134px">Date:</td>
        </tr>
      </table>
</div>
<?php

if(isset($_POST['button'])){    //trigger button click

  $search=$_POST['search'];

  $query=mysqli_query($sql_conn,"select * from job_card where first_name like '%{$search}%' || first_name like '%{$search}%' || address like '%{$search}%' || surname like '%{$search}%' || cell like '%{$search}%' || tel like '%{$search}%' || serial_code REGEXP '$search(\r\n.*)?$'");

if (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_array($query)) {
    echo "<div class='search_RESULT'>
		   <table width='100%' border='0' cellspacing='0' cellpadding='0' >
			   <tr>
				<td class='copy2' style='width:44px !important'><a href='job_card_edit.php?id=".$row['job_id']."'><img src='images/icon-edit.png'/></a></td>
				<td class='copy2' style='width:50px !important'>".$row['job_id']."</td>
					<td width='8px'><div class='search_line'></div></td>
				<td class='copy2' style='width:135px !important'>".$row['first_name']."&nbsp;".$row['surname']."</td>
					<td width='8px'><div class='search_line'></div></td>
				<td class='copy2' style='width:216px !important'>".$row['tel']."</td>
					<td width='8px'><div class='search_line'></div></td>
				<td class='copy2' style='width:261px !important'>".$row['address']."</td>
					<td width='8px'><div class='search_line'></div></td>
				<td class='copy2' style='width:134px !important'>".$row['cell']."</td>
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
	$query = mysqli_query($sql_conn,"select * from job_card order by job_id desc");																   
	while ($row = mysqli_fetch_array($query)) {													 
	$date        =  date_format(date_create($file_row['modified_date']),'d/m/Y');
	$user_id     =  $file_row['job_id'];
	?>  

                                
		<div class='search_RESULT'>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td align="center" class="copy2" style="width:44px !important"><a href="job_card_edit.php?id=<?php echo $row['job_id']; ?>"><img src="images/icon-edit.png"/></a></td>
            <td width="8" align="center"><div class="search_line"></div></td>
           <td align="center" class="copy2" style="width:70px !important"><?php echo $row['job_id']; ?></td>
           	<td width="8" align="center"><div class="search_line"></div></td>
           <td class="copy2" style="width:135px !important"><?php echo $row['first_name']; ?>&nbsp;<?php echo $row['surname']; ?></td>
          	<td width="8" align="center"><div class="search_line"></div></td>
           <td class="copy2" style="width:216px !important"><?php echo $row['tel']; ?></td>
           	<td width="8" align="center"><div class="search_line"></div></td>
           <td class="copy2" style="width:261px !important"><?php echo $row['address']; ?></td>
           	<td width="8" align="center"><div class="search_line"></div></td>
           <td class="copy2" style="width:134px !important"><?php echo $row['cell']; ?></td>
            <td width="8" align="center"><div class="search_line"></div></td>
           <td class="copy2" style="width:134px !important"><?php echo $row['current_date']; ?></td>
         </tr>
        </table>
		</div>
											
    <?php  
	
	}}
	mysqli_close($sql_conn);
	
	?>
										
</div>
<!-->
