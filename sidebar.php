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

<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0">

  <div>
    <div
      style=" width: 200px; float: left; padding-top: 10px; background-color: #333; color: white;  padding: 2px; position: absolute; height: 100%;">
      <div>
        <div style=" text-align: center; margin-top: 10px;">
          <img src="images/logo.jpg" alt="logo" height="77" style="border-radius: 50%;">
        </div>
        <div style="text-align:center; align-items: center;">
          <p style="border-width: 1px;
                    padding: 5px;
                    border-color: white;
                    border-style: solid;
                    border-radius: 14px;
                    padding-left: 10px;
                    padding-right: 10px;
                    width: 140px;
                    align-items: center;
                    text-align: center;
                    margin-left: auto;
                    margin-right: auto;
                    height: 14px;">
            + NEW </p>
        </div>
      </div>
      <div style="margin-left: 20px">
        <?php
        if ($_SESSION['UserName'] == 'Borwood') {
          echo
          "<div><a href='job_sheet_list.php'>Job Sheet</a></div>
				  <div><div class='div_divider'></div></div>";
        } else {
        ?>
        <div><a>Menu</a></div>
        <div></div>
        <div><a href="home.php" style="color: white">Dashboard</a></div>
        <div><a href="products.php" style="color: white">Products</a></div>
        <div><a href="customerJobCard.php" style="color: white">Customer Job Card</a></div>
        <div><a href="customerServices.php" style="color: white">Customer Services</a></div>
        <div><a href="breakdown.php" style="color: white">Breakdown / Call-Out</a></div>
        <div><a href="contactus_view.php" style="color: white">Mail Customers</a></div>
        <div><a href="serviceReminderHistory.php" style="color: white">Service Reminder History</a></div>
        <div><a href="users.php" style="color: white">Users</a></div>
        <div><a href="logHistory.php" style="color: white">Log History</a></div>
        <?php } ?>
      </div>
    </div>

    <div style="background-color: #F3F3F3; left: 200px; margin-left: 200px;">