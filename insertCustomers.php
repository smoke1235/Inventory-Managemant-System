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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Customers</title>
    <link rel="stylesheet" href="Assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once 'navbar.php'; ?>
        <main>
            <h1>Add new customer</h1>
            <div class="form-container">
                <form action="insertCustomersFrom.php">
                    <label for="firstName" name="firstName">Fisrt Name:</label>
                    <input type="text" name="firstName" placeholder="First Name">
                    <label for="lastName" name="lastName">Last name:</label>
                    <input type="text" name="lastName" placeholder="Last Name">
                    <label for="number">Phone Number:*</label>
                    <input type="tel" name="number" placeholder="06123456789" required>
                    <label for="email">Email:</label>
                    <input type="text" name="email" placeholder="someone@exaple.com">
                    <label for="companyName" name="companyName">Company name:</label>
                    <input type="text" name="companyName" placeholder="Company Name">
                    <label for="customerStreet" name="customerStreet">Street:</label>
                    <input type="text" name="customerStreet" placeholder="Street">
                    <label for="customerPostcode" name="customerPostcode">Postal Code:</label>
                    <input type="text" name="customerPostcode" placeholder="Postal Code">
                    <label for="customerCity" name="customerCity">City:</label>
                    <input type="text" name="customerCity" placeholder="City">
                    <label for="customerCountry" name="customerCountry">Country:</label>
                    <input type="text" name="customerCountry" placeholder="Country">
                    <input type="submit" name="submit" value="Submit">
                    <a class="cancel-button" href="customers.php">Cancel</a>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
