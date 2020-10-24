<?php
	session_start();
	include_once('header.php');
	include("dbConn.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Help Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
		document.getElementById("hel").classList.add("active");
	    </script>
        <style>
            .fulBlock {
                margin-top: 230px
            }

            .blck {
                padding: 10px;
            }

            fieldset {
                radius: 10px;
            }

            legend {
                margin-left: 50px;
                font-size: 22px;
                color: #000000;
            }

            p {
                margin-left: 100px;
                font-size: 18px;
                text-align: center;
            }
        </style>
</head>
<body>
<?php if (isset($_SESSION['username'])) : ?>
    <div class="fulBlock">
        <form>
            <fieldset>
                <legend>For Admins:</legend>
                <p>Only Admin account holder can access all the pages without user page. 
                When admin login to the site redirecting to the admin page. 
                Admin page can be accessed only admin account holders. Admin can update their account, 
                can access to user delete features, product realated details and stock related 
                details with thire features.</p>
            </fieldset>

            <fieldset>
                <legend>For Suppliers:</legend>
                <p>In very first time logging, he cannot suggest their products. After created the account, 
                admin panel call them for get more details about them and their raw materials. 
                <strong>So please wait patiently...</strong></p>
            </fieldset>

            <fieldset>
                <legend>For Users:</legend>
                <p>Users only can see our products details. And users can see who are the suppliers of ours. 
                All supplier details cannot see you but some can. This detail help you for trust our product 
                quality and naturality..</p>
                <p>And users cannot delete their accounts. If you need to delete your account then send us a 
                comment with reason.</p>
            </fieldset>
        </form>
    </div>
<?php endif ?>
</body>
</html>