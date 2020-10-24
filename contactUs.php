<?php
  session_start();
  include_once('header.php');
  include('db.php');
?>

<!DOCTYPE html>
<html>
<head>
<title>Contact Us</title>
<script>
	document.getElementById("con").classList.add("active");
</script>

<style>

body {
  background: url(imgs/img1.jpeg) no-repeat center fixed; 
  background-size: cover;
}

input[type=text], textarea, select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: orange;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #FF8C00;
}

.block {
  border-radius: 20px;
  background-color: #00CED1;
  padding: 20px;
  border: 1px solid black;
  margin-top: 240px;
  margin-right: 480px;
  margin-left:  500px;
  height: auto;
}

</style>
</head>
<body>
<?php if (isset($_SESSION['username'])) : ?>
  <div class="block">

  <form method="post" action="contactUs.php">
  <H2>Thank you for visiting us Today!</H2>
  <P> Please provide your feedback below: </P>


  <LABEL>How do you rate your overall experience?</LABEL> 
                                  
  <P><LABEL><INPUT name="experience" id="experience" type="radio" value="verygood"> Very Good </LABEL> 
              
  <LABEL><INPUT name="experience" id="experience" type="radio" value="good"> Good </LABEL>                                     
  <LABEL><INPUT name="experience" id="experience" type="radio" value="average"> Average </LABEL>  
  <LABEL><INPUT name="experience" id="experience" type="radio" value="bad"> Bad </LABEL>  
  </P>    
                            

  <label for="comments">Comments:</label>

  <textarea id="comments" name="comments" placeholder="Write something..." style="height:100px"></textarea>
  <p></p>
      <input type="submit" name="submit" value="Submit">

  </form>
  </div>

  <?php

  if(isset($_POST['submit'])) {

    $successes = array();

    $comments = mysqli_real_escape_string($db, $_POST['comments']);
    $experience = mysqli_real_escape_string($db, $_POST['experience']);

    $userName = $_SESSION['username'];

    //get user Id
    $get_user_id_query = "SELECT * FROM user WHERE USERNAME='$userName' ";
    $userIdExcute = mysqli_query($db, $get_user_id_query);
    $userIdArray = mysqli_fetch_assoc($userIdExcute);
    $userId = $userIdArray['USER_ID'];
    
    $query1 = "INSERT INTO comments (COMMENT_NAME, USER_ID, EXPERIENCE) VALUES ('$comments', '$userId', '$experience')";
    if(mysqli_query($db, $query1)) {
      array_push($successes, "Successfully Submitted");
    }
  }
  ?>
<?php endif ?>
</body>
</html>