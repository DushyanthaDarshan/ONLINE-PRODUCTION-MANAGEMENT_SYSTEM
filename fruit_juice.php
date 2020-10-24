<?php
	session_start();
	include_once('header.php');
	include_once('dbConn.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<link rel="stylesheet" href="production.css" type="text/css" />

	<script>
		document.getElementById("pro").classList.add("active");
	</script>
</head>
<body>
<?php if (isset($_SESSION['username'])) : ?>
	<div class="cont">

	<table align="center" width="80%" cellpadding="5" style="margin-top: 230px;">
						<tr>
							<th colspan="8" style="font-size: 45px; background-color:#a3a1ed">Green Garden Fruit Juice</th>
						</tr>
						<tr style="background-color: #9cdbdb; font-size:25px; ">
							<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Product Image</th>
							<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Product Type</th>
							<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Product Name</th>
							<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Product Code</th>
							<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Product Size</th>
							<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Product Description</th>
							<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Product Status</th>
							<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Price</th>
						</tr>
						<?php
							$product_get_query = "SELECT * FROM products WHERE PRODUCT_TYPE='Fruit Juice'";
							$product_excute = mysqli_query($db, $product_get_query);
							
						
							while($rows=mysqli_fetch_assoc($product_excute)) {
						?>
							<?php $img = $rows['IMG'] ?>
				<?php switch ($img) {
						case "imgs/Juice/mangoe_juice.jpg": ?>
					<tr style="background-color: #B8860B; font-size: 25px; font-family: Comic Sans MS, cursive, sans-serif">
					<td align="center"><img src="imgs/Juice/mangoe_juice.jpg" alt="strawbery_jam" id="img1" width=220 height=250></td>
					<?php break ?>
					<?php case "imgs/Juice/mixed1.jpg": ?>
					<tr style="background-color: #FFA500; font-size: 25px; font-family: Comic Sans MS, cursive, sans-serif">
					<td align="center"><img src="imgs/Juice/mixed1.jpg" alt="mango jam" id="img2" width=220 height=250></td>
					<?php break ?>
					<?php case "imgs/Juice/papaya.jpg": ?>
					<tr style="background-color: #D2691E; font-size: 25px; font-family: Comic Sans MS, cursive, sans-serif">
					<td align="center"><img src="imgs/Juice/papaya.jpg" alt="wood apple" id="img2" width=220 height=250></td>
					<?php break ?>
				<?php } ?>
				<td align="center"><?php echo $rows['PRODUCT_TYPE'] ?></td>
					<td align="center"><?php echo $rows['PRODUCT_NAME'] ?></td>
					<td align="center"><?php echo $rows['PRODUCT_CODE'] ?></td>
					<td align="center"><?php echo $rows['PRODUCT_SIZE'] ?></td>
					<td align="center"><?php echo $rows['PRODUCT_DESCRIPTION'] ?></td>
					<td align="center"><?php echo $rows['PRODUCT_STATUS'] ?></td>
					<td align="center"><?php echo $rows['PRICE'] ?></td>
					</tr>
						<?php	} ?>
					</table>
	<br>
	<a href="products.php"><img src="./imgs/back.png" width="100" height="100" ></a>

	</div>
<?php endif ?>
</body>
</html>