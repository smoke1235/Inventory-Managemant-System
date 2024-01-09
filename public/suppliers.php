<?php
require_once '../src/inc/session_check.php';

$sql = "SELECT * FROM `suppliers` ORDER BY `suppliers`.`dateTime` DESC;";
$result = $con->query($sql);

if (!$result) {
    die("Invalid quary: " . $con->error);
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="discription" content="">
    <title>Inventory Manager | Suppliers</title>
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../src/inc/navbar.php'; ?>
        <main class="main-content">
            <h1>Suppliers</h1>
            <a class="new-data" href="insertSuppliers.php">Add</a>
            <div class="table-container">
                <table>
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
                                <td>
                                    <?php echo $rows['name']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['number']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['email']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['street'] . ', ' .
                                    $rows['postcode'] . ', ' .
                                    $rows['city'] . ', ' .
                                    $rows['country']; ?>
                                </td>
                                <td>
                                    <a class="edit-data" href="editSupplier.php?id=<?php echo $rows['id']; ?>">Edit</a>
                                    <a class="view-data" href="view-supplier.php?id=<?php echo $rows['id']; ?>">View</a>
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
