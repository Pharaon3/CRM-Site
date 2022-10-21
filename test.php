<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<style>
.modal-title {
  text-align:center;
  font-size:20px;
  font-weight:bold;
}
@media screen and (min-width: 768px){
  #myModal1 .modal-dialog {
    webkit-box-shadow: 0 5px 15px rgba(0,0,0,.5);
    box-shadow: 0 5px 15px rgba(0,0,0,.5);
  }
}
#myModal1 .modal-header {
  border-radius: 5px 5px 0 0;
  background-color:#fff;
}
#myModal1 .modal-content {
  background-color:#fff;
  border-radius: 0;
  padding:20px;
  box-shadow: none;
  background-clip:inherit;
}
#myModal1 .modal-footer {
  background-color:#fff;
  border-radius: 0 0 5px 5px;
}


/*2*/
@media screen and (min-width: 768px){
  #myModal2 .modal-dialog {
    webkit-box-shadow: 0 5px 15px rgba(0,0,0,.5);
    box-shadow: 0 5px 15px rgba(0,0,0,.5);
  }
}
#myModal2 .modal-header {
  border-radius: 5px 5px 0 0;
  background-color:#fff;
}
#myModal2 .modal-content {
  background-color:#fff;
  border-radius: 0;
  padding:20px;
  box-shadow: none;
  background-clip:inherit;
}
#myModal2 .modal-footer {
  background-color:#fff;
  border-radius: 0 0 5px 5px;
}
</style>
</head>
<body>

<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
     <div class="modal-dialog">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <p class="modal-title">Quotation</p>
      </div>
      <div style="background-color:white; padding:10px"><?php include ("test_quote_doc.php");?></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
     <div class="modal-dialog">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <p class="modal-title">Install</p>
      </div>
		
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>


<a data-toggle="modal" href="http://www.solarprimeg.co.za/admin/test_quote_doc.php" data-remote="test_quote_doc.php #modal-section" data-target="#myModal1">Page 1 Modal Content</a>
<br /><br />
<a data-toggle="modal" href="test_install_doc.php" data-remote="test_install_doc.php #modal-section" data-target="#myModal2">Page 2 Modal Content</a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
$(document).on('hidden.bs.modal', function (e) {
    var target = $(e.target);
    target.removeData('bs.modal')
    .find(".clearable-content").html('');
});
</script>
</body>
</html>