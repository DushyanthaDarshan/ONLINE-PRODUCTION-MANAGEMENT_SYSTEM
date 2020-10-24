<?php
	if(isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location:login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Green Products</title>
	<link rel="stylesheet" href="header.css" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<header>
		<div id="navbar">
			<div id="logo">
				<img src="logo.jpeg" alt="logo" width="250" height="200"  id="logoHeader">
			</div>
			<div id="navbar-right">
				<a href="#" class="fa fa-facebook"></a>
				<a href="#" class="fa fa-google"></a>
				<a href="#" class="fa fa-linkedin"></a>
				<a href="#" class="fa fa-youtube"></a>
				<a href="#" class="fa fa-pinterest"></a>
				<a href="#" class="fa fa-skype"></a>
				<br><br><br><br>
				<div>
				<form action="header.php" method="post" id="menuBtn">
					<a href="home.php" id="hom">HOME</a>
					
					<?php if (isset($_SESSION['username'])) : ?>
						<a href="products.php" id="pro">PRODUCTS</a>
					<?php endif ?>

					<?php if (isset($_SESSION['username'])) : ?>
						<a href="suppliers.php" id="sup">SUPPLIERS</a>
					<?php endif ?>

					<?php if (isset($_SESSION['username'])) : ?>
						<a href="aboutUs.php" id="abo">ABOUT US</a>
					<?php endif ?>

					<?php if (isset($_SESSION['username'])) : ?>
						<a href="contactUs.php" id="con">CONTACT US</a>
					<?php endif ?>

					<?php if (isset($_SESSION['username'])) : ?>
						<a href="help.php" id="hel">HELP</a>
					<?php endif ?>
          			
					<?php if (isset($_SESSION['type'])) : ?>
						<?php if ($_SESSION['type'] == "ADMIN") : ?>
							<a href="admin.php" style="font-size: 20px; color: #64FAF7;" id="adm" class="adus"><?php echo $_SESSION['type']; ?></a>
						<?php else : ?>
							<a href="user.php" style="font-size: 20px; color: #64FAF7;" id="usr" class="adus"><?php echo $_SESSION['type']; ?></a>
						<?php endif ?>
						
					<?php endif ?>

					<?php if (isset($_SESSION['username'])) : ?>
						<a href="logout.php?logout='1'" name="logout" class="logout" style="margin-right: 15px;">LOGOUT</a>
					<?php else: ?>
						<a href="signup.php" name="logout" class="logout" style="margin-right: 15px;">SIGNUP</a>
					<?php endif ?>

					<div><br/>
					<?php if (isset($_SESSION['username'])) : ?>
						<p style="text-align: right; font-size: 24px; margin-right: 15px; color: #FFFFFF;">Hi <strong>
							<?php echo $_SESSION['username']; ?></strong></p>
					<?php endif ?>
					</div>
				</form></div>
			</div>
		</div>
	</header>
</body>
</html>