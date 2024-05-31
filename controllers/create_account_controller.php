<?php
include(dirname(__DIR__).'/models/create_account_model.php');
// include(dirname(__DIR__).'/views/create_account.php');

// include(dirname(__DIR__).'/includes/config_db.php');

$model = new SignUpModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Redirect to refresh the page after adding the list

    $first_name = $_POST['user_fname'];
    $last_name = $_POST['user_lname'];
    $email = $_POST['user_email'];
    $pass = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
    $phone = $_POST['user_phone'];

    $model->insertNewUser($first_name, $last_name, $email, $pass, $phone);

    if (isset($_POST['vegetarian']) && $_POST['vegetarian'] === 'Vegetarian') {
        $isVegetarian = 1;
        // $user_id = $model->getUserId($first_name, $last_name, $email);
        $model->isVegetarian($email);
    } else {
        $isVegetarian = 0;
    }

    if (isset($_POST['admin']) && $_POST['admin'] === 'Admin') {
        $isAdmin = 1;
        // $user_id = $model->getUserId($first_name, $last_name, $email);
        $model->isAdmin($email);
    } else {
        $isAdmin = 0;
    }

    if (isset($_POST['allergens'])) {
        $allergens = $_POST['allergens'];
        $allergens2 = htmlspecialchars($allergens, ENT_QUOTES, 'UTF-8');
        // $user_id = $model->getUserId($first_name, $last_name, $email);
        $model->insertAllergens($allergens2, $email);
        // $model->insertAllergens($allergens, $email);
    }

    header("Location: /menu");
    exit();
}

// include(dirname(__DIR__).'/views/create_account.php');

?>