<?php
session_start();

require '../config/connect.php';
if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();

        if ($_POST['password'] === $password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: ../public/dashboard.php');
        } else {
            echo "Wrong username/password";
        }
    } else {
        echo "Wrong username/password";
    }

    $stmt->close();
}
