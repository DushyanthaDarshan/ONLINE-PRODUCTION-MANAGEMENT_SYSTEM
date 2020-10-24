<?php
	session_start();
	include_once('header.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<link rel="stylesheet" href="production.css" type="text/css" />
	<style>
	table td img{
	transition: transform .7s;
	}
	
	table td:hover img{
		transform: scale(1.1);
	}

</style>
	<script>
		document.getElementById("pro").classList.add("active");
	</script>
</head>
<body>
<?php if (isset($_SESSION['username'])) : ?>
	<p>Hello home</p>

	<div class="category_container">

	<center><h1 style="font-family:Rockwell; font-size:50px;color:#800080;">PRODUCT CATEGORIES</h1></center>
	<center><p style="font-family:Rockwell; font-size:30px;color:#DA70D6; margin-top:-30px;">Eat Green. Be Healthy.</p></center><br/>
	
	<table align="center" cellspacing="33">
		<tr>
			<td><a href="jam.php"><img src="./imgs/Jam/table_jam.jpg" alt="jam" width="300" height="400"></a></td>
			<td><a href="fruit_juice.php"><img src="./imgs/Juice/table_juice.jpg" alt="juice" width="300" height="400"></a></td>
			<td><a href="sauce.php"><img src="./imgs/Sauce/table_sauce.jpg" alt="sauce" width="300" height="400"></a></td>
			
		</tr>
		
	

	</table>
	
	<table align="center" cellspacing="33">
		<tr>
			<td><a href="chuttney.php"><img src="./imgs/Chuttney/table_chutney.jpg" alt="chutney" width="300" height="400"></a></td>
			<td><a href="biscuit.php"><img src="./imgs/Biscuits/table_biscuit.jpg" alt="biscuit" width="300" height="400"></a></td>
			
			
		</tr>

	</table>
</div>
<?php endif ?>
</body>
</html>