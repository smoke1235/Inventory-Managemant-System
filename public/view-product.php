<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../config/connect.php';

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
    <link rel="stylesheet" href="../assets/CSS/main.css">
    <title>Inventory Manager | View <?php echo $row['product_name']; ?></title>
    <meta name="description" name="">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <h1>View <?php echo $row['product_name']; ?></h1>
            <a class="edit-data" href="editProduct.php?id=<?php echo $id; ?>">Edit</a>
            <div class="form-container">
                <form action="">
                    <label for="">Product name:</label>
                    <input type="text" value="<?php echo $row['product_name']; ?>" disabled>
                    <label for="">Description:</label>
                    <input type="text" value="<?php echo $row['product_description']; ?>" disabled>
                    <label for="">Quantity</label>
                    <input type="text" value="<?php echo $row['product_quantity']; ?>" disabled>
                    <label for="">Price:</label>
                    <input type="text" value="<?php echo $row['product_price']; ?>" disabled>
                    <label for="">Supplier:</label>
                    <input type="text" value="<?php echo $row['name']; ?>" disabled>
                    <label for="">Other details:</label>
                    <textarea name="other_details" rows="8" disabled><?php echo $row['other_details']; ?></textarea>
                    <a class="cancel-button" href="products.php">Back</a>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
