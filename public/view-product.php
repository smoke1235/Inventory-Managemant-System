<?php
require_once '../src/inc/session_check.php';

view('header', ['title' => 'View product']);

$id = $_GET['id'];
$sql = "SELECT * FROM products INNER JOIN suppliers ON products.supplier_id=suppliers.id  WHERE products.id='$id'";
$result = $con->query($sql);
$row = $result->fetch_assoc();

$lowStockWarning = ($row['product_quantity'] < 13) ? '<span style="color: red;">(Low stock!)</span>' : '';
?>

<h1>View
    <?php echo $row['product_name']; ?>
</h1>
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
<?php view('footer') ?>
