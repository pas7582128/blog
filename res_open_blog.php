<html>
<head>
  <link rel="stylesheet" type="text/css" href="CSS/a.css">
  
  <script type="text/javascript" src="script5.js"></script>
  
  <link rel="stylesheet" href="CSS/star.css">
  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> <!-- CSS Link -->
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> <!-- JS Link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="jquery.js" type="text/javascript"></script>

</head>
  <div class="heading"><h2>Bloggers.com</h2><span style="color:white;"><?php 
    session_start();
    if(isset($_SESSION['email']))
      echo "Logged in as ".$_SESSION['email'];
    else{
  
  }
  ?></span></div> 
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <?php
  echo  '<ul><li><a href="home.php">Home</a></li>';
  if(!isset($_SESSION['email']))
    echo '<li id="a1"><a href="login_blogger.php">Login</a></li><li id="a1"><a href="signup_blogger.php">Sign up</a></li>';
  if(isset($_SESSION['email']))
    echo '<li id="a1"><a href="Add_blog.php">Add blog</a></li>';
  if(isset($_SESSION['admin']) && $_SESSION['admin']==1)
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
  $servername="localhost";
  $username="root";
  $password="";

  //create connection
  $conn=new mysqli($servername,$username,$password);

  if($conn->connect_error){
    die("Connection failed".$conn->connect_error);
  }


  $db=mysqli_select_db($conn,'ass5_3rdyear');
  $p1=$_GET['pl'];
  echo "<div style=\"overflow: auto;\"><fieldset class=\"inner\">";
  if($db){
    if(isset($_SESSION['email']))
    $idx=$_SESSION['email'];
    $s="select * from add_blog where title='$p1'";
    $res=$conn->query($s);
    $cnt=10;
    $idxx=0;
    if($res->num_rows > 0 && $cnt>0) {
      while($row = $res->fetch_assoc()){
        if($cnt<=0) {
          break;
        }
        $tempt=$row["title"];
        $tempe=$row["email"];
        $cnt--;
        $idxx++;
        echo "<div class=\"column\">";
        //echo $row["title"];
        echo "<span class=\"d1\"><a class=\"open_profile\" href=\"res_open_blog.php?pl=".$tempt."&p2=".$tempe."\" method=\"post\">".$row["title"]."</a> written by</span><span ><a class=\"open_profile emaildis\" href=\"res_open_profile.php?pl=".$tempt."&p2=".$tempe."\" method=\"post\"> ".$row['email']."</a></span><br><br>";
        //echo "<span class=\"d2\">By".str_repeat("&nbsp;", 1) .$row["email"]."</span><br><br>";
        $tmp=date("d/m/Y", strtotime($row["date"]));
        echo $tmp."<br>";

        //echo "<div class=\"item\">";
        echo "<span class=\"d3\">"."<div class=\"item\">".$row["content"]."</div>"."</span><br><br><br><br>";

        $e1=$_SESSION['email'];
        $e2=$row['email'];
        $b1=$row['title'];
        $s4="select * from likes where email1='$e1' and email2='$e2' and bname='$b1'";
        $res4=$conn->query($s4);
        if($res4->num_rows>0){
          while($row = $res4->fetch_assoc()){
            if($row['islike']=='1'){
              echo '<a href="res_like.php?pl='.$tempt.'&p2='.$tempe.'" method="post"><div ><i onclick="myFunction'.$idxx.'(this)" class="fa fa-thumbs-up2" id="changed'.$idxx.'"></i></div></a>';
                $s5="select * from add_blog where title='$b1'";
                $res5=$conn->query($s5);
                if($res5->num_rows>0){
                  while($row = $res5->fetch_assoc()){
                  echo "<span class=\"d3\">";
                  echo "likes:  ".$row['likes'];
                  echo "  dislikes:  ".$row['dislikes'];
                  echo "</span";
                  echo "<br>";
                  }
                }
            }
            else if($row['islike']=='-1'){
              echo '<a href="res_like.php?pl='.$tempt.'&p2='.$tempe.'" method="post"><div ><i onclick="myFunction'.$idxx.'(this)" class="fa fa-thumbs-down2" id="changed'.$idxx.'"></i></div></a>';
              $s5="select * from add_blog where title='$b1'";
                $res5=$conn->query($s5);
                if($res5->num_rows>0){
                  while($row = $res5->fetch_assoc()){
                    echo "<span class=\"d3\">";
                  echo "likes:  ".$row['likes'];
                  echo "  dislikes:  ".$row['dislikes'];
                  echo "</span";
                  echo "<br>";
                  }
                }
            }
          }
        }
        else{
          echo '<a href="res_like.php?pl='.$tempt.'&p2='.$tempe.'" method="post"><div ><i onclick="myFunction'.$idxx.'(this)" class="fa fa-thumbs-up" id="change'.$idxx.'"></i></div></a>';

          $s5="select * from add_blog where title='$b1'";
          $res5=$conn->query($s5);
          if($res5->num_rows>0){
            while($row = $res5->fetch_assoc()){
            echo "<span class=\"d3\">";
                  echo "likes:  ".$row['likes'];
                  echo "  dislikes:  ".$row['dislikes'];
                  echo "</span";
                  echo "<br>";
            }
          }
          //echo "likes";
          //echo "dislikes";

        }

        echo '<div class="item2"><i class="fa fa-comments-o" style="font-size:24px"></i><B style="font-size:24px;color:black;text-decoration:underline;">Comments</B><br><table id="t1">';

        
        $resu = mysqli_query($conn,"select * from comment where title='$tempt' order by email");

        if(mysqli_num_rows($resu) > 0){
        while($row = mysqli_fetch_assoc($resu)){
          echo '<tr><td><div style="padding-left:45px;width:100%;"><i class="fa fa-user"></i>';
          echo 'Written by '.$row['email'].'<br><b>'.$row['ctitle'].'<br></b>'.$row['ccontent'].'<br><br>';
          echo '</div></td><td><div style="padding-left: 20px;">';
          echo date('jS M Y', strtotime($row['cdate']));
          echo '</div></td></tr>';

        }
      }
      else{
        echo "No comments till now<br>";
      }

        echo '</table></div>';
        ?>


        <div><input type="button" value="Write a comment"  class="danbutton btn btn-danger" id="myBtn1" onclick="document.getElementById('idm<?php echo $idxx?>').style.display='block'" /></div>
<br><br>
<div id="idm<?php echo $idxx?>" class="modalm">
  
  <form class="modalm-content animate" action="res_comments.php?pl=<?php echo $tempt ?>" method="post" style = "width:55%; height:61%">
   

    <div class="containe">
      <div class="mid">
  <h1>Your review of <?php echo $tempt;?></h1>
      <hr>
       <span id="s1"><label><b>Title of your comment</b></label></span>
      <input type="text" name="title" required style = "width:40% ; margin: 10px 0px;"><br>

       <span id="s2"><label><b>Your comment</b></label></span>
      
      <textarea  name="rev" maxlength="1000" cols="40" rows="5" required  style = "width:40% ; margin: 10px 0px;"></textarea>
      <br>
        
      
      </div>
    </div>

    
    <div>
      <div class="mid">
       <button type="submit" class="btn btn-danger" value="submit">Submit comment</button>
        <button type="button" onclick="document.getElementById('idm<?php echo $idxx?>').style.display='none'" class="btn btn-danger">Cancel</button>
</div>
      </div>
    
  </form>
</div>


        <?php
        echo "</div>";
      }  
    }
    else{
      echo '<h1>You have not yet updated any blog.</h1>';
    }
  }
  else
  {
    echo 'db not connected';
  }
  echo "</fieldset></div>";
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

//echo "hhhhhhhhhhhhhhh";
//echo json_encode($postDetails);
  $conn->close();
  ?>
  
  <script type="text/javascript">
    $(function(){ /* to make sure the script runs after page load */

  $('.item').each(function(event){ /* select all divs with the item class */
  
    var max_length = 135; /* set the max content length before a read more link will be added */
    
    if($(this).html().length > max_length){ /* check for content length */
      
      var short_content   = $(this).html().substr(0,max_length); /* split the content in two parts */
      var long_content  = $(this).html().substr(max_length);
      
      $(this).html(short_content+
             '<a href="#" class="read_more"><br/>Read More</a>'+
             '<span class="more_text" style="display:none;">'+long_content+'</span>'); /* Alter the html to allow the read more functionality */
             
      $(this).find('a.read_more').click(function(event){ /* find the a.read_more element within the new html and bind the following code to it */
 
        event.preventDefault(); /* prevent the a from changing the url */
        $(this).hide(); /* hide the read more button */
        $(this).parents('.item').find('.more_text').show(); /* show the .more_text span */
     
      });
      
    }
    
  });
 
 
});


  </script>

  <script type="text/javascript">
    $(function(){ /* to make sure the script runs after page load */

  $('.item2').each(function(event){ /* select all divs with the item class */
  
    var max_length = 0; /* set the max content length before a read more link will be added */
    
    if($(this).html().length > max_length){ /* check for content length */
      
      var short_content   = $(this).html().substr(0,max_length); /* split the content in two parts */
      var long_content  = $(this).html().substr(max_length);
      
      $(this).html(short_content+
             '<a href="#" class="read_more2" style="font-size:24px;"><br/>Comments</a>'+
             '<span class="more_text" style="display:none;">'+long_content+'</span>'); /* Alter the html to allow the read more functionality */
             
      $(this).find('a.read_more2').click(function(event){ /* find the a.read_more element within the new html and bind the following code to it */
 
        event.preventDefault(); /* prevent the a from changing the url */
        $(this).hide(); /* hide the read more button */
        $(this).parents('.item2').find('.more_text').show(); /* show the .more_text span */
     
      });
      
    }
    
  });
 
 
});


  </script>

  <!-- Script for autocomplete funtion -->
<!-- <script>
 
$(document).ready(function(e){
 
  $("#autocomplete").autocomplete({
    
    source:'res_home.php'
  });
 
});
</script> -->
<script>
function myFunction1(x) {
    x.classList.toggle("fa-thumbs-down");

    document.getElementById("change1").style.color = "red";
    //document.getElementById('change').onclick = changeColor;   

    // function changeColor() {
    //  //if(document.body.style.color!=purple)
    //      document.body.style.color = "purple";
    //     //else 
    //     // document.body.style.color = "black";
    //     return false;
    // }   
}
function myFunction2(x) {
    x.classList.toggle("fa-thumbs-down");
    document.getElementById("change2").style.color = "red";
}
function myFunction3(x) {
    x.classList.toggle("fa-thumbs-down");
    document.getElementById("change3").style.color = "red";
}
function myFunction4(x) {
    x.classList.toggle("fa-thumbs-down");
    document.getElementById("change4").style.color = "red";
}
function myFunction5(x) {
    x.classList.toggle("fa-thumbs-down");
    document.getElementById("change5").style.color = "red";
}
function myFunction6(x) {
    x.classList.toggle("fa-thumbs-down");
    document.getElementById("change6").style.color = "red";
}
function myFunction7(x) {
    x.classList.toggle("fa-thumbs-down");
    document.getElementById("change7").style.color = "red";
}
function myFunction8(x) {
    x.classList.toggle("fa-thumbs-down");
    document.getElementById("change8").style.color = "red";
}
function myFunction9(x) {
    x.classList.toggle("fa-thumbs-down");
    document.getElementById("change9").style.color = "red";
}
function myFunction10(x) {
    x.classList.toggle("fa-thumbs-down");
    document.getElementById("change10").style.color = "red";
}
</script>

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