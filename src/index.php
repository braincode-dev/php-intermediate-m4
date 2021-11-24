<?php
include_once dirname(__DIR__, 1) . '/vendor/autoload.php';
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

use App\Controllers\ProductController;
use App\Database\config\EntityManagerBuilder;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$controller = new ProductController(EntityManagerBuilder::build(), $url);
$request = $_SERVER['REQUEST_METHOD'];

$_SESSION['sort'] = $_SESSION['sort'] ?? false;

if ($request == 'GET') {
    if (isset($_GET['remove'])) {
        $controller->remove($_GET['remove']);
    }elseif(isset($_GET['sort'])){
        $controller->index($_GET['sort']);
    }
    $controller->index();

} elseif ($request == 'POST') {
    if ($_POST['id'] != '') {
        $controller->update($_REQUEST);
    } else {
        $controller->create($_POST);
    }
}