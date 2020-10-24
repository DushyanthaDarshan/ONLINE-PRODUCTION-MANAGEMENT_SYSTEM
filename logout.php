
<html>
<head>
    <?php
		session_start();
        include('dbConn.php');
        $logOutTimestamp = date("d/m/Y h:m:s");
        $login_id = $_SESSION['username'];
        echo "aaaaaaaaaaa";
        $update_log = "UPDATE login_track SET OUT_TIMESTAMP='$logOutTimestamp' WHERE USERNAME_OR_ID='$login_id'";
        mysqli_query($db, $update_log);
        session_destroy();
        unset($_SESSION['username']);
        header("location:login.php");
    ?>
</head>
</html>