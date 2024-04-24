<?php
require_once '../src/inc/session_check.php';
view('header', ['title' => 'My profile']);

$stmt = $con->prepare('SELECT password, email FROM users WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

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
<?php view('footer'); ?>
