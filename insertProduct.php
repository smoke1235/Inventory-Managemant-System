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
            <div class="form-container">
                <?php include "fetch-suppliers.php"; ?>
                <form action="insertProductForm.php">
                    <label for="product_name"> Product name: *</label>
                    <input type="text" name="product_name" required>
                    <label for="product_descr">Description</label>
                    <input type="text" name="product_descr" placeholder="Kleur, type, year?">
                    <label for="Quantity">Quantity: *</label>
                    <input type="number" name="quantity" value="1">
                    <label for="product_price">Product Price:</label>
                    <input type="number" name="product_price" value="0.00">
                    <label for="supplier_name">Supplier name:</label>
                    <select name="supplier_id">
                        <option value="0">None</option>
                        <?php
                        foreach ($options as $option) {
                            ?>
                            <option value="<?php echo $option['id']; ?>">
                                <?php echo $option['name']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <label for="other_details">Other Details</label>
                    <input type="text" name="other_details" placeholder="Instructions? Good to know?">
                    <input type="submit" value="Submit">
                    <a class="cancel-button" href="products.php">Cancel</a>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
