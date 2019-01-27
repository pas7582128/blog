<html>
<head><script src="js/jquery.js"></script></head>
</html>
<?php
	session_start();
	$name=$_POST['name'];
	$bdate=$_POST['bdate'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$country=$_POST['country'];
	$flag=1;
	include_once ('lib/smtp_validateEmail.class.php');
	$SMTP_Validator = new SMTP_validateEmail();
	$SMTP_Validator->debug = true;
	if(!preg_match('/^[0-9]{10}+$/', $mobile)){
		echo '<script type="text/javascript">alert("Mobile number is not valid");window.location.href="signup_blogger.php";</script>';
		$flag=0;
	}
	if ($email != "") {
	//echo $email;
	$results = $SMTP_Validator->validate((array($email)));
	if(preg_match('/^[a-z0-9\.\-_\+]+@[a-z0-9\-_]+\.([a-z0-9\-_]+\.)*?[a-z]+$/is', $email)) echo "Valid2";
	else{
	 echo "invalid2";
	 echo '<script type="text/javascript">alert("Email address is not valid");window.location.href="signup_blogger.php";</script>';
	}
	// if ($results[$email]) {
	// 	echo "valid";
	// } else {
	// 	echo "invalid";
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
			echo '<script type="text/javascript">alert("Registered succesfully");window.location.href="login_blogger.php";</script>';
			$zero=0;
		$sql="INSERT into bloggers values ('$name','$bdate','$mobile','$email','$pass','$city','$state','$country','$zero')";
		$sql2="INSERT into permit (email,ispermit) values ('$email',1)";
	       	if($conn->query($sql)===true && $conn->query($sql2)===true){
				echo 'Registered succesfully';

			}
			else{
				echo mysqli_error($conn);
			}
		}
		else{
			session_unset(); 
			session_destroy();
		}
	}
	else
	{
		echo 'db not connected';
	}
	$conn->close();
?>