<?php
    session_start();
?>
<html>
<head>
    <style>
        table {
            padding: 20px;
            margin-top: 200px;
            width: 100%;
		    border-collapse: collapse;
        }

        th, td {
            font-family: Verdana, Geneva, Tahoma, sans-serif, Helvetica, sans-serif;
            color: black;
            font-weight: bold;
            padding: 10px;
			border-bottom: 2px solid #ddd;
        }

        th {
            font-size: 15px;
            padding: 15px;
            background-color: #cecef2;
        }

        tr {
            font-family: Verdana, Geneva, Tahoma, sans-serif, Helvetica, sans-serif;
            text-align: center;
        }
        
		tr:hover {
			background-color:#98f5d7;
		}
    </style>
</head>
<body>
<?php
include('header.php');
include('dbConn.php');
?>
<?php if (isset($_SESSION['username'])) : ?>

    <script>
    document.getElementById("sup").classList.add("active");
    </script>

    <?php
    $result = mysqli_query($db, "SELECT U.F_NAME, U.COUNTRY, U.U_STATUS, S.M_NAME FROM user U LEFT JOIN stock S ON U.USER_ID = S.USER_ID WHERE USER_TYPE='Supplier'");

    echo "<table>
    <tr><th colspan='4' style='font-size: 25px; background-color: #7476f2'>Suppliers Details</th></tr>
    <tr>
    <th>Name</th>
    <th>COUNTRY</th>
    <th>Supplier Status</th>
    <th>Material Of Supply</th>

    </tr>";

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['F_NAME'] . "</td>";
    echo "<td>" . $row['COUNTRY'] . "</td>";
    echo "<td>" . $row['U_STATUS'] . "</td>";
    echo "<td>" . $row['M_NAME'] . "</td>";

    echo "</tr>";
    }
    echo "</table>";
    ?>

    <?php if (isset($_SESSION['type'])) : ?>
        <?php if ($_SESSION['type'] == "Supplier" || $_SESSION['type'] == "ADMIN") : ?>
            <?php
                $userNa = $_SESSION['username'];
                $material_supplier = "SELECT * FROM stock WHERE USER_ID=(SELECT USER_ID FROM user WHERE USERNAME='$userNa')";
                $stock_result = mysqli_query($db, $material_supplier);
                echo "<table style='margin-top: 100px;'>
                <tr><th colspan='7' style='font-size: 25px; background-color: #7476f2'>Stock Details For Supplier</th></tr>
                <tr>
                <th>Material Code</th>
                <th>Material Name</th>
                <th>Available Quantity</th>
                <th>Used Quantity</th>
                <th>Pending To Use Quantity</th>
                <th>Material Status</th>
                
                </tr>";
                
                while($stock_row = mysqli_fetch_array($stock_result))
                {
                echo "<tr>";
                echo "<td>" . $stock_row['M_CODE'] . "</td>";
                echo "<td>" . $stock_row['M_NAME'] . "</td>";
                echo "<td>" . $stock_row['AVAILABLE_Q'] . "</td>";
                echo "<td>" . $stock_row['USED_Q'] . "</td>";
                echo "<td>" . $stock_row['PENDING_USE_Q'] . "</td>";
                echo "<td>" . $stock_row['M_STATUS'] . "</td>";
                
                echo "</tr>";
                }
                echo "</table>";
            ?>
        <?php endif ?>
    <?php endif ?>
<?php endif ?>
</body>
</html>