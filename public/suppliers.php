<?php
require_once '../src/inc/session_check.php';
require_once __DIR__ . '/../src/bootstrap.php';
view('header', ['title' => 'Suppliers']);

$sql = "SELECT * FROM `suppliers` ORDER BY `suppliers`.`dateTime` DESC;";
$result = $con->query($sql);
if (!$result) {
    die("Invalid quary: " . $con->error);
}

$con->close();
?>

<h1>Suppliers</h1>
<a class="new-data" href="insertSuppliers.php">Add</a>
<div class="table-container">
    <table aria-describedby="">
        <thead>
            <tr>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php while ($rows = $result->fetch_assoc()) {
            ?>
            <tbody>
                <tr>
                    <td id="sup-name">
                        <?php echo $rows['name']; ?>
                    </td>
                    <td id="sup-num">
                        <?php echo $rows['number']; ?>
                    </td>
                    <td id="sup-mail">
                        <?php echo $rows['email']; ?>
                    </td>
                    <td id="sup-addr">
                        <?php echo $rows['street'] . ', ' .
                            $rows['postcode'] . ', ' .
                            $rows['city'] . ', ' .
                            $rows['country']; ?>
                    </td>
                    <td id="sup-act">
                        <a class="edit-data" href="editSupplier.php?id=<?php echo $rows['id']; ?>">Edit</a>
                        <a class="view-data" href="view-supplier.php?id=<?php echo $rows['id']; ?>">View</a>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>

</div>
<?php view('footer') ?>
