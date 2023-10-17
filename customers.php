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
    <title>Customers</title>
    <link rel="stylesheet" href="Assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once 'navbar.php'; ?>
        <main>
            <h1>Customers</h1>
            <a id="new-data" href="insertCustomers.php">Add</a>
            <div class="table-container">
                <table>
                    <thead>
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
                    </thead>
                    <?php while ($rows = $result->fetch_assoc()) {
                        ?>
                        <tbody>
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
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </main>
    </div>
</body>

</html>