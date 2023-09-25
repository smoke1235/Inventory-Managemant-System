<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if ( !isset($_SESSION['loggedin']) ) {
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
        <link href="SCSS/main.scss" rel="stylesheet">
    </head>
    <body>
    <nav aria-label="nav-top" class="nav-top">
            <a href="home.php"><h1>Website Title</h1></a>
            <ul>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <nav aria-label="nav-left" class="nav-left">
            <ul>
                <li><a href="home.php">Dashboard</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="stock.php">Stock</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="suppliers.php">Suppliers</a></li>
            </ul>
        </nav>
        <header>
            <h1>Welcome, <?=$_SESSION['name']?>!</h1>
            <div class="board">
                <div class="customer">
                    <a href="">Totale customers</a>
                </div>
                <div class="supplier">
                    <a href="">Totale suppliers</a>
                </div>
                <div class="sells">
                    <a href="">Sells this month</a>
                </div>
                <div class="purchase">
                    <a href="">Purchases this month</a>
                </div>
            </div>
            <div class="recent-order-list">
                <h2>Recent orders</h2>
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Date</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>01-01-2023</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Alex Doe</td>
                        <td>01-01-2023</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Anna Doe</td>
                        <td>05-01-2023</td>
                    </tr>
                </table>
            </div>
        </header>
        <footer>
            <h3>Inventory Manager</h3>
            <p>If problems ocurr contact the admin</p>
            <a href="mailto:email@example.com">Send Email</a>
        </footer>
    </body>
</html>