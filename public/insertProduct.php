<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | New Product</title>
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <h1>Add new products</h1>
            <div class="form-container">
                <?php include "../src/fetch-suppliers.php"; ?>
                <form action="../src/insertProductForm.php">
                    <label for="product_name"> Product name: *</label>
                    <input type="text" name="product_name" required>
                    <label for="product_descr">Description</label>
                    <input type="text" name="product_descr" placeholder="Kleur, type, year?">
                    <label for="Quantity">Quantity: *</label>
                    <input type="number" name="quantity" value="1">
                    <label for="product_price">Product Price:</label>
                    <input type="float" name="product_price" value="0.00">
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
                    <textarea type="text" name="other_details" rows="8" placeholder="Instructions? Good to know?"></textarea>
                    <input type="submit" value="Submit">
                    <a class="cancel-button" href="products.php">Cancel</a>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
