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

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id='$id' INNER JOIN suppliers ON products.supplier_id=suppliers.id";
$result = $con->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="Assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once 'navbar.php'; ?>
        <main>
            <h1>Update product</h1>
            <div class="form-container">
                <form action="editProductForm.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
                    <label for="product_name" name="product_name">Product Name:</label>
                    <input type="text" name="product_name" value="<?php echo $rows['product_name']; ?>">
                    <label for="product_description" name="product_description">Description:</label>
                    <input type="text" name="product_description" value="<?php echo $rows['product_description']; ?>">
                    <label for="quantity" name="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="<?php echo $rows['product_quantity']; ?>">
                    <label for="product_price">Product Price:</label>
                    <input type="float" name="product_price" value="<?php echo $rows['product_price']; ?>">
                    <label for="other_details">Other Details:</label>
                    <input type="text" name="other_details" value="<?php echo $rows['other_details']; ?>">
                    <label for="supplier">Supplier:</label>
                    <input type="text" name="supplier" value="<?php echo $rows['name']; ?>">
                    <input type="submit" value="Update">
                    <a class="cancel-button" href="products.php">Cancel</a>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
