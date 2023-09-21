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
                <li><a href="">Dashboard</a></li>
                <li><a href="">Customer</a></li>
                <li><a href="">Supplier</a></li>
                <li><a href="">Catergory</a></li>
                <li><a href="">Stock</a></li>
                <li><a href="">Sells</a></li>
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
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Date</th>
                    </tr>
                    <tr>
                        <td>
                            <a href="">2</a>
                        </td>
                        <td>
                            <a href="">2</a>
                        </td>
                        <td>
                            <a href="">3</a>
                        </td>
                    </tr>
                    <tr>
                        <td>john</td>
                        <td>alex</td>
                        <td>anne</td>
                    </tr>
                </table>
            </div>
        </header>
        <footer>
            <h3>Inventory Manager</h3>
            <p>If problems ocurr contact the admin</p>
        </footer>
    </body>
</html>