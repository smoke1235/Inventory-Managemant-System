<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

require_once '../config/connect.php';

$sql =
"SELECT products.id, products.product_name, products.product_description,
products.product_quantity, products.product_price, products.other_details, suppliers.name
FROM products
INNER JOIN suppliers
ON products.supplier_id=suppliers.id
ORDER BY id DESC";

$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <meta name="discription" content="">
    <link href="../assets/CSS/main.css" rel="stylesheet">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <h1>Products</h1>
            <a class="new-data" href="insertProduct.php">Add</a>
            <div class="table-container">
                <table aria-label="Table for products">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Discription</th>
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
