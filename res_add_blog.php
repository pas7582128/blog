<?php
	session_start();
	$title=$_POST['title'];
	$content=$_POST['content'];

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
		$blank=$_SESSION['email'];
		$date = date('Y-m-d H:i:s');
		$zero=0;
		$sql="INSERT into add_blog values ('$blank','$title','$content','$date','$zero','$zero')";
		$sql2="update bloggers set noofblogs=noofblogs+1 where email='$blank'";
		$sql3="update admins set noofblogs=noofblogs+1 where email='$blank'";
	       	if($conn->query($sql)===true && ($conn->query($sql2)==true && $conn->query($sql3)==true)){
				header("location: myblogs.php");
			}
			else{
				echo mysqli_error($conn);
			}
	}
	else
	{
		echo 'db not connected';
	}
	$conn->close();
?>