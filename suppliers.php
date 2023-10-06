<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'inventoryManager';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql = " SELECT * FROM suppliers ";
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
    <title>Suppliers</title>
    <link rel="stylesheet" href="Assets/SCSS/main.scss">
</head>

<body>
    <?php include_once 'navbar.php'; ?>

    <h1>Products</h1>
    <a href="insertSuppliers.php">Add</a>
    <table>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>street</th>
            <th>postcode</th>
            <th>city</th>
            <th>country</th>
            <th>Actions</th>
        </tr>
        <?php while ($rows = $result->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <?php echo $rows['id']; ?>
                </td>
                <td>
                    <?php echo $rows['name']; ?>
                </td>
                <td>
                    <?php echo $rows['street']; ?>
                </td>
                <td>
                    <?php echo $rows['postcode']; ?>
                </td>
                <td>
                    <?php echo $rows['city']; ?>
                </td>
                <td>
                    <?php echo $rows['country']; ?>
                </td>

                <td><a href="editSupplier.php?id=<?php echo $rows['id']; ?>">Edit</a></td>
            </tr>
        <?php } ?>
    </table>
    <footer>
        <h3>Inventory Manager</h3>
        <p>If problems ocurr contact the admin</p>
        <a href="mailto:email@example.com">Send Email</a>
    </footer>
</body>

</html>