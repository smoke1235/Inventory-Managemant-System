<?php
require_once '../src/inc/session_check.php';

$stmt = $con->prepare('SELECT password, email FROM users WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/CSS/profile.css" rel="stylesheet">
    <title>Inventory Manager | Profile</title>
    <meta name="discription" content="">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once '../src/inc/navbar.php'; ?>
        <main class="main-content">
            <h1>Profile Page</h1>
            <div class="profile-page">
                <div class="profile-table">
                    <p>Your account details are below:</p>
                    <table aria-label="table for profile">
                        <tr>
                            <td>Username:</td>
                            <td>
                                <?= $_SESSION['name'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>E-mail:</td>
                            <td>
                                <?= $email ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
