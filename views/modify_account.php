<?php
    session_start();
    $user_fname = $_SESSION["user_fname"];
    $user_lname = $_SESSION["user_lname"];
    $user_email = $_SESSION["user_email"];
    $user_phone = $_SESSION["user_phone"];
    $allerg = $_SESSION["allergens"];
    $veg = $_SESSION["vegetarian"];
    $admin = $_SESSION["admin"];
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Modify your account details</title>
        <style>
            <?php include "../css/modify_account.css" ?>
        </style>
    </head>

    <body>
        <nav>
            <ul>
              <li><a href="/menu">Home</a></li>
              <li><a href="/lists">My lists</a></li>
              <li><a href="/profile">Profile</a></li>
            </ul>
          </nav>
    
          <br>
          <br>
          <br>

        <h1>Modify your account</h1>

        <form class="forms" action="/modif" method="post">
            <ul>
                <li>
                    <label class="input-group">First Name</label>
                    <br>
                    <br>
                    <input autofocus type="text" id="first_name" name="fname" placeholder=<?php echo $user_fname; ?> >
                </li>
                <li>
                    <br>
                    <label class="input-group">Last Name</label>
                    <br>
                    <br>
                    <input type="text" id="last_name" name="lname" placeholder=<?php echo $user_lname; ?> >
                </li>
                <li>
                    <br>
                    <label class="input-group">Password</label>
                    <br>
                    <br>
                    <input type="password" id="password" name="user_pass" > <br>
                    <small id="strong_pass"> Use a strong password!</small>
                </li>
                <li>
                    <br>
                    <input type="checkbox" id="vegetarian" name="vegetarian" value="Vegetarian">
                    <label class="input-group" for="vegetarian"> Vegetarian diet</label><br>
                </li> 
                <li>
                    <br>
                    <p>Add here the allergens you are allergic to:</p>
                    <textarea id="allergens" name="allergens" placeholder=<?php echo $allerg; ?> ></textarea>
                </li>
                <!-- <li>
                    <br>
                    <br>
                    <button id="mod" name="change_pass">Change password</button>
                </li> -->
                <li>
                    <br>
                    <br>
                    <button id="create" name="create_acc">Modify</button>
                </li>
            </ul>
        </form>  
        <img src="images/logo.png" alt="logo">
    </body>
</html>