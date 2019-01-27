<html>
<head>
	<link rel="stylesheet" type="text/css" href="CSS/a.css">
</head>
	<div class="heading"><h2>Bloggers.com</h2><span style="color:white;"><?php 
		session_start();
		if(isset($_SESSION['email']))
			echo "Logged in as ".$_SESSION['email'];
		else{
	
	}
	?></span></div> 
	<?php
	echo  '<ul><li><a id="onlink" href="home.php">Home</a></li>';
	if(!isset($_SESSION['email']))
		echo '<li id="a1"><a href="login_blogger.php">Login</a></li><li id="a1"><a href="signup_blogger.php">Sign up</a></li>';
	if(isset($_SESSION['email']))
		echo '<li id="a1"><a href="Add_blog.php">Add blog</a></li><li id="a1"><a href="Add_admin.php">Add admin</a></li><li id="a1"><a href="Add_blog.php">Addtohome</a></li><li id="a1"><a href="myblogs.php">My blogs</a></li><li id="a1"><a href="myprofile.php">My profile</a></li><li id="a1"><a href="logout.php">Log out</a></li>';
	echo '</ul>';
	?>
	<br><br><br><br><br>
</html>