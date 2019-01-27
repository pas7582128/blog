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
	echo  '<ul><li><a href="home.php">Home</a></li>';
	if(!isset($_SESSION['email']))
		echo '<li id="a1"><a href="login_blogger.php">Login</a></li><li id="a1"><a href="signup_blogger.php">Sign up</a></li>';
	if(isset($_SESSION['email']))
		echo '<li id="a1"><a href="Add_blog.php">Add blog</a></li>';
	if(isset($_SESSION['admin'])&& $_SESSION['admin']==1)
		echo '<li id="a1"><a href="Add_admin.php">Add admin</a></li><li id="a1"><a href="Add_to_home.php">Addtohome</a></li>';
	if(isset($_SESSION['email'])){
  echo '<li id="a1"><a href="myblogs.php" >My blogs</a></li><li id="a1"><a href="myprofile.php">My profile</a></li>';
    if(isset($_SESSION['admin'])&& $_SESSION['admin']==1){
      echo '<li id="a1"><a href="mysuggestions.php">Suggestions</a></li>';
    }
  echo '<li id="a1"><a href="logout.php">Log out</a></li>';
  }
  if(!(isset($_SESSION['admin']) && $_SESSION['admin']==1) && (isset($_SESSION['email']))){
    echo '<li id="a1"><a href="contact_us.php">Contact us</a></li>';
  }
	echo '<li id="a1"><form autocomplete="off" action="res_search_page.php" method="post"><div class="autocomplete" style="width:200px;"><input id="autocomplete" type="text" name="mySearch" placeholder="Search ..."></div><input type="submit" id="a11"></form></li>';
	echo '</ul><br><br><br><br><br>';
	?>
	

	<?php
		$servername="localhost";
		$username="root";
		$password="";

		//create connection
		$conn=new mysqli($servername,$username,$password);

		if($conn->connect_error){
			die("Connection failed".$conn->connect_error);
		}


		$db=mysqli_select_db($conn,'ass5_3rdyear');

		$query = "SELECT * FROM bloggers";
$result = mysqli_query($conn, $query);

//number of rows
$rowCount = mysqli_num_rows($result);

if($rowCount > 0){
    while($row = mysqli_fetch_assoc($result)){
			$postDetails[] = ucfirst($row['name']);
	}
}


$query = "SELECT * FROM admins";
$result = mysqli_query($conn, $query);

//number of rows
$rowCount = mysqli_num_rows($result);

if($rowCount > 0){
    while($row = mysqli_fetch_assoc($result)){
			$postDetails[] = ucfirst($row['name']);
	}
}
$query = "SELECT * FROM add_blog";
$result = mysqli_query($conn, $query);

//number of rows
$rowCount = mysqli_num_rows($result);

if($rowCount > 0){
    while($row = mysqli_fetch_assoc($result)){
      $postDetails[] = ucfirst($row['title']);
  }
}

		$p21=$_GET['p2'];
    //echo $p21;
		echo "<div style=\"overflow: auto;\"><fieldset class=\"inner\">";
		if($db){
			$idx=$_SESSION['email'];
			$s="select * from bloggers where email='$p21'";
			$res=$conn->query($s);
      //echo $res;
			if($res->num_rows > 0){
				while($row = $res->fetch_assoc()){
					echo "<span class=\"mp1\">Name:</span><span class=\"mp2\">".$row["name"]."</span><br><br>";	
					$tmp=date("d/m/Y", strtotime($row["bdate"]));
					echo "<span class=\"mp1\">Birth date:</span><span class=\"mp2\">".$tmp."</span><br><br>";	
					echo "<span class=\"mp1\">Mobile:</span><span class=\"mp2\">".$row["mobile"]."</span><br><br>";	
					echo "<span class=\"mp1\">Email:</span><span class=\"mp2\">".$row["email"]."</span><br><br>";	
					echo "<span class=\"mp1\">City:</span><span class=\"mp2\">".$row["city"]."</span><br><br>";	
					echo "<span class=\"mp1\">State:</span><span class=\"mp2\">".$row["state"]."</span><br><br>";	
					echo "<span class=\"mp1\">Country:</span><span class=\"mp2\">".$row["country"]."</span><br><br>";	
					echo "<span class=\"mp1\">No of blogs:</span><span class=\"mp2\">".$row["noofblogs"]."</span><br><br>";	
				}	 
			}
			$s="select * from admins where email='$p21'";
			$res=$conn->query($s);

			if($res->num_rows > 0){
				while($row = $res->fetch_assoc()){
					echo "<span class=\"mp1\">Name:</span><span class=\"mp2\">".$row["name"]."</span><br><br>";	
					$tmp=date("d/m/Y", strtotime($row["bdate"]));
					echo "<span class=\"mp1\">Birth date:</span><span class=\"mp2\">".$tmp."</span><br><br>";	
					echo "<span class=\"mp1\">Mobile:</span><span class=\"mp2\">".$row["mobile"]."</span><br><br>";	
					echo "<span class=\"mp1\">Email:</span><span class=\"mp2\">".$row["email"]."</span><br><br>";	
					echo "<span class=\"mp1\">City:</span><span class=\"mp2\">".$row["city"]."</span><br><br>";	
					echo "<span class=\"mp1\">State:</span><span class=\"mp2\">".$row["state"]."</span><br><br>";	
					echo "<span class=\"mp1\">Country:</span><span class=\"mp2\">".$row["country"]."</span><br><br>";	
					echo "<span class=\"mp1\">No of blogs:</span><span class=\"mp2\">".$row["noofblogs"]."</span><br><br>";	
				}	 
			}
			//else{
			//	echo '<h1>You have not yet updated any blog.</h1>';
			//}
		}
		else
		{
			echo 'db not connected';
		}
		echo "</fieldset></div>";
		$conn->close();
	?>
	<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}
var temp=<?php echo json_encode($postDetails); ?>;

autocomplete(document.getElementById("autocomplete"),temp );

</script>
</html>