<?php
require_once '../src/inc/session_check.php';
require_once __DIR__ . '/../src/bootstrap.php';
view('header', ['title' => 'Products']);

$sql = "SELECT products.id, product_name, product_description, product_quantity, product_price, other_details, name
FROM products INNER JOIN suppliers ON products.supplier_id=suppliers.id ORDER BY id DESC;";
$result = $con->query($sql);
?>

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
                <th>Actions</th>
            </tr>
        </thead>
        <?php while ($rows = $result->fetch_assoc()) { ?>
            <tbody>
                <tr>
                    <td id="pro-id">
                        <?php echo $rows['id']; ?>
                    </td>
                    <td id="pro-name">
                        <?php echo $rows['product_name']; ?>
                    </td>
                    <td id="pro-descr">
                        <?php echo $rows['product_description']; ?>
                    </td>
                    <td id="pro-qty">
                        <?php echo $rows['product_quantity']; ?>
                    </td>
                    <td id="pro-prc">
                        <?php echo $rows['product_price']; ?>
                    </td>
                    <td id="pro-act">
                        <a class="edit-data" href="editProduct.php?id=<?php echo $rows['id']; ?>">Edit</a>
                        <a class="view-data" href="view-product.php?id=<?php echo $rows['id']; ?>">View</a>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</div>
<?php view('footer') ?>
