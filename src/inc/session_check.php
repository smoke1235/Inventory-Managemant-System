<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_DEPRECATED);

require_once '../vendor/autoload.php';
require_once '../config/connect.php';
require_once '../fpdf186/fpdf.php';


// Load the database
$database = DB::loadDb($DATABASE_HOST, $DATABASE_NAME, $DATABASE_USER, $DATABASE_PASS);
$params = Params::loadParams();


$documentRoot = $_SERVER['DOCUMENT_ROOT'];
if (strrpos($documentRoot, '/') !== strlen($documentRoot) - 1)
	$documentRoot .= '/Inventory-Managemant-System';

$loader = new \Twig\Loader\FilesystemLoader($documentRoot.'/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => $documentRoot.'/compilation_cache',
    'debug' => true
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

