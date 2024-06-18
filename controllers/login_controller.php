<?php
session_start();

include(dirname(__DIR__).'/models/login_model.php');
$loginModel = new LoginModel();

// Verifică dacă utilizatorul este deja autentificat
if (isset($_SESSION["user_email"])) {
    header("Location: /menu");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stayConnected = isset($_POST['stay_connected']) ? $_POST['stay_connected'] : '';

    $user = $loginModel->validateCredentials($email, $password);

    if($user=="Incorrect password."){
       echo "Wrong password! Try again.";
}
    else if($user=="Incorect email."){
       echo "Wrong email! Try again.";
    }
else if ($user) {
       
        $_SESSION["user_email"] = $user['emailAdress'];
        $_SESSION["user_fname"] = $user['firstName'];
        $_SESSION["user_lname"] = $user['lastName'];
        $_SESSION["user_phone"] = $user['phoneNumber'];
        $_SESSION["allergens"] = $user['allergens'];
        $_SESSION["admin"] = $user['admin'];
        $_SESSION['vegetarian'] = $user['vegetarian'];
        $_SESSION['user_id'] = $user['id'];
        $id = $user['id'];

        // Dacă a bifat cookies
        if ($stayConnected) {
            setcookie('email', $email, time() + (30 * 24 * 60 * 60), '/'); // 30 days
            setcookie('password', $password, time() + (30 * 24 * 60 * 60), '/'); // 30 days
            setcookie('id', $id, time() + (30 * 24 * 60 * 60), '/');
        } else {
            // Dacă nu a selectat cookies, șterge cookies existente
            if (isset($_COOKIE["email"])) {
                setcookie("email", "", time() - 3600, "/");
            }
            if (isset($_COOKIE["password"])) {
                setcookie("password", "", time() - 3600, "/");
            }
        }

        header("Location: /menu");
        exit();
    } else {
        header("Location: /login?error=1");
        exit();
    }
} else {
    include(dirname(__DIR__).'/views/login_view.php');
}

$loginModel->closeConnection();
?>
