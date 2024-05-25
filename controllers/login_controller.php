<?php

class UserController {
    public function login() {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the form data
            $username = $_POST['user_name'];
            $password = $_POST['user_password'];
            $stayConnected = isset($_POST['stay_connected']);

            // Here you would typically validate the user's credentials
            // For the sake of this example, we will assume validation is successful

            // If 'Stay connected' is checked, set a cookie
            if ($stayConnected) {
                setcookie('user_name', $username, time() + (30 * 24 * 60 * 60), '/'); // 30 days
                setcookie('user_password', $password, time() + (30 * 24 * 60 * 60), '/'); // 30 days
            }

            // Redirect to the menu page
            header('Location: /menu');
            exit();
        } else {
            // Show the login form
            require '../views/login.php';
        }
    }
}
