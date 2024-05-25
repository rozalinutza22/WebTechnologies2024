<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to Food Stash</title>
    <!-- <link href="../css/login.css" rel="stylesheet" type="text/css"> -->
    <style>
            <?php include "../css/login.css" ?>
    </style>
</head>
<body>
    <form action="/user/login" method="post">
        <h1 class="strokeTitle"> Login into your account. </h1>
        <ul>
            <li>
                <label for="name" class="stroke">Name:</label>
                <input type="text" id="name" name="user_name" class="input">
            </li>
            <li>
                <label for="password" class="stroke">Password:</label>
                <input type="password" id="password" name="user_password" class="input">
            </li>
            <li>
                <input type="checkbox" id="stayConnected" name="stay_connected">
                <label for="stayConnected" class="checkbox">Save login details by allowing cookies.</label>
            </li>
            <li>
                <button type="submit">Submit</button>
            </li>
        </ul>
        <p class="text">Don't have an account? <a href="create_account.php">Sign up.</a></p>
    </form>
</body>
</html>
