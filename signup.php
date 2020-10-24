<?php
    include('db.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="signup.css">
    <link rel="stylesheet" type="text/css" href="common.css">
    <title>Sign Up</title>
    <script>

    </script>
</head>
<body>
    <div class="signup">
        <div class="form">
            <form method="post" action="signup.php">
                <p style="font-size: 30px; text-align: center;"><strong>Create an Account</strong></p>
                <div>
                    <?php include('errors.php'); ?>
                    <div class="input-group">
                        <input type="text" name="name" placeholder="Name">
                    </div>
                    <div class="input-group">
                        <input type="text" name="username" placeholder="Username">
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <div class="input-group">
                        <input type="text" name="country" placeholder="Country">
                    </div>
                    <div class="input-group">
                        <input type="password" name="password1" placeholder="Password">
                    </div>
                    <div class="input-group">
                        <input type="password" name="password2" placeholder="Comfirm Password">
                    </div>
                    <div class="input-group">
                        <p style="color: #e9f71e; font-size: 18px; text-align: center;">
                        If your user type is supplier then tick the button</p>
                        <div class="check">
                            <input type="checkbox" id="sales" name="type" value="Supplier">
                        </div>
                    </div>
                    <div class="msg">
                        <label>If you are a customer, no need to fill following details.</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="phone" placeholder="Mobile Number">
                    </div>
                    <div class="input-group">
                        <input type="text" name="address" placeholder="Address">
                    </div>
                    <div class="input-group">
                        <input type="text" name="nic" placeholder="NIC">
                    </div>
                    <div>
                        <input type="submit" name="signupbtn" value="SignUp">
                    </div>
                    <div>
                        <p>Already have an account? <a href="login.php" style="color: #02e9f5;"><strong>Sign in</strong></a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
