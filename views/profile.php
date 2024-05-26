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