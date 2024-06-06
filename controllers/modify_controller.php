<?php

include(dirname(__DIR__).'/models/modify_model.php');

$model = new ModifyModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_acc'])) {
    session_start();
    $user_fname = $_SESSION["user_fname"];
    $user_lname = $_SESSION["user_lname"];
    $user_email = $_SESSION["user_email"];
    $user_phone = $_SESSION["user_phone"];
    $allerg = $_SESSION["allergens"];
    $veg = $_SESSION["vegetarian"];
    $admin = $_SESSION["admin"];
    
    if (!empty($_POST["fname"])) {
        $first_name = $_POST['fname'];
        $_SESSION["user_fname"] = $_POST['fname'];
        $model->updateUserFname($first_name, $user_email);

    }

    if (!empty($_POST['lname'])) {
        $last_name = $_POST['lname'];
        $_SESSION["user_lname"] = $_POST['lname'];
        $model->updateUserLname($last_name, $user_email);
    }

    if (!empty($_POST['vegetarian'])) {
        $model->updateisVegetarian($user_email);
        $_SESSION["vegetarian"] = 1;
    }

    if (!empty($_POST['user_pass'])) {
        $pass = $_POST['user_pass'];
        $pass2 = password_hash($pass, PASSWORD_DEFAULT);
        $model->updatePass($pass2, $user_email);
    }

    if (!empty($_POST['allergens'])) {
        $all = $_POST['allergens'];
        $_SESSION["allergens"] = $_POST['allergens'];
        $model->updateAllergens($all, $user_email);
    }

    header("Location: /profile");
    exit();
}