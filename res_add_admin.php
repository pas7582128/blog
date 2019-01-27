<html>
<head>
	<link rel="stylesheet" type="text/css" href="CSS/a.css">
</head>
	<div class="heading"><h2>Bloggers.com</h2><span style="color:white;"><?php 
		session_start();
		if(isset($_SESSION['email']))
			echo "Logged in as ".$_SESSION['email'];
		else{
	
	}?></div>
	<?php
	echo  '<ul><li><a href="home.php">Home</a></li>';
	if(!isset($_SESSION['email']))
		echo '<li id="a1"><a href="login_blogger.php">Login</a></li><li id="a1"><a href="signup_blogger.php">Sign up</a></li>';
	if(isset($_SESSION['email']))
		echo '<li id="a1"><a href="Add_blog.php">Add blog</a></li>';
	if(isset($_SESSION['admin']))
		echo '<li id="a1"><a href="Add_admin.php">Add admin</a></li><li id="a1"><a href="Add_to_home.php">Addtohome</a></li>';
	if(isset($_SESSION['email']))
	echo '<li id="a1"><a href="myblogs.php">My blogs</a></li><li id="a1"><a href="myprofile.php">My profile</a></li><li id="a1"><a href="logout.php">Log out</a></li>
	</ul>
	<br><br><br><br><br>';

	$name=$_POST['name'];
	$bdate=$_POST['bdate'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$country=$_POST['country'];
	$flag=1;
	// include_once ('lib/smtp_validateEmail.class.php');
	// $SMTP_Validator = new SMTP_validateEmail();

	if(!preg_match('/^[0-9]{10}+$/', $mobile)){
		echo '<script type="text/javascript">alert("Mobile number is not valid");window.location.href="signup_blogger.php";</script>';
		$flag=0;
	}
	if ($email != "") {
	
	//$results = $SMTP_Validator->validate(array($email));
	// if ($results[$email]) {
	// 	//echo "valid";
	// } else {
	// 	//echo "invalid";
	// 	//echo '<script type="text/javascript">alert("Email address is not valid");window.location.href="signup_blogger.php";</script>';
	// 	$flag=0;
	// }
	}


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
		$s="select * from bloggers where mobile='$mobile'";
		$res=$conn->query($s);
		if($res->num_rows > 0){
			echo '<script type="text/javascript">alert("Already used mobile number");window.location.href="signup_blogger.php";</script>';$flag=0;
		}
		$s="select * from bloggers where email='$email'";
		$res=$conn->query($s);
		if($res->num_rows > 0){
			echo '<script type="text/javascript">alert("Already used email");window.location.href="signup_blogger.php";</script>';$flag=0;
		}

		$s2="select * from admins where mobile='mobile'";
		$res2=$conn->query($s2);
		if($res2->num_rows > 0){
			echo '<script type="text/javascript">alert("Already used mobile number");window.location.href="signup_blogger.php";</script>';$flag=0;
		}
		$s2="select * from admins where email='$email'";
		$res2=$conn->query($s2);
		if($res2->num_rows > 0){
			echo '<script type="text/javascript">alert("Already used email");window.location.href="signup_blogger.php";</script>';$flag=0;
		}
		if($flag==1){
			//$_SESSION['email']=$email;
			//header("location: login_blogger.php");
			echo '<script type="text/javascript">alert("Registered succesfully");window.location.href="Add_admin.php";</script>';
			$zero=0;
		$sql="INSERT into admins values ('$name','$bdate','$email','$pass','$mobile','$city','$state','$country','$zero')";
	       	if($conn->query($sql)===true){
				echo 'Registered succesfully';
			}
			else{
				echo mysqli_error($conn);
			}
		}
		else{
			//session_unset(); 
			//session_destroy();
		}
	}
	else
	{
		echo 'db not connected';
	}
	$conn->close();
	?>
</html>