<?php
require_once '../src/inc/session_check.php';
require_once __DIR__ . '/../src/bootstrap.php';
view('header', ['title' =>  'Dashboard'])
?>

<h1>Welcome,
    <?= $_SESSION['name'] ?>!
</h1>
<div class="board">
    <div class="products-button">
        <?php
        $sql = "SELECT COUNT(product_name) AS total FROM products;";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        ?>
        <a href="products.php"
            title="This shows you how many products we have in the system, 
            You also can click it to go straight to the product page.">
            <h3>
                <?php
                echo $data['total'];
                ?>
            </h3>
            <p>Total products</p>
        </a>
    </div>
    <div class="customers-button">
        <?php
        $sql = "SELECT COUNT(id) AS total FROM customers;";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        ?>
        <a href="customers.php"
            title="This shows how many customers we have in the system, 
            you also can click it to go straight to the customers page.">
            <h3>
                <?php
                echo $data['total'];
                ?>
            </h3>
            <p>Total Customers</p>
        </a>
    </div>
    <div class="suppliers-button">
        <?php
        $sql = "SELECT COUNT(name) AS total FROM suppliers;";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        ?>
        <a href="suppliers.php"
            title="This shows how many suppliers we have in the system, 
            you also can click it to go straight to the suppliers page.">
            <h3>
                <?php
                echo $data['total'];
                ?>
            </h3>
            <p>Total Suppliers</p>
        </a>
    </div>
    <div class="orders-button">
        <?php
        $sql = "SELECT COUNT(id) AS total FROM invoices WHERE MONTH(updated) = MONTH(CURRENT_DATE) ORDER BY updated;";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        ?>
        <a href="orders.php">
            <h3>
                <?php echo $data['total']; ?>
            </h3>
            <p>Invoices this month</p>
        </a>
    </div>
</div>
<div class="dashboard-table">
    <h2>Recently added products</h2>
    <div class="dashboard-table-container">
        <table aria-label="A table that shows 30 newly added products">
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
            <?php
            $sql =
                "SELECT products.id, products.product_name, products.product_description,
                            products.product_quantity, products.product_price, products.other_details,
                            suppliers.name, date
                            FROM products
                            INNER JOIN suppliers
                            ON products.supplier_id=suppliers.id
                            ORDER BY date DESC LIMIT 0,30";
            $result = $con->query($sql);
            ?>
            <tbody>
                <?php while ($rows = $result->fetch_assoc()) { ?>
                    <tr>
                        <td id="dash-id">
                            <?php echo $rows['id']; ?>
                        </td>
                        <td id="dash-name">
                            <?php echo $rows['product_name']; ?>
                        </td>
                        <td id="dash-descr">
                            <?php echo $rows['product_description']; ?>
                        </td>
                        <td id="dash-qty">
                            <?php echo $rows['product_quantity']; ?>
                        </td>
                        <td id="dash-prc">
                            <?php echo $rows['product_price']; ?>
                        </td>
                        <td id="dash-act">
                            <a class="edit-data" href="editProduct.php?id=<?php echo $rows['id']; ?>">Edit</a>
                            <a class="view-data" href="view-product.php?id=<?php echo $rows['id']; ?>">View</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php view('footer') ?>
