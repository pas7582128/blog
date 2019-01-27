<?php
	session_start();
	

	$servername="localhost";
	$username="root";
	$password="";

	//create connection
	$conn=new mysqli($servername,$username,$password);

	if($conn->connect_error){
		die("Connection failed".$conn->connect_error);
	}


	$db=mysqli_select_db($conn,'ass5_3rdyear');
	if($db){
		$p1=$_GET['p1'];
		$query = "update permit set ispermit=-ispermit where email='$p1'";
		$result = mysqli_query($conn, $query);
		$affectedRows = mysqli_affected_rows($conn);
  if($affectedRows == 1){
  	
  	 echo '<script type="text/javascript">window.location.href = "Add_to_home.php";</script>';
  }

else{
	
}
	}
	else
	{
		echo 'db not connected';
	}
	$conn->close();
?>