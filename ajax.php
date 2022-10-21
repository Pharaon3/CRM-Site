<?php

$dbhost = 'dedi142.jnb3.host-h.net';
$dbusername = 'solarsjkyr_1';
$dbpassword = 'FkcMg7YGd29Uxt3zZwS5';
$dbname = 'solarsj_admin';


$sql_conn = mysqli_connect($dbhost, $dbusername, $dbpassword);
mysqli_select_db($sql_conn,$dbname);

// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail('sale.opencart@gmail.com',"My subject",$msg);

$query = "update job_card set isEmailSend = '1' where email = 'sale.opencart@gmail.com'";
mysqli_query($sql_conn,$query);


?>