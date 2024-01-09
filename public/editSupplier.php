<?php
require_once '../src/inc/session_check.php';

$id = $_GET['id'];
$sql =
"SELECT * FROM suppliers
WHERE id= $id";
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | Edit Supplier</title>
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include '../include/navbar.php'; ?>
        <main class="main-content">
            <h1>Edit <?php echo $row['name']; ?></h1>
            <div class="form-container">
                <form action="../src/editSupplierForm.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <label for="newSupplierName" name="newSupplierName">Name:</label>
                    <input type="text" name="newSupplierName"
                    placeholder="Supplier name" value="<?php echo $row['name']; ?>" maxlength="90">
                    <label for="number">Number:</label>
                    <input type="tel" name="number"
                    placeholder="06123456789" value="<?php echo $row['number']; ?>" maxlength="20">
                    <label for="email">Email:</label>
                    <input type="text" name="email"
                    placeholder="supplier@example.nl" value="<?php echo $row['email']; ?>" maxlength="200">
                    <label for="newSupplierStreet">Street:</label>
                    <input type="text" name="newSupplierStreet"
                    placeholder="Street" value="<?php echo $row['street']; ?>" maxlength="90">
                    <label for="newSupplierPostcode" name="newSupplierPostcode">Postal Code:</label>
                    <input type="text" name="newSuplierPostcode"
                    placeholder="Postal code" value="<?php echo $row['postcode']; ?>" maxlength="8">
                    <label for="newSupplierCity">City:</label>
                    <input type="text" name="city"
                    placeholder="City" value="<?php echo $row['city']; ?>" maxlength="90">
                    <label for="newSupplierCountry" name="newSupplierCountry">Country</label>
                    <input type="text" name="newSupplierCountry"
                    placeholder="Country" value="<?php echo $row['country']; ?>" maxlength="90">
                    <input type="submit" name="submit" value="Submit">
                    <a class="cancel-button" href="suppliers.php">Cancel</a>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
