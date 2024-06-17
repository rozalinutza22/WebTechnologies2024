<?php
// aici verifica dacă există cookies pentru email și parola
$email_cookie = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';
$password_cookie = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to Food Stash</title>
    <style>
        <?php include "../css/login.css"; ?>
    </style>
</head>
<body>
    <form action="/login" method="post">
        <h1 class="strokeTitle">Login into your account.</h1>
        <ul>
            <li>
                <label for="email" class="stroke">Email:</label>
                <input type="email" id="email" name="email" class="input" value="<?php echo $email_cookie; ?>" required><br>
            </li>
            <li>
                <label for="password" class="stroke">Password:</label>
                <input type="password" id="password" name="password" class="input" value="<?php echo $password_cookie; ?>" required><br>
            </li>
            <li>
                <input type="checkbox" id="stay_connected" name="stay_connected">
                <label for="stay_connected" class="checkbox">Save login details by allowing cookies.</label>
            </li>
            <li>
                <button type="submit">Submit</button>
            </li>
        </ul>
        <p class="text">Don't have an account? <a href="/create-account">Sign up.</a></p>
    </form>
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color:red;">Invalid email or password.</p>';
    }
    ?>
</body>
</html>
