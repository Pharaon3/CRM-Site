<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>
<?php include("admin_header.php"); ?>

<script src="../js/js.js"></script>

<div style="padding:10px; font-family:Arial; font-size:14px; font-weight:bold; background-color:#333; color:white; margin:10px; margin-left:0px">PAYMENT CONFIRMATION:</div>

<script type="text/javascript">
///////////////////
// Customization
//
// One place to customize.
//
// Specify the email address to send the notification email to.

// Specify the location of the PHP script. The location is the 
//    URI of the PHP script (the URL without the http://example.com part). 

var PHPscriptLocation = "/admin/notify.php";

// End of customization
//////////////////////////

var httpRequest;
if (window.XMLHttpRequest) {
   try { httpRequest = new XMLHttpRequest(); }
   catch(e) {}
   } 
else if (window.ActiveXObject) {
   try { httpRequest = new ActiveXObject("Msxml2.XMLHTTP"); }
   catch(e) {
      try { httpRequest = new ActiveXObject("Microsoft.XMLHTTP"); } 
      catch(e) {}
      }
   }
if(httpRequest) {
   url = PHPscriptLocation + "?referrer=" + escape(document.referrer) + "&page=" + escape(document.URL);
   httpRequest.onreadystatechange = function(){};
   httpRequest.open('GET',url,true);
   httpRequest.send('');
   }
</script>




<div class="page-break">
  <table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
      <td class="heading_01">Debit order successfully processed!</td>
    </tr>
    <tr>
      <td><p class="copy_01">Thank you for processing your payment cycle. If you have chosen  the either of payment plan, this payment will automatically debit your account  each month/year completing its full cycle. No further action will be required  until the full cycle has been concluded. Thereafter the cycle has completed you  will be required to set the next cycle.<br />
        <br />
        If for any reason you wish to cancel or stop the debit order  cycle please notify us before hand and we will certainly assist with your  request. This process has not been fully automated, but we continue to improve  our systems for better convenience. </p>
        <p class="copy_01">We thank you for your continues support!<br />
          Pixel Graphics Team
        </p></td>
    </tr>
  </table>
</div>

<?php include("admin_footer.php"); ?>
