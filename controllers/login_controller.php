<?php

include(dirname(__DIR__).'/models/login_model.php');
$loginModel = new LoginModel();

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 $firstName = $_POST['user_name'];
 $password = $_POST['user_password'];
 $stayConnected = isset($_POST['stay_connected']);

 $user = $loginModel->validateCredentials($firstName, $password);

if ($user) {
 if ($stayConnected) {
  setcookie('user_id', $user['id'], time() + (30 * 24 * 60 * 60), '/'); // 30 days
  setcookie('user_token', $user['session_token'], time() + (30 * 24 * 60 * 60), '/'); // 30 days
                   }

       header('Location: /menu');
       exit();
 } else {
  header('Location: /login?error=invalid_credentials');
 exit();
        }
 } else {
    include(dirname(__DIR__).'/views/login_view.php');
     header('Location: /login');
      exit();
        }

include(dirname(__DIR__).'/views/login_view.php');

?>
