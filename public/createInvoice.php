<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/connect.php';
include_once '../src/fetch-customers.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | New Order</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="../assets/CSS/main.css">
    <script src="../assets/js/populateTextInput.js"></script>
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
                <form action="" id="create-order" method="POST">
                    <div class="order-form-header">
                        <section class="order-form-customer">
                            <h2>Customer</h2>
                            <select name="customer-select" id="customer-select" onchange="populateTextInput()">
                                <option value="0">None</option>
                            <?php
                                foreach ($options as $option) {
                                    ?>
                                    <option value="<?php echo $option['id']; ?>">
                                        <?php echo $option['first_name'] . ' ' . $option['last_name']; ?>
                                    </option>
                                    <?php
                                }
                            ?>
                            </select>
                            <h3>Contact Info</h3>
                            <input type="text" name="customer_number" id="customer_number">
                            <input type="text" name="customer_email" id="customer_email">
                        </section>
                        <section class="order-form-shipping">
                            <h2>Shipping Address</h2>
                            <input type="text" name="shipping_name" id="shipping_name" placeholder="Full Name">
                            <input type="text" name="shipping_company" id="shipping_company" placeholder="Compamy name">
                            <input type="text" name="shipping_street" id="shipping_street" placeholder="Street">
                            <input type="text" name="shipping_postalcode" id="shipping_postalcode" placeholder="Postal Code">
                            <input type="text" name="shipping_city" id="shipping_city" placeholder="City">
                            <input type="text" name="shipping_country" id="shipping_country" placeholder="Country">
                        </section>
                        <section class="order-form-billing">
                            <h2>Billing Address</h2>
                            <input type="text" name="billing_name" id="billing_name" placeholder="Full Name">
                            <input type="text" name="billing_company" id="billing_company" placeholder="Company Name">
                            <input type="text" name="billing_street" id="billing_street" placeholder="Street">
                            <input type="text" name="billing_postalcode" id="billing_postalcode" placeholder="Postal Code">
                            <input type="text" name="billing_city" id="billing_city" placeholder="City">
                            <input type="text" name="billing_country" id="billing_country" placeholder="Country">
                        </section>
                        <section class="order-form-status">
                            <h2>Status</h2>
                            <select name="order-status">
                                <option value="6">IN PROCESS</option>   
                                <option value="8">SHIPPING</option>
                                <option value="9">SHIPPED</option>
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
                            <tbody id="formField">
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
