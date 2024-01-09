<?php
require_once '../src/inc/session_check.php';

$id = $_GET['id'];
$sql = "SELECT * FROM customers WHERE id='$id'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | View Customer</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../src/inc/navbar.php'; ?>
        <main class="main-content">
            <h1>View
                <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
            </h1>
            <a class="edit-data" href="editCustomers.php?id=<?php echo $id; ?>">Edit</a>
            <div class="form-container">
                <form action="">
                    <label for="">First name:</label>
                    <input type="text" value="<?php echo $row['first_name']; ?>" disabled>
                    <label for="">Last Name:</label>
                    <input type="text" value="<?php echo $row['last_name']; ?>" disabled>
                    <label for="">Number:</label>
                    <input type="text" value="<?php echo $row['number']; ?>" disabled>
                    <label for="">Email:</label>
                    <input type="text" value="<?php echo $row['email']; ?>" disabled>
                    <label for="">Company Name:</label>
                    <input type="text" value="<?php echo $row['company_name']; ?>" disabled>
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
