<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My lists</title>
    <link href="css/cumparaturi.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="menu.html">Home</a></li>
            <li><a href="cumparaturi.php">My lists</a></li>
            <li><a href="profile.html">Profile</a></li>
        </ul>
    </nav>

    <div class="searchSection">
        <div class="textTitle">All you need is here</div>
        <div class="search-container">
            <form action="controllers/cumparaturi_controller.php" method="post">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>

    <div class="add-list-form">
        <form action="controllers/cumparaturi_controller.php" method="post">
            <label for="list-name">List Name:</label>
            <input type="text" id="list-name" name="list_name" required>
            <button type="submit">Add List</button>
        </form>
    </div>

    <?php
    include 'controllers/cumparaturi_controller.php';
    ?>

    <div class="detaliiFinal">
        <img class="logo" src="images/logo.png" alt="logo">
        <div class="detaliiContact">
            <p class="footerTitle">Contact us at:</p>
            <p class="footerText">FoodStash@gmail.com</p>
            <p class="footerText">0769436813</p>
        </div>
    </div>
</body>
</html>
