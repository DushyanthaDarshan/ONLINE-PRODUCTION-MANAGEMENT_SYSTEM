<?php
session_start();

//database relate variables
$name = "";
$username = "";
$email = "";
$userType = "";
$country = "";
$phone = "";
$address = "";
$nic = "";
$status = "";
$errors = array();
$successes = array();
$success_message = array();
$error_message = array();

include("dbConn.php");

//signup page related
if (isset($_POST['signupbtn'])) {
  
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $country = mysqli_real_escape_string($db, $_POST['country']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password2 = mysqli_real_escape_string($db, $_POST['password2']);
  $userType = mysqli_real_escape_string($db, $_POST['type']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $nic = mysqli_real_escape_string($db, $_POST['nic']);

  if (empty($name)) { 
    array_push($errors, "Name should not be empty"); 
  }
  if (empty($username)) { 
    array_push($errors, "Username should not be empty"); 
  }
  if (empty($email)) { 
    array_push($errors, "Email should not be empty"); 
  }
  if (empty($country)) { 
    array_push($errors, "Country field should not be empty"); 
  }
  if (empty($password1)) { 
    array_push($errors, "Password should not be empty"); 
  }
  if (empty($userType)) { 
    $userType = "Customer";
  }
  if (empty($phone)) { 
    $phone = "null";
  }
  if (empty($address)) { 
    $address = "null";
  }
  if (empty($nic)) { 
    $nic = "null";
  }
  if (empty($status)) { 
    $status = "ACTIVE";
  }
  if ($password1 != $password2) {
	array_push($errors, "The two passwords do not match");
  }
  $createdTimestamp = date("d/m/Y h:m:s");

  //check already saved data
  $user_check_query = "SELECT * FROM user WHERE USERNAME='$username' OR EMAIL='$email' OR NIC='$nic' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['USERNAME'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['EMAIL'] === $email) {
      array_push($errors, "Email address already exists");
    }
  }

  if (count($errors) == 0) {
  	$insert_query = "INSERT INTO user(USER_TYPE, USERNAME, PASSWD, F_NAME, NIC, PHONE_NUMBER, U_ADDRESS, COUNTRY, 
              EMAIL, U_STATUS, CREATED_TIMESTAMP) 
  			      VALUES('$userType', '$username', '$password1', '$name', '$nic', '$phone', '$address', '$country', 
              '$email', '$status', '$createdTimestamp')";

    if (mysqli_query($db, $insert_query)) {
      //for track login timestamp
      if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
      }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }else{
        $ip = $_SERVER['REMOTE_ADDR'];
      }
      $log_in = "INSERT INTO login_track(USERNAME_OR_ID, IN_TIMESTAMP, IP_ADDRESS) VALUES('$username', '$createdTimestamp', '$ip')";
      mysqli_query($db, $log_in);

      $_SESSION['username'] = $username;
      $_SESSION['type'] = $userType;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: home.php');
    }
  }
}

//login page relate
if (isset($_POST['logbtn'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if(empty($username) && empty($password)) {
    array_push($errors, "Username and Password  should not be empty");
  } elseif (empty($username)) {
    array_push($errors, "Username should not be empty");
  } elseif (empty($password)) {
    array_push($errors, "Password should not be empty");
  }

  //for track login timestamp
  if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    //ip from share internet
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    //ip pass from proxy
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  $log_time = date("d/m/Y h:m:s");

  if (count($errors) == 0) {
  	$query = "SELECT * FROM user WHERE USERNAME='$username' AND PASSWD='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      $row = mysqli_fetch_assoc($results);
      //track user id
      $log_in = "INSERT INTO login_track(USERNAME_OR_ID, IN_TIMESTAMP, IP_ADDRESS) VALUES('$username', '$log_time', '$ip')";
      mysqli_query($db, $log_in);

      $supp = $row['USER_TYPE'];
      if ($row["USER_TYPE"] == "ADMIN") {
        $_SESSION['username'] = $username;
        $_SESSION['type'] = "ADMIN";
  	    $_SESSION['success'] = "You are now logged in";
        header('location: admin.php');
      } else {
        $_SESSION['type'] = $supp;
        $_SESSION['username'] = $username;
  	    $_SESSION['success'] = "You are now logged in";
  	    header('location: home.php');
      }
  	} else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

//Admin Managemnet related database queries
  //add admin to the database
if (isset($_POST['addAdminbtn'])) {
  
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $country = mysqli_real_escape_string($db, $_POST['country']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password2 = mysqli_real_escape_string($db, $_POST['password2']);
  $userType = mysqli_real_escape_string($db, $_POST['type']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $nic = mysqli_real_escape_string($db, $_POST['nic']);

  if (empty($name)) { 
    array_push($errors, "Name should not be empty"); 
  }
  if (empty($username)) { 
    array_push($errors, "Username should not be empty"); 
  }
  if (empty($email)) { 
    array_push($errors, "Email should not be empty"); 
  }
  if (empty($country)) { 
    array_push($errors, "Country field should not be empty"); 
  }
  if (empty($password1)) { 
    array_push($errors, "Password should not be empty"); 
  }
  if (empty($userType)) { 
    $userType = "ADMIN";
  }
  if (empty($phone)) { 
    array_push($errors, "Phone should not be empty"); 
  }
  if (empty($address)) { 
    array_push($errors, "Address should not be empty"); 
  }
  if (empty($nic)) { 
    array_push($errors, "NIC should not be empty"); 
  }
  if (empty($status)) { 
    $status = "ACTIVE";
  }
  if ($password1 != $password2) {
	array_push($errors, "The two passwords do not match");
  }
  $createdTimestamp = date("d/m/Y h:m:s");

  //check already saved data
  $user_check_query = "SELECT * FROM user WHERE USERNAME='$username' OR EMAIL='$email' OR NIC='$nic' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['USERNAME'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['EMAIL'] === $email) {
      array_push($errors, "Email address already exists");
    }
  }

  if (count($errors) == 0) {
  	$insert_query = "INSERT INTO user(USER_TYPE, USERNAME, PASSWD, F_NAME, NIC, PHONE_NUMBER, U_ADDRESS, COUNTRY, 
              EMAIL, U_STATUS, CREATED_TIMESTAMP) 
  			      VALUES('$userType', '$username', '$password1', '$name', '$nic', '$phone', '$address', '$country', 
              '$email', '$status', '$createdTimestamp')";
    if (mysqli_query($db, $insert_query)) {
      array_push($successes, "Admin profile has been saved Successfully.");
      array_push($success_message, "Admin Successfully saved.");
    }
  } else {
      array_push($error_message, "Admin not saved.");
  }
}

//update admin to the database
if (isset($_POST['updateAdminbtn'])) {
  
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $country = mysqli_real_escape_string($db, $_POST['country']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password2 = mysqli_real_escape_string($db, $_POST['password2']);
  $userType = mysqli_real_escape_string($db, $_POST['type']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $nic = mysqli_real_escape_string($db, $_POST['nic']);

  if (empty($name)) { 
    array_push($errors, "Name should not be empty"); 
  }
  if (empty($username)) { 
    array_push($errors, "Username should not be empty"); 
  }
  if ($username != $_SESSION['username'] && $_SESSION['username'] != "dushyantha1208@gmail.com" 
  && $_SESSION['username'] != "uoc") { 
    array_push($errors, "You don't have update permissions");
  }
  if (empty($email)) { 
    array_push($errors, "Email should not be empty"); 
  }
  if (empty($country)) { 
    array_push($errors, "Country field should not be empty"); 
  }
  if (empty($password1)) { 
    array_push($errors, "Password should not be empty"); 
  }
  if (empty($userType)) { 
    $userType = "ADMIN";
  }
  if (empty($phone)) { 
    array_push($errors, "Phone should not be empty"); 
  }
  if (empty($address)) { 
    array_push($errors, "Address should not be empty"); 
  }
  if (empty($nic)) { 
    array_push($errors, "NIC should not be empty"); 
  }
  if (empty($status)) { 
    $status = "ACTIVE";
  }
  if ($password1 != $password2) {
	array_push($errors, "The two passwords do not match");
  }
  $createdTimestamp = date("d/m/Y h:m:s");

  //check already saved data
  $user_check_query = "SELECT * FROM user WHERE USERNAME='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['USERNAME'] !== $username) {
      array_push($errors, "No data found for the given username");
    }
  }

  if (count($errors) == 0) {
    $userId = $user['USER_ID'];
  	$update_query = "UPDATE user SET PASSWD='$password1', F_NAME='$name', NIC='$nic', PHONE_NUMBER='$phone', 
    U_ADDRESS='$address', COUNTRY='$country', EMAIL='$email', U_STATUS='$status' WHERE USER_ID=$userId";
    if (mysqli_query($db, $update_query)) {
      array_push($successes, "Admin profile has been updated Successfully.");
      array_push($success_message, "Admin Successfully updated.");
    }
  } else {
      array_push($error_message, "Admin not updated.");
  }
}

//delete admin in the database
if (isset($_POST['deleteAdminbtn'])) {
  
  $username = mysqli_real_escape_string($db, $_POST['username']);

  if (empty($username)) { 
    array_push($errors, "Username should not be empty"); 
  }
  if ($username != $_SESSION['username'] && $_SESSION['username'] != "dushyantha1208@gmail.com" 
  && $_SESSION['username'] != "uoc") { 
    array_push($errors, "You don't have delete permissions");
  }

  //check given username is correct or not
  $user_check_query = "SELECT * FROM user WHERE USERNAME='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['USERNAME'] !== $username) {
      array_push($errors, "No data found for the given username");
    }
  }

  if (count($errors) == 0) {
    $userId = $user['USER_ID'];
  	$update_query = "DELETE FROM user WHERE USER_ID=$userId";
    if (mysqli_query($db, $update_query)) {
      array_push($successes, "Admin profile has been deleted Successfully.");
      array_push($success_message, "Admin Successfully deleted.");
      if ($username == $_SESSION['username']) {
        header('location: logout.php');
      }
    }
  } else {
      array_push($error_message, "Admin not deleted.");
  }
}

//update user in database
if (isset($_POST['updateUserbtn'])) {
  
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $country = mysqli_real_escape_string($db, $_POST['country']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password2 = mysqli_real_escape_string($db, $_POST['password2']);
  $userType = mysqli_real_escape_string($db, $_POST['type']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $nic = mysqli_real_escape_string($db, $_POST['nic']);

  $username = $_SESSION['username'];
  //get stock supplier user Id
  $get_query = "SELECT * FROM user WHERE USERNAME='$username' ";
  $userExcute = mysqli_query($db, $get_query);
  $rows = mysqli_fetch_assoc($userExcute);

  if (empty($name)) { 
    $name = $rows['F_NAME'];
  }
  
  if ($username != $_SESSION['username'] && $_SESSION['username'] != "dushyantha1208@gmail.com" 
  && $_SESSION['username'] != "uoc") { 
    array_push($errors, "You don't have update permissions");
  }
  if (empty($email)) { 
    $email = $rows['EMAIL'];
  }
  if (empty($country)) { 
    $country = $rows['COUNTRY'];
  }
  if (empty($password1)) { 
    $password1 = $rows['PASSWD'];
  }
  if (empty($userType)) { 
    $userType = $rows['USER_TYPE'];
  }
  if (empty($phone)) { 
    $phone = $rows['PHONE_NUMBER'];
  }
  if (empty($address)) { 
    $address = $rows['U_ADDRESS'];
  }
  if (empty($nic)) { 
    $nic = $rows['NIC'];
  }
  if (empty($status)) { 
    $status = $rows['U_STATUS'];
  }
  if ($password1 != $password2) {
	array_push($errors, "The two passwords do not match");
  }
  $createdTimestamp = date("d/m/Y h:m:s");

  //check already saved data
  $user_check_query = "SELECT * FROM user WHERE USERNAME='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['USERNAME'] !== $username) {
      array_push($errors, "No data found for the given username");
    }
  }

  if (count($errors) == 0) {
    $userId = $user['USER_ID'];
  	$update_query = "UPDATE user SET PASSWD='$password1', F_NAME='$name', NIC='$nic', PHONE_NUMBER='$phone', 
    U_ADDRESS='$address', COUNTRY='$country', EMAIL='$email', U_STATUS='$status' WHERE USER_ID=$userId";
    if (mysqli_query($db, $update_query)) {
      array_push($successes, "User profile has been updated Successfully.");
      array_push($success_message, "User Successfully updated.");
    }
  } else {
      array_push($error_message, "User not updated.");
  }
}

//delete user in the database
if (isset($_POST['deleteUserbtn'])) {
  
  $username = mysqli_real_escape_string($db, $_POST['username']);

  if (empty($username)) { 
    array_push($errors, "Username should not be empty"); 
  }
  if ($username != $_SESSION['username'] && $_SESSION['username'] != "dushyantha1208@gmail.com" 
  && $_SESSION['username'] != "uoc") { 
    array_push($errors, "You don't have delete permissions");
  }

  //check given username is correct or not
  $user_check_query = "SELECT * FROM user WHERE USERNAME='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['USERNAME'] !== $username) {
      array_push($errors, "No data found for the given username");
    }
  }

  if (count($errors) == 0) {
    $userId = $user['USER_ID'];
  	$update_query = "DELETE FROM user WHERE USER_ID=$userId";
    if (mysqli_query($db, $update_query)) {
      array_push($successes, "User profile has been deleted Successfully.");
      array_push($success_message, "User Successfully deleted.");
      if ($username == $_SESSION['username']) {
        header('location: logout.php');
      }
    }
  } else {
      array_push($error_message, "User not deleted.");
  }
}

//Product Managemnet related database queries
  //add product to the database
  if (isset($_POST['addProductbtn'])) {
  
    $productType = mysqli_real_escape_string($db, $_POST['productType']);
    $productName = mysqli_real_escape_string($db, $_POST['productName']);
    $productSize = mysqli_real_escape_string($db, $_POST['productSize']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $productCode = mysqli_real_escape_string($db, $_POST['productCode']);
    $status = mysqli_real_escape_string($db, $_POST['productStatus']);
    $img = mysqli_real_escape_string($db, $_POST['img']);
  
    if (empty($productType)) { 
      array_push($errors, "Product type should not be empty"); 
    }
    if (empty($productName)) { 
      array_push($errors, "Product name should not be empty"); 
    }
    if (empty($productSize)) { 
      array_push($errors, "Product size should not be empty"); 
    }
    if (empty($price)) { 
      array_push($errors, "Price field should not be empty"); 
    }
    if (empty($description)) { 
      array_push($errors, "Description should not be empty"); 
    }
    if (empty($productCode)) { 
      array_push($errors, "Product code should not be empty"); 
    }
    if (empty($status)) { 
      $status = "ACTIVE";
    }
    $createdTimestamp = date("d/m/Y h:m:s");
  
    //check already saved data
    $user_check_query = "SELECT * FROM products WHERE PRODUCT_CODE='$productCode' ";
    $result = mysqli_query($db, $user_check_query);
    $product = mysqli_fetch_assoc($result);
    
    if ($product) {
      if ($product['PRODUCT_TYPE'] === $productType && $product['PRODUCT_SIZE'] === $productSize 
      && $product['PRODUCT_CODE'] === $productCode && $product['PRODUCT_NAME'] === $productName) {
        array_push($errors, "Given product already exists");
      }
    }
  
    if (count($errors) == 0) {
      $insert_query = "INSERT INTO products(PRODUCT_TYPE, PRODUCT_NAME, PRODUCT_SIZE, PRICE, PRODUCT_DESCRIPTION, PRODUCT_STATUS, 
      CREATED_TIMESTAMP, PRODUCT_CODE, IMG) 
                VALUES('$productType', '$productName', '$productSize', '$price', '$description', '$status', '$createdTimestamp', '$productCode', '$img')";
      if (mysqli_query($db, $insert_query)) {
        array_push($successes, "Product has been saved Successfully.");
        array_push($success_message, "Product Successfully saved.");
      }
    } else {
        array_push($error_message, "Product not saved.");
    }
  }

  //update product to the database
  if (isset($_POST['updateProductbtn'])) {
  
    $productType = mysqli_real_escape_string($db, $_POST['productType']);
    $productName = mysqli_real_escape_string($db, $_POST['productName']);
    $productSize = mysqli_real_escape_string($db, $_POST['productSize']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $productCode = mysqli_real_escape_string($db, $_POST['productCode']);
    $status = mysqli_real_escape_string($db, $_POST['productStatus']);
    $img = mysqli_real_escape_string($db, $_POST['img']);
  
    if (empty($productType)) { 
      array_push($errors, "Product type should not be empty"); 
    }
    if (empty($productName)) { 
      array_push($errors, "Product name should not be empty"); 
    }
    if (empty($productSize)) { 
      array_push($errors, "Product size should not be empty"); 
    }
    if (empty($price)) { 
      array_push($errors, "Price field should not be empty"); 
    }
    if (empty($description)) { 
      array_push($errors, "Description should not be empty"); 
    }
    if (empty($productCode)) { 
      array_push($errors, "Product code should not be empty"); 
    }
    if (empty($status)) { 
      $status = "ACTIVE";
    }
    if ($status != "ACTIVE" && $status != "PROCESSING" && $status != "DEACTIVE" && $status != "") { 
      array_push($errors, "Product status should be given format"); 
    }
    $createdTimestamp = date("d/m/Y h:m:s");
  
    //check already saved data
    $product_check_query = "SELECT * FROM products WHERE PRODUCT_CODE='$productCode' ";
    $result = mysqli_query($db, $product_check_query);
    $product = mysqli_fetch_assoc($result);
    
    if ($product) {
      if ($product['PRODUCT_TYPE'] == $productType && $product['PRODUCT_SIZE'] == $productSize 
      && $product['PRODUCT_NAME'] == $productName) {
        array_push($errors, "Given product already exists");
      }
    }
  
    if (count($errors) == 0) {
      $update_query = "UPDATE products SET PRODUCT_TYPE='$productType', PRODUCT_NAME='$productName', PRODUCT_SIZE='$productSize', 
      PRICE='$price', PRODUCT_DESCRIPTION='$description', PRODUCT_STATUS='$status', IMG='$img' WHERE PRODUCT_CODE='$productCode'";
      if (mysqli_query($db, $update_query)) {
        array_push($successes, "Product has been updated Successfully.");
        array_push($success_message, "Product Successfully updated.");
      }
    } else {
        array_push($error_message, "Product not updated.");
    }
  }

//delete product in the database
if (isset($_POST['deleteProductbtn'])) {
  
  $productCode = mysqli_real_escape_string($db, $_POST['productCode']);

  if (empty($productCode)) { 
    array_push($errors, "Product code should not be empty"); 
  }
  if ($_SESSION['username'] != "dushyantha1208@gmail.com" && $_SESSION['username'] != "uoc") { 
    array_push($errors, "You don't have delete permissions");
  }

  //check given product code is correct or not
  $product_check_query = "SELECT * FROM products WHERE PRODUCT_CODE='$productCode' LIMIT 1";
  
  if (!mysqli_query($db, $product_check_query)) {
    array_push($errors, "No data found for the given product code");
  }

  if (count($errors) == 0) {
  	$delete_query = "DELETE FROM products WHERE PRODUCT_CODE='$productCode' ";
    if (mysqli_query($db, $delete_query)) {
      array_push($successes, "Product has been deleted Successfully.");
      array_push($success_message, "Product Successfully deleted.");
    }
  } else {
      array_push($error_message, "Product not deleted.");
  }
}

//Stock Managemnet related database queries
  //add stock to the database
if (isset($_POST['addStockbtn'])) {

  $stockName = mysqli_real_escape_string($db, $_POST['stockName']);
  $stockSize = mysqli_real_escape_string($db, $_POST['stockSize']);
  $stockCode = mysqli_real_escape_string($db, $_POST['stockCode']);
  $stockStatus = mysqli_real_escape_string($db, $_POST['stockStatus']);
  $availableQ = mysqli_real_escape_string($db, $_POST['availableQ']);
  $usedQ = mysqli_real_escape_string($db, $_POST['usedQ']);
  $pendingUseQ = mysqli_real_escape_string($db, $_POST['pendingUseQ']);
  $stockSuplierName = mysqli_real_escape_string($db, $_POST['stockSuplierName']);

  if (empty($stockName)) { 
    array_push($errors, "Stock name should not be empty"); 
  }
  if (empty($stockCode)) { 
    array_push($errors, "Stock code should not be empty"); 
  }
  if (empty($stockStatus)) { 
    $stockStatus = "ACTIVE";
  }
  if (empty($stockSuplierName)) { 
    array_push($errors, "Stock supplier name should not be empty"); 
  }
  $createdTimestamp = date("d/m/Y h:m:s");
  $createdBy = $_SESSION['username'];

  //get stock supplier user Id
  $get_supplier_id_query = "SELECT * FROM user WHERE USERNAME='$stockSuplierName' ";
  $supIdExcute = mysqli_query($db, $get_supplier_id_query);
  $supIdArray = mysqli_fetch_assoc($supIdExcute);
  $supId = $supIdArray['USER_ID'];

  //check already saved data
  $stock_check_query = "SELECT * FROM stock WHERE M_CODE='$stockCode' ";
  $result = mysqli_query($db, $stock_check_query);
  $stock = mysqli_fetch_assoc($result);
  
  if ($stock) {
    if ($stock['M_CODE'] === $stockCode && $stock['M_NAME'] === $stockName) {
      array_push($errors, "Given stock already exists");
    }
  }

  if (count($errors) == 0) {
    $insert_query = "INSERT INTO stock(M_NAME, ALL_Q, M_CODE, CREATED_BY, M_STATUS, CREATED_TIMESTAMP, AVAILABLE_Q, USED_Q, PENDING_USE_Q, USER_ID) 
              VALUES('$stockName', '$stockSize', '$stockCode', '$createdBy', '$stockStatus', '$createdTimestamp', '$availableQ', '$usedQ', '$pendingUseQ', $supId)";
    if (mysqli_query($db, $insert_query)) {
      array_push($successes, "Stock has been saved Successfully.");
      array_push($success_message, "Stock Successfully saved.");
    }
  } else {
      array_push($error_message, "Stock not saved.");
  }
}

//update stock to the database
if (isset($_POST['updateStockbtn'])) {

  //$stockType = mysqli_real_escape_string($db, $_POST['stockType']);
  $stockName = mysqli_real_escape_string($db, $_POST['stockName']);
  $stockSize = mysqli_real_escape_string($db, $_POST['stockSize']);
  // $description = mysqli_real_escape_string($db, $_POST['description']);
  $stockCode = mysqli_real_escape_string($db, $_POST['stockCode']);
  $stockStatus = mysqli_real_escape_string($db, $_POST['stockStatus']);
  $availableQ = mysqli_real_escape_string($db, $_POST['availableQ']);
  $usedQ = mysqli_real_escape_string($db, $_POST['usedQ']);
  $pendingUseQ = mysqli_real_escape_string($db, $_POST['pendingUseQ']);
  $stockSuplierName = mysqli_real_escape_string($db, $_POST['stockSuplierName']);

  if (empty($stockName)) { 
    array_push($errors, "Stock name should not be empty"); 
  }
  if (empty($stockCode)) { 
    array_push($errors, "Stock code should not be empty"); 
  }
  if ($stockStatus != "Available" && $stockStatus != "Ready to Pick" && $stockStatus != "Surplus" && $stockStatus != "Deficiency") { 
    array_push($errors, "Stock status should be given format"); 
  }
  if (empty($stockSuplierName)) { 
    array_push($errors, "Stock supplier name should not be empty"); 
  }
  $updatedTimestamp = date("d/m/Y h:m:s");
  $updatedBy = $_SESSION['username'];

  //get stock supplier user Id
  $get_supplier_id_query = "SELECT * FROM user WHERE USERNAME='$stockSuplierName' ";
  $supIdExcute = mysqli_query($db, $get_supplier_id_query);
  $supIdArray = mysqli_fetch_assoc($supIdExcute);
  $supId = $supIdArray['USER_ID'];

  //check already saved data
  $stock_check_query = "SELECT * FROM stock WHERE M_CODE='$stockCode' ";
  $result = mysqli_query($db, $stock_check_query);
  $stock = mysqli_fetch_assoc($result);
  
  if ($stock) {
    if ($stock['AVAILABLE_Q'] == $availableQ && $stock['M_STATUS'] == $stockStatus && $stock['USED_Q'] == $usedQ  
    && $stock['PRODUCT_NAME'] == $stockName && $stock['PENDING_USE_Q'] == $pendingUseQ) {
      array_push($errors, "Given stock data already exists");
    }
  }

  if (count($errors) == 0) {
    $update_query = "UPDATE stock SET M_NAME='$stockName', AVAILABLE_Q='$availableQ', UPDATED_TIMESTAMP='$updatedTimestamp', 
    UPDATED_BY='$updatedBy', M_STATUS='$stockStatus', USED_Q='$usedQ', PENDING_USE_Q='$pendingUseQ', USER_ID='$supId' WHERE M_CODE='$stockCode'";
    if (mysqli_query($db, $update_query)) {
      array_push($successes, "Stock data has been updated Successfully.");
      array_push($success_message, "Stock Successfully updated.");
    }
  } else {
      array_push($error_message, "Stock not updated.");
  }
}

//delete stock in the database
if (isset($_POST['deleteStockbtn'])) {
  
  $stockCode = mysqli_real_escape_string($db, $_POST['stockCode']);

  if (empty($stockCode)) { 
    array_push($errors, "Stock code should not be empty"); 
  }
  if ($_SESSION['username'] != "dushyantha1208@gmail.com" && $_SESSION['username'] != "uoc") { 
    array_push($errors, "You don't have delete permissions");
  }

  //check given stock code is correct or not
  $stock_check_query = "SELECT * FROM stock WHERE M_CODE='$stockCode' LIMIT 1";
  
  if (!mysqli_query($db, $stock_check_query)) {
    array_push($errors, "No data found for the given stock code");
  }

  if (count($errors) == 0) {
  	$delete_query = "DELETE FROM stock WHERE M_CODE='$stockCode' ";
    if (mysqli_query($db, $delete_query)) {
      array_push($successes, "Stock data has been deleted Successfully.");
      array_push($success_message, "Stock Successfully deleted.");
    }
  } else {
      array_push($error_message, "Stock not deleted.");
  }
}

?>