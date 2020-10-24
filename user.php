<?php
	session_start();
	include_once('header.php');
	include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<script>
		document.getElementById("usr").classList.add("active");
    </script>
    <style>
        .userUpdate {
            margin-top: 230px;
            background: #7b42ed;
            width: 350px;
            height: auto;
            padding: 15px;
            margin-left: 450px;
            display: inline-table;
            box-shadow: 5px 10px 8px rgba(0, 0, 128, 0.5);
            color: #000000;
        }

        input {
            width: 350px;
            text-align: center;
            font-size: 18px;
            padding: 10px;
            margin-top: 10px;
            color: #000000;
        }

        fieldset {
            width: 350px;
        }

        input[type="submit"] {
            border: none;
            width: 250px;
            background: #09D9F9;
            color: #1D09F9;
            cursor: pointer;
            font-size: 20px;
            font-weight: bald;
            line-height: 25px;
            padding: 5px;
            border-radius: 5px;
            margin-left: 100px;
        }

        input[type="submit"]:hover {
            color: #FFFFFF;
            background-color: #A109F9;
        }

        .error {
            background-color: #F90919; 
            width: 90%; 
            border: 1px solid #F90919; 
            height: 30px; 
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 0px;
            padding: 10px;
            padding-top: 0px;
            margin-bottom: 5px;
        }

        .success {
            background-color: #09f925; 
            width: 90%; 
            border: 1px solid #09f925; 
            height: 30px; 
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 0px;
            padding: 10px;
            padding-top: 0px;
            margin-bottom: 5px;
        }
    </style>
</head>
<?php if (isset($_SESSION['username'])) : ?>
    <body>
        <div class="userUpdate">
            <form method="post" action="db.php" style="width: 430px;">
            <p style="font-size: 30px; text-align: center;"><strong>Update Profile</strong></p>
            <p style="font-size: 18px; text-align: center;">
            <strong>Cannot update username. Enter username of account that you want to update</strong></p>

            <?php 
                $user = $_SESSION['username'];

                //get stock supplier user Id
                $get_query = "SELECT * FROM user WHERE USERNAME='$user' ";
                $userExcute = mysqli_query($db, $get_query);
                $rows = mysqli_fetch_assoc($userExcute);
            ?>
            <fieldset>
                <legend>Name</legend>
                <input type="text" name="name" placeholder="<?php echo $rows['F_NAME'] ?>">
            </fieldset>

            <fieldset>
                <legend>Email</legend>
                <input type="text" name="email" placeholder="<?php echo $rows['EMAIL'] ?>">
            </fieldset>
            
            <fieldset>
                <legend>Country</legend>
                <input type="text" name="country" placeholder="<?php echo $rows['COUNTRY'] ?>">
            </fieldset>

            <fieldset>
                <legend>Password</legend>
                <input type="password" name="password1" placeholder="Password">
            </fieldset>
            
            <fieldset>
                <legend>Comfirm Password</legend>
                <input type="password" name="password2" placeholder="Comfirm Password">
            </fieldset>

            <fieldset>
                <legend>Phone Number</legend>
                <input type="text" name="phone" placeholder="<?php echo $rows['PHONE_NUMBER'] ?>">
            </fieldset>

            <fieldset>
                <legend>Address</legend>
                <input type="text" name="address" placeholder="<?php echo $rows['U_ADDRESS'] ?>">
            </fieldset>

            <fieldset>
                <legend>NIC</legend>
                <input type="text" name="nic" placeholder="<?php echo $rows['NIC'] ?>"><br><br>
            </fieldset>
            
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
            <input type="submit" name="updateUserbtn" value="Update">
            </form>
        </div>
<?php endif ?>
</body>