<?php
	session_start();
	include_once('header.php');
	include("dbConn.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<script>
		document.getElementById("hom").classList.add("active");
	</script>

<style>

.mySlides {
	display: none;
}

#img1 {
	vertical-align: middle;
	width: 280px;
	height: 450px;
}

#img2 {
	vertical-align: middle;
	width: 180px;
	height: 250px;
}

/* Slideshow container */
.slideshow-container {
  max-width: 500px;
  position: relative;
  margin-top: 230px;
  margin-left: 450px;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}

table {
	border-collapse: collapse;
	width: 100%;
	padding: 20px;
}

th {
	font-size: 20px;
}

th, td {
	font-weight: bold;
	padding: 8px;
	text-align: center;
	border-bottom: 1px solid #ddd;
}

</style>
</head>
<body style="background-color: #d1cbc9;">

<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 5</div>
  <img src="imgs/mangoe_jam.jpg" style="width:100%" id="img1">
  <div class="text">Mango Jam</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 5</div>
  <img src="imgs/mangoe_juice.jpg" style="width:100%" id="img1">
  <div class="text">Mango Juice</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 5</div>
  <img src="imgs/passion_jam.jpg" style="width:100%" id="img1">
  <div class="text">Passion Juice</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">4 / 5</div>
  <img src="imgs/Chuttney/chilli.jpg" style="width:100%" id="img1">
  <div class="text">Chilli Chuttney</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">5 / 5</div>
  <img src="imgs/Biscuits/chocolate.jpg" style="width:100%" id="img1">
  <div class="text">Chocolate Biscuits</div>
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span> 
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>
<div>
  <p style="font-family: sans-serif; font-size: 25px;">
    Happy to annouce we produce following types of products as a world demand company. We can guarantee our 
    products are healthier. You can get more details about our product by using <strong>Products</strong> tab. 
  </p>
</div>
<table>
					<tr>
						<th colspan="4" style="font-size: 45px; background-color:#a3a1ed">Some Products With Some Details</th>
					</tr>
          <tr style="background-color: #9cdbdb">
						<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Product Image</th>
						<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Product Name</th>
						<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Product Size</th>
						<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Price</th>
					</tr>
					<?php
						$product_get_query = "SELECT * FROM products WHERE PRODUCT_STATUS='ACTIVE'";
						$product_excute = mysqli_query($db, $product_get_query);
						if (!$product_excute) {
						  array_push($errors, "No data found");
						}
					  
						while($rows=mysqli_fetch_assoc($product_excute)) {
					?>
						<?php $img = $rows['IMG'] ?>
            <?php switch ($img) {
                    case "imgs/Juice/mangoe_juice.jpg": ?>
                <tr>
                  <td><img src="imgs/Juice/mangoe_juice.jpg" alt="mango jam" id="img2"></td>
                  <?php break ?>
                <?php case "imgs/Jam/str_jam.jpg": ?>
                <tr>
                  <td><img src="imgs/Jam/str_jam.jpg" alt="mango juice" id="img2"></td>
                  <?php break ?>
                <?php case "imgs/Jam/mangoe_jam.jpg": ?>
                <tr>
                  <td><img src="imgs/Jam/mangoe_jam.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Jam/wood_jam.jpg": ?>
                <tr>
                  <td><img src="imgs/Jam/wood_jam.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Juice/mixed1.jpg": ?>
                <tr>
                  <td><img src="imgs/Juice/mixed1.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Juice/papaya.jpg": ?>
                <tr>
                  <td><img src="imgs/Juice/papaya.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Sauce/tomatoe.jpg": ?>
                <tr>
                  <td><img src="imgs/Sauce/tomatoe.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Sauce/chilli.jpg": ?>
                <tr>
                  <td><img src="imgs/Sauce/chilli.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Sauce/garlic.jpg": ?>
                <tr>
                  <td><img src="imgs/Sauce/garlic.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Chuttney/mangoe.jpg": ?>
                <tr>
                  <td><img src="imgs/Chuttney/mangoe.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Chuttney/chilli.jpg": ?>
                <tr>
                  <td><img src="imgs/Chuttney/chilli.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Chuttney/mint.jpg": ?>
                <tr>
                  <td><img src="imgs/Chuttney/mint.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Biscuits/chocolate.jpg": ?>
                <tr>
                  <td><img src="imgs/Biscuits/chocolate.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Biscuits/ginger.jpg": ?>
                <tr>
                  <td><img src="imgs/Biscuits/ginger.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
                  <?php case "imgs/Biscuits/peanut.jpg": ?>
                <tr>
                  <td><img src="imgs/Biscuits/peanut.jpg" alt="passion jam" id="img2"></td>
                  <?php break ?>
            <?php } ?>
                  <td><?php echo $rows['PRODUCT_NAME'] ?></td>
                  <td><?php echo $rows['PRODUCT_SIZE'] ?></td>
                  <td><?php echo $rows['PRICE'] ?></td>
                </tr>
					<?php	} ?>
				</table>
</body>
</html>