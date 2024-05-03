<?php require_once '../src/inc/session_check.php';
view('header', ['title' => 'New product']);
?>

<h1>Add new products</h1>
<div class="form-container">
    <?php include_once "../src/fetch-suppliers.php"; ?>
    <form action="../src/insertProductForm.php">
        <label for="product_name"> Product name: *</label>
        <input type="text" name="product_name" required>
        <label for="product_descr">Description</label>
        <input type="text" name="product_descr" placeholder="Kleur, type, year?">
        <label for="Quantity">Quantity: *</label>
        <input type="number" name="quantity" value="1">
        <label for="product_price">Product Price:</label>
        <input type="float" name="product_price" value="0.00">
        <label for="min_stock">Minimum stock:</label>
        <input type="number" name="min_stock" id="min_stock">
        <label for="supplier_name">Supplier name:</label>
        <select required name="supplier_id">
            <option value="" selected disabled>None</option>
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
        <textarea type="text" name="other_details" rows="8" placeholder="Good to know?"></textarea>
        <input type="submit" value="Submit">
        <a class="cancel-button" href="products.php">Cancel</a>
    </form>
</div>

<?php view('footer') ?>
