<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../config/connect.php';

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
    <?php include_once '../include/navbar.php'; ?>
    <main class="main-content">
        <h1>View <?php echo $row['first_name'] . ' ' .  $row['last_name']; ?></h1>
        <a class="edit-data" href="editCustomers.php?id=<?php echo $id; ?>">Edit</a>
        <div class="form-container">
            <form action="">
                
            </form>
        </div>
    </main>
    </div>
</body>
</html>