<?php
require_once '../src/inc/session_check.php';

$id = $_GET['id'];
$sql = "SELECT * FROM products INNER JOIN suppliers ON products.supplier_id=suppliers.id  WHERE products.id='$id'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | Edit Products</title>
    <link rel="stylesheet" href="../assets/CSS/main.css">
    <meta name="description" name="">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../src/inc/navbar.php'; ?>
        <main class="main-content">
            <h1>Edit <?php echo $row['product_name']; ?></h1>
            <div class="form-container">
                <form action="../src/editProductForm.php" method="POST" id="editProduct">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label for="product_description" name="product_description">Description:</label>
                    <input type="text" name="product_description"
                    value="<?php echo $row['product_description']; ?> " maxlength="100">
                    <label for="quantity" name="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity"
                    value="<?php echo $row['product_quantity']; ?>" maxlength="11">
                    <label for="product_price">Product Price:</label>
                    <input type="float" name="product_price" value="<?php echo $row['product_price']; ?>" >
                    <label for="supplier">Supplier:</label>
                    <select name="supplier">
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['name']; ?>
                        </option>
                        <?php include '../src/fetch-suppliers.php'; ?>
                        <?php
                        foreach ($options as $option) {
                            ?>
                            <option value="<?php echo $option['id']; ?>">
                                <?php echo $option['name']; ?>
                            </option>
                            <?php } ?>
                    </select>
                    <label for="other_details">Other Details:</label>
                    <textarea name="other_details" maxlength="500" rows="8"><?php echo $row['other_details']; ?></textarea>
                    <input type="submit" value="Update">
                    <a class="cancel-button" href="products.php">Cancel</a>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
