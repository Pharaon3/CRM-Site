<?php

include("../includes/admin.php"); 
include("../includes/clsDB.php"); 
include("../includes/dbconn.php");

?>
<style>
.but_blk{
	width:300px; 
	padding:10px; 
	color:#333; 
	border:thin solid #333; margin:10px;
	transition:ease 0.65s;
	border-radius:8px;
	margin-left: auto;
	margin-right:auto;
	text-align:center;
}
.but_blk:hover{
	background-color:#ccc;
}
</style>
<?php include("admin_header.php"); ?>
<script src="../js/js.js"></script>
<script language="javascript" type="text/javascript">
function validate(){
    var tTarget = "validate_response";
    cleardata(tTarget);
    bValid = true;
    if(checkfield('txtName', 'Please enter a username',tTarget,'required')!='true'){bValid = false}
    if(checkfield('txtPassword', 'Please enter a password',tTarget,'required')!='true'){bValid = false}
    if(bValid == false){
        return false;
    }
}
</script>
<!-- datepicker style -->
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script>
  $(document).ready(function() {
    $("#datepicker").datepicker({
	minDate: 0,
	dateFormat: 'yy-mm-dd'
	});
  });
</script>
<br />
<div style="width:100%; border-bottom:thin solid #333; text-align:left; font-size:18px; font-weight:bold; margin-bottom:20px">JOB CARD SELECTION</div>
<br />
<div style=" width:800px; margin-left:auto; margin-right:auto">
	
    <a href="step_2_quote.php?id=<?php echo $_GET['id'] ?>" style="text-decoration:none"><div class="but_blk"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;ADD QUOTATION</div></a>
    <a href="step_3_install.php?id=<?php echo $_GET['id'] ?>" style="text-decoration:none"><div class="but_blk"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;ADD INSTALLATION</div></a>
    <a href="http://solarprimeg.co.za/admin2/breakdown_update.php" style="text-decoration:none"><div class="but_blk"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;ADD BREAKDOWN</div></a>
</div>


<?php include("admin_footer.php"); ?>

