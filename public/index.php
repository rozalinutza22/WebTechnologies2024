<?php

require_once '../controllers/login_controller.php';

// Simple routing logic 
$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri === '/login') {
    require __DIR__ . '/../views/login_view.php';

} elseif ($requestUri === '/user/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController();
    $controller->login();

} elseif ($requestUri === '/menu') {
    require '../views/menu.php';


} elseif ($requestUri === '/profile') {
    require '../views/profile.php';


} elseif ($requestUri === '/create-account') {
    require '../views/create_account.php';


} elseif ($requestUri === '/produs') {
    require '../views/produs.php';

} elseif ($requestUri === '/lists') {
    require '../views/cumparaturi_view.php';

} elseif ($requestUri === '/principal') {
    require '../views/principal.php';

} elseif ($requestUri === '/modify') {
    require '../views/modify_account.php';

} elseif ($requestUri === '/signup') {
    require '../includes/create_acc.php';

} elseif ($requestUri === '/modif') {
    require '../includes/modify_acc.php';
 
} else {
    echo '404 Not Found';
}
