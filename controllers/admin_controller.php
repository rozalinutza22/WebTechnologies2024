<?php
include(dirname(__DIR__).'/models/admin_model.php');
$model = new AdminModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])) {
    $user_id = $_POST['delete-user'];
    $res = $model->deleteAllLists($user_id);
    $allProducts = $model->deleteUserId($user_id);

    header("Location: /access-admin"); 
    exit();
}   

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete-users'])) {
    $res = $model->deleteAll();
    $allProducts = $model->deleteAllUsers();

    header("Location: /access-admin"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteList'])) {
    $list_id = $_POST['searchList'];
    $user_id = $_POST['searchUser'];
    $allProducts = $model->deleteList($user_id, $list_id);

    header("Location: /access-admin"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteAllLists'])) {
    $user_id = $_POST['deleteAllL'];
    $allProducts = $model->deleteAllLists($user_id);

    header("Location: /access-admin"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])) {
    header("Location: /new-user"); 
    exit();
}

include(dirname(__DIR__).'/includes/admin.php');
?>