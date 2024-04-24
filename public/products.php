<?php
require_once '../src/inc/session_check.php';
require_once __DIR__ . '/../src/bootstrap.php';
view('header', ['title' => 'Products']);

$sql = "SELECT
            products.id,
            product_name,
            product_description,
            product_quantity,
            product_price,
            other_details,
            name
        FROM
            products
        INNER JOIN suppliers ON products.supplier_id=suppliers.id
        ORDER BY id DESC
        ";
$result = $con->query($sql);

$minimale_voorraad =array(
    "A5 Poster" => 60,
    "Verf" => 30,
    "poster" => 100,
);

?>

<h1>Products</h1>
<a class="new-data" href="insertProduct.php">Add</a>

    <div class="table-container">
    <table aria-label="Table for products">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php  include_once 'stockManager.php'; ?>
        <tbody> <!-- Plaats de tbody tag hier -->
            <?php while ($rows = $result->fetch_assoc()) { ?>
                <tr>
                    <td class="pro-id">
                        <?php echo $rows['id']; ?>
                    </td>
                    <td class="pro-name">
                        <?php echo $rows['product_name']; ?>
                    </td>
                    <td class="pro-descr">
                        <?php echo $rows['product_description']; ?>
                    </td>
                    <td class="pro-qty <?php echo ($rows['product_quantity'] < $minimale_voorraad[$rows['product_name']]) ? 'low-stock' : ''; ?>">
                        <?php echo $rows['product_quantity']; ?>
                        <?php if ($rows['product_quantity'] < $minimale_voorraad[$rows['product_name']]): ?>
                            <span style="color : red;">(Low stock!)</span> 
                        <?php endif; ?>
                        </td>
                    <td class="pro-prc">
                        <?php echo $rows['product_price']; ?>
                    </td>
                    <td class="pro-act">
                        <a class="edit-data" href="editProduct.php?id=<?php echo $rows['id']; ?>">
                            <ion-icon name="pencil-outline"></ion-icon>
                        </a>
                        <a class="view-data" href="view-product.php?id=<?php echo $rows['id']; ?>">
                            <ion-icon name="eye-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
</div>


        
<?php view('footer') ?>
