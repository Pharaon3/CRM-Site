<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>
<?php
//send email mail code start here
if (isset($_GET['id'])) {
  $job_id = $_GET['jobid'];
  $service_id = $_GET['id'];
  $sql2 = "select * from job_card WHERE job_id = " . $job_id;
  $result = mysqli_query($sql_conn, $sql2);
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
    $sqlquery = "update job_card set isEmailSend =1 where job_id =" . $job_id;
    $result = mysqli_query($sql_conn, $sqlquery);
    // $to = 'test-wbd3c4uau@srv1.mail-tester.com';
    $to = $toemailid;
    // $to = 'jorge@pixelgraphics.co.za';

    $subject = "SERVICES";

    $customername = $firstname;
    $acceptbtn = "<a href='http://www.solarprimeg.co.za/admin2/dueaction.php?action=accept&id=" . $service_id . "' style='text-decoration:none;'><input type='button'  class='acceptbt' name='accept' value='Accept'/></a>";
    $rejectbtn = "<a href='http://www.solarprimeg.co.za/admin2/dueaction.php?action=reject&id=" . $service_id . "' style='text-decoration:none;' ><input type='button' name='reject' class='rejectbt' value='Reject'/></a>";

    $message = "Dear " . $customername . ",";
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
<?php include("sidebar.php"); ?>
<?php
$sql = "select * FROM users";
$r = mysqli_query($sql_conn, $sql);
?>

<style>
  td {
    font-weight: normal !important
  }

  .td {
    font-weight: normal !important
  }

  .yes_approved {
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
    font-weight: normal !important;
  }

  .yes_approved:after {
    content: "Approved";
  }

  .Approved {
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
    font-weight: normal !important;
  }

  .Approved:after {
    content: "Approved";
  }

  .not_approved {
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
    font-weight: normal !important;
  }

  .not_approved:after {
    content: "Not Approved";
  }

  .Not Approved {
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
    font-weight: normal !important;
  }

  .Not Approved:after {
    content: "Not Approved";
  }

  .bt_wid {
    /* width:; */
  }
</style>

<link href="home.css" rel="stylesheet">

<div style="min-height: 250px;">

  <?php
  if ($_SESSION['UserName'] == 'Borwood') {
    echo
    "<< Select the tab on the left for more options...";
  } else {
  ?>
    <div style="max-width:100%; margin-left:auto; margin-right:auto">
      <div class="titleBar">
        <p class="crmSystme">CRM SYSTEM <?php echo "J"; ?> </p>
      </div>
      <div id="main_content">
        <div class="date">
          <?php echo "23 OCT 2022 - MONDAY"; ?>
        </div>
        <div class="div_divider"></div>
        <div class="dashboard">
          DASHBOARD
        </div>
        <div style="margin-left: 40px">
          <table class="bigTable">
            <thead></thead>
            <tbody>
              <tr>
                <td style="padding: 20px;width: 600px; height: 500p;">
                  <div class="viewTable">
                    <div style="width: 100%; display: flex; text-align: center; height: 35px;">
                      <div style="background-color: #606060; color: white; width: 70%; float: left;display: flex;align-items: center; border-style: solid;border-width: 0px;border-top-left-radius: 10px;">
                        <p class="dashboardTableHeader">RECENT CUSTOMER QUOTATIONS</p>
                      </div>
                      <div style="background-color: black; color: white; width: 30%; float: right; display: flex;align-items: center; border-style: solid;border-width: 0px;border-top-right-radius: 10px;">
                        <p class="dashboardTableHeader">VIEW ALL</p>
                      </div>
                    </div>
                    <div style="width: 100%;">
                      <p style="margin: 0px; text-align: right; margin-right: 20px; margin-top: 10px;">Last 30 Days <img src="./images/drop-down-39-16.png"></p>
                    </div>
                    <table class="separateTable">
                      <thead>
                        <tr style=" height: 30px;">
                          <td style="width: 10%;"></td>
                          <td style="width: 10%;">ID</td>
                          <td style="width: 30%;">DATE QUOTED</td>
                          <td style="width: 30%;">CLIENT NAME</td>
                          <td style="width: 20%;">APPROVED</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr style="height: 30px;">
                          <td>Edit</td>
                          <td>522</td>
                          <td>28 Oct 2022</td>
                          <td>Jorge Nicolau</td>
                          <td>Approved</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </td>
                <td style="padding: 20px; width: 600px; height: 500p;">
                  <div class="viewTable">
                    <div style="width: 100%; display: flex; text-align: center; height: 35px;">
                      <div style="background-color: #606060; color: white; width: 70%; float: left;display: flex;align-items: center; border-style: solid;border-width: 0px;border-top-left-radius: 10px;">
                        <p class="dashboardTableHeader">SERVICE DUE - OCTOBER 2022</p>
                      </div>
                      <div style="background-color: black; color: white; width: 30%; float: right; display: flex;align-items: center; border-style: solid;border-width: 0px;border-top-right-radius: 10px;">
                        <p class="dashboardTableHeader">VIEW ALL</p>
                      </div>
                    </div>
                    <div style="width: 100%;">
                      <p style="margin: 0px; text-align: right; margin-right: 20px; margin-top: 10px;">Last 30 Days <img src="./images/drop-down-39-16.png"></p>
                    </div>
                    <table id="quotations" class="separateTable">
                      <thead>
                        <tr style=" height: 30px;">
                          <td></td>
                          <td>ID</td>
                          <td>Client Name</td>
                          <td>Custromers Serial No.</td>
                          <td>Previous Service</td>
                          <td>Notified</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr style=" height: 30px;">
                          <td>522</td>
                          <td>28 Oct 2022</td>
                          <td>1223343434</td>
                          <td>28 Oct 2020</td>
                          <td>28 Oct 2022</td>
                          <td>Email Series</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </td>
                <td style="padding: 20px; width: 300px;">
                  <div class="viewTable">
                    <p class="newProduct" style="margin-left: 20px;">New</p>
                    <div class="newLines">
                      <div style="float: left;display: flex;align-items: center;">
                        <p class="newIcon">NEW</p>
                      </div>
                      <div class="newProductDiv">
                        <p class="dashboardTableHeader">NEW PRODUCT</p>
                      </div>
                    </div>
                    <div class="newLines">
                      <div style="float: left;display: flex;align-items: center;">
                        <p class="newIcon">NEW</p>
                      </div>
                      <div class="newProductDiv">
                        <p class="dashboardTableHeader">NEW CUSTOMER</p>
                      </div>
                    </div>
                    <div class="newLines">
                      <div style="float: left;display: flex;align-items: center;">
                        <p class="newIcon">NEW</p>
                      </div>
                      <div class="newProductDiv">
                        <p class="dashboardTableHeader">NEW BREAKDOWN</p>
                      </div>
                    </div>
                    <div class="newLines">
                      <div style="float: left;display: flex;align-items: center;">
                        <p class="newIcon">NEW</p>
                      </div>
                      <div class="newProductDiv">
                        <p class="dashboardTableHeader">NEW BREAKDOWN</p>
                      </div>
                    </div>
                    
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding: 20px;width: 600px; height: 500p;">
                  <div class="viewTable">
                    <div style="width: 100%; display: flex; text-align: center; height: 35px;">
                      <div style="background-color: #606060; color: white; width: 70%; float: left;display: flex;align-items: center; border-style: solid;border-width: 0px;border-top-left-radius: 10px;">
                        <p class="dashboardTableHeader">NEW CUSTOMERS</p>
                      </div>
                      <div style="background-color: black; color: white; width: 30%; float: right; display: flex;align-items: center; border-style: solid;border-width: 0px;border-top-right-radius: 10px;">
                        <p class="dashboardTableHeader">VIEW ALL</p>
                      </div>
                    </div>
                    <div style="width: 100%;">
                      <p style="margin: 0px; text-align: right; margin-right: 20px; margin-top: 10px;">Last 30 Days <img src="./images/drop-down-39-16.png"></p>
                    </div>
                    <table class="separateTable">
                      <thead>
                        <tr style=" height: 30px;">
                          <td style="width: 10%;"></td>
                          <td style="width: 10%;">ID</td>
                          <td style="width: 30%;">Date Created</td>
                          <td style="width: 30%;">Client Name</td>
                          <td style="width: 20%;">Serial Number</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr style="height: 30px;">
                          <td>Edit</td>
                          <td>522</td>
                          <td>28 Oct 2022</td>
                          <td>Jorge Nicolau</td>
                          <td>12132343234</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </td>
                <td style="padding: 20px; width: 600px; height: 500p;">
                  <div class="viewTable">
                    <div style="width: 100%; display: flex; text-align: center; height: 35px;">
                      <div style="background-color: #606060; color: white; width: 70%; float: left;display: flex;align-items: center; border-style: solid;border-width: 0px;border-top-left-radius: 10px;">
                        <p class="dashboardTableHeader">BREAKDOWN/CALL-OUT</p>
                      </div>
                      <div style="background-color: black; color: white; width: 30%; float: right; display: flex;align-items: center; border-style: solid;border-width: 0px;border-top-right-radius: 10px;">
                        <p class="dashboardTableHeader">VIEW ALL</p>
                      </div>
                    </div>
                    <div style="width: 100%;">
                      <p style="margin: 0px; text-align: right; margin-right: 20px; margin-top: 10px;">Last 30 Days <img src="./images/drop-down-39-16.png"></p>
                    </div>
                    <table id="quotations" class="separateTable">
                      <thead>
                        <tr style=" height: 30px;">
                          <td>ID</td>
                          <td>Client Name</td>
                          <td>Custromers Serial No.</td>
                          <td>Telephone</td>
                          <td>Date Attended</td>
                          <td>Job Complete</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr style=" height: 30px;">
                          <td>522</td>
                          <td>28 Oct 2022</td>
                          <td>1223343434</td>
                          <td>072 343 0909</td>
                          <td>28 Oct 2022</td>
                          <td>Complete</td>
                        </tr>
                        <tr style=" height: 30px;">
                          <td>522</td>
                          <td>28 Oct 2022</td>
                          <td>2222222222</td>
                          <td>072 343 0909</td>
                          <td>28 Oct 2022</td>
                          <td>pending</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </td>
                <td style="padding: 20px; width: 300px;">
                  <div class="viewTable">
                    <p class="newProduct" style="margin-left: 20px;">Overview</p>
                    <div class="newLines">
                      <div style="float: left;display: flex;align-items: center;">
                        <p>Customers</p>
                      </div>
                      <div style="float: right;">
                        <p >90</p>
                      </div>
                    </div>
                    <div class="newLines">
                      <div style="float: left;display: flex;align-items: center;">
                        <p>Quotations</p>
                      </div>
                      <div>
                        <p >110</p>
                      </div>
                    </div>
                    <div class="newLines">
                      <div style="float: left;display: flex;align-items: center;">
                        <p>Breakdowns</p>
                      </div>
                      <div>
                        <p >20</p>
                      </div>
                    </div>
                    <div class="newLines">
                      <div style="float: left;display: flex;align-items: center;">
                        <p>Services</p>
                      </div>
                      <div>
                        <p >10</p>
                      </div>
                    </div>                    
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
    <p>&nbsp;</p>
  <?php } ?>
</div>

<?php include("admin_footer.php"); ?>

<script>
  function emailsentmsg() {

    alert("Email sent sucessfully.");

  }
</script>