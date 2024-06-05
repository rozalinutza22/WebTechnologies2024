<?php
include(dirname(__DIR__).'/models/create_account_model.php');
// include(dirname(__DIR__).'/views/create_account.php');

// include(dirname(__DIR__).'/includes/config_db.php');

$model = new SignUpModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    session_start();
    $_SESSION["user_password"] = htmlentities($_POST["user_password"]);
    $_SESSION["user_fname"] = htmlentities($_POST["user_fname"]);
    $_SESSION["user_lname"] = htmlentities($_POST["user_lname"]);
    $_SESSION["user_email"] = htmlentities($_POST["user_email"]);
    $_SESSION["user_phone"] = htmlentities($_POST["user_phone"]);
    // $_SESSION["vegetarian"] = htmlentities($_POST["vegetarian"]);
    // $_SESSION["admin"] = htmlentities($_POST["admin"]);
    // $_SESSION["allergens"] = htmlentities($_POST["allergens"]);

    // header("Location: /profile");

    if (empty($_POST["user_password"])) {
        die("Password is required! Go back to the form!");
    }

    if (empty($_POST["user_email"])) {
        die("Phone number is required! Go back to the form!");
    }

    if ( ! filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL)) {
        die("Valid email is required!");
    }

    if (strlen($_POST["user_password"]) < 8) {
        die("Password must be at least 8 characters!");
    }

    $first_name = $_POST['user_fname'];
    $last_name = $_POST['user_lname'];
    $email = $_POST['user_email'];
    $pass = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
    $phone = $_POST['user_phone'];

    $result = $model->insertNewUser($first_name, $last_name, $email, $pass, $phone);

    if ($result === true) {
        if (isset($_POST['vegetarian']) && $_POST['vegetarian'] === 'Vegetarian') {
            $isVegetarian = 1;
            $model->isVegetarian($email);
            $_SESSION["vegetarian"] = 1;
        } else {
            $isVegetarian = 0;
            // $_SESSION["vegetarian"] = 'No';
            $_SESSION["vegetarian"] = 0;
        }
    
        if (isset($_POST['admin']) && $_POST['admin'] === 'Admin') {
            $isAdmin = 1;
            $model->isAdmin($email);
            $_SESSION["admin"] = 1;
        } else {
            $isAdmin = 0;
            $_SESSION["admin"] = 0;
            // $_SESSION["admin"] = 'No';
        }
    
        if (isset($_POST['allergens'])) {
            $_SESSION["allergens"] = htmlentities($_POST["allergens"]);
            $allergens = $_POST['allergens'];
            $allergens2 = htmlspecialchars($allergens, ENT_QUOTES, 'UTF-8');
            $model->insertAllergens($allergens2, $email);
        } 

        header("Location: /menu");
        exit;
    } elseif ($result === "Duplicate email") {
        die("This email is already in use! Go back to the form!");
    } elseif ($result === "Duplicate phone") {
        die("This phone number is already in use! Go back to the form!");
    } else {
        header("Location: /signup?error=database_error");
        exit;
    }
}

?>