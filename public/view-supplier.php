<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../config/connect.php';

$id = $_GET['id'];
$sql = "SELECT * FROM suppliers WHERE id='$id'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | View Supplier</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <h1>View
                <?php echo $row['name']; ?>
            </h1>
            <a class="edit-data" href="editCustomers.php?id=<?php echo $id; ?>">Edit</a>
            <div class="form-container">
                <form action="">
                    <label for="">Name:</label>
                    <input type="text" value="<?php echo $row['name']; ?>" disabled>
                    <label for="">Phone number:</label>
                    <input type="text" value="<?php echo $row['number']; ?>" disabled>
                    <label for="">Email:</label>
                    <input type="text" value="<?php echo $row['email']; ?>" disabled>
                    <label for="">Street:</label>
                    <input type="text" value="<?php echo $row['street']; ?>" disabled>
                    <label for="">Postal code:</label>
                    <input type="text" value="<?php echo $row['postcode']; ?>" disabled>
                    <label for="">City:</label>
                    <input type="text" value="<?php echo $row['city']; ?>" disabled>
                    <label for="">Country:</label>
                    <input type="text" value="<?php echo $row['country']; ?>" disabled>
                    <a class="cancel-button" href="products.php">Back</a>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
