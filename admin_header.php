<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CRM System</title>
<link href="adminstyle.css" rel="stylesheet" type="text/css">
<!-- favicon icon -->
<link rel="icon" type="image/png" href="http://www.solarprimeg.co.za/images/favicon.png">
<link rel="icon" type="image/jpeg" href="http://www.solarprimeg.co.za/images/favicon.jpg">
<link rel="icon" type="image/vnd.microsoft.icon" href="http://www.solarprimeg.co.za/images/favicon.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0" bgcolor="#101A26">



    <div id="header">
	<div id="header_text">Solar PriMeg: CRM System<br /> <div id="header_text2">[Login as: <?php echo $_SESSION['UserName']; ?> ]</div></div>
    <div id="header_image"><img src="images/logo.jpg" alt="" height="77" /></div>
    <div class="clear"></div>
</div>

<div id="content">

	<div id="content_menu">
    	<ul>
        <?php 
		if($_SESSION['UserName'] == 'Borwood'){
		echo 
				 "<li><a href='job_sheet_list.php'>Job Sheet</a></li>
				  <li><div class='div_divider'></div></li>";
		}else{
		?>
        	<li><a href="home.php">Dashboard</a></li>
            <li><div class="div_divider"></div></li>
           			    <li><div class="div_logout_bt">FACTORY</div></li>
            <li><a href="factory_job_card_tank_view.php">Product - Tank</a></li>
            <li><div class="div_divider"></div></li>
            <li><a href="factory_job_card_panels_view.php">Product - Panels</a></li>
            <li><div class="div_divider"></div></li>
                        <li><div class="div_logout_bt">JOB CARD</div></li>
            <li><a href="search.php">View list</a></li>
            <li><div class='div_divider'></div></li>
            <li><a href="step_1_client.php?id=0">Create New</a></li>
            <li><div class="div_divider"></div></li>
                       <li><div class="div_logout_bt">SERVICES</div></li>
            <li><a href="service_search.php">View list</a></li>
			<li><div class="div_logout_bt">Breakdown/Call-Out</div></li>
            <li><a href="breakdown.php">View list</a></li>
            <li><div class='div_divider'></div></li>
            			<li><div class='div_logout_bt'>CONFIG</div></li>
            <li><div class='div_divider'></div></li>
			<li><a href='team_view.php'>Team</a></li>
            <li><div class='div_divider'></div></li>
                        			<li><div class='div_logout_bt'>EMAILS</div></li>
            <li><div class='div_divider'></div></li>
			<li><a href='contactus_view.php'>Contact Form</a></li>
            <li><div class='div_divider'></div></li>
		 <?php } ?>
            <?php 
			if($_SESSION['UserName']  == 'Jorge'){
            echo "<li><a href='users.php'>Users</a></li>
				  <li><div class='div_divider'></div></li>
				  
			";
			}
            ?>
             <?php 
			if($_SESSION['UserName']  == 'Megan'){
            echo "<li><a href='users.php'>Users</a></li>
				  <li><div class='div_divider'></div></li>
				  
			";
			}
            ?>
            <li><div class="div_logout_bt" style="background-color:#900 !important"><a href="http://www.solarprimeg.co.za/admin/logout.php">Logout</a></div></li>
            <li><div class="div_divider"></div></li>
<?php
if($_SESSION['IsAdmin'] == "yes"){
?>
<?php
}
?>
        </ul>
    </div>

    <div id="content_main">
    