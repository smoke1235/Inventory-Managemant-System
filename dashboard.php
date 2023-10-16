<?php
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
                <div class="products-button">
                    <?php
                    $sql = "SELECT COUNT(productName) AS total FROM products;";
                    $result = mysqli_query($con, $sql);
                    $data = mysqli_fetch_assoc($result);
                    ?>
                    <a href="products.php">
                        <h3>
                            <?php
                            echo $data['total'];
                            ?>
                        </h3>
                        <p>Totale products</p>
                    </a>
                </div>
                <div class="customers-button">
                    <?php
                    $sql = "SELECT COUNT(first_name) AS total FROM customers;";
                    $result = mysqli_query($con, $sql);
                    $data = mysqli_fetch_assoc($result);
                    ?>
                    <a href="customers.php">
                        <h3>
                            <?php
                            echo $data['total'];
                            ?>
                        </h3>
                        <p>Totale Customers</p>
                    </a>
                </div>
                <div class="suppliers-button">
                    <?php
                    $sql = "SELECT COUNT(name) AS total FROM suppliers;";
                    $result = mysqli_query($con, $sql);
                    $data = mysqli_fetch_assoc($result);
                    ?>
                    <a href="suppliers.php">
                        <h3>
                            <?php
                            echo $data['total'];
                            ?>
                        </h3>
                        <p>Totale Suppliers</p>
                    </a>
                </div>
            </div>
            <div class="dashboard-table">
                <h2>Recently added products</h2>
                <?php
                $sql =
                    "SELECT products.id, products.productName, products.product_description,
                products.quantity, products.product_price, products.other_details, suppliers.name, date
                FROM products
                INNER JOIN suppliers
                ON products.supplier_id=suppliers.id
                ORDER BY date DESC LIMIT 0,30";
                $result = $con->query($sql);
                if (!$result) {
                    die("Invalid quary: " . $con->error);
                }
                ?>
                <table>
                    <tr>
                        <th class="Number">No.</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Supplier</th>
                    </tr>
                    <?php while ($rows = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $rows['id']; ?>
                            </td>
                            <td>
                                <?php echo $rows['productName']; ?>
                            </td>
                            <td>
                                <?php echo $rows['product_description']; ?>
                            </td>
                            <td>
                                <?php echo $rows['quantity']; ?>
                            </td>
                            <td>
                                <?php echo $rows['product_price']; ?>
                            </td>
                            <td>
                                <?php echo $rows['name']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </main>
    </div>
</body>

</html>