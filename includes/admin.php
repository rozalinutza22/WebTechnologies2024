<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin page</title>
        <style>
            <?php include "../css/admin.css" ?>
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

        <h1>Wellcome, admin!</h1>

        <br>
        <br>
        <br>
        <br>
        
        <div class="adminButtons">
            <form action="/modify-admin" method="post">
                <button type="submit" name="delete-users">Delete all users</button>
                <button type="submit" name="create-user" class="create-user">Create new user</button>
            </form>
        </div>

        <br>
        <br>

        <div class="deleteUserId">
          <form action="/modify-admin" method="post">
            <input type="text" placeholder="Insert user id" name="delete-user" class="sc">
            <button type="submit" name="deleteUser" class="sButton">Delete user</button>
          </form>
        </div>

        <br>
        <br>

        <div class="deleteListId">
          <form action="/modify-admin" method="post">
            <input type="text" placeholder="Insert user id" name="searchUser" class="sc">
            <input type="text" placeholder="Insert list id" name="searchList" class="sc">
            <button type="submit" name="deleteList" class="sButton">Delete list</button>
          </form>
        </div>

        <br>
        <br>

        <div class="deleteAllListId">
          <form action="/modify-admin" method="post">
            <input type="text" placeholder="Insert user id" name="deleteAllL" class="sc">
            <button type="submit" name="deleteAllLists" class="sButton">Delete all lists</button>
          </form>
        </div>

    </body>
</html>