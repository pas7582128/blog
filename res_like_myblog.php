
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ass5_3rdyear";
session_start();

$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn,$database);

if($_SESSION['email']){
	$blogname=$_GET['pl'];
	$email2=$_GET['p2'];
	//echo $blogname."<br>";
	//echo $email2."<br>";
	$email1=$_SESSION['email'];

	// $sql3="select * from likes where email1='$email1' and bname='$blogname'";
	// $rs3=mysqli_query($conn, $sql3);
	// $affectedRows3 = mysqli_affected_rows($conn);
	// if($affectedRows3 == 1){
	// 	//echo "hhh";
 //  	 	echo '<script type="text/javascript">window.location.href = "home.php";</script>';
 //  	}
 //  	else{
  		$sql="update likes set islike=-islike where email1='$email1' and email2='$email2' and bname='$blogname'";
		//echo $sql."<br>";

		

		$rs = mysqli_query($conn, $sql);
		$affectedRows = mysqli_affected_rows($conn);
		//echo $affectedRows."<br>";
		if($affectedRows == 1){
			$sql2="select * from likes where email1='$email1' and email2='$email2' and bname='$blogname'";
			$rs2=mysqli_query($conn, $sql2);
			//echo $rs2;
			while($row = mysqli_fetch_assoc($rs2)){
				$or=- $row['islike'];
				if($or==1){
					$sql3="update add_blog set likes=likes-1,dislikes=dislikes+1 where title='$blogname'";
					$rs3=mysqli_query($conn, $sql3);
					echo "1".$rs3;

					
				}
				else if($or==-1){
					$sql3="update add_blog set likes=likes+1,dislikes=dislikes-1 where title='$blogname'";
					$rs3=mysqli_query($conn, $sql3);
					echo "2".$rs3;

					
				}
			}

	  	 echo '<script type="text/javascript">window.location.href = "myblogs.php";</script>';

	  	}
	  	else{
	  		$zero=1;
			$sql="insert into likes (email1,email2,bname,islike) values ('$email1','$email2','$blogname','$zero')";
		 	$rs = mysqli_query($conn, $sql);
  			$affectedRows = mysqli_affected_rows($conn);
 	 		if($affectedRows == 1){
 	 			
			$sql2="select * from likes where email1='$email1' and email2='$email2' and bname='$blogname'";
			$rs2=mysqli_query($conn, $sql2);
			//echo $rs2;
			while($row = mysqli_fetch_assoc($rs2)){
				$or=- $row['islike'];
				// if($or==1){
				// 	$sql3="update add_blog set likes=likes-1,dislikes=dislikes+1 where title='$blogname'";
				// 	$rs3=mysqli_query($conn, $sql3);
				// 	echo "3".$rs3;
				// }
				// else if($or==-1){
					$sql3="update add_blog set likes=likes+1 where title='$blogname'";
					$rs3=mysqli_query($conn, $sql3);
					echo "4".$rs3;


					break;
				//}
			}

	  	 echo '<script type="text/javascript">window.location.href = "myblogs.php";</script>';

	  	
  			 //echo '<script type="text/javascript">window.location.href = "home.php";</script>';
  			}
  			else{
  				echo "Error in inserting new record<br>";
  			}
		}
  	//}


	



	
}
else{
	
}
?>
