<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}

require '../config/connect.php';

$sql =
"SELECT * FROM `customers`  \n"
. "ORDER BY `customers`.`last_name` ASC;";
$result = $con->query($sql);

if (!$result) {
    die("Invalid quary: " . $con->error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="discription" content="">
    <title>Customers</title>
    <link rel="stylesheet" href="../assets/CSS/main.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../include/navbar.php'; ?>
        <main>
            <h1>Customers</h1>
            <a class="new-data" href="insertCustomers.php">Add</a>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>street</th>
                            <th>Postal Code</th>
                            <th>city</th>
                            <th>country</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <?php while ($rows = $result->fetch_assoc()) { ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $rows['first_name']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['last_name']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['number']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['email']; ?>
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
                                    <a class="edit-data"
                                        href="editcustomers.php?id=<?php echo $rows['id']; ?>">Edit
                                    </a>
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
