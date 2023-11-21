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
    <title>Invtory Manager | New Order</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main class="main-content">
            <h1>New Order</h1>
            <div class="form-container">
                <form action="">
                    <label for="">Customer:</label>
                    <label for="">Address:</label>
                    <label for="">Created by:</label>
                    <label for="">Products</label>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
