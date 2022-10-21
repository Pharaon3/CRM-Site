<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>
<?php
   //send email mail code start here
if (isset($_GET['id'])) {
    $job_id = $_GET['jobid'];
    $service_id = $_GET['id'];
    $sql2 = "select * from job_card WHERE job_id = " .$job_id;
    $result = mysqli_query($sql_conn,$sql2);
    while ($row2 = mysqli_fetch_array($result)) {
        //echo '<pre>'; print_r($row2);
        $toemailid = isset($row2['email']) ? $row2['email'] : '';
        $firstname = isset($row2['first_name']) ? $row2['first_name'] : '';
        $surname = isset($row2['surname']) ? $row2['surname'] : '';
        $address = isset($row2['address']) ? $row2['address'] : '';
        $cellno = isset($row2['cell']) ? $row2['cell'] : '';
        $card_no = isset($row2['card_no']) ? $row2['card_no'] : '';
        $date_quote = isset($row2['date_quote']) ? $row2['date_quote'] : '';
    }

      // $sql_query_pdf = "SELECT `image` FROM service_doc WHERE service_job_code=$service_id";
      // $rowPDF = '';
      // if ($doc_result = $sql_conn -> query($sql_query_pdf)) {
      //   $rowPDF = $doc_result -> fetch_row();
      //   $doc_result -> free_result();
      // }

    if ($toemailid != ' ') {
        //update emailstatus 
        $sqlquery = "update job_card set isEmailSend =1 where job_id =".$job_id; 
        $result = mysqli_query($sql_conn,$sqlquery);
            // $to = 'test-wbd3c4uau@srv1.mail-tester.com';
        $to = $toemailid;
        // $to = 'jorge@pixelgraphics.co.za';
  
        $subject = "SERVICES";

        $customername = $firstname;
        $acceptbtn ="<a href='http://www.solarprimeg.co.za/admin2/dueaction.php?action=accept&id=".$service_id."' style='text-decoration:none;'><input type='button'  class='acceptbt' name='accept' value='Accept'/></a>";
        $rejectbtn ="<a href='http://www.solarprimeg.co.za/admin2/dueaction.php?action=reject&id=".$service_id."' style='text-decoration:none;' ><input type='button' name='reject' class='rejectbt' value='Reject'/></a>";

        $message= "Dear ".$customername.",";
        //$message .="\r\n Your services due this month.";
        $message = file_get_contents('servicedue_etemplate.html');
        $message = str_replace("{{CUSTOMERNAME}}", $customername, $message);
        $message = str_replace("{{ACCEPT_BTN}}", $acceptbtn, $message);
        $message = str_replace("{{REJECT_BTN}}", $rejectbtn, $message);      
 
      // boundary
      $semi_rand = md5(uniqid(time()));
      $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
      
      // headers for attachment
      $headers = "From: sales@solarprimeg.co.za";
    //   $headers .= "Cc: $toemailid";
      $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
      
      // multipart boundary
      $msgContent = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n";
      $msgContent .= "Content-Type: text/html; charset=ISO-8859-1\"\n";
      $msgContent .= "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
      $msgContent .= "--{$mime_boundary}\n";
      

      $filename = '2020-Solar-PriMeg-Service-Letter.pdf';
      $file = fopen($filename, "rb");
      $data = fread($file, filesize($filename));
      fclose($file);
      $data = chunk_split(base64_encode($data));
    
      $msgContent .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$filename\"\n";
      $msgContent .= "Content-Disposition: attachment;\n" . " filename=\"$filename\"\n";
      $msgContent .= "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
      $msgContent .= "--{$mime_boundary}\n";
  
      $resultMail = mail($to, $subject, $msgContent, $headers);

      header('Location: home.php'); 
      exit(); 
       
    }
}
?> 
<?php include("admin_header.php"); ?>
<?php	
$sql = "select * FROM users";
$r = mysqli_query($sql_conn, $sql);
?>
<style>
    td{ font-weight:normal !important}
    .td{ font-weight:normal !important}
    .yes_approved{
        background-color: #5eea81;
        color: white;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        width: 100px;
        padding: 10px;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        border-radius: 7px;
        font-weight:normal !important;
    }
    .yes_approved:after{
        content:"Approved";
    }
	
	  .Approved{
        background-color: #5eea81 !important;
        color: white;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        width: 100px;
        padding: 10px;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        border-radius: 7px;
        font-weight:normal !important;
    }
    .Approved:after{
        content:"Approved";
    }
	
    .not_approved{
        background-color: #e9a4a9 !important;
        color: white;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        width: 100px;
        padding: 10px;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        border-radius: 7px;
        font-weight:normal !important;
    }
    .not_approved:after{
        content:"Not Approved";
    }
	    .Not Approved{
        background-color: #e9a4a9 !important;
        color: white;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        width: 100px;
        padding: 10px;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        border-radius: 7px;
        font-weight:normal !important;
    }
    .Not Approved:after{
        content:"Not Approved";
    }
    .bt_wid{
        width:;
    }
</style>
<div style="min-height: 250px;">

<?php
if ($_SESSION['UserName'] == 'Borwood') {
    echo
    "<< Select the tab on the left for more options...";
} else {
    ?>
        <div style="max-width:100%; margin-left:auto; margin-right:auto">
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                    <th colspan="6" align="center" bgcolor="#333333" class="heading_02" style="padding:5px" scope="col">QUICK ACTIONS</th>
                </tr>
                <tr>
                    <td class="bt_wid"><a href="factory_job_card_tank.php?id=0" style="color:black; margin-bottom:10px"><div class="dash_shortcut"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;NEW TANK</div></a></td>
                    <td class="bt_wid"><a href="factory_job_card_panels.php?id=0" style="color:black; margin-bottom:10px"><div class="dash_shortcut"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;NEW PANEL</div></a></td>
                    <td class="bt_wid"><a href="step_1_client.php?id=0" style="color:black; margin-bottom:10px"><div class="dash_shortcut"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;NEW JOB CARD</div></a></td>
                </tr>
                <tr>
                    <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th width="50%" valign="top" scope="col">
                                    <!--left block -->
                                    <fieldset style="border:thin solid #999; padding:0px !important ">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <th width="82%" align="left" bgcolor="#333333" scope="col"><span class="heading_02" style="padding:10px; display:block">RECENT FACTORY TANKS</span></th>
                                            <th width="18%" bgcolor="#333333" scope="col"><a href="factory_job_card_tank_view.php" style="text-decoration:none; color:#000"><div class="dash_view_bt1">VIEW</div></a></th>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div style="padding:10px">
                                                        <!-- Recent factory tanks -->
    <?php
    /* $sql = "select * from fac_job_panels where username and user_id >= 1 order by username"; */
    $sql1 = "select * from fac_job_tank ORDER BY id_tank desc LIMIT 5 ";
    $r1 = mysqli_query($sql_conn, $sql1);
    ?>

                                                        <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
                                                            <tr bgcolor="#E5E5E5">
                                                                <td width="74">Edit</td>
                                                                <td width="91" class="do_b">ID:</td>
                                                                <td width="89" class="do_b">Loaded Date:</td>
                                                                <td width="89" class="do_b">Serial No.:</td>
                                                                <td width="94" class="do_b">Approval Date:</td>
                                                            </tr>
    <?php
    while ($row = mysqli_fetch_array($r1)) {
        ?>
                                                                <tr>
                                                                    <td><a href="factory_job_card_tank.php?id=<?php echo $row['id_tank'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
                                                                    <td><?php echo $row['id_tank'] ?></td>
                                                                    <td><?php echo date_format(date_create($row['date']), 'd-m-Y') ?></td>
                                                                    <td><?php echo $row['serial_code'] ?></td>
                                                                    <td><?php echo date_format(date_create($row['approval_date']), 'd-m-Y') ?></td>
                                                                </tr>
        <?php
    }
    ?>
                                                        </table>

                                                    </div>

                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </th>
                                <th width="2%" class="heading_02" scope="col">&nbsp;</th>
                                <th width="48%" align="left" valign="top" scope="col">

                                    <!-- right block -->
                                    <fieldset style="border:thin solid #999; padding:0px !important ">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <th width="82%" align="left" bgcolor="#333333" scope="col"><span class="heading_02" style="padding:10px; display:block">RECENT FACTORY PANELS</span></th>
                                            <th width="25%" align="right" bgcolor="#333333" scope="col"><a href="factory_job_card_panels_view.php" style="text-decoration:none; color:#000"><div class="dash_view_bt1">VIEW</div></a></th>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div style="padding:10px">
                                                        <!-- Recent factory panels -->
    <?php
    /* $sql = "select * from fac_job_panels where username and user_id >= 1 order by username"; */
    $sql2 = "select * from fac_job_panels ORDER BY id_panels desc LIMIT 5";
    $r2 = mysqli_query($sql_conn, $sql2);
    ?>

                                                        <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
                                                            <tr bgcolor="#E5E5E5">
                                                                <td width="74">Edit</td>
                                                                <td width="70" class="do_b">ID:</td>
                                                                <td width="91" class="do_b">Loaded Date:</td>
                                                                <td width="83" class="do_b">Serial No.:</td>
                                                                <td width="94" class="do_b">Approval Date:</td>
                                                            </tr>
    <?php
    while ($row = mysqli_fetch_array($r2)) {
        ?>
                                                                <tr>
                                                                    <td><a href="factory_job_card_panels.php?id=<?php echo $row['id_panels'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
                                                                    <td><?php echo $row['id_panels'] ?></td>
                                                                    <td><?php echo date_format(date_create($row['date']), 'd-m-Y') ?></td>
                                                                    <td><?php echo $row['serial_no'] ?></td>
                                                                    <td><?php echo date_format(date_create($row['approval_date']), 'd-m-Y') ?></td>
                                                                </tr>
        <?php
    }
    ?>
                                                        </table>


                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </th>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th width="50%" valign="top" scope="col"> <!--left block -->
                                    <fieldset style="border:thin solid #999; padding:0px !important ">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <th width="82%" align="left" valign="top" bgcolor="#333333" scope="col"><span class="heading_02" style="padding:10px; display:block">RECENT JOB CARD</span></th>
                                            <th align="right" valign="top" bgcolor="#333333" scope="col"><a href="search.php" style="text-decoration:none; color:#000"><div class="dash_view_bt1">VIEW</div></a></th>
                                            </tr>
                                            <tr>
                                                <td colspan="2" valign="top"><div style="padding:10px">
                                                        <!-- Recent job card -->
    <?php
    /* $sql = "select * from fac_job_panels where username and user_id >= 1 order by username"; */
    $sql3 = "select * from job_card ORDER BY job_id desc LIMIT 5 ";
    $r3 = mysqli_query($sql_conn, $sql3);
    ?>
                                                        <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
                                                            <tr bgcolor="#E5E5E5">
                                                                <td width="74">Edit</td>
                                                                <td width="42" class="do_b">ID:</td>
                                                                <td width="42" class="do_b">Date Quoted:</td>
                                                                <td width="109" bgcolor="#E5E5E5" class="do_b">Address:</td>
                                                                <td width="122" class="do_b">Approved:</td>
                                                            </tr>
    <?php
    while ($row = mysqli_fetch_array($r3)) {
        ?>
                                                                <tr>
                                                                    <td><a href="job_card_edit.php?id=<?php echo $row['job_id'] ?>"><img src="images/icon-edit.png" alt="" border="0" /></a></td>
                                                                    <td><?php echo $row['job_id'] ?></td>
                                                                    <td><?php echo $row['date_quote'] ?></td>
                                                                    <td><?php echo $row['address'] ?></td>
                                                                    <td><div class="<?php echo $row['approved'] ?>"></div></td>
                                                                </tr>
        <?php
    }
    ?>
                                                        </table>
                                              </div></td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </th>
                                <th width="2%" class="heading_02" scope="col">&nbsp;</th>
                                <th width="48%" valign="top" scope="col"> <!-- right block -->
                                    <fieldset style="border:thin solid #999; padding:0px !important ">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                            <tr>
                                                <th width="76%" align="left" bgcolor="#333333" scope="col"><span class="heading_02" style="padding:10px; display:block">SERVICES DUE THIS MONTH</span></th>
<th width="24%" align="right" bgcolor="#333333" scope="col"><a href="service_search.php" style="text-decoration:none; color:#000">
<div class="dash_view_bt1">VIEW</div>
</a></th>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div style="padding:10px; text-align:center; max-height:250px; overflow:scroll">

                                                        <!-- up coming services due -->
    <?php
    /* $sql = "select * from fac_job_panels where username and user_id >= 1 order by username"; */

    $curr_date = date("Y-m-d");

    /*$sql = "select * from services WHERE YEAR(next_service)= YEAR('$curr_date') AND MONTH(next_service)= MONTH('$curr_date') ORDER BY next_service DESC"; */
	$sql ="select jc.isEmailSend,s.service_id,s.service_job_code, s.team, s.next_service from services as s
			inner join job_card as jc ON jc.job_id = s.service_job_code
			WHERE YEAR(s.next_service)= YEAR('$curr_date') AND MONTH(s.next_service)= MONTH('$curr_date') ORDER BY s.next_service DESC";
    $r = mysqli_query($sql_conn, $sql);
    ?>

            <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#DDDDDD" class="tablelist">
                <tr>
                    <td width="74" bgcolor="#E5E5E5">Edit</td>
                    <td width="216" bgcolor="#E5E5E5" class="do_b">Service Id:</td>
                    <td width="216" bgcolor="#E5E5E5" class="do_b">Job Code:</td>
                    <td width="285" bgcolor="#E5E5E5" class="do_b">Client:</td>
                    <td width="522" bgcolor="#E5E5E5" class="do_b">Service Date:</td>
                    <td width="285" bgcolor="#E5E5E5">&nbsp;</td>

                </tr>
    <?php
    while ($row = mysqli_fetch_array($r)) {
		
		$sqlCard = "SELECT * FROM `job_card` WHERE job_id =".$row['service_job_code']." LIMIT 1";
		$r02 = mysqli_query($sql_conn, $sqlCard);
		$namer = "NA";
		while ($cardData = mysqli_fetch_array($r02)) {
			$namer = $cardData['first_name']." ".$cardData['surname'];
		}
		
        ?>
                <tr>
                    <td><a href="service_edit_view2.php?id=<?php echo $row['service_id'] ?>"><img src="images/icon-edit.png" border="0" /></a></td>
                    <td><?php echo $row['service_id'] ?></td>
                    <td><?php echo $row['service_job_code'] ?></td>
                    <td>
                        <?php echo $namer;  ?>
                    </td>
                    <td><?php echo $row['next_service'] ?></td>
                    <td>
					<?php 
					if($row['isEmailSend']==0){
					?>
					 <a href='home.php?id=<?php echo $row['service_id'] ?>&jobid=<?php echo $row['service_job_code'] ?>' style='text-decoration:none;' onclick='emailsentmsg();'><input type='button' name='sendreminder' value='Send Email' /></a>
					<?php }else{ ?>
					
					<a href='home.php?id=<?php echo $row['service_id'] ?>&jobid=<?php echo $row['service_job_code'] ?>' style='text-decoration:none;' onclick='emailsentmsg();'><input type='button' name='sendreminder' value='Email Sent' /></a>					
						
					<?php } ?>
					</td>
                </tr>
        <?php
    }
    ?>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </th>
                            </tr>
                  </table></td>
                </tr>
            </table>
        </div>
        <p>&nbsp;</p>
<?php } ?>
</div>

    <?php include("admin_footer.php"); ?>
	
	<script>
	function emailsentmsg(){
		
		alert("Email sent sucessfully."); 
		
	}
	</script>
