<?php include("../includes/dbconn.php"); ?>
<?php
session_start();

if ($_POST){
 $UserName = mysqli_real_escape_string($sql_conn,$_POST['txtUserName']);
 $Password = mysqli_real_escape_string($sql_conn,$_POST['txtPassword']);
 $sql = "select * from users WHERE active = 1 AND username='$UserName' AND password='$Password'";

 $r = mysqli_query($sql_conn,$sql);

 if(mysqli_num_rows($r) <= 0){
  $sMessage = "Invalid username or password!";
  $_SESSION['LoggedIn'] = '';
  header("Location: index.php?i=" . $sMessage);
 
// echo'<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?i={$sMessage}">';
  exit;
 }else{
  $row = mysqli_fetch_array($r);

 
  $_SESSION['LoggedIn'] = "yes";
  $_SESSION['UserId']   =  $row["user_id"];
  $_SESSION['UserName']   =  $row["username"];
  $_SESSION['company_id']   =  $row["company_id"];
  $_SESSION['companyName']   =  $row["companyName"];
  if($row['IsAdmin']   == 1){
  
	$_SESSION['IsAdmin']="yes";
	
  }else{
	$_SESSION['IsAdmin']="";
  }

  header("Location: home.php");
  //echo'<META HTTP-EQUIV="Refresh" Content="0; URL=home.php">';
  exit;
 }

}


?>
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
            <div>
			
              <form id="frmMain" name="frmMain" method="post" action="index.php">
                <table border="0" cellpadding="8" cellspacing="8" style="padding-top:20px; padding-bottom:20px; margin-left:auto; margin-right:auto">
                    <tr>
                        <td colspan="2" align="center" style="color: #F00;; font-family:Arial; font-size:20px"><?php if(isset($_GET["i"])) echo $_GET["i"]; ?></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center" style="font-family:Arial; font-size:20px; color:white; font-weight:bold;">Admin Login</td>
                  </tr>
                    <tr>
                        <td style="font-family:Arial; font-size:13px; color:white;">Username:</td>
                        <td><input type="text" name="txtUserName" id="txtUserName" style="width:150px;" />
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial; font-size:13px; color:white;">Password:</td>
                        <td><input type="password" name="txtPassword" id="txtPassword" style="width:150px;" />
                        </td>
                    </tr>
            
                    <tr>
                        <td colspan="2" align="right">
                            <input type="submit" name="submit" value="Login" style="background-color:#c4161c; border-radius:7px; text-decoration:none; padding:5px; font-family:Arial; font-size:18px; color:white; font-weight:bold; text-align:center; width:100%" />
                        </td>
                    </tr>
                </table>
            
            </form>

          </div>
   	    </div>
</div>

<!-- footer -->
<div style="position: absolute;bottom:0px; width:100%; background-color:white;height:54px; margin-left:auto; margin-right:auto; z-index:99999; border-top:thin solid #999">
<table width="100%" border="0" cellspacing="010" cellpadding="10" align="center">
  <tr>
    <td width="50%" align="left" valign="middle" class="copy_01">ÃÂ© 2004-2017 All rights reserved - Solar PriMeg</td>
    <td width="50%" align="right" valign="middle" class="copy_01">Developed by <a href="http://www.pixelgraphics.co.za">Pixel Graphics</a></td>
    </tr>
</table>
</div>

</body>
</html>