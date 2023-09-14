<?php

$host = "localhost";
$username = "user";
$password = "test";
$dbname = "myDb";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];
?>