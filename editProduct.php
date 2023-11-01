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
$sql = "SELECT * FROM products INNER JOIN suppliers ON products.supplier_id=suppliers.id  WHERE products.id='$id'";
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
            <h1>Edit </h1>
            <div class="form-container">
                <form action="editProductForm.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label for="product_description" name="product_description">Description:</label>
                    <input type="text" name="product_description" value=" ">
                    <label for="quantity" name="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="">
                    <label for="product_price">Product Price:</label>
                    <input type="float" name="product_price" value="">
                    <label for="other_details">Other Details:</label>
                    <input type="text" name="other_details" value="">
                    <label for="supplier">Supplier:</label>
                    <select name="supplier">
                        <option value=""></option>
                    </select>
                    <input type="submit" value="Update">
                    <a class="cancel-button" href="products.php">Cancel</a>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
