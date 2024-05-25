<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>
        <style>
            <?php include "../css/profile.css" ?>
        </style>
        <!-- <link href="../css/profile.css" rel="stylesheet" type="text/css"> -->
        <!-- <link rel="stylesheet" href="../css/profile.css?v=<?php echo time(); ?>"> -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    </head>

    <body>
        <nav>
            <ul>
              <li><a href="principal.html">Home</a></li>
              <li><a href="cumparaturi.php">My lists</a></li>
              <li><a href="profile.php">Profile</a></li>
            </ul>
          </nav> 

        <h1>Welcome!</h1>

        <div class="circular-image">
          <img src="images/avatar.png" alt="user photo">
        </div>

        <div class="user_info">
            <div class="info">
                <h3>First name</h3>
                <p>Your first name</p>
            </div>

            <br>

            <div class="info">
                <h3>Last name</h3>
                <p>Your last name</p>
            </div>

            <br>

            <div class="info">
                <h3>Email adress</h3>
                <p>Your email adress</p>
            </div>

            <br>

            <div class="info">
                <h3>Phone number</h3>
                <p>Your phone number</p>
            </div>

            <br>

            <div class="info">
                <h3>Vegetarian</h3>
                <p>Yes/No</p>
            </div>

            <br>
            
            <div class="info">
                <h3>Admin</h3>
                <p>Yes/No</p>
            </div>
        </div>

      <a href="modify_account.html"><button id="create" name="create_acc">Modify</button></a>
      <button class="import">Import</button>
      <button class="export">Export</button>
    </body>
</html>