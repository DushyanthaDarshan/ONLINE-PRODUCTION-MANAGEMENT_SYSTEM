<?php 
	include('db.php');

	if(isset($_POST['notUser'])) {
		session_destroy();
		unset($_SESSION['username']);
		unset($_SESSION['type']);
		header("location:home.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="login.css">
	<title>Login Page</title>

</head>
<body>
	<div class="signin">
	 	<div class="form">
  			<form method="post" action="login.php">
  				<p style="font-size: 30px; text-align: center;"><strong>Welcome</strong></p>
				<img src="logo.jpeg" alt="logo" height="200px" width="350px" style="margin-left: 50px; border-radius: 100px;">
				<p style="font-size: 20px; text-align: center;"><strong>Log Here</strong></p>
  				<div>
  					<input type="text" name="username" placeholder="Username">
  				</div>
  				<div >
  					<input type="password" name="password" placeholder="Password">
				</div>
					<br/>
				<?php include('errors.php'); ?>
				<br/>
  				<div>
	  				<input type="submit" name="logbtn" value="LogIn">
				</div>

				<hr color=#FFFFFF size=2.5 width='100%' align=left />   

				<div id="sen">
					<a href="signup.php"><strong>Sign Up</strong></a>
					<br/>
					<br/>
					<input type="submit" style="line-height: 20px; background: none; color: #FFFFFF;" name="notUser" value="Continue Without Login">
				</div> 
  			</form>
		</div>
	</div>
</body>
</html>