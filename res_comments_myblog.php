<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ass5_3rdyear";
session_start();

$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn,$database);

if($_SESSION['email']){
	$ctitle=$_POST['title'];
	$ccontent=$_POST['rev'];
	$blogname=$_GET['pl'];
	echo $blogname;
	$tempemail=$_SESSION['email'];
	$sql="insert into comment (email,title,ctitle,ccontent,cdate) values ('$tempemail','$blogname','$ctitle','$ccontent',current_timestamp)";

	 $rs = mysqli_query($conn, $sql);
  	$affectedRows = mysqli_affected_rows($conn);
  if($affectedRows == 1){
  	 echo '<script type="text/javascript">window.location.href = "myblogs.php";</script>';
  }
}
else{
	
}
?>
