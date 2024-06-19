<?php
    include(dirname(__DIR__).'/models/profile_model.php');
    $model = new DeleteAccModel();
    session_start();
    $email = $_SESSION['user_email'];
    $_SESSION['user_id'] = $model->getId($email);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete-user'])) {
        $res = $model->deleteUserLists($_SESSION['user_id']);
        $allProducts = $model->deleteUserPref($_SESSION['user_id']);
        $all = $model ->deleteUser($_SESSION['user_email']);
    
        header("Location: /principal"); 
        exit();
    }
?>