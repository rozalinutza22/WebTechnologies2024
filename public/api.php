<?php
include(dirname(__DIR__).'/public/ErrorHandler.php');
header("Content-type: application/json; charset=UTF-8");
set_exception_handler("ErrorHandler::handleException");

$parts = explode("/", $_SERVER["REQUEST_URI"]);
echo "\n\n";
$id = $parts[3] ??  null;
$list_id = $parts[4] ?? null;
$product_id = $parts[5] ?? null;

if ($parts[2] === "users") {
    include(dirname(__DIR__).'/public/UserManagement.php');
    $model = new UserManager();
    $model->processRequest($_SERVER["REQUEST_METHOD"], $id, $list_id);
}elseif ($parts[2] ==="lists") {
    include(dirname(__DIR__).'/public/ListManagement.php');
    $manager = new ListManager();
    $manager->processRequest($_SERVER["REQUEST_METHOD"], $id, $list_id, $product_id);
}elseif($parts[2] == "login"){
    include(dirname(__DIR__).'/public/LoginManagement.php');
    $loginManager = new LoginManager();
    $loginManager->processRequest($_SERVER["REQUEST_METHOD"]); 
}else echo "No such endpoint exists yet.";

?>