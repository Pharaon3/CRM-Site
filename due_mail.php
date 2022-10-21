<?php
error_reporting(0);
include("../includes/dbconn.php");
$curr_date = date("Y-m-d");
$sql ="select jc.isEmailSend,s.service_id,s.service_job_code, s.team, s.next_service from services as s
			inner join job_card as jc ON jc.job_id = s.service_job_code
			WHERE YEAR(s.next_service)= YEAR('$curr_date') AND MONTH(s.next_service)= MONTH('$curr_date') AND s.auto_email=1 ORDER BY s.next_service DESC";
$r = mysqli_query($sql_conn, $sql);

//$p = array();
    while ($row = mysqli_fetch_array($r)) {
         $job_id = $row['service_job_code'];
		 $sql2 = "select * from job_card WHERE job_id = " .$job_id;
		 $result = mysqli_query($sql_conn,$sql2);
		 $row2 = mysqli_fetch_array($result);
	     $toemailid = isset($row2['email']) ? $row2['email'] : '';
                      if(strpos($toemailid,'/') !== false){
	     $toemailid = explode("/",$toemailid);
		 $tomail = $toemailid[0];
		}else{
		 $tomail = $toemailid;
		}
        // array_push($p,$tomail);
			   
			   
//$filename = 'http://www.solarprimeg.co.za/admin2/2020-Solar-PriMeg-Service-Letter.pdf';
$path = '/usr/www/users/solarsjkyr/upload';
$file      = $path . $filename;
$file_size = filesize($file);
$handle    = fopen($file, "r");
$content   = fread($handle, $file_size);
fclose($handle);

$content = chunk_split(base64_encode($content));
$uid     = md5(uniqid(time()));
$name    = basename($file);
$customername = $row2['first_name'];
$acceptbtn ="<a href='http://www.solarprimeg.co.za/admin2/dueaction.php?action=accept&id=".$service_id."' style='text-decoration:none;'><input type='button'  class='acceptbt' name='accept' value='Accept'/></a>";
$rejectbtn ="<a href='http://www.solarprimeg.co.za/admin2/dueaction.php?action=reject&id=".$service_id."' style='text-decoration:none;' ><input type='button' name='reject' class='rejectbt' value='Reject'/></a>";
$eol     = PHP_EOL;
$subject = "SERVICES DUE THIS MONTH";
$message = "Dear ".$customername.",";
        //$message1 .="\r\n Your services due this month.";
        $message = file_get_contents('servicedue_etemplate.html');
        $message = str_replace("{{CUSTOMERNAME}}", $customername, $message);
        $message = str_replace("{{ACCEPT_BTN}}", $acceptbtn, $message);
        $message = str_replace("{{REJECT_BTN}}", $rejectbtn, $message);

$from_name = "Solar Primeg";
$from_mail = "www.solarprimeg.co.za";
$replyto   = "www.solarprimeg.co.za";
$mailto    = "jorge@pixelgraphics.co.za";
//$mailto    = $toemailid;
$header    = "From: " . $from_name . " <" . $from_mail . ">\n";
$header .= "Reply-To: " . $replyto . "\n";
$header .= "MIME-Version: 1.0\n";
$header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\n\n";
$emessage = "--" . $uid . "\n";
$emessage .= "Content-type:text/html; charset=iso-8859-1\n";
$emessage .= "Content-Transfer-Encoding: 7bit\n\n";
$emessage .= $message . "\n\n";
$emessage .= "--" . $uid . "\n";
$emessage .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\n"; // use different content types here
$emessage .= "Content-Transfer-Encoding: base64\n";
$emessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\n\n";
$emessage .= $content . "\n\n";
$emessage .= "--" . $uid . "--";
mail($mailto, $subject, $emessage, $header);
echo 'Mail Send Successfully';	 

print_r($job_id);
    }

/*
//$pp = 'archirayan75@gmail.com';
$pp = implode($p,','); 
                                                        


//boundary 
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 



	//update emailstatus 
	$sqlquery = "update job_card set isEmailSend =1 where job_id =".$job_id; 
	$result = mysqli_query($sql_conn,$sqlquery);
        //$subject = "SERVICES DUE THIS MONTH";
        $customername = $firstname;
        $acceptbtn ="<a href='http://www.solarprimeg.co.za/admin/dueaction.php?action=accept&id=".$service_id."' style='text-decoration:none;'><input type='button'  class='acceptbt' name='accept' value='Accept'/></a>";
        $rejectbtn ="   <a href='http://www.solarprimeg.co.za/admin/dueaction.php?action=reject&id=".$service_id."' style='text-decoration:none;' ><input type='button' name='reject' class='rejectbt' value='Reject'/></a>";
        $message= "Dear ".$customername.",";
        //$message .="\r\n Your services due this month.";
        $message = file_get_contents('servicedue_etemplate.html');
        $message = str_replace("{{CUSTOMERNAME}}", $customername, $message);
        $message = str_replace("{{ACCEPT_BTN}}", $acceptbtn, $message);
        $message = str_replace("{{REJECT_BTN}}", $rejectbtn, $message);
		
  //      $headers = "MIME-Version: 1.0\r\n";
        $headers = "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

$message1 = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .  "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";

$file = '2019-Solar-PriMeg-Service-Letter.pdf';
$path = '/usr/www/users/solarsjkyr/upload';
if(!empty($file) > 0){
    if(is_file($file)){
        $message1 .= "--{$mime_boundary}\n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));

        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message1 .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
        "Content-Description: ".basename($file)."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}
$from = 'www.solarprimeg.co.za';
$message1 .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;


        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: www.solarprimeg.co.za";
        $headers .= "Cc: jorge@pixelgraphics.co.za";
		

		
		
		//mail_attachment($filename, $path, $pp, 'info@solarprimeg.co.za', 'Solarprimeg', 'reply@solarprimeg.co.za', $subject, $message);
		//exit;
		// mail($pp, $subject, $message, $headers);
                  mail($pp, $subject, $message1, $headers, $returnpath); 
                echo 'Mail Send Successfully';
   //     header('Location: home.php'); 
        exit();
*/


