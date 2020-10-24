<?php
	session_start();
	include_once('header.php');
	include("dbConn.php");
?>

<html>
<head>
<title>About Us</title>
<script>
		document.getElementById("abo").classList.add("active");
</script>
<style>
.cont2 p{
	font-size:25px;
	font-family:Comic Sans MS, cursive, sans-serif;
	text-align: justify;
	color:#2F4F4F;
}



</style>
</head>

<body>
<?php if (isset($_SESSION['username'])) : ?>
	<div class="cont2" style="width:95%; margin-left:19px; margin-top: 230px;">
	<font color="#00008B" size="7px" face="Rockwell"><b>About Us</b></font>

	<br><br>
	<table border="0" cellspacing="15px">
	<tr>
	<td valign="top">
	<p>
	<b><i>Green Garden Food Products</i></b> is a company that produces jam, fruit juice, sauce, chuttney & biscuits in Sri Lanka. Its becoming one of the most trusted and respected brands in Sri lanka. We serve you the best quality products. 
	</p>
	<p>
	<b><i>Green Garden Food Products</i></b> were established in 2013 in small scale by producing only jam & fruit juice by manufacturing them with freshly harvested fruits.

	In time the company was developed and started to produce diferrent kind of products in larger scale.
	</p>
	</td>
	<td><img src="./imgs/sauce.jpg" width="450px" border="0" style="box-shadow: 5px 5px 5px grey;"> </td></tr>



	</table>
	<br>
	<p>
	We serve you the best products using advanced machinery and uses advanceed technology.
	We have over 1000 dedicated employees and highly professional management team who are dedicated to serve the best quality products to our valuable customers.
	</p>

	<table align="center" cellspacing="50">
		<tr>
			<td><img src="./imgs/juice.jpg" width="400px" style="box-shadow: 5px 4px 5px grey;"></td>
			<td><img src="./imgs/bis.jpg" width="400px" height="270px" style="box-shadow: 5px 4px 5px grey;"></td>
			<td><img src="./imgs/jam.jpg" width="400px" height="270px" style="box-shadow: 5px 4px 5px grey;"></td>
		
		</tr>

	</table>
	<p>
	Our main goal is to export our products within two years with a world famouse brand and a company name as a production and manufacturing company.
	</p>

	</div>
<?php endif ?>
</body>

</html>