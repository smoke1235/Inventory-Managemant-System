<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("Loacation: ../index.php");
    exit;
}

require_once '../config.connect.php';

