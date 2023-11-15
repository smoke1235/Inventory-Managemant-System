<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/connect.php';

$sql = "SELECT * FROM orders
INNER JOIN order_catergory ON orders.catergory=order_catergory.id
INNER JOIN customers ON orders.customer_id=customers.id
INNER JOIN products ON orders.product_id=products.id
INNER JOIN users ON orders.user_id=users.id
ORDER BY updated DESC";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | Orders</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <h1>Orders</h1>
            <a class="new-data" href="">Add</a>
            <div class="table-container">
                <table aria-label="">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th>Total Price</th>
                            <th>Order started</th>
                            <th>Expected Delivery</th>
                        </tr>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()) {?>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $row['order_number']; ?>
                            </td>
                            <td>
                                <?php echo $row['status']; ?>
                            </td>
                            <td>
                                <?php echo $row['company_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['unit_price']; ?>
                            </td>
                            <td>
                                <?php echo $row['created']; ?>
                            </td>
                            <td>
                                <?php echo $row['expected']; ?>
                            </td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </main>
    </div>
</body>
</html>