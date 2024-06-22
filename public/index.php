<?php

$requestUri = $_SERVER['REQUEST_URI'];

if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {

    if (strpos($_SERVER['REQUEST_URI'], '/users') === false && strpos($_SERVER['REQUEST_URI'], '/lists') === false && strpos($_SERVER['REQUEST_URI'], '/login') == false) {
        http_response_code(404); 
        echo "404 Not Found";
        exit;
    }

    include_once 'api.php';
    exit; 
}

if (strpos($requestUri, '/product') === 0) {
    require_once '../controllers/product_controller.php';
}
elseif ($requestUri === '/login') {
    require_once '../controllers/login_controller.php';
}
elseif (strpos($requestUri, '/selectList') === 0) {
 require_once '../controllers/selectList_controller.php';

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

}elseif ($requestUri === '/delete_acc') {
    require '../controllers/profile_controller.php';
}elseif ($requestUri === '/noLogin') {
        require_once '../views/noLogin_view.php';
}else {
    echo '404 Not Found';
}
