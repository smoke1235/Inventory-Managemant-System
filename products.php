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

$sql =
"SELECT products.id, products.productName, products.product_description,
products.quantity, products.product_price, products.other_details, suppliers.name
FROM products
INNER JOIN suppliers
ON products.supplier_id=suppliers.name ";

$result = $con->query($sql);
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
    <table>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>discription</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Supplier</th>
            <th>Actions</th>
        </tr>
        <?php while ($rows = $result->fetch_assoc()) { ?>
            <tr>
                <td>
                    <?php echo $rows['id']; ?>
                </td>
                <td>
                    <?php echo $rows['productName']; ?>
                </td>
                <td>
                    <?php echo $rows['product_description']; ?>
                </td>
                <td>
                    <?php echo $rows['quantity']; ?>
                </td>
                <td>
                    <?php echo $rows['product_price']; ?>
                </td>
                <td>
                    <?php echo $rows['supplier_id']; ?>
                </td>
                <td>
                    <a href="editProduct.php?id=<?php echo $rows['id']; ?>">Edit</a>
                    <a href="">View</a>
                </td>

            </tr>
        <?php } ?>
    </table>

    <?php include_once 'footer.php'; ?>
</body>

</html>