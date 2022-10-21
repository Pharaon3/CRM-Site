<?php include("../includes/dbconn.php"); ?>
<?php
session_start();

if ($_POST){
 $UserName = mysqli_real_escape_string($_POST['txtUserName']);
 $Password = mysqli_real_escape_string($_POST['txtPassword']);
 $sql = "select * from users WHERE active = 1 AND username='$UserName' AND password='$Password'";

 $r = mysqli_query($sql);

 if(mysqli_num_rows($r) <= 0){
  $sMessage = "Invalid email or password";
  $_SESSION['LoggedIn'] = '';
  header("Location: index.php?i=" . $sMessage);
 
// echo'<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?i={$sMessage}">';
  exit;
 }else{
  $row = mysqli_fetch_array($r);

  $_SESSION['LoggedIn'] = "yes";
  $_SESSION['UserId']   =  $row["user_id"];
  $_SESSION['UserName']   =  $row["username"];
  if($row['IsAdmin']    == 1){
  
	$_SESSION['IsAdmin']="yes";
	
  }else{
	$_SESSION['IsAdmin']="";
  }
  //echo $_SESSION['ResellerId'].' reseller';
  //header("Location: home.php");
  
  echo'<META HTTP-EQUIV="Refresh" Content="0; URL=home.php">';
  exit;
 }

}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Newtown Landscape Architects | Admin</title>
<link href="adminstyle.css" rel="stylesheet" type="text/css" />
</head>

<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0" bgcolor="#101A26">



    <div id="header">
	<div id="header_text">Pixel Graphics: Automated Billing</div>
    <div id="header_image"></div>
    <div class="clear"></div>
</div>

<div id="content">


    <div id="content_main">
<form id="frmMain" name="frmMain" method="post" action="index.php">
    <table border="0">
    	<tr>
        	<td colspan="2" align="center" style="color:#FF0000;"><?php if(isset($_GET["i"])) echo $_GET["i"]; ?></td>
        </tr>
    	<tr>
        	<td>Username:</td>
            <td><input type="text" name="txtUserName" id="txtUserName" style="width:150px;" />
            </td>
        </tr>
    	<tr>
        	<td>Password:</td>
            <td><input type="password" name="txtPassword" id="txtPassword" style="width:150px;" />
            </td>
        </tr>

        <tr>
        	<td colspan="2" align="right">
            	<input type="submit" name="submit" value="Login >>" />
            </td>
        </tr>
    </table>

</form>

    </div>

    <div class="clear"></div>

</div>


</body>
</html>