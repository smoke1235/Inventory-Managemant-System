<?php
require_once '../src/inc/session_check.php';
include_once '../src/fetch-customers.php';

$id = $_GET['id'];
$sql1 = "SELECT
    *,
    `invoices`.`id` AS `invoice_id`,
    `invoices`.`created` AS `invoice_created`,
    `invoices`.`status` AS `invoice_status`
FROM
    invoices
INNER JOIN invoice_status ON invoices.status = invoice_status.id
INNER JOIN customers ON invoices.customer_id = customers.id
INNER JOIN users ON invoices.user_id = users.id
WHERE
    `invoices`.`id` = '$id' ";

$inv_result = $con->query($sql1);
$row = $inv_result->fetch_assoc();

$fetch_items = "SELECT
    *,
    products.id AS product_nmr
FROM
    invoice_line
INNER JOIN products ON invoice_line.product_id = products.id
WHERE
    invoice_id = '$id' ";
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
    <title>Inventory Manager | View Invoice</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <div class="order-title">
                <h1>View Invoice</h1>
                <section>
                    <a href="invoice.php">Back</a>
                    <a class="edit-data" href="editInvoice.php?id=<?php echo $id; ?>">Edit</a>
                </section>
            </div>
            <div class="order-form-container">
            <form id="create-invoice" method="POST">
                    <input type="hidden" name="hidden" value="<?php echo $invoice_id; ?>">
                    <div class="order-form-header">
                        <section class="order-form-customer">
                            <h2>Customer</h2>
                            <p><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
                            <h3>Contact Info</h3>
                            <p><?php echo $row['number']; ?></p>
                            <p><?php echo $row['mail']; ?></p>
                        </section>
                        <section class="order-form-shipping">
                            <h2>Shipping Address</h2>
                            <p><?php echo $row['shipping_name']; ?></p>
                            <p><?php echo $row['shipping_company']; ?></p>
                            <p><?php echo $row['shipping_street']; ?></p>
                            <p><?php echo $row['shipping_postalcode']; ?></p>
                            <p><?php echo $row['shipping_city']; ?></p>
                            <p><?php echo $row['shipping_country']; ?></p>
                        </section>
                        <section class="order-form-billing">
                            <h2>Billing Address</h2>
                            <p><?php echo $row['billing_name']; ?></p>
                            <p><?php echo $row['billing_company']; ?></p>
                            <p><?php echo $row['billing_street']; ?></p>
                            <p><?php echo $row['billing_postalcode']; ?></p>
                            <p><?php echo $row['billing_city']; ?></p>
                            <p><?php echo $row['billing_country']; ?></p>
                        </section>
                        <section class="order-form-status">
                            <h2>Status</h2>
                            <p><?php echo $row['status']; ?></p>
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
                                        echo '<td></td>';
                                        echo '<td><p>'.$item['product_name'].'</p></td>';
                                        echo '<input type="hidden" name="product[]" value="'.$item['product_nmr'].'">';
                                        echo '<td><p>'.$item['product_description'].'</p></td>';
                                        echo '<td><p>'.$item['quantity'].'</p></td>';
                                        echo '<td><p>'.$item['product_price'].'</p></td>';
                                        echo '</tr>';
                                        $n++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
