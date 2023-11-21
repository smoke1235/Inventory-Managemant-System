<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | New Order</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <h1>New Draft Order</h1>
            <div class="order-form-container">
                <form action="" method="">
                    <div class="order-form-header">
                        <h2>Customer</h2>
                        <select name="" id="">
                            <option value="0">None</option>
                            <option value="1">I❤️U</option>
                        </select>
                        <h2>Shipping Address</h2>
                        <h2>Billing Address</h2>
                        <input type="text" placeholder="Name">
                        <input type="text" placeholder="Street">
                        <input type="text" name="" placeholder="Postal Code">
                        <input type="text" placeholder="City">
                        <input type="text" placeholder="Country">
                    </div>
                    <br><hr>
                    <div class="order-form-content">
                        <table aria-label="">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4"><a href="">Add Product</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>

            </div>
        </main>
    </div>
</body>

</html>
