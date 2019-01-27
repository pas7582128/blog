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
		$sender=$_SESSION['email'];
		$subject=$_POST['subject'];
		$content=$_POST['content'];


		$query = "insert into suggestion (sender,subject,content,date) values ('$sender','$subject','$content',current_timestamp)";
		$result = mysqli_query($conn, $query);
		$affectedRows = mysqli_affected_rows($conn);
  if($affectedRows == 1){
  	 echo '<script type="text/javascript">window.location.href = "home.php";</script>';
  }

else{
	
}
?>