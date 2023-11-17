<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/connect.php';

$id = $_GET['id'];
$sql =
"SELECT * FROM customers
WHERE id= $id";
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | Edit Order</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <h1>Edit Order</h1>
        </main>
    </div>
</body>
</html>