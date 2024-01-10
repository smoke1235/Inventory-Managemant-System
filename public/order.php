<?php
require_once '../src/inc/session_check.php';
require_once __DIR__ . '/../src/bootstrap.php';
view('header', ['title' => 'Orders']);

$sql = "SELECT
            *,
            `orders`.`id` AS `order_id`,
            `orders`.`created` AS `order_created`
        FROM
            orders
        INNER JOIN order_status ON orders.status = order_status.id
        INNER JOIN customers ON orders.customer_id = customers.id
        INNER JOIN users ON orders.user_id = users.id
        ORDER BY
            updated
        DESC";

$result = $con->query($sql);
?>

<h1>Orders</h1>
<a class="new-data" href="create-order.php">Create invoice</a>
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
                    <td>
                        <?php echo $row['order_id']; ?>
                    </td>
                    <td>
                        <?php echo $row['status']; ?>
                    </td>
                    <td>
                        <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
                    </td>
                    <td>
                        <?php echo $row['updated']; ?>
                    </td>
                    <td>
                        <?php echo $row['order_created']; ?>
                    </td>
                    <td>
                        <?php echo $row['username'] ?>
                    </td>
                    <td>
                        <a class="edit-data" href="editInvoice.php?id=<?php echo $row['invoice_id']; ?>">Edit</a>
                        <a class="view-data" href="view-invoice.php?id=<?php echo $row['invoice_id']; ?>">View</a>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</div>
<?php view('footer') ?>
