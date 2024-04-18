<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_DEPRECATED);

require_once '../vendor/autoload.php';
require_once '../src/classes/DB.php';
require_once '../config/connect.php';

// Load the database
$database = DB::loadDb($DATABASE_HOST, $DATABASE_NAME, $DATABASE_USER, $DATABASE_PASS);

$documentRoot = $_SERVER['DOCUMENT_ROOT'];
if (strrpos($documentRoot, '/') !== strlen($documentRoot) - 1)
	$documentRoot .= '/Inventory-Managemant-System-main';

$loader = new \Twig\Loader\FilesystemLoader($documentRoot.'/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => $documentRoot.'/compilation_cache',
]);



if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}

function view(string $filename, array $data = []) : void {
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}

