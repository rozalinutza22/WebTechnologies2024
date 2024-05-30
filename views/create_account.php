<!DOCTYPE html>
<html lang="en-US">
    <head>
        <!-- <meta charset="utf-8" /> -->
        <title>Create account</title>
        <style>
            <?php include "../css/create_account.css" ?>
        </style>
    </head>

    <body>
        <h1>Create an account for free!</h1>
        <br> <br> <br>

        <form class="forms" action="includes/create_acc.php" method="post" novalidate>
            <ul>
                <li>
                    <label class="input-group">First Name</label>
                    <br>
                    <br>
                    <input autofocus type="text" id="first_name" name="user_name" placeholder="Ex: Anna" required>
                </li>
                <li>
                    <br>
                    <label class="input-group">Last Name</label>
                    <br>
                    <br>
                    <input type="text" id="last_name" name="user_name" placeholder="Ex: Gomez" required>
                </li>
                <li>
                    <br>
                    <label class="input-group">Email</label>
                    <br>
                    <br>
                    <input type="text" id="email_name" name="user_name" placeholder="Ex: anna223@gmail.com" required>
                </li>
                <li>
                    <br>
                    <label class="input-group" for="password">Password</label>
                    <br>
                    <br>
                    <input type="password" id="password" name="user_password" required> <br>
                    <small id="strong_pass"> Use a strong password!</small>
                </li>
                <li>
                    <br>
                    <label class="input-group">Phone number</label>
                    <br>
                    <br>
                    <input type="tel" id="phone_number" name="user_phone"  pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}" placeholder="Ex: 0700000000" required>
                </li>
                <li>
                    <br>
                    <input type="checkbox" id="vegetarian" name="vegetarian" value="Vegetarian">
                    <label class="input-group" for="vegetarian"> Vegetarian diet</label><br>
                </li>
                <li>
                    <br>
                    <input type="checkbox" id="admin" name="admin" value="Admin">
                    <label class="input-group" for="admin"> Admin</label><br>
                </li>

                <li>
                    <br>
                    <p>Add here the allergens you are allergic to:</p>
                    <textarea id="allergens"></textarea>
                </li>
                <li>
                    <br>
                    <button id="create" name="create_acc">Create account</button>
                </li>
            </ul>
        </form>
        <img src="images/logo.png" alt="logo">
    </body>
</html>