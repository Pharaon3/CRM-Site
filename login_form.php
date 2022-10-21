<?php include("../includes/dbconn.php"); ?>
<?php
session_start();

if ($_POST){
 $UserName = mysqli_real_escape_string($_POST['txtUserName']);
 $Password = mysqli_real_escape_string($_POST['txtPassword']);
 $sql = "select * from users WHERE active = 1 AND username='$UserName' AND password='$Password'";

 $r = mysqli_query($sql);

 if(mysqli_num_rows($r) <= 0){
  $sMessage = "Invalid username or password!";
  $_SESSION['LoggedIn'] = '';
  header("Location: login.php?i=" . $sMessage);
 
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

  //header("Location: home.php");
  echo'<META HTTP-EQUIV="Refresh" Content="0; URL=home.php">';
  exit;
 }

}


?>



<form id="frmMain" name="frmMain" method="post" action="index.php">
    <table border="0" cellpadding="8" cellspacing="8" style="padding-top:20px; padding-bottom:20px; margin-left:auto; margin-right:auto">
    	<tr>
        	<td colspan="2" align="center" style="color: #F00;"><?php if(isset($_GET["i"])) echo $_GET["i"]; ?></td>
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
