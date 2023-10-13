<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'inventoryManager';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <meta name="discription" content="">
    <link href="Assets/CSS/main.css" rel="stylesheet">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once 'navbar.php'; ?>
        <main>
            <h1>Welcome,
                <?= $_SESSION['name'] ?>!
            </h1>
            <div class="board">
                <div class="Products-button">
                    <?php
                    $sql = "SELECT COUNT(productName) AS total FROM products;";
                    $result = mysqli_query($con, $sql);
                    $data = mysqli_fetch_assoc($result);
                    ?>
                    <a href="products.php">
                        <?php
                        echo $data['total'];
                        ?>
                         Totale products
                    </a>
                </div>
                <div class="customers-button">
                    <?php
                    $sql = "SELECT COUNT(first_name) AS total FROM customers;";
                    $result = mysqli_query($con, $sql);
                    $data = mysqli_fetch_assoc($result);
                    ?>
                    <a href="customers.php">
                        <?php
                        echo $data['total'];
                        ?>
                         Totale Customers
                    </a>
                </div>
                <div class="suppliers-button">
                    <?php
                    $sql = "SELECT COUNT(name) AS total FROM suppliers;";
                    $result = mysqli_query($con, $sql);
                    $data = mysqli_fetch_assoc($result);
                    ?>
                    <a href="suppliers.php">
                        <?php
                        echo $data['total'];
                        ?>
                         Totale Suppliers
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>