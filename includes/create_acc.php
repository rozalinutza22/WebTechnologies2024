<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $first_name = $_POST['user_fname'];
        $last_name = $_POST['user_lname'];
        $email = $_POST['user_email'];
        $pass = $_POST['user_password'];
        $phone = $_POST['user_phone'];

        if (isset($_POST['vegetarian']) && $_POST['vegetarian'] === 'Vegetarian') {
            $isVegetarian = 1;
        } else {
            $isVegetarian = 0;
        }

        if (isset($_POST['admin']) && $_POST['admin'] === 'Admin') {
            $isAdmin = 1;
        } else {
            $isAdmin = 0;
        }
    }
}