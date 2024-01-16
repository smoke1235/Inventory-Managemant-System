<?php
require_once '../src/inc/session_check.php';
require_once __DIR__ . '/../src/bootstrap.php';
view('header', ['title' => 'Invoices']);

$sql = "SELECT
            *,
            `invoices`.`id` as `invoice_id`,
            `invoices`.`created` AS `invoice_created`
        FROM
            invoices
        INNER JOIN invoice_status ON invoices.status=invoice_status.id
        INNER JOIN customers ON invoices.customer_id=customers.id
        INNER JOIN users ON invoices.user_id=users.id
        ORDER BY
            updated
        DESC
        ";

$result = $con->query($sql);
?>

<h1>Invoices</h1>
<a class="new-data" href="createInvoice.php">Create invoice</a>
<div class="table-container">
    <table aria-label="">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Customer</th>
                <th>Last Updated</th>
                <th>Created</th>
                <th>Last interacted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tbody>
                <tr>
                    <td id="invoice-id">
                        <?php echo $row['invoice_id']; ?>
                    </td>
                    <td id="invoice-status">
                        <?php echo $row['status']; ?>
                    </td>
                    <td id="invoice-name">
                        <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
                    </td>
                    <td id="invoice-update">
                        <?php echo $row['updated']; ?>
                    </td>
                    <td id="invoice-create">
                        <?php echo $row['invoice_created']; ?>
                    </td>
                    <td id="invoice-user">
                        <?php echo $row['username'] ?>
                    </td>
                    <td id="invoice-action">
                        <a class="edit-data" href="editInvoice.php?id=<?php echo $row['invoice_id']; ?>">Edit</a>
                        <a class="view-data" href="view-invoice.php?id=<?php echo $row['invoice_id']; ?>">View</a>
                        <a class="Download" href="download-invoice.php?id=<?php echo $row['invoice_id']; ?>">
                            <ion-icon name="download-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</div>
<?php view('footer') ?>
