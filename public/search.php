<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
    exit;
}
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
                <form class="search-form" id="search-form" >
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
                                <?php
                                if (isset($_POST['search'])) {
                                    require '../src/productSearch.php';
                                    if (count($results) > 0) {
                                        foreach ($results as $row) {
                                ?>
                                <td>
                                    <?php echo $row['id'];?>
                                    <?php echo $row['product_name'];?>
                                    <?php echo $row['product_quantity'];?>
                                    <?php echo $row['product_price'];?>
                                </td>
                                <?php
                                        }
                                    } else {
                                        echo "<td>No results found</td>";
                                    }
                                }
                                ?>

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
