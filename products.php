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
    "SELECT products.id, products.product_name, products.product_description,
products.product_quantity, products.product_price, products.other_details, suppliers.name
FROM products
INNER JOIN suppliers
ON products.supplier_id=suppliers.id ";

$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <meta name="discription" content="">
    <link href="Assets/CSS/main.css" rel="stylesheet">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once 'navbar.php'; ?>
        <main>
            <h1>Products</h1>
            <a class="new-data" href="insertProduct.php">Add</a>
            <div class="table-container">
                <table aria-label="Table for products">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>discription</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Supplier</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <?php while ($rows = $result->fetch_assoc()) { ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $rows['id']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['product_name']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['product_description']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['product_quantity']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['product_price']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['name']; ?>
                                </td>
                                <td>
                                    <a class="edit-data"
                                    href="editProduct.php?id=<?php echo $rows['id']; ?>">Edit</a>
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