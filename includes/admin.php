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
                <button type="submit" name="filter_name">Delete all users</button>
                <button type="submit" name="create_user">Create new user</button>
            </form>
        </div>

        <br>
        <br>

        <div class="deleteUserId">
          <form action="/modify-admin" method="post">
            <input type="text" placeholder="Insert user id" name="search" class="sc">
            <button type="submit" name="search_product" class="sButton">Delete user</button>
          </form>
        </div>

        <br>
        <br>

        <div class="deleteListId">
          <form action="/modify-admin" method="post">
            <input type="text" placeholder="Insert list id" name="search" class="sc">
            <button type="submit" name="search_product" class="sButton">Delete list</button>
          </form>
        </div>

        <br>
        <br>

        <div class="deleteAllListId">
          <form action="/modify-admin" method="post">
            <input type="text" placeholder="Insert user id" name="search" class="sc">
            <button type="submit" name="search_product" class="sButton">Delete all lists</button>
          </form>
        </div>

    </body>
</html>