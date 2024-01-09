<?php
require_once '../src/inc/session_check.php';
include_once '../src/fetch-customers.php';

$invoice_id = $_GET['id'];
$sql1 = "SELECT *,
`invoices`.`id` AS `invoice_id`,
`invoices`.`created` AS `invoice_created`,
`invoices`.`status` AS `invoice_status` FROM invoices
INNER JOIN invoice_status ON invoices.status=invoice_status.id
INNER JOIN customers ON invoices.customer_id=customers.id
INNER JOIN users ON invoices.user_id=users.id
WHERE `invoices`.`id` = '$invoice_id'";
$inv_result = $con->query($sql1);
$row = $inv_result->fetch_assoc();

$fetch_items = "SELECT *, products.id AS product_nmr FROM invoice_line
INNER JOIN products ON invoice_line.product_id=products.id
WHERE invoice_id = '$invoice_id'";
$item_result = $con->query($fetch_items);
while ($array = $item_result->fetch_assoc()) {
    $items[] = $array;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | Edit Invoice</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="../assets/CSS/main.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../assets/js/populateTextInput.js"></script>
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <div id="myModal" class="modal">
                <?php include_once '../include/invoiceInsertProduct.php'; ?>
            </div>
            <div class="order-title">
                <h1>Edit Invoice</h1>
                <section>
                    <a href="invoice.php">Cancel</a>
                    <input type="submit" name="submit" value="Save" form="create-invoice">
                </section>
            </div>
            <div class="order-form-container">
                <form action="../src/editInvoiceForm.php" id="create-invoice" method="POST">
                    <input type="hidden" name="hidden" value="<?php echo $invoice_id; ?>">
                    <div class="order-form-header">
                        <section class="order-form-customer">
                            <h2>Customer</h2>
                            <select name="customer_select" id="customer-select" onchange="populateTextInput()">
                                <option value="<?php echo $row['customer_id']; ?>">
                                    <?php echo $row['first_name'] . ' ' . $row['last_name']; ?> (draft)
                                </option>
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
                            <input type="text" name="customer_number" id="customer_number"
                                value="<?php echo $row['number']; ?>">
                            <input type="text" name="customer_email" id="customer_email"
                                value="<?php echo $row['mail']; ?>">
                        </section>
                        <section class="order-form-shipping">
                            <h2>Shipping Address</h2>
                            <input type="text" name="shipping_name" id="shipping_name" placeholder="Full Name"
                                value="<?php echo $row['shipping_name']; ?>">
                            <input type="text" name="shipping_company" id="shipping_company" placeholder="Compamy name"
                                value="<?php echo $row['shipping_company']; ?>">
                            <input type="text" name="shipping_street" id="shipping_street" placeholder="Street"
                                value="<?php echo $row['shipping_street']; ?>">
                            <input type="text" name="shipping_postalcode" id="shipping_postalcode"
                                placeholder="Postal Code" value="<?php echo $row['shipping_postalcode']; ?>">
                            <input type="text" name="shipping_city" id="shipping_city" placeholder="City"
                                value="<?php echo $row['shipping_city']; ?>">
                            <input type="text" name="shipping_country" id="shipping_country" placeholder="Country"
                                value="<?php echo $row['shipping_country']; ?>">
                        </section>
                        <section class="order-form-billing">
                            <h2>Billing Address</h2>
                            <input type="text" name="billing_name" id="billing_name" placeholder="Full Name"
                                value="<?php echo $row['billing_name']; ?>">
                            <input type="text" name="billing_company" id="billing_company" placeholder="Company Name"
                                value="<?php echo $row['billing_company']; ?>">
                            <input type="text" name="billing_street" id="billing_street" placeholder="Street"
                                value="<?php echo $row['billing_street']; ?>">
                            <input type="text" name="billing_postalcode" id="billing_postalcode"
                                placeholder="Postal Code" value="<?php echo $row['billing_postalcode']; ?>">
                            <input type="text" name="billing_city" id="billing_city" placeholder="City"
                                value="<?php echo $row['billing_city']; ?>">
                            <input type="text" name="billing_country" id="billing_country" placeholder="Country"
                                value="<?php echo $row['billing_country']; ?>">
                        </section>
                        <section class="order-form-status">
                            <h2>Status</h2>
                            <select name="invoice_status">
                                <option value="<?php echo $row['invoice_status']; ?>">
                                    <?php echo $row['status']; ?> (Previously saved)
                                </option>
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
                    <br>
                    <hr>
                    <div class="order-form-content">
                        <table aria-label="">
                            <thead>
                                <tr>
                                    <th id="inv-action"></th>
                                    <th id="inv-name">Name</th>
                                    <th id="inv-descr">Description</th>
                                    <th id="inv-qty">Qty</th>
                                    <th id="inv-prc">Price</th>
                                </tr>
                            </thead>
                            <tbody id="item_results">
                                <?php
                                    $n = 0;
                                    foreach ($items as $item) {
                                        echo '<tr id="item-'.$n.'">';
                                        echo '<td><a href="#" onclick="removeItem('. $n .')"> Remove</a></td>';
                                        echo '<td><p>'.$item['product_name'].'</p></td>';
                                        echo '<input type="hidden" name="product[]" value="'.$item['product_nmr'].'">';
                                        echo '<td><p>'.$item['product_description'].'</p></td>';
                                        echo '<td><input type="number" name="qty[]" id="input-qty"
                                        value="'.$item['quantity'].'"></td>';
                                        echo '<td><p>'.$item['product_price'].'</p></td>';
                                        echo '</tr>';
                                        $n++;
                                    }
                                ?>
                                <tr>
                                    <td colspan="5"><a href="#" id="btn">Add product</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="../assets/js/productSelectorPopup.js"></script>
    <script src="../assets/js/showProductResult.js"></script>
</body>

</html>
