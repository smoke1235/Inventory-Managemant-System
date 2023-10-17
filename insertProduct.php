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

$sql = "SELECT * FROM suppliers";
$all_suppliers = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="Assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once 'navbar.php'; ?>
        <main>
            <h1>Add new products</h1>
            <div class="form container">
                <form action="insertProductForm.php" method="post">
                    <label for="productName">Product name:*</label>
                    <input type="text" name="productName" id="productName" required>
                    <label for="product_descr">Product description:</label>
                    <input type="text" name="product_descr" id="product_descr">
                    <label for="quantity">quantity:</label>
                    <input type="text" name="quanity" id="quantity">
                    <label for="product_price"></label>
                    <input type="float" name="product_price" id="product_price">
                    <label for="other_details">Other details:</label>
                    <input type="text" name="other_details" id="other_details">
                    <label for="supplier-option">Supplier</label>
                    <select name="supplier-option" id="supplier-option">
                        <option value="none">Select a supplier</option>
                        <?php
                        while ($supplier = mysqli_fetch_array ($all_suppliers, MYSQLI_ASSOC) )
                        ?>
                        <option value="<?php echo $supplier['name']; ?>">
                            <?php echo $supplier['name']; ?>
                        </option>
                    </select>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </main>
    </div>
</body>

</html>