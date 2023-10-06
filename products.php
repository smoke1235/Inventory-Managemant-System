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

$sql = " SELECT * FROM products ";
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <meta name="discription" content="">
    <link href="Assets/SCSS/main.scss" rel="stylesheet">
</head>

<body>
    <?php include_once 'navbar.php'; ?>
    <h1>Products</h1>
    <a href="insertProduct.php">Add</a>
    <table id="myTable">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        <?php while ($rows = $result->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <?php echo $rows['id']; ?>
                </td>
                <td>
                    <?php echo $rows['productName']; ?>
                </td>
                <td>
                    <?php echo $rows['quantity']; ?>
                </td>
                <td><a href="editProduct.php?id=<?php echo $rows['id']; ?>">Edit</a></td>
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