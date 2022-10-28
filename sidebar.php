<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>CRM System</title>
  <link href="adminstyle.css" rel="stylesheet" type="text/css">
  <link href="sidebar.css" rel="stylesheet" type="text/css">
  <!-- favicon icon -->
  <link rel="icon" type="image/png" href="http://www.solarprimeg.co.za/images/favicon.png">
  <link rel="icon" type="image/jpeg" href="http://www.solarprimeg.co.za/images/favicon.jpg">
  <link rel="icon" type="image/vnd.microsoft.icon" href="http://www.solarprimeg.co.za/images/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0">

  <div>
    <div
      style=" width: 220px; float: left; padding-top: 5px; background-color: #606060; color: white;  padding: 2px; position: absolute; height: 100%;">
      <div>
        <div style=" text-align: center; margin-top: 5px;">
          <img src="images/logo.jpg" alt="logo" height="77" style="border-radius: 50%; width: 102px; height: 102px;">
        </div>
        <div style="text-align:center; align-items: center;margin-top: 13px;">
          <div class="roundNewButton">
            <p style=" margin: 0px; margin-top: 3px; "> + NEW </p> 
          </div>
        </div>
      </div>
      <div>
        <?php
        if ($_SESSION['UserName'] == 'Borwood') {
          echo
          "<div><a href='job_sheet_list.php'>Job Sheet</a></div>
				  <div><div class='div_divider'></div></div>";
        } else {
        ?>
        <div style="margin-top: 20px;
                    font-size: 18px;
                    margin-left: 19px;"><a>MENU</a></div>
        <div></div>
        <div class="sideItem"><a href="home.php" class="sideItemA">Dashboard</a></div>
        <div class="sideItem"><a href="products.php" class="sideItemA">Products</a></div>
        <div class="sideItem"><a href="customerJobCard.php" class="sideItemA">Customer Job Card</a></div>
        <div class="sideItem"><a href="customerServices.php" class="sideItemA">Customer Services</a></div>
        <div class="sideItem"><a href="breakdown.php" class="sideItemA">Breakdown / Call-Out</a></div>
        <div class="sideItem"><a href="contactus_view.php" class="sideItemA">Mail Customers</a></div>
        <div class="sideItem"><a href="serviceReminderHistory.php" class="sideItemA">Service Reminder History</a></div>
        <div class="sideItem"><a href="users.php" class="sideItemA">Users</a></div>
        <div class="sideItem"><a href="logHistory.php" class="sideItemA">Log History</a></div>
        <?php } ?>
      </div>
    </div>

    <div style="background-color: #F3F3F3; left: 200px; margin-left: 200px;">