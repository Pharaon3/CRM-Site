<?php include("../includes/dbconn.php"); ?>
<?php

session_start();
		if(isset($_SESSION["IsAdmin"]))
		if($_GET["destroy"]=="yes")
		{
		unset($_SESSION["UserName"]);
		session_destroy();
		}
		
		if(!isset($_SESSION["UserName"]) &&
		$_GET["username"]!="")
		$_SESSION["UserName"] = $_GET["username"];
   		//exit();
?>
<meta http-equiv="refresh" content="1;URL=http://www.solarprimeg.co.za/admin/index.php" />

<script>
  function preventBack(){window.history.forward();}
  setTimeout("preventBack()", 0);
  window.onunload=function(){null};
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Pixel Graphics - Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="adminstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
</head>

<body style="overflow:hidden !important">
<!-- Header -->
<div style="background-color: #FFF; height:90px; width:100%; z-index:99; border-bottom:thin solid #999">
	<div style="font-family:Arial; color: #666; font-size:20px; font-weight:bold; float:left; padding-top:30px; padding-left:10px">Solar PriMeg - CRM</div>
	<div style="float:right"><img src="images/logo.jpg" style="margin:10px;" width="70"/></div>
</div>

<!--login panel -->
<div style="max-width:340px; margin-left:auto; margin-right:auto; display:block">
        <div style="padding: 10px; height: auto; width: 340px; z-index: 101; border-radius:20px; margin-top:70px; background-color: rgba(0,0,0,0.9); position:absolute; margin-left:auto; margin-right:auto;">
            <div style="padding:30px">
			
                <div style="font-family: Arial; font-size: 25px; color: white; padding:30px; font-weight:bold; text-align:center">Successfully <br />
                Logged out!</div>
                <a href="http://www.solarprimeg.co.za/admin/index.php"><div style="background-color:#c4161c; border-radius:7px; text-decoration:none; padding:10px; font-family:Arial; font-size:18px; color:white; font-weight:bold; text-align:center;">Re-Login</div></a>
                
           </div>
</div>
</div>

<!-- footer -->
<div style="position: absolute;bottom:0px; width:100%; background-color:white;height:54px; margin-left:auto; margin-right:auto; z-index:99999; border-top:thin solid #999">
<table width="100%" border="0" cellspacing="010" cellpadding="10" align="center">
  <tr>
    <td width="50%" align="left" valign="middle" class="copy_01">© 2004-2017 All rights reserved - Solar PriMeg</td>
    <td width="50%" align="right" valign="middle" class="copy_01">Developed by <a href="http://www.pixelgraphics.co.za">Pixel Graphics</a></td>
    </tr>
</table>
</div>
</body>
</html>