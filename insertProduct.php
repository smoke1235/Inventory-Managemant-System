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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="Assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once 'navbar.php'; ?>
        <main>
            <h1>Add new products</h1>
            <div class="form-container">
                <form action="searchSupplier.php" method="POST">
                    <input type="text" name="quary">
                    <input type="submit" value="Search">
                </form>
            </div>
        </main>
    </div>
</body>

</html>