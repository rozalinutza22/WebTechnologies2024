<?php

include(dirname(__DIR__).'/models/modify_model.php');

$model = new ModifyModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_acc'])) {
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];

    if (isset($_POST['fname']) && isset($_POST['lname'])) {
        $model->updateUser($fname, $lname, $email);
    } else if (isset($_POST['fname'])) {
        $model->updateUserFname($fname, $email);
    }else if (isset($_POST['lname'])) {
        $model->updateUserLname($lname, $email);
    }else {
        
    }




}