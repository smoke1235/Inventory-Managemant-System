<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: ../ondex.php");
}

require_once '../config/connect.php';
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../assets/js/populateTextInput.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <div class="modal" id="modal">
                <?php include_once '../include/invoiceInsertProduct.php'; ?>
            </div>
            <div class="order-title">
                <h1>View Invoice</h1>
                <a href="invoice.php">Back</a>
                <a href="editInvoice.php?id=<?php echo $id; ?>">Edit</a>
            </div>
        </main>
    </div>
</body>
</html>
