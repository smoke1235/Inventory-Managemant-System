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
            <div class="order-title">
                <h1>New Order</h1>
                <section class="">
                    <a href="orders.php">Cancel</a>
                    <input type="submit" name="submit" value="Save" form="create-order">
                </section>
            </div>
            <div class="order-form-container">
                <form action="" method="" id="create-order">
                    <div class="order-form-header">
                        <section class="order-form-customer">
                            <h2>Customer</h2>
                            <select name="customer-select" id="customer-select" onchange="customerChange(this.value)">
                                <option value="0">None</option>
                            <?php
                                include_once '../src/fetch-customers.php';
                                foreach ($options as $option) {
                                    ?>
                                    <option value="<?php echo $option['id']; ?>">
                                        <?php echo $option['first_name'] . ' ' . $option['last_name']; ?>
                                    </option>
                                    <?php
                                }
                            ?>
                            </select>
                        </section>
                        <section class="order-form-shipping">
                            <h2>Shipping Address</h2>
                            <input type="text" placeholder="Name">
                            <input type="text" placeholder="Street">
                            <input type="text" name="" placeholder="Postal Code">
                            <input type="text" placeholder="City">
                            <input type="text" placeholder="Country">
                        </section>
                        <section class="order-form-billing">
                            <h2>Billing Address</h2>
                            <input type="text" placeholder="Name">
                            <input type="text" placeholder="Street">
                            <input type="text" name="" placeholder="Postal Code">
                            <input type="text" placeholder="City">
                            <input type="text" placeholder="Country">
                        </section>
                        <section class="order-form-status">
                            <h2>Status</h2>
                            <select name="order-status">
                                <option value="6">IN PROCESS</option>
                                <option value="3">PAID</option>
                                <option value="4">RETURNED</option>
                                <option value="5">CLOSED</option>
                                <option value="7">ARCHIEVED</option>
                            </select>
                        </section>
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
