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
              <li><a href="/principal">Home</a></li>
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
                    <input autofocus type="text" id="first_name" name="fname" placeholder="Ex: Anna" >
                </li>
                <li>
                    <br>
                    <label class="input-group">Last Name</label>
                    <br>
                    <br>
                    <input type="text" id="last_name" name="lname" placeholder="Ex: Gomez" >
                </li>
                <!-- <li>
                    <br>
                    <label class="input-group">Email</label>
                    <br>
                    <br>
                    <input type="text" id="email_name" name="user_name" placeholder="Ex: anna223@gmail.com" >
                </li> -->
                <!-- <li>
                    <br>
                    <label class="input-group">Password</label>
                    <br>
                    <br>
                    <input type="password" id="password" name="user_password" > <br>
                    <small id="strong_pass"> Use a strong password!</small>
                </li> -->
                <!-- <li>
                    <br>
                    <label class="input-group">Phone number</label>
                    <br>
                    <br>
                    <input type="tel" id="phone_number" name="user_phone"  ppattern="[0-9]{4}-[0-9]{3}-[0-9]{3}" placeholder="Ex: 0700000000" >
                </li> -->
                <li>
                    <br>
                    <input type="checkbox" id="vegetarian" name="vegetarian" value="Vegetarian">
                    <label class="input-group" for="vegetarian"> Vegetarian diet</label><br>
                </li>
                <li>
                    <br>
                    <p>Add here the allergens you are allergic to:</p>
                    <textarea id="allergens"></textarea>
                </li>
                <li>
                    <br>
                    <br>
                    <button id="mod" name="change_pass">Change password</button>
                </li>
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