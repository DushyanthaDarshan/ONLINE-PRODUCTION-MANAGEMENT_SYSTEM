<?php
	include('db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="header.css" type="text/css" />
	<link rel="stylesheet" href="admin.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
	<title>Admin Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<style>
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

		tr:nth-child(odd) {
			background-color: #ecf5b3;
		}

		tr:hover {
			background-color:#97e898;
		}

		.searchBtn:hover {
			color: #FFFFFF;
			background-color: #A109F9;
		}
	</style>
</head>
<body>
	<script>
		//for minimize header height
    	/*window.onscroll = function() {
			scrollFunction()
			};
          
        function scrollFunction() {
            if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
              //document.getElementById("navbar").style.padding = "0px 0px";
			  document.getElementById("navbar").style.height = "100px";
            } else {
			  //document.getElementById("navbar").style.padding = "0px 0px";
			  document.getElementById("navbar").style.height = "auto";
            }
        }*/
		</script>
	<div>
		<?php
			include('header.php');
		?>
<?php if (isset($_SESSION['username'])) : ?>
		<script>
			document.getElementById("adm").classList.add("active");
		</script>
	</div>
	<div id="middle">
		<div id="dashBoard">
			<h2 style="text-align: center;" id="top">Admin DashBoard</h2>
			<button class="collapsible">Admin Management</button>
			<div class="collapsible-body">
				<a href="#addAdmin"><button class="internal-btn">Add Admin</button></a>
				<a href="#updateAdmin"><button class="internal-btn">Update Admin</button></a>
				<a href="#deleteAdmin"><button class="internal-btn">Delete Admin</button></a>
			</div>
			<button class="collapsible">User Management</button>
			<div class="collapsible-body">
				<a href="#viewUser"><button class="internal-btn">View Users</button></a>
				<a href="#deleteUser"><button class="internal-btn">Delete User</button></a>
			</div>
			<button class="collapsible">Product Management</button>
			<div class="collapsible-body">
				<a href="#addProduct"><button class="internal-btn">Add Products</button></a>
				<a href="#updateProduct"><button class="internal-btn">Update Products</button></a>
				<a href="#deleteProduct"><button class="internal-btn">Delete Products</button></a>
			</div>
			<button class="collapsible">Stock Management</button>
			<div class="collapsible-body">
				<a href="#addStock"><button class="internal-btn">Add Stock</button></a>
				<a href="#viewStock"><button class="internal-btn">View Stock</button></a>
				<a href="#updateStock"><button class="internal-btn">Update Stock</button></a>
				<a href="#deleteStock"><button class="internal-btn">Delete Stock</button></a>
			</div>
			<div>
			<?php if (count($success_message) > 0) : ?>
				<?php foreach ($success_message as $s_msg) : ?>
  	  				<p class="success-msg"><?php echo $s_msg ?></p>
				<?php endforeach ?>
			<?php endif ?>
			<?php if (count($error_message) > 0) : ?>
				<?php foreach ($error_message as $e_msg) : ?>
  	  				<p class="error-msg"><?php echo $e_msg ?></p>
				<?php endforeach ?>
			<?php endif ?>
			</div>
		</div>
		<script>
			var collaClass = document.getElementsByClassName("collapsible");
			var i;

			for (i = 0; i < collaClass.length; i++) {
				collaClass[i].addEventListener("click", function() {
    				this.classList.toggle("collapsible-active");
    				var content = this.nextElementSibling;
    				if (content.style.maxHeight) {
      					content.style.maxHeight = null;
    				} else {
      					content.style.maxHeight = content.scrollHeight + "px";
    				} 
  				});
			}
		</script>
	<!-- right side body related area -->
		<div id="right">
			<!-- Admin profiles related area -->
			<!-- Add Admin profile related area -->
			<div id="addAdmin" class="admin">
				<form method="post" action="admin.php">
					<p style="font-size: 30px; text-align: center;"><strong>Add Admin Profile</strong></p>
					<input type="text" id="name" name="name" placeholder="Name">
					<input type="text" id="username" name="username" placeholder="Username">
					<input type="email" name="email" placeholder="Email">
					<input type="text" name="country" placeholder="Country">
					<input type="password" name="password1" placeholder="Password">
					<input type="password" name="password2" placeholder="Comfirm Password">
					<input type="text" name="phone" placeholder="Mobile Number">
					<input type="text" name="address" placeholder="Address">
					<input type="text" name="nic" placeholder="NIC"><br><br>
					<?php if (count($errors) > 0) : ?>
						<?php foreach ($errors as $error) : ?>
  	  						<p class="error"><?php echo $error ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<?php if (count($successes) > 0) : ?>
						<?php foreach ($successes as $success) : ?>
  	  						<p class="success"><?php echo $success ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<input type="submit" name="addAdminbtn" value="Save">
				</form>
			</div>

			<!-- Update Admin profile related area -->
			<div id="updateAdmin" class="admin">
			<form method="post" action="admin.php">
					<p style="font-size: 30px; text-align: center;"><strong>Update Admin Profile</strong></p>
					<p style="font-size: 18px; text-align: center;">
					<strong>Cannot update username. Enter username of account that you want to update</strong></p>
					<input type="text" name="name" placeholder="Name">
					<input type="text" name="username" placeholder="Username">
					<input type="email" name="email" placeholder="Email">
					<input type="text" name="country" placeholder="Country">
					<input type="password" name="password1" placeholder="Password">
					<input type="password" name="password2" placeholder="Comfirm Password">
					<input type="text" name="phone" placeholder="Mobile Number">
					<input type="text" name="address" placeholder="Address">
					<input type="text" name="nic" placeholder="NIC">
					<input type="text" name="productStatus" placeholder="Product Status"><br><br>
					<?php if (count($errors) > 0) : ?>
						<?php foreach ($errors as $error) : ?>
  	  						<p class="error"><?php echo $error ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<?php if (count($successes) > 0) : ?>
						<?php foreach ($successes as $success) : ?>
  	  						<p class="success"><?php echo $success ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<input type="submit" name="updateAdminbtn" value="Update">
				</form>
			</div>

			<!-- Delete Admin profile related area -->
			<div id="deleteAdmin" class="admin">
			<form method="post" action="admin.php">
					<p style="font-size: 30px; text-align: center;"><strong>Delete Admin Profile</strong></p>
					<p style="font-size: 18px; text-align: center;">
					<strong>Enter username of account that you want to delete</strong></p>
					<input type="text" id="username" name="username" placeholder="Username"><br/><br/>
					<?php if (count($errors) > 0) : ?>
						<?php foreach ($errors as $error) : ?>
  	  						<p class="error"><?php echo $error ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<?php if (count($successes) > 0) : ?>
						<?php foreach ($successes as $success) : ?>
  	  						<p class="success"><?php echo $success ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<input type="submit" name="deleteAdminbtn" value="Delete">
				</form>
			</div>

			<!-- User related area -->
			<!-- View all users reated area -->
			<div id="viewUser">
				<table>
					<tr>
						<th colspan="8" style="font-size: 45px; background-color:#a3a1ed">All Users</th>
					</tr>
					<tr style="background-color: #9cdbdb">
						<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">User Type</th>
						<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Name</th>
						<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">NIC</th>
						<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Phone Number</th>
						<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Address</th>
						<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Country</th>
						<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Email</th>
						<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Status</th>
					</tr>
					<?php
						$user_get_query = "SELECT * FROM user WHERE USER_TYPE='Customer' OR USER_TYPE='Sales Agent' OR USER_TYPE='Supplier'";
						$user_excute = mysqli_query($db, $user_get_query);
						if (!stock_euser_excutexcute) {
						  array_push($errors, "No data found");
						}
					  
						while($Urows=mysqli_fetch_assoc($user_excute)) {
					?>
						<tr>
							<td><?php echo $Urows['USER_TYPE'] ?></td>
							<td><?php echo $Urows['F_NAME'] ?></td>
							<td><?php echo $Urows['NIC'] ?></td>
							<td><?php echo $Urows['PHONE_NUMBER'] ?></td>
							<td><?php echo $Urows['U_ADDRESS'] ?></td>
							<td><?php echo $Urows['COUNTRY'] ?></td>
							<td><?php echo $Urows['EMAIL'] ?></td>
							<td><?php echo $Urows['U_STATUS'] ?></td>
						</tr>
					<?php	} ?>
				</table>
			</div>	
			<!-- Delete User profile related area -->
			<div id="deleteUser" class="admin">
				<form method="post" action="admin.php">
					<p style="font-size: 30px; text-align: center;"><strong>Delete User Profile</strong></p>
					<p style="font-size: 18px; text-align: center;">
					<strong>Enter username of account that you want to delete</strong></p>
					<input type="text" id="username" name="username" placeholder="Username"><br/><br/>
					<?php if (count($errors) > 0) : ?>
						<?php foreach ($errors as $error) : ?>
  	  						<p class="error"><?php echo $error ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<?php if (count($successes) > 0) : ?>
						<?php foreach ($successes as $success) : ?>
  	  						<p class="success"><?php echo $success ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<input type="submit" name="deleteUserbtn" value="Delete">
				</form>
			</div>

			<!-- Product related area -->
			<!-- Add product related area -->
			<div id="addProduct" class="admin">
				<form method="post" action="admin.php">
					<p style="font-size: 30px; text-align: center;"><strong>Add Product</strong></p>
					<input type="text" name="productType" placeholder="Product Type">
					<input type="text" name="productName" placeholder="Product Name">
					<input type="text" name="productSize" placeholder="Product Size">
					<input type="text" name="price" placeholder="Price">
					<p style="font-size: 18px; text-align: center;"><strong>Product code should be started with "**". (ex: **001)</strong></p>
					<input type="text" name="productCode" placeholder="Product Code">
					<input type="text" name="description" placeholder="Product Description">
					<input type="text" name="img" placeholder="Product Image Path">
					<input type="text" name="productStatus" placeholder="Product Status"><br><br>
					<?php if (count($errors) > 0) : ?>
						<?php foreach ($errors as $error) : ?>
  	  						<p class="error"><?php echo $error ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<?php if (count($successes) > 0) : ?>
						<?php foreach ($successes as $success) : ?>
  	  						<p class="success"><?php echo $success ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<input type="submit" name="addProductbtn" value="Save">
				</form>
			</div>

			<!-- Update product related area -->
			<div id="updateProduct" class="admin">
				<form method="post" action="admin.php">
					<p style="font-size: 30px; text-align: center;"><strong>Update Product</strong></p>
					<input type="text" name="productType" placeholder="Product Type">
					<input type="text" name="productName" placeholder="Product Name">
					<input type="text" name="productSize" placeholder="Product Size">
					<input type="text" name="price" placeholder="Price">
					<p style="font-size: 18px; text-align: center;"><strong>Product code should be started with "**" (ex: **001). 
						Product code cannot be updated.</strong></p>
					<input type="text" name="productCode" placeholder="Product Code">
					<input type="text" name="img" placeholder="Product Image Path">
					<input type="text" name="description" placeholder="Product Description">
					<p style="font-size: 18px; text-align: center;"><strong>Product status should be "ACTIVE" or 
					"PROCESSING" or "DEACTIVE"</strong></p>
					<input type="text" name="productStatus" placeholder="Product Status"><br><br>
					<?php if (count($errors) > 0) : ?>
						<?php foreach ($errors as $error) : ?>
  	  						<p class="error"><?php echo $error ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<?php if (count($successes) > 0) : ?>
						<?php foreach ($successes as $success) : ?>
  	  						<p class="success"><?php echo $success ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<input type="submit" name="updateProductbtn" value="Update">
				</form>
			</div>

			<!-- Delete product related area -->
			<div id="deleteProduct" class="admin">
				<form method="post" action="admin.php">
					<p style="font-size: 30px; text-align: center;"><strong>Delete Product</strong></p>
					<p style="font-size: 18px; text-align: center;"><strong>Product code should be started with "**" (ex: **001). 
						Product code should be enter that what you want delete.</strong></p>
					<input type="text" name="productCode" placeholder="Product Code"><br><br>
					<?php if (count($errors) > 0) : ?>
						<?php foreach ($errors as $error) : ?>
  	  						<p class="error"><?php echo $error ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<?php if (count($successes) > 0) : ?>
						<?php foreach ($successes as $success) : ?>
  	  						<p class="success"><?php echo $success ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<input type="submit" name="deleteProductbtn" value="Delete">
				</form>
			</div>

			<!-- Stock related area -->
			<!-- Add stock related area -->
			<div id="addStock" class="admin">
				<form method="post" action="admin.php">
					<p style="font-size: 30px; text-align: center;"><strong>Add Stock</strong></p>
					<input type="text" name="stockName" placeholder="Stock Name">
					<input type="text" name="availableQ" placeholder="Available stock Size">
					<input type="text" name="usedQ" placeholder="Used stock Size">
					<input type="text" name="pendingUseQ" placeholder="Ready to pick to use stock Size">
					<p style="font-size: 18px; text-align: center;"><strong>Stock code should be started with "**". (ex: **500)</strong></p>
					<input type="text" name="stockCode" placeholder="Stock Code">
					<input type="text" name="stockSuplierName" placeholder="Stock Supplier UserName">
					<p style="font-size: 18px; text-align: center;"><strong>Stock status: Available, Ready to Pick, Surplus, Deficiency</strong></p>
					<input type="text" name="stockStatus" placeholder="Stock Status"><br><br>
					<?php if (count($errors) > 0) : ?>
						<?php foreach ($errors as $error) : ?>
  	  						<p class="error"><?php echo $error ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<?php if (count($successes) > 0) : ?>
						<?php foreach ($successes as $success) : ?>
  	  						<p class="success"><?php echo $success ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<input type="submit" name="addStockbtn" value="Save">
				</form>
			</div>

			<!-- Update stock related area -->
			<div id="updateStock" class="admin">
				<form method="post" action="admin.php">
					<p style="font-size: 30px; text-align: center;"><strong>Update Stock</strong></p>
					<input type="text" name="stockName" placeholder="Stock Name">
					<p style="font-size: 18px; text-align: center;"><strong>Stock code should be started with "**" (ex: **500). 
						Stock code cannot be updated.</strong></p>
					<input type="text" name="stockCode" placeholder="Stock Code">
					<input type="text" name="availableQ" placeholder="Available stock Size">
					<input type="text" name="usedQ" placeholder="Used stock Size">
					<input type="text" name="pendingUseQ" placeholder="Ready to pick to use stock Size">
					<p style="font-size: 18px; text-align: center;"><strong>Stock code: Available, Ready to Pick, Surplus, Deficiency</strong></p>
					<input type="text" name="stockStatus" placeholder="Stock Status"><br><br>
					<?php if (count($errors) > 0) : ?>
						<?php foreach ($errors as $error) : ?>
  	  						<p class="error"><?php echo $error ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<?php if (count($successes) > 0) : ?>
						<?php foreach ($successes as $success) : ?>
  	  						<p class="success"><?php echo $success ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<input type="submit" name="updateStockbtn" value="Update">
				</form>
			</div>

			<!-- Delete Stock related area -->
			<div id="deleteStock" class="admin">
				<form method="post" action="admin.php">
					<p style="font-size: 30px; text-align: center;"><strong>Delete Stock</strong></p>
					<p style="font-size: 18px; text-align: center;"><strong>Stock code should be started with "**" (ex: **500). 
					Stock code should be enter that what you want delete.</strong></p>
					<input type="text" name="stockCode" placeholder="Stock Code"><br><br>
					<?php if (count($errors) > 0) : ?>
						<?php foreach ($errors as $error) : ?>
  	  						<p class="error"><?php echo $error ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<?php if (count($successes) > 0) : ?>
						<?php foreach ($successes as $success) : ?>
  	  						<p class="success"><?php echo $success ?></p>
						<?php endforeach ?>
					<?php endif ?>
					<input type="submit" name="deleteStockbtn" value="Delete">
				</form>
			</div>

			<!-- View stock reated area -->
			<div id="viewStock">
				<table>
					<tr>
						<th colspan="7" style="font-size: 45px; background-color:#a3a1ed">All Raw Materials Details</th>
					</tr>
					<tr style="background-color: #9cdbdb">
						<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Material Code</th>
						<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Material Name</th>
						<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Available Quantity</th>
						<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Used Quantity</th>
						<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Pending To Use Quantity</th>
						<th style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Material Status</th>
						<th style="color: #000000; text-shadow: 2px 2px 4px #FFFFFF;">Supplier Name</th>
					</tr>
					<?php
						$stock_get_query = "SELECT S.M_CODE, S.M_NAME, S.AVAILABLE_Q, S.USED_Q, S.PENDING_USE_Q, S.M_STATUS, U.F_NAME FROM stock S LEFT JOIN user U ON S.USER_ID=U.USER_ID";
						$stock_excute = mysqli_query($db, $stock_get_query);
						if (!stock_excute) {
						  array_push($errors, "No data found");
						}
					  
						while($rows=mysqli_fetch_assoc($stock_excute)) {
					?>
						<tr>
							<td><?php echo $rows['M_CODE'] ?></td>
							<td><?php echo $rows['M_NAME'] ?></td>
							<td><?php echo $rows['AVAILABLE_Q'] ?></td>
							<td><?php echo $rows['USED_Q'] ?></td>
							<td><?php echo $rows['PENDING_USE_Q'] ?></td>
							<td><?php echo $rows['M_STATUS'] ?></td>
							<td><?php echo $rows['F_NAME'] ?></td>
						</tr>
					<?php	} ?>
				</table>
			</div>
		</div>
	</div>
<?php endif ?>
</body>
</html>