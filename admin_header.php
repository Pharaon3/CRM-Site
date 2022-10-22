<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

  <div id="content">

    <div id="content_menu">

      <ul>
        <li style="margin-left: -50px;">
          <div style="text-align:center">
            <img src="images/logo.jpg" alt="logo" height="77" style="border-radius: 50%;">
          </div>
        </li>
        <li style=" text-align: center; align-items: center; margin-left: -50px; ">
          <div style="text-align:center; align-items: center;">
            <p
              style="border-width: 1px; padding: 5px; border-color: white; border-style: solid; border-radius: 5px; padding-left: 10px; padding-right: 10px; width: 99px; align-items: center;text-align: center;margin-left: auto;margin-right: auto;">
              + NEW </p>
          </div>
        </li>
        <?php
                if ($_SESSION['UserName'] == 'Borwood') {
                    echo
                    "<li><a href='job_sheet_list.php'>Job Sheet</a></li>
				  <li><div class='div_divider'></div></li>";
                } else {
                ?>
        <li><a>Menu</a></li>
        <li></li>
        <li><a href="home.php">Dashboard</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="customerJobCard.php">Customer Job Card</a></li>
        <li><a href="customerServices.php">Customer Services</a></li>
        <li><a href="breakdown.php">Breakdown / Call-Out</a></li>
        <li><a href="contactus_view.php">Mail Customers</a></li>
        <li><a href="serviceReminderHistory.php">Service Reminder History</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="logHistory.php">Log History</a></li>
        <?php } ?>
        <?php
                if ($_SESSION['UserName']  == 'Jorge') {
                    echo "<li><a href='users.php'>Users</a></li>
				  <li><div class='div_divider'></div></li>
				  
			";
                }
                ?>
        <?php
                if ($_SESSION['UserName']  == 'Megan') {
                    echo "<li><a href='users.php'>Users</a></li>
				  <li><div class='div_divider'></div></li>
				  
			";
                }
                ?>
        <li>
          <div class="div_logout_bt" style="background-color:#900 !important"><a
              href="http://www.solarprimeg.co.za/admin/logout.php">Logout</a></div>
        </li>
        <li>
          <div class="div_divider"></div>
        </li>
        <?php
                if ($_SESSION['IsAdmin'] == "yes") {
                ?>
        <?php
                }
                ?>
      </ul>
    </div>

    <div id="content_main">