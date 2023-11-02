<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
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
    <title>Dashboard</title>
    <meta name="discription" content="">
    <link href="../assets/CSS/main.css" rel="stylesheet">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main>
            <h1>Welcome,
                <?= $_SESSION['name'] ?>!
            </h1>
            <div class="board">
                <div class="products-button">
                    <?php
                    $sql = "SELECT COUNT(product_name) AS total FROM products;";
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
                <div class="table-container">
                    <table id="dashboard-table" class="dashboard-table"
                        aria-label="A table that shows newly 30 newly added products">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Supplier</th>
                            </tr>
                        </thead>
                        <?php
                        $sql =
                            "SELECT products.id, products.product_name, products.product_description,
                            products.product_quantity, products.product_price, products.other_details,
                            suppliers.name, date
                            FROM products
                            INNER JOIN suppliers
                            ON products.supplier_id=suppliers.id
                            ORDER BY date DESC LIMIT 0,30";
                        $result = $con->query($sql);
                        ?>
                            <tbody>
                                <?php while ($rows = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?php echo $rows['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rows['product_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rows['product_description']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rows['product_quantity']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rows['product_price']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rows['name']; ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
