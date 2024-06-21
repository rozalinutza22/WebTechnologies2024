<?php
include(dirname(__DIR__).'/public/UserController.php');
include(dirname(__DIR__).'/public/ErrorHandler.php');
header("Content-type: application/json; charset=UTF-8");
set_exception_handler("ErrorHandler::handleException");

$parts = explode("/", $_SERVER["REQUEST_URI"]);
echo "\n\n";
$id = $parts[3] ??  null;

$model = new ProductController();
$model->processRequest($_SERVER["REQUEST_METHOD"], $id);
?>