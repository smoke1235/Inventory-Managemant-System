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

$sql = " SELECT * FROM customers ";
$result = $con->query($sql);

if (!$result) {
    die("Invalid quary: " . $con->error);
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="discription" content="">
    <title>Suppliers</title>
    <link rel="stylesheet" href="Assets/SCSS/main.scss">
</head>

<body>
    <nav aria-label="nav-top" class="nav-top">
        <a href="home.php">
            <h1>Website Title</h1>
        </a>
        <ul>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <nav aria-label="nav-left" class="nav-left">
        <ul>
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="stock.php">Stock</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="suppliers.php">Suppliers</a></li>
        </ul>
    </nav>
    <h1>Customers</h1>
    <a href="insertCustomers.php">Add</a>
    <table>
        <tr>
            <th>No.</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Company</th>
            <th>street</th>
            <th>postcode</th>
            <th>city</th>
            <th>country</th>
            <th>Actions</th>
        </tr>
        <?php while ($rows = $result->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <?php echo $rows['id']; ?>
                </td>
                <td>
                    <?php echo $rows['first_name']; ?>
                </td>
                <td>
                    <?php echo $rows['last_name']; ?>
                </td>
                <td>
                    <?php echo $rows['company_name']; ?>
                </td>
                <td>
                    <?php echo $rows['street']; ?>
                </td>
                <td>
                    <?php echo $rows['postcode']; ?>
                </td>
                <td>
                    <?php echo $rows['city']; ?>
                </td>
                <td>
                    <?php echo $rows['country']; ?>
                </td>

                <td>
                    <a href="editcustomers.php?id=<?php echo $rows['id']; ?>">Edit</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <footer>
        <h3>Inventory Manager</h3>
        <p>If problems ocurr contact the admin</p>
        <a href="mailto:email@example.com">Send Email</a>
    </footer>
</body>

</html>