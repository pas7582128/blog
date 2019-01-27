<?php


$servername = "localhost";
$username = "root";
$password = "";
$database = "ass5_3rdyear";

$con = mysqli_connect($servername, $username, $password);
mysqli_select_db($con,$database);

$postDetails = array();

$search_key = $_GET['term'];
//$search_key="a";
//get rows query
$query = "SELECT * FROM bloggers where name like '%$search_key%'";
$result = mysqli_query($con, $query);

//number of rows
$rowCount = mysqli_num_rows($result);

if($rowCount > 0){
    while($row = mysqli_fetch_assoc($result)){
			$postDetails[] = ucfirst($row['name']);
	}
}
//echo "hhhhhhhhhhhhhhh";
echo json_encode($postDetails);
?>