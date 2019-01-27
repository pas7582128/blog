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
  	$email1=$_SESSION['email'];
  	
  	$sql5="select email from add_blog where title='$blogname'";
  	$rs5=mysqli_query($conn, $sql5);
  	while($row=mysqli_fetch_assoc($rs5)){
  		$email2=$row['email'];
  	}
  	if($email1!=$email2){
					$sql4="insert into notify(sender,reciever,bname,lorc,date) values ('$email1','$email2','$blogname','-1',current_timestamp)";
					$rs4=mysqli_query($conn, $sql4);
					echo "4".$rs3;
					}
  	 echo '<script type="text/javascript">window.location.href = "res_search_page.php?pl='.$blogname.'";</script>';
  }
}
else{
	
}
?>
