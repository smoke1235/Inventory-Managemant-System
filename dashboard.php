<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
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
            <h1>Welcome,<?= $_SESSION['name'] ?>!</h1>
            <div class="board">
                <div class="Products-button">
                    <?php
                    $products_counter = 'SELECT * FROM products';
                    ?>
                    <a href="products.php">Totale products</a>
                </div>
                <div class="customers-button">
                    <a href="suppliers.php">Totale Customers</a>
                </div>
                <div class="suppliers-button">
                    <a href="">Totale Suppliers</a>
                </div>
            </div>
        </main>
    </div>
    <?php include_once 'footer.php'; ?>
</body>

</html>