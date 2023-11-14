<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../config/connect.php';

$search= '';
$sql = "SELECT product_name, name FROM products
INNER JOIN suppliers ON products.supplier_id=suppliers.id
WHERE (products.product_name LIKE \'%$search%\' OR name LIKE \'%$search%\');";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/main.css">
    <title>Iventory Manager | Search</title>
    <meta name="description" content="">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <h1>Search Items</h1>
            <div class="seacrh-container">
                <form class="search-form" id="search-form" method="POST">
                    <input type="text" name="search" placeholder="Search for products, Customers & Suppliers.">
                    <button><ion-icon name="search-sharp"></ion-icon></button>
                </form>
            </div>
            <div class="result-container">
                <div class="result-product">
                    <h2>Products results</h2>
                    <div class="results-table">
                        <table aria-label="">
                            <thead>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <hr>
                </div>
                <div class="result-customer">
                    <h2>Customer results</h2>
                    <div class="results-table">
                        <table aria-label="">
                            <thead>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Quantity</th>
                                <th>Email</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="result-supplier">
                    <h2>Supplier results</h2>
                    <div class="results-table">
                        <table aria-label="">
                            <thead>
                                <th>Name.</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Price</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
