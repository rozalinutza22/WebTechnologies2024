<?php

require_once '../controllers/login_controller.php';

// Simple routing logic 
$requestUri = $_SERVER['REQUEST_URI'];


if (strpos($requestUri, '/product') === 0) {
    require_once '../controllers/product_controller.php';
}
elseif ($requestUri === '/login') {
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

} elseif ($requestUri === '/lists') {
    require_once '../controllers/cumparaturi_controller.php';

} elseif ($requestUri === '/principal') {
    require '../views/principal.php';

} elseif ($requestUri === '/modify') {
    require '../views/modify_account.php';

} elseif ($requestUri === '/signup') {
    require '../controllers/create_account_controller.php';

} elseif ($requestUri === '/modif') {
    require '../controllers/modify_controller.php';
 
} elseif ($requestUri === '/logout') {
    require '../includes/logout.php';
 
}elseif ($requestUri === '/search') {
    require '../controllers/menu_controller.php';
 
}elseif ($requestUri === '/access-admin') {
    require '../includes/admin.php';

}elseif ($requestUri === '/modify-admin') {
    require '../controllers/admin_controller.php';

}elseif ($requestUri === '/new-user') {
    require '../includes/create_new_user.php';

}elseif ($requestUri === '/new-user-form') {
    require '../controllers/create_new_user_controller.php';

}else {
    echo '404 Not Found';
}
