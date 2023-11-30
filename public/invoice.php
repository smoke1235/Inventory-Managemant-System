<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/connect.php';

$sql = "SELECT *, invoices.id AS invoiceID FROM invoices\n"
    . "INNER JOIN invoice_category ON invoices.category=invoice_category.id\n"
    . "INNER JOIN customers ON invoices.customer_id=customers.id\n"
    . "INNER JOIN users ON invoices.user_id=users.id\n";
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
            <h1>Invoices</h1>
            <a class="new-data" href="createInvoice.php">Create invoice</a>
            <div class="table-container">
                <table aria-label="">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th>Created</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()) {?>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $row['orderID']; ?>
                            </td>
                            <td>
                                <?php echo $row['status']; ?>
                            </td>
                            <td>
                                <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['created']; ?>
                            </td>
                            <td>
                                <?php echo $row['updated']; ?>
                            </td>
                            <td>
                                <a class="edit-data" href="">Edit</a>
                                <a class="view-data" href="">View</a>
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
