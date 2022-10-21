<?php include("../includes/dbconn.php"); ?>
<?php include("../includes/admin.php"); ?>

<?php include("admin_header.php"); 
?>


<style>
/* Popup box BEGIN */
.box {
	padding:10px;
}

.button {
  font-size: 1em;
  padding: 10px;
  color: #fff;
  border: 2px solid #06D85F;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  margin-top:200px !important; 
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
/* Popup box BEGIN */
</style>
<?php 
$sql = "select * FROM solar_contact";
$r = mysqli_query($sql_conn, $sql);

$ref =  $_GET['id'];

if(isset($_GET["delete"])){
    
	$feedback = "Are you sure you want to delete this message <a href='contactus_view.php?id=$ref&cd=true'>Yes</a>  <a href='contactus_view.php'>No</a>?";
}

if(isset($_GET['cd'])){

$sql = "DELETE FROM solar_contact WHERE customer_id ='$ref'";
$delete = mysqli_query($sql_conn, $sql);
header("Location: contactus_view.php");
exit;

}
?>
<?=  isset($feedback)? $feedback."<br /><br />" : "";  ?>
<?php include("admin_footer.php"); ?>
