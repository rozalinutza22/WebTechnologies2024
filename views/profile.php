<?php
    session_start();

    $user_fname = $_SESSION["user_fname"];
    $user_lname = $_SESSION["user_lname"];
    $user_email = $_SESSION["user_email"];
    $user_phone = $_SESSION["user_phone"];
    // $allergens = $_SESSION["allergens"];

    foreach(array('vegetarian', 'admin') as $name) {
        $_SESSION[$name] = (isset($_POST[$name])) ? $_POST[$name] : "";
    }

    foreach(array('allergens') as $alg) {
        $_SESSION[$alg] = (isset($_POST[$alg])) ? $_POST[$alg] : "";
    }
    
?>


<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>
        <style>
            <?php include "../css/profile.css" ?>
        </style>
    </head>

    <body>
        <nav>
            <ul>
              <li><a href="/principal">Home</a></li>
              <li><a href="/lists">My lists</a></li>
              <li><a href="/profile">Profile</a></li>
            </ul>
          </nav> 

        <h1>Welcome!</h1>

        <div class="circular-image">
          <img src="images/avatar.png" alt="user photo">
        </div>

        <div class="user_info">
            <div class="info">
                <h3>First name</h3>
                <p> <?php echo $user_fname; ?> </p>
            </div>

            <br>

            <div class="info">
                <h3>Last name</h3>
                <p><?php echo $user_lname; ?></p>
            </div>

            <br>

            <div class="info">
                <h3>Email adress</h3>
                <p><?php echo $user_email; ?></p>
            </div>

            <br>

            <div class="info">
                <h3>Phone number</h3>
                <p><?php echo $user_phone; ?></p>
            </div>

            <br>

            <div class="info">
                <h3>Vegetarian</h3>
                <p>
                    <?php 
                        if (empty($_SESSION[$name])) echo "No";
                        else echo "Yes";
                    ?>
                </p>
            </div>

            <br>
            
            <div class="info">
                <h3>Admin</h3>
                <p>
                    <?php 
                        if (empty($_SESSION[$name])) echo "No";
                        else echo "Yes";
                    ?>
                </p>
            </div>

            <br>

            <div class="info">
                <h3>Allergens</h3>
                <p>
                    <?php 
                        if (empty($_SESSION[$alg])) echo 'None';
                        else echo $_SESSION[$alg];   
                    ?>
                </p>
            </div>
        </div>

      <a href="/modify"><button id="create" name="create_acc">Modify</button></a>
      <button class="import">Import</button>
      <button class="export">Export</button>
      <a href="/logout"><button class="logout">Logout</button>
    </body>
</html>