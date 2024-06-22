<?php
// include(dirname(__DIR__).'/public/UserManagement.php');
include(dirname(__DIR__).'/public/ErrorHandler.php');
header("Content-type: application/json; charset=UTF-8");
set_exception_handler("ErrorHandler::handleException");

$parts = explode("/", $_SERVER["REQUEST_URI"]);
echo "\n\n";
$id = $parts[3] ??  null;

if ($parts[2] === "users") {
    include(dirname(__DIR__).'/public/UserManagement.php');
    $model = new UserManager();
    $model->processRequest($_SERVER["REQUEST_METHOD"], $id);
}else echo "lists";

?>