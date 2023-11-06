<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Suppliers</title>
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main>
            <h1>Add new supplier</h1>
            <div class="form-container">
                <form action="../src/insertSuppliersForm.php">
                    <label for="supplierName" name="supplierName">Supplier Name:*</label>
                    <input type="text" name="supplierName" placeholder="Supplier" required>
                    <label for="number">Phone Number:</label>
                    <input type="tel" name="number" placeholder="06123456789">
                    <label for="email">Email:</label>
                    <input type="text" name="email" placeholder="supplier@example.nl">
                    <label for="supplierStreet" name="supplierStreet">Street:</label>
                    <input type="text" name="supplierStreet" placeholder="Street">
                    <label for="supplierPostcode" name="supplierPostcode">Postal Code:</label>
                    <input type="text" name="supplierPostcode" placeholder="Postal Code">
                    <label for="supplierCity" name="supplierCity">City:</label>
                    <input type="text" name="supplierCity" placeholder="City">
                    <label for="supplierCountry" name="supplierCountry">Country:</label>
                    <input type="text" name="supplierCountry" placeholder="Country">
                    <input type="submit" name="submit" value="Submit">
                    <a class="cancel-button" href="suppliers.php">Cancel</a>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
