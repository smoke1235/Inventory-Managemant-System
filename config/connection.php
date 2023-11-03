<?php
function db_connect() {
    require "config.php";
    $connection = new PDO($dsn, $username, $password, $options);
    return $connection;
}
