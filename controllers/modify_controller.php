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

    if (isset($_POST['fname'])) {
        $first_name = $_POST['fname'];
        $model->updateUserFname($first_name, $user_email);
        $_SESSION["user_fname"] = $_POST['fname'];
    }

    if (isset($_POST['lname'])) {
        $last_name = $_POST['lname'];
        $model->updateUserLname($last_name, $user_email);
        $_SESSION["user_lname"] = $_POST['lname'];
    }

    if (isset($_POST['vegetarian'])) {
        $model->updateisVegetarian($user_email);
        $_SESSION["vegetarian"] = 1;
    }

    if (isset($_POST['user_pass'])) {
        $pass = $_POST['user_pass'];
        $model->updatePass($pass, $user_email);
    }

    if (isset($_POST['allergens'])) {
        $all = $_POST['allergens'];
        $model->updateAllergens($all, $user_email);
        $_SESSION["allergens"] = $_POST['allergens'];
    }

    // header("Location: /profile");
    // exit();
}