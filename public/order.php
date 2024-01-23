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
                    <td id="order-id">
                        <?php echo $row['order_id']; ?>
                    </td>
                    <td id="order-status">
                        <?php echo $row['status']; ?>
                    </td>
                    <td id="order-name">
                        <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
                    </td>
                    <td id="order-update">
                        <?php echo $row['updated']; ?>
                    </td>
                    <td id="order-create">
                        <?php echo $row['order_created']; ?>
                    </td>
                    <td id="order-user">
                        <?php echo $row['username'] ?>
                    </td>
                    <td id="order-user">
                        <a class="edit-data" href="edit-order.php?id=<?php echo $row['order_id']; ?>">
                            <ion-icon name="pencil-outline"></ion-icon>
                        </a>
                        <a class="view-data" href="view-order.php?id=<?php echo $row['order_id']; ?>">
                            <ion-icon name="eye-outline"></ion-icon>
                        </a>
                        <a class="download" href="download-order.php?id=<?php echo $row['order_id']; ?>">
                            <ion-icon name="download-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</div>
<?php view('footer') ?>
