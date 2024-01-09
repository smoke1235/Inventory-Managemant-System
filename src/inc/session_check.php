<?php
require_once '../config/connect.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}
